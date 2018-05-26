var EditableTable = function () {

    return {

        //main function to initiate the module
        init: function () {
            function restoreRow(pTable, nRow) {
                var aData = pTable.fnGetData(nRow);
                var jqTds = $('>td', nRow);

                for (var i = 0, iLen = jqTds.length; i < iLen; i++) {
                    pTable.fnUpdate(aData[i], nRow, i, false);
                }

                pTable.fnDraw();
            }
            if (window.location.href.split('/')[window.location.href.split('/').length-3] == "all-websites") {
                var url = window.location.href.replace(/(\/[^\/]+){2}\/?$/, '')+'/ajaxDashboard/'+window.location.href.split('/')[window.location.href.split('/').length-2]+'/'+window.location.href.split('/')[window.location.href.split('/').length-1];
            } 
            else{
                var url = window.location.href+'/ajaxDashboard/';
            }
            var dashboardTable = $('#table-dashboard').dataTable({
                "processing": true,
                "serverSide": true,
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
                    "url":  url,
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

                "order": [
                    [0, 'asc']
                ],
                
                "lengthMenu": [
                    [5, 10, 15, 20, -1],
                    [5, 10, 15, 20, "All"] // change per page values here
                ],
                // set the initial value
                "pageLength": 10,
            });
            $(".dt-button").append("<i class='fa fa-angle-down'></i>");

            function editRowWebsiteInfo(dashboardTable, nRow, nUrl) {
                var aData = dashboardTable.fnGetData(nRow);
                var jqTds = $('>td', nRow);
                var languageList;
                jqTds[0].innerHTML = '<input type="text" class="form-control small" id="titlewebsite" value="' + aData[0] + '">';
                jqTds[1].innerHTML = '<input type="text" class="form-control small" id="website" value="' + $(aData[1]).text() + '">';
                $.getJSON( (window.location.href.split('/')[window.location.href.split('/').length-3] == "all-websites"?window.location.href.replace(/(\/[^\/]+){2}\/?$/, ''):window.location.href)+'/loadCategories/', function( data ) {
                    languageList = '<select id="category" class="form-control">';
                    $.each( data, function( key, val ) {
                        if ( val.c_title == aData[3] ) {
                            languageList += '<option value="'+val.c_id+'" selected>'+ val.title_category + '</option>';
                        } else{
                            languageList += '<option value="'+val.c_id+'">'+ val.title_category + '</option>';
                        }
                    });
                    languageList += '</select>';
                    jqTds[3].innerHTML = languageList;
                });
                $.getJSON( (window.location.href.split('/')[window.location.href.split('/').length-3] == "all-websites"?window.location.href.replace(/(\/[^\/]+){2}\/?$/, ''):window.location.href)+'/loadLanguages/', function( data ) {
                    languageList = '<select id="language" class="form-control">';
                    $.each( data, function( key, val ) {
                        if ( val.l_title == aData[4] ) {
                            languageList += '<option value="'+val.l_id+'" selected>'+ val.title_language + '</option>';
                        } else{
                            languageList += '<option value="'+val.l_id+'">'+ val.title_language + '</option>';
                        }
                    });
                    languageList += '</select>';
                    jqTds[4].innerHTML = languageList;
                });
                jqTds[9].innerHTML = '<a id="edit-dashboard" href="'+nUrl+'" class="btn btn-secondary fuse-ripple-ready"><i class="fa fa-check" value="check"></i></a><a id="cancel-dashboard" href="" class="btn btn-white"><i class="fa fa-close"></i></a>';
            }
            function deleteRowWebsiteInfo(dashboardTable, nRow, nUrl) {
                var aData = dashboardTable.fnGetData(nRow);
                var jqTds = $('>td', nRow);
                jqTds[9].innerHTML = '<a id="delete-dashboard" href="'+nUrl+'" class="btn btn-white"><i class="fa fa-check" value="check"></i></a><a id="cancel-dashboard" href="" class="btn btn-white"><i class="fa fa-close"></i></a>';
            }
            function saveRowWebsiteInfo(dashboardTable, nRow) {
                var jqInputs = $('input', nRow);
                dashboardTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
                dashboardTable.fnUpdate($.parseHTML('<a href="'+jqInputs[1].value+'" target="_blank">'+jqInputs[1].value+'</a>'), nRow, 1, false);
                var jqSelects = $('select', nRow);
                dashboardTable.fnUpdate(jqSelects[0].options[jqSelects[0].selectedIndex].text, nRow, 3, false);
                dashboardTable.fnUpdate(jqSelects[1].options[jqSelects[1].selectedIndex].text, nRow, 4, false);
                dashboardTable.fnDraw();
            }

            jQuery('#editable-sample_wrapper .dataTables_filter input').addClass("form-control medium");
            jQuery('#editable-sample_wrapper .dataTables_length select').addClass("form-control xsmall");

            var nEditingDashboard = null;

            $(document).on('click', '#table-dashboard #edit-dashboard', function (e) {
                e.preventDefault();

                var nRow = $(this).parents('tr')[0];
                var nUrl = $(this).attr('href');
                
                if (nEditingDashboard !== null && nEditingDashboard != nRow) {
                    restoreRow(dashboardTable, nEditingDashboard);
                    editRowWebsiteInfo(dashboardTable, nRow, nUrl);
                    nEditingDashboard = nRow;
                } else if (nEditingDashboard == nRow && $(this).find("i").attr("value") == "check") {
                    var id = $('#id').val();
                    var titlewebsite = $('#titlewebsite').val();
                    var website = $('#website').val();
                    var category = $('#category').val();
                    var language = $('#language').val();
                    var datecreatewebsite = $('#datecreatewebsite').val();
                    $.ajax({
                        type: "POST",
                        url: $(this).attr('href'),
                        data: {'id':id,'titlewebsite':titlewebsite,'website':website,'category':category,'language':language},
                        success: function(msg){
                            saveRowWebsiteInfo(dashboardTable, nEditingDashboard);
                            nEditingDashboard = null;
                        },
                        error: function(msg){
                            console.log(msg);
                        }
                    });
                } else {
                    editRowWebsiteInfo(dashboardTable, nRow, nUrl);
                    nEditingDashboard = nRow;
                }
            });

            $(document).on('click', '#table-dashboard #delete-dashboard', function (e) {

                var nRow = $(this).parents('tr')[0];
                var nUrl = $(this).attr('href');
                if (nEditingDashboard != nRow) {
                    deleteRowWebsiteInfo(dashboardTable, nRow, nUrl);
                    nEditingDashboard = nRow;
                } else if (nEditingDashboard == nRow && $(this).find("i").attr("value") == "check") {
                    $.ajax({
                        type: "POST",
                        url: $(this).attr('href'),
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

            $(document).on('click', '#table-dashboard #cancel-dashboard', function (e) {
                e.preventDefault();
                if ($(this).attr("data-mode") == "new") {
                    var nRow = $(this).parents('tr')[0];
                    dashboardTable.fnDeleteRow(nRow);
                } else {
                    restoreRow(dashboardTable, nEditingDashboard);
                    nEditingDashboard = null;
                }
            });
            

        }

    };

}();