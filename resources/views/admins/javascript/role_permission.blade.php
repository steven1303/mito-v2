<script type="text/javascript">
	$('#formPermission_role').validator().on('submit', function (e) {
		var id = $('#id').val();
		if (!e.isDefaultPrevented()){
			url = "{{ route('update.rolePermission',$role->id) }}";
			$.ajax({
				url : url,
				type : "POST",
				data : $('#formPermission_role').serialize(),
				success : function(data) {
					if(data.stat == 'Success'){
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

	function selectAll(accessMenu){
		const check = document.querySelectorAll("."+accessMenu);
		check.forEach(function(checkbox){
			checkbox.checked = true;
		})
	}

	function deselectAll(accessMenu){
		const check = document.querySelectorAll("."+accessMenu);
		check.forEach(function(checkbox){
			checkbox.checked = false;
		})
	}
	
</script>
