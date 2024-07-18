<div class="addLight" style="display: none;position: absolute;">
    <div class="ant-drawer ant-drawer-right ant-drawer-open ant-drawer-border" style="">
        <div class="ant-drawer-mask"></div>
        <div class="ant-drawer-content-wrapper" style="width: 710px;">
            <div class="ant-drawer-content">
                <div class="ant-drawer-wrapper-body" style="overflow: auto; height: 100%;">
                    <div class="ant-drawer-header">
                        <div class="ant-drawer-title">添加行程亮点</div>
                        <div class="ant-drawer-right-actions">
                            <button aria-label="Close" onclick="$('.addLight').css('display','none')" class="ant-drawer-close">
                                <i aria-label="图标: close" class="anticon anticon-close">
                                    <img src="/lushu/static/svg/icon-11.svg" style="width: 1rem;height: 1rem;margin-top: -6px;">
                                </i>
                            </button>
                        </div>
                    </div>
                    <div class="ant-drawer-body">
                        <div class="addTripElement__addTripElement___JbkSU">

                            <div class="addTripElement__rightContent___dzhaf" style="margin-right: unset">
                                <div class="addTripElement__rightContentInner___3Pu-R">
                                    <div class="addTripElement__actionBar___2NyCT">
                                        <form  @submit.prevent="GetTripList(1)">
                                            <span class="ant-input-affix-wrapper" style="width: 410px;">
                                                <span class="ant-input-prefix">
                                                    <i aria-label="图标: search" class="anticon anticon-search">
                                                        <img src="/lushu/static/svg/icon-16.svg" style="width: 1rem;height: 1rem;margin-top: -6px;">
                                                    </i>
                                                </span>
                                                <input placeholder="搜索关键字" type="text" v-model="search_Trip_data.title" class="ant-input" value="">
                                                <span class="ant-input-suffix"></span>
                                            </span>
                                        </form>
                                    </div>
                                    <div>
                                        <div>
                                            <div class="ant-row" style="margin-left: -8px; margin-right: -8px;">


                                                <div class="ant-col-8" v-for="item in list.trip_list" :key="item.id" :data-id="item.id" style="padding-left: 8px; padding-right: 8px;">
                                                    <div class="tripElementAddControl__tripElementAddControl___2ffiM tripElementAddControl__control___30rqE tripElementAddControl__actionAddRemove___2sld3 tripElementAddControl__positionRightTop___pk2DG">
                                                        <div class="tripElementAddControl__btns___3cfir">
                                                            <button v-if="item.status == false" v-on:click="add_project_trip(item)" type="button" class="ant-btn tripElementAddControl__btnAdd___3M54d ant-btn-primary ant-btn-sm ant-btn-icon-only">
                                                                <i aria-label="图标: plus" class="anticon anticon-plus">
                                                                    <img src="/lushu/static/svg/icon-22.svg" style="width: 1rem;height: 1rem;margin-top: -6px;">
                                                                </i>
                                                            </button>
                                                            <button v-if="item.status == true"  type="button" class="ant-btn tripElementAddControl__labelAdded___dGYg6 ant-btn-primary ant-btn-sm ant-btn-icon-only">
                                                                <i aria-label="图标: check" class="anticon anticon-check">
                                                                    <img src="/lushu/static/svg/icon-57.svg" style="width: 1rem;height: 1rem;margin-top: -6px;">
                                                                </i>
                                                            </button>
                                                            <button v-if="item.status == true"  v-on:click="del_project_trip(item,2)" type="button" class="ant-btn tripElementAddControl__btnRemove___3jsJE ant-btn-danger ant-btn-circle ant-btn-sm ant-btn-icon-only">
                                                                <i aria-label="图标: delete" class="anticon anticon-delete">
                                                                    <img src="/lushu/static/svg/icon-48.svg" style="width: 1rem;height: 1rem;margin-top: -6px;">
                                                                </i>
                                                            </button>
                                                        </div>
                                                        <div class="keypoint__keypoint___18gVZ tripElementAddControl__element___3LZTR tripElementAddControl__keypoint___i-JiB" style="margin-bottom: 16px;">
                                                            <div class="keypoint__cover___ffcTY">
                                                                <span class="widgets__lushuBackgroundImage___3XMmZ" :style='"background-image: url("+item.url+");"'></span>
                                                            </div>
                                                            <div class="keypoint__cont___1W55z">
                                                                <h4 class="keypoint__title___EAnXu">{{item.title}}</h4>
                                                                <div class="keypoint__description___oofnF">{{item.content}}</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <?php
                                                $page = 'search_Trip_data.page';
                                                $PreviousPage   =   'previousPageTrip';
                                                $NextPage   =   'nextPageTrip';
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
</div>
