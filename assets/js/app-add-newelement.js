$( document ).ready(function() {
	$("#results").hide();
	$("#form-add-website").validate({
		rules: {
			nom: "required",
			url: "required",
	    },
		messages: {
			nom: "Veuillez saisir le nom de votre site web",
			url: "Veuillez saisir l'URL' de votre site web",
	    }
	});
	$("#form-add-website").submit(function(e){
		$.ajax({
			type: "POST",
			url: $(this).attr('action'),
			data:$(this).serialize(),
			success: function(msg){
				console.log(msg);
				$("#form-add-website").fadeOut('slow');
				$('#results').fadeIn('fast');
				setTimeout(function() {
				 $('#results').fadeOut('slow');
				 $("#form-add-website").find("input[type=text], textarea").val("");
				 $("#form-add-website").fadeIn('slow');
				}, 3000 );
			},
			error: function(msg){
				console.log(msg);
			}
		});
		e.preventDefault();
	});
	$("#form-add-category").submit(function(e){
		$.ajax({
			type: "POST",
			url: $(this).attr('action'),
			data:$(this).serialize(),
			success: function(msg){
			},
			error: function(msg){
				console.log(msg);
			}
		});
		e.preventDefault();
	});
	$("#form-add-language").submit(function(e){
		$.ajax({
			type: "POST",
			url: $(this).attr('action'),
			data:$(this).serialize(),
			success: function(msg){
			},
			error: function(msg){
				console.log(msg);
			}
		});
		e.preventDefault();
	});
});