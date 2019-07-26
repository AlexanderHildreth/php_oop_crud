  </div>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>

  <script>
$(document).on('click', '.delete-object', function(){
	var id = $(this).attr('data-delete-id');

	bootbox.confirm({
		message: "<h4>Are you sure?</h4>",
		buttons: {
			confirm: {
				label: '<span class="glyphicon glyphicon-ok"></span> Yes',
				className: 'btn-danger'
			},
			cancel: {
				label: '<span class="glyphicon glyphicon-remove"></span> No',
				className: 'btn-primary'
			}
		}, callback: function (result) {
			if(result == true){
				$.post('delete_blog.php', {
					object_id: id
				}, function(data){
					location.reload();
				}).fail(function() {
					alert('Unable to delete.');
				});
			}
		}
	});

	return false;
});
</script>
</body>
</html>