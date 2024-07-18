<div id="poi_details" style="display: none;position: absolute">
    <div class="ant-drawer ant-drawer-right ant-drawer-open" style="">
        <div class="ant-drawer-mask"></div>
        <div class="ant-drawer-content-wrapper" style="width: 824px;">
            <div class="ant-drawer-content">
                <div class="ant-drawer-wrapper-body" style="overflow: auto; height: 100%;">
                    <div class="ant-drawer-header">
                        <div class="ant-drawer-title">POI详情</div>
                        <div class="ant-drawer-right-actions">
                            <button aria-label="Close" onclick="$('#poi_details').hide()" class="ant-drawer-close">
                                <i aria-label="图标: close" class="anticon anticon-close">
                                    <img src="/lushu/static/svg/icon-11.svg" style="width: 1rem;height: 1rem">
                                </i>
                            </button>
                        </div>
                    </div>
                    <div class="ant-drawer-body">
                        <div class="tripPoiDetailPreview__container___FliB-">
                            <div class="iconHeader__title___1Fei8">
                                {{details_poi.title}}
                            </div>
                            <div class="tripPoiDetailPreview__pictures___2w3vJ" v-if="details_poi.picture">
                                <div class="ant-carousel">
                                    <div class="slick-slider slick-initialized">
                                        <div class="slick-list">
                                            <div class="slick-track" style="width: 720px; opacity: 1; transform: translate3d(0px, 0px, 0px);">
                                                <div data-index="0" class="slick-slide slick-active slick-current" tabindex="-1" aria-hidden="false" style="outline: none; width: 720px;">
                                                    <div>
                                                        <div tabindex="-1" style="width: 100%; display: inline-block;">
                                                            <div class="tripPoiDetailPreview__picture___2g6l7" :style="'background-image: url('+details_poi.picture+'); width: 720px; height: 380px;'"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tripPoiDetailPreview__divider___cb_DN ant-divider ant-divider-horizontal"></div>
                            <div class="tripPoiDetailPreview__poiViewInfo___3ZrMa">
                                <table class="tripPoiDetailPreview__infoList___3FPzE">
                                    <tbody  v-if="details_poi.en_title">
                                        <tr class="tripPoiDetailPreview__item___akK6a" >
                                            <td class="tripPoiDetailPreview__title___1o9qd">英文名称</td>
                                            <td class="tripPoiDetailPreview__content___3v4Ow">{{details_poi.en_title}}</td>
                                        </tr>
                                    </tbody>
                                    <tbody  v-if="details_poi.other_title">
                                        <tr class="tripPoiDetailPreview__item___akK6a" >
                                            <td class="tripPoiDetailPreview__title___1o9qd">其他名称</td>
                                            <td class="tripPoiDetailPreview__content___3v4Ow">{{details_poi.other_title}}</td>
                                        </tr>
                                    </tbody>
                                    <tbody  v-if="details_poi.phone">
                                        <tr class="tripPoiDetailPreview__item___akK6a" >
                                            <td class="tripPoiDetailPreview__title___1o9qd">电话</td>
                                            <td class="tripPoiDetailPreview__content___3v4Ow">{{details_poi.phone}}</td>
                                        </tr>
                                    </tbody>
                                    <tbody  v-if="details_poi.official_web">
                                        <tr class="tripPoiDetailPreview__item___akK6a" >
                                            <td class="tripPoiDetailPreview__title___1o9qd">网址</td>
                                            <td class="tripPoiDetailPreview__content___3v4Ow">{{details_poi.official_web}}</td>
                                        </tr>
                                    </tbody>
                                    <tbody  v-if="details_poi.opening_hours">
                                        <tr class="tripPoiDetailPreview__item___akK6a" >
                                            <td class="tripPoiDetailPreview__title___1o9qd">开放时间</td>
                                            <td class="tripPoiDetailPreview__content___3v4Ow">{{details_poi.opening_hours}}</td>
                                        </tr>
                                    </tbody>
                                    <tbody  v-if="details_poi.consumption">
                                        <tr class="tripPoiDetailPreview__item___akK6a" >
                                            <td class="tripPoiDetailPreview__title___1o9qd">消费</td>
                                            <td class="tripPoiDetailPreview__content___3v4Ow">{{details_poi.consumption}}</td>
                                        </tr>
                                    </tbody>
                                    <tbody  v-if="details_poi.traffic">
                                        <tr class="tripPoiDetailPreview__item___akK6a" >
                                            <td class="tripPoiDetailPreview__title___1o9qd">交通</td>
                                            <td class="tripPoiDetailPreview__content___3v4Ow">{{details_poi.traffic}}</td>
                                        </tr>
                                    </tbody>
                                    <tbody  v-if="details_poi.introduction">
                                        <tr class="tripPoiDetailPreview__item___akK6a" >
                                            <td class="tripPoiDetailPreview__title___1o9qd">地点简介</td>
                                            <td class="tripPoiDetailPreview__content___3v4Ow">{{details_poi.introduction}}</td>
                                        </tr>
                                    </tbody>
                                    <tbody  v-if="details_poi.guide">
                                    <tr class="tripPoiDetailPreview__item___akK6a" >
                                        <td class="tripPoiDetailPreview__title___1o9qd">实用指南</td>
                                        <td class="tripPoiDetailPreview__content___3v4Ow" v-html="details_poi.guide"></td>
                                    </tr>
                                    </tbody>


                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>