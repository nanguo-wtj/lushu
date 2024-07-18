<!-- 导入顶部数据  -->
<?php
$key_id =   req('key_id');
include(dirname(__FILE__,2) . '/layout/header.php');?>
<style>
    /* reset */
    html,body,h1,h2,h3,h4,h5,h6,div,dl,dt,dd,ul,ol,li,p,blockquote,pre,hr,figure,table,caption,th,td,form,fieldset,legend,input,button,textarea,menu{margin:0;padding:0;}
    ul,li{list-style-type: none}
    h1{font-size: 26px;}
    p{font-size: 14px; margin-top: 10px;}
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
                        <?php include(dirname(__FILE__,2) . '/layout/resources_top_details.php');?>
                        <?php include(dirname(__FILE__,2) . '/layout/resources_top_poi.php');?>

                    </div>
                    <div class="basicLayout__pageContainer___2LQ1G">
                        <div class="poiViewLibrary__container___1hbY3">
                            <div class="poiViewLibrary__leftElt___hHCfu">
                                <div class="poiViewTabs__poiViewTabs___gNFI5">
                                    <ul>
                                        <li v-for="item in template_list" :key="item.id"  :class="item.id == default_id?  'poiViewTabs__activeItem___349Cw':'poiViewTabs__defaultItem___2Sn3m' "    v-on:click="Set_default_s(item)">
                                            <div class="poiViewTabs__btnTemplateTab___PBXei">
                                                <span>{{item.name}}</span>
                                                <span class="default" v-if="item.id == resources_data.default">(默认)</span>
                                            </div>
                                        </li>
<!--                                        <li class="poiViewTabs__activeItem___349Cw">-->
<!--                                            <div class="poiViewTabs__btnTemplateTab___PBXei">-->
<!--                                                <span>标准模板</span>-->
<!--                                                <span class="default">(默认)-->
<!--                                                </span>-->
<!--                                            </div>-->
<!--                                        </li>-->
                                    </ul>
                                    <div class="poiViewTabs__btnNewTab___f5FZ0" onclick="$('.poiViewNameEditModal').css('display','block')">
                                        <span>添加模板</span>
                                    </div>
                                </div>
                            </div>
                            <div class="poiViewLibrary__rightElt___movFf">
                                <div class="poiViewContent__poiViewContent___2f8gT">
                                    <div class="poiViewContent__poiViewHeader___2aTGQ">
                                        <div class="poiViewContent__title___2-fac">
                                            <span class="poiViewContent__icon___2G7xp">
                                                <i aria-label="图标: poi-method-4" class="anticon anticon-poi-method-4">
                                                    <img src="/lushu/static/svg/icon-31.svg" style="width: 1rem;height: 1rem">
                                                </i>
                                            </span>
                                            {{default_s.title}}
                                        </div>
                                        <div class="poiViewContent__btnContainer___cgETY">
                                            <button v-if="default_s.id != 0 && resources_data.default != default_s.id"  type="button" class="ant-btn poiViewContent__setBtn___38OOr ant-btn-default"  v-on:click="Set_default_id(default_s.id)">
                                                <span>设为默认</span>
                                            </button>
                                            <button v-if="default_s.id == 0 && resources_data.default != 0"  type="button" class="ant-btn poiViewContent__setBtn___38OOr ant-btn-default"  v-on:click="Set_default_id(0)">
                                                <span>设为默认</span>
                                            </button>
                                            <button v-if="default_s.id != 0"  type="button" class="ant-btn poiViewContent__editBtn___1LKKZ ant-btn-primary" onclick="$('.newCenterModal').css('display', 'block')" ant-click-animating-without-extra-node="false">
                                                <span>编辑展示内容</span>
                                            </button>
                                            <button preventspace="true" type="button" onclick="delOrCopy(this)" class="ant-btn ant-dropdown-trigger ant-btn-icon-only">
                                                <i aria-label="图标: ellipsis" class="anticon anticon-ellipsis">
                                                    <img src="/lushu/static/svg/icon-15.svg" style="width: 1rem;height: 1rem">
                                                </i>
                                            </button>
                                            <ul class="ant-dropdown-menu ant-dropdown-menu-light ant-dropdown-menu-root ant-dropdown-menu-vertical" style="position:absolute;z-index:999;display: none;" role="menu">
                                                <li class="ant-dropdown-menu-item" role="menuitem">
                                                    <div>复制模板</div>
                                                </li>
                                                <li class="ant-dropdown-menu-item" role="menuitem">
                                                    <div>删除模板</div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="poiViewContent__pictures___2HvEW">
                                        <div class="ant-carousel">
                                            <div class="slick-slider slick-initialized">
                                                <div class="slick-list">
                                                    <div class="slick-track" style="width:100%;left:0%">
                                                        <div data-index="0" class="slick-slide slick-active slick-current" tabindex="-1" aria-hidden="false" style="outline:none;width:100%">
                                                            <div v-for="item_1 in default_s.picture" :key="item_1.id">
                                                                <div tabindex="-1" style="width:100%;display:inline-block">
                                                                    <div class="poiViewContent__picture___2HH9s" :style="'background-image:url('+item_1.value+');width:720px;height:380px'"></div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="poiViewContent__poiViewBrief___26z4w">{{default_s.introduction}}</div>
                                    </div>
                                    <div class="ant-divider ant-divider-horizontal"></div>
                                    <div>
                                        <div class="poiViewContent__poiViewInfo___3-bga">
                                            <table class="poiViewContent__infoList___JS0bf">
                                                <tbody></tbody>
                                                <tbody v-for="(item_2,index_2) in  default_s.information" :key="index_2">
                                                    <tr class="poiViewContent__item___sBT4a">
                                                        <td class="poiViewContent__title___2-fac">{{item_2.title}}</td>
                                                        <td class="poiViewContent__content___25K-j">{{item_2.value}}</td>
                                                    </tr>
                                                </tbody>

                                            </table>
                                        </div>
                                    </div>
                                    <?php include(dirname(__FILE__,2) . '/layout/project_poi_template.php');?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- 添加模板 -->
    <div class="tosProjectCssMarker popUpModal modalWrap poiViewNameEditModal" id="add_template" style="display: none;">
        <div class="content">
            <div class="head">
                <h5 class="modalTitle">添加模板</h5>
                <div class="actions" onclick="close_add_template()">
                    <i class="icon iconClose icon-close"></i>
                </div>
            </div>
            <div class="body">
                <div class="title">模板名称</div>
                <input class="poiViewName" type="text" maxlength="64" v-model="template_name" value="">
                <div class="btnBar" v-on:click="add_template">
                    <span class="btnGreen">添加模板</span>
                    <div class="message"></div>
                </div>
            </div>
        </div>
    </div>
    <!--  -->
    <?php include(dirname(__FILE__,2) . '/layout/project_poi_template.php');?>
    <?php include(dirname(__FILE__,2) . '/layout/resources_poi_del.php');?>

</div>



</body>

</html>