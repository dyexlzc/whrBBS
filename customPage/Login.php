<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="maximum-scale=1.0,minimum-scale=1.0,user-scalable=0,width=device-width,initial-scale=1.0" />
        <meta name="format-detection" content="telephone=no,email=no,date=no,address=no">
        <title>登录</title>
        <script src="../view/js/jquery-3.1.0.js" type="text/javascript" charset="utf-8"></script>
        <script src="https://cdn.jsdelivr.net/npm/vue@2.6.9/dist/vue.js"></script>
        <script type="text/javascript" src="aui/script/api.js"></script>
        <script src="../view/js/xiuno.js" type="text/javascript" charset="utf-8"></script>
        <script src="../view/js/bbs.js" type="text/javascript" charset="utf-8"></script>
        <script src="../view/js/md5.js" type="text/javascript" charset="utf-8"></script>
        <link rel="stylesheet" type="text/css" href="./aui/css/aui.css" />
        <style>
        body {
            background-image: url('custom_img/Login_bg.png');
            background-repeat: no-repeat;
            background-color: rgba(189,204,212,1);
            background-position: center 0;
            background-attachment:fixed;
        }
        </style>
    </head>

    
    <body >
        <header class="aui-bar aui-bar-nav" style="background-color:rgba(53,63,73,1);padding:10px">
            <a class="aui-pull-left aui-btn ">
                DASHBOARD
            </a>
            <div class="aui-title">
                <script>
                    
                </script>
                <div id="dataaa"></div>
            </div>
            <a class="aui-pull-right aui-btn ">
                <span class="aui-iconfont aui-icon-search"></span>
            </a>
        </header>
        <div class="aui-content aui-margin-b-15" style="display:flex;justify-content:center;position:relative;top:75px">
            <form class="" id="form1">
                <img src="custom_img/WHRlogo.png">
                <br/>
                <br/>
                <ul class="aui-list aui-form-list" style="background-color:rgba(0,0,0,0);">
                    
                    <li class="aui-list-item">
                        <div class="aui-list-item-inner">
                            
                            <div class="aui-list-item-input">
                                 <input type="text"  placeholder="  请输你的WHR账号..." name="email" style="background-color:rgba(255,255,255,1)">
                            </div>
                            <div class="aui-list-item-label-icon">
                                <i class="aui-iconfont aui-icon-my"></i>
                            </div>
                        </div>
                    </li>
                    <br>
                    <li class="aui-list-item">
                        <div class="aui-list-item-inner">
                            <div class="aui-list-item-input">
                                <input type="password" placeholder=" 请输入密码" name="password" style="background-color:rgba(255,255,255,1)">
                            </div>
                            <div class="aui-list-item-label-icon">
                                <i class="aui-iconfont aui-icon-lock"></i>
                            </div>
                        </div>
                    </li>
                    <br/>
                    <br/>

                    <li class="aui-list-item center" >
                       
                            <div class="aui-btn aui-btn-warning aui-btn-block" @click="btnSubmit">登&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;录</div>
                        
                        
                    </li>
                </ul>
            </form>
        </div>
        <script>
        var myDate = new Date(); 
        var month = myDate.getMonth()+1;       //获取当前月份(1-12)
        var day = myDate.getDate();        //获取当前日(1-31)
        //var referer = '<?php echo $_SERVER['HTTP_REFERER'];?>';
        $("#dataaa").text(month+"-"+day);  //修改日期
        var postdata;
        var v_form = new Vue({
            el: "#form1",
            methods: {
                btnSubmit: function () {
                    postdata = $('#form1').serializeObject();
                    postdata.password = $.md5(postdata.password);
                    console.log(postdata);

                    $.xpost("http://whrhost.tk/whr/bbs/?user-login.htm?ajax=1",
                        postdata, function (code, message) {
                        console.log(message);
                        if(code == 0) {
                			alert(message);
                			window.location="http://whrhost.tk/whr/bbs/custompage/index.html";//暂时这样吧。。。 
                		} else if(xn.is_number(code)) {
                			alert(message);
                			//jsubmit.button('reset');
                		} else {
                			jform.find('[name="'+code+'"]').alert(message).focus();
                			//jsubmit.button('reset');
                		}
                    });
                }
            }
        });
        </script>
    </body>

</html>