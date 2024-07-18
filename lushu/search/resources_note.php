<div class="pageFilter__pageFilterRow___2A-U3 clear">
    <form class="ant-form ant-form-horizontal" @submit.prevent="search">
        <input type="submit" value="on" style="display: none">
        <span class="pageFilter__pageFilterCell___2PklM">
            <span class="ant-input-affix-wrapper" style="width:320px">
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
            <div class="destinationAutoComplete__container___2u6IR">
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
                                                        <span class="ant-select-search__field ant-input-affix-wrapper" style="width:320px">
                                                            <span class="ant-input-prefix">
                                                                <i aria-label="图标: location" class="anticon anticon-location destinationAutoComplete__icon___2aPbK">
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
                                        <span class="ant-select-arrow" style="user-select:none;-webkit-user-select:none" unselectable="on">
                                            <i aria-label="图标: down" class="anticon anticon-down ant-select-arrow-icon">
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
        <button type="button" onclick="$('.addNode').css('display', 'block')" class="ant-btn ant-btn-primary ant-btn-lg">
            <i aria-label="图标: plus" class="anticon anticon-plus">
                <svg viewbox="64 64 896 896" class="" data-icon="plus" width="1em" height="1em" fill="currentColor" aria-hidden="true" focusable="false">
                    <path d="M830.37 464H547.13V180.86a47.94 47.94 0 1 0-95.88 0V464H168a47.94 47.94 0 0 0 0 95.88h283.25v283.28a47.94 47.94 0 1 0 95.88 0V559.92h283.24a47.94 47.94 0 0 0 0-95.88z">
                    </path>
                </svg>
            </i>
            <span>新建笔记</span>
        </button>
    </span>
</div>
