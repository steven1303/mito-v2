<script type="text/javascript">
    
    $("#qty").inputmask('currency', {rightAlign: true});    
    $("#po_stock_ppn").inputmask('currency', {rightAlign: true, prefix: "Rp "});
    $("#price").inputmask('currency', {rightAlign: true, prefix: "Rp "});
    $("#disc").inputmask('currency', {rightAlign: true, prefix: "Rp "});

    $('#ReceiptStockForm').validator().on('submit', function (e) {
        if (!e.isDefaultPrevented()){
            url = "{{route('rec.stock.update', $rec->id) }}";
            $.ajax({
                url : url,
                type : "PATCH",
                data : $('#ReceiptStockForm').serialize(),
                beforeSend:function(){
                    $(document).find('span.error-text').text('');
                    $('#btnSaveUpdate').attr('disabled',true);
                },
                success : function(data) {              
                    if(data.stat == 'Success'){
                        $('#btnSaveUpdate').attr('disabled',false);
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
                    $('#btnSaveUpdate').attr('disabled',false);
                }
            });
            return false;
        }
    });

    var save_method;
    save_method = 'add';
    var table1 = $('#recStockDetailTable')
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
        "ajax": "{{route('rec.stock.record.detail', ['id' => $rec->id]) }}",
        "columns": [
            {data: 'DT_RowIndex', name: 'DT_RowIndex' },
            {data: 'stock_master.stock_no', name: 'stock_master.stock_no'},
            {data: 'receive', name: 'receive'},
            {data: 'price', name: 'price'},
            {data: 'disc', name: 'disc'},
            {data: 'stock_master.satuan', name: 'stock_master.satuan'},
            {data: 'action', name:'action', orderable: false, searchable: false}
        ]
    });

    var table2 = $('#poStockDetailTable')
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
        "ajax": "{{route('po.stock.record.detail', ['id' => $rec->po_stock_id, 'status' => 'RecStock']) }}",
        "columns": [
            {data: 'DT_RowIndex', name: 'DT_RowIndex' },
            {data: 'stock_master.stock_no', name: 'stock_master.stock_no'},
            {data: 'qty', name: 'qty'},
            {data: 'rec_qty', name: 'rec_qty'},
            {data: 'stock_master.satuan', name: 'stock_master.satuan'},
            {data: 'action', name:'action', orderable: false, searchable: false}
        ]
    });

    @canany(['po.stock.store', 'po.stock.update'], Auth::user())

    function addItem(id) {
        save_method = 'add';
        $.ajax({
        url: "{{ url('po_stock/detail') }}" + '/' + id,
        type: "GET",
        dataType: "JSON",
        success: function(data) {
            $('#modal-input-item').modal('show');
            $('#button_modal').text('Save');
            $('#formTitle').text('Add Item');
            $('#button_modal').attr('disabled',false);
            $('#stock_master').val(data.stock_master.stock_no);
            $('#stock_master_id').val(data.stock_master_id);
            $('#spbd_detail_id').val(data.id);
            $('#spbd_qty').val(data.qty);
            $('#satuan').val(data.stock_master.satuan);
            $('#spbd_ket').val(data.keterangan);
        },
        error : function() {
            toastr.error('Error', 'Nothing Data');
        }
        });
    }

    $('#modal-input-item').on('hidden.bs.modal', function (e) {
        cancel();
    })

    $('#recStockDetailForm').validator().on('submit', function (e) {
        var id = $('#id').val();
        if (!e.isDefaultPrevented()){
            if (save_method == 'add')
            {
                url = "{{route('po.stock.store.detail', $rec->id) }}";
                $('input[name=_method]').val('POST');
            } else {
                url = "{{ url('po_stock/detail') . '/' }}" + id;
                $('input[name=_method]').val('PATCH');
            }
            $.ajax({
                url : url,
                type : "POST",
                data : $('#recStockDetailForm').serialize(),
                beforeSend:function(){
                    $(document).find('span.error-text').text('');
                    $('#btnSave').attr('disabled',true);
                },
                success : function(data) {
                    table1.ajax.reload();
                    table2.ajax.reload();                 
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
    function cancel(){
        save_method = 'add';
        $('#id').val('');
        $('#poStockDetailForm')[0].reset();
        $('#btnSave').attr('disabled',false);
        $('#stock_master').val(null).trigger('change');
        $('input[name=_method]').val('POST');
        $('#button_modal').text('Save changes');
    }
    @endcanany

    @can('po.stock.print', Auth::user())
    function print_spbd(id){
        window.open("{{ url('po_stock/print') }}" + '/' + id,"_blank");
    }
    @endcan

    @can('po.stock.update', Auth::user())
    function editForm(id) {
        save_method = 'edit';
        $('input[name=_method]').val('PATCH');
        $.ajax({
        url: "{{ url('po_stock/detail') }}" + '/' + id,
        type: "GET",
        dataType: "JSON",
        success: function(data) {
            $('#modal-input-item').modal('show');
            $('#button_modal').text('Update');
            $('#modal_title').text('Edit Item');
            $('#button_modal').attr('disabled',false);
            $('#id').val(data.id);
            $('#stock_master').val(data.stock_master.name);
            $('#stock_master_id').val(data.stock_master.id);
            $('#spbd_qty').val(data.spbd_detail.qty);
            $('#spbd_detail_id').val(data.spbd_detail.id);
            $('#satuan').val(data.stock_master.satuan);
            $('#spbd_ket').val(data.spbd_detail.keterangan);
            $('#price').val(data.price);
            $('#disc').val(data.disc);
            $('#keterangan').val(data.keterangan);
        },
        error : function() {
            error('Error', 'Nothing Data');
        }
        });
    }
    @endcan

    @can('spbd.delete', Auth::user())
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
                    url : "{{ url('po_stock/detail') }}" + '/' + id,
                    type : "POST",
                    data : {'_method' : 'DELETE', '_token' : csrf_token},
                    success : function(data) {
                        table1.ajax.reload();
                        table2.ajax.reload();
                        swal({
                            type: 'success',
                            title: 'Deleted',
                            text: 'Poof! Your record has been deleted!',
                        });
                    },
                    error : function (data) {
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

    @can('po.stock.request', Auth::user())
    function request_po_stock() {
        $.ajax({
        url: "{{route('po.stock.request', $rec->id) }}",
        type: "GET",
        dataType: "JSON",
        success: function(data) {
            if(data.stat == 'Success')
            {
                toastr.success(data.stat, data.message);
                print_spbd( "{{ $rec->id }}" );
                ajaxLoad("{{ route('po.stock.index') }}");
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
</script>