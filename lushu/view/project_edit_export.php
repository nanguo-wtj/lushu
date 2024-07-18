<!-- 导入顶部数据  -->
<?php include(dirname(__FILE__,2) . '/layout/header.php');?>
<style>
    #wangeditor_column {
        border-bottom: 1px solid #b1b1b1;
        /*margin-top: 10px;*/
    }

    #w-e-textarea-1 {
        min-height: 500px;
    }

    #w-e-textarea-2 {
        min-height: 500px;
        margin-top: 40px;
    }

    #div4 .w-e-text-placeholder {
        margin-top: 20px;
    }
    .exp{
        display: none;
        position: absolute;
        top: 40px;
        left: 32px;
        z-index: 999;
        background: #fff;
        color: #333;
        padding: 5px 5px;
        line-height: 30px;
        border-radius: 5px;
    }
    .exp>div{
        padding: 1px 5px;
    }
    .exp>div:hover{
        background: #f5f5f5;
    }
    .expBtn:hover .exp {
        display: block;
    }
    .tag_box{
        display: none;
    }
    .importTripTemplate__tagCell___Fp0X3:hover .tag_box{
        display: block;
    }
</style>
<body class="appName-library">
<div id="webMain" ref="pageTop">
    <div>
        <div class="">
            <div id="pageTrip" class="plannerMain__main___1CkOO">
                <div class="plannerTopBar__plannerTopBar___1KWAX">
                    <div class="plannerTopBar__breadcrumb___24jl9 ant-breadcrumb
                ant-breadcrumb-dark">
						<span>
							<span class="ant-breadcrumb-link">
								<a class="globalLink undefined-link" href="./resources.html">行程路线库</a>
							</span>
							<span class="ant-breadcrumb-separator">&gt;</span>
						</span>

                    </div>
                    <span class="plannerTopBar__autosaveIndicator___1irX5">
						<i aria-label="图标: check-circle" class="anticon anticon-check-circle">
							<img src="/lushu/static/svg/icon-43.svg" style="width: 1rem;height: 1rem">
						</i>
						<span>Auto Saved</span>
					</span>
                    <div class="plannerTopBar__rightActions___8GNrJ">
                        <div class="plannerTopBar__rightBtns___1WwbV">
                            <div>
                                <button type="button" class="ant-btn ant-dropdown-trigger ant-btn-plain expBtn">
                                    <i aria-label="图标: swap" class="anticon anticon-swap">
                                        <img src="/lushu/static/svg/icon-45.svg" style="width: 1rem;height: 1rem">
                                    </i>
                                    <span>核价报价</span>
                                    <div class="exp">
                                        <div @click="location.href='project_cost_edit_export.html?key_id=<?=$key_id?>';">费用核算</div>
                                        <div @click="location.href='project_quotation_edit_export.html?key_id=<?=$key_id?>';">行程报价</div>
                                    </div>
                                </button>
                            </div>
                            <button type="button" class="ant-btn ant-btn-plain" @click="setProject">
                                <i aria-label="图标: setting" class="anticon anticon-setting">
                                    <img src="/lushu/static/svg/icon-44.svg" style="width: 1rem;height: 1rem">
                                </i>
                                <span>路书信息设置</span>
                            </button>

                            <button onclick="Jump_url('/lushu/');" type="button" class="ant-btn ant-btn-primary">
                                <span>返回</span>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- <div class="plannerMain__pageBody___336Xk hide-map" style="display: none;"> -->
                <div class="plannerMain__pageBody___336Xk hide-map">
                    <div>
                        <!-- 行程安排 -->
                        <?php include(dirname(__FILE__,2) . '/layout/project_edit_scheduling_export.php');?>
                        <!-- 行程亮点 -->
                        <?php include(dirname(__FILE__,2) . '/layout/project_edit_Highlights_list.php');?>

                        <!-- 定制师笔记 -->
                        <?php include(dirname(__FILE__,2) . '/layout/project_edit_note_list.php');?>
                        <!-- 行程介绍 -->
                        <?php include(dirname(__FILE__,2) . '/layout/project_edit_Itinerary_list.php');?>


                    </div>
                </div>
                <!-- 行程城市编辑 -->
                <?php include(dirname(__FILE__,2) . '/layout/project_edit_city.php');?>

                <div class="projectModuleAlert"></div>
            </div>
            <div class="authWatcher accessoryWrapper "></div>
            <div class="tosAlerts accessoryWrapper tosProjectCssMarker"></div>
            <div class="projectModuleEditing accessoryWrapper "></div>
            <div class="tripErrors accessoryWrapper"></div>
        </div>
    </div>
    <!-- 行程介绍 -->
    <?php include(dirname(__FILE__,2) . '/layout/project_edit_Itinerary.php');?>

    <!-- 各种详情 -->
    <?php include(dirname(__FILE__,2) . '/layout/project_edit_details.php');?>

    <!-- 添加笔记 -->
    <?php include(dirname(__FILE__,2) . '/layout/project_edit_note.php');?>


    <!-- 行程亮点 -->
    <?php include(dirname(__FILE__,2) . '/layout/project_edit_Highlights.php');?>

    <!-- 新增编辑行程亮点 -->
<!--    --><?php //include(dirname(__FILE__,2) . '/layout/project_edit_Highlightsedit.php');?>

    <!-- 新建笔记 -->
<!--    --><?php //include(dirname(__FILE__,2) . '/layout/project_edit_noteedit.php');?>

    <!-- 地图 -->
    <?php include(dirname(__FILE__,2) . '/layout/map.php');?>
    
     <!-- 设置 -->
     <div v-if="setShow"style="position: absolute">
        <?php include(dirname(__FILE__,2) . '/layout/project_set.php');?>
    </div>

</body>






</body>

</html>