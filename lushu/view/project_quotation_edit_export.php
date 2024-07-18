<!-- 导入顶部数据  -->
<?php include(dirname(__FILE__,2) . '/layout/header.php');?>
<style>
    p{
        color: #5e5e5e;
    }
    div{
        color: #5e5e5e;
    }
</style>
<body class="appName-workbench">
<div id="webMain" ref="pageTop">
    <div>
        <div class="">
            <div id="pageWrap" class="editLayout__editLayout___3vFVX">
                <div class="transitIndicator__transitIndicator___3m8Gd">
                    <div class="transitIndicator__transitBar___2q3uc"></div>
                </div>
                <div class="editLayout__pageTopBar___HuSEJ">
                    <div class="editLayout__breadcrumb___mkSjH ant-breadcrumb ant-breadcrumb-dark">

                            <span class="ant-breadcrumb-link">
                                <a class="globalLink undefined-link" href="./staging_project_export.html?key_id=<?=$key_id?>">{{project_data.title}}</a>
                            </span>
                            <span class="ant-breadcrumb-separator">
                                <i aria-label="图标: right" class="anticon anticon-right">
                                    <img src="/lushu/static/svg/icon-67.svg" style="width: 1rem;height: 1rem">
                                </i>
                            </span>
                        </span>
                        <span>
                            <span class="ant-breadcrumb-link">行程报价</span>
                            <span class="ant-breadcrumb-separator" >
                                <i aria-label="图标: right" class="anticon anticon-right">
                                    <img src="/lushu/static/svg/icon-67.svg" style="width: 1rem;height: 1rem">
                                </i>
                            </span>
                        </span>
                    </div>
                    <div class="editLayout__rightActions___3kOHV">

                        <button preventspace="true" type="button" onclick="history.back()" class="ant-btn ant-btn-primary">
                            <span>返回</span>
                        </button>
                    </div>
                </div>
                <div class="editLayout__pageContainer___1_d0K">
                    <div class="editProjectTripQuote__container___Yf5ms">
                        <div class="tosProjectCssMarker">
                            <div class="editQuote__editQuote___3FZQ0 editQuote__editQuoteComponent___1aUD9 editProjectTripQuote__tripQuoteContainer___GtyXp">
                                <div>
                                    <div class="editQuote__headerContainer___3B5EZ">
                                        <div class="editQuote__btnWrapper___2hBtR">
                                            <button preventspace="true" type="button" v-on:click="$('.setPrise').css('display', 'block')" class="ant-btn ant-btn-lg">
                                                <span>设置价格表</span>
                                            </button>
                                        </div>
                                        <div v-if="quotation_top.length > 1" class="ant-tabs ant-tabs-top ant-tabs-line">
                                            <div role="tablist" class="ant-tabs-bar ant-tabs-top-bar" tabindex="0">
                                                <div class="ant-tabs-nav-container">

                                                    <div class="ant-tabs-nav-wrap">
                                                        <div class="ant-tabs-nav-scroll">
                                                            <div class="ant-tabs-nav ant-tabs-nav-animated">
                                                                <div>
                                                                    <div  v-for="(item,index) in quotation_top" :key="index" v-on:click="openItinerary(item)"   :class="item.id == quotation_top_id? 'ant-tabs-tab-active ant-tabs-tab':'ant-tabs-tab '">{{item.class_type}}</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="editQuote__headerRow___9_PxR">
                                            <div class="editQuote__totalPrice___2W7Ue">
                                                <span class="editQuote__priceTitle___2yZ1U">行程报价：</span>
                                                <div class="editQuote__price___2uIIZ editQuote__edit___3FmJ2">
                                                    <span class="editQuote__currency___1j9Ql">(货币: 人民币)</span>
                                                </div>
                                                <span v-if="quotation_top_status == false" class="editQuote__actions___2dGg1">
                                                    <button preventspace="true" v-on:click="open_time(true)" type="button" class="ant-btn editQuote__actionBtn___2OoW6 ant-btn-lg">
                                                        <span>取消</span>
                                                    </button>
                                                    <button type="button" v-on:click="post_time()" class="ant-btn editQuote__actionBtn___2OoW6 ant-btn-primary ant-btn-lg">
                                                        <span>保存</span>
                                                    </button>
                                                </span>
                                                <span class="editQuote__actions___2dGg1" v-if="quotation_top_status == true">
                                                    <button type="button" class="ant-btn ant-btn-plain ant-btn-lg" v-on:click="open_time(false)">
                                                        <i aria-label="图标: edit" class="anticon anticon-edit">
                                                            <img src="/lushu/static/svg/icon-107.svg" style="width: 1rem;height: 1rem">
                                                        </i>
                                                        <span>编辑报价</span>
                                                    </button>
                                                </span>

                                            </div>
                                        </div>
                                        <div class="tripPriceTable__priceTable___3mNyy">
                                            <div class="tosProjectCssMarker dataTable__dataTableSet___3xooO">
                                                <div class="dataTable__dataTable___3z9Jt" v-if="quotation_top_status == true">
                                                    <div class="dataTable__th___2jo2p">
                                                        <span style="width: 19%" class="dataTable__tableDimensions___pL2Q9 dataTable__double___1Nv3p">
                                                            <span class="dataTable__colTitle___dZ1YN">游客分类</span>
                                                            <span class="dataTable__rowTitle___ydKnj">出行日期</span>
                                                        </span>
                                                        <span style="width: 19%"  class="dataTable__cell___3kPEN dataTable__colHeader___2g_sn">成人</span>
                                                        <span style="width: 19%" v-if="classification[0].status == true" class="dataTable__cell___3kPEN dataTable__colHeader___2g_sn">老人</span>
                                                        <span style="width: 19%" v-if="classification[1].status == true" class="dataTable__cell___3kPEN dataTable__colHeader___2g_sn">儿童</span>
                                                        <span style="width: 19%" v-if="classification[2].status == true" class="dataTable__cell___3kPEN dataTable__colHeader___2g_sn">婴儿</span>
                                                    </div>
                                                    <div v-loading="loading" v-for="(item,index) in quotation_top_list" :key="index" class="dataTable__tr___3V6y4">
                                                         <span style="width: 19%" class="dataTable__cell___3kPEN dataTable__rowHeader___xAjP6">{{item.title}}</span>
                                                        <span style="width: 19%" class="dataTable__cell___3kPEN" >{{item.adult}}</span>
                                                        <span style="width: 19%" v-if="classification[0].status == true" class="dataTable__cell___3kPEN" >{{item.old}}</span>
                                                        <span style="width: 19%" v-if="classification[1].status == true" class="dataTable__cell___3kPEN" >{{item.children}}</span>
                                                        <span style="width: 19%" v-if="classification[2].status == true" class="dataTable__cell___3kPEN" >{{item.baby}}</span>
                                                    </div>
                                                </div>
                                                <div class="dataTable__dataTable___3z9Jt" v-if="quotation_top_status == false">
                                                    <div class="dataTable__th___2jo2p">
                                                        <span style="width: 19%" class="dataTable__tableDimensions___pL2Q9 dataTable__double___1Nv3p">
                                                            <span class="dataTable__colTitle___dZ1YN">游客分类</span>
                                                            <span class="dataTable__rowTitle___ydKnj">出行日期</span>
                                                        </span>
                                                        <span style="width: 19%" class="dataTable__cell___3kPEN dataTable__colHeader___2g_sn">成人</span>
                                                        <span style="width: 19%" v-if="classification[0].status == true" class="dataTable__cell___3kPEN dataTable__colHeader___2g_sn">老人</span>
                                                        <span style="width: 19%" v-if="classification[1].status == true" class="dataTable__cell___3kPEN dataTable__colHeader___2g_sn">儿童</span>
                                                        <span style="width: 19%" v-if="classification[2].status == true" class="dataTable__cell___3kPEN dataTable__colHeader___2g_sn">婴儿</span>
                                                    </div>
                                                    <div v-for="(item,index) in quotation_top_lists" :key="index" class="dataTable__tr___3V6y4">
                                                         <span style="width: 19%" class="dataTable__cell___3kPEN dataTable__rowHeader___xAjP6">{{item.title}}</span>
                                                        <span style="width: 19%" class="dataTable__cell___3kPEN" >
                                                            <input type="text" value="" v-model="quotation_top_lists[index].adult" placeholder="点击编辑价格" style="width: 100%;height: 100%;border: 1px solid #fdfdfe;">
                                                        </span>
                                                        <span style="width: 19%" v-if="classification[0].status == true" class="dataTable__cell___3kPEN" >
                                                            <input type="text" value="" v-model="quotation_top_lists[index].old" placeholder="点击编辑价格" style="width: 100%;height: 100%;border: 1px solid #fdfdfe;">
                                                        </span>
                                                        <span style="width: 19%" v-if="classification[1].status == true" class="dataTable__cell___3kPEN" >
                                                            <input type="text" value="" v-model="quotation_top_lists[index].children" placeholder="点击编辑价格" style="width: 100%;height: 100%;border: 1px solid #fdfdfe;">
                                                        </span>
                                                        <span style="width: 19%" v-if="classification[2].status == true" class="dataTable__cell___3kPEN" >
                                                            <input type="text" value="" v-model="quotation_top_lists[index].baby" placeholder="点击编辑价格" style="width: 100%;height: 100%;border: 1px solid #fdfdfe;">
                                                        </span>
                                                        <span v-if="index > 0" v-on:click="Delquotation_top_lists(index)" style="width: 4%;" class="editQuote__column___2B62e editQuote__delete___3NZ8V"  style='width: 4%;'>
                                                            <i aria-label="图标: minus-circle" tabindex="-1" class="anticon anticon-minus-circle editQuote__deleteBtn___3B69A">
                                                                <img src="/lushu/static/svg/icon-125.svg" style="width: 1rem;height: 1rem">
                                                            </i>
                                                        </span>
                                                    </div>
                                                    <div v-if="quotation_top_status == false"  class="dataTable__tr___3V6y4">
                                                        <button v-on:click="openPicker" preventspace="true" type="button" class="ant-btn ant-btn-plain" ant-click-animating-without-extra-node="false">
                                                            <i aria-label="图标: plus-circle" class="anticon anticon-plus-circle dataTable__icon___oP9tR">
                                                                <img src="/lushu/static/svg/icon-124.svg" style="width: 1rem;height: 1rem">
                                                            </i>
                                                            <span>添加报价日期</span>
                                                        </button>
                                                        <div style="opacity: 0;width: 20%;margin-left: 0;">
                                                            <el-date-picker
                                                                    v-model="quotation_top_data.time"
                                                                    type="daterange"
                                                                    ref="dateTime"
                                                                    @change="addTime"
                                                                    start-placeholder="开始日期"
                                                                    end-placeholder="结束日期"
                                                                    :default-time="['00:00:00', '23:59:59']"
                                                            >
                                                            </el-date-picker>
                                                        </div>

                                                    </div>
                                                </div>






                                            </div>
                                        </div>
                                    </div>
                                    <div class="editQuote__contentContainer___2A0KS editQuote__contentContainerEdit___17FTr">
                                        <div class="editQuote__section___ZB-wU">
                                            <div class="editQuote__sectionHeader___bWqD4">费用说明</div>
                                            <div class="editQuote__header___315Tv">
                                                <div class="editQuote__column___2B62e editQuote__nameTripEditable___27oeG">项目名称
                                                </div>
                                                <div class="editQuote__column___2B62e editQuote__descriptionTripEditable___3HtPe">
                                                    描述</div>
                                            </div>
                                            <div v-for="(item,index) in cost_list" :key="index"  style="border:unset" class="editQuote__dataRow___2zh0l editQuote__noPrice___3CA_B">
                                                <div style='padding: 16px 8px;cursor: pointer;width: 95%;float: left;border-bottom: 1px solid #eeeeee' v-on:click="open_const(item,index)">
                                                    <div v-if="item.status == false" class="editQuote__column___2B62e editQuote__nameTripEditable___27oeG" >
                                                        {{item.title}}
                                                    </div>
                                                    <div  v-if="item.status == false" v-html="item.content"  class="editQuote__column___2B62e editQuote__descriptionTripNoPriceEditable___E2tYq">

                                                    </div>
                                                    <div v-if="item.status == false" v-on:click="Del_quotation(item.id,1)" class="editQuote__column___2B62e editQuote__delete___3NZ8V"  style='width: 3%;'>
                                                        <i aria-label="图标: minus-circle" tabindex="-1" class="anticon anticon-minus-circle editQuote__deleteBtn___3B69A">
                                                            <img src="/lushu/static/svg/icon-125.svg" style="width: 1rem; height: 1rem;">
                                                        </i>
                                                    </div>
                                                </div>


                                                <div style="width: 100%;" v-if="item.status == true">
                                                    <input class="editQuote__titleEdit___2rIee" v-model="cost_data.title" type="text" placeholder="项目名称" value="">
                                                    <textarea style="height: 200px;" class="editQuote__descriptionEdit___2iyCf" placeholder="输入项目信息" v-model="cost_data.content"></textarea>
                                                    <div class="editQuote__actionBar___ILUtO">
                                                        <button preventspace="true" v-on:click="close_const()" type="button" class="ant-btn editQuote__actionBtn___2OoW6 ant-btn-lg">
                                                            <span>取消</span>
                                                        </button>
                                                        <button type="button" v-on:click="Post_const()"  class="ant-btn editQuote__actionBtn___2OoW6 ant-btn-primary ant-btn-lg">
                                                            <span>保存</span>
                                                        </button>

                                                    </div>
                                                </div>

                                            </div>
                                            <div v-if="cuoct_status == true" class="editQuote__dataRow___2zh0l editQuote__noPrice___3CA_B">
                                                <div style="width: 100%;" >
                                                    <input class="editQuote__titleEdit___2rIee" v-model="cost_data.title" type="text" placeholder="项目名称" value="">
                                                    <textarea style="height: 200px;" class="editQuote__descriptionEdit___2iyCf" placeholder="输入项目信息" v-model="cost_data.content"></textarea>
                                                    <div class="editQuote__actionBar___ILUtO">
                                                        <button preventspace="true" v-on:click="close_const()" type="button" class="ant-btn editQuote__actionBtn___2OoW6 ant-btn-lg">
                                                            <span>取消</span>
                                                        </button>
                                                        <button type="button" v-on:click="Post_const()" class="ant-btn editQuote__actionBtn___2OoW6 ant-btn-primary ant-btn-lg">
                                                            <span>保存</span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div v-if="cuoct_status == false" class="editQuote__btnBar___1EqT5">


                                                <button type="button" v-on:click="addcuoct()" class="ant-btn editQuote__addBtn___2Sfp7 ant-btn-plain ant-btn-lg">
                                                    <i aria-label="图标: plus-circle" class="anticon anticon-plus-circle">
                                                        <img src="/lushu/static/svg/icon-65.svg" style="width: 1rem; height: 1rem;">
                                                    </i>
                                                    <span>添加项目</span>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="editQuote__section___ZB-wU editQuote__notIncludes___2UqSO">
                                            <div class="editQuote__sectionHeader___bWqD4">费用不包括</div>
                                            <div class="editQuote__header___315Tv editQuote__empty___2VV9q"></div>
                                            <div v-for="(item,index)  in not_included" :key="index"  class="editQuote__dataRow___2zh0l editQuote__onlyOneColumn___2keCS">
                                                <div v-on:click="open_not_included(item,index)" v-if="item.status == false"  v-html="item.content"  class="editQuote__column___2B62e editQuote__descriptionOnlyOneTripEditable___3cT5D">

                                                </div>
                                                <div v-if="item.status == false" v-on:click="Del_quotation(item.id,2)"  class="editQuote__column___2B62e editQuote__delete___3NZ8V"  style='width: 4%;'>
                                                    <i aria-label="图标: minus-circle" tabindex="-1" class="anticon anticon-minus-circle editQuote__deleteBtn___3B69A">
                                                        <img src="/lushu/static/svg/icon-125.svg" style="width: 1rem; height: 1rem;">
                                                    </i>
                                                </div>
                                                <div v-if="item.status == true" >
                                                    <textarea style="height: 200px;" class="editQuote__descriptionEdit___2iyCf" v-model="not_included_data.content" placeholder="输入项目信息"></textarea>
                                                    <div class="editQuote__actionBar___ILUtO">
                                                        <button preventspace="true" v-on:click="close_not_included()" type="button" class="ant-btn editQuote__actionBtn___2OoW6 ant-btn-lg">
                                                            <span>取消</span>
                                                        </button>
                                                        <button type="button" v-on:click="Post_NotIncluded" class="ant-btn editQuote__actionBtn___2OoW6 ant-btn-primary ant-btn-lg">
                                                            <span>保存</span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div v-if="not_included_status == true"  class="editQuote__dataRow___2zh0l editQuote__onlyOneColumn___2keCS">
                                                <textarea style="height: 200px;" class="editQuote__descriptionEdit___2iyCf" v-model="not_included_data.content" placeholder="输入项目信息"></textarea>
                                                <div class="editQuote__actionBar___ILUtO">
                                                    <button preventspace="true" v-on:click="close_not_included()" type="button" class="ant-btn editQuote__actionBtn___2OoW6 ant-btn-lg">
                                                        <span>取消</span>
                                                    </button>
                                                    <button type="button" v-on:click="Post_NotIncluded" class="ant-btn editQuote__actionBtn___2OoW6 ant-btn-primary ant-btn-lg">
                                                        <span>保存</span>
                                                    </button>
                                                </div>
                                            </div>
                                            <div v-if="not_included_status == false" class="editQuote__btnBar___1EqT5">
                                                <button type="button" v-on:click="addnot_included()" class="ant-btn editQuote__addBtn___2Sfp7 ant-btn-plain ant-btn-lg">
                                                    <i aria-label="图标: plus-circle" class="anticon anticon-plus-circle">
                                                        <img src="/lushu/static/svg/icon-65.svg" style="width: 1rem; height: 1rem;">

                                                    </i>
                                                    <span>添加项目</span>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="editQuote__section___ZB-wU">
                                            <div class="editQuote__sectionHeader___bWqD4">可选付费项目</div>
                                            <div class="editQuote__header___315Tv">
                                                <div class="editQuote__column___2B62e editQuote__nameTripEditable___27oeG" >项目名称
                                                </div>
                                                <div class="editQuote__column___2B62e editQuote__descriptionTripEditable___3HtPe">
                                                    描述</div>
                                            </div>
                                            <div v-for="(item,index) in PaidItemsList" :key="index" class="editQuote__dataRow___2zh0l editQuote__noPrice___3CA_B">
                                                <div v-if="item.status == false" v-on:click="open_PaidItems(item,index)" class="editQuote__column___2B62e editQuote__nameTripEditable___27oeG" >{{item.title}}</div>
                                                <div v-if="item.status == false" v-on:click="open_PaidItems(item,index)" class="editQuote__column___2B62e editQuote__descriptionTripNoPriceEditable___E2tYq" v-html="item.content"></div>
                                                <div v-if="item.status == false" v-on:click="Del_quotation(item.id,3)" class="editQuote__column___2B62e editQuote__delete___3NZ8V"  style='width: 4%;'>
                                                    <i aria-label="图标: minus-circle" tabindex="-1" class="anticon anticon-minus-circle editQuote__deleteBtn___3B69A">
                                                        <img src="/lushu/static/svg/icon-125.svg" style="width: 1rem; height: 1rem;">
                                                    </i>
                                                </div>
                                                <div v-if="item.status == true" style="width: 100%;" >
                                                    <input class="editQuote__titleEdit___2rIee" v-model="PaidItemsData.title" type="text" placeholder="项目名称" value="">
                                                    <textarea style="height: 200px;" class="editQuote__descriptionEdit___2iyCf" placeholder="输入项目信息" v-model="PaidItemsData.content"></textarea>
                                                    <div class="editQuote__actionBar___ILUtO">
                                                        <button preventspace="true" v-on:click="close_PaidItems()" type="button" class="ant-btn editQuote__actionBtn___2OoW6 ant-btn-lg">
                                                            <span>取消</span>
                                                        </button>
                                                        <button type="button" v-on:click="Post_PaidItems" class="ant-btn editQuote__actionBtn___2OoW6 ant-btn-primary ant-btn-lg">
                                                            <span>保存</span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div v-if="PaidItemsStatus == true" class="editQuote__dataRow___2zh0l editQuote__noPrice___3CA_B">
                                                <input class="editQuote__titleEdit___2rIee" v-model="PaidItemsData.title" type="text" placeholder="项目名称" value="">
                                                <textarea style="height: 200px;" class="editQuote__descriptionEdit___2iyCf" placeholder="输入项目信息" v-model="PaidItemsData.content"></textarea>
                                                <div class="editQuote__actionBar___ILUtO">
                                                    <button preventspace="true" v-on:click="close_PaidItems()" type="button" class="ant-btn editQuote__actionBtn___2OoW6 ant-btn-lg">
                                                        <span>取消</span>
                                                    </button>
                                                    <button type="button"  v-on:click="Post_PaidItems" class="ant-btn editQuote__actionBtn___2OoW6 ant-btn-primary ant-btn-lg">
                                                        <span>保存</span>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="editQuote__btnBar___1EqT5">
                                                <button type="button" v-on:click="addPaidItems()" class="ant-btn editQuote__addBtn___2Sfp7 ant-btn-plain ant-btn-lg">
                                                    <i aria-label="图标: plus-circle" class="anticon anticon-plus-circle">
                                                        <img src="/lushu/static/svg/icon-65.svg" style="width: 1rem; height: 1rem;">
                                                    </i>
                                                    <span>添加项目</span>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="editQuote__section___ZB-wU editQuote__introduction___1yGlX">
                                            <div class="editQuote__sectionHeader___bWqD4">补充说明
                                                <button v-on:click="open_supplement()" v-if="supplementStatsu == false" type="button" class="ant-btn editQuote__btnEdit___1c2iB ant-btn-plain ant-btn-sm">
                                                    <i aria-label="图标: edit" class="anticon anticon-edit">
                                                        <img src="/lushu/static/svg/icon-107.svg" style="width: 1rem; height: 1rem;">
                                                    </i>
                                                    <span>编辑</span>
                                                </button>
                                            </div>

                                            <div v-if="supplementStatsu == false" class="editQuote__introductionContent___1GgRE" v-html="supplementdata.content">

                                            </div>
                                            <div v-if="supplementStatsu == true">
                                                <textarea v-model="supplementdatas.content" style="height: 200px;width: 100%" class="editQuote__descriptionEdit___2iyCf" placeholder="输入项目信息" >
                                                </textarea>
                                                <div class="editQuote__actionBar___ILUtO">
                                                    <button style="float: right;" type="button" v-on:click="Post_supplement()" class="ant-btn editQuote__actionBtn___2OoW6 ant-btn-primary ant-btn-lg">
                                                        <span>保存</span>
                                                    </button>
                                                    <button style="float: right;margin-right: 15px" preventspace="true" v-on:click="close_supplement()" type="button" class="ant-btn editQuote__actionBtn___2OoW6 ant-btn-lg">
                                                        <span>取消</span>
                                                    </button>
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
            <div class="authWatcher accessoryWrapper "></div>
            <div class="tosAlerts accessoryWrapper tosProjectCssMarker"></div>
            <div class="projectModuleEditing accessoryWrapper "></div>
        </div>
    </div>
    <!-- 设置价格表 -->
    <div class="setPrise" style="display: none;">
        <div class="ant-drawer ant-drawer-right ant-drawer-open" style="">
            <div class="ant-drawer-mask"></div>
            <div class="ant-drawer-content-wrapper" style="width: 600px;">
                <div class="ant-drawer-content">
                    <div class="ant-drawer-wrapper-body" style="overflow: auto; height: 100%;">
                        <div class="ant-drawer-header">
                            <div class="ant-drawer-title">设置价格表</div>
                            <div class="ant-drawer-right-actions">
                                <div class="ant-drawer-actions">
                                    <button type="button" v-on:click="Setquotation()" class="ant-btn ant-btn-primary">
                                        <span>确认</span>
                                    </button>
                                </div>
                                <button onclick="$('.setPrise').css('display', 'none')" aria-label="Close" class="ant-drawer-close">
                                    <i aria-label="图标: close" class="anticon anticon-close">
                                        <img src="/lushu/static/svg/icon-11.svg" style="width: 1rem; height: 1rem;">
                                    </i>
                                </button>
                            </div>
                        </div>
                        <div class="ant-drawer-body">
                            <div class="tosProjectCssMarker editQuote__configQuoteTable___pTm4P">
                                <!-- <div class="editQuote__configRow___3opIu"><span class="editQuote__label___rlKep">报价日历</span>
                               <div class="editQuote__configContent___Y3frG"><button type="button" role="switch"
                                     aria-checked="true" class="ant-switch ant-switch-checked"><span
                                        class="ant-switch-inner"></span></button></div>
                            </div> -->
                                <div class="editQuote__configRow___3opIu">
                                    <span class="editQuote__label___rlKep">游客分类</span>
                                    <div class="editQuote__configContent___Y3frG">
                                        <label class="editQuote__checkbox___38AZz ant-checkbox-wrapper ant-checkbox-wrapper-checked ant-checkbox-wrapper-disabled">
												<span class="ant-checkbox ant-checkbox-checked ant-checkbox-disabled">
													<span class="ant-checkbox-inner"></span>
												</span>
                                            <span>成人(默认)</span>
                                        </label>
                                        <label v-for="(item,index) in classification" :key="index" class="editQuote__checkbox___38AZz ant-checkbox-wrapper">
												<span v-on:click="item_status(item)" :class="item.status == true? 'ant-checkbox ant-checkbox-checked':'ant-checkbox '">
													<span class="ant-checkbox-inner"></span>
												</span>
                                            <span>{{item.value}}</span>
                                        </label>

                                    </div>
                                </div>
                                <div class="editQuote__configRow___3opIu">
                                    <span class="editQuote__label___rlKep">报价分级</span>
                                    <div class="editQuote__configContent___Y3frG">
                                        <label class="editQuote__checkbox___38AZz ant-checkbox-wrapper ant-checkbox-wrapper-checked ant-checkbox-wrapper-disabled">
												<span class="ant-checkbox ant-checkbox-checked ant-checkbox-disabled">
													<input type="checkbox" disabled="" class="ant-checkbox-input" value="" checked="">
													<span class="ant-checkbox-inner"></span>
												</span>
                                            <span>标准(默认)</span>
                                        </label>
                                        <label v-for="(item,index) in grading" :key="index" class="editQuote__checkbox___38AZz ant-checkbox-wrapper">
												<span v-on:click="item_status(item)" :class="item.status == true? 'ant-checkbox ant-checkbox-checked':'ant-checkbox '">
													<span class="ant-checkbox-inner"></span>
												</span>
                                            <span>{{item.value}}</span>
                                        </label>
                                        <span v-for="(item,index) in grading_user" :key="index" class="editQuote__quoteTab___diUta">
                                            <span class="self-name">{{item.value}}</span>
                                            <span class="editQuote__removeBtn___1q-Ac"  v-on:click="delgrading_user(index)">
                                                <i aria-label="图标: close-circle" class="anticon anticon-close-circle editQuote__icon___2Q2RR">
                                                    <img src="/lushu/static/svg/icon-30.svg" style="width: 0.8rem; height: 0.8rem;">
                                                </i>
                                            </span>
                                        </span>
                                        <div v-if="addUserTypeStatus== false" class="editQuote__addTab___2OvBx btn">
                                            <button  type="button" v-on:click="opneUserType()" class="ant-btn editQuote__customClass___1VzML ant-btn-plain">
                                                <i aria-label="图标: plus-circle" class="anticon anticon-plus-circle">
                                                    <img src="/lushu/static/svg/icon-65.svg" style="width: 1rem; height: 1rem;">
                                                </i>
                                                <span>自定义分级</span>
                                            </button>
                                        </div>
                                        <div v-else class="editQuote__addTab___2OvBx">
                                            <input type="text" v-model="grading_data" placeholder="自定义分级">
                                            <button type="button" v-on:click="opneUserType" class="ant-btn">
                                                <span>取消</span>
                                            </button>
                                            <button type="button" v-on:click="addUserType" class="ant-btn editQuote__button___2sa_d ant-btn-primary">
                                                <span>确认</span>
                                            </button>
                                        </div>
                                    </div>

                                </div>
                                <div class="editQuote__commentRow___MLI6l">选择价格日历或游客分类后，「费用说明」项目中将不再展示分项报价。</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>

</html>