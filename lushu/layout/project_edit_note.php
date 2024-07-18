<div class="addCard" style="display: none;position: absolute;">
    <div class="ant-drawer ant-drawer-right ant-drawer-open
          ant-drawer-border" style="">
        <div class="ant-drawer-mask"></div>
        <div class="ant-drawer-content-wrapper" style="width: 710px;">
            <div class="ant-drawer-content">
                <div class="ant-drawer-wrapper-body" style="overflow: auto;
                height: 100%;">
                    <div class="ant-drawer-header">
                        <div class="ant-drawer-title">添加笔记</div>
                        <div class="ant-drawer-right-actions">
                            <button aria-label="Close" onclick="$('.addCard').css('display','none')" class="ant-drawer-close">
                                <i aria-label="图标: close" class="anticon anticon-close">
                                    <img src="/lushu/static/svg/icon-11.svg" style="width: 1rem;height: 1rem">
                                </i>
                            </button>
                        </div>
                    </div>
                    <div class="ant-drawer-body">
                        <div class="addTripElement__addTripElement___JbkSU">
<!--                            <div class="addTripElement__leftMenu___2Q_HF">-->
<!--                                <div class="addTripElement__tripDestinationGroup___5VlKB">-->
<!--                                    <ul class="ant-menu ant-menu-medium ant-menu-light ant-menu-root ant-menu-inline" role="menu">-->
<!--                                        <li class="ant-menu-item ant-menu-item-selected" role="menuitem" style="padding-left: 24px;">全部 </li>-->
<!--                                        <li class=" ant-menu-item-group">-->
<!--                                            <ul class="ant-menu-item-group-list">-->
<!--                                                <li class="ant-menu-item" role="menuitem" style="padding-left: 24px;">-->
<!--                                                    <i aria-label="图标: swap-right" class="anticon anticon-swap-right">-->
<!--                                                        <img src="/lushu/static/svg/icon-64.svg" style="width: 1rem;height: 1rem">-->
<!--                                                    </i>雷姆沙伊德-->
<!--                                                </li>-->
<!---->
<!--                                            </ul>-->
<!--                                        </li>-->
<!---->
<!--                                    </ul>-->
<!--                                    <div class="addTripElement__inner___HLfv6">-->
<!--                                        <div class="ant-select-show-search ant-select-auto-complete ant-select ant-select-combobox ant-select-enabled">-->
<!--                                            <div class="ant-select-selection ant-select-selection--single" role="combobox" aria-autocomplete="list" aria-haspopup="true" aria-controls="3c500987-d429-410a-a5f5-287d15878920" aria-expanded="false">-->
<!--                                                <div class="ant-select-selection__rendered">-->
<!--                                                    <ul>-->
<!--                                                        <li class="ant-select-search ant-select-search--inline">-->
<!--                                                            <div class="ant-select-search__field__wrap">-->
<!--																	<span class="ant-select-search__field ant-input-affix-wrapper">-->
<!--																		<span class="ant-input-prefix">-->
<!--																			<i aria-label="图标: location" class="anticon anticon-location">-->
<!--																				<img src="/lushu/static/svg/icon-17.svg" style="width: 1rem;height: 1rem">-->
<!--																			</i>-->
<!--																		</span>-->
<!--																		<input placeholder="搜索其他目的地" type="text" class="ant-input" value="">-->
<!--																		<span class="ant-input-suffix"></span>-->
<!--																	</span>-->
<!--                                                                <span class="ant-select-search__field__mirror">&nbsp;</span>-->
<!--                                                            </div>-->
<!--                                                        </li>-->
<!--                                                    </ul>-->
<!--                                                </div>-->
<!--                                                <span class="ant-select-arrow" unselectable="on" style="user-select: none;">-->
<!--														<i aria-label="图标: down" class="anticon anticon-down ant-select-arrow-icon">-->
<!--															<img src="/lushu/static/svg/icon-1.svg" style="width: 1rem;height: 1rem">-->
<!--														</i>-->
<!--													</span>-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
                            <div class="addTripElement__rightContent___dzhaf" style="margin-right: unset">
                                <div class="addTripElement__rightContentInner___3Pu-R">
                                    <div class="addTripElement__actionBar___2NyCT">
                                        <form  @submit.prevent="get_content(1)">
											<span class="ant-input-affix-wrapper" style="width: 410px;">
												<span class="ant-input-prefix">
													<i aria-label="图标: search" class="anticon anticon-search">
														<img src="/lushu/static/svg/icon-16.svg" style="width: 1rem;height: 1rem">
													</i>
												</span>
												<input placeholder="搜索关键字" type="text" v-model="search_note_data.title" class="ant-input" value="">
												<span class="ant-input-suffix"></span>
											</span>
                                        </form>

<!--                                        <div class="addTripElement__actionBarRight___o0b45">-->
<!--                                            <button type="button" onclick="$('.addNode').css('display', 'block')" class="ant-btn ant-btn-lg">-->
<!--                                                <i aria-label="图标: plus" class="anticon anticon-plus">-->
<!--                                                    <img src="/lushu/static/svg/icon-60.svg" style="width: 1rem;height: 1rem">-->
<!--                                                </i>-->
<!--                                                <span>新建笔记</span>-->
<!--                                            </button>-->
<!--                                        </div>-->
                                    </div>
                                    <div class="ant-radio-group ant-radio-group-outline customRadioGroup default sizeSmall addTripElement__radioGroup___20ysd">
                                        <label  :class="list.note_note_status? 'ant-radio-button-wrapper ant-radio-button-wrapper-checked':'ant-radio-button-wrapper ' " v-on:click="list.note_source_status = false;list.note_note_status=true">
                                        <span  :class="list.note_note_status? 'ant-radio-button ant-radio-button-checked':'ant-radio-button-checked' " >
                                            <span class="ant-radio-button-inner"></span>
                                        </span>
                                            <span>素材库</span>
                                        </label>
<!--                                        <label  :class="list.note_source_status? 'ant-radio-button-wrapper ant-radio-button-wrapper-checked':'ant-radio-button-wrapper ' "  v-on:click="list.note_source_status = true;list.note_note_status=false">-->
<!--                                        <span  :class="list.note_source_status? 'ant-radio-button ant-radio-button-checked':'ant-radio-button-checked' " >-->
<!--                                            <span class="ant-radio-button-inner"></span>-->
<!--                                        </span>-->
<!--                                            <span>旅行资源库</span>-->
<!--                                        </label>-->
                                    </div>
                                    <div>
                                        <div class="addTripElement__noteList___3yVOO">
                                            <div class="ant-row" v-if="list.note_note_status == true" style="margin-left: -8px;
                              margin-right: -8px;">
                                                <div class="ant-col-24" v-for="item in list.note_list" :key="item.id" v-on:click="Getdetails_note_data(item.id)" :data-id="item.id"  style="padding-left: 8px;padding-right: 8px;">
                                                    <div class="tripElementAddControl__tripElementAddControl___2ffiM tripElementAddControl__control___30rqE tripElementAddControl__actionAddRemove___2sld3 tripElementAddControl__positionRightCenter___1PRs2">
                                                        <div class="tripElementAddControl__btns___3cfir">
                                                            <button v-if="item.status == false" v-on:click="add_project_note(item)" type="button" class="ant-btn tripElementAddControl__btnAdd___3M54d ant-btn-primary ant-btn-sm ant-btn-icon-only">
                                                                <i aria-label="图标: plus" class="anticon anticon-plus">
                                                                    <img src="/lushu/static/svg/icon-22.svg" style="width: 1rem;height: 1rem;margin-top: -6px;">
                                                                </i>
                                                            </button>
                                                            <button v-if="item.status == true"  type="button" class="ant-btn tripElementAddControl__labelAdded___dGYg6 ant-btn-primary ant-btn-sm ant-btn-icon-only">
                                                                <i aria-label="图标: check" class="anticon anticon-check">
                                                                    <img src="/lushu/static/svg/icon-57.svg" style="width: 1rem;height: 1rem;margin-top: -6px;">
                                                                </i>
                                                            </button>
                                                            <button v-if="item.status == true"  v-on:click="del_project_note(item,2)" type="button" class="ant-btn tripElementAddControl__btnRemove___3jsJE ant-btn-danger ant-btn-circle ant-btn-sm ant-btn-icon-only">
                                                                <i aria-label="图标: delete" class="anticon anticon-delete">
                                                                    <img src="/lushu/static/svg/icon-48.svg" style="width: 1rem;height: 1rem;margin-top: -6px;">
                                                                </i>
                                                            </button>
                                                        </div>
                                                        <div class="note__noteBox___UhFwo tripElementAddControl__element___3LZTR tripElementAddControl__note___QQ-hv">
                                                            <div class="note__noteCover___3XJg6">
																	<span class="widgets__lushuBackgroundImage___3XMmZ" :style='"background-image:url("+item.url+");"'></span>
                                                            </div>
                                                            <div class="note__noteCont___2WJA_">
                                                                <h4>{{item.title}}</h4>{{item.user}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="ant-row" v-if="list.note_source_status == true" style="margin-left: -8px;
                              margin-right: -8px;">
                                                <div class="ant-col-24" v-for="item in list.source_list" :key="item.id" :data-id="item.id"  style="padding-left: 8px;padding-right: 8px;">
                                                    <div class="tripElementAddControl__tripElementAddControl___2ffiM tripElementAddControl__control___30rqE tripElementAddControl__actionAddRemove___2sld3 tripElementAddControl__positionRightCenter___1PRs2">
                                                        <div class="tripElementAddControl__btns___3cfir">
                                                            <button type="button" class="ant-btn selected tripElementAddControl__labelAdded___dGYg6 ant-btn-primary ant-btn-sm ant-btn-icon-only">
                                                                <i aria-label="图标: check" class="anticon anticon-check">
                                                                    <img src="/lushu/static/svg/icon-57.svg" style="width: 1rem;height: 1rem">
                                                                </i>
                                                            </button>
                                                            <button type="button" class="ant-btn tripElementAddControl__btnRemove___3jsJE ant-btn-danger ant-btn-circle ant-btn-sm ant-btn-icon-only">
                                                                <i aria-label="图标: delete" class="anticon anticon-delete">
                                                                    <img src="/lushu/static/svg/icon-48.svg" style="width: 1rem;height: 1rem">
                                                                </i>
                                                            </button>
                                                        </div>
                                                        <div class="note__noteBox___UhFwo tripElementAddControl__element___3LZTR tripElementAddControl__note___QQ-hv">
                                                            <div class="note__noteCover___3XJg6">
                                                                <span class="widgets__lushuBackgroundImage___3XMmZ" :style='"background-image:url("+item.url+");"'></span>
                                                            </div>
                                                            <div class="note__noteCont___2WJA_">
                                                                <h4>{{item.title}}</h4>{{item.user}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <?php
                                        $page = 'search_note_data.page';
                                        $PreviousPage   =   'previousPageNotes';
                                        $NextPage   =   'nextPageNotes';
                                        include(dirname(__FILE__,2) . '/layout/page.php');?>

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