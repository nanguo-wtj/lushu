<!-- 新建 -->
<div id="Hotel_add" class="centerModal modalWrap tosBase editPoiModal editContent tosProjectCssMarker" style="display: none">
    <div class="modalContainer">
        <div class="modalNavBar">
            <div class="modalActions">
                <span class="btnBorder cancelBtn" onclick="hotel_close()">取消</span>
                <span class="btnGreen submitBtn" v-on:click="post_poi">保存</span>
            </div>
            <div class="modalTitle" v-if="project_data.key_id">编辑酒店</div>
            <div class="modalTitle" v-if="!project_data.key_id">新建酒店</div>
        </div>
        <div class="modalBody">
            <div class="bodyPanel">
                <div class="jsonSchemaListWrapper editTable">
                    <div class="field editNames required highlightable">
                        <label>名称</label>
                        <div class="fieldContent clear">
                            <div class="names editNames">
                                <div class="nameLine">
                                    <label class="name">中文</label>
                                    <input class="singleInput input nameValue" v-model="project_data.title" maxlength="64" placeholder="请输入中文名称" value="">
                                </div>
                                <div class="nameLine">
                                    <label class="name">英文</label>
                                    <input class="singleInput input nameValue" v-model="project_data.en_title" maxlength="64" placeholder="请输入英文名称" value="">
                                </div>
                                <div class="nameLine">
                                    <label class="name">其他语言</label>
                                    <input class="singleInput input nameValue" v-model="project_data.other_title" maxlength="64" placeholder="请输入其他语言名称" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="field required geographicalPosition">
                        <label>地理位置</label>
                        <div class="fieldContent clear">
                            <div class="poiMap">
                                <div class="map__piecefulMap___cY63A editPoiMap">
                                    <div class="map__mapBlock___2rphQ mapboxgl-map">
                                        <iframe src="layout/map_edit_poi.php"  id="map_edit" width="100%" height="100%"></iframe>
                                    </div>
                                </div>
                                <form  @submit.prevent="search_address_map">
                                    <input type="submit" value="on" style="display: none">
                                    <div class="searchWrap searchWrapS" style="z-index: 200;">
                                        <div class="searchBar">
                                            <i class="btn-search  icon-search"></i>
                                            <input type="text" class="mapStr" v-model="project_data.address" placeholder="请输入详细地址" onchange="addNewPoi()" value="">
                                            <i class="btn-clear-text icon-close" style="display: none;"></i>
                                        </div>
                                        <div class="searchResultsPopup">
                                            <div class="searchResultsList">
                                                <div class="resultItem " v-for="(item,index) in search_data.poi_list" :key="index" v-on:click="add_poi_address(item)">
                                                    <span class="icon  "></span>
                                                    <span class="itemTitle">{{item.name}},{{item.district}}</span>
                                                </div>
                                                <div v-if="!search_data.poi_list" class="resultItem" style="text-align: center">
                                                    搜索中，请稍候.......
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </form>


                                <div class="tips">定位不准确？请拖动图标，移动到精确的位置。</div>
                            </div>
                        </div>
                    </div>
                    <div class="field">
                        <label>相关目的地</label>
                        <div class="fieldContent clear">
                            <div class="relatedDestinationList relatedItemList clear">
                                <div>
                                    <div>
                                        <div class="item city" v-for="item in project_data.address_code" :key="item.id"  >
                                            <div class="name">{{item.value}}</div>
                                            <span class="removeBtn">
                                                <i class="tos-icon icon-minus" v-on:click="del_city(item)"></i>
                                            </span>
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
															<div class="ant-select-selection
            ant-select-selection--single" role="combobox" aria-autocomplete="list" aria-haspopup="true" aria-controls="0cd4f234-66f8-4b28-991f-e07f219c661c" aria-expanded="false" data-__meta="[object Object]" data-__field="[object Object]">
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
                                                                                    <input class="ant-input ant-input-dark" @input="search_city(1)" v-model="project_city" placeholder="搜索目的地" type="text" value="">
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
																				<span class="ant-select-search__field__mirror">&nbsp;</span>
																			</div>
																		</li>
																	</ul>
																</div>
																<span class="ant-select-arrow" unselectable="on" style="user-select: none;">
																	<i aria-label="图标: down" class="anticon anticon-down ant-select-arrow-icon">
																		<img src="/lushu/static/svg/icon-26.svg" style="width: 1rem;height: 1rem">
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
                    <div class="field required">
                        <label>类别</label>
                        <div class="fieldContent clear">
                            <ul class="tagsWrap clear">
                                <li  v-for="(item,index) in project_type" :key="index"  :class="item.status? item.class_s+' active':item.class_s " v-on:click="Set_project_type(item,(index+1))">
                                    <span class="toolTips">{{item.name}}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="field">
                        <label>标签</label>
                        <div class="fieldContent clear">
                            <div class="editTag">
                                <div>
                                    <div class="relatedTagList relatedItemList clear tosProjectCssMarker">
                                        <div class="item"  v-for="(item,index) in project_data.label" :key="index">
                                            <div class="name">{{item.label}}</div>
                                            <span class="removeBtn">
                                                <i class="icon-minus" v-on:click="del_label(item)"></i>
                                            </span>
                                        </div>
                                        <div class="btnCube">
                                            <i class="icon-close"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="editTagWrapPosition">
                                    <div class="editTagWrap">
                                        <div class="error"></div>
                                        <div class="relatedTagList relatedItemList clear">
                                            <div v-for="(item,index) in label" :key="index"  :class="item.status? ' item selected':'item tagBtn' "  v-on:click="add_project_label(item)">
                                                <div class="name">{{item.label}}</div>
                                            </div>

                                            <div class="createTag">
                                                <input type="text" maxlength="20" v-model="label_data" placeholder="请输入标签">
                                                <div class="btnCube" v-on:click="add_label()">
                                                    <i class="icon-check2" ></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="field">
                        <label>酒店星级</label>
                        <div class="fieldContent clear">
                            <div class="editHotelStar">
                                <div v-for="a in 5"  :class="a <= rating?  'editStar selected':'editStar'"  v-on:click="Set_rating(a)">
                                    <i class="iconStar icon-star"></i>
                                    <i class="iconStarBg icon-star2"></i>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="field">
                        <label>设施</label>
                        <div class="fieldContent clear">
                            <ul class="facilityWrap clear">

                                <li  v-for="(item,index) in facilities" :key="index"  :class="item.status? item.class_s+' active':item.class_s " v-on:click="Set_project_facilities(item,(index+1))">
                                    <span class="toolTips">{{item.name}}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="field highlightable">
                        <label>电话</label>
                        <div class="fieldContent clear">
                            <input class="singleInput" v-model="project_data.phone" maxlength="20" value="">
                        </div>
                    </div>
                    <div class="field highlightable">
                        <label>网址</label>
                        <div class="fieldContent clear">
                            <input class="singleInput" v-model="project_data.official_web" maxlength="200" value="">
                        </div>
                    </div>
                    <div class="field highlightable">
                        <label>开放时间</label>
                        <div class="fieldContent clear">
                            <div class="textareaWrapper">
                                <textarea v-model="project_data.opening_hours"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="field highlightable">
                        <label>消费</label>
                        <div class="fieldContent clear">
                            <div class="textareaWrapper">
                                <textarea v-model="project_data.consumption"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="field highlightable">
                        <label>交通</label>
                        <div class="fieldContent clear">
                            <div class="textareaWrapper">
                                <textarea v-model="project_data.traffic"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="field highlightable">
                        <label>用时参考</label>
                        <div class="fieldContent clear">
                            <div class="textareaWrapper">
                                <textarea v-model="project_data.time_reference"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="field editPriceOptions">
                        <label>房型</label>
                        <div class="fieldContent clear">
                            <div class="priceOptions editPriceOptions">
                                <div class="priceOption" v-for="(item,index) in project_data.price_list" :key="index" >
                                    <input class="name" placeholder="请输入标题" v-model="item.title" value="" @input="add_price_list(item,index)">
                                    <input class="price" maxlength="8" placeholder="请输入价格" v-model="item.value" value="" @input="add_price_list(item,index)">
                                    <span class="btnSquare btnBorderRed removeBtn"  v-on:click="del_price_list(index)"><i class="tos-icon icon-minus"></i></span>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="field placeGuide highlightable">
                        <label>地点简介</label>
                        <div class="fieldContent clear">
                            <div class="textareaWrapper">
                                <textarea maxlength="250" v-model="project_data.introduction"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="field policy">
                        <label>酒店政策</label>
                        <div class="fieldContent clear">
                            <div class="editTipsBody">
                                <div class="piecefulEditor articleCont">
                                    <div class="fr-box fr-top fr-basic">
                                        <div class="fr-toolbar fr-ltr fr-desktop fr-top fr-basic"></div>
                                        <div class="fr-wrapper">
                                            <div id="policy" contenteditable="true" style="min-height: 680px;" class="fr-element fr-view" dir="auto" spellcheck="true">

                                            </div>
                                            <span class="fr-placeholder" style="font-size: 16px; line-height: 25.6px; margin-top: 0px;">请输入内容</span>
                                        </div>
                                        <span class="fr-counter"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="field guide">
                        <label>实用指南</label>
                        <div class="fieldContent clear">
                            <div class="editTipsBody">
                                <div class="piecefulEditor articleCont">
                                    <div class="editor__piecefulEditor___QSJXD addTripRichText__richEditor___3AXgH">
                                        <!-- 富文本 -->
                                        <!-- 头 -->
                                        <div class="editor__editorActions___3V13t addTripRichText__richEditorActionBar___UDF6g" id="div3">

                                        </div>
                                        <!-- 内容 -->
                                        <div class="editor__richContent___x93pI fr-box fr-top fr-basic" id="div4">

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