<?php include(dirname(__FILE__,2) . '/layout/header.php');?>
<body class="appName-account">

<div id="webMain" ref="pageTop">
    <div id="app">
        <div class="">
            <div class="loginBase__pageTosLogin___2o31C">
                <div class="loginBase__panelCont___18gfm">
                    <div class="loginBase__leftPanel___2sq1d">
                        <div class="ant-carousel">
                            <div class="slick-slider slick-initialized" dir="ltr">
                                <div class="slick-list">
                                    <div class="slick-track" style="width:700%;left:-100%">
                                        <div data-index="-1" tabindex="-1" class="slick-slide slick-cloned" aria-hidden="true" style="width:14.285714285714286%">
                                            <div>
                                                <div class="loginBase__loginStep___dg2cW loginBase__step3___hz5FR" tabindex="-1" style="width:100%;display:inline-block"></div>
                                            </div>
                                        </div>
                                        <div data-index="0" class="slick-slide slick-active slick-current" tabindex="-1" aria-hidden="false" style="outline:none;width:14.285714285714286%">
                                            <div>
                                                <div class="loginBase__loginStep___dg2cW loginBase__step1___3jANj" tabindex="-1" style="width:100%;display:inline-block"></div>
                                            </div>
                                        </div>
                                        <div data-index="1" class="slick-slide" tabindex="-1" aria-hidden="true" style="outline:none;width:14.285714285714286%">
                                            <div>
                                                <div class="loginBase__loginStep___dg2cW loginBase__step2___1wMQu" tabindex="-1" style="width:100%;display:inline-block"></div>
                                            </div>
                                        </div>
                                        <div data-index="2" class="slick-slide" tabindex="-1" aria-hidden="true" style="outline:none;width:14.285714285714286%">
                                            <div>
                                                <div class="loginBase__loginStep___dg2cW loginBase__step3___hz5FR" tabindex="-1" style="width:100%;display:inline-block"></div>
                                            </div>
                                        </div>
                                        <div data-index="3" tabindex="-1" class="slick-slide slick-cloned" aria-hidden="true" style="width:14.285714285714286%">
                                            <div>
                                                <div class="loginBase__loginStep___dg2cW loginBase__step1___3jANj"  tabindex="-1" style="width:100%;display:inline-block"></div>
                                            </div>
                                        </div>
                                        <div data-index="4" tabindex="-1" class="slick-slide slick-cloned" aria-hidden="true" style="width:14.285714285714286%">
                                            <div>
                                                <div class="loginBase__loginStep___dg2cW loginBase__step2___1wMQu" tabindex="-1" style="width:100%;display:inline-block"></div>
                                            </div>
                                        </div>
                                        <div data-index="5" tabindex="-1" class="slick-slide slick-cloned" aria-hidden="true" style="width:14.285714285714286%">
                                            <div>
                                                <div class="loginBase__loginStep___dg2cW loginBase__step3___hz5FR" tabindex="-1" style="width:100%;display:inline-block"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <ul style="display:block" class="slick-dots">
                                    <li class="slick-active"><button>1</button></li>
                                    <li class=""><button>2</button></li>
                                    <li class=""><button>3</button></li>
                                </ul>
                            </div>
                        </div>
                        <div class="loginBase__titleContainer___kw1CS">
                            <div class="loginBase__title1___27neu">
                                线路设计
                            </div>
                            <div class="loginBase__title2___12zmv">
                                专业的定制旅行工作台
                            </div>
<!--                            <div class="loginBase__title3___DoYOn">-->
<!--                                TEL: 010-56231901-->
<!--                            </div>-->
                        </div>
                    </div>
                    <div class="loginBase__rightPanel___c_7Or">
                        <img src="<?=$_static?>/images/logo.png" class="loginBase__tosLogo___KBIGu">
                        <div class="login__loginContainer___3o3ll">
                            <div class="login__loginWord___bjU-w">
                                登录
                            </div>
                            <form class="ant-form ant-form-horizontal">
                                <div class="ant-row ant-form-item login__formItem___35amM">
                                    <div class="ant-form-item-control-wrapper">
                                        <div class="ant-form-item-control">
                                            <span class="ant-form-item-children"><input type="text" placeholder="请输入账号" v-model="account" class="ant-input login__input___2s_SP" autoComplete="off" value="" id="account" ></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="login__formItem___35amM ant-divider ant-divider-horizontal"></div>
                                <div class="ant-row ant-form-item login__formItem___35amM">
                                    <div class="ant-form-item-control-wrapper">
                                        <div class="ant-form-item-control">
                                            <span class="ant-form-item-children"><input type="password" placeholder="请填写密码" v-model="password" class="ant-input login__input___2s_SP" value="" id="password"  ></span>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div>
                                <button type="button" class="ant-btn login__loginButton___K7_5R ant-btn-primary ant-btn-xl ant-btn-block"  v-on:click="login"><span>登录</span></button>
                            </div>
                            <div>
                                <!-- <a class="globalLink login__forgotPassword___bMKgR" href="/email-reset-password" rel="nofollow">忘记密码</a> -->
                                <!-- <a class="login__applyFor___3uswu" href="https://www.lushu.com">申请账号</a> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
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
                    
                    over_Time_url('/lushu/',1000);
                },error=>{
                    _that.password = '';
                });
            }
        }
    })
    $('.LOADING').css('display','none')

</script>
</body>
</html>