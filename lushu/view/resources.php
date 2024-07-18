<!-- 导入顶部数据  -->
<?php include(dirname(__FILE__,2) . '/layout/header.php');?>
<style>
    /* reset */
    html,body,h1,h2,h3,h4,h5,h6,div,dl,dt,dd,ul,ol,li,p,blockquote,pre,hr,figure,table,caption,th,td,form,fieldset,legend,input,button,textarea,menu{margin:0;padding:0;}
    ul,li{list-style-type: none}
    h1{font-size: 26px;}
    p{font-size: 14px; margin-top: 10px;}
    pre{background:#eee;border:1px solid #ddd;border-left:4px solid #f60;padding:15px;margin-top: 15px;}
    h2{font-size: 20px;margin-top: 20px;}
    .case{margin-top: 15px;}
    #callback{float: left;margin-left: 12px;height:33px;line-height: 33px;border:1px solid #d7d7d7;padding:0 10px;}
    .inputDuration__popover___2DN4h {
        padding: 0px 16px 12px;
    }
</style>
<body class="appName-library">

<div id="webMain" ref="pageTop">
    <div>
        <div class="">
            <div id="pageWrap" class="basicLayout__basicLayout___3_npk">
                <div class="transitIndicator__transitIndicator___3m8Gd">
                    <div class="transitIndicator__transitBar___2q3uc"></div>
                </div>

                <!-- 导入导航栏目  -->
                <?php include(dirname(__FILE__,2) . '/layout/menu.php');?>


                <div class="basicLayout__layoutMain___1NUHo">

                    <div class="pageTopBar basicLayout__pageTopBar___3r1fF">
                        <!-- 导入顶部栏目  -->
                        <?php include(dirname(__FILE__,2) . '/layout/top.php');?>
                        <?php include(dirname(__FILE__,2) . '/layout/resources_top.php');?>


                    </div>
                    <div class="basicLayout__pageContainer___2LQ1G">
                        <div>
                            <?php include(dirname(__FILE__,2) . '/search/resources.php');?>
                            <div>
                                <div class="pagePanel pagePanel__pagePanel___3fszW templateList__fitHeight___2AYOX">
                                    <div class="ant-table-wrapper ant-table-dark ant-table-inpanel ant-table-cursor templateList__table___Mm8Yw">
                                        <div class="ant-spin-nested-loading">
                                            <div class="ant-spin-container">
                                                <div class="ant-table ant-table-default ant-table-scroll-position-left">
                                                    <div class="ant-table-content">
                                                        <div class="ant-table-body">
                                                            <table class="">
                                                                <colgroup>
                                                                    <col>
                                                                    <col style="width:268px;min-width:268px">
                                                                    <col style="width:148px;min-width:148px">
                                                                    <col style="width:180px;min-width:180px">
                                                                    <col style="width:148px;min-width:148px">
                                                                </colgroup>
                                                                <thead class="ant-table-thead">
                                                                <tr>
                                                                    <th class="ant-table-align-left" style="text-align:left">
                                                                        <div>
                                                                            名称
                                                                        </div>
                                                                    </th>
                                                                    <th class="ant-table-align-center" style="text-align:center">
                                                                        <div>
                                                                            相关城市
                                                                        </div>
                                                                    </th>
                                                                    <th class="ant-table-column-has-actions ant-table-column-has-sorters ant-table-align-center" style="text-align:center">
                                                                        <div class="ant-table-column-sorters">
                                                                            出行天数
                                                                            <div title="排序" class="ant-table-column-sorter">
                                                                                <i aria-label="图标: caret-up" class="anticon anticon-caret-up ant-table-column-sorter-up off">
                                                                                    <img src="/lushu/static/svg/icon-127.svg" style="width: 0.8rem; height: 0.8rem;">
                                                                                </i>
                                                                                <i aria-label="图标: caret-down" class="anticon anticon-caret-down ant-table-column-sorter-down off">
                                                                                    <img src="/lushu/static/svg/icon-128.svg" style="width: 0.8rem; height: 0.8rem;">
                                                                                </i>
                                                                            </div>
                                                                        </div>
                                                                    </th>
                                                                    <th class="ant-table-align-center" style="text-align:center">
                                                                        <div>
                                                                            标签
                                                                        </div>
                                                                    </th>
                                                                    <th class="ant-table-align-center" style="text-align:center">
                                                                        <div>
                                                                            最后更新
                                                                        </div>
                                                                    </th>
                                                                </tr>
                                                                </thead>
                                                                <tbody class="ant-table-tbody">
                                                                <tr v-for="(item,index) in routeList" v-on:click="project_detail(item)" class="ant-table-row ant-table-row-level-0" data-row-key="jgMBJYwN">
                                                                    <td class="" style="text-align:left">
                                                                        <span style="padding-left:0px" class="ant-table-row-indent indent-level-0"></span>
                                                                        <div class="imageText__imageTextContainer___3YHZ8">
                                                                            <div class="imageText__image___2SuEP">
                                                                                <span v-if="!item.url" class="imageText__roundCorner___bSW_R widgets__lushuBackgroundImage___3XMmZ widgets__noImg___CsB0Z">
                                                                                    <div class="widgets__noImgCont___blaq6">
                                                                                        <i aria-label="图标: picture" style="font-size:26px" class="anticon anticon-picture">
                                                                                            <img src="/lushu/static/svg/icon-104.svg" style="width: 2rem; height: 2rem;">
                                                                                        </i>
                                                                                    </div>
                                                                                </span>
                                                                                <span v-if="item.url" class="imageText__roundCorner___bSW_R widgets__lushuBackgroundImage___3XMmZ widgets__noImg___CsB0Z">
                                                                                    <img :src="item.url" style="width: 100%;height: 100%">
                                                                            </span>
                                                                            </div>
                                                                            <div class="imageText__textContent___28V1T">
                                                                                <div class="imageText__name_cn___5kdN2">
                                                                                    {{item.title}}
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td class="" style="text-align:center">{{item.city}}</td>
                                                                    <td class="ant-table-column-has-actions ant-table-column-has-sorters" style="text-align:center">
                                                                        <div>
                                                                            {{item.setout.duration}}
                                                                        </div>
                                                                    </td>
                                                                    <td class="" style="text-align:center">- -</td>
                                                                    <td class="" style="text-align:center">
                                                                        <div>
                                                                            <!-- <p>- -</p> -->
                                                                            <p>{{item.time}}</p>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="widgets__empty___8_50e widgets__large___1ny40" v-if="routeList.length < 1">
                                                    <div class="widgets__header___3RBY_">
                                                        暂无数据
                                                    </div>
                                                    <div class="widgets__description___3PlNA"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php include(dirname(__FILE__,2) . '/layout/page_list.php');?>

                    </div>
                </div>
            </div>
            <div class="authWatcher accessoryWrapper "></div>
            <div class="tosAlerts accessoryWrapper tosProjectCssMarker"></div>
        </div>
    </div>
    <!-- 通知 -->
    <div class="notice" style="display: none;">

    </div>
    <!-- 标签 -->
    <div class="label" style="position: absolute; top: 0px; left: 0px; width: 100%;display: none;">
        <div onclick="$('.label').css('display', 'none')">
            <div class="ant-dropdown ant-dropdown-placement-bottomCenter" style="left: 745px; top: 160px;">
                <ul class="ant-dropdown-menu tagFilter__menu___1foH8 ant-dropdown-menu-light ant-dropdown-menu-root ant-dropdown-menu-vertical" onclick="(function (event) {
              event = event || window.event;
              console.log(event);
              event.stopPropagation()})()" role="menu">
                    <div class="tagFilter__searchTagBar___2bJnB">
							<span class="ant-input-affix-wrapper">
								<span class="ant-input-prefix">
									<i aria-label="图标: search" class="anticon anticon-search">
										<svg viewBox="64 64 896 896" class="" data-icon="search" width="1em" height="1em" fill="currentColor" aria-hidden="true" focusable="false">
											<path d="M908.83 852.5L807 750.64c58.67-69.56 94.19-159.24 94.19-257.14 0-220.39-179.27-399.67-399.64-399.67S101.86 273.11 101.86 493.5s179.28 399.61 399.66 399.61c89.7 0 172.3-30.06 239.06-80.14l103.86 103.86a45.51 45.51 0 0 0 64.39-64.33zm-716-359c0-170.17 138.47-308.67 308.66-308.67s308.67 138.5 308.67 308.67-138.47 308.61-308.64 308.61S192.86 663.67 192.86 493.5z">
											</path>
										</svg>
									</i>
								</span>
								<input placeholder="搜索标签名称" type="text" oninput="" class="ant-input" value="">
							</span>
                    </div>
                    <div class="tagFilter__tagContainer___3TpEe">
                        <!-- (event) =>{
  event = event || window.event;
  console.log(event);
  event.stopPropagation()} -->
                        <div class="ant-tag ant-tag-checkable tagFilter__tag___2gbqb">全部</div>
                        <div class="ant-tag ant-tag-checkable tagFilter__tag___2gbqb">官对</div>
                        <div class="ant-tag ant-tag-checkable tagFilter__tag___2gbqb">官方的</div>
                        <div class="ant-tag ant-tag-checkable tagFilter__tag___2gbqb">2</div>
                        <div class="ant-tag ant-tag-checkable tagFilter__tag___2gbqb">22</div>
                        <div class="ant-tag ant-tag-checkable tagFilter__tag___2gbqb">222</div>
                        <div class="ant-tag ant-tag-checkable tagFilter__tag___2gbqb">111</div>
                        <div class="ant-tag ant-tag-checkable tagFilter__tag___2gbqb">11</div>
                        <div class="ant-tag ant-tag-checkable tagFilter__tag___2gbqb">1</div>
                        <div class="ant-tag ant-tag-checkable tagFilter__tag___2gbqb">123</div>
                    </div>
                </ul>
            </div>
        </div>
    </div>
    <!-- 出行天数 -->
    <div style="position: absolute; top: 0px; left: 0px; width: 100%;display: none;" class="outDays">
        <div onclick="$('.outDays').css('display', 'none')">
            <div class="ant-popover ant-popover-placement-bottomLeft" onclick="(function (event) {
          event = event || window.event;
          console.log(event);
          event.stopPropagation()})()" style="left: 576px; top: 160px; transform-origin: 0px 0px;">
                <div class="ant-popover-content">
                    <div class="ant-popover-arrow"></div>
                    <div class="ant-popover-inner" role="tooltip">
                        <div>
                            <div class="ant-popover-inner-content">
                                <div class="inputDuration__popover___2DN4h">
                                    <div class="ant-slider ant-slider-with-marks">
                                    </div>
                                    <div class="inputDuration__footer___Dujnt">
                                        <button type="button" onclick="$('.outDays').css('display', 'none')" class="ant-btn inputDuration__button___3KFJ_">
                                            <span>取 消</span>
                                        </button>
                                        <button type="button" onclick="$('.outDays').css('display', 'none')" class="ant-btn ant-btn-primary">
                                            <span>确 认</span>
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
<!--    //提醒通知-->
    <?php include(dirname(__FILE__,2) . '/layout/notice.php');?>

</div>

<script>





    function inputArea(node) {
        const val = $(node).val()
        const params = {
            buckets: [
                {
                    own: false
                },
                {
                    own: true
                }
            ],
            q: val,
            type: 2,
            hits: 100
        }

    }

</script>


<script type="text/javascript">
    var clsss_id = '1'
    var days1,days2
    function showSider() {
        $(".ant-slider").sider({
            min: 0, //最小值
            max: 60, //最大值
            step: 1, //拖动步长
            quick:[],
            value: 30, //默认值
            callback: function (_this, value, status, count) {
                //回调函数， 反回3个参数，
                //_this : 当前元素
                //value : 选取的值
                //status : 是否选择完毕
                // count: 1 2 拖动的按钮
                console.log(value, count)
                if (count == 1) {
                    if (value != 0) {
                        days1 = value ||  days1
                    } else days1 = 0

                } else {
                    if (value != 0) {
                        days2 = value || days2
                    } else days2 = 0
                }
                if (!(!days1 & !days2)) {
                    days1 = days1 || 0
                    days2 = days2 || 0
                    if (days2 >= days1) {
                        $('.days').val(`${days1}~${days2}`)
                    } else {
                        $('.days').val(`${days2}~${days1}`)
                    }
                }
            }
        });
    }


</script>
</body>
<script>



</script>
</html>