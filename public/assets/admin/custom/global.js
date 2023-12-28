"use strict";

function reloadTable() {
    tableData.ajax.reload(null,false);
}

function remove(id, url = '') {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((res) => {

        if(res.isConfirmed) {
            $.ajax({
                url : url,
                type: "POST",
                data: {id: id},
                dataType: "JSON",
                success: function(data) {
                    if(data.error == false) {
                        Swal.fire({
                            title   : 'Deleted!',
                            text    : 'Your file has been deleted.',
                            icon    : 'success'
                        });

                        reloadTable();
                    } else {
                        Swal.fire({
                            title   : 'Sorry!',
                            text    : 'Error deleting data',
                            icon    : 'error'
                        });
                    }
                    
                }, error: function (jqXHR, textStatus, errorThrown) {                  
                    Swal.fire({
                        title   : 'Sorry!',
                        text    : 'Error deleting data',
                        icon    : 'error'
                    });
                }
            });
        } else {
            Swal.fire("", "Delete is canceled", "info");
        }
    });
}

function publish(id, param, url = '')
{    
    $.ajax({
        url : url,
        type: "POST",
        data: {id:id, param:param},
        dataType: "JSON",
        success: function(data) {
            if(data.error == false) {
                Swal.fire({
                    title   : 'Success!',
                    text    : data.message,
                    icon    : 'success'
                });
                
                reloadTable();
            } else {
                Swal.fire({
                    title   : 'Failed!',
                    text    : data.message,
                    icon    : 'error'
                });
            }
            
        }, error: function (jqXHR, textStatus, errorThrown) {                  
            Swal.fire({
                title   : 'Failed!',
                text    : data.message,
                icon    : 'error'
            });
        }
    });
}

KTUtil.onDOMContentLoaded(function () {
    
});
