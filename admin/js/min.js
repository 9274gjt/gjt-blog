/**
 * Created by 92 74 on 2017/2/11.
 */
window.onload=function () {
    var minimenu=document.getElementById('minimenu');
    var minisiderbar=document.getElementById('minisidebar');
    addEvent(minimenu,'click',function () {
        if(minisiderbar.style.left=="0px"){
            startMove(-150,minisiderbar);
        }else{
            startMove(0,minisiderbar);
        }
    });
}
var timer=null;
function startMove(iTarget,minisiderbar){
    clearInterval(timer);
    timer=setInterval(function(){
        var speed=(iTarget-minisiderbar.offsetLeft)/10;
        speed=speed>0?Math.ceil(speed):Math.floor(speed);
        if(minisiderbar.offsetLeft==iTarget){
            clearInterval(timer);
        }else
        {
            minisiderbar.style.left=minisiderbar.offsetLeft+speed+'px';
        }
    },30)
}

function addEvent(obj,type,handle) {
    try {  // Chrome、FireFox、Opera、Safari、IE9.0及其以上版本
        obj.addEventListener(type, handle, false);
    } catch (e) {
        try {  // IE8.0及其以下版本
            obj.attachEvent('on' + type, handle);
        } catch (e) {  // 早期浏览器
            obj['on' + type]=handle;
        }
    }
}