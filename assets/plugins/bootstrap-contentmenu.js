(function ($, window) {

    $.fn.contextMenu = function (settings) {

        return this.each(function () {

            // Open context menu
            $(this).on("contextmenu", function (e) {
                // return native menu if pressing control
                if (e.ctrlKey) return;
                
                //open menu
                var $menu = $(settings.menuSelector)
                    .data("invokedOn", $(e.target))
                    .show()
                    .css({
                        position: "absolute",
                        left: getMenuPosition(e.clientX - $(".panel").offset().left +10, 'width', 'scrollLeft'),
                        top: getMenuPosition(e.clientY - $(".panel").offset().top, 'height', 'scrollTop')
                    })
                    .off('click')
                    .on('click', 'a', function (e) {
                        $menu.hide();
                
                        var $invokedOn = $menu.data("invokedOn");
                        var $selectedMenu = $(e.target);
                        
                        settings.menuSelected.call(this, $invokedOn, $selectedMenu);
                    });
                
                return false;
            });

            //make sure menu closes on any click
            $('body').click(function () {
                $(settings.menuSelector).hide();
            });
        });
        
        function getMenuPosition(mouse, direction, scrollDir) {
            var win = $(window)[direction](),
                scroll = $(window)[scrollDir](),
                menu = $(settings.menuSelector)[direction](),
                position = mouse + scroll;
                        
            // opening menu would pass the side of the page
            if (mouse + menu > win && menu < mouse) 
                position -= menu;
            
            return position;
        }    

    };
})(jQuery, window);

$(".treeviewlocal .tree-branch a, .treeviewserver .tree-branch a").contextMenu({
    menuSelector: "#contextMenu",
    menuSelected: function (invokedOn, selectedMenu) {
        var url = window.location.href.substring(0, window.location.href.lastIndexOf("/"));
        var id = window.location.href.substr(window.location.href.lastIndexOf('/') + 1);
        if (selectedMenu.text() == 'Creer') {
            var elementcreate = prompt("Enter your name : ", "New Document");

            jQuery.ajax({
                type: "POST",
                url: url+'/mkdirftp/'+id,
                data: 'elementcreate='+$('#path-server').val()+elementcreate,
                success: function(msg){
                    results = JSON.parse(msg);
                    console.log(JSON.parse(msg));
                },
                error: function(msg){
                    console.log(msg);
                }
            });
        }
        if (selectedMenu.text() == 'Telecharger') {
            jQuery.ajax({
                type: "POST",
                url: url+'/downloadftp/'+id,
                data: 'elementdownload='+$('#path-server').val()+invokedOn.text(),
                success: function(msg){
                    results = JSON.parse(msg);
                    console.log(JSON.parse(msg));
                },
                error: function(msg){
                    console.log(msg);
                }
            });
        }
        if (selectedMenu.text() == 'Renommer') {
            var newrename = prompt("Enter your name : ", invokedOn.text());
            
            jQuery.ajax({
                type: "POST",
                url: url+'/renameftp/'+id,
                data: 'oldrename='+$('#path-server').val()+invokedOn.text()+'&newrename='+$('#path-server').val()+newrename,
                success: function(msg){
                    results = JSON.parse(msg);
                    console.log(JSON.parse(msg));
                },
                error: function(msg){
                    console.log(msg);
                }
            });
        }
        if (selectedMenu.text() == 'Supprimer') {
            jQuery.ajax({
                type: "POST",
                url: url+'/deleteftp/'+id,
                data: 'elementdelete='+$('#path-server').val()+invokedOn.text(),
                success: function(msg){
                    results = JSON.parse(msg);
                    console.log(JSON.parse(msg));
                },
                error: function(msg){
                    console.log(msg);
                }
            });
        }
    }
});