<script type="text/javascript">
    var save_method;
    save_method = 'add';
    var table = $('#permissionTable')
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
        "ajax": "{{route('record.permission') }}",
        "columns": [
            {data: 'DT_RowIndex', name: 'DT_RowIndex' },
            {data: 'name', name: 'name'},
            {data: 'for', name: 'for'},
            {data: 'stat', name: 'stat'},
            @canany(['permission.delete', 'permission.update'], Auth::user())
            {data: 'action', name:'action', orderable: false, searchable: false}
            @endcanany
        ]
    });

    @canany(['permission.store', 'permission.update'], Auth::user())
    $(function(){
	    $('#permissionForm').validator().on('submit', function (e) {
		    var id = $('#id').val();
		    if (!e.isDefaultPrevented()){
			    if (save_method == 'add')
			    {
				    url = "{{route('permission.store') }}";
				    $('input[name=_method]').val('POST');
			    } else {
				    url = "{{ url('permission') . '/' }}" + id;
				    $('input[name=_method]').val('PATCH');
                }
			    $.ajax({
				    url : url,
				    type : "POST",
				    data : $('#permissionForm').serialize(),
				    success : function(data) {
                        table.ajax.reload();
                        if(data.stat == 'Success'){
                            save_method = 'add';
                            $('input[name=_method]').val('POST');
                            $('#id').val('');
                            $('#permissionForm')[0].reset();
                            $('#btnSave').text('Create');
                            toastr.success(data.stat, data.message);
                        }
                        if(data.stat == 'Error'){
                            toastr.error(data.stat, data.message);
                        }
                        if(data.stat == 'Warning'){
                            toastr.error(data.stat, data.message);
                        }
				    },
				    error : function(){
					    toastr.error('Error', 'Oops! Something Error! Try to reload your page first...');
				    }
			    });
			    return false;
		    }
	    });
    });
    @endcanany

    function cancel(){
        save_method = 'add';
        $('#permissionForm')[0].reset();
        $('#btnSave').text('Create');
        $('#formTitle').text('Add Roles');
        $('#btnSave').attr('disabled',false);
        $('input[name=_method]').val('POST');
    }

    @can('permission.update', Auth::user())
    function editForm(id) {
        save_method = 'edit';
        $('input[name=_method]').val('PATCH');
        $.ajax({
        url: "{{ url('permission') }}" + '/' + id + "/edit",
        type: "GET",
        dataType: "JSON",
        success: function(data) {
            $('#btnSave').text('Update');
            $('#btnSave').attr('disabled',false);
            $('#id').val(data.id);
            $('#permission_name').val(data.name);
            $('#permission_for').val(data.for);
            $('#status').val(data.stat);
        },
        error : function() {
            toastr.error('Error', 'Nothing Data');
        }
        });
    }
    @endcan

    @can('permission.delete', Auth::user())
    function deleteData(id, title){
        swal.fire({
            title: 'Are you sure want to delete ' + title + ' ?',
            text: 'You won\'t be able to revert this!',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        })
        .then((willDelete) => {
            if (willDelete.value) {
                var csrf_token = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url : "{{ url('permission') }}" + '/' + id,
                    type : "POST",
                    data : {'_method' : 'DELETE', '_token' : csrf_token},
                    success : function(data) {
                        table.ajax.reload();
                        swal.fire({
                            type: 'success',
                            title: 'Deleted',
                            text: 'Poof! Your record has been deleted!',
                        });
                    },
                    error : function () {
                        swal.fire( {
                            type: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong!'
                        });
                    }
                });
            } else {
                swal.fire({
                    type: 'success',
                    title: 'Canceled',
                    text: 'Your record is still safe!',
                });
            }
        });
    }
    @endcan
</script>