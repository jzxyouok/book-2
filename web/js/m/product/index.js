;
$(document).ready(function () {
    TouchSlide({
        slideCell: "#slideBox",
        titCell: ".hd ul", //开启自动分页 autoPage:true ，此时设置 titCell 为导航元素包裹层
        mainCell: ".bd ul",
        effect: "left",
        autoPage: true,//自动分页
        autoPlay: false //自动播放
    });
    //加减效果 start
    $(".quantity-form .icon_lower").click(function () {
        var num = parseInt($(this).next(".input_quantity").val());
        if (num > 1) {
            $(this).next(".input_quantity").val(num - 1);
        }
    });
    $(".quantity-form .icon_plus").click(function () {
        var num = parseInt($(this).prev(".input_quantity").val());
        var max = parseInt($(this).prev(".input_quantity").attr("max"));
        if (num < max) {
            $(this).prev(".input_quantity").val(num + 1);
        }
    });
    //加减效果 end
    $(".pro_vlist span").click(function () {
        $(this).parent().find("span").removeClass("aon");
        $(this).addClass("aon");
    });
});