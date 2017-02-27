;
function SmoothlyMenu() {
    if (!$('body').hasClass('mini-navbar') || $('body').hasClass('body-small')) {
        // Hide menu in order to smoothly turn on when maximize menu
        $('#side-menu').hide();
        // For smoothly turn on menu
        setTimeout(
            function () {
                $('#side-menu').fadeIn(400);
            }, 200);
    } else if ($('body').hasClass('fixed-sidebar')) {
        $('#side-menu').hide();
        setTimeout(
            function () {
                $('#side-menu').fadeIn(400);
            }, 100);
    } else {
        // Remove all inline style from jquery fadeIn function to reset menu state
        $('#side-menu').removeAttr('style');
    }
}

// Full height of sidebar
function fix_height() {
    var heightWithoutNavbar = $("body > #wrapper").height() - 61;
    $(".sidebard-panel").css("min-height", heightWithoutNavbar + "px");

    var navbarHeigh = $('nav.navbar-default').height();
    var wrapperHeigh = $('#page-wrapper').height();

    if (navbarHeigh > wrapperHeigh) {
        $('#page-wrapper').css("min-height", navbarHeigh + "px");
    }

    if (navbarHeigh < wrapperHeigh) {
        $('#page-wrapper').css("min-height", $(window).height() + "px");
    }

    if ($('body').hasClass('fixed-nav')) {
        if (navbarHeigh > wrapperHeigh) {
            $('#page-wrapper').css("min-height", navbarHeigh - 60 + "px");
        } else {
            $('#page-wrapper').css("min-height", $(window).height() - 60 + "px");
        }
    }

}

var common_ops = {
    init:function(){
        this.eventBind();
        this.setMenuIconHighLight();
    },
    eventBind:function(){
        $('.navbar-minimalize').click(function () {
            $("body").toggleClass("mini-navbar");
            SmoothlyMenu();
        });

        $(window).bind("load resize scroll", function () {
            if (!$("body").hasClass('body-small')) {
                fix_height();
            }
        });
    },
    setMenuIconHighLight:function(){
        if( $("#side-menu li").size() < 1 ){
            return;
        }
        var pathname = window.location.pathname;
        var nav_name = null;

        if(  pathname.indexOf("/web/dashboard") > -1 || pathname == "/web" || pathname == "/web/" ){
            nav_name = "dashboard";
        }

        if(  pathname.indexOf("/web/account") > -1  ){
            nav_name = "account";
        }

        if(  pathname.indexOf("/web/brand") > -1  ){
            nav_name = "brand";
        }

        if(  pathname.indexOf("/web/book") > -1  ){
            nav_name = "book";
        }

        if(  pathname.indexOf("/web/member") > -1  ){
            nav_name = "member";
        }

        if(  pathname.indexOf("/web/market") > -1  ){
            nav_name = "market";
        }

        if(  pathname.indexOf("/web/finance") > -1  ){
            nav_name = "finance";
        }

        if(  pathname.indexOf("/web/stat") > -1  ){
            nav_name = "stat";
        }

        if( nav_name == null ){
            return;
        }

        $("#side-menu li."+nav_name).addClass("active");
    },
    buildWebUrl:function( path ,params){
        var url =   "/web" + path;
        var _paramUrl = '';
        if( params ){
            _paramUrl = Object.keys(params).map(function(k) {
                return [encodeURIComponent(k), encodeURIComponent(params[k])].join("=");
            }).join('&');
            _paramUrl = "?"+_paramUrl;
        }
        return url + _paramUrl

    },
    alert:function( msg ){
        layer.alert( msg );
    },
    confirm:function(){
        layer.confirm('您是如何看待前端开发？', {
            btn: ['重要','奇葩'] //按钮
        }, function(){
            layer.msg('的确很重要', {icon: 1});
        }, function(){
            layer.msg('也可以这样', {
                time: 20000, //20s后自动关闭
                btn: ['明白了', '知道了']
            });
        });
    },
    tip:function( msg,target ){
        layer.tips( msg, target, {
            tips: [ 3, '#e5004f']
        });
    }
};

$(document).ready( function() {
    common_ops.init();
});


// 对Date的扩展，将 Date 转化为指定格式的String
// 月(M)、日(d)、小时(h)、分(m)、秒(s)、季度(q) 可以用 1-2 个占位符，
// 年(y)可以用 1-4 个占位符，毫秒(S)只能用 1 个占位符(是 1-3 位的数字)
// 例子：
// (new Date()).Format("yyyy-MM-dd hh:mm:ss.S") ==> 2006-07-02 08:09:04.423
// (new Date()).Format("yyyy-M-d h:m:s.S")      ==> 2006-7-2 8:9:4.18
Date.prototype.Format = function(fmt)
{ //author: meizz
    var o = {
        "M+" : this.getMonth()+1,                 //月份
        "d+" : this.getDate(),                    //日
        "h+" : this.getHours(),                   //小时
        "m+" : this.getMinutes(),                 //分
        "s+" : this.getSeconds(),                 //秒
        "q+" : Math.floor((this.getMonth()+3)/3), //季度
        "S"  : this.getMilliseconds()             //毫秒
    };
    if(/(y+)/.test(fmt))
        fmt=fmt.replace(RegExp.$1, (this.getFullYear()+"").substr(4 - RegExp.$1.length));
    for(var k in o)
        if(new RegExp("("+ k +")").test(fmt))
            fmt = fmt.replace(RegExp.$1, (RegExp.$1.length==1) ? (o[k]) : (("00"+ o[k]).substr((""+ o[k]).length)));
    return fmt;
};