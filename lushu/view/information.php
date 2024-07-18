<?php include(dirname(__FILE__,2) . '/layout/header.php');?>
<body class="appName-workbench">

<div id="webMain" ref="pageTop">
    <div>
        <div class="">
            <div id="pageWrap" class="basicLayout__basicLayout___3_npk accountSetting__basicLayout___1JP_t">
                <div class="transitIndicator__transitIndicator___3m8Gd">
                    <div class="transitIndicator__transitBar___2q3uc"></div>
                </div>
                <?php include(dirname(__FILE__,2) . '/layout/menu.php');?>
                <div class="basicLayout__layoutMain___1NUHo">
                    <div class="pageTopBar basicLayout__pageTopBar___3r1fF">
                    </div>
                    <div class="basicLayout__pageContainer___2LQ1G">
                        <div class="accountSetting__accountSettingPage___3YmaH tosProjectCssMarker">
                            <div class="modalCont">
                                <div class="container">
                                    <div class="accountSetting__accountSettingContainer___2g_CA">
                                        <div class="btnUploadImgWrap accountSetting__imgForAvatar___2C50L uploading-undefined uploadImgLoaded">
                                            <span class="an-avatar accountSetting__imgForAvatar___2C50L accountSetting__avatar___3TziB avatar__avatar___4NUXc">
                                                <span class="avatar__avatarInner___1y0H-">
                                                    <span v-if="!user_data.sculpture" style="width:80px;height:80px;line-height:80px;font-size:18px;background-color:#599DFA" class="ant-avatar ant-avatar-circle">
                                                        <span class="ant-avatar-string">{{user_data.username}}</span>
                                                    </span>
                                                    <img v-if="user_data.sculpture" :src="user_data.sculpture" style="width:80px;height:80px;line-height:80px;font-size:18px;background-color:#599DFA">
                                                </span>
                                            </span>

                                            <div class="btnBlock btnUploadImg" v-on:click="upFile(this)">
                                                <i aria-label="图标: camera" class="anticon anticon-camera accountSetting__camera___1gJIW">
                                                    <svg viewbox="64 64 896 896" class="" data-icon="camera" width="1em" height="1em" fill="currentColor" aria-hidden="true" focusable="false">
                                                        <path d="M837.94 239.58H729a14.47 14.47 0 0 1-12.61-7.39L687 179.86a98.37 98.37 0 0 0-85.5-49.94H420.83a98.3 98.3 0 0 0-85.5 50l-29.39 52.3a14.49 14.49 0 0 1-12.61 7.36H186.06A115.4 115.4 0 0 0 70.78 354.86v446.7a115.42 115.42 0 0 0 115.28 115.27h651.88a115.42 115.42 0 0 0 115.28-115.27v-446.7a115.4 115.4 0 0 0-115.28-115.28zm24.28 562a24.3 24.3 0 0 1-24.28 24.27H186.06a24.3 24.3 0 0 1-24.28-24.27V354.86a24.3 24.3 0 0 1 24.28-24.28h107.27a105.59 105.59 0 0 0 91.95-53.77l29.39-52.23a7 7 0 0 1 6.16-3.66H601.5a7.11 7.11 0 0 1 6.17 3.61l29.39 52.25a105.54 105.54 0 0 0 91.94 53.8h108.94a24.3 24.3 0 0 1 24.28 24.28z">
                                                        </path>
                                                        <path d="M505.06 355.42c-111.73 0-202.56 90.86-202.56 202.58s90.83 202.5 202.56 202.5S707.61 669.67 707.61 558s-90.83-202.58-202.55-202.58zm0 314.08A111.54 111.54 0 1 1 616.61 558a111.7 111.7 0 0 1-111.55 111.5z">
                                                        </path>
                                                    </svg>
                                                </i>
                                                <input type="file" accept="image/bmp,image/jpeg,image/jpg,image/gif,image/png">
                                            </div>
                                        </div>
                                        <div class="accountSettingForm">
                                            <div class="rowHeader">
                                                <span class="accountSetting__require___1QvCj">*</span>姓名：
                                            </div>
                                            <div class="formPreview display-true" v-if="username_status == false">
                                                <div class="formRow accountSetting__formRow___1p0jE">
                                                    <div class="col-md-7 defaultTxt username">
                                                        {{user_data.username}}
                                                    </div>
                                                    <div class="col-md-5 controlBtn" v-on:click="username_status = true">
                                                        <span class="btnBorder" >修改</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="formEdit " v-if="username_status == true">
                                                <div class="errorMsg"></div>
                                                <div class="formRow accountSetting__formRow___1p0jE">
                                                    <div class="col-md-7">
                                                        <input type="text" v-model="user_data.username" maxLength="20" class="input-username" placeholder="姓名" value="">
                                                    </div>
                                                    <div class="col-md-5 controlBtn">
                                                        <span class="btn btnBorder " v-on:click="username_status = false">取消</span>
                                                        <span class="btn btnBorder " v-on:click="SetUserData('username')" data-key="username">确认</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accountSettingForm">
                                            <div class="rowHeader">
                                                <span class="accountSetting__require___1QvCj">*</span>邮箱
                                                <!-- -->：
                                            </div>
                                            <div class="formPreview display-true" v-if="mailbox_status == false">
                                                <div class="formRow accountSetting__formRow___1p0jE">
                                                    <div class="col-md-7 defaultTxt email">
                                                        {{user_data.mailbox}}
                                                    </div>
                                                    <div class="col-md-5 controlBtn">
                                                        <span class="btnBorder" v-on:click="mailbox_status = true">修改</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="formEdit " v-if="mailbox_status == true">
                                                <div class="errorMsg"></div>
                                                <div class="formRow accountSetting__formRow___1p0jE">
                                                    <div class="col-md-7">
                                                        <input type="text" v-model="user_data.mailbox" class="input-email" placeholder="邮箱地址" value="">
                                                    </div>
                                                    <div class="col-md-5 controlBtn">
                                                        <span class="btn btnBorder " v-on:click="mailbox_status = false">取消</span>
                                                        <span class="btn btnBorder " v-on:click="SetUserData('mailbox')" data-key="email">确认</span>
                                                    </div>
                                                </div>
                                                <div class="formRow accountSetting__formRow___1p0jE">
                                                    <!-- <div class="col-md-7">
                                                  <input type="password" class="" placeholder="密码">
                                                </div> -->

                                                </div>
                                            </div>
                                        </div>
                                        <div class="accountSettingForm">
                                            <div class="rowHeader">
                                                手机号
                                                <!-- -->：
                                            </div>
                                            <div class="formPreview display-true" v-if="phone_status == false">
                                                <div class="formRow accountSetting__formRow___1p0jE">
                                                    <div v-if="!user_data.phone" class="col-md-7 defaultTxt mobile">
                                                        还未绑定手机
                                                    </div>
                                                    <div v-if="user_data.phone" class="col-md-7 defaultTxt mobile">
                                                        {{user_data.phone}}
                                                    </div>
                                                    <div class="col-md-5 controlBtn">
                                                        <span class="btnBorder" v-on:click="phone_status = true">修改</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="formEdit " v-if="phone_status == true">
                                                <div class="errorMsg"></div>
                                                <div class="formRow accountSetting__formRow___1p0jE">
                                                    <div class="col-md-7">
                                                        <input type="text" v-model="user_data.phone" class="input-mobile" placeholder="请填写手机号">
                                                    </div>
                                                    <div class="col-md-5 controlBtn">
                                                        <span class="btnBorder " v-on:click="phone_status = false">取消</span>
                                                        <span class="btnBorder " v-on:click="SetUserData('phone')" data-key="mobile">确认</span>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="accountSettingForm">
                                            <div class="rowHeader">
                                                <span class="accountSetting__require___1QvCj">*</span>密码
                                                <!-- -->：
                                            </div>
                                            <div class="formPreview display-true" v-if="password_status == false">
                                                <div class="formRow accountSetting__formRow___1p0jE">
                                                    <div class="col-md-7 defaultTxt">
                                                        ******
                                                    </div>
                                                    <div class="col-md-5 controlBtn">
                                                        <span class="btnBorder" v-on:click="password_status = true">修改</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="formEdit " v-if="password_status == true">
                                                <div class="errorMsg"></div>
                                                <div class="formRow accountSetting__formRow___1p0jE">
                                                    <div class="col-md-7">
                                                        <input type="password" v-model="user_data.OriginalPassword" class="old-psd" placeholder="原密码">
                                                    </div>
                                                </div>
                                                <div class="formRow accountSetting__formRow___1p0jE">
                                                    <div class="col-md-7">
                                                        <input type="password" v-model="user_data.NewPassword"  class="new-psd" placeholder="新密码">
                                                    </div>
                                                </div>
                                                <div class="formRow accountSetting__formRow___1p0jE">
                                                    <div class="col-md-7">
                                                        <input type="password" v-model="user_data.NewPasswords" class="s-psd" placeholder="确认密码">
                                                    </div>
                                                    <div class="col-md-5 controlBtn">
                                                        <span class="btn btnBorder " v-on:click="password_status = false">取消</span>
                                                        <span class="btn btnBorder " v-on:click="SetUserData('password')" data-key="psd">确认</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

</body>

<script>
    $('.col-md-5.controlBtn:even').click(function () {
        const pNode = $(this).parents('.formPreview')
        pNode.addClass(' ')
        pNode.removeClass(' display-true')
        const nNode = pNode.next()
        // nNode.find('input:first').val(pNode.find('.defaultTxt').html().trim())
        nNode.find('input[type=password]').val('')
        nNode.addClass('display-true')
        nNode.removeClass('')
    })

    $('.col-md-5.controlBtn:odd').delegate('.btnBorder:even', 'click', function () {
        // 取消
        const pNode = $(this).parents('.formEdit')
        pNode.addClass(' ')
        pNode.removeClass(' display-true')
        const nNode = pNode.prev()
        nNode.addClass('display-true')
        nNode.removeClass('')
    })

</script>



<script>

</script>
</html>