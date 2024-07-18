<!-- 导入顶部数据  -->
<?php include(dirname(__FILE__,2) . '/layout/header.php');?>
<body class="appName-library">
<div id="webMain" ref="pageTop">
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
                    <?php
                    $superior_name  =   '活动与服务库';
                    $superior_url   =   'resources_activities';
                    $add_status = true;
                    include(dirname(__FILE__,2) . '/layout/resources_top_details.php');?>

                </div>
                <div class="basicLayout__pageContainer___2LQ1G">
                    <div class="pagePanel__pagePanelContainer___3FpIY">
                        <div class="pagePanel pagePanel__pagePanel___3fszW activityDetail__leftElt___2FmMf pagePanel__auto___1xn2A">
                            <div class="activityDetail__contentWrap___34Ty-">
                                <div class="iconHeader__title___1Fei8">
										<span class="iconHeader__icon___3doeA">
											<i aria-label="图标: activity" class="anticon anticon-activity">
												<img src="/lushu/static/svg/icon-134.svg" style="width: 1rem;height: 1rem">
											</i>
										</span>{{resources_data.title}}
                                </div>
                                <div class="activityDetail__pictures___29nRL">
                                    <div class="ant-carousel">
                                        <div class="slick-slider slick-initialized" dir="ltr">
                                            <div class="slick-list">
                                                <div class="slick-track" style="width: 12240px; opacity: 1; ">
                                                    <div   class="slick-slide slick-cloned"  style="width: 720px;">
                                                        <div>
                                                            <div tabindex="-1" v-for="(item,index) in resources_data.imgList" :key="index" v-if="item.status == true"  style="width: 100%; display: inline-block;">
                                                                <div class="activityDetail__picture___3B7ZY" :style="'background-image: url('+item.url+'); height: 480px;'"></div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <ul class="slick-dots" style="display: block;">
                                                <li v-for="(item,index) in resources_data.imgList" :key="index"   :class="item.status == true ? 'slick-active':''" v-on:click="openpicture(item)">
                                                    <button>{{index}}</button>
                                                </li>

                                            </ul>
                                        </div>
                                    </div>
                                    <div class="activityDetail__brief___2-Fbs"></div>
                                </div>
                                <div class="activityDetail__divider___3skQ3 ant-divider ant-divider-horizontal"></div>
                                <div class="activityDetail__price___2lXdb activityDetail__tableRow___TpOcF">
                                    <div class="activityDetail__label___2w0PL">参考价格</div>
                                    <div class="activityDetail__priceOptions___OAXcA">
                                        <div class="activityDetail__priceItem___2EYA_" v-for="(item,index) in resources_data.price" :key="index">{{item.title}} ￥{{item.value}}</div>
                                    </div>
                                </div>
                                <div class="activityDetail__divider___3skQ3 ant-divider ant-divider-horizontal"></div>
                                <div class="activityDetail__purchaseNote___1stya activityDetail__tableRow___TpOcF">
                                    <div class="activityDetail__label___2w0PL">购买须知</div>
                                    <div class="activityDetail__noteItem___1nL2E">{{resources_data.notice}}</div>
                                </div>
                                <div class="activityDetail__divider___3skQ3 ant-divider ant-divider-horizontal"></div>
                                <div class="activityDetail__introduction___vWxGR activityDetail__tableRow___TpOcF">
                                    <div class="activityDetail__label___2w0PL">活动与服务介绍</div>
                                    <div class="activityDetail__introItem___1pKWp">
                                        <div class="widgets__showMoreWrap___3x-uL undefined">
                                            <div class="widgets__allContentContainer___3dOex" style="max-height: 120px; padding-bottom: 0px;">
                                                <div>
                                                    <div class="widgets__globalParagraph___2aU6y" v-html="resources_data.service">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="activityDetail__divider___3skQ3 ant-divider ant-divider-horizontal"></div>
                                <div class="activityDetail__tableRow___TpOcF">
                                    <div class="activityDetail__label___2w0PL">定制师笔记</div>
                                    <div>
                                        <div v-for="(item,index) in resources_data.notes" :key="index" class="note__noteBox___UhFwo note__dark___ZrySZ">
                                            <div class="note__noteCover___3XJg6">
                                                <span v-if="item.url" class="widgets__lushuBackgroundImage___3XMmZ" :style="'background-image: url('+item.url+');'" ></span>
                                                <span v-if="!item.url" class="widgets__lushuBackgroundImage___3XMmZ widgets__noImg___CsB0Z">
														<div class="widgets__noImgCont___blaq6">
															<i aria-label="图标: picture" class="anticon anticon-picture" style="font-size: 24px;">
																<img src="/lushu/static/svg/icon-104.svg" style="width: 1rem;height: 1rem">
															</i>
														</div>
													</span>
                                            </div>
                                            <div class="note__noteCont___2WJA_">
                                                <h4>{{item.title}}</h4>{{item.user}}
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="pagePanel pagePanel__pagePanel___3fszW activityDetail__rightElt___2m5GY pagePanel__sider___3KzU1" style="flex: 0 0 320px; max-width: 320px; min-width: 320px; width: 320px;">
                            <div class="relatePois__pois___3SUgw">
                                <div class="relatePois__title___MokFL">相关地点</div>
                                <div v-for="(item,index) in resources_data.association"  :key="index"  class="relatePois__poiItem___3Mu7X">
                                    <i aria-label="图标: poi-method-4" class="anticon anticon-poi-method-4 relatePois__poiIcon___N8gWA">
                                        <img src="/lushu/static/svg/icon-29.svg" style="width: 1rem;height: 1rem">
                                    </i>
                                    <span> {{item.value}}</span>
                                </div>
                            </div>
                            <div class="sideTags__tagsContainer___1A0zO">
                                <div class="sideTags__title___31b98">标签</div>
                                <div class="materialFilterTags__container___Dj1ek">
                                    <div class="materialFilterTags__wrapped___GA1ii">
                                        <span class="materialFilterTags__tag___1x6Ei" v-for="(item,index) in resources_data.label"  :key="index">{{item.label}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="relateDestinations__destinationContainer___1kzC4">
                                <div class="relateDestinations__title___YuZMc">相关目的地</div>
                                <div class="relateDestinations__destText___Huluv">
                                    <div class="destinationListText__destinationListText___3ly9q" style="justify-content: start;">
                                        <div v-for="(item,index) in resources_data.address_code"  :key="index" class="destinationListText__item___3FMZT">
                                            <span>{{item.value}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="versionInfo__container___3jWaV">
                                <div class="versionInfo__title___2Vm_j">版本信息</div>
                                <div class="versionInfo__content___1VljP">
                                    <div>
                                        <div>最后编辑时间:</div>
                                        <div>{{resources_data.time}}</div>
                                    </div>
                                </div>
                                <div class="versionInfo__content___1VljP">
                                    <div>
                                        <div>创建人:</div>
                                        <div>{{resources_data.user}}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div></div>
                </div>
            </div>
            <div></div>
            <div id="my-photoswipe-shoppingMall" class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="pswp__bg"></div>
                <div class="pswp__scroll-wrap">
                    <div class="pswp__container">
                        <div class="pswp__item"></div>
                        <div class="pswp__item"></div>
                        <div class="pswp__item"></div>
                    </div>
                    <div class="pswp__ui pswp__ui--hidden">
                        <div class="pswp__top-bar">
                            <div class="pswp__counter"></div>
                            <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>
                            <button class="pswp__button pswp__button--share" title="Share"></button>
                            <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>
                            <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>
                            <div class="pswp__preloader">
                                <div class="pswp__preloader__icn">
                                    <div class="pswp__preloader__cut">
                                        <div class="pswp__preloader__donut"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                            <div class="pswp__share-tooltip"></div>
                        </div>
                        <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)"></button>
                        <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)"></button>
                        <div class="pswp__caption">
                            <div class="pswp__caption__center"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="authWatcher accessoryWrapper "></div>
        <div class="tosAlerts accessoryWrapper tosProjectCssMarker"></div>
    </div>
    <!--编辑-->
    <!--编辑-->
    <!-- 地图 -->
    <div style="position:absolute;top:0">
        <?php include(dirname(__FILE__,2) . '/layout/resources_edit_activities.php');?>
    </div>
    <?php include(dirname(__FILE__,2) . '/layout/resources_poi_del.php');?>

</div>
</body>