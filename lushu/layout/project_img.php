<div class="add-poi" style="position:absolute;top: 0;left: 0;display: none;" id="add-img">
    <div class="ant-drawer ant-drawer-right ant-drawer-open">
        <div class="ant-drawer-mask"></div>
        <div class="ant-drawer-content-wrapper" style="width: 1024px;">
            <div class="ant-drawer-content">
                <div class="ant-drawer-wrapper-body" style="overflow: auto; height: 100%;">
                    <div class="ant-drawer-header">
                        <div class="ant-drawer-title" v-if="project_picture_data.key_id">编辑笔记</div>
                        <div class="ant-drawer-title" v-if="!project_picture_data.key_id">新建笔记</div>
                        <div class="ant-drawer-right-actions">
                            <div class="ant-drawer-actions">
                                <button type="button" v-on:click="post_picture" class="ant-btn ant-btn-primary">
                                    <span>保 存</span>
                                </button>
                            </div>
                            <button onclick="close_img()" aria-label="Close" class="ant-drawer-close">
                                <i aria-label="图标: close" class="anticon anticon-close">
                                    <img src="/lushu/static/svg/icon-11.svg" style="width: 1rem;height: 1rem">
                                </i>
                            </button>
                        </div>
                    </div>
                    <div class="ant-drawer-body">
                        <div class="editPicture__container___2kxj9">
                            <div class="editPicture__leftElt___1bXKz">
                                <span class="">
                                    <div class="ant-upload ant-upload-select ant-upload-select-text">
                                        <span tabindex="0" class="ant-upload" role="button">
                                            <input type="hidden" id="picture2" value="">
                                            <input type="file" accept="image/bmp,image/jpeg,image/jpg,image/gif,image/png" style="display: none;">
                                            <div class="pictureUploader__coverContainer___1lm-8" style="width: 640px; height: 480px;">
                                                <div class="pictureUploader__cover___MOiqv" id="img2">
                                                    <span class="pictureUploader__roundCorner___3J8rd widgets__lushuBackgroundImage___3XMmZ widgets__noImg___CsB0Z">
                                                        <div class="widgets__noImgCont___blaq6">
                                                            <i aria-label="图标: picture" class="anticon anticon-picture" style="font-size: 192px;">
                                                               <img src="/lushu/static/svg/icon-104.svg" style="width: 5rem;height: 5rem">
                                                            </i>
                                                        </div>
                                                    </span>
                                                </div>
                                                <div class="pictureUploader__mask___4A-xD" onclick="upFile2(this)">
                                                    <div class="pictureUploader__camera___2an34">
                                                        <i aria-label="图标: camera" class="anticon anticon-camera pictureUploader__cameraIcon___2Pcwp">
                                                            <img src="/lushu/static/svg/icon-98.svg" style="width: 1.6rem;height: 1.6rem">
                                                        </i>
                                                    </div>
                                                </div>
                                            </div>
                                        </span>
                                    </div>
                                </span>
                                <div class="editPicture__textSection___1gqzy">
                                    <textarea v-model="project_picture_data.content" placeholder="请输入图片备注，以了解图片更多信息。备注只可用于查看，无法展示。" maxlength="100" rows="4" class="ant-input"></textarea>
                                    <div class="editPicture__characters___1VOLr">
                                        <span>{{project_picture_data.content.length}}</span>
                                        <span>/100</span>
                                    </div>
                                </div>
                            </div>
                            <div class="editPicture__rightElt___13o_C">
                                <div class="editPicture__section___3kiSp">
                                    <div class="editPicture__subHeader___1XI-u">相关地点</div>
                                    <div class="relateToNewPoi__pois___31qlJ">
                                        <div class="relateToNewPoi__poiItem___1v0TJ"  v-for="(item,index) in project_picture_data.association" :key="index" >
                                            <div class="relateToNewPoi__pre___2xuDR">
                                                <i aria-label="图标: poi-method-4" class="anticon anticon-poi-method-4 relateToNewPoi__poiType___2OY1I">
                                                    <img src="/lushu/static/svg/icon-29.svg" style="width: 1rem;height: 1rem">
                                                </i>
                                                <div class="relateToNewPoi__poiName___2ynr4"> {{item.value}}</div>
                                                <i aria-label="图标: close-circle" v-on:click="Del_poi(item.id,index)" tabindex="-1" class="anticon anticon-close-circle relateToNewPoi__delete____5Ts9">
                                                    <img src="/lushu/static/svg/icon-30.svg" style="width: 1rem;height: 1rem">
                                                </i>
                                            </div>
                                        </div>
                                        <button type="button" onclick="addNewPoi()" class="ant-btn relateToNewPoi__ralateBtn___33CKG" ant-click-animating-without-extra-node="false">
                                            <span>关联POI</span>
                                        </button>
                                    </div>
                                </div>
                                <div class="editPicture__section___3kiSp">
                                    <div class="editPicture__subHeader___1XI-u">相关目的地</div>
                                    <div class="relatedDestinationList__relatedDestinationList___v4lHw">
                                        <div>
                                            <div>
                                                <div class="relatedTagList relatedItemList clear tosProjectCssMarker">
                                                    <div class="item"  v-for="item in project_picture_data.address_code" :key="item.id">
                                                        <div class="name">{{item.value}}</div>
                                                        <span class="removeBtn">
                                                    <i class="icon-minus" v-on:click="del_city(item,2)"></i>
                                                    </span>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <form class="ant-form ant-form-horizontal">
                                            <div class="destinationAutoComplete__container___2u6IR destinationAutoComplete__hasBorder___3-Prs">
                                                <div class="ant-row ant-form-item">
                                                    <div class="ant-form-item-control-wrapper">
                                                        <div class="ant-form-item-control">
																	<span class="ant-form-item-children">
																		<div id="dest" class="ant-select-show-search ant-select-auto-complete ant-select ant-select-combobox ant-select-enabled ant-select-allow-clear">
																			<div class="ant-select-selection ant-select-selection--single" role="combobox" aria-autocomplete="list" aria-haspopup="true" aria-controls="628fea43-6a5c-42dd-ad81-b7ecd7f42ea6" aria-expanded="false" data-__meta="[object Object]" data-__field="[object Object]">
																				<div class="ant-select-selection__rendered">
																					<ul>
																						<li class="ant-select-search ant-select-search--inline">
																							<div class="ant-select-search__field__wrap">
																								<span class="ant-select-search__field ant-input-affix-wrapper">
																									<span class="ant-input-prefix">
																										<i aria-label="图标: location" class="anticon anticon-location destinationAutoComplete__icon___2aPbK">
																											<img src="/lushu/static/svg/icon-25.svg" style="width: 1rem;height: 1rem">
																										</i>
																									</span>
																									<input class="ant-input ant-input-dark" placeholder="搜索目的地" @input="search_city(2)" v-model="project_city" type="text" value="">
																								</span>
                                                                                                 <div class="city_body" v-if="city_list2_status">
                                                                                            <div class="city_list" v-for="item in city_list2.city" :key="item.id" v-on:click="add_city(item,2)">
                                                                                                <div class="city_name">{{item.region_name}}</div>
                                                                                                <div class="city_enname">{{item.en_name}}  {{item.parent.region_name}}</div>
                                                                                            </div>
                                                                                            <div class="city_user" v-if="city_list2.user.length > 0">以下为用户创建内容</div>
                                                                                            <div class="city_list"  v-for="item in city_list2.user" :key="item.id" v-on:click="add_city(item,2)">
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
																				<span class="ant-select-arrow" unselectable="on" style="user-select: none;">
																					<i aria-label="图标: down" class="anticon anticon-down ant-select-arrow-icon">
																						<svg viewBox="64 64 896 896" class="" data-icon="down" width="1em" height="1em" fill="currentColor" aria-hidden="true" focusable="false">
																							<path d="M153.62 360.52a45.49 45.49 0 0 1 77.17-32.7l281.28 272.39L793.29 329a45.52 45.52 0 1 1 63.22 65.5L543.62 696.24a45.53 45.53 0 0 1-63.27-.06l-312.89-303a45.33 45.33 0 0 1-13.84-32.66z">
																							</path>
																						</svg>
																					</i>
																				</span>
																			</div>
																		</div>
																	</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
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

<!-- 选择poi -->
<?php
if(!isset($map_status)){
    include(dirname(__FILE__,2) . '/layout/project_select_poi.php');
}
?>

