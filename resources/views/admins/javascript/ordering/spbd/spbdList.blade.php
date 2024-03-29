<script type="text/javascript">
    var save_method;
    save_method = 'add';
    var table = $('#spbdTable')
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
        "ajax": "{{route('spbd.record') }}",
        "columns": [
            {data: 'DT_RowIndex', name: 'DT_RowIndex' },
            {data: 'spbd_no', name: 'spbd_no'},
            {data: 'approve', name: 'approve'},
            {data: 'status', name: 'status'},
            {data: 'action', name:'action', orderable: false, searchable: false}
        ]
    });

    @if($access['store'])
    $(function(){
	    $('#spbdForm').validator().on('submit', function (e) {
		    var id = $('#id').val();
		    if (!e.isDefaultPrevented()){
                url = "{{route('spbd.store') }}";
				$('input[name=_method]').val('POST');
			    $.ajax({
				    url : url,
				    type : "POST",
				    data : $('#spbdForm').serialize(),
				    success : function(data) {
                        if(data.stat == 'Success'){
                            toastr.success(data.stat, data.message);
                            if (data.process == 'add')
                            {
                                ajaxLoad("{{ url('spbd/form') }}" + '/' + data.id);
                            }
                        }
                        if(data.stat == 'Error'){
                            toastr.error(data.stat, data.message);
                        }
                        if(data.stat == 'Warning'){
                            toastr.error(data.stat, data.message);
                        }
				    },
				    error : function(){
					    error('Error', 'Oops! Something Error! Try to reload your page first...');
				    }
			    });
			    return false;
		    }
	    });
    });
    @endif

    @if($access['print'])
    function print_transfer_branch(id){
        window.open("{{ url('transfer_branch_print') }}" + '/' + id,"_blank");
    }
    @endif

    @if($access['verify1'])
    function verify1(id) {
        $.ajax({
        url: "{{ url('spbd') }}" + '/' + id + "/verify1",
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
    @endif

    @if($access['verify2'])
    function verify2(id) {
        $.ajax({
        url: "{{ url('spbd') }}" + '/' + id + "/verify2",
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
    @endif

    @if($access['approve'])
    function approve(id) {
        save_method = 'edit';
        $.ajax({
        url: "{{ url('spbd') }}" + '/' + id + "/approve",
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
                    url : "{{ url('transfer_branch') }}" + '/' + id,
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
    @endif
</script>