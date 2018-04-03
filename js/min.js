/**
 * Created by 92 74 on 2017/2/12.
 */
var menu=document.getElementById('itemmenu');
var menulist=document.getElementById('menu_list');
addEvent(menu,'click',function () {
    if(menulist.style.display=="block"){
        menulist.style.display="none";
    }else{
        menulist.style.display="block";
    }
})
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