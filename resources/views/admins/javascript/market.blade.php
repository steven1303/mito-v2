<script type="text/javascript">
var save_method;
save_method = 'add';
var table = $('#marketTable')
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
    "ajax": "{{route('record.market') }}",
    "columns": [
        {data: 'DT_RowIndex', name: 'DT_RowIndex' },
        {data: 'market_name', name: 'market_name'},
        {data: 'market_time_1', name: 'market_time_1'},
        {data: 'market_time_2', name: 'market_time_2'},
        {data: 'market_time_3', name: 'market_time_3'},
        {data: 'status', name: 'status'},
        @canany(['market.delete', 'market.update'], Auth::user())
        {data: 'action', name:'action', orderable: false, searchable: false}
        @endcanany
    ]
});
$(function () {
    $('#timepicker1').datetimepicker({
        format: 'LT',
        // allowInputToggle: true
    });
    $('#timepicker2').datetimepicker({
        format: 'LT',
        // allowInputToggle: true
    });
    $('#timepicker3').datetimepicker({
        format: 'LT',
        // allowInputToggle: true
    });

    $('#marketForm').validator().on('submit', function (e) {
        var id = $('#id').val();
        if (!e.isDefaultPrevented()){
            if (save_method == 'add')
            {
                url = "{{route('market.store') }}";
                $('input[name=_method]').val('POST');
            } else {
                url = "{{ url('market') . '/' }}" + id;
                $('input[name=_method]').val('PATCH');
            }
            $.ajax({
                url : url,
                type : "POST",
                data : $('#marketForm').serialize(),
                success : function(data) {
                    table.ajax.reload();
                    if(data.stat == 'Success'){
                        save_method = 'add';
                        $('input[name=_method]').val('POST');
                        $('#id').val('');
                        $('#marketForm')[0].reset();
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
})

function cancel(){
    save_method = 'add';
    $('#marketForm')[0].reset();
    $('#btnSave').text('Create');
    $('#btnSave').attr('disabled',false);
    $('input[name=_method]').val('POST');
}

@can('market.update', Auth::user())
function editForm(id) {
    save_method = 'edit';
    $('input[name=_method]').val('PATCH');
    $.ajax({
        url: "{{ url('market') }}" + '/' + id + "/edit",
        type: "GET",
        dataType: "JSON",
        success: function(data) {
            $('#btnSave').text('Update');
            $('#formTitle').text('Edit Market');
            $('#btnSave').attr('disabled',false);
            $('#id').val(data.id);
            $('#nama').val(data.market_name);
            $('#timepicker1').datetimepicker( 'date', data.market_time_1);
            $('#timepicker2').datetimepicker( 'date', data.market_time_2);
            $('#timepicker3').datetimepicker( 'date', data.market_time_3);
            // $('#role').val(data.id_role);
        },
        error : function() {
            error('Error', 'Nothing Data');
        }
    });
}
@endcan

@can('market.delete', Auth::user())
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
                url : "{{ url('market') }}" + '/' + id,
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