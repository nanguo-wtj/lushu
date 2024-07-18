<?php include(dirname(__FILE__,2) . '/layout/header.php');?>

<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>登录 | <?=$g_sys_name?></title>
    <!-- Meta tag Keywords -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta charset="UTF-8" />
    <meta name="keywords"
          content="Report Login Form Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
    <!-- //Meta tag Keywords -->
    <!--/Style-CSS -->
    <link rel="stylesheet" href="<?=$_static?>/user/style.css" type="text/css" media="all" />
    <!--//Style-CSS -->

    <link rel="stylesheet" href="<?=$_static?>/user/font-awesome.min.css" type="text/css" media="all">
    <script src="<?=$_static?>/vue/vue.js"></script>
    <script src="<?=$_static?>/vue/axios.js"></script>
    <script src="<?=$_static?>/user/open.js"></script>
</head>

<body>

<!-- form section start -->
<section id="app" class="w3l-hotair-form">
    <h1><?=$g_sys_name?></h1>
    <div class="container">
        <div class="hide_layer">
            <iframe id="frm" name="frm" src="" frameborder="0" scrolling="no" width="0" height="0"></iframe>
        </div>
        <div class="workinghny-form-grid">
            <div class="main-hotair">
                <div class="content-wthree">
                    <h2>账号登录</h2>
                    <div style="position: relative" class="form-validate"    id="loginFrom">
                        <input type="text" class="text" name="account" id="account" placeholder="输入账号..." v-model="account" required="" autofocus>
                        <input type="password" class="password" name="password" id="password"  placeholder="输入密码..." v-model="password"   required="" autofocus>

                        <button class="btn" type="button" v-on:click="login">登录</button>
                    </div>
                    <p style="color:red" id='err'></p>
                    <p class="account"> 由<a href="http://www.cloota.com" target="_blank">云驴通&reg</a>提供软件技术服务</p>
                </div>
                <div class="w3l_form align-self">
                    <div class="left_grid_info">
                        <img src="<?=$_static?>/images/1.png" alt="" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
        <!-- //form -->
    </div>
    <!-- copyright-->
    <div class="copyright text-center">
        <p class="copy-footer-29"><a href="http://www.cloota.com" target="_blank">云驴通&reg</a></p>
    </div>
    <!-- //copyright-->
</section>
<!-- //form section start -->
</body>

<script>

    new Vue({
        el: '#app',
        data: {
            account:'',
            password:''

        },
        methods: {
            login: function () {
                let _that   =   this;
                if (!_that.account || !_that.password) {
                    layer.msg("请填写账户和密码!",{icon: 0});
                    return false;
                }
                let dateArr = (new Date()).toLocaleDateString().split('/')
                dateArr[1] = dateArr[1] < 10 ? '0'+ dateArr[1] : dateArr[1]
                dateArr[2] = dateArr[2] < 10 ? '0'+ dateArr[2] : dateArr[2]
                const str = 'CLOOTA_ADMIN' + dateArr.join('')
                const md5Str = md5(str).toUpperCase()
                const data    =   {
                    hash: md5Str,
                    account:_that.account,
                    password:_that.password
                }
                const url   =   "<?=$_Post_url?>?cmd=login";
                post_url(url,data,true).then(res => {
                    if(res.data.role == 3){
                        over_Time_url('/lushu/',1000);
                    }else {
                        over_Time_url('/console/select.html',1000);
                    }
                },error=>{
                    _that.password = '';
                });
            }
        }
    })
    $('.LOADING').css('display','none')

</script>


</html>

