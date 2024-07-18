<div class="pageFilter__pageFilterRow___2A-U3 clear">
    <form class="ant-form ant-form-horizontal" @submit.prevent="search">
        <input type="submit" value="on" style="display: none">
        <span class="pageFilter__pageFilterCell___2PklM">
            <span class="poiList__queryInput___13z3V ant-input-affix-wrapper">
                <span class="ant-input-prefix">
                    <i aria-label="图标: search" class="anticon anticon-search">
                        <img src="/lushu/static/svg/icon-16.svg" style="width: 1rem;height: 1rem">
                    </i>
                </span>
                <input type="text" v-model="resources_key.title" placeholder="搜索关键字"  class="ant-input ant-input-dark" value="">
                <span class="ant-input-suffix"></span>
            </span>
        </span>
        <span class="pageFilter__pageFilterCell___2PklM">
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
                                                            <input  v-model="resources_key.address_value" @input="search_address"  type="text" class="ant-input input-area ant-input-dark"  placeholder="相关目的地" value="">
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
        </span>
        <span class="pageFilter__pageFilterCell___2PklM">
            <i aria-label="图标: other" class="anticon anticon-other pageFilter__prefix___xvb_x">
                <img src="/lushu/static/svg/icon-19.svg" style="width: 1rem;height: 1rem">
            </i>
            <div style="width:210px" class="ant-select-dark ant-select ant-select-enabled">
                <div class="ant-select-selection ant-select-selection--single" role="combobox" aria-autocomplete="list" aria-haspopup="true" aria-controls="" aria-expanded="false" tabindex="0">
                    <div class="ant-select-selection__rendered" v-on:click="search_type_show">
                        <div class="ant-select-selection-selected-value" title="类别: 全部"  style="display:block;opacity:1">
                            类别: {{resources_key.type_value}}
                        </div>
                    </div>
                    <span class="ant-select-arrow" style="user-select:none;-webkit-user-select:none" v-on:click="search_type_show">
                        <i aria-label="图标: down" class="anticon anticon-down ant-select-arrow-icon">
                            <img src="/lushu/static/svg/icon-20.svg" style="width: 1rem;height: 1rem">
                        </i>
                    </span>
                    <!--  -->
                    <div id="search_city" class="ant-select-dropdown ant-select-dropdown--single ant-select-dropdown-placement-bottomLeft ant-select-dropdown-hidden" style="width: 210px; left: 0px; top: 45px;">
                        <div id="b2a8a4c1-599d-4fe6-b70a-6a88b11ab083" style="overflow: auto; transform: translateZ(0px);">
                            <ul role="listbox" class="ant-select-dropdown-menu ant-select-dropdown-menu-root ant-select-dropdown-menu-vertical" tabindex="0">
                                <li role="option"   class="ant-select-dropdown-menu-item" v-on:click="Set_search_type(0,'全部')"  aria-selected="false" style="user-select: none;">全部</li>

                                <li role="option" v-for="(item,index) in project_type"  :key="index"  v-on:click="Set_search_type(index+1,item.name)"  :class="resources_key.type_value == item.name? 'ant-select-dropdown-menu-item ant-select-dropdown-menu-item-selected':'ant-select-dropdown-menu-item'" aria-selected="false" style="user-select: none;">{{item.name}}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </span>
        <span class="pageFilter__pageFilterCell___2PklM">
            <i aria-label="图标: tag" class="anticon anticon-tag pageFilter__prefix___xvb_x">
                <img src="/lushu/static/svg/icon-21.svg" style="width: 1rem;height: 1rem">

            </i>
            <div class="tagFilter__tagPanel___29iXi ant-dropdown-trigger" style="padding-left:45px;width:124px;padding-right:16px" v-on:click="search_label_show">
                <span class="tagFilter__selectTag___2QHKl" >标签：{{resources_key.label_value}}
                </span>
                <i aria-label="图标: down" class="anticon anticon-down">
                    <img src="/lushu/static/svg/icon-20.svg" style="width: 1rem;height: 1rem">
                </i>
            </div>
        </span>

    </form>
    <span class="pageFilter__pageFilterCell___2PklM pageFilter__right___ArpIX">
        <button type="button" class="ant-btn ant-btn-primary ant-btn-lg add-btn" onclick="Poi_add()">
            <i aria-label="图标: plus" class="anticon anticon-plus">
                <img src="/lushu/static/svg/icon-22.svg" style="width: 1rem;height: 1rem">
            </i>
            <span>新建POI</span>
        </button>
    </span>
</div>
