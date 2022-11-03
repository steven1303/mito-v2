
<script type="text/javascript">
    
    $("#qty").inputmask('currency', {rightAlign: true});

    var save_method;
    save_method = 'add';
    var table = $('#spbdDetailTable')
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
        "ajax": "{{route('spbd.record.detail', ['id' => $spbd->id]) }}",
        "columns": [
            {data: 'DT_RowIndex', name: 'DT_RowIndex' },
            {data: 'stock_master.stock_no', name: 'stock_master.stock_no'},
            {data: 'qty', name: 'qty'},
            {data: 'po_qty', name: 'po_qty'},
            {data: 'stock_master.satuan', name: 'stock_master.satuan'},
            {data: 'action', name:'action', orderable: false, searchable: false}
        ]
    });

    @canany(['spbd.store', 'spbd.update'], Auth::user())
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

    $('#spbdDetailForm').validator().on('submit', function (e) {
        var id = $('#id').val();
        if (!e.isDefaultPrevented()){
            if (save_method == 'add')
            {
                url = "{{route('spbd.store.detail', $spbd->id) }}";
                $('input[name=_method]').val('POST');
            } else {
                url = "{{ url('spbd/detail') . '/' }}" + id;
                $('input[name=_method]').val('PATCH');
            }
            $.ajax({
                url : url,
                type : "POST",
                data : $('#spbdDetailForm').serialize(),
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
        $('#spbdDetailForm')[0].reset();
        $('#btnSave').attr('disabled',false);
        $('#stock_master').val(null).trigger('change');
        $('input[name=_method]').val('POST');
        $('#button_modal').text('Save changes');
    }
    @endcanany

    @can('spbd.request', Auth::user())
    function request_spbd() {
        $.ajax({
        url: "{{route('spbd.request', $spbd->id) }}",
        type: "GET",
        dataType: "JSON",
        success: function(data) {
            if(data.stat == 'Success')
            {
                toastr.success(data.stat, data.message);
                print_spbd( "{{ $spbd->id }}" );
                ajaxLoad("{{ route('spbd.index') }}");
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

    function reject_spbd(id) {
        $.ajax({
        url: "{{ route('spbd.reject', $spbd->id) }}",
        type: "GET",
        dataType: "JSON",
        success: function(data) {
            if(data.stat == 'Success')
            {                
                toastr.success(data.stat, data.message);
                ajaxLoad("{{ route('spbd.index') }}");
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

    @can('spbd.print', Auth::user())
    function print_spbd(id){
        window.open("{{ url('spbd/print') }}" + '/' + id,"_blank");
    }
    @endcan

    @can('spbd.update', Auth::user())
    function editForm(id) {
        save_method = 'edit';
        $('input[name=_method]').val('PATCH');
        $.ajax({
        url: "{{ url('spbd/detail') }}" + '/' + id,
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
            $('#qty').val(data.qty);
            $('#satuan').val(data.stock_master.satuan);
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
                    url : "{{ url('spbd/detail') }}" + '/' + id,
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