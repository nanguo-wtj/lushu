<!-- 导入顶部数据  -->
<?php include(dirname(__FILE__,2) . '/layout/header.php');?>
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
                        <div class="mainRow basicLayout__mainRow___JOrD9">
                            <div>
                                <a class="globalLink basicLayout__pageTitle___3IeEK" href="./resources.html">素材库</a>
                            </div>
                            <div class="basicLayout__center___RAJSN basicLayout__subHeader___1ArlM">
                                <div class="ant-breadcrumb ant-breadcrumb-undefined">
                                    <span>
                                        <span class="ant-breadcrumb-link">
                                            <a class="globalLink undefined-link" href="./resources.html">行程路线库</a>
                                        </span>
                                        <span class="ant-breadcrumb-separator">
                                            <i aria-label="图标: right" class="anticon anticon-right">
                                                <img src="/lushu/static/svg/icon-129.svg" style="width: 1rem;height: 1rem">
                                            </i>
                                        </span>
                                    </span>
                                    <span>
                                        <span class="ant-breadcrumb-link">{{project_data.title}}</span>
                                        <span class="ant-breadcrumb-separator">
                                            <i aria-label="图标: right" class="anticon anticon-right">
                                                <img src="/lushu/static/svg/icon-129.svg" style="width: 1rem;height: 1rem">
                                            </i>
                                        </span>
                                    </span>
                                </div>
                            </div>
                            <div>
                                <div class="widgets__buttonGroup___u-3Ns">
                                    <button type="button" onclick=" $('.del').css('display', 'block')" class="ant-btn ant-btn-plain">
                                        <i aria-label="图标: delete" class="anticon anticon-delete">
                                            <img src="/lushu/static/svg/icon-108.svg" style="width: 1rem;height: 1rem">
                                        </i>
                                        <span>删除</span>
                                    </button>
                                    <button type="button" class="ant-btn ant-btn-plain" onclick="$('.copy').css('display', 'block')">
                                        <i aria-label="图标: copy" class="anticon anticon-copy">
                                            <img src="/lushu/static/svg/icon-130.svg" style="width: 1rem;height: 1rem">
                                        </i>
                                        <span>复制</span>
                                    </button>
                                    <button type="button" class="ant-btn ant-btn-primary" onclick="location.href='./project_edit_export.html?key_id=<?=$key_id?>'">
                                        <span>编辑</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="basicLayout__pageContainer___2LQ1G">
                        <div class="pagePanel__pagePanelContainer___3FpIY">
                            <div class="pagePanel pagePanel__pagePanel___3fszW templateDetail__contentContainer___3pMlc pagePanel__auto___1xn2A">
                                <div class="tripEditPreview__tripEditPrevew___30JYd">
                                    <div class="tripEditPreview__sectionBasicInfo___gwo7S tripEditPreview__anchorItem___3U4fG">
                                        <div id="SectionOverview" class="tripEditPreview__anchorMarker___L0W6l"></div>
                                        <div class="ant-row" style="margin-left: -28px; margin-right: -28px;">
                                            <div class="ant-col-16" style="padding-left: 28px; padding-right: 28px;">
                                                <div class="tripEditPreview__tripHeader___2cpHr">
                                                    <h1>{{project_data.title}}</h1>
                                                </div>
                                                <div class="tripEditPreview__tripMeta___1vXgD">共{{project_data.day}}天</div>
                                                <div class="tripEditPreview__tripMeta___1vXgD">{{project_data.city}}</div>
                                            </div>
                                            <div class="ant-col-8" style="padding-left: 28px; padding-right: 28px;">
                                                <div class="tripEditPreview__tripCover___2Kg4s">
                                                    <div style="display: flex;background-color: #f4f4f5; border-radius: 10px; justify-content: center; align-items: center; " class="tripEditPreview__backgroundImage___3BLFv widgets__lushuBackgroundImage___3XMmZ" >
                                                        <img v-if="!project_data.url" src="/lushu/static/svg/icon-104.svg" style="width: 5rem;height: 5rem">
                                                        <img v-else  :src="project_data.url" style="width: 100%;height: 100%">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tripEditPreview__sectionMain___3ojF5">
                                        <h2 class="tripEditPreview__sectionMainTitle___1jNra">
                                            <span>行程总览</span>
                                        </h2>
                                        <div>
                                            <div class="tripEditPreview__sectionSub___1mgKs">
                                                <h3 class="tripEditPreview__sectionSubTitle___1Vkyj">关于这次旅行</h3>
                                                <div>
                                                    <div class="widgets__showMoreWrap___3x-uL undefined">
                                                        <div id="itinerary" class="widgets__allContentContainer___3dOex" style="max-height: 120px; padding-bottom: 0px;">
                                                            <div>
                                                                <div class="widgets__globalParagraph___2aU6y">
                                                                    <div v-html="Itinerary.content">

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div id="itinerary_All" v-on:click="ExpandAll('itinerary','itinerary_All','itinerary_close')" class="showMoreBarWidget widgets__showMoreBar___267FV">
                                                            <i aria-label="图标: double-down" class="anticon anticon-double-down widgets__icon___xHGFW">
                                                                <img src="/lushu/static/svg/icon-78.svg" style="width: 1rem;height: 1rem">
                                                            </i>
                                                            <span class="showOrHide" >展开全部</span>
                                                        </div>
                                                        <div id="itinerary_close" style="display: none;" v-on:click="CloseAll('itinerary','itinerary_All','itinerary_close')" class="showMoreBarWidget widgets__showMoreBar___267FV">
                                                            <i aria-label="图标: double-down" class="anticon anticon-double-down widgets__icon___xHGFW">
                                                                <img src="/lushu/static/svg/icon-132.svg" style="width: 1rem;height: 1rem">
                                                            </i>
                                                            <span class="showOrHide" >收起</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tripEditPreview__sectionMain___3ojF5">
                                        <h2 class="tripEditPreview__sectionMainTitle___1jNra">
                                            <span>行程路线</span>
                                        </h2>
                                        <div>

                                            <div v-for="(item,index) in day_list" class="tripEditPreview__tripDay___c9zgQ tripEditPreview__anchorItem___3U4fG">
                                                <div :id="'D'+item.day" class="tripEditPreview__anchorMarker___L0W6l"></div>
                                                <div class="tripEditPreview__tripDayHeader___xBHBj">
                                                    <div class="tripEditPreview__leftDate____x-D2">
                                                        <div class="tripEditPreview__dayIndex___3A60s">D{{item.day}}</div>
                                                        <div></div>
                                                    </div>
                                                    <div class="tripEditPreview__dayCityList___2pa-M">
															<span v-for="(a,b) in item.city" class="tripEditPreview__dayCity___3VI9K">
																<span>{{a.value}}</span>
																<i aria-label="图标: swap-right" class="anticon anticon-swap-right tripEditPreview__dayCityIcon___3I70F">
																	<img src="/lushu/static/svg/icon-131.svg" style="width: 1rem;height: 1rem">
																</i>
															</span>
                                                    </div>
                                                </div>
                                                <div v-if="item.content" class="tripEditPreview__sectionSub___1mgKs">
                                                    <h3 class="tripEditPreview__sectionSubTitle___1Vkyj">今日介绍</h3>
                                                    <div>
                                                        <div class="widgets__showMoreWrap___3x-uL undefined">
                                                            <div :id="'itinerary'+item.day" class="widgets__allContentContainer___3dOex" style="max-height: 120px; padding-bottom: 0px;">
                                                                <div>
                                                                    <div class="widgets__globalParagraph___2aU6y">
                                                                        <div v-html="item.content">

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div :id="'itinerary_All'+item.day" v-on:click="ExpandAll('itinerary'+item.day,'itinerary_All'+item.day,'itinerary_close'+item.day)" class="showMoreBarWidget widgets__showMoreBar___267FV">
                                                                <i aria-label="图标: double-down" class="anticon anticon-double-down widgets__icon___xHGFW">
                                                                    <img src="/lushu/static/svg/icon-78.svg" style="width: 1rem;height: 1rem">
                                                                </i>
                                                                <span class="showOrHide" >展开全部</span>
                                                            </div>
                                                            <div :id="'itinerary_close'+item.day" v-on:click="CloseAll('itinerary'+item.day,'itinerary_All'+item.day,'itinerary_close'+item.day)" style="display: none;" class="showMoreBarWidget widgets__showMoreBar___267FV">
                                                                <i aria-label="图标: double-down" class="anticon anticon-double-down widgets__icon___xHGFW">
                                                                    <img src="/lushu/static/svg/icon-132.svg" style="width: 1rem;height: 1rem">
                                                                </i>
                                                                <span class="showOrHide" >收起</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div v-if="item.schedule.length >0" class="tripEditPreview__sectionSub___1mgKs">
                                                    <h3 class="tripEditPreview__sectionSubTitle___1Vkyj">日程安排</h3>
                                                    <div>
                                                        <div class="tripDayAgendaList__agendaListWrap___3nBzv tripDayAgendaList__preview___3Kvhq">
                                                            <div v-for="(c,d) in item.schedule">
                                                                <div class="tripDayAgendaList__agendaItem___1E2QK">
                                                                    <span class="tripDayAgendaList__indexNum___fNUg5">{{d+1}}</span>
                                                                    <span class="tripDayAgendaList__icon___84ljn">
																		<i aria-label="图标: poi-method-4" class="anticon anticon-poi-method-4">
																			<img src="/lushu/static/svg/icon-101.svg" style="width: 1rem;height: 1rem">
																		</i>
																	</span>
                                                                    <div class="tripDayAgendaList__title___3S1R9">{{c.title}}</div>
                                                                </div>
                                                                <div v-if="(d+1) < item.schedule.length" class="tripDayAgendaList__transit___2luVb">
                                                                    <span> </span>{{c.traffic}}
                                                                </div>
                                                            </div>


                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="tripEditPreview__anchorNav___3GIgu anchorNav__anchorNav___qOm_3">
                                        <div>
                                            <div class="">
                                                <div class="ant-anchor-wrapper" style="max-height: 100vh;">
                                                    <div class="ant-anchor">
                                                        <div class="ant-anchor-ink">
                                                            <span class="ant-anchor-ink-ball visible" style="top: 15.5px;"></span>
                                                        </div>
                                                        <div class="ant-anchor-link ant-anchor-link-active">
                                                            <a class="ant-anchor-link-title ant-anchor-link-title-active" href="#SectionOverview" title="行程总览">行程总览</a>
                                                        </div>
                                                        <div v-for="(item,index) in day_list" :key="index" class="ant-anchor-link">
                                                            <a class="ant-anchor-link-title" :href="'#D'+item.day" :title="'D'+item.day">D{{item.day}}</a>
                                                        </div>

                                                        <div class="anchorNav__anchorMenu___2faDZ">
                                                            <button type="button" class="ant-btn anchorNav__triggerIcon___1m89_ ant-dropdown-trigger ant-btn-plain ant-btn-lg ant-btn-icon-only">
                                                                <i aria-label="图标: down" class="anticon anticon-down">
                                                                    <img src="/lushu/static/svg/icon-105.svg" style="width: 1rem;height: 1rem">
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
                            <div class="pagePanelGroup pagePanel__pagePanelGroup___19_UR pagePanel__sider___3KzU1" style="flex: 0 0 320px; max-width: 320px; min-width: 320px; width: 320px;">
                                <div class="pagePanel pagePanel__pagePanel___3fszW templateDetail__bookingAndTripQuoteContainer___3vl4z">
                                    <div class="templateDetail__title___2l9Uf">费用核算与行程报价</div>
                                    <div class="templateDetail__subTitle___fXLmt">
                                        <span class="templateDetail__name___2q6rp">费用核算：</span>
                                        <span v-on:click="GetCost" class="templateDetail__content___3tSRQ">查看详情</span>
                                    </div>
                                    <div class="templateDetail__subTitle___fXLmt">
                                        <span class="templateDetail__name___2q6rp">行程报价：</span>
                                        <span v-if="project_data.export_type == true" v-on:click="GetQuotation" class="templateDetail__content___3tSRQ">查看详情</span>
                                        <span v-if="project_data.export_type == false" class="templateDetail__content___3tSRQ">暂无数据</span>
                                    </div>
                                </div>
                                <div class="pagePanel pagePanel__pagePanel___3fszW templateDetail__otherInfoContainer___NaTxq">
                                    <div class="versionInfo__container___3jWaV">
                                        <div class="versionInfo__title___2Vm_j">版本信息</div>
                                        <div class="versionInfo__content___1VljP">
                                            <div>
                                                <div>最后编辑时间:</div>
                                                <div>{{project_data.update_time}}</div>
                                            </div>
                                        </div>
                                        <div class="versionInfo__content___1VljP">
                                            <div>
                                                <div>创建人:</div>
                                                <div>{{project_data.user}}</div>
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


    <?php include(dirname(__FILE__,2) . '/layout/details_poi.php');?>
    <?php include(dirname(__FILE__,2) . '/layout/export_copy.php');?>
    <?php include(dirname(__FILE__,2) . '/layout/export_del.php');?>
    <?php include(dirname(__FILE__,2) . '/layout/export_Cost.php');?>
    <?php include(dirname(__FILE__,2) . '/layout/export_quotation.php');?>
</div>

</body>
<script>


    function sureCopy() {
        $('.copy').css('display', 'none')
    }

    function sureDel() {
        $('.del').css('display', 'none')

    }
</script>

</html>