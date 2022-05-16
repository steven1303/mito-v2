<script type="text/javascript">
    var save_method;
    save_method = 'add';
    var table = $('#adminTable')
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
        "ajax": "{{route('record.admin') }}",
        "columns": [
            {data: 'DT_RowIndex', name: 'DT_RowIndex' },
            {data: 'name', name: 'name'},
            {data: 'username', name: 'username'},
            {data: 'role_name', name: 'role_name'},
            @canany(['admin.delete', 'admin.update'], Auth::user())
            {data: 'action', name:'action', orderable: false, searchable: false}
            @endcanany
        ]
    });
    function cancel(){
        save_method = 'add';
        $('#adminForm')[0].reset();
        $('#btnSave').text('Create');
        $('#btnSave').attr('disabled',false);
        $('input[name=_method]').val('POST');
    }

    @canany(['admin.store', 'admin.update'], Auth::user())
    $(function(){
	    $('#adminForm').validator().on('submit', function (e) {
		    var id = $('#id').val();
		    if (!e.isDefaultPrevented()){
			    if (save_method == 'add')
			    {
				    url = "{{route('admin.store') }}";
				    $('input[name=_method]').val('POST');
			    } else {
				    url = "{{ url('admin') . '/' }}" + id;
				    $('input[name=_method]').val('PATCH');
                }
			    $.ajax({
				    url : url,
				    type : "POST",
				    data : $('#adminForm').serialize(),
				    success : function(data) {
                        table.ajax.reload();
                        if(data.stat == 'Success'){
                            save_method = 'add';
                            $('input[name=_method]').val('POST');
                            $('#id').val('');
                            $('#adminForm')[0].reset();
                            $('#btnSave').text('Create');
                            toastr.success(data.stat, data.message);
                        }
                        if(data.stat == 'Error'){
                            toastr.error(data.stat, data.message);
                        }
                        if(data.stat == 'Warning'){
                            toastr.warning(data.stat, data.message);
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

    @can('admin.update', Auth::user())
    function editForm(id) {
        save_method = 'edit';
        $('input[name=_method]').val('PATCH');
        $.ajax({
            url: "{{ url('admin') }}" + '/' + id + "/edit",
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                $('#btnSave').text('Update');
                $('#formTitle').text('Edit Admin');
                $('#btnSave').attr('disabled',false);
                $('#id').val(data.id);
                $('#nama').val(data.name);
                $('#username').val(data.username);
                $('#email').val(data.email);
                $('#role').val(data.role_id);
            },
            error : function() {
                error('Error', 'Nothing Data');
            }
        });
    }
    @endcan

    @can('admin.delete', Auth::user())
    function deleteData(id, title){
        Swal.fire({
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
                    url : "{{ url('admin') }}" + '/' + id,
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
                Swal.fire({
                    type: 'success',
                    title: 'Canceled',
                    text: 'Your record is still safe!',
                });
            }
        });
    }
    @endcan
</script>