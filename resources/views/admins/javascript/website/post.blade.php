<script type="text/javascript">
    var table = $('#postTable')
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
        "ajax": "{{route('record.website.post') }}",
        "columns": [
            {data: 'DT_RowIndex', name: 'DT_RowIndex' },
            {data: 'title', name: 'title'},
            {data: 'title', name: 'title'},
            {data: 'title', name: 'title'},
            {data: 'action', name:'action', orderable: false, searchable: false}
        ]
    });

    function editForm(id) {
        ajaxLoad("{{ url('post_detail') }}" + '/' + id + '/edit');
    }
</script>