$(function () {
    "use strict";
    var table = $('#division_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: url,
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex',orderable : false, searchable : false},
            {data: 'name', name: 'name'},
            {data : 'bn_name', name: 'bn_name'},
            // {data : 'country', name: 'allcountry.nicename'}
        ],
        dom : 'lBfrtip',
        buttons : [
            'csv','excel','pdf','print'
        ],
        order : [[0,'asc']]
    });

});