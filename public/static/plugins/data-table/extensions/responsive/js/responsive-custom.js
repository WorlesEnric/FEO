$(document).ready(function() {
    $('#responsive-config-option').DataTable({
        responsive: true
    });
    var new_constructor = $('#new-constructor').DataTable();

    new $.fn.dataTable.Responsive(new_constructor);

    $('#show-hide-responsive').DataTable({
        responsive: {
            details: {
                display: $.fn.dataTable.Responsive.display.childRowImmediate,
                type: ''
            }
        }
    });
});
