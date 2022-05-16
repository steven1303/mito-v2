<script type="text/javascript">
    $("#ppn").inputmask("decimal");
    var save_method;
    save_method = 'add';

    var table = $('#taxhTable')
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
        "ajax": "{{route('tax.record') }}",
        "columns": [
            {data: 'DT_RowIndex', name: 'DT_RowIndex' },
            {data: 'name', name: 'name'},
            {data: 'ppn', name: 'ppn'},
            {data: 'tax_percent', name: 'tax_percent'},
            {data: 'action', name:'action', orderable: false, searchable: false}
        ]
    });

    @canany(['tax.store', 'tax.update'], Auth::user())
    $(function(){    
	    $('#taxForm').validator().on('submit', function (e) {
		    var id = $('#id').val();
		    if (!e.isDefaultPrevented()){
			    if (save_method == 'add')
			    {
				    url = "{{route('tax.store') }}";
				    $('input[name=_method]').val('POST');
			    } else {
				    url = "{{ url('tax') . '/' }}" + id;
				    $('input[name=_method]').val('PATCH');
                }
			    $.ajax({
				    url : url,
				    type : "POST",
                    dataType: "JSON",
                    data : $('#taxForm').serialize(),
                    beforeSend: function(){
                        $('#btnSave').attr('disabled',true);
                        $(document).find('span.error-text').text('');
                    },				                     
				    success : function(data) {
                        table.ajax.reload();
                        if(data.stat == 'Success'){
                            cancel();
                            toastr.success(data.stat, data.message);
                        }
                        if(data.stat == 'Error'){
                            toastr.error(data.stat, data.message);
                        }
                        if(data.stat == 'Warning'){
                            toastr.error(data.stat, data.message);
                        }
				    },
				    error : function(data){
                        if(data.status == 422){
                            Object.keys(data.responseJSON.errors).forEach(function(key) {
                                console.log('Key : ' + key + ', Value : ' + data.responseJSON.errors[key])
                                $('span.'+key+'_error').text(data.responseJSON.errors[key]);
                            })
                        }else{
                            toastr.error('Error', 'Oops! Something Error! Try to reload your page first...');                       
                        }					    
                        $('#btnSave').attr('disabled',false);
				    }
			    });
			    return false;
		    }
	    });
       
    });    

    function cancel(){
        save_method = 'add';
        $('#btnSave').text('Create New');
        $('input[name=_method]').val('POST');
        $('#taxForm')[0].reset();
        $('#id').val('');
        $('#formTitle').text('Add New Tax');
        $('#btnSave').attr('disabled',false);
    }
    @endcanany

    @can('tax.update', Auth::user())
    function editForm(id) {
        save_method = 'edit';
        $('input[name=_method]').val('PATCH');
        $.ajax({
        url: "{{ url('tax') }}" + '/' + id + "/edit",
        type: "GET",
        dataType: "JSON",
        success: function(data) {
            $('#btnSave').text('Update');
            $('#formTitle').text('Edit Tax');
            $('#btnSave').attr('disabled',false);
            $('#id').val(data.id);
            $('#name').val(data.name);
            $('#ppn').val(data.ppn);
            if(data.stat == 'Error'){
                toastr.error(data.stat, data.message);
            }
        },
        error : function() {
            toastr.error('Error', 'Nothing Data');
        }
        });
    }
    @endcan

    @can('tax.delete', Auth::user())
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
                    url : "{{ url('tax') }}" + '/' + id,
                    type : "POST",
                    data : {'_method' : 'DELETE', '_token' : csrf_token},
                    success : function(data) {
                        table.ajax.reload();
                        swal.fire({
                            type: data.stat,
                            title: 'Deleted',
                            text: data.message,
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