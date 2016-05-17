$( document ).ready(function() {
	$("#changepassword-form").submit(function(e){
		$.ajax({
			type: "POST",
			url: $(this).attr('action'),
			data:$(this).serialize(),
			success: function(msg){
			},
			error: function(){
				alert("failure");
			}
		});
		e.preventDefault();
	});
});