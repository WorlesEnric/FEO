$(document).ready(function() {
    $('#fixed-header').DataTable({
        fixedHeader: false //To enable fixed change value to true
    });
    var hfoot = $('#header-footer-fixed').DataTable({
        fixedHeader: {
            header: false,//To enable fixed change value to true
            footer: false
        }
    });
    var colheader = $('#col-header').DataTable({
        fixedHeader: false,//To enable fixed change value to true
        colReorder: false
    });
});
