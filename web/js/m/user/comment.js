;
$(function () {
    var literal = document.getElementById('literal');
    var num = 200;
    literal.onkeyup = function () {
        if (this.value.length > 200) {
            alert('超过字数');
            literal.value = literal.value.substring(0, 200);
        }
        else {
            num = 200 - this.value.length;
            $(".feed_box font").text(num);
        }
    }
});