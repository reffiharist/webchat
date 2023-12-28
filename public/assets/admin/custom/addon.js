"use strict";

var tableData;
var save_method;

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
            url : baseUrl + "/backend/addon/dataList",
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

    $('#kt_modal_add_addon_header h2').text('Add Addon');
    $('.fv-row .invalid-feedback').remove();
    $("#form").trigger('reset');
    $("select[name=type]").val('').trigger('change');
    $('#kt_modal_addon').modal('show');
}

function edit(id)
{
    save_method = 'update';

    $("#form").trigger('reset');
    $("select[name=type]").val('').trigger('change');
    $('.fv-row .invalid-feedback').remove();
    $('#kt_modal_add_addon_header h2').text('Edit Addon');

    $.ajax({
        type     : "POST",
        url      : baseUrl + "/backend/addon/getData",
        data     : {id:id},
        dataType : "json",
        error    : function (xhr, status, error) {
            alert("An error occurred");
        },
        success  : function(data) {

            $('[name=id]').val(id);
            $('[name=name]').val(data.name);
            $('[name=price]').val(data.price);
            $('[name=number]').val(data.number);
            $('[name=message]').val(data.message);
            $("select[name=type]").val(data.type).trigger('change');
            $('[name=desc]').val(data.desc);
            $('#kt_modal_addon').modal('show');
        },
    });
}

function save() {

	var btnSubmit = document.querySelector('[data-kt-addon-modal-action="submit"]');

    $('.fv-row .invalid-feedback').remove();

	btnSubmit.setAttribute("data-kt-indicator", "on");
	btnSubmit.disabled = !0;

	$.ajax({
        type : "POST",
        url : baseUrl + '/backend/addon/' + save_method,
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
                $('.fv-row input[name=price]').after(data.price);
                $('.fv-row input[name=number]').after(data.number);
                $('.fv-row input[name=message]').after(data.message);
                $('.fv-row input[name=type]').after(data.type);
                $('.fv-row textarea[name=desc]').after(data.desc);
            }
            else
            {
                $('#kt_modal_addon').modal('hide');

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
