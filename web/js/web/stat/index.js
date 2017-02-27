;
var stat_index_ops = {
    init:function(){
        this.eventBind();
        this.datetimepickerComponent();
    },
    eventBind:function(){
        $('#container').highcharts({
            chart: {
                type: 'spline'
            },
            exporting: {
                enabled: false
            },
            legend: {
                enabled:true
            },
            credits:{
                enabled:false
            },
            title: {
                text: '日营收报表'
            },
            subtitle: {
                text: '日统计'
            },
            xAxis: {
                categories: [
                    '2017-02-01', '2017-02-02', '2017-02-03', '2017-02-04', '2017-02-05', '2017-02-06', '2017-02-07', '2017-02-08', '2017-02-09', '2017-02-10', '2017-02-11', '2017-02-12']
            },
            yAxis: {
                title: {
                    text: '金额(元)'
                },
                min: 0
            },
            tooltip: {
                formatter: function(){
                    var s = '<b>' + this.x + '</b><br/>营收总金额：' + this.y;
                    return s;
                }
            },
            plotOptions: {
                spline: {
                    marker: {
                        enabled: true
                    }
                }
            },
            series: [{
                name: '日营收报表',
                data: [ 1,2,3,4,5,6,7,8,9,10,11,12]
            }]
        });
    },
    datetimepickerComponent:function(){
        var that = this;
        $.datetimepicker.setLocale('zh');
        params = {
            scrollInput: false,
            scrollMonth: false,
            scrollTime: false,
            dayOfWeekStart: 1,
            lang: 'zh',
            todayButton: true,//回到今天
            defaultSelect: true,
            defaultDate: new Date().Format('yyyy-MM-dd'),
            format: 'Y-m-d',//格式化显示
            timepicker: false
        };
        $('#search_form_wrap input[name=date_from]').datetimepicker(params);
        $('#search_form_wrap input[name=date_to]').datetimepicker(params);

    }
};

$(document).ready( function(){
    stat_index_ops.init();
});
