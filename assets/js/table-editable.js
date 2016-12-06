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
            var dashboardTable = $('#table-dashboard').dataTable({
                "processing": true, //Feature control the processing indicator.
                "serverSide": true, //Feature control DataTables' server-side processing mode.
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
                    "url":  window.location.href+'/ajaxDashboard/',
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

                order: [ 1, 'asc' ],
                
                // pagination control
                "lengthMenu": [
                    [5, 10, 15, 20, -1],
                    [5, 10, 15, 20, "All"] // change per page values here
                ],
                // set the initial value
                "pageLength": 10,
            });
            $(".dt-button").append("<i class='fa fa-angle-down'></i>");
            var ftpTable = $('#table-ftp-dashboard').dataTable({
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
            var dbTable = $('#table-database-dashboard').dataTable({
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
            var boTable = $('#table-backoffice-dashboard').dataTable({
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

            function editRowWebsiteInfo(dashboardTable, nRow, nUrl) {
                var aData = dashboardTable.fnGetData(nRow);
                var jqTds = $('>td', nRow);
                var languageList;
                jqTds[0].innerHTML = '<input type="text" class="form-control small" id="titlewebsite" value="' + aData[0] + '">';
                jqTds[1].innerHTML = '<input type="text" class="form-control small" id="website" value="' + $(aData[1]).text() + '">';
                $.getJSON( window.location.href+'/loadCategories/', function( data ) {
                    languageList = '<select id="category" class="form-control">';
                    $.each( data, function( key, val ) {
                        if ( val.c_title == aData[3] ) {
                            languageList += '<option value="'+val.c_id+'" selected>'+ val.c_title + '</option>';
                        } else{
                            languageList += '<option value="'+val.c_id+'">'+ val.c_title + '</option>';
                        }
                    });
                    languageList += '</select>';
                    jqTds[3].innerHTML = languageList;
                });
                $.getJSON( window.location.href+'/loadLanguages/', function( data ) {
                    languageList = '<select id="language" class="form-control">';
                    $.each( data, function( key, val ) {
                        if ( val.l_title == aData[4] ) {
                            languageList += '<option value="'+val.l_id+'" selected>'+ val.l_title + '</option>';
                        } else{
                            languageList += '<option value="'+val.l_id+'">'+ val.l_title + '</option>';
                        }
                    });
                    languageList += '</select>';
                    jqTds[4].innerHTML = languageList;
                });
                jqTds[9].innerHTML = '<a id="edit-dashboard" href="'+nUrl+'">Save</a>';
                jqTds[10].innerHTML = '<a id="cancel-dashboard" href="">Cancel</a>';
            }
            function saveRowWebsiteInfo(dashboardTable, nRow) {
                var jqInputs = $('input', nRow);
                dashboardTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
                dashboardTable.fnUpdate($.parseHTML('<a href="'+jqInputs[1].value+'" target="_blank">'+jqInputs[1].value+'</a>'), nRow, 1, false);
                var jqSelects = $('select', nRow);
                dashboardTable.fnUpdate(jqSelects[0].options[jqSelects[0].selectedIndex].text, nRow, 3, false);
                dashboardTable.fnUpdate(jqSelects[1].options[jqSelects[1].selectedIndex].text, nRow, 4, false);
                dashboardTable.fnUpdate($.parseHTML('<a id="edit-dashboard" href="javascript:void(0);">Edit</a>'), nRow, 9, false);
                dashboardTable.fnUpdate($.parseHTML('<a id="delete-dashboard" href="javascript:void(0);">Delete</a>'), nRow, 10, false);
                dashboardTable.fnDraw();
            }

            function editRowWebsiteFtp(ftpTable, nRow, nUrl) {
                var aData = ftpTable.fnGetData(nRow);
                var jqTds = $('>td', nRow);
                var languageList;
                jqTds[0].innerHTML = '<input type="text" class="form-control small" id="hoteftp" value="' + aData[0] + '">';
                jqTds[1].innerHTML = '<input type="text" class="form-control small" id="loginftp" value="' + aData[1] + '">';
                jqTds[2].innerHTML = '<input type="text" class="form-control small" id="passwordftp" value="' + aData[2] + '">';
                jqTds[3].innerHTML = '<a id="edit-dashboard" href="'+nUrl+'">Save</a>';
                jqTds[4].innerHTML = '<a id="cancel-dashboard" href="javascript:void(0);">Cancel</a>';
            }
            function saveRowWebsiteFtp(ftpTable, nRow) {
                var jqInputs = $('input', nRow);
                ftpTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
                ftpTable.fnUpdate(jqInputs[1].value, nRow, 1, false);
                ftpTable.fnUpdate(jqInputs[2].value, nRow, 2, false);
                ftpTable.fnUpdate('<a id="edit-dashboard" href="javascript:void(0);">Edit</a>', nRow, 3, false);
                ftpTable.fnUpdate('<a id="delete-dashboard" href="javascript:void(0);">Delete</a>', nRow, 4, false);
                ftpTable.fnDraw();
            }
            function editRowWebsiteDatabase(dbTable, nRow, nUrl) {
                var aData = dbTable.fnGetData(nRow);
                var jqTds = $('>td', nRow);
                var languageList;
                jqTds[0].innerHTML = '<input type="text" class="form-control small" id="hotedatabase" value="' + aData[0] + '">';
                jqTds[1].innerHTML = '<input type="text" class="form-control small" id="namedatabase" value="' + aData[1] + '">';
                jqTds[2].innerHTML = '<input type="text" class="form-control small" id="logindatabase" value="' + aData[2] + '">';
                jqTds[3].innerHTML = '<input type="text" class="form-control small" id="passworddatabase" value="' + aData[3] + '">';
                jqTds[4].innerHTML = '<a id="edit-dashboard" href="'+nUrl+'">Save</a>';
                jqTds[5].innerHTML = '<a id="cancel-dashboard" href="javascript:void(0);">Cancel</a>';
            }
            function saveRowWebsiteDatabase(dbTable, nRow) {
                var jqInputs = $('input', nRow);
                dbTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
                dbTable.fnUpdate(jqInputs[1].value, nRow, 1, false);
                dbTable.fnUpdate(jqInputs[2].value, nRow, 2, false);
                dbTable.fnUpdate(jqInputs[3].value, nRow, 3, false);
                dbTable.fnUpdate('<a id="edit-dashboard" href="javascript:void(0);">Edit</a>', nRow, 4, false);
                dbTable.fnUpdate('<a id="delete-dashboard" href="javascript:void(0);">Delete</a>', nRow, 5, false);
                dbTable.fnDraw();
            }
            function editRowWebsiteBackoffice(boTable, nRow, nUrl) {
                var aData = boTable.fnGetData(nRow);
                var jqTds = $('>td', nRow);
                var languageList;
                jqTds[0].innerHTML = '<input type="text" class="form-control small" id="loginbackoffice" value="' + aData[0] + '">';
                jqTds[1].innerHTML = '<input type="text" class="form-control small" id="passwordbackoffice" value="' + aData[1] + '">';
                jqTds[2].innerHTML = '<a id="edit-dashboard" href="'+nUrl+'">Save</a>';
                jqTds[3].innerHTML = '<a id="cancel-dashboard" href="javascript:void(0);">Cancel</a>';
            }
            function saveRowWebsiteBackoffice(boTable, nRow) {
                var jqInputs = $('input', nRow);
                boTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
                boTable.fnUpdate(jqInputs[1].value, nRow, 1, false);
                boTable.fnUpdate('<a id="edit-dashboard" href="javascript:void(0);">Edit</a>', nRow, 2, false);
                boTable.fnUpdate('<a id="delete-dashboard" href="javascript:void(0);">Delete</a>', nRow, 3, false);
                boTable.fnDraw();
            }

            jQuery('#editable-sample_wrapper .dataTables_filter input').addClass("form-control medium");
            jQuery('#editable-sample_wrapper .dataTables_length select').addClass("form-control xsmall");

            var nEditingDashboard = null;
            var nEditingDatabase = null;
            var nEditingFtp = null;
            var nEditingBackoffice = null;

            $(document).on('click', '#table-dashboard #delete-dashboard', function (e) {
                if (confirm('Voulez vous supprimer cette enregistrement')) {
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
            
            $(document).on('click', '#table-dashboard #edit-dashboard', function (e) {
                e.preventDefault();

                var nRow = $(this).parents('tr')[0];
                var nUrl = $(this).attr('href');
                
                if (nEditingDashboard !== null && nEditingDashboard != nRow) {
                    restoreRow(dashboardTable, nEditingDashboard);
                    editRowWebsiteInfo(dashboardTable, nRow, nUrl);
                    nEditingDashboard = nRow;
                } else if (nEditingDashboard == nRow && this.innerHTML == "Save") {
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

            $(document).on('click', '#table-ftp-dashboard #cancel-dashboard', function (e) {
                e.preventDefault();
                if ($(this).attr("data-mode") == "new") {
                    var nRow = $(this).parents('tr')[0];
                    ftpTable.fnDeleteRow(nRow);
                } else {
                    restoreRow(ftpTable, nEditingFtp);
                    nEditingFtp = null;
                }
            });

            $(document).on('click', '#table-ftp-dashboard #edit-dashboard', function (e) {
                e.preventDefault();

                var nRow = $(this).parents('tr')[0];
                var nUrl = $(this).attr('href');
                
                if (nEditingFtp !== null && nEditingFtp != nRow) {
                    restoreRow(ftpTable, nEditingFtp);
                    editRowWebsiteFtp(ftpTable, nRow, nUrl);
                    nEditingFtp = nRow;
                } else if (nEditingFtp == nRow && this.innerHTML == "Save") {
                    var hoteftp = $('#hoteftp').val();
                    var loginftp = $('#loginftp').val();
                    var passwordftp = $('#passwordftp').val();
                    $.ajax({
                        type: "POST",
                        url: $(this).attr('href'),
                        data: {'hoteftp':hoteftp,'loginftp':loginftp,'passwordftp':passwordftp},
                        success: function(msg){
                            console.log(msg);
                            saveRowWebsiteFtp(ftpTable, nEditingFtp);
                            nEditingFtp = null;
                        },
                        error: function(msg){
                            console.log(msg);
                        }
                    });
                } else {
                    editRowWebsiteFtp(ftpTable, nRow, nUrl);
                    nEditingFtp = nRow;
                }
            });

            $(document).on('click', '#table-database-dashboard #cancel-dashboard', function (e) {
                e.preventDefault();
                if ($(this).attr("data-mode") == "new") {
                    var nRow = $(this).parents('tr')[0];
                    dbTable.fnDeleteRow(nRow);
                } else {
                    restoreRow(dbTable, nEditingDatabase);
                    nEditingDatabase = null;
                }
            });
            $(document).on('click', '#table-database-dashboard #edit-dashboard', function (e) {
                e.preventDefault();

                var nRow = $(this).parents('tr')[0];
                var nUrl = $(this).attr('href');
                
                if (nEditingDatabase !== null && nEditingDatabase != nRow) {
                    restoreRow(dbTable, nEditingDatabase);
                    editRowWebsiteDatabase(dbTable, nRow, nUrl);
                    nEditingDatabase = nRow;
                } else if (nEditingDatabase == nRow && this.innerHTML == "Save") {
                    var hotedatabase = $('#hotedatabase').val();
                    var namedatabase = $('#namedatabase').val();
                    var logindatabase = $('#logindatabase').val();
                    var passworddatabase = $('#passworddatabase').val();
                    $.ajax({
                        type: "POST",
                        url: $(this).attr('href'),
                        data: {'hotedatabase':hotedatabase,'namedatabase':namedatabase,'logindatabase':logindatabase,'passworddatabase':passworddatabase},
                        success: function(msg){
                            console.log(msg);
                            saveRowWebsiteDatabase(dbTable, nEditingDatabase);
                            nEditingDatabase = null;
                        },
                        error: function(msg){
                            console.log(msg);
                        }
                    });
                } else {
                    editRowWebsiteDatabase(dbTable, nRow, nUrl);
                    nEditingDatabase = nRow;
                }
            });


            $(document).on('click', '#table-backoffice-dashboard #cancel-dashboard', function (e) {
                e.preventDefault();
                if ($(this).attr("data-mode") == "new") {
                    var nRow = $(this).parents('tr')[0];
                    boTable.fnDeleteRow(nRow);
                } else {
                    restoreRow(boTable, nEditingBackoffice);
                    nEditingBackoffice = null;
                }
            });
            $(document).on('click', '#table-backoffice-dashboard #edit-dashboard', function (e) {
                e.preventDefault();

                var nRow = $(this).parents('tr')[0];
                var nUrl = $(this).attr('href');
                
                if (nEditingBackoffice !== null && nEditingBackoffice != nRow) {
                    restoreRow(boTable, nEditingBackoffice);
                    editRowWebsiteBackoffice(boTable, nRow, nUrl);
                    nEditingBackoffice = nRow;
                } else if (nEditingBackoffice == nRow && this.innerHTML == "Save") {
                    var loginbackoffice = $('#loginbackoffice').val();
                    var passwordbackoffice = $('#passwordbackoffice').val();
                    $.ajax({
                        type: "POST",
                        url: $(this).attr('href'),
                        data: {'loginbackoffice':loginbackoffice,'passwordbackoffice':passwordbackoffice},
                        success: function(msg){
                            saveRowWebsiteBackoffice(boTable, nEditingBackoffice);
                            nEditingBackoffice = null;
                        },
                        error: function(msg){
                            console.log(msg);
                        }
                    });
                } else {
                    editRowWebsiteBackoffice(boTable, nRow, nUrl);
                    nEditingBackoffice = nRow;
                }
            });
        }

    };

}();