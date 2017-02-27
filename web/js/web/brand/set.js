;
var brand_set_ops = {
    init:function(){
        this.eventBind();
    },
    eventBind:function(){
        $(".wrap_brand_set .save").click( function(){
            var btn_target = $(this);
            if( btn_target.hasClass("disabled") ){
                alert("正在处理!!请不要重复提交~~");
                return;
            }

            var name = $(".wrap_brand_set input[name=name]").val();
            var mobile = $(".wrap_brand_set input[name=mobile]").val();
            var address = $(".wrap_brand_set input[name=address]").val();
            var description = $(".wrap_brand_set textarea[name=description]").val();
            if( name.length < 1 ){
                alert("请输入符合规范的品牌名称~~");
                return;
            }

            if( mobile.length < 1 ){
                alert("请输入符合规范的手机号码~~");
                return;
            }

            if( address.length < 1  ){
                alert("请输入符合规范的地址~~");
                return;
            }

            if( description.length < 1  ){
                alert("请输入符合规范的品牌介绍~~");
                return;
            }

            btn_target.addClass("disabled");

            var data = {
                name:name,
                mobile:mobile,
                address:address,
                description:description
            };

            $.ajax({
                url:common_ops.buildWebUrl("/brand/set") ,
                type:'POST',
                data:data,
                dataType:'json',
                success:function(res){
                    btn_target.removeClass("disabled");
                    alert( res.msg );
                    if( res.code == 200 ){
                        window.location.href = common_ops.buildWebUrl("/brand/info");
                    }
                }
            });
        });
    }
};

$(document).ready( function(){
    brand_set_ops.init();
});