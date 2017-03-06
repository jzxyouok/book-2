;
var user_order_ops = {
    init:function(){
        this.eventBind();
    },
    eventBind:function(){
        $(".order_box").click(function () {
            $(this).find(".order_list").toggle();
        });
    }
};

$(document).ready( function(){
    user_order_ops.init();
});
