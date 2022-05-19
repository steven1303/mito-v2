<script type="text/javascript">
    $('#bod').datetimepicker({format: 'DD/MM/YYYY'});
    // $('#bod_val').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });
    var save_method;
    save_method = 'add';

    var table = $('#customerTable')
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
        "ajax": "{{route('customer.record') }}",
        "columns": [
            {data: 'DT_RowIndex', name: 'DT_RowIndex' },
            {data: 'name', name: 'name'},
            {data: 'city', name: 'city'},
            {data: 'npwp', name: 'npwp'},
            {data: 'phone', name: 'phone'},
            {data: 'action', name:'action', orderable: false, searchable: false}
        ]
    });

    @canany(['customer.store', 'customer.update'], Auth::user())
    $(function(){    
	    $('#customerForm').validator().on('submit', function (e) {
		    var id = $('#id').val();
		    if (!e.isDefaultPrevented()){
			    if (save_method == 'add')
			    {
				    url = "{{route('customer.store') }}";
				    $('input[name=_method]').val('POST');
			    } else {
				    url = "{{ url('customer') . '/' }}" + id;
				    $('input[name=_method]').val('PATCH');
                }
			    $.ajax({
				    url : url,
				    type : "POST",
                    dataType: "JSON",
                    data : $('#customerForm').serialize(),
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
        $('#customerForm')[0].reset();
        $('#id').val('');
        $('#formTitle').text('Add New Customer');
        $('#btnSave').attr('disabled',false);
    }
    @endcanany

    @can('customer.update', Auth::user())
    function editForm(id) {
        save_method = 'edit';
        $('input[name=_method]').val('PATCH');
        $.ajax({
        url: "{{ url('customer') }}" + '/' + id + "/edit",
        type: "GET",
        dataType: "JSON",
        success: function(data) {
            $('#btnSave').text('Update');
            $('#formTitle').text('Edit Customer');
            $('#btnSave').attr('disabled',false);
            $('#id').val(data.id);
            $('#name').val(data.name);
            $('#address1').val(data.address1);
            $('#address2').val(data.address2);
            $('#email').val(data.email);
            $('#city').val(data.city);
            $('#pic').val(data.pic);
            $('#telp').val(data.telp);
            $('#phone').val(data.phone);
            $('#npwp').val(data.npwp);
            $('#tax').val(data.tax_id);
            $('#ktp').val(data.ktp);
            $('#bod').datetimepicker('date',data.bod);
            // $('#bod').val(data.bod);
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

    @can('customer.delete', Auth::user())
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
                    url : "{{ url('customer') }}" + '/' + id,
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

