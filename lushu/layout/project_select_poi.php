<div id="modalWrap"  class="slideDownMap editLocationMap tosProjectCssMarker modalWrap"  style="display: none;z-index: 9999999;">
    <div class="mapContent shown">
        <div class="map__piecefulMap___cY63A mapBlock slideDownMapBLock">

            <div class="map__mapBlock___2rphQ mapboxgl-map">
                <div class="mapboxgl-canary" style="visibility: hidden;"></div>
                <div style="height: 100%;" class="mapboxgl-canvas-container mapboxgl-interactive mapboxgl-touch-drag-pan mapboxgl-touch-zoom-rotate">
                    <iframe  src="layout/map_select_poi.php"  id="map_edit" width="100%" height="100%"></iframe>
                </div>

            </div>
        </div>
        <div class="editLocations">
            <div class="searchPoiAddress">
                <form  @submit.prevent="search_poi">
                    <input type="submit" value="on" style="display: none">
                    <div class="searchWrap searchWrapL">
                        <div class="searchBar">
                            <i class="btn-search  icon-search"></i>
                            <input type="text" class="search" v-model="poi_value"   placeholder="请输入POI名称" value="" >
                        </div>
                    </div>
                    <div class="traffic_body" style="top: 59px;width: 100%;display: none;max-height: 500px;overflow: auto;" >
                        <div class="traffic_list" v-for="(item,index) in search_data.poi_list" :key="index" v-on:click="add_poi_address(item)">
                            <div class="city_name">{{item.title}}</div>
                            <div class="city_enname" style="margin-top: 13px;">{{item.address}} </div>
                        </div>
                        <div v-if="!search_data.poi_list" class="traffic_list" >
                            <div class="traffic_name" style="padding: unset;">搜索中.请稍候！</div>
                        </div>
                        <div class="traffic_list" >
                            <div class="traffic_name" style="padding: unset;"><img src="/lushu/static/svg/icon-60.svg" style="width: 1rem;height: 1rem;margin-right: 5px">添加poi</div>
                        </div>
                    </div>
                </form>

            </div>
            <div class="poiShortcuts">
                <div class="poiBtn" v-for="(item,index) in association_code">
                    <i class="icon icon-tag-4-tour"></i>
                    <span class="name">{{item.value}}</span>
                    <span class="removePoi icon-close" v-on:click="Del_poi(item.id,index)"></span>
                </div>
<!--                <div class="poiBtn">-->
<!--                    <i class="icon icon-tag-3-traveling"></i>-->
<!--                    <span class="name">黄山机场</span>-->
<!--                    <span class="removePoi icon-close"></span>-->
<!--                </div>-->
            </div>
            <a href="javascript:void(0)" class="closeMapBtn" onclick="closeMap()"><i class="icon-close"></i></a>
        </div>

    </div>

</div>
