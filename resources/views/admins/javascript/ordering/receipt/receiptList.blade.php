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
            {data: 'approve', name: 'approve'},
            {data: 'status', name: 'status'},
            {data: 'action', name:'action', orderable: false, searchable: false}
        ]
    });

    @can('po.stock.store', Auth::user())
    $(function(){
        $('#poStock').select2({
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

        $('#spbd').on('select2:select', function (e) {
            var data = e.params.data;
        });

        $("input").focus(function(){
            $("#spbd").trigger('select2:open');
        });

	    $('#poStockForm').validator().on('submit', function (e) {
		    var id = $('#id').val();
		    if (!e.isDefaultPrevented()){
                url = "{{route('po.stock.store') }}";
				$('input[name=_method]').val('POST');
			    $.ajax({
				    url : url,
				    type : "POST",
				    data : $('#poStockForm').serialize(),
				    success : function(data) {
                        if(data.stat == 'Success'){
                            toastr.success(data.stat, data.message);
                            if (data.process == 'add')
                            {
                                $('#spbd').val(null).trigger('change');
                                ajaxLoad("{{ url('po_stock/form') }}" + '/' + data.id);
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
    @endcan

    @can('po.stock.print', Auth::user())
    function print_transfer_branch(id){
        window.open("{{ url('po_stock_print') }}" + '/' + id,"_blank");
    }
    @endcan

    @can('po.stock.verify1', Auth::user())
    function verify1(id) {
        $.ajax({
        url: "{{ url('po_stock') }}" + '/' + id + "/verify1",
        type: "GET",
        dataType: "JSON",
        success: function(data) {
            if(data.stat == 'Success')
            {                
                table.ajax.reload();
                toastr.success(data.stat, data.message);
                print_spbd(id);
            }
            if(data.stat == 'Error')
            {
                toastr.error(data.stat, data.message);
            }
        },
        error : function() {
            toastr.error('Error', 'Nothing Data');
        }
        });
    }
    @endcan

    @can('po.stock.verify2', Auth::user())
    function verify2(id) {
        $.ajax({
        url: "{{ url('po_stock') }}" + '/' + id + "/verify2",
        type: "GET",
        dataType: "JSON",
        success: function(data) {
            if(data.stat == 'Success')
            {                
                table.ajax.reload();
                toastr.success(data.stat, data.message);
                print_spbd(id);
            }
            if(data.stat == 'Error')
            {
                toastr.error(data.stat, data.message);
            }
        },
        error : function() {
            toastr.error('Error', 'Nothing Data');
        }
        });
    }
    @endcan

    @can('po.stock.approve', Auth::user())
    function approve(id) {
        $.ajax({
        url: "{{ url('po_stock') }}" + '/' + id + "/approve",
        type: "GET",
        dataType: "JSON",
        success: function(data) {
            table.ajax.reload();
            toastr.success(data.stat, data.message);
        },
        error : function() {
            error('Error', 'Nothing Data');
        }
        });
    }
    @endcan
    @can('po.stock.delete', Auth::user())
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
                    url : "{{ url('po_stock') }}" + '/' + id,
                    type : "POST",
                    data : {'_method' : 'DELETE', '_token' : csrf_token},
                    success : function(data) {
                        table.ajax.reload();
                        swal({
                            type: 'success',
                            title: 'Deleted',
                            text: 'Poof! Your record has been deleted!',
                        });
                    },
                    error : function () {
                        swal( {
                            type: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong!'
                        });
                    }
                });
            } else {
                swal({
                    type: 'success',
                    title: 'Canceled',
                    text: 'Your record is still safe!',
                });
            }
        });
    }
    @endcan
</script>