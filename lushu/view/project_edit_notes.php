<!-- 导入顶部数据  -->
<?php include(dirname(__FILE__,2) . '/layout/header.php');?>
<?php  $day =   req('day'); ?>
<style>
    #div2 {
        margin-top: 100px
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
    .hidden{
        display: none;
    }
    .eat{
        width: 120px;
        margin-top: 5px;
        height: 30px;
        line-height: 30px;
    }
    .trafficlist:hover  .list-box{
        display: block!important;
    }
    .plannerMain__cell___2Vav9{
        width: ;
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
								<a class="globalLink undefined-link" href="project.html">我参与的出行项目</a>
							</span>
							<span class="ant-breadcrumb-separator">&gt;</span>
						</span>
                        <span>
							<span class="ant-breadcrumb-link">
								<a target="_blank" class="globalLink undefined-link" href="staging_project.html?key_id=<?=$key_id?>">{{project_data.title}}</a>
							</span>
							<span class="ant-breadcrumb-separator">&gt;</span>
						</span>
                        <span>
							<span class="ant-breadcrumb-link">行程编辑</span>
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
                            <button type="button" class="ant-btn ant-btn-plain" @click="setProject">
                                <i aria-label="图标: setting" class="anticon anticon-setting">
                                    <img src="/lushu/static/svg/icon-44.svg" style="width: 1rem;height: 1rem">
                                </i>
                                <span>路书信息设置</span>
                            </button>
                            <div>
                                <button type="button" class="ant-btn ant-dropdown-trigger ant-btn-plain expBtn">
                                    <i aria-label="图标: swap" class="anticon anticon-swap">
                                        <img src="/lushu/static/svg/icon-45.svg" style="width: 1rem;height: 1rem">
                                    </i>
                                    <span>导入导出</span>

                                    <div class="exp">
                                        <div @click="impClick">导入行程路线</div>
                                        <div @click="expClick">导出到素材库</div>
                                    </div>
                                </button>
                            </div>
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
                        <?php include(dirname(__FILE__,2) . '/layout/project_edit_scheduling.php');?>

                        <!-- 今日介绍 -->
                        <?php
                        $style  =   true;
                        include(dirname(__FILE__,2) . '/layout/project_edit_introduction.php');?>
                        <!-- 定制师笔记 -->
                        <?php
                        $styles =   true;
                        include(dirname(__FILE__,2) . '/layout/project_edit_note_list.php');?>

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


    <!-- 添加笔记 -->
    <?php include(dirname(__FILE__,2) . '/layout/project_edit_note.php');?>


    <!-- 设置 -->
    <div v-if="setShow"style="position: absolute">
        <?php include(dirname(__FILE__,2) . '/layout/project_set.php');?>
    </div>
    <!-- 导入 -->
    <div id="importShow" id="importShow" style="position: absolute;display: none;">
        <?php include(dirname(__FILE__,2) . '/layout/project_import.php');?>
    </div>
    <!-- 导出 -->
    <div id="exportShow" id="exportShow" style="position: absolute;display: none;">
        <?php include(dirname(__FILE__,2) . '/layout/project_export.php');?>
    </div>
    <?php include(dirname(__FILE__,2) . '/details/note.php');//笔记详情?>

</body>


</body>

</html>