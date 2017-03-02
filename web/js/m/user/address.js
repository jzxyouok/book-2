;
$(".default_set").click(function () {
    $(".default_set").removeClass("aon");
    $(this).addClass("aon");
});
$(".del").click(function () {
    $(this).parent().parent().remove();
});