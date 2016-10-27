<?php
/**
 * Created by PhpStorm.
 * User: bingochen
 * Date: 2016/10/27
 * Time: 10:17
 */
use yii\helpers\Html;
?>
    <script>
        function sidebarFold(fold){
            if(fold){
                $('.sidebar').animate({left:"-215px"},750).attr("data-value","fold");
                $('.main-content').animate({paddingLeft:"25px"},750);
            }
            else{
                $('.main-content').animate({paddingLeft:"240px"},750);
                $('.sidebar').animate({left:"0px"},750).attr("data-value","unfold");
            }
        }

        $(function(){
            $('.resize-sidebar').click(function(){
                if($('.sidebar').attr("data-value")=="fold")
                    sidebarFold(false);
                else
                    sidebarFold(true);
            }).hover(function(){
                $('.sidearrow').animate({backgroundColor: 'rgba(255,255,255,0.1)'},250);
            }, function(){
                $('.sidearrow').animate({backgroundColor: 'rgba(255,255,255,0)'},250);
            });
            $('.sidebar-btn').hover(function(){
                $(this).animate({backgroundColor: 'rgba(176,196,222,0.5)', fontSize:"20px"},250);
            }, function(){
                $(this).animate({backgroundColor: 'rgba(176,196,222,0)', fontSize:"16px"},250);
            }).click(function(){
                if($(this).attr('href'))
                    window.location.href = $(this).attr('href');
            });
        });
    </script>

    <style>
        .main-content{
            padding-left: 240px;
        }
        .sidebar{
            position: fixed;
            width: 240px;
            height: 100%;
            min-height: 300px;
            background-image: linear-gradient(270deg,LightSkyBlue,MediumSlateBlue);
            color: white;
            left: 0;
            top: 0;
            padding-top: 50px;
            z-index: 1000;
        }
        .sidebuttons{
            padding-top: 20px;
            padding-left: 10px;
            width: 215px;
            float: left;
            height: 100%;
        }
        .sidearrow{
            width: 25px;
            float: right;
            height: 100%;
        }
        .sidearrow.up{
            height:45%;
        }
        .sidebar-btn{
            width: 100%;
            font-size: 16px;
            padding: 5px 15px;
            text-align: center;
            margin: 10px 0;
            border-radius:5px;
        }
        .sidebar-text:hover{
            cursor: pointer;
        }
        .sidebar-img{
            padding-left: 10px;
        }
        .verify-sign{
            color: #00df00;
        }
    </style>
    <div class="sidebar" data-value="fold">
        <div class="sidebuttons">
            <div class="sidebar-btn sidebar-text" href="/account/"><?="342"?><?php if(1):?>&nbsp;<span class="glyphicon glyphicon-leaf verify-sign"></span><?php endif?></div>
            <div class="sidebar-btn sidebar-text">Notification&nbsp;<span class="glyphicon glyphicon-envelope"></span></div>
            <div class="sidebar-btn sidebar-text" href="/course/composer/index">Composer&nbsp;<span class="glyphicon glyphicon-edit"></span></div>
            <div class="sidebar-btn sidebar-text">Discussion&nbsp;<span class="glyphicon glyphicon-comment"></span></div>
            <div class="sidebar-btn sidebar-text">Materials&nbsp;<span class="glyphicon glyphicon-book"></span></div>
            <div class="sidebar-btn sidebar-text" href="/course/wiki/index">Wiki&nbsp;<span class="glyphicon glyphicon-tags"></span></div>
        </div>
        <div class="sidearrow">
            <div class="sidearrow up"></div>
            <div class="glyphicon glyphicon-resize-small resize-sidebar sidebar-text" aria-hidden="true" style="font-size:23px; margin-top: 45%; margin-bottom: 45%"></div>
        </div>
    </div>
<?= Html::jsFile("@web/js/sidebar.js"); ?>