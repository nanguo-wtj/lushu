<div class="XCJS" style="display: none;position: absolute;">
    <div class="ant-drawer ant-drawer-right ant-drawer-open
          ant-drawer-border">
        <div class="ant-drawer-mask"></div>
        <div class="ant-drawer-content-wrapper" style="width: 960px;">
            <div class="ant-drawer-content">
                <div class="ant-drawer-wrapper-body" style="overflow: auto;
                height: 100%;">
                    <div class="ant-drawer-header">
                        <div class="ant-drawer-title">编辑今日介绍</div>
                        <div class="ant-drawer-right-actions">
                            <div class="ant-drawer-actions">
                                <button type="button" class="ant-btn ant-btn-primary" v-on:click="Post_content">
                                    <span>保存</span>
                                </button>
                            </div>
                            <button aria-label="Close" v-on:click="Close_Itinerary()" class="ant-drawer-close">
                                <i aria-label="图标: close" class="anticon anticon-close">
                                    <img src="/lushu/static/svg/icon-11.svg" style="width: 1rem;height: 1rem">
                                </i>
                            </button>
                        </div>
                    </div>
                    <div class="ant-drawer-body">
                        <div class="addTripRichText__addTripRichText___Itm8C">
                            <input type="hidden" id="editor-content" value="">
                            <div class="addTripRichText__leftMenu___3GBpJ">
                                <div class="editor__piecefulEditor___QSJXD addTripRichText__richEditor___3AXgH">
                                    <!-- 富文本 -->
                                    <!-- 头 -->
                                    <div class="editor__editorActions___3V13t addTripRichText__richEditorActionBar___UDF6g" id="wangeditor_column">

                                    </div>
                                    <!-- 内容 -->
                                    <div class="editor__richContent___x93pI fr-box fr-top fr-basic" id="wangeditor_content">

                                    </div>
                                </div>
                            </div>
                            <div class="addTripRichText__rightContent___5TCRf">
                                <div class="ant-radio-group ant-radio-group-outline customRadioGroup sizeSmall default">
                                    <label  :class="list.note_status? 'ant-radio-button-wrapper ant-radio-button-wrapper-checked':'ant-radio-button-wrapper ' " v-on:click="switch_Itinerary(1);">
                                        <span  :class="list.note_status? 'ant-radio-button ant-radio-button-checked':'ant-radio-button-checked' " >
                                            <span class="ant-radio-button-inner"></span>
                                        </span>
                                        <span>笔记</span>
                                    </label>
                                    <label  :class="list.img_status? 'ant-radio-button-wrapper ant-radio-button-wrapper-checked':'ant-radio-button-wrapper ' "  v-on:click="switch_Itinerary(2);">
                                        <span  :class="list.img_status? 'ant-radio-button ant-radio-button-checked':'ant-radio-button-checked' " >
                                            <span class="ant-radio-button-inner"></span>
                                        </span>
                                        <span>图片</span>
                                    </label>
                                </div>
                                <div class="addTripRichText__actionBar___2nsdp">
                                    <form  @submit.prevent="searchContent">
                                        <span class="ant-input-affix-wrapper" style="width: 210px;">
                                            <span class="ant-input-prefix">
                                                <i aria-label="图标: search" class="anticon anticon-search">
                                                    <img src="/lushu/static/svg/icon-59.svg" style="width: 1rem;height: 1rem">
                                                </i>
                                            </span>
                                            <input placeholder="搜索关键字" type="text" v-model="searchContentDate" class="ant-input" value="">
                                            <span class="ant-input-suffix"></span>
                                        </span>
                                    </form>
<!--                                    <div class="addTripRichText__actionBarRight___2xdNJ">-->
<!--                                        <button type="button" v-on:click="add_list_content()" class="ant-btn ant-btn-lg">-->
<!--                                            <i aria-label="图标: plus" class="anticon anticon-plus">-->
<!--                                                <img src="/lushu/static/svg/icon-60.svg" style="width: 1rem;height: 1rem">-->
<!--                                            </i>-->
<!--                                           <span v-if="list.note_status ==  true">新建笔记</span>-->
<!--                                            <span v-if="list.img_status ==  true">新建图片</span>-->
<!--                                        </button>-->
<!--                                    </div>-->
                                </div>
                                <div>
                                    <div class="addTripRichText__noteList___1jUqN" >
                                        <div class="ant-row" v-if="list.note_status ==  true" style="margin-left: -8px; margin-right: -8px;">

                                            <div class="ant-col-24" v-for="item in list.note_list" :key="item.id" v-on:click="Getdetails_note_data(item.id)"  data-id="3" style="padding-left: 8px; padding-right: 8px;">
                                                <div class="tripElementAddControl__tripElementAddControl___2ffiM tripElementAddControl__control___30rqE tripElementAddControl__actionAdd___2YbP8 tripElementAddControl__positionRightCenter___1PRs2">
                                                    <div class="tripElementAddControl__btns___3cfir" >
                                                        <button type="button" class="ant-btn tripElementAddControl__btnAdd___3M54d ant-btn-primary ant-btn-sm ant-btn-icon-only" @click="addNode(item)">
                                                            <i aria-label="图标: plus" class="anticon anticon-plus">
                                                                <img src="/lushu/static/svg/icon-52.svg" style="width: 1rem;height: 1rem;margin-top: -5px">
                                                            </i>
                                                        </button>
                                                    </div>
                                                    <div class="note__noteBox___UhFwo tripElementAddControl__element___3LZTR tripElementAddControl__note___QQ-hv">
                                                        <div class="note__noteCover___3XJg6" v-if="!item.url">
                                                            <span class="widgets__lushuBackgroundImage___3XMmZ widgets__noImg___CsB0Z">
                                                                <div class="widgets__noImgCont___blaq6">
                                                                    <i aria-label="图标: picture" class="anticon anticon-picture" style="font-size: 24px;">
                                                                        <svg viewBox="64 64 896 896" class="" data-icon="picture" width="1em" height="1em" fill="currentColor" aria-hidden="true" focusable="false">
                                                                            <path d="M349.22 579.27l-51.7-67.55a29.39 29.39 0 0 0-46.49-.24L73.56 738.43a29.4 29.4 0 0 0 23.36 47.5l153.97-1.1c-5.96-8.41-10.52-17.67-11.98-28.18a64.81 64.81 0 0 1 12.6-48.3zm600.25 142.21L646.1 311.89a36.75 36.75 0 0 0-58.83-.3L274.16 725.6a36.74 36.74 0 0 0 29.57 58.9l616.47-4.37a36.74 36.74 0 0 0 29.27-58.61zM281.62 394.22a78.08 78.08 0 1 0-78.72-77.49 78.1 78.1 0 0 0 78.72 77.5z"></path>
                                                                        </svg>
                                                                    </i>
                                                                </div>
                                                            </span>
                                                        </div>
                                                        <div class="note__noteCover___3XJg6" v-if="item.url">
                                                            <img :src="item.url" style="    width: 100%; height: 100%; ">
                                                        </div>
                                                        <div class="note__noteCont___2WJA_">
                                                            <h4>{{item.title}}</h4>{{item.user}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                            $page = 'search_note_data.page';
                                            $PreviousPage   =   'previousPageNotes';
                                            $NextPage   =   'nextPageNotes';
                                            include(dirname(__FILE__,2) . '/layout/page.php');?>

                                        </div>
                                        <div class="ant-row" v-if="list.img_status ==  true" style="margin-left: 16px; margin-right: -16px;" >

                                            <div class="ant-col-12" v-for="item in list.img_list" :key="item.id" style="padding-left: 8px; padding-right: 8px;">
                                                <div class="tripElementAddControl__tripElementAddControl___2ffiM tripElementAddControl__control___30rqE tripElementAddControl__actionAdd___2YbP8 tripElementAddControl__positionRightTop___pk2DG">
                                                    <div class="tripElementAddControl__btns___3cfir" v-on:click="add_content(item,2)">
                                                        <button type="button" class="ant-btn tripElementAddControl__btnAdd___3M54d ant-btn-primary ant-btn-sm ant-btn-icon-only"  @click="addImage(item)">
                                                            <i aria-label="图标: plus" class="anticon anticon-plus">
                                                                <svg viewBox="64 64 896 896" class="" data-icon="plus" width="1em" height="1em" fill="currentColor" aria-hidden="true" focusable="false">
                                                                    <path d="M830.37 464H547.13V180.86a47.94 47.94 0 1 0-95.88 0V464H168a47.94 47.94 0 0 0 0 95.88h283.25v283.28a47.94 47.94 0 1 0 95.88 0V559.92h283.24a47.94 47.94 0 0 0 0-95.88z"></path>
                                                                </svg>
                                                            </i>
                                                        </button>
                                                    </div>
                                                    <div class="addTripRichText__picture___pxtL8 tripElementAddControl__element___3LZTR">
                                                        <span class="widgets__lushuBackgroundImage___3XMmZ" :style='"background-image: url("+item.url+");"'></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                            $page = 'search_picture_data.page';
                                            $PreviousPage   =   'previousPagePicture';
                                            $NextPage   =   'nextPagePicture';
                                            include(dirname(__FILE__,2) . '/layout/page.php');?>

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
