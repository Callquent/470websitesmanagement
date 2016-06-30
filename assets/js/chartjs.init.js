/**
 * Created by westilian on 1/19/14.
 */

(function(){
    var t;
    function size(animate){
        if (animate == undefined){
            animate = false;
        }
        clearTimeout(t);
        t = setTimeout(function(){
            $("canvas").each(function(i,el){
                $(el).attr({
                    "width":$(el).parent().width(),
                    "height":$(el).parent().outerHeight()
                });
            });
            redraw(animate);
            var m = 0;
            $(".chartJS").height("");
            $(".chartJS").each(function(i,el){ m = Math.max(m,$(el).height()); });
            $(".chartJS").height(m);
        }, 30);
    }
    $(window).on('resize', function(){ size(false); });


    function redraw(animation){
        var options = {};
        if (!animation){
            options.animation = false;
        } else {
            options.animation = true;
        }


        var barChartData = {
            labels : ["January","February","March","April","May","June","July"],
            datasets : [
                {
                    fillColor : "#E67A77",
                    strokeColor : "#E67A77",
                    data : [65,59,90,81,56,55,40]
                },
                {
                    fillColor : "#79D1CF",
                    strokeColor : "#79D1CF",
                    data : [28,48,40,19,96,27,100]
                }
            ]

        }

        /*var myLine = new Chart(document.getElementById("bar-chart-js").getContext("2d")).Bar(barChartData);*/

        if (document.getElementById("line-chart-positiontracking")) {
            var data = {
                labels: ["January", "February", "March", "April", "May", "June", "July"],
                datasets: [
                    {
                        label: "My First dataset",
                        fill: false,
                        lineTension: 0.1,
                        backgroundColor: "rgba(75,192,192,0.4)",
                        borderColor: "rgba(75,192,192,1)",
                        borderCapStyle: 'butt',
                        borderDash: [],
                        borderDashOffset: 0.0,
                        borderJoinStyle: 'miter',
                        pointBorderColor: "rgba(75,192,192,1)",
                        pointBackgroundColor: "#fff",
                        pointBorderWidth: 1,
                        pointHoverRadius: 5,
                        pointHoverBackgroundColor: "rgba(75,192,192,1)",
                        pointHoverBorderColor: "rgba(220,220,220,1)",
                        pointHoverBorderWidth: 2,
                        pointRadius: 1,
                        pointHitRadius: 10,
                        data: [65, 59, 80, 81, 56, 55, 40],
                    }
                ]
            };

            var ctx = document.getElementById("line-chart-positiontracking").getContext("2d");
            var myPie = new Chart(ctx,{ type: 'line', data: data });            
        }


        var options ={
            tooltips: {
                callbacks: {
                    label: function(tooltipItem, data) {
                      var dataset = data.datasets[tooltipItem.datasetIndex];
                      var label = data.labels[tooltipItem.index];
                      var total = dataset.data.reduce(function(previousValue, currentValue, currentIndex, array) {
                        return previousValue + currentValue;
                      });
                      var currentValue = dataset.data[tooltipItem.index];
                      var precentage = currentValue;
                      return label + ': ' + precentage + '%';
                    }
                }
            }
        };

        var ctx = document.getElementById("pie-chart-language").getContext("2d");
        var myPie = new Chart(ctx,{ type: 'pie', data: pieDataLanguage, options: options });

        var ctx = document.getElementById("pie-chart-category").getContext("2d");
        var myPie = new Chart(ctx,{ type: 'pie', data: pieDataCategory, options: options });


        var donutData = [
            {
                value: 30,
                color:"#E67A77"
            },
            {
                value : 50,
                color : "#D9DD81"
            },
            {
                value : 100,
                color : "#79D1CF"
            },
            {
                value : 40,
                color : "#95D7BB"
            },
            {
                value : 120,
                color : "#4D5360"
            }

        ]
        /*var myDonut = new Chart(document.getElementById("donut-chart-js").getContext("2d")).Doughnut(donutData);*/
    }




    size(true);

}());
