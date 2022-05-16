<script type="text/javascript">
    $(function(){
	    $('#profileForm').validator().on('submit', function (e) {
		    var id = $('#id').val();
		    if (!e.isDefaultPrevented()){
                $('input[name=_method]').val('PATCH');
                url = "{{route('profile.update', Auth::user()->id ) }}";
			    $.ajax({
				    url : url,
				    type : "POST",
				    data : $('#profileForm').serialize(),
				    success : function(data) {
                        if(data.stat == 'Success'){
                            save_method = 'add';
                            $('input[name=_method]').val('POST');
                            $('#btnSave').text('Submit');
                            toastr.success(data.stat, data.message);
                        }
                        if(data.stat == 'Error'){
                            toastr.error(data.stat, data.message);
                        }
                        if(data.stat == 'Warning'){
                            toastr.error(data.stat, data.message);
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
</script>