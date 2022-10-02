<script type="text/javascript">
    var table = $('#stockMovementTable')
    .DataTable({
        'paging'      	: true,
        'lengthChange'	: true,
        'searching'   	: true,
        'ordering'    	: true,
        'info'        	: true,
        'autoWidth'   	: false,
        "processing"	: true,
        "serverSide"	: true,
        responsive      : true,
        "ajax": "{{route('stock_master.movement.record', $stock_detail->id ) }}",
        "columns": [
            {data: 'DT_RowIndex', name: 'DT_RowIndex' },
            {data: 'type', name: 'type'},
            {data: 'doc_no', name: 'doc_no'},
            {data: 'move_date', name: 'move_date'},
            {data: 'order_qty', name: 'order_qty'},
            {data: 'sell_qty', name: 'sell_qty'},
            {data: 'in_qty', name: 'in_qty'},
            {data: 'out_qty', name: 'out_qty'},
            {data: 'status_desc', name: 'status_desc'},
        ]
    });
</script>