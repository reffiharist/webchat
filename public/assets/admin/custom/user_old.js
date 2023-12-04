"use strict";

var tableData;
var save_method;
var baseUrl = window.location.protocol + '//' + window.location.hostname + '/webchat';

var KTAppUser = (function () {

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
                url : baseUrl + "/backend/user/dataList",
                type: "post",
            },
            columnDefs: [
                {targets: [0], orderable: false},
                {targets: [5], orderable: false, class: 'text-end'},
            ],
            
        });
    };

    function add()
    {
        save_method = 'create';

        $('.modal-title').text('Add User');
        $('.error-field').hide();
        $("#form").trigger('reset');
        $('[name=password], [name=conpassword]').attr('required', 'required');
        $('#kt_modal_user').modal('show');
    }

    function edit(id)
    {
        save_method = 'update';

        $("#form").trigger('reset');
        $('.error-field').hide();
        $('.modal-title').text('Edit User');

        $.ajax({
            type     : "POST",
            url      : baseUrl + "/backend/user/getData",
            data     : {id:id},
            dataType : "json",
            error    : function (xhr, status, error) {
                alert("An error occurred");
            },
            success  : function(data) {

                $('[name=id]').val(id);
                $('[name=name]').val(data.name);
                $('[name=level]').val(data.level);
                $('[name=email]').val(data.email);
                $('[name=password], [name=conpassword]').removeAttr('required');
                $('#kt_modal_user').modal('show');
            },
        });
    }

    function save() {
        var btnSubmit = document.querySelector('[data-kt-users-modal-action="submit"]');

        btnSubmit.setAttribute("data-kt-indicator", "on");
        btnSubmit.disabled = !0;

        $.ajax({
            type : "POST",
            url : baseUrl + '/backend/user/' + save_method,
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
                    $('#er_name').html(data.name);
                    $('#er_email').html(data.email);
                    $('#er_password').html(data.password);
                    $('#er_copassword').html(data.copassword);
                }
                else
                {
                    $('#kt_modal_user').modal('hide');

                    Swal.fire('Sukses!', 'Data berhasil '+ text_message, 'success');

                    reloadTable();
                }
            }
        });
    }

    return {
        init: function() {

            tableData();

            tableData.on('draw', function() {
                KTMenu.createInstances();
            });

            $('.table-responsive').on('show.bs.dropdown', function () {
                 $('.table-responsive').css( "overflow", "inherit" );
            });

            $('.table-responsive').on('hide.bs.dropdown', function () {
                 $('.table-responsive').css( "overflow", "auto" );
            });
        }
    }
})();

KTUtil.onDOMContentLoaded(function () {
    KTAppUser.init();
});
