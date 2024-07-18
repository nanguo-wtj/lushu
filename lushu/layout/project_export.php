<div>
    <div class="ant-drawer ant-drawer-right ant-drawer-open">
        <div class="ant-drawer-mask"></div>
        <div class="ant-drawer-content-wrapper" style="width: 600px;">
            <div class="ant-drawer-content">
                <div class="ant-drawer-wrapper-body" style="overflow: auto; height: 100%;">
                    <div class="ant-drawer-header">
                        <div class="ant-drawer-title">行程导出</div>
                        <div class="ant-drawer-right-actions">
                            <div class="ant-drawer-actions">
                                <button type="button" v-on:click="ExportSave" class="ant-btn ant-btn-primary" >
                                    <span>保存</span>
                                </button>
                            </div>
                            <button aria-label="Close" class="ant-drawer-close"  onclick="$('#exportShow').hide()">
                                <i aria-label="图标: close" class="anticon anticon-close">
                                    <img src="/lushu/static/svg/icon-11.svg" style="width: 1rem;height: 1rem">
                                </i>
                            </button>
                        </div>
                    </div>
                    <div class="ant-drawer-body">
                        <div class="exportTripTemplate__sectionTitle___3R4tD">行程标题:</div>
                        <div>
                            <input class="ant-input exportTripTemplate__inputField___2qVQQ" placeholder="请输入行程标题" type="text" v-model="export_data.title">
                        </div>
                        <div class="exportTripTemplate__sectionTitle___3R4tD">
                            请选择导出的内容:
                            <label   style="float: right;" class="ant-checkbox-wrapper">
									<span v-on:click="SelectAllExport" :class="AllExport == true? 'ant-checkbox ant-checkbox-checked': 'ant-checkbox '" >
										<span class="ant-checkbox-inner"></span>
									</span>
                            </label>
                            <span style="float: right;" class="exportTripTemplate__optionTitle___gdw5y">全选</span>
                        </div>

                        <div>
                            <div class="exportTripTemplate__exportOption___2xtw_">
                                <label class="ant-checkbox-wrapper">
									<span v-on:click="SelectExportType(1)" :class="export_data.itinerary == true? 'ant-checkbox ant-checkbox-checked': 'ant-checkbox '" >
										<span class="ant-checkbox-inner"></span>
									</span>
                                </label>
                                <span class="exportTripTemplate__optionTitle___gdw5y">行程总览</span>
                            </div>
                            <div v-for="(item,index) in export_day" class="exportTripTemplate__exportOption___2xtw_ exportTripTemplate__day___1LMmA">
                                <label class="ant-checkbox-wrapper" >
									<span v-on:click="SelectExportDay(item)" :class="item.status == true? 'ant-checkbox ant-checkbox-checked': 'ant-checkbox '">
										<span class="ant-checkbox-inner"></span>
									</span>
                                </label>
                                <span class="exportTripTemplate__optionTitle___gdw5y">D{{item.day}}</span>
                                <span class="exportTripTemplate__cities___3ndiZ">
                                    <span v-for="(a,b) in item.city">
                                        <i v-if="b > 0" aria-label="图标: swap-right" class="anticon anticon-swap-right">
                                            <img src="/lushu/static/svg/icon-117.svg" style="width: 1rem;height: 1rem">
                                        </i>
                                        <span class="exportTripTemplate__city___2wRr2">
                                            <i v-if="index == 0 && b == 0" aria-label="图标: flag" class="anticon anticon-flag">
                                                <img src="/lushu/static/svg/icon-111.svg" style="width: 1rem;height: 1rem">
                                            </i>
                                            <span>{{a.value}}</span>
									    </span>
                                    </span>


								</span>
                            </div>
                            <div class="exportTripTemplate__exportOption___2xtw_">
                                <label class="ant-checkbox-wrapper">
									<span v-on:click="SelectExportType(2)" :class="export_data.notes == true? 'ant-checkbox ant-checkbox-checked': 'ant-checkbox '" >
										<span class="ant-checkbox-inner"></span>
									</span>
                                </label>
                                <span class="exportTripTemplate__optionTitle___gdw5y">行程备注</span>
                            </div>
                            <div class="exportTripTemplate__exportOptionFooter___12c3i">
								<span class="exportTripTemplate__sideCheckbox___1iLER">
									<label>关联行程报价</label>
									<label class="ant-checkbox-wrapper">
										<span v-on:click="SelectExportType(3)" :class="export_data.quotation == true? 'ant-checkbox ant-checkbox-checked': 'ant-checkbox '">
											<span class="ant-checkbox-inner"></span>
										</span>
									</label>
								</span>
                            </div>
                        </div>



<!--                        <div class="exportTripTemplate__sectionTitle___3R4tD">添加标签</div>-->
<!--                        <div>-->
<!--                            <div class="tagPanel__editTagWrapPosition___dLOaA tosProjectCssMarker">-->
<!--                                <div class="tagPanel__editTagWrap___2u_Ee" style="padding: 0px;">-->
<!--                                    <div class="tagPanel__relatedTagList___23Ph8 tagPanel__relatedItemList___1smWM">-->
<!--                                        <div  class="tagPanel__item___yCbYP tagPanel__tagBtn___3HNMy">-->
<!--                                            <div class="tagPanel__name___10H5M">标签</div>-->
<!--                                        </div>-->
<!--                                        <div  class="tagPanel__btnCube___3pngi" >-->
<!--                                            <i aria-label="图标: tag" class="anticon anticon-tag">-->
<!--                                                <svg viewBox="64 64 896 896" class="" data-icon="tag" width="1em" height="1em" fill="currentColor" aria-hidden="true" focusable="false">-->
<!--                                                    <path d="M906.15 438.52L889.54 235.3a104.58 104.58 0 0 0-96-96.06l-203.17-16.61c-31.44-3.22-61.06 8.5-82.89 30.39L127.81 532.69a105.05 105.05 0 0 0 0 148.44L347.65 901a105 105 0 0 0 148.44 0l99.78-99.77c0-.05.12-.07.17-.12s.06-.11.11-.16L875.76 521.3a104.56 104.56 0 0 0 30.39-82.78zM431.76 836.63a14 14 0 0 1-19.78 0L192.15 616.8a14 14 0 0 1 0-19.78l67.75-67.75 239.61 239.61zM811.43 457L563.84 704.55 324.23 464.94l247.58-247.59a14.06 14.06 0 0 1 9.89-4h1.17l203.22 16.61a14.07 14.07 0 0 1 12.78 12.83L815.48 446a14 14 0 0 1-4.05 11z">-->
<!--                                                    </path>-->
<!--                                                </svg>-->
<!--                                            </i>-->
<!--                                            <span class="tagPanel__addTag___2w28Q">添加标签</span>-->
<!--                                        </div>-->
<!---->
<!--                                    </div>-->
<!--                                    <div  class="tagPanel__createTag___ZLmvq">-->
<!--                                        <input type="text" maxlength="20"  placeholder="请输入标签">-->
<!--                                        <button type="button" class="ant-btn tagPanel__close___1ustW ant-btn-lg ant-btn-icon-only" >-->
<!--                                            <i aria-label="图标: close" class="anticon anticon-close">-->
<!--                                                <svg viewBox="64 64 896 896" class="" data-icon="close" width="1em" height="1em" fill="currentColor" aria-hidden="true" focusable="false">-->
<!--                                                    <path d="M576.36 512l235.13-235.11a45.51 45.51 0 1 0-64.34-64.39L512 447.64 276.85 212.5a45.51 45.51 0 1 0-64.33 64.39L447.64 512 212.52 747.11a45.51 45.51 0 0 0 64.33 64.39L512 576.36 747.15 811.5a45.51 45.51 0 1 0 64.34-64.39z">-->
<!---->
<!--                                                    </path>-->
<!--                                                </svg>-->
<!--                                            </i>-->
<!--                                        </button>-->
<!--                                        <button type="button" class="ant-btn tagPanel__close___1ustW ant-btn-lg ant-btn-icon-only" >-->
<!--                                            <i aria-label="图标: check" class="anticon anticon-check">-->
<!--                                                <svg viewBox="64 64 896 896" class="" data-icon="check" width="1em" height="1em" fill="currentColor" aria-hidden="true" focusable="false">-->
<!--                                                    <path d="M398.7 788.9c-10.9 0-21.8-4.2-30.2-12.5l-212-212a42.55 42.55 0 0 1 0-60.3 42.55 42.55 0 0 1 60.3 0l181.8 181.8L820.5 264a42.55 42.55 0 0 1 60.3 0 42.55 42.55 0 0 1 0 60.3l-452 452a42.18 42.18 0 0 1-30.1 12.6z">-->
<!--                                                    </path>-->
<!--                                                </svg>-->
<!--                                            </i>-->
<!--                                        </button>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>