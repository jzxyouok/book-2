;
var product_cart_ops = {
    init:function(){
        this.eventBind();
    },
    eventBind:function(){
        var that = this;
        $(".quantity-form .icon_lower").click(function () {
            var num = parseInt($(this).next(".input_quantity").val());
            if (num > 1) {
                $(this).next(".input_quantity").val(num - 1);
                that.setItem( $(this).attr("data-book_id"), $(this).next(".input_quantity").val() )
            }

        });

        $(".quantity-form .icon_plus").click(function () {
            var num = parseInt($(this).prev(".input_quantity").val());
            var max = parseInt($(this).prev(".input_quantity").attr("max"));
            if (num < max) {
                $(this).prev(".input_quantity").val(num + 1);
                that.setItem( $(this).attr("data-book_id"), $(this).prev(".input_quantity").val() )
            }

        });

        //全选效果
        $(".cart_fixed input[type='checkbox']").click(function () {
            var name = $(this).attr("name");
            $(".order_pro_box input[name='" + name + "']").prop('checked', $(this).prop('checked'));
        });

        //删除
        $(".delC_icon").click(function () {
            $(this).parent().parent().remove();
            $.ajax({
                url:common_ops.buildMUrl("/product/cart"),
                type:'POST',
                data:{
                    id:$(this).attr("data"),
                    act:'del'
                },
                dataType:'json',
                success:function( res ){
                    if( res.code != 200 ){
                        alert( res.msg );
                    }

                }
            });
        });
    },
    setItem:function( book_id,quantity ){
        $.ajax({
            url:common_ops.buildMUrl("/product/cart"),
            type:'POST',
            data:{
                book_id:book_id,
                quantity:quantity,
                act:'set'
            },
            dataType:'json',
            success:function( res ){
                if( res.code != 200 ){
                    alert( res.msg );
                }

            }
        });
    }
};

$(document).ready( function(){
    product_cart_ops.init();
});

