<!-- 编辑项目 -->

<div style="display: none;" id="add_projects">
    <div class="ant-modal-mask"></div>
    <div tabindex="-1" class="ant-modal-wrap ant-modal-centered" role="dialog" aria-labelledby="rcDialogTitle0">
        <div role="document" class="ant-modal modalOrderPage" style="width: 420px; transform-origin: 308px 200.5px;">
            <div tabindex="0" style="width: 0px; height: 0px; overflow: hidden;">sentinelStart</div>
            <div class="ant-modal-content">
                <button aria-label="Close" class="ant-modal-close"  v-on:click="$('#add_projects').hide();">
                    <span class="ant-modal-close-x">
                        <i aria-label="图标: close" class="anticon anticon-close ant-modal-close-icon">
                            <svg viewBox="64 64 896 896" class="" data-icon="close" width="1em" height="1em" fill="currentColor" aria-hidden="true" focusable="false">
                              <path
                                  d="M576.36 512l235.13-235.11a45.51 45.51 0 1 0-64.34-64.39L512 447.64 276.85 212.5a45.51 45.51 0 1 0-64.33 64.39L447.64 512 212.52 747.11a45.51 45.51 0 0 0 64.33 64.39L512 576.36 747.15 811.5a45.51 45.51 0 1 0 64.34-64.39z">
                              </path>
                            </svg>
                        </i>
                    </span>
                </button>
                <div class="ant-modal-header">
                    <div class="ant-modal-title" id="rcDialogTitle0">新建行程</div>
                </div>
                <div class="ant-modal-body">
                    <div class="ant-form ant-form-vertical">
                        <div class="ant-row ant-form-item createTripModal__label___2FHL0">
                            <div class="ant-form-item-label">
                                <label for="title" class="ant-form-item-required" title="行程标题">行程标题</label>
                            </div>
                            <div class="ant-form-item-control-wrapper">
                                <div class="ant-form-item-control">
                                    <span class="ant-form-item-children">
                                        <input placeholder="行程标题" maxlength="24" type="text" id="title" v-model="project_data.title"   class="ant-input" value="">
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="ant-row ant-form-item createTripModal__label___2FHL0">
                            <div class="ant-form-item-label">
                                <label for="depart" class="" title="出行日期">出行日期</label>
                            </div>
                            <div class="ant-form-item-control-wrapper">
                                <div class="ant-form-item-control">
                                    <span class="ant-form-item-children">
                                        <span  class="ant-calendar-picker" tabindex="0">
                                            <span v-on:click="openProjectPicker" class="ant-calendar-picker-input ant-input ant-calendar-range-picker-input-wraper">
<!--                                                <input type="text" class="layui-input" id="duo_time" placeholder="开始 到 结束">-->
                                                <input type="text" style="width: 40%;float: left;border: 0;margin-top: -5px;" v-model="project_data.start_time"  class="layui-input" placeholder="开始日期">
                                                <input type="text" style="width: 40%;float: left;border: 0;margin-top: -5px;"   v-model="project_data.end_time"    class="layui-input" placeholder="结束日期">
<!--                                                <input type="datetime-local"  placeholder="请选择"  value="">-->
                                                <i aria-label="图标: calendar" class="anticon anticon-calendar ant-calendar-picker-icon">
                                                   <img src="/lushu/static/svg/icon-14.svg" style="width: 1rem;height: 1rem">
                                                </i>

                                                <div style="opacity: 0;width: 20%;margin-left: 0;">
                                                            <el-date-picker
                                                                    v-model="Project_time"
                                                                    type="daterange"
                                                                    ref="dateProjectTime"
                                                                    @change="addProjectTime"
                                                                    start-placeholder="开始日期"
                                                                    end-placeholder="结束日期"
                                                                    :default-time="['00:00:00', '23:59:59']"
                                                            >
                                                            </el-date-picker>
                                                        </div>

                                            </span>
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="ant-row">
                            <div class="ant-col-12">
                                <div class="ant-row ant-form-item createTripModal__label___2FHL0">
                                    <div class="ant-form-item-label">
                                        <label class="" title="出发与返回（城市）">出发与返回（城市）</label>
                                    </div>
                                    <div class="ant-form-item-control-wrapper">
                                        <div class="ant-form-item-control">
                                            <span class="ant-form-item-children">
                                                <div class="ant-form ant-form-horizontal">
                                                    <div class="destinationAutoComplete__container___2u6IR">
                                                        <div class="ant-row ant-form-item">
                                                            <div class="ant-form-item-control-wrapper">
                                                              <div class="ant-form-item-control">
                                                                  <span class="ant-form-item-children">
                                                                  <div id="dest" class="ant-select-show-search ant-select-auto-complete ant-select ant-select-combobox ant-select-enabled ant-select-allow-clear">
                                                                    <div class="ant-select-selection ant-select-selection--single" role="combobox" aria-autocomplete="list" aria-haspopup="true" aria-controls="43e27813-21d4-4061-9917-009e09cc2e9c" aria-expanded="false"  >
                                                                      <div class="ant-select-selection__rendered">
                                                                        <ul>
                                                                          <li class="ant-select-search ant-select-search--inline">
                                                                            <div class="ant-select-search__field__wrap">
                                                                                <span class="createTripModal__city___3315f ant-select-search__field ant-input-affix-wrapper">
                                                                                    <input class="ant-input" placeholder="出发城市" type="text" v-model="project_data.departure_name" @input="search_city(1)"  value="">
                                                                                </span>
                                                                                <span class="ant-select-search__field__mirror">&nbsp;</span>
                                                                            </div>
                                                                          </li>
                                                                        </ul>
                                                                      </div>
                                                                        <span class="ant-select-arrow" unselectable="on" style="user-select: none;">
                                                                            <i aria-label="图标: down" class="anticon anticon-down ant-select-arrow-icon">
                                                                                <svg viewBox="64 64 896 896" class="" data-icon="down" width="1em" height="1em" fill="currentColor" aria-hidden="true" focusable="false">
                                                                                    <path
                                                                                        d="M153.62 360.52a45.49 45.49 0 0 1 77.17-32.7l281.28 272.39L793.29 329a45.52 45.52 0 1 1 63.22 65.5L543.62 696.24a45.53 45.53 0 0 1-63.27-.06l-312.89-303a45.33 45.33 0 0 1-13.84-32.66z">
                                                                                    </path>
                                                                                </svg>
                                                                            </i>
                                                                        </span>
                                                                        <div class="city_body" v-if="city_list1_status">
                                                                            <div class="city_list" v-for="item in city_list1.city" :key="item.id" v-on:click="add_address(item,1)">
                                                                                <div class="city_name">{{item.region_name}}</div>
                                                                                <div class="city_enname">{{item.en_name}}  {{item.parent.region_name}}</div>
                                                                            </div>
                                                                            <div class="city_user" v-if="city_list1.user.length > 0">以下为用户创建内容</div>
                                                                            <div class="city_list"  v-for="item in city_list1.user" :key="item.id" v-on:click="add_address(item,1)">
                                                                                 <div class="city_name">{{item.region_name}}</div>
                                                                                <div class="city_enname">{{item.en_name}}  {{item.parent.region_name}}</div>
                                                                                <div class="city_icon">
                                                                                    <img src="/lushu/static/svg/icon-15.svg" style="width: 1rem;height: 1rem">
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                  </div>
                                                                </span>
                                                              </div>
                                                            </div>
                                                            </div>
                                                    </div>
                                                </div>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="ant-col-1">
                                <div class="ant-row ant-form-item createTripModal__label___2FHL0">
                                    <div class="ant-form-item-label" style="height: 32px;">
                                        <label class="" title="　" >　</label>
                                    </div>
                                    <div class="ant-form-item-control-wrapper">
                                        <div class="ant-form-item-control">
                                            <span class="ant-form-item-children">
                                                <div class="createTripModal__dividerVertical___prOap">　</div>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="ant-col-11">
                                <div class="ant-row ant-form-item createTripModal__label___2FHL0">
                                    <div class="ant-form-item-label" style="height: 32px;">
                                        <label class="" title="　">　</label>
                                    </div>
                                    <div class="ant-form-item-control-wrapper">
                                        <div class="ant-form-item-control">
                                            <span class="ant-form-item-children">
                                              <div class="ant-form ant-form-horizontal">
                                                <div class="destinationAutoComplete__container___2u6IR">
                                                  <div class="ant-row ant-form-item">
                                                    <div class="ant-form-item-control-wrapper">
                                                      <div class="ant-form-item-control">
                                                          <span class="ant-form-item-children">
                                                          <div id="dest" class="ant-select-show-search ant-select-auto-complete ant-select ant-select-combobox ant-select-enabled ant-select-allow-clear">
                                                            <div class="ant-select-selection ant-select-selection--single" role="combobox" aria-autocomplete="list" aria-haspopup="true" aria-controls="f7d3ac8d-7057-41ec-c68e-a89c4e04c62f" aria-expanded="false"  >
                                                              <div class="ant-select-selection__rendered">
                                                                <ul>
                                                                  <li class="ant-select-search ant-select-search--inline">
                                                                    <div class="ant-select-search__field__wrap">
                                                                        <span class="createTripModal__city___3315f ant-select-search__field ant-input-affix-wrapper">
                                                                            <input class="ant-input" placeholder="返回城市" type="text" v-model="project_data.return_to_name" @input="search_city(2)" value="">
                                                                        </span>
                                                                        <span class="ant-select-search__field__mirror">&nbsp;</span>
                                                                    </div>
                                                                  </li>
                                                                </ul>
                                                              </div>
                                                                <span class="ant-select-arrow" unselectable="on" style="user-select: none;">
                                                                    <i aria-label="图标: down" class="anticon anticon-down ant-select-arrow-icon">
                                                                        <svg viewBox="64 64 896 896" class="" data-icon="down" width="1em" height="1em" fill="currentColor" aria-hidden="true" focusable="false">
                                                                            <path
                                                                                d="M153.62 360.52a45.49 45.49 0 0 1 77.17-32.7l281.28 272.39L793.29 329a45.52 45.52 0 1 1 63.22 65.5L543.62 696.24a45.53 45.53 0 0 1-63.27-.06l-312.89-303a45.33 45.33 0 0 1-13.84-32.66z">
                                                                            </path>

                                                                        </svg>
                                                                    </i>
                                                                </span>
                                                                 <div class="city_body" v-if="city_list2_status">
                                                                            <div class="city_list" v-for="item in city_list2.city" :key="item.id" v-on:click="add_address(item,2)">
                                                                                <div class="city_name">{{item.region_name}}</div>
                                                                                <div class="city_enname">{{item.en_name}}  {{item.parent.region_name}}</div>
                                                                            </div>
                                                                            <div class="city_user" v-if="city_list2.user.length > 0">以下为用户创建内容</div>
                                                                            <div class="city_list"  v-for="item in city_list2.user" :key="item.id"   v-on:click="add_address(item,2)">
                                                                                 <div class="city_name">{{item.region_name}}</div>
                                                                                <div class="city_enname">{{item.en_name}}  {{item.parent.region_name}}</div>
                                                                                <div class="city_icon">
                                                                                    <img src="/lushu/static/svg/icon-15.svg" style="width: 1rem;height: 1rem">
                                                                                </div>
                                                                            </div>

                                                                 </div>

                                                            </div>
                                                          </div>
                                                        </span>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="ant-row ant-form-item createTripModal__label___2FHL0">
                            <div class="ant-form-item-label">
                                <label for="serial" class="" title="路书编号">路书编号</label>
                            </div>
                            <div class="ant-form-item-control-wrapper">
                                <div class="ant-form-item-control">
                                    <span class="ant-form-item-children">
                                        <input placeholder="请输入" maxlength="24" type="text" id="serial"  v-model="project_data.project_code"  class="ant-input" value="">
                                    </span>
                                </div>
                            </div>
                        </div>
<!--                        <div class="ant-row ant-form-item createTripModal__label___2FHL0">-->
<!--                            <div class="ant-form-item-label">-->
<!--                                <label for="domestic" class="" title="默认地图">默认地图</label>-->
<!--                            </div>-->
<!--                            <div class="ant-form-item-control-wrapper">-->
<!--                                <div class="ant-form-item-control has-success">-->
<!--                                    <span class="ant-form-item-children">-->
<!--                                        <div id="domestic" class="createTripModal__domesticSelect___1HC8z ant-select ant-select-enabled">-->
<!--                                            <div class="ant-select-selection ant-select-selection--single" role="combobox" aria-autocomplete="list" aria-haspopup="true" aria-controls="d1ddf269-6f23-4f47-a5fd-67eccb000c0d" aria-expanded="false"   tabindex="0">-->
<!--                                                <div class="ant-select-selection__rendered">-->
<!--                                                    <div unselectable="on" class="ant-select-selection__placeholder" style="display: none; user-select: none;">请选择</div>-->
<!--                                                    <div class="ant-select-selection-selected-value" title="优先支持境外" style="display: block; opacity: 1;">优先支持境外</div>-->
<!--                                                </div>-->
<!--                                                <span class="ant-select-arrow" unselectable="on" style="user-select: none;">-->
<!--                                                    <i aria-label="图标: down" class="anticon anticon-down ant-select-arrow-icon">-->
<!--                                                        <svg viewBox="64 64 896 896" class="" data-icon="down" width="1em" height="1em" fill="currentColor" aria-hidden="true" focusable="false">-->
<!--                                                            <path-->
<!--                                                                d="M153.62 360.52a45.49 45.49 0 0 1 77.17-32.7l281.28 272.39L793.29 329a45.52 45.52 0 1 1 63.22 65.5L543.62 696.24a45.53 45.53 0 0 1-63.27-.06l-312.89-303a45.33 45.33 0 0 1-13.84-32.66z">-->
<!--                                                            </path>-->
<!--                                                          </svg>-->
<!--                                                    </i>-->
<!--                                                </span>-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                      <div style="position: absolute; top: 0px; left: 0px; width: 100%;">-->
<!--                                        <div>-->
<!--                                          <div class="ant-select-dropdown ant-select-dropdown--single ant-select-dropdown-placement-bottomLeft  ant-select-dropdown-hidden" style="width: 356px; left: 0.5px; top: 36px;">-->
<!--                                            <div id="d1ddf269-6f23-4f47-a5fd-67eccb000c0d" style="overflow: auto; transform: translateZ(0px);">-->
<!--                                              <ul role="listbox" class="ant-select-dropdown-menu  ant-select-dropdown-menu-root ant-select-dropdown-menu-vertical" tabindex="0">-->
<!--                                                <li role="option" unselectable="on" class="ant-select-dropdown-menu-item ant-select-dropdown-menu-item-selected" aria-selected="true" style="user-select: none;">优先支持境外</li>-->
<!--                                                <li role="option" unselectable="on" class="ant-select-dropdown-menu-item" aria-selected="false" style="user-select: none;">优先支持国内</li>-->
<!--                                              </ul>-->
<!--                                            </div>-->
<!--                                          </div>-->
<!--                                        </div>-->
<!--                                      </div>-->
<!--                                    </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
                        <div class="ant-row ant-form-item">
                            <div class="ant-form-item-control-wrapper">
                                <div class="ant-form-item-control">
                                    <span class="ant-form-item-children">
                                        <button type="button" v-on:click="Edit_project_post" class="ant-btn createTripModal__button___3RiWf ant-btn-primary">
                                            <span>创 建</span>
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
