<?php include(dirname(__FILE__,2) . '/layout/header.php');?>
<style>
        #webMain{
                    height: 100vh!important;
                    overflow-y: auto!important;
                }
                 .trial{
                     height:calc(100vh)!important;
                }
                .swiper-container {
                     height:calc(100vh)!important;
                      overflow-y: auto!important;
                }
                .active {
                    color: #00A4A8!important;
                }
        </style>
<body class="appName-shareweb">


<div id="webMain" ref="pageTop">
    <div class="">
        
        <div class="tosProjectCssMarker pageViewTrip  swiperPc loaded">
            
            <div class="transitIndicator">
                <div class="transitBar"></div>
            </div>
            <div class="scoll">
                <div class="tripViewMainCover hMobile">
                    <div class="tripCover ">
                        <div class="cover" style="background-image: url(<?=$_static?>/user/share.jpg);"></div>
                        <div class="briefInfo">
                            <div class="tripHeader">
                                <div class="coverIcon" style="margin: 10px auto 5px;width: 200px;height: 200px;">
                                    <img v-if="!project_data.url" src="/lushu/static/svg/icon-104.svg" style="width: 15rem;height: 15rem">
                                    <img v-else  :src="project_data.url" style="width: 100%;height: 100%;border-radius: 100px">
                                </div>
                                <div class="title">{{project_data.title}}</div>
                                <div class="date">{{project_data.start_time}} ~ {{project_data.end_time}}</div>
                                <div class="author"><?=$ApplicationName?>为您定制的路书</div>
                            </div>
                        </div>
                        <div class="tripTop"><?=$ApplicationName?>提供技术支持</div>
                    </div>
                </div>
                <div class="tripContWrap ">
                    <div class="viewTripMap" style="height: 953px;">
                        <div class="map__piecefulMap___cY63A viewMapBlock">

                            <div class="map__mapBlock___2rphQ mapboxgl-map">
                                <iframe src="layout/map_edit.php"  id="map_poi_view" width="100%" height="100%"></iframe>
                            </div>
                        </div>
                    </div>
                    <div class="sideBar mobileHide">
                        <div class="sideBarBtns sideTop">
                            <div class="btnPage active section0">
                                <i class="tos-icon icon-route"></i>行程路线
                            </div>
                            <div class="border"></div>
                        </div>
                        <ul>
                            <a v-for="(item,index) in TravelRoute" :key="index" :href="'#day'+item.day" v-on:click="getMap_href(item.day)">
                                <li  class="btnPage"  :class="day_number == item.day? 'active':''">
                                    <span class="dayIndex">D{{item.day}}</span>
                                    <span class="city"  v-for="(a,b) in  item.city" :key="b">
                                            <i  v-if="index==0 && b == 0" class="tos-icon icon-point"></i>
                                        {{a.value}}
                                    </span>
                                </li>
                            </a>

                        </ul>
                        <div class="sideBarBtns sideBtm">
                            <div class="border"></div>
                        </div>
                    </div>
                    <div class="tripViewContainer main ">
                        <div class="swiper-container">
                            <div class="swiper-wrapper">

                                <div class="swiper-slide" id="section_schedule">
                                    <div class="inner" id="section0">
                                        <div class="slideHeader" class="active">行程路线</div>
                                        <div>
                                            <div class="cityDayList clear">
                                                <div class="tripDay" v-for="(item,index) in TravelRoute" :key="index" >
                                                    <div class="left">
                                                        <div class="dayIndex">D{{item.day}}</div>
                                                        <div class="date">
                                                            <span class="dateDay">{{item.time}}</span>
                                                            <span class="dateWeek">{{item.work}}</span>
                                                        </div>
                                                    </div>
                                                    <div class="cities">
                                                        <span class="city"  v-for="(a,b) in  item.city" :key="b">
                                                                <i  v-if="index==0 && b == 0" class="tos-icon icon-point"></i>
                                                            {{a.value}}
                                                        </span>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide" v-for="(item,index) in TravelRoute" :key="index" :id="'section' + (index+1)">
                                     <a class="getScroll" :id="'day'+item.day"></a>
                                    <div class="dayAgenda inner">
                                        <div class="slideHeader">
                                            <div class="dayNum">D{{item.day}}</div>

                                            <div class="dayNumRight">
                                                <div class="dateEleSpace">
                                                    <div class="date">
                                                        <span class="dateDay">{{item.time}}</span>
                                                        <span class="dateWeek">{{item.work}}</span>
                                                    </div>
                                                </div>
                                                <div class="cities">
                                                    <span class="city"  v-for="(a,b) in  item.city" :key="b">
                                                            <i  v-if="index==0 && b == 0" class="tos-icon icon-point"></i>
                                                        {{a.value}}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="introduction tripDayIntroduction" v-if="item.content">
                                                <div class="articleCont articleTxt" v-html="item.content">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="notes" v-if="item.note.length > 0">
                                            <div class="row">
                                                <div class="col-md-12 notesHeader">
                                                    <div class="noteSubHeader">
                                                        <span class="subTitle">定制师笔记</span>
                                                    </div>
                                                </div>
                                                <div v-for="(a,b) in item.note" :key="index" v-on:click="Getdetails_note_data(a.id)" class="col-md-6 col-sm-12">
                                                    <div class="noteBriefPiece">
                                                        <i v-if="!a.url" class="iconCard icon-note"></i>
                                                        <img  v-else  :src="a.url"  class="cover">
                                                        <div class="noteTitle">{{a.title}}</div>
                                                        <div class="smallLink">点击查看<i class="icon-navigateright"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="agendaSection" v-if="item.schedule.length > 0">
                                            <div class="slideSubHeader">
                                                <span class="subTitle">D{{item.day}} 日程安排</span>
                                            </div>
                                            <div class="tripViewAgendaList">
                                                <div v-for="(a,b) in item.schedule">
                                                    <div class="agendaBox expand expandAll">
<!--                                                        <div class="indexNum">1</div>-->
                                                        <div v-if="a.picture" class="coverWrap coverWrapHover" :style="'background-image: url('+a.picture+'); background-color: rgb(145, 166, 167);'"></div>
                                                        <div class="txtCont icon-triangle">
                                                            <div class="agendaPoi">
                                                                <i class="tos-icon icon-tag-4-tour"></i>
                                                                <span class="title">{{a.title}}</span>
                                                            </div>
                                                            <div v-if="a.introduction" class="detailBox">
                                                                <div class="detailSection poiSection">
                                                                    <div v-html="a.introduction" class="subSection hideAgendaDetails">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div v-if="(b+1) != item.schedule.length" class="tripAgendaTransitBox">
                                                        <div class="transitIcon">
                                                            <i class="transitMethod tos-icon tos-icon icon-bus"></i>
                                                        </div>
                                                        <div class="transitInfo">
                                                            <div class="item">{{a.traffic}}</div>
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

    <?php include(dirname(__FILE__,2) . '/details/notes.php');//亮点详情?>


</div>




</body>