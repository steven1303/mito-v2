
<script type="text/javascript">
    
    $("#in_qty").inputmask('currency', {rightAlign: true});
    $("#out_qty").inputmask('currency', {rightAlign: true});
    $("#harga_modal").inputmask('currency', {rightAlign: true, prefix: "Rp "});
    $("#harga_jual").inputmask('currency', {rightAlign: true, prefix: "Rp "});

    var save_method;
    save_method = 'add';
    var table = $('#transferBranchTable')
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
        "ajax": "{{route('adj.record.detail', ['id' => $transferBranch->id]) }}",
        "columns": [
            {data: 'DT_RowIndex', name: 'DT_RowIndex' },
            {data: 'stock_master.stock_no', name: 'stock_master.stock_no'},
            {data: 'in_qty', name: 'in_qty'},
            {data: 'out_qty', name: 'out_qty'},
            {data: 'harga_modal', name: 'out_qty'},
            {data: 'harga_jual', name: 'out_qty'},
            {data: 'stock_master.satuan', name: 'stock_master.satuan'},
            {data: 'action', name:'action', orderable: false, searchable: false}
        ]
    });

    @canany(['adjustment.store', 'adjustment.update'], Auth::user())
    $('#stock_master').select2({
        placeholder: "Select and Search",
        ajax:{
            url:"{{route('stock_master.search') }}",
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

    $('#stock_master').on('select2:select', function (e) {
        var data = e.params.data;
        $('#satuan').val(data.satuan);
        $('#harga_jual').val(data.harga_jual);
        $('#harga_modal').val(data.harga_modal);
    });

    $('#modal-input-item').on('hidden.bs.modal', function (e) {
        cancel();
    })

    $('#AdjDetailForm').validator().on('submit', function (e) {
        var id = $('#id').val();
        if (!e.isDefaultPrevented()){
            if (save_method == 'add')
            {
                // url = "{{route('adj.store.detail', $transferBranch->id) }}";
                $('input[name=_method]').val('POST');
            } else {
                url = "{{ url('adj/detail') . '/' }}" + id;
                $('input[name=_method]').val('PATCH');
            }
            $.ajax({
                url : url,
                type : "POST",
                data : $('#AdjDetailForm').serialize(),
                beforeSend:function(){
                    $(document).find('span.error-text').text('');
                    $('#btnSave').attr('disabled',true);
                },
                success : function(data) {
                    table.ajax.reload();                    
                    if(data.stat == 'Success'){
                        cancel();
                        toastr.success(data.stat, data.message);
                        $('#modal-input-item').modal('hide')
                    }
                    if(data.stat == 'Error'){
                        toastr.error(data.stat, data.message);
                    }
                    if(data.stat == 'Warning'){
                        toastr.error(data.stat, data.message);
                    }
                },
                error : function(){
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
    function cancel(){
        save_method = 'add';
        $('#id').val('');
        $('#AdjDetailForm')[0].reset();
        $('#btnSave').attr('disabled',false);
        $('#stock_master').val(null).trigger('change');
        $('input[name=_method]').val('POST');
        $('#button_modal').text('Save changes');
    }
    @endcanany

    @can('adjustment.update', Auth::user())
    function request_adj() {
        $.ajax({
        // url: "{{route('adj.request', $transferBranch->id) }}",
        type: "GET",
        dataType: "JSON",
        success: function(data) {
            if(data.stat == 'Success')
            {
                toastr.success(data.stat, data.message);
                // print_adj( "{{ $transferBranch->id }}" );
                ajaxLoad("{{ route('adj.index') }}");
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
    @can('adjustment.print', Auth::user())
    function print_adj(id){
        window.open("{{ url('adj/print') }}" + '/' + id,"_blank");
    }
    @endcan

    @can('adjustment.update', Auth::user())
    function editForm(id) {
        save_method = 'edit';
        $('input[name=_method]').val('PATCH');
        $.ajax({
        url: "{{ url('adj/detail') }}" + '/' + id,
        type: "GET",
        dataType: "JSON",
        success: function(data) {
            $('#modal-input-item').modal('show');
            $('#button_modal').text('Update');
            $('#modal_title').text('Edit Item');
            $('#button_modal').attr('disabled',false);
            $('#id').val(data.id);
            var newOption = new Option(data.stock_master.stock_no, data.stock_master_id, true, true);
            $('#stock_master').append(newOption).trigger('change');
            $('#in_qty').val(data.in_qty);
            $('#out_qty').val(data.out_qty);
            $('#harga_modal').val(data.harga_modal);
            $('#harga_jual').val(data.harga_jual);
            $('#satuan').val(data.stock_master.satuan);
            $('#keterangan').val(data.keterangan);
        },
        error : function() {
            error('Error', 'Nothing Data');
        }
        });
    }
    @endcan

    @can('adjustment.delete', Auth::user())
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
                    url : "{{ url('adj/detail') }}" + '/' + id,
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