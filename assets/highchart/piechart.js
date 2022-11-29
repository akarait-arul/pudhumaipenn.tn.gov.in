function generatePieChart(result) {
    if (!result) {
        $("#registration-pie").html("<b>Data Not Found</b>");
        return false;
    }
    var _pie_data = [];
    $.each(pie_data, function (index, value) {
        _pie_data.push({
            name: value.name,
            y: parseInt(value.y)
        });
    });
    Highcharts.chart('registration-pie', {
        credits: {
            enabled: false
        },
        chart: {
            type: 'pie'
        },
        title: {
            text: ' '
        },
        accessibility: {
            announceNewData: {
                enabled: true
            },
            point: {
                valueSuffix: '%'
            }
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true
                },
                showInLegend: true
            },
            series: {
                dataLabels: {
                    enabled: true,
                    format: '{point.name}: {point.y}'
                }
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            //pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b><br/>'
        },

        series: [
            {
                innerSize: '75%',
                name: "Institution Type",
                colorByPoint: true,
                data: _pie_data,
            }
        ]
    });
}