<div>
    <div class="ant-drawer ant-drawer-right ant-drawer-open importTripTemplate__importTemplateDrawer___1YKsX">
        <div class="ant-drawer-mask"></div>
        <div class="ant-drawer-content-wrapper" style="width: 960px;">
            <div class="ant-drawer-content">
                <div class="ant-drawer-wrapper-body" style="overflow: auto; height: 100%;">
                    <div class="ant-drawer-header">
                        <div class="ant-drawer-title">行程导入</div>
                        <div class="ant-drawer-right-actions">
                            <div class="ant-drawer-actions">
                                <button type="button" v-on:click="PostImport" class="ant-btn ant-btn-primary">
                                    <span>保存</span>
                                </button>
                            </div>
                            <button aria-label="Close" class="ant-drawer-close" onclick="$('#importShow').hide()">
                                <i aria-label="图标: close" class="anticon anticon-close">
                                    <img src="/lushu/static/svg/icon-11.svg" style="width: 1rem;height: 1rem">
                                </i>
                            </button>
                        </div>
                    </div>
                    <div class="ant-drawer-body">
                        <div class="importTripTemplate__channelTabs___158QM">
                            <div class="clear tabsNav__tabNav___1-jmV">
                                <div class="tabsNav__tabsGroup___3G2wf">
                                    <span class="tabsNav__tab___cgToo tabsNav__active___3OOMW">行程路线库</span>
                                </div>
                            </div>
                        </div>
                        <div class="pageFilter__pageFilterRow___2A-U3 importTripTemplate__filterOptions___Ol0bl clear">
                        </div>
                        <!-- 底下是内容 -->

                        <div class="importTripTemplate__templates___2nIJr" style="top: 50px;">
                            <div class="importTripTemplate__templateList___1ptdw">
								<span style="margin-left: 12px;margin-bottom: 17px;" class="pageFilter__pageFilterCell___2PklM">
									<span class="importTripTemplate__queryInput___1arOJ ant-input-affix-wrapper">
										<span class="ant-input-prefix">
											<i aria-label="图标: search" class="anticon anticon-search">
												<img src="/lushu/static/svg/icon-92.svg" style="width: 1rem;height: 1rem">
											</i>
										</span>
										<input placeholder="搜索关键字" class="ant-input ant-input-light" type="text" value="">
										<span class="ant-input-suffix"></span>
									</span>
								</span>
                                <ul class="ant-menu ant-menu-light ant-menu-root ant-menu-inline" role="menu">
                                    <li v-for="(item,index) in ExportList" :key="index" v-on:click="GetExportListData(item)" :class="item.status == true? 'ant-menu-item ant-menu-item-selected':'ant-menu-item'"  style="padding-left: 24px;">
                                        {{item.title}}
                                    </li>
                                </ul>
                                <ul class="ant-pagination mini" unselectable="unselectable">
                                    <li title="上一页" v-on:click="previousExport" class="ant-pagination-disabled ant-pagination-prev" >
                                        <a class="ant-pagination-item-link">
                                            <i aria-label="图标: left" class="anticon anticon-left">
                                                <img src="/lushu/static/svg/icon-50s.svg" style="width: 1rem;height: 1rem">
                                            </i>
                                        </a>
                                    </li>
                                    <li title="1" class="ant-pagination-item ant-pagination-item-1 ant-pagination-item-active" tabindex="0">
                                        <a>{{ExportData.page}}</a>
                                    </li>
                                    <li title="下一页" v-on:click="nextExport" tabindex="0" class=" ant-pagination-next" >
                                        <a class="ant-pagination-item-link">
                                            <i aria-label="图标: right" class="anticon anticon-right">
                                                <img src="/lushu/static/svg/icon-129.svg" style="width: 1rem;height: 1rem">
                                            </i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="importTripTemplate__importOptionList___3llpZ">
                                <div class="importTripTemplate__listTitle___3cRcb">请选择导入的内容:<span class="importTripTemplate__sideCheckbox___QOB5P">
										<label>全选</label>
										<label class="ant-checkbox-wrapper">
											<span v-on:click="SelectAllImport" :class="AllImport == true? 'ant-checkbox ant-checkbox-checked': 'ant-checkbox '">
												<span class="ant-checkbox-inner"></span>
											</span>
										</label>
									</span>
                                </div>
                                <div class="importTripTemplate__importOption___2AuxQ">
                                    <label class="ant-checkbox-wrapper">
										<span  v-on:click="SelectImportType(1)"  :class="import_data.itinerary == true? 'ant-checkbox ant-checkbox-checked':'ant-checkbox'">
											<span class="ant-checkbox-inner"></span>
										</span>
                                    </label>
                                    <span class="importTripTemplate__optionTitle___37PFD">行程总览</span>
                                </div>
                                <div v-for="(item,index) in ExportListData"  class="importTripTemplate__importOption___2AuxQ importTripTemplate__day___1FEmY">
                                    <label class="ant-checkbox-wrapper" >
										<span v-on:click="SelectImportDay(item)"  :class="item.status == true? 'ant-checkbox ant-checkbox-checked':'ant-checkbox'">
											<span class="ant-checkbox-inner"></span>
										</span>
                                    </label>
                                    <span class="importTripTemplate__optionTitle___37PFD">D{{item.day}}</span>
                                    <span class="importTripTemplate__cities___2GOOe">
										<span v-for="(a,b) in item.city" :key="b">
                                            <i v-if="b!=0" aria-label="图标: swap-right" class="anticon anticon-swap-right">
											    <img src="/lushu/static/svg/icon-117.svg" style="width: 1rem;height: 1rem">
                                            </i>
                                            <span class="importTripTemplate__city___2n-Od">
                                                <span>{{a.value}}</span>
                                            </span>
                                        </span>

									</span>
                                </div>

                                <div class="importTripTemplate__importOption___2AuxQ">
                                    <label class="ant-checkbox-wrapper">
										<span v-on:click="SelectImportType(2)"  :class="import_data.notes == true? 'ant-checkbox ant-checkbox-checked':'ant-checkbox'">
											<span class="ant-checkbox-inner"></span>
										</span>
                                    </label>
                                    <span class="importTripTemplate__optionTitle___37PFD">行程备注</span>
                                </div>
                                <div class="importTripTemplate__importOptionFooter___2MEG0">
									<span class="importTripTemplate__sideCheckbox___QOB5P">
										<label>关联行程报价</label>
										<label class="ant-checkbox-wrapper">
											<span v-on:click="SelectImportType(3)"  :class="import_data.quotation == true? 'ant-checkbox ant-checkbox-checked':'ant-checkbox'">
												<span class="ant-checkbox-inner"></span>
											</span>
										</label>
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