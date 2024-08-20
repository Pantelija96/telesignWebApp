document.addEventListener('DOMContentLoaded', function() {
    initDataTable();

});

function initDataTable(){
    if (!$().DataTable) {
        console.warn('Warning - datatables.min.js is not loaded.');
        return;
    }

    $.extend( $.fn.dataTable.defaults, {
        autoWidth: false,
        dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
        language: {
            search: '<span class="me-3">Filter:</span> <div class="form-control-feedback form-control-feedback-end flex-fill">_INPUT_<div class="form-control-feedback-icon"><i class="ph-magnifying-glass opacity-50"></i></div></div>',
            searchPlaceholder: 'Type to filter...',
            lengthMenu: '<span class="me-3">Show:</span> _MENU_',
            paginate: { 'first': 'First', 'last': 'Last', 'next': document.dir == "rtl" ? '&larr;' : '&rarr;', 'previous': document.dir == "rtl" ? '&rarr;' : '&larr;' }
        }
    });

    if (typeof statusForSearch === 'undefined') {
        $('.datatable-html').dataTable({
            columnDefs: [{
                orderable: false,
                width: 100,
                targets: [ 5 ]
            }]
        });
    }
    else{
        $('.datatable-html').dataTable({
            columnDefs: [{
                orderable: false,
                width: 100,
                targets: [ 5 ]
            }],
            search: {
                search: statusForSearch
            }
        });
    }
}

function sureToDelete(projectId){
    if (typeof swal == 'undefined') {
        console.warn('Warning - sweet_alert.min.js is not loaded.');
        return;
    }

    const swalInit = swal.mixin({
        buttonsStyling: false,
        customClass: {
            confirmButton: 'btn btn-primary',
            cancelButton: 'btn btn-light',
            denyButton: 'btn btn-light',
            input: 'form-control'
        }
    });

    swalInit.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
        buttonsStyling: false,
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
        }
    }).then(function(result) {
        if(result.value) {
            $.ajax({
                type:'GET',
                url:'/deleteProject',
                data:{
                    projectId: projectId,
                },
                success:function(data) {
                    window.location.reload();
                },
                error: function (error){
                    console.log(error);
                    swalInit.fire(
                        'Some error happened!',
                        'error'
                    );
                }
            });
        }
        else if(result.dismiss === swal.DismissReason.cancel) {
            swalInit.fire(
                'Cancelled',
                'info'
            );
        }
    });
}
