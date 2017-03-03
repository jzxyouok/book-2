;
var product_index_ops = {
    init:function(){
        this.eventBind();
    },
    eventBind:function(){
        var that = this;
        $(".search_header .search_icon").click( function(){
            that.search();
        });

        $(".sort_box .sort_list li a").click( function(){
            that.search();
        });
    },
    search:function(){

    }
};
$(document).ready(function () {
    product_index_ops.init();
});