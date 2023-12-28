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
            url : baseUrl + "/backend/feature/dataList",
            type: "post",
        },
		columnDefs: [
			{targets: [0], class: 'text-gray-800 fw-bold'},
			{targets: [3], orderable: false, class: 'text-end'},
		],
		
	});
};

function add()
{
    save_method = 'create';

    $('#kt_modal_add_feature_header h2').text('Add Feature');
    $('.fv-row .invalid-feedback').remove();
    $("#form").trigger('reset');
    $('#kt_modal_feature').modal('show');
}

function edit(id)
{
    save_method = 'update';

    $("#form").trigger('reset');
    $('.fv-row .invalid-feedback').remove();
    $('#kt_modal_add_feature_header h2').text('Edit Feature');

    $.ajax({
        type     : "POST",
        url      : baseUrl + "/backend/feature/getData",
        data     : {id:id},
        dataType : "json",
        error    : function (xhr, status, error) {
            alert("An error occurred");
        },
        success  : function(data) {

            $('[name=id]').val(id);
            $('[name=icon]').val(data.icon);
            $('[name=name]').val(data.name);
            $('[name=desc]').val(data.desc);
            $('#kt_modal_feature').modal('show');
        },
    });
}

function save() {

	var btnSubmit = document.querySelector('[data-kt-feature-modal-action="submit"]');

    $('.fv-row .invalid-feedback').remove();

	btnSubmit.setAttribute("data-kt-indicator", "on");
	btnSubmit.disabled = !0;

	$.ajax({
        type : "POST",
        url : baseUrl + '/backend/feature/' + save_method,
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
                $('.fv-row input[name=icon]').after(data.icon);
                $('.fv-row textarea[name=desc]').after(data.desc);
            }
            else
            {
                $('#kt_modal_feature').modal('hide');

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
