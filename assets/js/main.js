$(document).ready(function(){

	if (window.location.href.split('/').pop() == "all-websites" || window.location.href.split('/')[window.location.href.split('/').length-3] == "all-websites") {
        if (window.location.href.split('/')[window.location.href.split('/').length-3] == "all-websites") {
            var url = window.location.href.replace(/(\/[^\/]+){2}\/?$/, '');
        } 
        else{
            var url = window.location.href;
        }
		$(document).on('click', '.access-ftp', function(e) {
			var id = $(this).data('id');
			$.ajax({
				type: "POST",
				url: url+'/modal-ftp-website/'+id,
				success: function(data){
					var jsdata = JSON.parse(data);
					$('#table-ftp-dashboard').dataTable().fnAddData(jsdata);
				},
				error: function(){
					alert("failure");
				}
			});
			e.preventDefault();
		});
		
		$('#view-ftp').on('hide.bs.modal',function(event){
			$('#table-ftp-dashboard').dataTable().fnClearTable();
		});
		$(document).on('click', '.access-sql', function(e) {

			var id = $(this).data('id');
			$.ajax({
				type: "POST",
				url: url+'/modal-database-website/'+id,
				success: function(data){
					var jsdata = JSON.parse(data);
					$('#table-database-dashboard').dataTable().fnAddData(jsdata);
				},
				error: function(){
					alert("failure");
				}
			});
			e.preventDefault();
		});
		$('#view-database').on('hide.bs.modal',function(event){
			$('#table-database-dashboard').dataTable().fnClearTable();
		});
		$(document).on('click', '.access-backoffice', function(e) {

			var id = $(this).data('id');
			$.ajax({
				type: "POST",
				url: url+'/modal-backoffice-website/'+id,
				success: function(data){
					var jsdata = JSON.parse(data);
					$('#table-backoffice-dashboard').dataTable().fnAddData(jsdata);
				},
				error: function(){
					alert("failure");
				}
			});
			e.preventDefault();
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
	} else if (window.location.href.split('/')[window.location.href.split('/').length-2] == "website-category") {
        var websitecategoryTable = $('#table-website-per-category').dataTable({
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Tous"]],
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.
			"dom": "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
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
                "url": window.location.href.substring(0, window.location.href.lastIndexOf("/"))+'/ajaxDashboard/'+window.location.href.substr(window.location.href.lastIndexOf('/') + 1),
                "type": "POST"
            },
            responsive: {
                details: {
                   
                }
            },
            columnDefs: [ {
                className: 'control',
                orderable: false,
                targets:   0
            } ],
        });
	} else if (window.location.href.split('/')[window.location.href.split('/').length-2] == "website-language") {
        var websitelanguageTable = $('#table-website-per-language').dataTable({
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Tous"]],
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.
			"dom": "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
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
                "url": window.location.href.substring(0, window.location.href.lastIndexOf("/"))+'/ajaxDashboard/'+window.location.href.substr(window.location.href.lastIndexOf('/') + 1),
                "type": "POST"
            },
            responsive: {
                details: {
                   
                }
            },
            columnDefs: [ {
                className: 'control',
                orderable: false,
                targets:   0
            } ],
        });
	} else if (window.location.href.split('/').pop() == "add-website" || window.location.href.split('/').pop() == "add-category" || window.location.href.split('/').pop() == "add-language") {
		$("#results .alert-success").hide();
		$("#results .alert-danger").hide();
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
					$('#results .alert-success').fadeIn('fast');
					setTimeout(function() {
						$('#results .alert-success').fadeOut('slow');
						$("#form-add-website").find("input[type=text], textarea").val("");
						$("#form-add-website").fadeIn('slow');
					}, 3000 );
				},
				error: function(msg){
					console.log(msg);
					$("#form-add-website").fadeOut('slow');
					$('#results .alert-danger').fadeIn('fast');
					setTimeout(function() {
						$('#results .alert-danger').fadeOut('slow');
						$("#form-add-website").find("input[type=text], textarea").val("");
						$("#form-add-website").fadeIn('slow');
					}, 3000 );
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
					console.log(msg);
					$("#form-add-category").fadeOut('slow');
					$('#results .alert-success').fadeIn('fast');
					setTimeout(function() {
						$('#results .alert-success').fadeOut('slow');
						$("#form-add-category").find("input[type=text], textarea").val("");
						$("#form-add-category").fadeIn('slow');
					}, 3000 );
				},
				error: function(msg){
					console.log(msg);
					$("#form-add-category").fadeOut('slow');
					$('#results .alert-danger').fadeIn('fast');
					setTimeout(function() {
						$('#results .alert-danger').fadeOut('slow');
						$("#form-add-category").find("input[type=text], textarea").val("");
						$("#form-add-category").fadeIn('slow');
					}, 3000 );
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
					console.log(msg);
					$("#form-add-language").fadeOut('slow');
					$('#results .alert-success').fadeIn('fast');
					setTimeout(function() {
						$('#results .alert-success').fadeOut('slow');
						$("#form-add-language").find("input[type=text], textarea").val("");
						$("#form-add-language").fadeIn('slow');
					}, 3000 );
				},
				error: function(msg){
					console.log(msg);
					$("#form-add-language").fadeOut('slow');
					$('#results .alert-danger').fadeIn('fast');
					setTimeout(function() {
						$('#results .alert-danger').fadeOut('slow');
						$("#form-add-language").find("input[type=text], textarea").val("");
						$("#form-add-language").fadeIn('slow');
					}, 3000 );
				}
			});
			e.preventDefault();
		});
	} else if (window.location.href.split('/').pop() == "export") {
		$('#form-export a').click(function(e) {
			$.ajax({
				type: "POST",
				url: $(this).attr('href'),
				success: function(msg){
					$('#form-export #keysecrete').val(msg);
				},
				error: function(msg){
					console.log(msg);
				}
			});
			e.preventDefault();
		});
		$(":input[type='radio']").on("change", function () {
			if ($("#radio_quick_export").prop("checked") ) {
				$(".export-search-table").hide();
			}
			else {
				$(".export-search-table").show();
			}
		});
	} else if (window.location.href.split('/').pop() == "import") {
		$("#results .alert-success").hide();
		$("#results .alert-danger").hide();
		$('#form-import').submit(function(e) {
			var formData = new FormData($(this)[0]);

			$.ajax({
				type: "POST",
				url: $(this).attr('action'),
				data: formData,
				dataType: 'json',
				cache : false,
				contentType : false,
				processData : false,
				success: function(response){
					if(response.type != 'error'){
						$("#form-import").fadeOut('slow');
						$('#results .alert-success').fadeIn('fast');
						setTimeout(function() {
							$('#results .alert-success').fadeOut('slow');
							$("#form-import").find("input[type=text], textarea").val("");
							$("#form-import").fadeIn('slow');
						}, 3000 );
					} else {
						$("#form-import").fadeOut('slow');
						$('#results .alert-danger').fadeIn('fast');
						setTimeout(function() {
							$('#results .alert-danger').fadeOut('slow');
							$("#form-import").find("input[type=text], textarea").val("");
							$("#form-import").fadeIn('slow');
						}, 3000 );
					}
				},
				error: function(response){
					$("#form-import").fadeOut('slow');
					$('#results .alert-danger').fadeIn('fast');
					setTimeout(function() {
						$('#results .alert-danger').fadeOut('slow');
						$("#form-import").find("input[type=text], textarea").val("");
						$("#form-import").fadeIn('slow');
					}, 3000 );
				}
			});
			e.preventDefault();
		});
	} else if (window.location.href.split('/').pop() == "category") {
		var nEditingCategory = null;
		var ElementDelete = null;
        var categoryTable = $('#table-category').dataTable({
			"columnDefs": [{ // set default column settings
                'orderable': true,
                'targets': [0]
            }, {
                "searchable": true,
                "targets": [0]
            }],
            "order": [
                [0, "asc"]
            ]
        });
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
            var categoryList;
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


		$('#modal-delete-category').on('show.bs.modal',function(event) {
			if (confirm('Voulez vous supprimer cette enregistrement')) {
				var modal = $(this);
				var id = $(event.relatedTarget).data('id');

				$('#form-category').attr("action",window.location.href+'/delete-category/'+id);
				$.getJSON( window.location.href+'/loadCategories/', function( data ) {
					categoryList = '<select id="category" name="category" class="form-control">';
					$.each( data, function( key, val ) {
						if ( id != val.c_id ) {
							categoryList += '<option value="'+val.c_id+'">'+ val.c_title + '</option>';
						}
					});
					categoryList += '</select>';
					$( "#modal-delete-category .modal-body" ).append( categoryList );
				});
            }
		});
		$('#modal-delete-category').on('hidden.bs.modal',function(event) {
			$('#category').remove();
		});
		$('#form-category').submit(function(e) {
            $.ajax({
                type: "POST",
                url:  $(this).attr('action'),
                data: $(this).serialize(),
                success: function(msg){
                	$('#modal-delete-category').modal('hide');
                    var nRow = $(ElementDelete).parents('tr')[0];
                    categoryTable.fnDeleteRow(nRow);
                },
                error: function(msg){
                    console.log(msg);
                }
            });
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
        $(document).on('click', '#table-category #delete-dashboard', function (e) {
            ElementDelete = this;
        });
	} else if (window.location.href.split('/').pop() == "language") {
        var nEditingLanguage = null;
        var ElementDelete = null;
        var languageTable = $('#table-language').dataTable({
			"columnDefs": [{ // set default column settings
                'orderable': true,
                'targets': [0]
            }, {
                "searchable": true,
                "targets": [0]
            }],
            "order": [
                [0, "asc"]
            ]
        });
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
        
		$('#modal-delete-language').on('show.bs.modal',function(event) {
			var modal = $(this);
			var id = $(event.relatedTarget).data('id');

			$('#form-language').attr("action",window.location.href+'/delete-language/'+id);
			$.getJSON( window.location.href+'/loadLanguages/', function( data ) {
				languageList = '<select id="language" name="language" class="form-control">';
				$.each( data, function( key, val ) {
					if ( id != val.l_id ) {
						languageList += '<option value="'+val.l_id+'">'+ val.l_title + '</option>';
					}
				});
				languageList += '</select>';
				$( "#modal-delete-language .modal-body" ).append( languageList );
			});
		});
		$('#modal-delete-language').on('hidden.bs.modal',function(event) {
			$('#language').remove();
		});
		$('#form-language').submit(function(e) {
            $.ajax({
                type: "POST",
                url:  $(this).attr('action'),
                data: $(this).serialize(),
                success: function(msg){
                	$('#modal-delete-language').modal('hide');
                    var nRow = $(ElementDelete).parents('tr')[0];
					languageTable.fnDeleteRow(nRow);
                },
                error: function(msg){
                    console.log(msg);
                }
            });
            e.preventDefault();
		});
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
        $(document).on('click', '#table-language #delete-dashboard', function (e) {
            ElementDelete = this;
        });
	} else if (window.location.href.split('/').pop() == "whois-domain") {
        var registarTable = $('#table-whois').dataTable({
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Tous"]],
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.
			"dom": "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
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
            responsive: {
                details: {
                   
                }
            },
            columnDefs: [ {
                className: 'control',
                orderable: false,
                targets:   0
            } ],
        });
		$(document).on('click', '.access-whois', function(e) {

			var id = $(this).data('id');
			$.ajax({
				type: "POST",
				url: window.location.href+'/modal-whois/'+id,
				success: function(data){		
					$( "#view-whois .modal-body" ).append("<pre>"+data+"</pre>");
				},
				error: function(){
					alert("failure");
				}
			});
			e.preventDefault();
		});
		$('#view-whois').on('hide.bs.modal',function(event){
			$( "#view-whois .modal-body pre" ).remove();
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
	} else if (window.location.href.split('/').pop() == "website-scrapper-google") {
		var seoTable = $('#table-seo').dataTable({
		    "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Tous"]],
		    "processing": true,
		    "serverSide": true,
		    "order": [],
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
		        "url":  window.location.href+'/ajaxWebsiteScrapperGoogle/',
		        "type": "POST"
		    },
		    "columnDefs": [
			    {
			        "targets": [ 0 ],
			        "orderable": false,
			    },
		    ],
		});
	} else if (window.location.href.split('/').pop() == "search-scrapper-google") {
		var searchgoogleTable = $('#table-search-scrapper-google').DataTable({
		    "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Tous"]],
		    "order": [],
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
		    "columnDefs": [
			    {
			        "targets": [ 0 ],
			        "orderable": false,
			    },
		    ],
		});
		$('#form-search-scrapper-google').submit(function(e) {
			$.ajax({
				type: "POST",
				url: $(this).attr('action'),
				data: $(this).serialize(),
				success: function(data){
					$('#table-search-scrapper-google').DataTable().rows().remove().draw();
					var jsdata = JSON.parse(data);
					$('#table-search-scrapper-google').DataTable().rows.add(jsdata).draw();
				},
				error: function(msg){
					console.log(msg);
				}
			});
			e.preventDefault();
		});
	/*} else if (window.location.href.split('/')[window.location.href.split('/').length-2] == "ftp-websites") {*/
		/*for (var i = 0; i < tree_data.length; i++) {
			$('ul.treeview').append('<li class="tree-branch"><a href="javascript:void(0)" class="'+tree_data[i].text+'"><i class="'+tree_data[i].icon+'"></i> '+tree_data[i].text+'</a></li>');
		};*/

	/*$("#tree_3").bind("open_node.jstree", function (event, data) {
		var glue = '/';
		var pathftp = $('#tree_3').jstree().get_path(data.node, glue, true );
		var url = window.location.href.substring(0, window.location.href.lastIndexOf("/"));
		var id = window.location.href.substr(window.location.href.lastIndexOf('/') + 1);

		$.ajax({
			type: "POST",
			url: url+'/refreshpath/'+id,
			data: 'pathftp='+pathftp,
			success: function(msg){
				results = JSON.parse(msg);
				for(var key in results) {
					$('#tree_3').jstree().create_node(data.node.text, results[key], "last");
				}
				console.log(JSON.parse(msg));
			},
			error: function(msg){
				console.log(msg);
			}
		});
		return false;
	});*/
	} else if (window.location.href.split('/').pop() == "ftp-websites" || window.location.href.split('/')[window.location.href.split('/').length-2] == "ftp-websites") {

		$('ul.treeview').on('click', 'a', function() {
			var elementfolder = $(this).attr('class');
			var path = $("#path").val();
			console.log($(this).parent().attr('class'));
			var url = window.location.href.substring(0, window.location.href.lastIndexOf("/"));
			var id = window.location.href.substr(window.location.href.lastIndexOf('/') + 1);

			$.ajax({
				type: "POST",
				url: url+'/refreshfolder/'+id,
				data: 'path='+($('#path').val() == '/' ?path+elementfolder:path+'/'+elementfolder),
				success: function(msg){
					results = JSON.parse(msg);
					$("#path").val($("#path").val() == '/' ?path+elementfolder:path+'/'+elementfolder);
					$('ul.treeview .'+elementfolder).after('<ul></ul>');
					for(var key in results) {
						$('ul.treeview .'+elementfolder).next().append('<li class="tree-branch"><a href="javascript:void(0)" class="'+results[key].title+'"><i class="'+results[key].icon+'"></i> '+results[key].title+'</a></li>');
					}
				},
				error: function(msg){
					console.log(msg);
				}
			});
		});

        var ftpwebsitesTable = $('#table-ftpwebsites').dataTable({
           /* "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Tous"]],
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.
			"dom": "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
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
                "url":  window.location.href+'/ajaxListftp/',
                "type": "POST"
            },
            responsive: {
                details: {
                   
                }
            },
            columnDefs: [ {
                className: 'control',
                orderable: false,
                targets:   0
            } ]*/
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Tous"]],
            "responsive": {
                'details': {
                   
                }
            },
			"columnDefs": [{ // set default column settings
                'orderable': true,
                'targets': [0]
            }, {
                "searchable": true,
                "targets": [0]
            }],
            "order": [
                [0, "asc"]
            ]
        });
	} else if (window.location.href.split('/').pop() == "members") {
		$('a#delete-user').click(function(e) {
			if (confirm('Voulez vous supprimer cette enregistrement')) {
				$.ajax({
					type: "POST",
					url: $(this).attr('href'),
					success: function(msg){
						$('.member-entry-'+$(this).attr('url').split("/").pop()).remove();
					},
					error: function(msg){
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
				data: $(this).serialize(),
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
		$("#forgotpasswordform").submit(function(e){

			console.log($(this).attr('action'));
			console.log($(this).serialize());
			$.ajax({
				type: "POST",
				url: $(this).attr('action'),
				data: $(this).serialize(),
				success: function(msg){

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
				window.location.reload();
			},
			error: function(msg){
				console.log(msg);
			}
		});
		e.preventDefault();
	});
	$('.leftside-navigation .sidebar-menu li a').load(function(e) {
		$(this).addClass("active");
	});
});