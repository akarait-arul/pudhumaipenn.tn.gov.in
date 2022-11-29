function generateColoumChartinst(result, gheading) {
    if (!result) {
        $("#registration-chart-inst").html("<b>Data Not Found</b>");
        return false;
    }
    var _xaxis_data = [];
    var _total_app_recd_data = [];
    var _total_pending_data = [];
    var _auto_approve_data = [];

    var _series_data = [];

    $.each(result, function (index, value) {
        _xaxis_data.push(value.institution_type);
        _total_app_recd_data.push(parseInt(value.total_app_recd));
        _total_pending_data.push(parseInt(value.total_pending));
        _auto_approve_data.push(parseInt(value.total_app_auto_app_allstage));
    });
    _series_data.push({type: 'column', color: 'orange', name: "Total Application", data: _total_app_recd_data});
    _series_data.push({type: 'column', color: 'red', name: "Total Approval Pending", data: _total_pending_data});
    _series_data.push({type: 'line', color: 'green', name: "Total Auto Approved", data: _auto_approve_data});

    Highcharts.chart('registration-chart-inst', {
         chart: {
            style: {
                fontFamily: 'Poppins'
            }
        },
        credits: {
            enabled: false
        },
        title: {
            text: gheading
        },
        xAxis: {
            categories: _xaxis_data,
            crosshair: true
        },
        yAxis: {
            title: {
                useHTML: true,
                text: 'No Of Application',
            },
            tickInterval: 2000
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y}</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: _series_data
    });
}