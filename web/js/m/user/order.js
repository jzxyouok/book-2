;
var user_order_ops = {
    init:function(){
        this.eventBind();
    },
    eventBind:function(){
        $(".order_box").click(function () {
            $(this).find(".order_list").toggle();
        });

        $(".close").click( function() {
            var btn_target = $(this);
            if( btn_target.hasClass("disabled") ){
                alert("正在处理!!请不要重复提交");
                return;
            }
            $.ajax({
                url:common_ops.buildMUrl("/order/ops"),
                type:'POST',
                data:{
                    act:'close',
                    id:btn_target.attr("data")
                },
                dataType:'json',
                success:function( res ){
                    btn_target.removeClass("disabled");
                    alert( res.msg );
                    if( res.code == 200 ){
                        window.location.href = window.location.href;
                    }
                }
            });
        });
    }
};

$(document).ready( function(){
    user_order_ops.init();
});
