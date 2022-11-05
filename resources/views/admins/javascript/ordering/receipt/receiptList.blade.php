<script type="text/javascript">
    var save_method;
    save_method = 'add';
    var table = $('#poStockTable')
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
        "ajax": "{{route('rec.stock.record') }}",
        "columns": [
            {data: 'DT_RowIndex', name: 'DT_RowIndex' },
            {data: 'rec_no', name: 'rec_no'},
            {data: 'po_no', name: 'po_no'},
            {data: 'approved', name: 'approved'},
            {data: 'status', name: 'status'},
            {data: 'action', name:'action', orderable: false, searchable: false}
        ]
    });

    @if($access['store'])
    $(function(){
        $('#po_stock').select2({
            placeholder: "Select and Search",
            ajax:{
                url:"{{route('po.stock.search') }}",
                dataType: 'json',
                data: function (params) {
                    return {
                        q: $.trim(params.term)
                    }
                },
                processResults: function (data) {
                    return {
                        results: data
                    };
                },
                cache: true
            },
        })

        $('#po_stock').on('select2:select', function (e) {
            var data = e.params.data;
        });

        $("input").focus(function(){
            $("#po_stock").trigger('select2:open');
        });

	    $('#receiptForm').validator().on('submit', function (e) {
		    var id = $('#id').val();
		    if (!e.isDefaultPrevented()){
                url = "{{route('rec.stock.store') }}";
				$("#ReceiptkMethod").val('POST');
			    $.ajax({
				    url : url,
				    type : "POST",
				    data : $('#receiptForm').serialize(),
				    success : function(data) {
                        if(data.stat == 'Success'){
                            toastr.success(data.stat, data.message);
                            if (data.process == 'add')
                            {
                                $('#po_stock').val(null).trigger('change');
                                ajaxLoad("{{ url('rec_stock/form') }}" + '/' + data.id);
                            }
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
				    }
			    });
			    return false;
		    }
	    });
    });
    @endif

    @if($access['print'])
    function print_transfer_branch(id){
        window.open("{{ url('rec_stock_print') }}" + '/' + id,"_blank");
    }
    @endif

    @if($access['approve'])
    function approve(id) {
        $.ajax({
        url: "{{ url('rec_stock') }}" + '/' + id + "/approve",
        type: "GET",
        dataType: "JSON",
        success: function(data) {
            table.ajax.reload();
            toastr.success(data.stat, data.message);
        },
        error : function() {
            toastr.error('Error', 'Nothing Data');
        }
        });
    }
    @endif
    @if($access['delete'])
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
                    url : "{{ url('rec_stock') }}" + '/' + id,
                    type : "POST",
                    data : {'_method' : 'DELETE', '_token' : csrf_token},
                    success : function(data) {
                        table.ajax.reload();
                        if(data.stat == "Success"){
                            swal.fire({
                                type: 'success',
                                title: 'Deleted',
                                text: data.message,
                            });
                        }else{
                            swal.fire({
                                type: 'error',
                                title: data.stat,
                                text: data.message,
                            });
                        }                      
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
    @endif
</script>