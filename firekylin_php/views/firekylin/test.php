<!DOCTYPE html>
<html>
<head>
    <meta charset=" utf-8">
    <title>侧边栏展开收缩</title>
    <style type="text/css">
        #thediv{
            width:150px;
            height:200px;
            background:#999999;
            position:absolute;
            left:-150px;//div初始位置
        }
        span{
            width:20px;
            height:100px;
            line-height:23px;
            background:#09C;
            position:absolute;
            right:-20px;
            top:70px;
        }
    </style>
    <script>
        window.onload=function(){
            var odiv=document.getElementById('thediv');
            odiv.onmousedown = function()
            {
                if(odiv.offsetLeft == 0)
                {
                    startmove(-150, -10);
                }
                else
                {
                    startmove(0, 10);
                }

            }

            var timer=null;
            function startmove(target,speed){
                var odiv=document.getElementById('thediv');
                clearInterval(timer);
                timer=setInterval(function (){
                    if(odiv.offsetLeft==target){
                        clearInterval(timer);
                    }
                    else{
                        odiv.style.left=odiv.offsetLeft+speed+'px';
                    }
                },30)
            }
    </script>
</head>
<body>
<div id="thediv">
    <span>侧边栏展开收缩</span>
</div>
</body>
</html>