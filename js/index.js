/**
 * Created by 92 74 on 2017/2/13.
 */
window.onload=function(){
    var more=document.getElementById('learn_more');
    var audio=document.getElementById('audio');
    var muisc=document.getElementById('voice_control');
    addEvent(more,'click',function(){
        var timer=null;
        var index=document.getElementById('index');
        audio.pause();
        muisc.src="images/quiet.png";
        timer=setInterval(function(){
            var osTop=document.documentElement.scrollTop||document.body.scrollTop;
            document.documentElement.scrollTop=document.body.scrollTop+=20;
            if(osTop>=index.offsetHeight){
                clearInterval(timer);
            }
        },10);
    });
    
    addEvent(muisc,'click',function () {
        if(audio.paused){
            audio.play();
            muisc.src="images/voice.png";
        }else{
            audio.pause();
            muisc.src="images/quiet.png";
        }
    });
}
