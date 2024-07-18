<div id="quotation" style="display: none;">
    <div class="ant-drawer ant-drawer-right ant-drawer-open" style="">
        <div class="ant-drawer-mask" style=""></div>
        <div class="ant-drawer-content-wrapper" style="width: 960px;">
            <div class="ant-drawer-content">
                <div class="ant-drawer-wrapper-body" style="overflow: auto; height: 100%;">
                    <div class="ant-drawer-header">
                        <div class="ant-drawer-title">行程报价</div>
                        <div class="ant-drawer-right-actions">
                            <button aria-label="Close" v-on:click="CloseQuotation" class="ant-drawer-close">
                                <i aria-label="图标: close" class="anticon anticon-close">
                                    <img src="/lushu/static/svg/icon-11.svg" style="width: 1rem;height: 1rem">
                                </i>
                            </button>
                        </div>
                    </div>
                    <div class="ant-drawer-body">
                        <div class="tosProjectCssMarker">
                            <div class="editQuote__editQuote___3FZQ0 editQuote__editQuoteComponent___1aUD9">
                                <div>
                                    <div class="editQuote__headerContainer___3B5EZ">
                                        <div class="editQuote__btnWrapper___2hBtR"></div>
                                        <div class="ant-tabs ant-tabs-top ant-tabs-line">
                                            <div role="tablist" class="ant-tabs-bar ant-tabs-top-bar" tabindex="0">
                                                <div class="ant-tabs-nav-container">

                                                    <div class="ant-tabs-nav-wrap">
                                                        <div class="ant-tabs-nav-scroll">
                                                            <div class="ant-tabs-nav ant-tabs-nav-animated">
                                                                <div>
                                                                    <div  v-for="(item,index) in quotation_top" :key="index" v-on:click="openItinerary(item,index)"   :class="item.id == quotation_top_id? 'ant-tabs-tab-active ant-tabs-tab':'ant-tabs-tab '">{{item.class_type}}</div>
                                                                </div>
                                                                <div class="ant-tabs-ink-bar ant-tabs-ink-bar-animated" :style="'display: block; transform: translate3d(0px, 0px, 0px); width: 60px;    margin-left: '+(90*quotation_top_index)+'px;'"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div tabindex="0" role="presentation" style="width: 0px; height: 0px; overflow: hidden; position: absolute;"></div>
                                            <div class="ant-tabs-content ant-tabs-content-animated ant-tabs-top-content" style="margin-left: 0%;">
                                                <div role="tabpanel" aria-hidden="false" class="ant-tabs-tabpane ant-tabs-tabpane-active">
                                                    <div tabindex="0" role="presentation" style="width: 0px; height: 0px; overflow: hidden; position: absolute;"></div>
                                                    <div tabindex="0" role="presentation" style="width: 0px; height: 0px; overflow: hidden; position: absolute;"></div>
                                                </div>
                                                <div role="tabpanel" aria-hidden="true" class="ant-tabs-tabpane ant-tabs-tabpane-inactive"></div>
                                                <div role="tabpanel" aria-hidden="true" class="ant-tabs-tabpane ant-tabs-tabpane-inactive"></div>
                                            </div>
                                            <div tabindex="0" role="presentation" style="width: 0px; height: 0px; overflow: hidden; position: absolute;"></div>
                                        </div>
                                        <div class="editQuote__headerRow___9_PxR">
                                            <div class="editQuote__totalPrice___2W7Ue">
                                                <span class="editQuote__priceTitle___2yZ1U">行程报价：</span>
                                                <div class="editQuote__price___2uIIZ editQuote__edit___3FmJ2">
                                                    <span class="editQuote__currency___1j9Ql">(货币: 人民币)</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tripPriceTable__priceTable___3mNyy">
                                            <div class="tosProjectCssMarker dataTable__dataTableSet___3xooO">
                                                <div class="dataTable__dataTable___3z9Jt">
                                                    <div class="dataTable__th___2jo2p">
														<span style="width: 19%"  class="dataTable__tableDimensions___pL2Q9 dataTable__double___1Nv3p">
															<span class="dataTable__colTitle___dZ1YN">游客分类</span>
															<span class="dataTable__rowTitle___ydKnj">出行日期</span>
														</span>
                                                        <span style="width: 19%"  class="dataTable__cell___3kPEN dataTable__colHeader___2g_sn">成人</span>
                                                        <span style="width: 19%" v-if="classification[0].status == true" class="dataTable__cell___3kPEN dataTable__colHeader___2g_sn">老人</span>
                                                        <span style="width: 19%" v-if="classification[1].status == true" class="dataTable__cell___3kPEN dataTable__colHeader___2g_sn">儿童</span>
                                                        <span style="width: 19%" v-if="classification[2].status == true" class="dataTable__cell___3kPEN dataTable__colHeader___2g_sn">婴儿</span>
                                                    </div>
                                                    <div  v-for="(item,index) in quotation_top_list" :key="index" class="dataTable__tr___3V6y4">
                                                        <span style="width: 19%" class="dataTable__cell___3kPEN dataTable__rowHeader___xAjP6">{{item.title}}</span>
                                                        <span style="width: 19%" class="dataTable__cell___3kPEN" >{{item.adult}}</span>
                                                        <span style="width: 19%" v-if="classification[0].status == true" class="dataTable__cell___3kPEN" >{{item.old}}</span>
                                                        <span style="width: 19%" v-if="classification[1].status == true" class="dataTable__cell___3kPEN" >{{item.children}}</span>
                                                        <span style="width: 19%" v-if="classification[2].status == true" class="dataTable__cell___3kPEN" >{{item.baby}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="editQuote__contentContainer___2A0KS">
                                        <div class="editQuote__section___ZB-wU">
                                            <div class="editQuote__sectionHeader___bWqD4">费用说明</div>
                                            <div class="editQuote__header___315Tv">
                                                <div class="editQuote__column___2B62e editQuote__name___3V3Tn">项目名称</div>
                                                <div class="editQuote__column___2B62e editQuote__description___2x8mR">描述</div>
                                            </div>
                                            <div v-for="(item,index) in cost_list" :key="index" class="editQuote__dataRow___2zh0l editQuote__noPrice___3CA_B">
                                                <div class="editQuote__column___2B62e editQuote__name___3V3Tn">{{item.title}}</div>
                                                <div  v-html="item.content" class="editQuote__column___2B62e editQuote__description___2x8mR">
                                                </div>
                                            </div>

                                        </div>
                                        <div class="editQuote__section___ZB-wU editQuote__notIncludes___2UqSO">
                                            <div class="editQuote__sectionHeader___bWqD4">费用不包括</div>
                                            <div class="editQuote__header___315Tv editQuote__empty___2VV9q"></div>
                                            <div v-for="(item,index)  in not_included" :key="index" class="editQuote__dataRow___2zh0l editQuote__onlyOneColumn___2keCS">
                                                <div v-html="item.content" class="editQuote__column___2B62e editQuote__descriptionOnlyOne___2Vy2L">

                                                </div>
                                                <div class="editQuote__column___2B62e editQuote__delete___3NZ8V"></div>
                                            </div>

                                        </div>
                                        <div class="editQuote__section___ZB-wU">
                                            <div class="editQuote__sectionHeader___bWqD4">可选付费项目</div>
                                            <div class="editQuote__header___315Tv">
                                                <div class="editQuote__column___2B62e editQuote__name___3V3Tn">项目名称
                                                </div>
                                                <div class="editQuote__column___2B62e editQuote__description___2x8mR">描述
                                                </div>
                                            </div>
                                            <div v-for="(item,index) in PaidItemsList" :key="index"  class="editQuote__dataRow___2zh0l editQuote__noPrice___3CA_B">
                                                <div class="editQuote__column___2B62e editQuote__name___3V3Tn">{{item.title}}
                                                </div>
                                                <div class="editQuote__column___2B62e editQuote__description___2x8mR" v-html="item.content">
                                                </div>
                                            </div>
                                        </div>
                                        <div  class="editQuote__section___ZB-wU editQuote__introduction___1yGlX">
                                            <div class="editQuote__sectionHeader___bWqD4">补充说明</div>
                                            <div v-html="supplementdata.content" class="editQuote__introductionContent___1GgRE">
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