/*===============================================================
 ************************* CHARTS *******************************
 ===============================================================*/
$(window).load(function() {

    /*===============================================================
    ****************chart for filters-ranking :**********************
    ===============================================================*/
    $.getJSON('index.php?module=home&action=chart', {chart: 'filter'}, function(ranking) {
        if(ranking == 'error'){
            $('#ranking-filter-title').html('<span class="fa fa-bar-chart"></span> Classement des meilleurs filtres d\'IFUP');
            $('#jumbotron-bar-chart-filter').replaceWith('<h4>Suite à une erreur nous n\'avons pas pu afficher le classement. Veuillez réessayer</h4>');

        }else{
            //console.log(ranking);
            var labels_chart= [];
            var values_chart= [];
            for(var i in ranking){
                labels_chart[i] = ranking[i]["ifup_filter_name"];
                values_chart[i] = parseInt(ranking[i]['nbrServicesPerFilter']);
            }
            parseInt(values_chart);

            //console.log(labels_chart);
            //console.log(values_chart);
            //console.log(ranking.length);

            if(ranking.length < 10){
                $('#ranking-filter-title').html('<span class="fa fa-bar-chart"></span> Classement des meilleurs filtres d\'IFUP').after('<span class="sub-title">(selon leur fréquence d\'utilisation dans les services)</span>');


            }else{
                $('#ranking-filter-title').html('<span class="fa fa-bar-chart"></span> Classement des 10 meilleurs filtres d\'IFUP').after('<span class="sub-title">(selon leur fréquence d\'utilisation dans les services)</span>');
            }


            var context, data, myBarChart, option_bars;
            Chart.defaults.global.responsive = true;
            context = document.getElementById("jumbotron-bar-chart-filter").getContext("2d");
            option_bars = {
                showScale: true,
                responsive: false,
                scaleShowGridLines: true,
                scaleBeginAtZero: true,
                scaleGridLineColor: "rgba(0,0,0,.05)",
                scaleGridLineWidth: 1,
                scaleShowHorizontalLines: true,
                scaleShowVerticalLines: true,
                barShowStroke: true,
                barStrokeWidth: 1,
                barValueSpacing: 10,
                barDatasetSpacing: 3,
                legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>"
            };
            data = {
                labels: labels_chart,
                datasets: [
                    {
                        label: "Les filtres",
                        fillColor: "rgba(26, 188, 156,0.6)",
                        strokeColor: "#1ABC9C",
                        pointColor: "#1ABC9C",
                        pointStrokeColor: "#fff",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "#1ABC9C",
                        data: values_chart
                    }
                ]
            };
            myBarChart = new Chart(context).Bar(data, option_bars);
        }
    });


    /*===============================================================
     *****************chart for users-ranking :**********************
     ===============================================================*/
    $.getJSON('index.php?module=home&action=chart', {chart: "user"}, function(ranking) {
        if(ranking == 'error'){
            $('#ranking-user-title').html('<span class="fa fa-bar-chart"></span> Classement des meilleurs utilisateurs d\'IFUP');
            $('#jumbotron-bar-chart-user').replaceWith('<h4>Suite à une erreur nous n\'avons pas pu afficher le classement. Veuillez réessayer</h4>');

        }else{
            console.log(ranking);
            var ifup_user_names= [];
            var nbrServicesAsIffer= [];
            var nbrServicesAsUpper= [];
            for(var i in ranking){
                ifup_user_names[i] = ranking[i]["ifup_user_firstname"] + ' ' + ranking[i]["ifup_user_lastname"];
                nbrServicesAsIffer[i] = parseInt(ranking[i]['nbrServicesAsIffer']);
                nbrServicesAsUpper[i] = parseInt(ranking[i]['nbrServicesAsUpper']);
            }

            //console.log(labels_chart);
            //console.log(values_chart);
            //console.log(ranking.length);

            if(ranking.length < 10){
                $('#ranking-user-title').html('<span class="fa fa-bar-chart"></span> Classement des meilleurs utilisateurs d\'IFUP').after('<span class="sub-title">(selon les demandes et prestations effectuées avec succès)</span>');

            }else{
                $('#ranking-user-title').html('<span class="fa fa-bar-chart"></span> Classement des 10 meilleurs utilisateurs d\'IFUP').after('<span class="sub-title">(selon les demandes et prestations effectuées avec succès)</span>');
            }

            var context, data, myBarChart, option_bars;
            Chart.defaults.global.responsive = true;
            context = document.getElementById("jumbotron-bar-chart-user").getContext("2d");
            option_bars = {
                showScale: true,
                responsive: false,
                scaleShowGridLines: true,
                scaleBeginAtZero: true,
                scaleGridLineColor: "rgba(0,0,0,.05)",
                scaleGridLineWidth: 1,
                scaleShowHorizontalLines: true,
                scaleShowVerticalLines: true,
                barShowStroke: true,
                barStrokeWidth: 1,
                barValueSpacing: 10,
                barDatasetSpacing: 3,
                legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>"
            };
            data = {
                labels: ifup_user_names,
                datasets: [
                    {
                        label: "Demandes",
                        fillColor: "rgba(26, 188, 156,0.6)",
                        strokeColor: "#1ABC9C",
                        pointColor: "#1ABC9C",
                        pointStrokeColor: "#fff",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "#1ABC9C",
                        data: nbrServicesAsIffer
                    }, {
                        label: "Prestations",
                        fillColor: "rgba(34, 167, 240,0.6)",
                        strokeColor: "#22A7F0",
                        pointColor: "#22A7F0",
                        pointStrokeColor: "#fff",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "#22A7F0",
                        data: nbrServicesAsUpper
                    }
                ]
            };
            myBarChart = new Chart(context).Bar(data, option_bars);
        }
    });
});