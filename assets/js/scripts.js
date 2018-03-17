(function ()
{
    $('document').ready(function ()
    {
        // Prevent default for empty links
        $('[href="#"]').click(function (e)
        {
            e.preventDefault()
        })

        // Adding data-parent to togglable nav items
        $('#sidenav [data-toggle]').each(function ()
        {
            $(this).attr('data-parent', '#' + $(this).parent().parent().attr('id'));
        })

        /**
         * Trigger window resize to update nvd3 charts
         */
        $('[data-toggle="tab"]').on('shown.bs.tab', function (e)
        {
            window.dispatchEvent(new Event('resize'));
        });

        /**
         * Enable tooltips everywhere
         */
        $('[data-toggle="tooltip"]').tooltip();

        /**
         * Enable popovers everywhere
         */
        $('[data-toggle="popover"]').popover();

        // Activate animated progress bar
        $('.bd-toggle-animated-progress').on('click', function () {
            $(this).siblings('.progress').find('.progress-bar-striped').toggleClass('progress-bar-animated')
        })

        /**
         * Enable Custom Scrollbars only for desktop
         */
        var mobileDetect = new MobileDetect(window.navigator.userAgent);

        if ( !mobileDetect.mobile() )
        {
            $('.custom-scrollbar').perfectScrollbar();
        }

        /**
         * Fix code block indentations
         */
        $('code').each(function ()
        {
            var lines = $(this).html().split('\n');

            if ( lines[0] === '' )
            {
                lines.shift()
            }

            var matches;
            var indentation = (matches = /^\s+/.exec(lines[0])) !== null ? matches[0] : null;

            if ( !!indentation )
            {
                lines = lines.map(function (line)
                {
                    return line.replace(indentation, '');
                });

                $(this).html(lines.join('\n').trim());
            }
        });

        /**
         * Flip source-preview cards
         */
        $('.toggle-source-preview').on('click', function ()
        {
            $(this).parents('.example').toggleClass('show-source');
        });
    });

    /**
     * Data tables fix header resize
     */
    $(window).on('resize', function ()
    {
        $.fn.dataTable.tables({
            visible: true,
            api    : true
        }).columns.adjust();
    })


})();

(function ($) {
    "use strict";
    $(document).ready(function () {
        /*==Left Navigation Accordion ==*/
        if ($.fn.dcAccordion) {
            $('#nav-accordion').dcAccordion({
                eventType: 'click',
                autoClose: true,
                saveState: true,
                disableLink: true,
                speed: 'slow',
                showCount: false,
                autoExpand: true,
                classExpand: 'dcjq-current-parent'
            });
        }

        /*$(function() {

            var toc = $("#toc").tocify({
              selectors: "h2,h3,h4,h5"
            }).data("toc-tocify");

            prettyPrint();
            $(".optionName").popover({ trigger: "hover" });

        });*/
        /*==Slim Scroll ==*/
        if ($.fn.slimScroll) {
            $('.event-list').slimscroll({
                height: '305px',
                wheelStep: 20
            });
            $('.conversation-list').slimscroll({
                height: '360px',
                wheelStep: 35
            });
            $('.to-do-list').slimscroll({
                height: '300px',
                wheelStep: 35
            });
        }
        /*==Nice Scroll ==*/
        if ($.fn.niceScroll) {


            $(".leftside-navigation").niceScroll({
                cursorcolor: "#1FB5AD",
                cursorborder: "0px solid #fff",
                cursorborderradius: "5px",
                background:"rgba(255, 255, 255, 0.1)",
                cursorwidth: "9px"
            });

            $(".leftside-navigation").getNiceScroll().resize();
            if ($('#sidebar').hasClass('hide-left-bar')) {
                $(".leftside-navigation").getNiceScroll().hide();
            }
            $(".leftside-navigation").getNiceScroll().show();

            $(".right-stat-bar").niceScroll({
                cursorcolor: "#1FB5AD",
                cursorborder: "0px solid #fff",
                cursorborderradius: "5px",
                background:"rgba(255, 255, 255, 0.1)",
                cursorwidth: "9px"
            });

        }

        /*==Easy Pie chart ==*/
        if ($.fn.easyPieChart) {

            $('.notification-pie-chart').easyPieChart({
                onStep: function (from, to, percent) {
                    $(this.el).find('.percent').text(Math.round(percent));
                },
                barColor: "#39b6ac",
                lineWidth: 3,
                size: 50,
                trackColor: "#efefef",
                scaleColor: "#cccccc"

            });

            $('.pc-epie-chart').easyPieChart({
                onStep: function(from, to, percent) {
                    $(this.el).find('.percent').text(Math.round(percent));
                },
                barColor: "#5bc6f0",
                lineWidth: 3,
                size:50,
                trackColor: "#32323a",
                scaleColor:"#cccccc"

            });

        }

        /*== SPARKLINE==*/
        if ($.fn.sparkline) {

            $(".d-pending").sparkline([3, 1], {
                type: 'pie',
                width: '40',
                height: '40',
                sliceColors: ['#e1e1e1', '#8175c9']
            });



            var sparkLine = function () {
                $(".sparkline").each(function () {
                    var $data = $(this).data();
                    ($data.type == 'pie') && $data.sliceColors && ($data.sliceColors = eval($data.sliceColors));
                    ($data.type == 'bar') && $data.stackedBarColor && ($data.stackedBarColor = eval($data.stackedBarColor));

                    $data.valueSpots = {
                        '0:': $data.spotColor
                    };
                    $(this).sparkline($data.data || "html", $data);


                    if ($(this).data("compositeData")) {
                        $spdata.composite = true;
                        $spdata.minSpotColor = false;
                        $spdata.maxSpotColor = false;
                        $spdata.valueSpots = {
                            '0:': $spdata.spotColor
                        };
                        $(this).sparkline($(this).data("compositeData"), $spdata);
                    };
                });
            };

            var sparkResize;
            $(window).resize(function (e) {
                clearTimeout(sparkResize);
                sparkResize = setTimeout(function () {
                    sparkLine(true)
                }, 500);
            });
            sparkLine(false);



        }



        if ($.fn.plot) {
            var datatPie = [30, 50];
            // DONUT
            $.plot($(".target-sell"), datatPie, {
                series: {
                    pie: {
                        innerRadius: 0.6,
                        show: true,
                        label: {
                            show: false

                        },
                        stroke: {
                            width: .01,
                            color: '#fff'

                        }
                    }




                },

                legend: {
                    show: true
                },
                grid: {
                    hoverable: true,
                    clickable: true
                },

                colors: ["#ff6d60", "#cbcdd9"]
            });
        }



        /*==Collapsible==*/
        $('.widget-head').click(function (e) {
            var widgetElem = $(this).children('.widget-collapse').children('i');

            $(this)
                .next('.widget-container')
                .slideToggle('slow');
            if ($(widgetElem).hasClass('ico-minus')) {
                $(widgetElem).removeClass('ico-minus');
                $(widgetElem).addClass('ico-plus');
            } else {
                $(widgetElem).removeClass('ico-plus');
                $(widgetElem).addClass('ico-minus');
            }
            e.preventDefault();
        });




        /*==Sidebar Toggle==*/

        $(".leftside-navigation .sub-menu > a").click(function () {
            var o = ($(this).offset());
            var diff = 80 - o.top;
            if (diff > 0)
                $(".leftside-navigation").scrollTo("-=" + Math.abs(diff), 500);
            else
                $(".leftside-navigation").scrollTo("+=" + Math.abs(diff), 500);
        });



        $('.sidebar-toggle-box .fa-bars').click(function (e) {

            $(".leftside-navigation").niceScroll({
                cursorcolor: "#1FB5AD",
                cursorborder: "0px solid #fff",
                cursorborderradius: "0px",
                cursorwidth: "3px"
            });

            $('#sidebar').toggleClass('hide-left-bar');
            if ($('#sidebar').hasClass('hide-left-bar')) {
                $(".leftside-navigation").getNiceScroll().hide();
            }
            $(".leftside-navigation").getNiceScroll().show();
            $('#main-content').toggleClass('merge-left');
            e.stopPropagation();
            if ($('#container').hasClass('open-right-panel')) {
                $('#container').removeClass('open-right-panel')
            }
            if ($('.right-sidebar').hasClass('open-right-bar')) {
                $('.right-sidebar').removeClass('open-right-bar')
            }

            if ($('.header').hasClass('merge-header')) {
                $('.header').removeClass('merge-header')
            }


        });
        $('.toggle-right-box .fa-bars').click(function (e) {
            $('#container').toggleClass('open-right-panel');
            $('.right-sidebar').toggleClass('open-right-bar');
            $('.header').toggleClass('merge-header');

            e.stopPropagation();
        });

        $('.header,#main-content,#sidebar').click(function () {
            if ($('#container').hasClass('open-right-panel')) {
                $('#container').removeClass('open-right-panel')
            }
            if ($('.right-sidebar').hasClass('open-right-bar')) {
                $('.right-sidebar').removeClass('open-right-bar')
            }

            if ($('.header').hasClass('merge-header')) {
                $('.header').removeClass('merge-header')
            }


        });


        $('.panel .tools .fa').click(function () {
            var el = $(this).parents(".panel").children(".panel-body");
            if ($(this).hasClass("fa-chevron-down")) {
                $(this).removeClass("fa-chevron-down").addClass("fa-chevron-up");
                el.slideUp(200);
            } else {
                $(this).removeClass("fa-chevron-up").addClass("fa-chevron-down");
                el.slideDown(200); }
        });



        $('.panel .tools .fa-times').click(function () {
            $(this).parents(".panel").parent().remove();
        });


    });


})(jQuery);

$(document).ready(function(){
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
    $('ul.sidebar-menu li a').each(function(){  
        var currentPage = this.href.substring(this.href.lastIndexOf('/')+1);

        if (activePage == currentPage) {
            $(this).parent().addClass('active'); 
        } 
    });
});