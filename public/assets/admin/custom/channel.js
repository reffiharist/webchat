"use strict";

var tableData;
var save_method;
var baseUrl = window.location.protocol + '//' + window.location.hostname + '/webchat';

function tableData() {
	tableData = $('#dataTable').DataTable( {
		"processing" : true,
		"lengthChange": false,
		"info": false,
		"serverSide": true,
		"stateSave" : false,
		responsive: false,
		order: [],
        "ajax":{
            url : baseUrl + "/backend/channel/dataList",
            type: "post",
        },
		columnDefs: [
			{targets: [0], orderable: false},
			{targets: [6], orderable: false, class: 'text-end'},
		],
		
	});
};

function add()
{
    save_method = 'create';

    $('#kt_modal_add_channel_header h2').text('Add Channel');
    $('.fv-row .invalid-feedback').remove();
    $("#form").trigger('reset');
    $("select[name=category]").val('').trigger('change');
    $('#kt_modal_channel').modal('show');
}

function edit(id)
{
    save_method = 'update';

    $("#form").trigger('reset');
    $("select[name=category]").val('').trigger('change');
    $('.fv-row .invalid-feedback').remove();
    $('#kt_modal_add_channel_header h2').text('Edit Channel');

    $.ajax({
        type     : "POST",
        url      : baseUrl + "/backend/channel/getData",
        data     : {id:id},
        dataType : "json",
        error    : function (xhr, status, error) {
            alert("An error occurred");
        },
        success  : function(data) {

            $('[name=id]').val(id);
            $('[name=name]').val(data.name);
            $('[name=code]').val(data.code);
            $('[name=fee]').val(data.fee);
            $('[name=feeadd]').val(data.feeadd);
            $("select[name=category]").val(data.category).trigger('change');

            if(data.fee_type == 'percent') {
                $('[name=fee_type]').prop('checked', true);
            }

            if(data.feeadd_type == 'percent') {
                $('[name=feeadd_type]').prop('checked', true);
            }

            $('#kt_modal_channel').modal('show');
        },
    });
}

function save() {

	var btnSubmit = document.querySelector('[data-kt-channel-modal-action="submit"]');

    $('.fv-row .invalid-feedback').remove();

	btnSubmit.setAttribute("data-kt-indicator", "on");
	btnSubmit.disabled = !0;

	$.ajax({
        type : "POST",
        url : baseUrl + '/backend/channel/' + save_method,
        data : $('#form').serialize(),
        dataType : "json",
        error : function () {
        	btnSubmit.removeAttribute("data-kt-indicator");
			btnSubmit.disabled = !1;
            alert("An error occurred");
        },
        success : function(data)
        {
            btnSubmit.removeAttribute("data-kt-indicator");
			btnSubmit.disabled = !1;

            var text_message = save_method == 'create' ? 'ditambahkan' : 'diedit';
            
            if(data.error == true)
            {
                $('.fv-row input[name=name]').after(data.name);
                $('.fv-row input[name=code]').after(data.code);
                $('.fv-row input[name=fee]').after(data.fee);
                $('.fv-row input[name=feeadd]').after(data.feeadd);
                $('.fv-row input[name=fee_type]').after(data.fee_type);
                $('.fv-row input[name=feeadd_type]').after(data.feeadd_type);
                $('.fv-row input[name=category]').after(data.category);
            }
            else
            {
                $('#kt_modal_channel').modal('hide');

                Swal.fire('Sukses!', 'Data berhasil '+ text_message, 'success');

                reloadTable();
            }
        }
    });
}

KTUtil.onDOMContentLoaded(function () {
    tableData();

    // Add function KTMenu
    tableData.on('draw', function() {
        KTMenu.createInstances();
    });

    // Search table
    document.querySelector('[data-kt-filter="search"]').addEventListener("keyup", function (t) {
        tableData.search(t.target.value).draw();
    });
});
