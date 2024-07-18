<form class="ant-form ant-form-horizontal" @submit.prevent="search">
    <input type="submit" value="on" style="display: none">
    <div class="pageFilter__pageFilterRow___2A-U3 projectLibrary__options___3LHP1 clear">
        <span class="pageFilter__pageFilterCell___2PklM">
            <span class="projectLibrary__queryInput___2d_Ho ant-input-affix-wrapper">
                <span class="ant-input-prefix">
                    <i aria-label="图标: search" class="anticon anticon-search projectLibrary__icon___17-Md">
                        <img src="/lushu/static/svg/icon-59.svg" style="width: 1rem;height: 1rem">
                    </i>
                </span>
                <input type="text" v-model="project_search.title" placeholder="搜索关键字" class="ant-input ant-input-dark" value="">
            </span>
        </span>
        <span class="pageFilter__pageFilterCell___2PklM projectLibrary__inputGroup___21As7">
            <span class="pageFilter__pageFilterGroup___1zgfD">
                <div class="destinationAutoComplete__container___2u6IR poiList__queryInput___13z3V">
                    <div class="ant-row ant-form-item">
                    <div class="ant-form-item-control-wrapper">
                        <div class="ant-form-item-control">
                            <span class="ant-form-item-children">
                                <div id="dest" class="ant-select-show-search ant-select-auto-complete ant-select ant-select-combobox ant-select-enabled ant-select-allow-clear">
                                    <div class="ant-select-selection ant-select-selection--single" role="combobox" aria-autocomplete="list" aria-haspopup="true" aria-controls="" aria-expanded="false" data-__meta="[object Object]" data-__field="[object Object]">
                                        <div class="ant-select-selection__rendered">
                                            <ul>
                                                <li class="ant-select-search ant-select-search--inline">
                                                    <div class="ant-select-search__field__wrap">
                                                        <span class="ant-select-search__field ant-input-affix-wrapper">
                                                            <span class="ant-input-prefix">
                                                                <i aria-label="图标: location" class="anticonanticon-location destinationAutoComplete__icon___2aPbK">
                                                                    <img src="/lushu/static/svg/icon-17.svg" style="width: 1rem;height: 1rem">
                                                                </i>
                                                            </span>
                                                            <input  v-model="project_search.address_value" @input="search_address"  type="text" class="ant-input input-area ant-input-dark"  placeholder="相关目的地" value="">
                                                        </span>
                                                        <div class="city_body"   style="display: none;">
                                                            <div class="city_list" v-for="item in city_address.city" :key="item.id" v-on:click="add_search_address(item,1)">
                                                                <div class="city_name">{{item.region_name}}</div>
                                                                <div class="city_enname">{{item.en_name}}  {{item.parent.region_name}}</div>
                                                            </div>
                                                            <div class="city_user" v-if="city_address.user.length > 0">以下为用户创建内容</div>
                                                            <div class="city_list"  v-for="item in city_address.user" :key="item.id" v-on:click="add_search_address(item,1)">
                                                                 <div class="city_name">{{item.region_name}}</div>
                                                                <div class="city_enname">{{item.en_name}}  {{item.parent.region_name}}</div>
                                                                <div class="city_icon">
                                                                    <img src="/lushu/static/svg/icon-15.svg" style="width: 1rem;height: 1rem">
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <span class="ant-select-search__field__mirror">&nbsp;</span>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <span class="ant-select-arrow" style="user-select:none;-webkit-user-select:none" >
                                            <i aria-label="图标: down" class="anticon anticon-down  ant-select-arrow-icon">
                                                <img src="/lushu/static/svg/icon-18.svg" style="width: 1rem;height: 1rem">
                                            </i>
                                        </span>
                                    </div>
                                </div>
                            </span>
                        </div>
                    </div>
                </div>
                </div>
                <div class="inputDuration__inputDurationPopover___3CXS7">
                    <span class="inputDuration__input___2Klnp projectLibrary__queryDays___2BesO ant-input-affix-wrapper">
                        <span class="ant-input-prefix">
                            <i aria-label="图标: day" class="anticon anticon-day inputDuration__icon___3Wa67">
                                <img src="/lushu/static/svg/icon-86.svg" style="width: 1rem; height: 1rem;">
                            </i>
                        </span>
                        <input type="text" v-model="project_search.day_value" class="ant-input ant-input-dark days" placeholder="出行天数" onclick="$('.outDays').css('display', 'block');showSider()" value="">
                        <span class="ant-input-suffix"></span>
                    </span>
                </div>

            </span>
        </span>
        <span class="pageFilter__pageFilterCell___2PklM">
            <div class="poiSimpleAutoComplete__container___3dzBa">
                <div class="ant-row ant-form-item">
                    <div class="ant-form-item-control-wrapper">
                        <div class="ant-form-item-control">
                            <span class="ant-form-item-children">
                                <div id="poi" class="ant-select-show-search ant-select-auto-complete ant-select ant-select-combobox ant-select-enabled ant-select-allow-clear">
                                    <div class="ant-select-selection ant-select-selection--single" role="combobox" aria-autocomplete="list" aria-haspopup="true" aria-controls="" aria-expanded="false" data-__meta="[object Object]" data-__field="[object Object]">
                                        <div class="ant-select-selection__rendered">
                                            <ul>
                                                <li class="ant-select-search ant-select-search--inline">
                                                    <div class="ant-select-search__field__wrap">
                                                        <span class="ant-select-search__field ant-input-affix-wrapper" style="width:150px">
                                                            <span class="ant-input-prefix">
                                                                <i aria-label="图标: poi-method-4" class="anticon anticon-poi-method-4 poiSimpleAutoComplete__icon___3v5LA">
                                                                    <img src="/lushu/static/svg/icon-87.svg" style="width: 1rem; height: 1rem;">
                                                                </i>
                                                            </span>
                                                            <input type="text" v-model="poi_value" @blur="search_poi" class="ant-input ant-input-dark" placeholder="相关POI" value="">
                                                        </span>
                                                        <span class="ant-select-search__field__mirror">
                                                        </span>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="traffic_body" style="top: 59px;width: 100%;max-height: 500px;overflow: auto;" v-if="poi_list.length > 0">
                                            <div class="traffic_list" v-for="(item,index) in poi_list" :key="index" v-on:click="add_poi_address(item)">
                                                <div class="city_name" style="line-height:16px;padding: 9px 0 1px 2px;">{{item.title}}</div>
                                                <!--                                                <div class="city_enname" style="margin-top: 13px;overflow: hidden">{{item.address}} </div>-->
                                            </div>
                                            <div v-if="!poi_list" class="traffic_list" >
                                                <div class="traffic_name" style="padding: unset;">搜索中.请稍候！</div>
                                            </div>
                                        </div>
                                        <span class="ant-select-arrow" style="user-select:none;-webkit-user-select:none" unselectable="on">
                                            <i aria-label="图标: down" class="anticon anticon-down ant-select-arrow-icon">
                                                <img src="/lushu/static/svg/icon-88.svg" style="width: 1rem; height: 1rem;">
                                            </i>
                                        </span>
                                    </div>
                                </div>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </span>


    </div>
</form>


<!-- 出行天数 -->
<div style="position: absolute; top: 0px; left: 0px; width: 100%;display: none;" class="outDays">
    <div onclick="$('.outDays').css('display', 'none')">
        <div class="ant-popover ant-popover-placement-bottomLeft" onclick="(function (event) {event= event || window.event;console.log(event);event.stopPropagation()})()" style="left: 576px; top: 160px;
          transform-origin: 0px 0px;">
            <div class="ant-popover-content">
                <div class="ant-popover-arrow"></div>
                <div class="ant-popover-inner" role="tooltip">
                    <div>
                        <div class="ant-popover-inner-content">
                            <div class="inputDuration__popover___2DN4h">
                                <div class="ant-slider ant-slider-with-marks">
                                </div>
                                <div class="inputDuration__footer___Dujnt">
                                    <button type="button" onclick="$('.outDays').css('display', 'none')" class="ant-btn inputDuration__button___3KFJ_">
                                        <span>取 消</span>
                                    </button>
                                    <button type="button" v-on:click="search();$('.outDays').css('display', 'none')" class="ant-btn ant-btn-primary">
                                        <span>确认</span>
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
