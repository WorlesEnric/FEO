$(document).ready(function() {

    var lrfix = $('#left-right-fixed').DataTable({
        scrollY: "300px",
        scrollX: true,
        scrollCollapse: true,
        paging: false,
        fixedColumns: {
            leftColumns: 0,
            rightColumns: 5
        }
    });

    var rfix = $('#right-fixed').DataTable({
        scrollY: "300px",
        scrollX: true,
        scrollCollapse: true,
        paging: false,
        fixedColumns: {
            leftColumns: 0,
            rightColumns: 5
        }
    });
    
    var mfix = $('#multi-fixed').DataTable( {
        scrollY: "300px",
        scrollX: true,
        scrollCollapse: true,
        paging: false,
        fixedColumns:{
            leftColumns: 0,
            rightColumns: 5
        
        }
    } );
    
});
