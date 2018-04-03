/**
 * Created by 92 74 on 2017/2/14.
 */
$(function(){
    $(".praise").click(function () {
        var like=$(this);
        var id=like.attr("rel");
        var ip=like.attr("ip");
        like.fadeOut(300);
        $.ajax({
            type:"POST",
            url:"cores/praise.php",
            data:{
                "ip":ip,
                "id":id
            },
            catch:false,
            success:function (data) {
                 like.find("span").html(data);
                like.fadeIn(300)
            }
        });
      return false;
    })
});