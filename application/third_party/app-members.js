$( document ).ready(function() {
	$('a#delete-user').click(function(e) {
		if (confirm('Voulez vous supprimer cette enregistrement')) {
			$.ajax({
				type: "POST",
				url: $(this).attr('href'),
				success: function(msg){
					$('.member-entry-'+$(this).attr('url').split("/").pop()).remove();
				},
				error: function(){
					console.log(msg);
				}
			});
		}
		e.preventDefault();
	});
	$('#members-edit').on('show.bs.modal', function (event) {
		var id = $(event.relatedTarget).data('id');
		var idgroup = $(event.relatedTarget).data('idgroup');
		/*var idgroup = $(event.relatedTarget).attr('data-idgroup');*/
		var modal = $(this);
		$('#form-edit-user').attr('action', window.location.href+'/edit/'+id+'/'+idgroup)
		$('#members-edit select[name="members"] option').each(function() {
			if ($(this).val() == idgroup) {
				$(this).prop('selected', true);
			}
		});
		$('#form-edit-user').submit(function(e) {
			$.ajax({
				type: "POST",
				url: $(this).attr('action'),
				data:$(this).serialize(),
				success: function(msg){
					/*event.relatedTarget.dataset.idgroup = msg;*/
					/*$(event.relatedTarget).data('idgroup', msg);*/
					$('#edit-user').attr('data-idgroup='+id,msg);
					$('#members-edit').modal('hide');
				},
				error: function(msg){
					console.log(msg);
				}
			});
			e.preventDefault();
		});
	});	

});