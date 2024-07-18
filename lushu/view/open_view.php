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
            <div id="pageWrap" style="padding-left:unset;" class="basicLayout__basicLayout___3_npk">
                <div class="transitIndicator__transitIndicator___3m8Gd">
                    <div class="transitIndicator__transitBar___2q3uc"></div>
                </div>

                <div class="basicLayout__layoutMain___1NUHo">


                    <div class="basicLayout__pageContainer___2LQ1G">

                        <div class="pagePanel__pagePanelContainer___3FpIY">
                            <div class="pagePanel pagePanel__pagePanel___3fszW contentBase__contentContainer___2oebb pagePanel__auto___1xn2A">
                                <div class="contentBase__headerContainer___aQ_Tu">
                                    <div class="contentBase__statusContainer___1r1Jm">
                                            <span class="ant-dropdown-trigger">
                                                <span class="planStatus__container___3-d71 planStatus__editable___1-vdr">
                                                    <i aria-label="图标: consult-status-0" class="anticon anticon-consult-status-0 planStatus__statusOngoing___TLUgv">
                                                        <img src="/lushu/static/svg/icon-73.svg" style="width: 1rem;height: 1rem">
                                                    </i>
                                                    <span class="planStatus__status___2m1rw" v-if="project_data.is_sale == 0">正在进行</span>
                                                    <span class="planStatus__status___2m1rw" v-else >已完成</span>
                                                </span>
                                                <i aria-label="图标: down" class="anticon anticon-down contentBase__icon___3i5zd">
                                                    <img src="/lushu/static/svg/icon-74.svg" style="width: 1rem;height: 1rem">
                                                </i>
                                            </span>
                                    </div>
                                    <span class="contentBase__actionsContainer___prlIt"></span>
                                </div>
                                <div class="contentBase__contentContainerInner___6KAPZ">
                                    <div class="tripEditPreview__tripEditPrevew___30JYd">
                                        <div class="tripEditPreview__sectionBasicInfo___gwo7S tripEditPreview__anchorItem___3U4fG">
                                            <div id="SectionOverview" class="tripEditPreview__anchorMarker___L0W6l"></div>
                                            <div class="ant-row" style="margin-left: -28px; margin-right: -28px;">
                                                <div class="ant-col-16" style="padding-left: 28px; padding-right: 28px;">
                                                    <div class="tripEditPreview__tripHeader___2cpHr">
                                                        <h1>{{project_data.title}}</h1>
                                                    </div>
                                                    <div class="tripEditPreview__tripMeta___1vXgD">
                                                        <span class="tripEditPreview__departDateRange___1h-Mf">{{project_data.start_time}} ~
                                                            {{project_data.end_time}}
                                                        </span>
                                                        共{{project_data.day}}天
                                                    </div>
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
                                                    <h3 class="tripEditPreview__sectionSubTitle___1Vkyj">行程亮点</h3>
                                                    <div>
                                                        <div class="ant-carousel">
                                                            <div class="slick-slider tripEditPreview__hotelSlider___TQGjo slick-initialized" dir="ltr">
                                                                <button type="button" class="ant-btn slick-arrow slick-prev slick-disabled ant-btn-plain ant-btn-icon-only">
                                                                    <i aria-label="图标: left-circle" class="anticon anticon-left-circle">
                                                                        <img src="/lushu/static/svg/icon-75.svg" style="width: 2rem;height: 2rem">
                                                                    </i>
                                                                </button>
                                                                <div class="slick-list" >
                                                                    <div class="slick-track" style="width: 2496px; opacity: 1; transform: translate3d(0px, 0px, 0px);">
                                                                        <div v-for="(item,index) in project_list.OverviewOfItinerary.Highlights" v-on:click="Getdetails_Tripdata(item.id)" :key="index" :data-index="index" class="slick-slide " tabindex="-1" aria-hidden="false" style="outline: none; width: 416px;">
                                                                            <div>
                                                                                <div class="keypoint__keypoint___18gVZ tripEditPreview__keypoint___PG2hj" style="width: 100%; display: inline-block;">
                                                                                    <div class="keypoint__cover___ffcTY">
                                                                                        <div class="widgets__lushuBackgroundImage___3XMmZ" style="display: flex;background-color: #f4f4f5; border-radius: 10px; justify-content: center; align-items: center; ">
                                                                                            <img v-if="!item.url" src="/lushu/static/svg/icon-104.svg" style="width: 3rem;height: 3rem">
                                                                                            <img v-else  :src="item.url" style="width: 100%;height: 100%">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="keypoint__cont___1W55z">
                                                                                        <h4 class="keypoint__title___EAnXu">{{item.title}}
                                                                                        </h4>
                                                                                        <div class="keypoint__description___oofnF">{{item.content}}</div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                                <button type="button" class="ant-btn slick-arrow slick-next ant-btn-plain ant-btn-icon-only">
                                                                    <i aria-label="图标: right-circle" class="anticon anticon-right-circle">
                                                                        <img src="/lushu/static/svg/icon-77.svg" style="width: 2rem;height: 2rem">
                                                                    </i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div  class="tripEditPreview__sectionSub___1mgKs">
                                                    <h3 class="tripEditPreview__sectionSubTitle___1Vkyj">关于这次旅行</h3>
                                                    <div>
                                                        <div class="widgets__showMoreWrap___3x-uL undefined">
                                                            <div id="itinerary"  class="widgets__allContentContainer___3dOex" style="max-height: 120px; padding-bottom: 0px;">
                                                                <div>
                                                                    <div class="widgets__globalParagraph___2aU6y">
                                                                        <div v-html="project_list.OverviewOfItinerary.content">

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
                                                <div  class="tripEditPreview__sectionSub___1mgKs">
                                                    <h3 class="tripEditPreview__sectionSubTitle___1Vkyj">定制师笔记</h3>
                                                    <div>
                                                        <div class="ant-row" style="margin-left: -8px; margin-right: -8px;">
                                                            <div v-for="(item,index) in project_list.OverviewOfItinerary.note"  :key="index" v-on:click="Getdetails_note_data(item.id)"  class="ant-col-12" style="padding-left: 8px; padding-right: 8px;">
                                                                <div class="note__noteBox___UhFwo note__dark___ZrySZ">
                                                                    <div class="note__noteCover___3XJg6">
                                                                        <div class="widgets__lushuBackgroundImage___3XMmZ" style="display: flex;background-color: #f4f4f5; border-radius: 10px; justify-content: center; align-items: center; ">
                                                                            <img v-if="!item.url" src="/lushu/static/svg/icon-104.svg" style="width: 2rem;height: 2rem">
                                                                            <img v-else  :src="item.url" style="width: 100%;height: 100%">
                                                                        </div>
                                                                    </div>
                                                                    <div class="note__noteCont___2WJA_">
                                                                        <h4>{{item.title}}</h4>
                                                                        {{item.user}}
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div v-if="traffic_list.length > 1" class="tripEditPreview__sectionMain___3ojF5 tripEditPreview__anchorItem___3U4fG">
                                            <h2 class="tripEditPreview__sectionMainTitle___1jNra">
                                                <span>交通方案</span>
                                            </h2>
                                            <div>
                                                <div id="SectionLongTransit" class="tripEditPreview__anchorMarker___L0W6l" style="top: -16px;"></div>
                                                <div  v-for="(item,index) in traffic_list" :key="index" class="longTransitFull__longTransitFull___quurH" >
                                                    <div class="longTransitFull__leftMethod___3TEs6">
                                                        <i aria-label="图标: transit-method-1" class="anticon anticon-transit-method-1 longTransitFull__icon___3lJox">
                                                            <img src="/lushu/static/svg/icon-79.svg" style="width: 1.5rem;height: 1.5rem">
                                                        </i>
                                                        <span class="longTransitFull__dateGroup___1A9Dy">
                                                            <span class="h3 longTransitFull__dayIndex___2-OjW">D{{item.day}}</span>
                                                            <span class="longTransitFull__date___3HqjY">({{item.time}})</span>
                                                        </span>
                                                    </div>
                                                    <div class="longTransitFull__rightTicket___1UuAA">
                                                        <div class="longTransitFull__airportBox___1ZC2j">
                                                            <!--                                                            00:10-->
                                                            <div class="h3 longTransitFull__cityName___2UR2f">{{item.startingPoint.region_name}}</div>
                                                            <!--                                                            <div class="longTransitFull__poiName___2xGuC">北京首都机场T3航站楼</div>-->
                                                        </div>
                                                        <div class="longTransitFull__middleBox___3AuVK">
                                                            <!--                                                            5小时5分钟-->
                                                            <div class="longTransitFull__middleLine___1jlHD"></div>
                                                            {{item.Traffic_value}}
                                                        </div>
                                                        <div class="longTransitFull__airportBox___1ZC2j">
                                                            <!--                                                            05:15-->
                                                            <div class="h3 longTransitFull__cityName___2UR2f">{{item.destination.region_name}}</div>
                                                            <!--                                                            <div class="longTransitFull__poiName___2xGuC">伊斯坦布尔机场I</div>-->
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div  v-if="booking.length > 1" class="tripEditPreview__sectionMain___3ojF5 tripEditPreview__anchorItem___3U4fG">
                                            <h2 class="tripEditPreview__sectionMainTitle___1jNra">
                                                <span>酒店住宿</span>
                                            </h2>
                                            <div>
                                                <div id="SectionHotelAccommodation" class="tripEditPreview__anchorMarker___L0W6l" style="top: -16px;"></div>
                                                <div class="ant-carousel">
                                                    <div class="slick-slider tripEditPreview__hotelSlider___TQGjo slick-initialized" dir="ltr">
                                                        <button type="button" class="ant-btn slick-arrow slick-prev slick-disabled ant-btn-plain ant-btn-icon-only">
                                                            <i aria-label="图标: left-circle" class="anticon anticon-left-circle">
                                                                <img src="/lushu/static/svg/icon-75.svg" style="width: 2rem;height: 2rem">
                                                            </i>
                                                        </button>
                                                        <div class="slick-list">
                                                            <div class="slick-track" style="width: 2185px; opacity: 1; transform: translate3d(0px, 0px, 0px);">



                                                                <div v-for="(item,index) in booking" :key="index"  :data-index="index" class="slick-slide slick-active slick-current" tabindex="-1" aria-hidden="false" style="outline: none; width: 437px;">
                                                                    <div>
                                                                        <div class="hotel__hotel___2VENg">
                                                                            <div class="hotel__cover___2Pf7p">
                                                                                <div class="widgets__lushuBackgroundImage___3XMmZ" style="display: flex;background-color: #f4f4f5; border-radius: 10px; justify-content: center; align-items: center; ">
                                                                                    <img v-if="!item.url" src="/lushu/static/svg/icon-104.svg" style="width: 2rem;height: 2rem">
                                                                                    <img v-else  :src="item.url" style="width: 100%;height: 100%">
                                                                                </div>
                                                                            </div>
                                                                            <div class="hotel__cont___caizp">
                                                                                <div class="hotel__titleGroup___2GCs_">
                                                                                    <h4 class="hotel__titleCn___34Xc-">{{item.name}}</h4>{{item.en_name}}
                                                                                </div>
                                                                                <div class="hotel__dayIndex___26lhC">D{{item.day[0]}} ~ D{{item.day[1]}}</div>
                                                                                {{item.time}}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>


                                                            </div>
                                                        </div>
                                                        <button type="button" class="ant-btn slick-arrow slick-next ant-btn-plain ant-btn-icon-only">
                                                            <i aria-label="图标: right-circle" class="anticon anticon-right-circle">
                                                                <img src="/lushu/static/svg/icon-77.svg" style="width: 2rem;height: 2rem">
                                                            </i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tripEditPreview__sectionMain___3ojF5">
                                            <h2 class="tripEditPreview__sectionMainTitle___1jNra">
                                                <span>行程路线</span>
                                            </h2>
                                            <div>


                                                <div v-for="(item,index) in TravelRoute" :key="index" class="tripEditPreview__tripDay___c9zgQ tripEditPreview__anchorItem___3U4fG">
                                                    <div :id="'D'+item.day" class="tripEditPreview__anchorMarker___L0W6l"></div>
                                                    <div class="tripEditPreview__tripDayHeader___xBHBj">
                                                        <div class="tripEditPreview__leftDate____x-D2">
                                                            <div class="tripEditPreview__dayIndex___3A60s">D{{item.day}}</div>
                                                            <div>{{item.time}}</div>
                                                        </div>
                                                        <div class="tripEditPreview__dayCityList___2pa-M">
                                                            <span v-for="(a,b) in  item.city" :key="b" class="tripEditPreview__dayCity___3VI9K">
                                                                <i v-if="b==0" aria-label="图标: flag" class="anticon anticon-flag iconFlag tripEditPreview__iconFlag___35kIa">
                                                                    <img src="/lushu/static/svg/icon-81.svg" style="width: 2rem;height: 2rem">
                                                                </i>
                                                                <span>{{a.value}}</span>
                                                                <i aria-label="图标: swap-right" class="anticon anticon-swap-right tripEditPreview__dayCityIcon___3I70F">
                                                                    <img src="/lushu/static/svg/icon-82.svg" style="width: 2rem;height: 2rem">
                                                                </i>
                                                            </span>

                                                        </div>
                                                    </div>
                                                    <div v-if="item.restaurant.breakfast || item.restaurant.dinner || item.restaurant.lunch" class="mealList__mealListWrap___2D_6Y mealList__preview___3qkkJ">
                                                        <div class="mealList__mealList___3fEB_">
                                                            <i aria-label="图标: poi-method-1" class="anticon anticon-poi-method-1 mealList__icon___On4se">
                                                                <img src="/lushu/static/svg/icon-83.svg" style="width: 0.6rem;height: 0.6rem">
                                                            </i>
                                                            <div class="mealList__mealBox___2VU-l">
                                                                <span class="mealList__label___3T8Vn">早</span>{{item.restaurant.breakfast}}
                                                            </div>
                                                            <div class="mealList__mealBox___2VU-l">
                                                                <span class="mealList__label___3T8Vn">午</span>{{item.restaurant.lunch}}
                                                            </div>
                                                            <div class="mealList__mealBox___2VU-l">
                                                                <span class="mealList__label___3T8Vn">晚</span>{{item.restaurant.dinner}}
                                                            </div>
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
                                                    <div v-if="item.note.length > 0" class="tripEditPreview__sectionSub___1mgKs">
                                                        <h3 class="tripEditPreview__sectionSubTitle___1Vkyj">定制师笔记</h3>
                                                        <div>
                                                            <div class="ant-row" style="margin-left: -8px; margin-right: -8px;">

                                                                <div v-for="(a,b) in item.note" :key="index" v-on:click="Getdetails_note_data(a.id)" class="ant-col-12" style="padding-left: 8px; padding-right: 8px;">
                                                                    <div class="note__noteBox___UhFwo note__dark___ZrySZ">
                                                                        <div class="note__noteCover___3XJg6">
                                                                            <div class="widgets__lushuBackgroundImage___3XMmZ" style="display: flex;background-color: #f4f4f5; border-radius: 10px; justify-content: center; align-items: center; ">
                                                                                <img v-if="!a.url" src="/lushu/static/svg/icon-104.svg" style="width: 2rem;height: 2rem">
                                                                                <img v-else  :src="a.url" style="width: 100%;height: 100%">
                                                                            </div>
                                                                        </div>
                                                                        <div class="note__noteCont___2WJA_">
                                                                            <h4>{{a.title}}</h4>
                                                                            {{a.user}}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tripEditPreview__sectionSub___1mgKs">
                                                        <h3 class="tripEditPreview__sectionSubTitle___1Vkyj">日程安排</h3>
                                                        <div>
                                                            <div class="tripDayAgendaList__agendaListWrap___3nBzv tripDayAgendaList__preview___3Kvhq">
                                                                <div v-for="(a,b) in item.traffic"   class="longTransit__longTransit___3KNeD tripDayAgendaList__longTransit___1klQm">

                                                                    <div class="longTransit__info___2-j7o">
                                                                        <div class="longTransit__depart___3yGzq">
                                                                            <div class="longTransit__city___2gqSa">{{a.startingPoint.region_name}}</div>
                                                                            <!--                                                                            <div class="longTransit__time___1qKN0">00:10</div>-->
                                                                        </div>
                                                                        <div class="longTransit__method___1RDka">
                                                                            <div class="longTransit__name___24v8m">
                                                                                <i aria-label="图标: transit-method-1" class="anticon anticon-transit-method-1 longTransit__icon___15Lgw">
                                                                                    <img src="/lushu/static/svg/icon-79.svg" style="width: 0.6rem;height: 0.6rem">
                                                                                </i>{{a.Traffic_value}}
                                                                            </div>
                                                                            <div class="longTransit__arrow___7sUsx">
                                                                                <img src="//static.lushu.com/images/new/transit-arrow.svg">
                                                                            </div>
                                                                            <!--                                                                            <span>5小时5分钟</span>-->
                                                                        </div>
                                                                        <div class="longTransit__arrive___3WqQB">
                                                                            <div class="longTransit__city___2gqSa">{{a.destination.region_name}}</div>
                                                                            <!--                                                                            <div class="longTransit__time___1qKN0">05:15</div>-->
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div v-for="(a,b) in item.schedule" v-on:click="Getdetails_Resources_data(a.schedule,a.type)">
                                                                    <div class="tripDayAgendaList__agendaItem___1E2QK">
                                                                        <span class="tripDayAgendaList__indexNum___fNUg5">{{a.poi_sort}}</span>
                                                                        <span class="tripDayAgendaList__icon___84ljn">
                                                                        <i aria-label="图标: poi-method-2" class="anticon anticon-poi-method-2">
                                                                            <img src="/lushu/static/svg/icon-101.svg" style="width: 1rem;height: 1rem">
                                                                        </i>
                                                                    </span>
                                                                        <div class="tripDayAgendaList__title___3S1R9">{{a.title}}</div>
                                                                    </div>
                                                                    <div class="tripDayAgendaList__transit___2luVb">
                                                                        <span>.</span>{{a.traffic}}
                                                                    </div>
                                                                </div>
                                                                <div  v-if="item.hotel" class="tripDayAgendaList__agendaItem___1E2QK">
                                                                    <!--                                                                    <span class="tripDayAgendaList__indexNum___fNUg5">9</span>-->
                                                                    <span class="tripDayAgendaList__icon___84ljn tripDayAgendaList__accomadation___3dc0N">
                                                                        <i aria-label="图标: poi-method-2" class="anticon anticon-poi-method-2">
                                                                            <img src="/lushu/static/svg/icon-103.svg" style="width: 1rem;height: 1rem">
                                                                        </i>
                                                                    </span>
                                                                    <div v-if="item.hotel.name" class="tripDayAgendaList__title___3S1R9">{{item.hotel.name.title}}</div>
                                                                    <div class="tripDayAgendaList__accomadationType___GSDqs">住宿</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>






                                            </div>
                                        </div>
                                        <div class="tripEditPreview__anchorNav___3GIgu anchorNav__anchorNav___qOm_3">
                                            <div style="">
                                                <div class="" style="">
                                                    <div class="ant-anchor-wrapper" style="max-height: 100vh;">
                                                        <div class="ant-anchor">
                                                            <div class="ant-anchor-ink">
                                                                <span class="ant-anchor-ink-ball visible" style="top: 15.5px;"></span>
                                                            </div>
                                                            <div class="ant-anchor-link ant-anchor-link-active">
                                                                <a class="ant-anchor-link-title ant-anchor-link-title-active" href="#SectionOverview" title="行程总览">行程总览</a>
                                                            </div>
                                                            <div class="ant-anchor-link">
                                                                <a class="ant-anchor-link-title" href="#SectionLongTransit" title="交通方案">交通方案</a>
                                                            </div>
                                                            <div class="ant-anchor-link">
                                                                <a class="ant-anchor-link-title" href="#SectionHotelAccommodation" title="酒店住宿">酒店住宿</a>
                                                            </div>
                                                            <div class="ant-anchor-link" v-for="(item,index) in day_list">
                                                                <a class="ant-anchor-link-title" :href="'#D'+item.day" :title="'D'+item.day">D{{item.day}}</a>
                                                            </div>

                                                            <div class="anchorNav__anchorMenu___2faDZ">
                                                                <button type="button" class="ant-btn anchorNav__triggerIcon___1m89_ ant-dropdown-trigger ant-btn-plain ant-btn-lg ant-btn-icon-only">
                                                                    <i aria-label="图标: down" class="anticon anticon-down">
                                                                        <img src="/lushu/static/svg/icon-84.svg" style="width: 1rem;height: 1rem">
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
                            <div class="pagePanelGroup pagePanel__pagePanelGroup___19_UR pagePanel__sider___3KzU1" style="flex: 0 0 320px; max-width: 320px; min-width: 320px; width: 320px;">
                                <div class="pagePanel pagePanel__pagePanel___3fszW templateDetail__bookingAndTripQuoteContainer___3vl4z">
                                    <div class="templateDetail__title___2l9Uf">费用核算与行程报价</div>
                                    <div class="templateDetail__subTitle___fXLmt">
                                        <span class="templateDetail__name___2q6rp">费用核算：</span>
                                        <span v-on:click="GetCost" class="templateDetail__content___3tSRQ">查看详情</span>
                                    </div>
                                    <div class="templateDetail__subTitle___fXLmt">
                                        <span class="templateDetail__name___2q6rp">行程报价：</span>
                                        <span  v-on:click="GetQuotation" class="templateDetail__content___3tSRQ">查看详情</span>
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

    <!--    各种详情页面-->
    <?php include(dirname(__FILE__,2) . '/details/note.php');//笔记详情?>
    <?php include(dirname(__FILE__,2) . '/details/poi_view.php');//笔记详情?>
    <?php include(dirname(__FILE__,2) . '/details/Highlights.php');//亮点详情?>
    <?php include(dirname(__FILE__,2) . '/layout/export_Cost.php');?>
    <?php include(dirname(__FILE__,2) . '/layout/export_quotation.php');?>
</div>



</body>

</html>