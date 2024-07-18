<!-- 导入顶部数据  -->
<?php include(dirname(__FILE__,2) . '/layout/header.php');?>
<style>
    /* reset */
    html,body,h1,h2,h3,h4,h5,h6,div,dl,dt,dd,ul,ol,li,p,blockquote,pre,hr,figure,table,caption,th,td,form,fieldset,legend,input,button,textarea,menu{margin:0;padding:0;}
    ul,li{list-style-type: none}
    h1{font-size: 26px;}
    p{font-size: 14px; margin-top: 10px;}
    pre{background:#eee;border:1px solid #ddd;border-left:4px solid #f60;padding:15px;margin-top: 15px;}
    h2{font-size: 20px;margin-top: 20px;}
    .case{margin-top: 15px;}
    #callback{float: left;margin-left: 12px;height:33px;line-height: 33px;border:1px solid #d7d7d7;padding:0 10px;}
    .inputDuration__popover___2DN4h {
        padding: 0px 16px 12px;
    }
</style>
<body class="appName-library">

<div id="webMain" ref="pageTop">
    <div>
        <div class="">
            <div id="pageWrap" class="basicLayout__basicLayout___3_npk">
                <div class="transitIndicator__transitIndicator___3m8Gd">
                    <div class="transitIndicator__transitBar___2q3uc"></div>
                </div>

                <!-- 导入导航栏目  -->
                <?php include(dirname(__FILE__,2) . '/layout/menu.php');?>


                <div class="basicLayout__layoutMain___1NUHo">

                    <div class="pageTopBar basicLayout__pageTopBar___3r1fF">
                        <!-- 导入顶部栏目  -->
                        <?php include(dirname(__FILE__,2) . '/layout/top.php');?>
                        <?php include(dirname(__FILE__,2) . '/layout/resources_top.php');?>


                    </div>
                    <div class="basicLayout__pageContainer___2LQ1G">

                        <div class="tagLibrary__tagLibrary___3JcdX">

                            <div class="tagLibrary__pageRightNav___2BNHs">
                                <!-- 行程路线 -->
                                <div class="tag_xclx tagLibrary__tagPanel___1j5Iy tagPanel__editTagWrapPosition___dLOaA tosProjectCssMarker">
                                    <div class="tagPanel__editTagWrap___2u_Ee">
                                        <div class="tagPanel__relatedTagList___23Ph8 tagPanel__relatedItemList___1smWM">
                                            <div v-for="(item,index) in label" :key="index"  class="tagPanel__item___yCbYP tagPanel__editable___3-4ik">
                                                <div class="tagPanel__name___10H5M" :id="'content'+index" contenteditable v-on:blur="Update_label(index,item)" >
                                                    {{item.label}}
                                                </div>
                                                <span class="tagPanel__removeBtn___ROtOD" v-on:click="DelLabel(item)">
                                                    <i  aria-label="图标: close" class="anticon anticon-close">
                                                         <img src="/lushu/static/svg/icon-53.svg" style="width: 0.8rem; height: 0.8rem;">
                                                    </i>
                                                </span>
                                            </div>

                                            <div id="tag_library_open" class="tagPanel__btnCube___3pngi" onclick="$('#tag_library').show();$('#tag_library_open').hide();">
                                                <i aria-label="图标: tag" class="anticon anticon-tag">
                                                    <img src="/lushu/static/svg/icon-133.svg" style="width: 1rem; height: 1rem;">
                                                </i>
                                                <span class="tagPanel__addTag___2w28Q" >添加标签</span>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="tagPanel__createTag___ZLmvq" id="tag_library" style="display: none;">
                                                <input type="text" v-model="label_data" maxlength="20" placeholder="请输入标签">
                                                <button type="button" class="ant-btn tagPanel__close___1ustW ant-btn-lg ant-btn-icon-only" onclick="$('#tag_library').hide();$('#tag_library_open').show();">
                                                    <i aria-label="图标: close" class="anticon anticon-close">
                                                        <img src="/lushu/static/svg/icon-11.svg" style="width: 1rem; height: 1rem;">
                                                    </i>
                                                </button>
                                                <button type="button" class="ant-btn tagPanel__close___1ustW ant-btn-lg ant-btn-icon-only" v-on:click="add_label()">
                                                    <i aria-label="图标: check" class="anticon anticon-check">
                                                        <img src="/lushu/static/svg/icon-120.svg" style="width: 1rem; height: 1rem;">
                                                    </i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>


                    </div>
                </div>
            </div>
            <div class="authWatcher accessoryWrapper "></div>
            <div class="tosAlerts accessoryWrapper tosProjectCssMarker"></div>
        </div>
    </div>
    <!-- 通知 -->
    <?php include(dirname(__FILE__,2) . '/layout/notice.php');?>
</div>



</body>
<script>



</script>
</html>