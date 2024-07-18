<div id="poi_details" style="display: none;position: absolute" class="exploreDetailsWrapper">
    <div class="tosProjectCssMarker popUpModal modalWrap centerPage tosBase exploreItem explorePoiDetails explorePoiDetails">
        <div class="content">
            <div class="head">
                <h5 class="modalTitle">查看POI详情</h5>
                <div class="actions">
                    <a href="javascript:void(0)"  v-on:click="Add_poiProject"  class="btnBorderGreen">
                        <i class="tos-icon icon-plus"></i>添加到行程
                    </a>
                </div>
                <span class="btnClose" onclick="$('#poi_details').hide()">
					<i class="icon-close"></i>
				</span>
            </div>
            <div class="body">
                
                <div class="detailsContent" style="top:0;">
                    <div class="cardDetailContainer poiDetailsContent clear">
                        <h4 class="templateBasicHeader">{{details_poi.title}}</h4>
                        <div class="mainCont">
                            <div class="jsonSchemaListWrapper">
                                <div class="field" v-if="details_poi.en_title">
                                    <label>英文名称</label>
                                    <div class="fieldContent clear">
                                        <span>{{details_poi.en_title}}</span>
                                    </div>
                                </div>
                                <div class="field" v-if="details_poi.other_title">
                                    <label>其他名称</label>
                                    <div class="fieldContent clear">
                                        <span>{{details_poi.other_title}}</span>
                                    </div>
                                </div>
                                <div class="field" v-if="details_poi.type">
                                    <label>POI类型</label>
                                    <div class="fieldContent clear">
                                        <div class="poiType">
                                            <i v-if="details_poi.type == 1" class="poiIcon tos-icon icon-tag-1-food"></i>
                                            <i v-if="details_poi.type == 2" class="poiIcon tos-icon icon-tag-4-tour"></i>
                                            <i v-if="details_poi.type == 3" class="poiIcon tos-icon icon-tag-5-shopping"></i>
                                            <i v-if="details_poi.type == 4" class="poiIcon tos-icon icon-tag-2-hotel"></i>
                                            <i v-if="details_poi.type == 5" class="poiIcon tos-icon icon-tag-4-tour"></i>
                                            <i v-if="details_poi.type == 7" class="poiIcon tos-icon icon-tag-3-traveling"></i>
                                            <span class="poiText">{{details_poi.type_value}}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="field" v-if="details_poi.phone">
                                    <label>电话</label>
                                    <div class="fieldContent clear">
                                        <span>{{details_poi.phone}}</span>
                                    </div>
                                </div>
                                <div class="field" v-if="details_poi.official_web">
                                    <label>网址</label>
                                    <div class="fieldContent clear">
                                        <span>{{details_poi.official_web}}</span>
                                    </div>
                                </div>
                                <div class="field" v-if="details_poi.opening_hours">
                                    <label>开放时间</label>
                                    <div class="fieldContent clear">
                                        <span>{{details_poi.opening_hours}}</span>
                                    </div>
                                </div>
                                <div class="field" v-if="details_poi.consumption">
                                    <label>消费</label>
                                    <div class="fieldContent clear">
                                        <span>{{details_poi.consumption}}</span>
                                    </div>
                                </div>
                                <div class="field" v-if="details_poi.traffic">
                                    <label>交通</label>
                                    <div class="fieldContent clear">
                                        <span>{{details_poi.traffic}}</span>
                                    </div>
                                </div>
                                <div class="field" v-if="details_poi.time_reference">
                                    <label>用时参考</label>
                                    <div class="fieldContent clear">
                                        <span>{{details_poi.time_reference}}</span>
                                    </div>
                                </div>
                                <div class="field" v-if="details_poi.introduction">
                                    <label>地点简介</label>
                                    <div class="fieldContent clear">
                                        <span>{{details_poi.introduction}}</span>
                                    </div>
                                </div>
                                <div class="field" v-if="details_poi.guide">
                                    <label>实用指南</label>
                                    <div class="fieldContent clear">
                                        <span>{{details_poi.guide}}</span>
                                    </div>
                                </div>
                                
                                
                                
                                
                            </div>
                        </div>
                        <div class="subCont">
                            <div class="subRow" v-if="details_poi.lng && details_poi.lat">
                                <h6>地理位置</h6>
                                <div class="inner">
                                    <div class="location">
                                        <iframe  :src="'layout/map_view.php?lng='+details_poi.lng+'&lat='+details_poi.lat" width="100%" height="100%"></iframe>

                                        <div class="address">{{details_poi.address}}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="subRow" v-if="details_poi.address_code.length >1">
                                <h6>相关目的地</h6>
                                <div class="inner">
                                    <div class="relatedDestinationList relatedItemList clear">
                                        <div>
                                            <div>
                                                
                                                <div class="item country " v-for="(item,index) in details_poi.address_code" :key="index">
                                                    <!--                                                    <span class="destinationListText__country___GMItw">德国</span>-->
                                                    <span>{{item}}</span>
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

