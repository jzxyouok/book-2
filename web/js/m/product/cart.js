;
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
//全选效果
$(".cart_fixed input[type='checkbox']").click(function () {
    var name = $(this).attr("name");
    $(".order_pro_box input[name='" + name + "']").prop('checked', $(this).prop('checked'));
});
//删除
$(".delC_icon").click(function () {
    $(this).parent().parent().remove();
});