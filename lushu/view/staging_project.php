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
                        <?php include(dirname(__FILE__,2) . '/layout/project_top.php');?>
                    </div>
                    <div class="basicLayout__pageContainer___2LQ1G">
                        <div class="projectOverview__pageContainer___rSdjV">
                            <div class="projectOverview__headerContainer___EMM1d">
                                <div class="projectOverview__title___3J0PC">
                                    {{project_data.title}}
                                </div>
                                <div class="projectOverview__adminContainer___3g0nG">
										<span class="projectOverview__title___3J0PC">项目管理者
                                            <!-- -->：
										</span>
                                    <span>
											<span class="an-avatar projectOverview__avatar___26irj avatar__avatar___4NUXc">
												<span class="avatar__avatarInner___1y0H-">
													<span style="background-color:#599DFA" class="ant-avatar ant-avatar-circle">
														<span class="ant-avatar-string">{{project_data.user}}</span>
													</span>
												</span>
											</span>
										</span>
                                </div>
                            </div>
                            <div class="pagePanel__pagePanelContainer___3FpIY">
                                <div class="pagePanel pagePanel__pagePanel___3fszW projectOverview__leftContainer___34_bg pagePanel__auto___1xn2A">
                                    <div class="projectOverview__overviewContainer___26nkC">
                                        <div class="projectOverview__titleOverview___3mdYk">
                                            业务概览
                                        </div>
                                        <div>
                                            <div>
                                                <div class="tripInfoView__tripInfo___1AFfG">
                                                    <div class="tripInfoView__top___Rl7dS">
                                                        <div id="antd-pro-ellipsis-168809711595172" class="index__ellipsis___29TdG index__lineClamp___3S2HX">
                                                            <style>
                                                                #antd-pro-ellipsis-168809711595172 {
                                                                    -webkit-line-clamp: 1;
                                                                    -webkit-box-orient: vertical;
                                                                }
                                                            </style>
                                                            <i aria-label="图标: calendar" class="anticon anticon-calendar tripInfoView__icon___13HLt">
                                                                <img src="/lushu/static/svg/icon-14.svg" style="width: 1rem;height: 1rem">
                                                            </i>
                                                            <span class="tripInfoView__depart___ozY0R">{{project_data.time}}</span>·
                                                            <span class="tripInfoView__departCity___22uGG">{{project_data.departure}}出发</span>·
                                                            <span class="tripInfoView__duration___1dq2x">共{{project_data.day}}天</span>
                                                        </div>
                                                    </div>
                                                    <div class="tripInfoView__bottom___1fr_-">
                                                        <div id="antd-pro-ellipsis-168809711595144" class="index__ellipsis___29TdG index__lineClamp___3S2HX">
                                                            <style>
                                                                #antd-pro-ellipsis-168809711595144 {
                                                                    -webkit-line-clamp: 1;
                                                                    -webkit-box-orient: vertical;
                                                                }
                                                            </style>
                                                            <i aria-label="图标: location-city" class="anticon anticon-location-city tripInfoView__icon___13HLt">
                                                                <img src="/lushu/static/svg/icon-5.svg" style="width: 1rem;height: 1rem">
                                                            </i>
                                                            {{project_data.city}}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="projectOverview__modulesContainer___3UXN2">
                                                    <div class="projectOverview__moduleViewLine___27Zk7">
                                                        <div class="projectOverview__moduleView___7rhKE">
                                                            <div class="projectOverview__topContainer___1_AOA">
                                                                <div class="projectOverview__title___3J0PC">
                                                                    项目需求
                                                                </div>
                                                                <span class="planStatus__container___3-d71">
																		<i aria-label="图标: consult-status-0" class="anticon anticon-consult-status-0 planStatus__statusOngoing___TLUgv">
																			<img src="/lushu/static/svg/icon-34.svg" style="width: 1rem;height: 1rem">
																		</i>
																		<span v-if="project_data.is_sale == 0" class="planStatus__status___2m1rw">正在进行</span>
																		<span v-else class="planStatus__status___2m1rw">已结束</span>
                                                                </span>
                                                            </div>
                                                            <div class="projectOverview__lastOperateContainer___zMsLH">
                                                                <div id="antd-pro-ellipsis-168809711595173" class="index__ellipsis___29TdG index__lineClamp___3S2HX">
                                                                    <style>
                                                                        #antd-pro-ellipsis-168809711595173 {
                                                                            -webkit-line-clamp: 1;
                                                                            -webkit-box-orient: vertical;
                                                                        }
                                                                    </style>
                                                                    <span>{{project_data.time}}</span>
                                                                    <span class="projectOverview__lastOperator___3e2Oh">{{project_data.user}}</span>更新
                                                                </div>
                                                            </div>
                                                            <div class="projectOverview__operatorsContainer___3tUOi">
																	<span class="an-avatar projectOverview__avatar___26irj avatar__avatar___4NUXc">
																		<span class="avatar__avatarInner___1y0H-">
																			<span style="background-color:#599DFA" class="ant-avatar ant-avatar-circle">
																				<span class="ant-avatar-string">{{project_data.user}}</span>
																			</span>
																		</span>
																	</span>
                                                            </div>
                                                        </div>
                                                        <div class="projectOverview__moduleView___7rhKE">
                                                            <div class="projectOverview__topContainer___1_AOA">
                                                                <div class="projectOverview__title___3J0PC">
                                                                    行程制作
                                                                </div>
                                                                <span class="planStatus__container___3-d71">
																		<i aria-label="图标: consult-status-0" class="anticon anticon-consult-status-0 planStatus__statusOngoing___TLUgv">
																			<img src="/lushu/static/svg/icon-34.svg" style="width: 1rem;height: 1rem">
																		</i>
																		<span v-if="project_data.is_sale == 0" class="planStatus__status___2m1rw">正在进行</span>
																		<span v-else class="planStatus__status___2m1rw">已结束</span>
																	</span>
                                                            </div>
                                                            <div class="projectOverview__lastOperateContainer___zMsLH">
                                                                <div id="antd-pro-ellipsis-168809711595214" class="index__ellipsis___29TdG index__lineClamp___3S2HX">
                                                                    <style>
                                                                        #antd-pro-ellipsis-168809711595214 {
                                                                            -webkit-line-clamp: 1;
                                                                            -webkit-box-orient: vertical;
                                                                        }
                                                                    </style>
                                                                    <span>{{project_data.time}}</span>
                                                                    <span class="projectOverview__lastOperator___3e2Oh">{{project_data.user}}</span>更新
                                                                </div>
                                                            </div>
                                                            <div class="projectOverview__operatorsContainer___3tUOi">
																	<span class="an-avatar projectOverview__avatar___26irj avatar__avatar___4NUXc">
																		<span class="avatar__avatarInner___1y0H-">
																			<span style="background-color:#599DFA" class="ant-avatar ant-avatar-circle">
																				<span class="ant-avatar-string">{{project_data.user}}</span>
																			</span>
																		</span>
																	</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="projectOverview__moduleViewLine___27Zk7">
                                                        <div class="projectOverview__moduleView___7rhKE">
                                                            <div class="projectOverview__topContainer___1_AOA">
                                                                <div class="projectOverview__title___3J0PC">
                                                                    费用核算
                                                                </div>
                                                                <span class="planStatus__container___3-d71">
																		<i aria-label="图标: consult-status-0" class="anticon anticon-consult-status-0 planStatus__statusOngoing___TLUgv">
																			<img src="/lushu/static/svg/icon-34.svg" style="width: 1rem;height: 1rem">
																		</i>
																		<span v-if="project_data.is_sale == 0" class="planStatus__status___2m1rw">正在进行</span>
																		<span v-else class="planStatus__status___2m1rw">已结束</span>
																	</span>
                                                            </div>
                                                            <div class="projectOverview__lastOperateContainer___zMsLH">
                                                                <div id="antd-pro-ellipsis-168809711595298" class="index__ellipsis___29TdG index__lineClamp___3S2HX">
                                                                    <style>
                                                                        #antd-pro-ellipsis-168809711595298 {
                                                                            -webkit-line-clamp: 1;
                                                                            -webkit-box-orient: vertical;
                                                                        }
                                                                    </style>
                                                                    <span>{{project_data.time}}</span>
                                                                    <span class="projectOverview__lastOperator___3e2Oh">{{project_data.user}}</span>更新
                                                                </div>
                                                            </div>
                                                            <div class="projectOverview__operatorsContainer___3tUOi">
																	<span class="an-avatar projectOverview__avatar___26irj avatar__avatar___4NUXc">
																		<span class="avatar__avatarInner___1y0H-">
																			<span style="background-color:#599DFA" class="ant-avatar ant-avatar-circle">
																				<span class="ant-avatar-string">{{project_data.user}}</span>
																			</span>
																		</span>
																	</span>
                                                            </div>
                                                        </div>
                                                        <div class="projectOverview__moduleView___7rhKE">
                                                            <div class="projectOverview__topContainer___1_AOA">
                                                                <div class="projectOverview__title___3J0PC">
                                                                    行程报价
                                                                </div>
                                                                <span class="planStatus__container___3-d71">
																		<i aria-label="图标: consult-status-0" class="anticon anticon-consult-status-0 planStatus__statusOngoing___TLUgv">
																			<img src="/lushu/static/svg/icon-34.svg" style="width: 1rem;height: 1rem">
																		</i>
																		<span v-if="project_data.is_sale == 0" class="planStatus__status___2m1rw">正在进行</span>
																		<span v-else class="planStatus__status___2m1rw">已结束</span>
																	</span>
                                                            </div>
                                                            <div class="projectOverview__lastOperateContainer___zMsLH">
                                                                <div id="antd-pro-ellipsis-168809711595321" class="index__ellipsis___29TdG index__lineClamp___3S2HX">
                                                                    <style>
                                                                        #antd-pro-ellipsis-168809711595321 {
                                                                            -webkit-line-clamp: 1;
                                                                            -webkit-box-orient: vertical;
                                                                        }
                                                                    </style>
                                                                    <span>{{project_data.time}}</span>
                                                                    <span class="projectOverview__lastOperator___3e2Oh">{{project_data.user}}</span>更新
                                                                </div>
                                                            </div>
                                                            <div class="projectOverview__operatorsContainer___3tUOi">
																	<span class="an-avatar projectOverview__avatar___26irj avatar__avatar___4NUXc">
																		<span class="avatar__avatarInner___1y0H-">
																			<span style="background-color:#599DFA" class="ant-avatar ant-avatar-circle">
																				<span class="ant-avatar-string">{{project_data.user}}</span>
																			</span>
																		</span>
																	</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="projectOverview__itineraryContainer___1q-bg">
                                                <div class="projectOverview__titleContainer___214RT">
                                                    <div class="projectOverview__title___3J0PC">
                                                        行程单
                                                    </div>
                                                    <div>
                                                        <span class="projectOverview__bookings___UcoA2">核价：--</span>
                                                        <span class="projectOverview__tripQuote___2O26h">报价：--</span>
                                                    </div>
                                                </div>
                                                <div class="ant-table-wrapper projectOverview__table___12pQT">
                                                    <div class="ant-spin-nested-loading">
                                                        <div class="ant-spin-container">
                                                            <div class="ant-table ant-table-default ant-table-bordered ant-table-scroll-position-left">
                                                                <div class="ant-table-content">
                                                                    <div class="ant-table-body">
                                                                        <table class="">
                                                                            <colgroup>
                                                                                <col style="width:25%;min-width:25%">
                                                                                <col style="width:25%;min-width:25%">
                                                                                <col style="width:25%;min-width:25%">
                                                                                <col style="width:25%;min-width:25%">
                                                                            </colgroup>
                                                                            <thead class="ant-table-thead">
                                                                            <tr>
                                                                                <th class="">
                                                                                    <span class="projectOverview__title___3J0PC">日期及城市</span>
                                                                                </th>
                                                                                <th class="">
                                                                                    <span class="projectOverview__title___3J0PC">日程安排</span>
                                                                                </th>
                                                                                <th class="">
                                                                                    <span class="projectOverview__title___3J0PC">酒店住宿</span>
                                                                                </th>
                                                                                <th class="">
                                                                                    <span class="projectOverview__title___3J0PC">交通方案</span>
                                                                                </th>
                                                                            </tr>
                                                                            </thead>
                                                                            <tbody class="ant-table-tbody">
                                                                                <tr  v-for="(item,index) in  project_data.day_list"  :key="index"   class="ant-table-row ant-table-row-level-0" data-row-key="LNd49e1N">
                                                                                    <td class="">
                                                                                        <span style="padding-left:0px" class="ant-table-row-indent indent-level-0"></span>
                                                                                        <div class="projectOverview__dateContainer___3XrKM">
                                                                                            <div class="projectOverview__index___YXJLx">
                                                                                                D{{item.day}}
                                                                                            </div>
                                                                                            <div class="projectOverview__data___PN8qF">
                                                                                                {{item.time}} ({{item.work}}）
                                                                                            </div>
                                                                                            <div class="projectOverview__cities___c-X3O">
                                                                                                <div v-for="(a,b) in item.city">
                                                                                                    <i v-if="index == 0 && b == 0" aria-label="图标: flag" class="anticon anticon-flag">
                                                                                                        <img src="/lushu/static/svg/icon-35.svg" style="width: 1rem;height: 1rem">
                                                                                                    </i>
                                                                                                    {{a.value}}
                                                                                                </div>

                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td class="">
                                                                                        <div class="projectOverview__agendaContainer___1nJLN">
                                                                                            <ul>
                                                                                                <li v-for="(a,b) in item.schedule">
                                                                                                    {{b+1}}<span >{{a.title}}</span>
                                                                                                </li>
                                                                                            </ul>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td class="">
                                                                                        <div class="projectOverview__agendaContainer___1nJLN">
                                                                                            <ul>
                                                                                                <li >
                                                                                                    <span>{{item.hotel}}</span>
                                                                                                </li>
                                                                                            </ul>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td class="">
                                                                                        <div class="projectOverview__agendaContainer___1nJLN">
                                                                                            <ul>
                                                                                                <li  v-for="(a,b) in item.traffic" class="projectOverview__longTransitContainer___2bz2g">
                                                                                                    <div>
                                                                                                        <i aria-label="图标: transit-method-1" class="anticon anticon-transit-method-1 projectOverview__methodIcon___1HBvD">
                                                                                                            <img src="/lushu/static/svg/icon-36.svg" style="width: 1rem;height: 1rem">
                                                                                                        </i>
                                                                                                        <span class="projectOverview__name___1qapB">{{a.Traffic_value}}</span>
                                                                                                    </div>
                                                                                                    <div>
                                                                                                        {{a.startingPoint.region_name}}
                                                                                                        <i aria-label="图标: swap-right" class="anticon anticon-swap-right">
                                                                                                            <img src="/lushu/static/svg/icon-37.svg" style="width: 1rem;height: 1rem">
                                                                                                        </i>
                                                                                                        {{a.destination.region_name}}
                                                                                                    </div>
<!--                                                                                                    <div class="projectOverview__time___1d6z5">-->
<!--                                                                                                        00:10 - 05:15-->
<!--                                                                                                    </div>-->
                                                                                                </li>

                                                                                            </ul>
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
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
                                <?php include(dirname(__FILE__,2) . '/layout/project_log.php');?>

                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
    <?php include(dirname(__FILE__,2) . '/layout/release.php');//发布路书详情?>

</div>



</body>

</html>