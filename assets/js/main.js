$( document ).ready(function() {


	if (window.location.href.split('/').pop() == "all-websites" || window.location.href.split('/').pop() == "website-category" || window.location.href.split('/').pop() == "website-language") {
		$('#view-ftp').on('show.bs.modal',function(event){
			var modal = $(this);
			var id = $(event.relatedTarget).data('id');

			$.ajax({
				type: "POST",
				url: window.location.href+'/modal-ftp-website/'+id,
				success: function(data){
					var jsdata = JSON.parse(data);
					$('#table-ftp-dashboard').dataTable().fnAddData(jsdata);
				},
				error: function(){
					alert("failure");
				}
			});
		});
		$('#view-ftp').on('hide.bs.modal',function(event){
			$('#table-ftp-dashboard').dataTable().fnClearTable();
		});
		$('#view-database').on('show.bs.modal',function(event){
			var modal = $(this);
			var id = $(event.relatedTarget).data('id');

			$.ajax({
				type: "POST",
				url: window.location.href+'/modal-database-website/'+id,
				success: function(data){
					var jsdata = JSON.parse(data);
					$('#table-database-dashboard').dataTable().fnAddData(jsdata);
				},
				error: function(){
					alert("failure");
				}
			});
		});
		$('#view-database').on('hide.bs.modal',function(event){
			$('#table-database-dashboard').dataTable().fnClearTable();
		});
		$('#view-backoffice').on('show.bs.modal',function(event){
			var modal = $(this);
			var id = $(event.relatedTarget).data('id');
			$.ajax({
				type: "POST",
				url: window.location.href+'/modal-backoffice-website/'+id,
				success: function(data){
					var jsdata = JSON.parse(data);
					$('#table-backoffice-dashboard').dataTable().fnAddData(jsdata);
				},
				error: function(){
					alert("failure");
				}
			});
		});
		$('#view-backoffice').on('hide.bs.modal',function(event){
			$('#table-backoffice-dashboard').dataTable().fnClearTable();
		});
		$('#email').on('show.bs.modal',function(event){
			var modal = $(this);
			var id = $(event.relatedTarget).data('id');
			
			$('[name="id"]').val(id);
		});
		$("#form-email").submit(function(e){
			$.ajax({
				type: "POST",
				url: $(this).attr('action'),
				data: $(this).serialize(),
				success: function(msg){
					$("#email").modal('hide');
				},
				error: function(msg){
					alert(msg.responseText);
				}
			});
			e.preventDefault();
		});

		EditableTable.init();
	} else if (window.location.href.split('/').pop() == "add-website" || window.location.href.split('/').pop() == "add-category" || window.location.href.split('/').pop() == "add-language") {
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
	} else if (window.location.href.split('/').pop() == "dashboard") {

	} else if (window.location.href.split('/').pop() == "category") {
        var categoryTable = $('#table-category').dataTable({
            "columnDefs": [
            { 
                "targets": [ 0 ], //last column
                "orderable": false, //set not orderable
            },
            ],
        });
        var nEditingCategory = null;
        function restoreRow(pTable, nRow) {
            var aData = pTable.fnGetData(nRow);
            var jqTds = $('>td', nRow);

            for (var i = 0, iLen = jqTds.length; i < iLen; i++) {
                pTable.fnUpdate(aData[i], nRow, i, false);
            }

            pTable.fnDraw();
        }
		function editRowCategory(categoryTable, nRow, nUrl) {
            var aData = categoryTable.fnGetData(nRow);
            var jqTds = $('>td', nRow);
            var languageList;
            jqTds[0].innerHTML = '<input type="text" class="form-control small" id="titlecategory" value="' + aData[0] + '">';
            jqTds[1].innerHTML = '<a id="edit-dashboard" href="'+nUrl+'">Save</a>';
            jqTds[2].innerHTML = '<a id="cancel-dashboard" href="javascript:void(0);">Cancel</a>';
        }
        function saveRowCategory(categoryTable, nRow) {
            var jqInputs = $('input', nRow);
            categoryTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
            categoryTable.fnUpdate('<a id="edit-dashboard" href="javascript:void(0);">Edit</a>', nRow, 1, false);
            categoryTable.fnUpdate('<a id="delete-dashboard" href="javascript:void(0);">Delete</a>', nRow, 2, false);
            categoryTable.fnDraw();
        }


		$('#delete-category').on('show.bs.modal',function(event){

					$.getJSON( window.location.href+'/loadCategories/', function( data ) {
						languageList = '<select id="category" class="form-control">';
						$.each( data, function( key, val ) {
							languageList += '<option value="'+val.c_id+'">'+ val.c_title + '</option>';
						});
						languageList += '</select>';
						$( "#delete-category .modal-body" ).append( languageList );
					});

		});
        $(document).on('click', '#table-category #delete-dashboard', function (e) {
            if (confirm('Voulez vous supprimer cette enregistrement')) {
                $.ajax({
                    type: "POST",
                    url: $(this).attr('href'),
                    data: $(this).serialize(),
                    success: function(msg){
                        var nRow = $('#table-dashboard #delete-dashboard').parents('tr')[0];
                        dashboardTable.fnDeleteRow(nRow);
                    },
                    error: function(msg){
                        console.log(msg);
                    }
                });
            }
            e.preventDefault();
        });

        $(document).on('click', '#table-category #cancel-dashboard', function (e) {
            e.preventDefault();
            if ($(this).attr("data-mode") == "new") {
                var nRow = $(this).parents('tr')[0];
                categoryTable.fnDeleteRow(nRow);
            } else {
                restoreRow(categoryTable, nEditingCategory);
                nEditingCategory = null;
            }
        });
        $(document).on('click', '#table-category #edit-dashboard', function (e) {
            e.preventDefault();

            var nRow = $(this).parents('tr')[0];
            var nUrl = $(this).attr('href');
            
            if (nEditingCategory !== null && nEditingCategory != nRow) {
                restoreRow(categoryTable, nEditingCategory);
                editRowCategory(categoryTable, nRow, nUrl);
                nEditingCategory = nRow;
            } else if (nEditingCategory == nRow && this.innerHTML == "Save") {
                var titlecategory = $('#titlecategory').val();
                $.ajax({
                    type: "POST",
                    url: $(this).attr('href'),
                    data: 'titlecategory='+titlecategory,
                    success: function(msg){
                        console.log(msg);
                        saveRowCategory(categoryTable, nEditingCategory);
                        nEditingCategory = null;
                    },
                    error: function(msg){
                        console.log(msg);
                    }
                });
            } else {
                editRowCategory(categoryTable, nRow, nUrl);
                nEditingCategory = nRow;
            }
        });
		EditableTable.init();
	} else if (window.location.href.split('/').pop() == "language") {
        var languageTable = $('#table-language').dataTable({
            "columnDefs": [
            { 
                "targets": [ 0 ], //last column
                "orderable": false, //set not orderable
            },
            ],
        });
        var nEditingLanguage = null;
		function editRowLanguage(languageTable, nRow, nUrl) {
            var aData = languageTable.fnGetData(nRow);
            var jqTds = $('>td', nRow);
            var languageList;
            jqTds[0].innerHTML = '<input type="text" class="form-control small" id="titlelanguage" value="' + aData[0] + '">';
            jqTds[1].innerHTML = '<a id="edit-dashboard" href="'+nUrl+'">Save</a>';
            jqTds[2].innerHTML = '<a id="cancel-dashboard" href="javascript:void(0);">Cancel</a>';
        }
        function saveRowLanguage(languageTable, nRow) {
            var jqInputs = $('input', nRow);
            languageTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
            languageTable.fnUpdate('<a id="edit-dashboard" href="javascript:void(0);">Edit</a>', nRow, 1, false);
            languageTable.fnUpdate('<a id="delete-dashboard" href="javascript:void(0);">Delete</a>', nRow, 2, false);
            languageTable.fnDraw();
        }
        function restoreRow(pTable, nRow) {
            var aData = pTable.fnGetData(nRow);
            var jqTds = $('>td', nRow);

            for (var i = 0, iLen = jqTds.length; i < iLen; i++) {
                pTable.fnUpdate(aData[i], nRow, i, false);
            }

            pTable.fnDraw();
        }

        $(document).on('click', '#table-language #cancel-dashboard', function (e) {
            e.preventDefault();
            if ($(this).attr("data-mode") == "new") {
                var nRow = $(this).parents('tr')[0];
                languageTable.fnDeleteRow(nRow);
            } else {
                restoreRow(languageTable, nEditingLanguage);
                nEditingLanguage = null;
            }
        });
        $(document).on('click', '#table-language #edit-dashboard', function (e) {
            e.preventDefault();

            var nRow = $(this).parents('tr')[0];
            var nUrl = $(this).attr('href');
            
            if (nEditingLanguage !== null && nEditingLanguage != nRow) {
                restoreRow(languageTable, nEditingLanguage);
                editRowLanguage(languageTable, nRow, nUrl);
                nEditingLanguage = nRow;
            } else if (nEditingLanguage == nRow && this.innerHTML == "Save") {
                var titlelanguage = $('#titlelanguage').val();
                $.ajax({
                    type: "POST",
                    url: $(this).attr('href'),
                    data: 'titlelanguage='+titlelanguage,
                    success: function(msg){
                        console.log(msg);
                        saveRowLanguage(languageTable, nEditingLanguage);
                        nEditingLanguage = null;
                    },
                    error: function(msg){
                        console.log(msg);
                    }
                });
            } else {
                editRowLanguage(languageTable, nRow, nUrl);
                nEditingLanguage = nRow;
            }
        });
		EditableTable.init();
	} else if (window.location.href.split('/').pop() == "whois-domain") {
        var registarTable = $('#table-whois').dataTable({
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Tous"]],
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.
            "dom": 'lBfrtip',
            "buttons": [
                {
                    extend: 'collection',
                    text: 'Export',
                    buttons: [
                        'copy',
                        'excel',
                        'csv',
                        'pdf',
                        'print'
                    ]
                }
            ],
            "ajax": {
                "url":  window.location.href+'/ajaxWhois/',
                "type": "POST"
            },
            "columnDefs": [
            { 
                "targets": [ 0 ], //last column
                "orderable": false, //set not orderable
            },
            ],
        });
		$('a#load-whois').click(function(e) {
			if (confirm('Voulez vous télécharger les whois des sites dans la base de donnée')) {
				$.ajax({
					xhr: function () {
					    var xhr = new window.XMLHttpRequest();
					    xhr.upload.addEventListener("progress", function (evt) {
					        if (evt.lengthComputable) {
					            var percentComplete = evt.loaded / evt.total;
					            console.log(percentComplete);
					            $('.progress-bar').css({
					                width: percentComplete * 100 + '%'
					            });
					            if (percentComplete === 1) {
					                $('.progress-bar').addClass('hide');
					            }
					        }
					    }, false);
					    xhr.addEventListener("load", function (evt) {
					        if (evt.lengthComputable) {
					            var percentComplete = evt.loaded / evt.total;
					            console.log(percentComplete);
					            $('.progress-bar').css({
					                width: percentComplete * 100 + '%'
					            });
					        }
					    }, false);
					    return xhr;
					},
					type: "POST",
					url: window.location.href+'/downloadWhois/',
					beforeSend: function() {
						$("a#load-whois").html('Chargement ...');
						$("a#load-whois").addClass('disabled');
					},
					success: function(msg){
						$("a#load-whois").html('Télécharger Whois');
						$("a#load-whois").removeClass('disabled');
						alert("L'intégralité de vos sites ont été télécharger");
					},
					error: function(msg){
						console.log(msg);
					}
				});
			}
			e.preventDefault();
		});
	} else if (window.location.href.split('/').pop() == "tasks") {
        $('.todo-check label').click(function () {
            $(this).parents('li').children('.todo-title').toggleClass('line-through');
        });


        $(document).on('click', '.todo-remove', function () {
            $(this).closest("li").remove();
            return false;
        });


        $('.stat-tab .stat-btn').click(function () {

            $(this).addClass('active');
            $(this).siblings('.btn').removeClass('active');

        });

        $('select.styled').customSelect();
        $("#sortable-todo").sortable();
        
		DraggablePortlet.init();
	} else if (window.location.href.split('/').pop() == "members") {
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
			var idgroup;
			$.getJSON( window.location.href+'/userGroup/'+id, function( data ) {
				idgroup = data;
				var modal = $(this);
				$('#form-edit-user').attr('action', window.location.href+'/edit/'+id+'/'+idgroup)
				$('#members-edit select[name="members"] option').each(function() {
					if ($(this).val() == idgroup) {
						$(this).prop('selected', true);
					}
				});			
			});
		});	
		$('#form-edit-user').submit(function(e) {
			$.ajax({
				type: "POST",
				url: $(this).attr('action'),
				data:$(this).serialize(),
				success: function(msg){
					/*event.relatedTarget.dataset.idgroup = msg;*/
					/*$(event.relatedTarget).data('idgroup', msg);*/
					/*$(event.relatedTarget).attr('data-idgroup',msg);*/
					$('#members-edit').modal('hide');
				},
				error: function(msg){
					console.log(msg);
				}
			});
			e.preventDefault();
		});
	} else if (window.location.href.split('/').pop() == "profile") {
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
	} else if (window.location.href.split('/').pop() == "index") {
		$('.toggle').click(function(){
			$(this).children('i').toggleClass('fa-pencil');
			$('.form-login-account').animate({
				height: "toggle",
				'padding-top': 'toggle',
				'padding-bottom': 'toggle',
				opacity: "toggle"
			}, "slow");
			$('.form-create-account').animate({
				height: "toggle",
				'padding-top': 'toggle',
				'padding-bottom': 'toggle',
				opacity: "toggle"
			}, "slow");
			/*$('.form-login-account').fadeOut();
			$('.form-create-account').fadeIn();
			$(this).addClass("toggle-in").removeClass("toggle");*/
		});
		$('.toggle-in').click(function(){
			$(this).children('i').toggleClass('fa-pencil');
			/*$('.form-create-account').fadeOut();
			$('.form-login-account').fadeIn();
			$(this).addClass("toggle").removeClass("toggle-in");*/
		});
		$('.link-forgot-password').click(function(){
			if ($('.form-login-account').is(':visible')) {
				$('.form-login-account').animate({
					height: "toggle",
					'padding-top': 'toggle',
					'padding-bottom': 'toggle',
					opacity: "toggle"
				}, "slow");
			} else {
				$('.form-create-account').animate({
					height: "toggle",
					'padding-top': 'toggle',
					'padding-bottom': 'toggle',
					opacity: "toggle"
				}, "slow");
			}
			$('.forgot-your-password').animate({
				height: "toggle",
				'padding-top': 'toggle',
				'padding-bottom': 'toggle',
				opacity: "toggle"
			}, "slow");
			$('.toggle').toggle();
			/*$('.form-login-account').fadeOut();
			$('.form-create-account').fadeOut();
			$('.forgot-your-password').fadeIn();*/
			$(this).text('Already have an account?');
		});
		$("#forgotpasswordform").submit(function(e){

			console.log($(this).attr('action'));
			console.log($(this).serialize());
			$.ajax({
				type: "POST",
				url: $(this).attr('action'),
				data: $(this).serialize(),
				success: function(msg){
					$('.forgot-your-password').animate({
						height: "toggle",
						'padding-top': 'toggle',
						'padding-bottom': 'toggle',
						opacity: "toggle"
					}, "slow");
					$('.toggle').toggle();
					$('.verification-code').animate({
						height: "toggle",
						'padding-top': 'toggle',
						'padding-bottom': 'toggle',
						opacity: "toggle"
					}, "slow");
					$('.toggle').toggle();
				},
				error: function(msg){
					alert(msg.responseText);
				}
			});
			e.preventDefault();
		});
	}
	$('li.language a').click(function(e) {
		$.ajax({
			type: "POST",
			url: $(this).attr('href'),
			success: function(msg){
				console.log(msg);
			}
		});
		e.preventDefault();
	});
});