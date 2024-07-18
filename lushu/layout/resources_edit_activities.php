<div class="invisibleWrapper" style="display:none;">
    <div class="tosProjectCssMarker centerModal tosBase modalWrap newCenterModal editActivityModal">
        <div class="modalContainer">
            <div class="navBarSpace">
                <div class="navBar">
                    <div class="left">
                        <h5 class="modalTitle">新建活动与服务</h5>
                    </div>
                    <div class="editActions">
                        <span class="actionBtn btnBorder" v-on:click="closeactivities">取消</span>
                        <span class="actionBtn btnGreen" v-on:click="postactivities">保存</span>
                    </div>
                </div>
            </div>
            <div class="modalCont" id="modalCont">
                <div class="templateViewContainer">
                    <div class="templateViewCont">
                        <div class="mainCont">
                            <div class="jsonSchemaListWrapper">
                                <div class="field" @click="editClick(1)">
                                    <label>名称</label>
                                    <div v-if="Name_status == false">
                                        {{ActivitiesDate.title}}
                                    </div>
                                    <el-input v-if="Name_status == true" v-model="ActivitiesDate.title"></el-input>
                                </div>
                                <div class="field" @click="editClick(2)">
                                    <label>标签</label>
                                    <div class="fieldContent clear">
                                        <div class="editTag">
                                            <div>
                                                <div class="relatedTagList relatedItemList clear tosProjectCssMarker">
                                                    <div class="item"  v-for="(item,index) in ActivitiesDate.label" :key="index">
                                                        <div class="name">{{item.label}}</div>
                                                        <span class="removeBtn">
                                                <i class="icon-minus" v-on:click="del_label(item)"></i>
                                                </span>
                                                    </div>
                                                    <div class="btnCube btnCube1" onclick="$(this).css('display','none');$('.btnCube2').css('display','block');$('.tagPanel__editTagWrapPosition___dLOaA').css('display','block')">
                                                        <i class="iconTag icon-tag2"></i>
                                                    </div>
                                                    <div class="btnCube btnCube2" onclick="$(this).css('display','none');$('.btnCube1').css('display','block');$('.tagPanel__editTagWrapPosition___dLOaA').css('display','none')" style="display: none;">
                                                        <i class="icon-close"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tagPanel__editTagWrapPosition___dLOaA tosProjectCssMarker" style="display: none;">
                                                <div class="tagPanel__editTagWrap___2u_Ee" style="padding: 0px;">
                                                    <div class="tagPanel__relatedTagList___23Ph8 tagPanel__relatedItemList___1smWM">
                                                        <div v-for="(item,index) in label" :key="index"  :class="item.status? ' tagPanel__item___yCbYP tagPanel__tagBtn___3HNMy  tagPanel__selected___vTRl1':'tagPanel__item___yCbYP tagPanel__tagBtn___3HNMy' "  v-on:click="add_project_label(item)">
                                                            <div class="tagPanel__name___10H5M">{{item.label}}</div>
                                                        </div>

                                                        <div class="tagPanel__btnCube___3pngi" onclick="$(this).css('display','none');$('.tagPanel__createTag___ZLmvq').css('display','block')">
                                                            <i aria-label="图标: tag" class="anticon anticon-tag">
                                                                <img src="/lushu/static/svg/icon-133.svg" style="width: 1rem;height: 1rem">
                                                            </i>
                                                            <span class="tagPanel__addTag___2w28Q">添加标签</span>
                                                        </div>
                                                    </div>
                                                    <div class="tagPanel__createTag___ZLmvq" style="display: none;">
                                                        <input type="text" class="tag-input" v-model="label_data" maxlength="20" placeholder="请输入标签">
                                                        <button type="button" onclick="$('.tagPanel__createTag___ZLmvq').css('display','none');$('.tagPanel__btnCube___3pngi').css('display','block')" class="ant-btn tagPanel__close___1ustW ant-btn-lg ant-btn-icon-only">
                                                            <i aria-label="图标: close" class="anticon anticon-close">
                                                                <img src="/lushu/static/svg/icon-11.svg" style="width: 1rem;height: 1rem">
                                                            </i>
                                                        </button>
                                                        <button type="button" v-on:click="add_label" class="ant-btn tagPanel__close___1ustW ant-btn-lg ant-btn-icon-only">
                                                            <i aria-label="图标: check" class="anticon anticon-check">
                                                                <img src="/lushu/static/svg/icon-120.svg" style="width: 1rem;height: 1rem">
                                                            </i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--editing-->
                                <div class="field" @click="editClick(3)">
                                    <label>图片</label>
                                    <div class="fieldContent clear">
                                        <div class="editPictures">
                                            <div class="pictures" v-if="Picture_status == false" style="padding-left:unset;min-height: 80px">
                                                <div v-for="(item,index) in ActivitiesDate.imgList" :key="index" class="picture" style="width:auto;float:left;margin-right: 8px;margin-top: 8px">
                                                    <img :src="item.url" style="width: 165px;height: 110px">
                                                </div>

                                            </div>
                                            <div class="pictures" v-if="Picture_status == true" >
                                                <div v-for="(item,index) in ActivitiesDate.imgList" :key="index" class="draggable pictureContainer" style="width: 165px;height: 110px;" :class="{firstFixedBlock: index == 0}">
                                                    <div class="picture" :style="'width: 165px;height: 110px;background-image: url('+item.url+');'">
                                                        <i class="tos-icon icon-minus btnRemove" v-on:click="DelImgList(item,index)"></i>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="field title" @click="editClick(4)">
                                    <label>相关地点</label>
                                    <div class="fieldContent clear">
                                        <div class="relatedPoiList relatedItemList clear">
                                            <div class="item" v-for="(item,index) in ActivitiesDate.association">
												<span>
													<i class="poiIcon tos-icon icon-tag-1-food"></i>
													<span class="name">{{item.value}}</span>
												</span>
                                                <span class="removeBtn" v-on:click="Del_poi(item.id,index)">
													<i class="icon-minus"></i>
												</span>
                                            </div>
                                            <div v-if="Location_status == true" class="clear" onclick="$('.modalWrap').css('display','block')">
                                                <span class="btnBorderGreen expandMapBtn">关联POI</span>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="field" @click="editClick(5)">
                                    <label>相关目的地</label>
                                    <div class="fieldContent clear">
                                        <div class="relatedDestinationList relatedItemList clear">
                                            <div>
                                                <div>
                                                    <div>
                                                        <div class="relatedTagList relatedItemList clear tosProjectCssMarker">
                                                            <div class="item"  v-for="item in ActivitiesDate.address_code" :key="item.id">
                                                                <div class="name">{{item.value}}</div>
                                                                <span class="removeBtn">
                                                                    <i class="icon-minus" v-on:click="del_city(item)"></i>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div v-if="Destination_status == true" class="destinationAutoComplete__container___2u6IR destinationAutoComplete__hasBorder___3-Prs">
                                                        <div class="ant-row ant-ActivitiesDate-item">
                                                            <div class="ant-ActivitiesDate-item-control-wrapper">
                                                                <div class="ant-ActivitiesDate-item-control">
                                                                    <span class="ant-ActivitiesDate-item-children">
                                                                        <div id="dest" class="ant-select-show-search ant-select-auto-complete ant-select ant-select-combobox ant-select-enabled ant-select-allow-clear">

                                                                            <!-- 一下需替换 -->
                                                                            <div class="ant-select-selection ant-select-selection--single" role="combobox">
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
																							<input class="ant-input ant-input-dark" placeholder="搜索目的地"  @input="search_city(1)" v-model="project_city" type="text" value="">
																						</span>
																						<span class="ant-select-search__field__mirror">&nbsp;</span>
                                                                                        <div class="city_body" v-if="city_list1_status">
                                                                                            <div class="city_list" v-for="item in city_list1.city" :key="item.id" v-on:click="add_city(item,1)">
                                                                                                <div class="city_name">{{item.region_name}}</div>
                                                                                                <div class="city_enname">{{item.en_name}}  {{item.parent.region_name}}</div>
                                                                                            </div>
                                                                                            <div class="city_user" v-if="city_list1.user.length > 0">以下为用户创建内容</div>
                                                                                            <div class="city_list"  v-for="item in city_list1.user" :key="item.id" v-on:click="add_city(item,1)">
                                                                                                 <div class="city_name">{{item.region_name}}</div>
                                                                                                <div class="city_enname">{{item.en_name}}  {{item.parent.region_name}}</div>
                                                                                                <div class="city_icon">
                                                                                                    <img src="/lushu/static/svg/icon-15.svg" style="width: 1rem;height: 1rem">
                                                                                                </div>
                                                                                            </div>
                                                                                         </div>
																					</div>
																				</li>
																			</ul>
                                                                                </div>
                                                                                <span class="ant-select-arrow" unselectable="on" style="user-select: none;">
                                                                                    <i aria-label="图标: down" class="anticon anticon-down ant-select-arrow-icon">
                                                                                        <img src="/lushu/static/svg/icon-2.svg" style="width: 1rem;height: 1rem">
                                                                                    </i>
                                                                                </span>
                                                                            </div>
                                                                        </div>
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
                                <div class="field editPriceOptions" @click="editClick(6)">
                                    <label>参考价</label>
                                    <div class="fieldContent field editing " style="background: #F6F6F6">
                                        <div class="priceOptions editPriceOptions">
                                            <div v-if="Price_status == false" class="priceOption" >
                                                <div style="width: 100%" v-for="(item,index) in ActivitiesDate.price" v-if="item.title || item.value">
                                                    <label class="name">{{item.title}}</label><span class="price">{{item.value}}</span>
                                                </div>

                                            </div>

                                            <div v-if="Price_status == true" v-for="(item,index) in ActivitiesDate.price" :key="index" class="priceOption">
                                                <input class="name" placeholder="请输入标题" v-model="item.title" value="" @input="add_price_list(item,index)">
                                                <input class="price" maxlength="8" placeholder="请输入价格" v-model="item.value" value="" @input="add_price_list(item,index)">
                                                <span class="btnSquare btnBorderRed removeBtn"  v-on:click="del_price_list(index)"><i class="tos-icon icon-minus"></i></span>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="field" @click="editClick(7)">
                                    <label>购买须知</label>
                                    <div v-if="Notice_status == false" class="fieldContent">
                                        {{ActivitiesDate.notice}}
                                    </div>
                                    <div v-if="Notice_status == true" class="fieldContent field editing">
                                        <el-input type="textarea" :rows="2" placeholder="请输入内容" v-model="ActivitiesDate.notice">
                                        </el-input>
                                    </div>
                                </div>
                                <div class="field" @click="editClick(8)">
                                    <label>活动与服务介绍</label>
                                    <div class="fieldContent ">
                                        <div v-if="Service_status ==  false" class="fieldContent">
                                            {{ActivitiesDate.service}}
                                        </div>
                                        <div v-if="Service_status ==  true" class="fieldContent field editing">
                                            <el-input type="textarea" :rows="2" placeholder="请输入内容" v-model="ActivitiesDate.service">
                                            </el-input>
                                        </div>
                                    </div>
                                </div>
                                <div class="field" @click="editClick(9)">
                                    <label>定制师笔记</label>
                                    <div class="fieldContent clear">
                                        <div class="noteListContent">
                                            <div class="draggableNoteList">
                                                <div class="row">
                                                    <div v-for="(item,index) in ActivitiesDate.notes" class="draggable note">
                                                        <div class="tosPieceBox cardPiece ">
                                                            <a href="javascript:void(0)" class="outerLink">
                                                                <div class="pieceHeader" :style="'background-image: url('+item.url+');'">
                                                                    <span class=" avatar" :style="'background-image: url('+item.url+');'"></span>
                                                                </div>
                                                                <div class="pieceContent">
                                                                    <div class="leftEle">
                                                                        <i class="icon icon-note"></i>
                                                                    </div>
                                                                    <div class="right">
                                                                        <div class="title">{{item.title}}</div>
                                                                        <div class="subTitle">{{item.user}}</div>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                            <span v-if="Note_status == true" v-on:click="DelNote(item,index)" class="btnCardRect btnDelete btnRed icon-trashcan">删除</span>

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
                    <div class="subCont">
                        <div class="innerCont">
                            <div class="toolbar">
                                <div v-if="Picture_status == true" class="picturesSelector">
                                    <div class="searchGroup gap10">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="searchWrap searchWrapXS">
                                                    <div class="searchBar">
                                                        <i class="btn-search icon-search"></i>
                                                        <input type="text" v-model="Picture_List_search.title" class="searchInput" placeholder="搜索图片" value="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="sectionTitle clear">请选择要展示的图片</div>
                                    <div class="pictureList">
                                        <div class="row">
                                            <div v-for="(item,index) in Picture_List" :key="index" class="col-md-6">
                                                <div class="picture " :class="{ checked: item.select }">
                                                    <div class="image" :style="'background-image: url('+item.url+');'">
                                                    </div>
                                                    <div class="info">
                                                        <div class="subtitle"></div>
                                                        <div class="creator">{{item.title}}</div>
                                                        <i v-if="item.status == false" class="icon iconAdd icon-plus" v-on:click="AddPicture(item)"></i>
                                                    </div>
                                                    <i v-if="item.status == true" class="icon iconAdded icon-check2" style="opacity: 1;" ></i>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div v-if="Note_status == true" class="cardsSelector">
                                    <div class="searchGroup gap10">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="searchGroup clear">
                                                    <div class="searchWrap searchWrapXS">
                                                        <div class="searchBar">
                                                            <i class="btn-search icon-search"></i>
                                                            <input type="text" class="searchInput" placeholder="搜索笔记" value="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="sectionTitle">请从下列选项中插入贴士，作为补充的定制师笔记</div>
                                    <div class="cardList clear">
                                        <div v-for="(item,index) in NoteList" :key="index" class="cardWrap">
                                            <div class="card " :class="{checked: item.status}">
                                                <div class="tosPieceBox cardPiece ">
                                                    <a href="javascript:void(0)" class="outerLink">
                                                        <div class="pieceHeader" :style="'background-image: url('+item.url+');'">
                                                            <span class=" avatar" :style="'background-image: url('+item.url+');'"></span>
                                                        </div>
                                                        <div class="pieceContent">
                                                            <div class="leftEle">
                                                                <i class="icon icon-note"></i>
                                                            </div>
                                                            <div class="right">
                                                                <div class="title">{{item.title}}</div>
                                                                <div class="subTitle">{{item.user}}</div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                                <div class="info">
                                                    <i v-if="item.status == false" class="icon iconAdd icon-plus" v-on:click="AddNote(item)"></i>
                                                </div>
                                                <i v-if="item.status == true" class="icon iconAdded icon-check2" style="opacity: 1;"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div v-if="showStr == 'name'" class="title">
                                    {{ActivitiesDate.content}}
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
<?php include(dirname(__FILE__,2) . '/layout/project_select_poi.php');?>