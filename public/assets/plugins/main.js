$(document).ready(function(){
    /*$(function() {

        var toc = $("#toc").tocify({
          selectors: "h2,h3,h4,h5"
        }).data("toc-tocify");

        prettyPrint();
        $(".optionName").popover({ trigger: "hover" });

    });*/
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
    var url = window.location.pathname;  
    var activePage = url.substring(url.lastIndexOf('/')+1);
});