<div class="mainRow basicLayout__mainRow___JOrD9">
    <div>
        <a class="globalLink basicLayout__pageTitle___3IeEK" href="./project.html">工作台</a>
    </div>
    <div class="basicLayout__center___RAJSN
                    basicLayout__subHeader___1ArlM">
        <div class="workbenchBase__subTitle___2p7OJ">
            <div class="workbenchBase__breadcrumb___3J43B
                        ant-breadcrumb ant-breadcrumb-undefined">
				<span>
					<span class="ant-breadcrumb-link">
						<a class="globalLink undefined-link" href="./project.html">
							<span class="workbenchBase__subTitle___2p7OJ">
								<span class="workbenchBase__name___1tmwz">我</span>参与的出行项目
							</span>
						</a>
					</span>
					<span class="ant-breadcrumb-separator">
						<i aria-label="图标: right" class="anticon anticon-right">
							<img src="/lushu/static/svg/icon-10-2.svg" style="width: 1rem;height: 1rem">
						</i>
					</span>
				</span>
                <span>
					<span class="ant-breadcrumb-link">{{project_data.title}}</span>
					<span class="ant-breadcrumb-separator">
						<i aria-label="图标: right" class="anticon anticon-right">
							<img src="/lushu/static/svg/icon-10-2.svg" style="width: 1rem;height: 1rem">
						</i>
					</span>
				</span>
            </div>
            <span class="workbenchBase__status___tp84T workbenchBase__statusDeveloping___3szdu" v-if="project_data.is_sale == 0">制作中</span>
            <span class="workbenchBase__status___tp84T workbenchBase__statusDeveloping___3szdu" style="    background: #00b1b3;" v-if="project_data.is_sale == 1">已完成</span>
            <span class="workbenchBase__status___tp84T workbenchBase__statusDeveloping___3szdu" style="    background: #bfc3c6;" v-if="project_data.is_sale == 2">已关闭</span>
        </div>
    </div>
    <div>
        <div>
<!--			<span style="display:inline-block;cursor:not-allowed">-->
<!--				<button disabled style="pointer-events:none" type="button" class="ant-btn ant-btn-plain">-->
<!--					<i aria-label="图标: bell" class="anticon anticon-bell">-->
<!--						<img src="/lushu/static/svg/icon-40.svg" style="width: 1rem;height: 1rem">-->
<!--					</i>-->
<!--					<span>添加提醒</span>-->
<!--				</button>-->
<!--			</span>-->
            <div class="ant-divider ant-divider-vertical"></div>
            <span>
				<button onclick="GetSteUp()" type="button" class="ant-btn ant-btn-plain">
					<i aria-label="图标: control" class="anticon anticon-control">
						<img src="/lushu/static/svg/icon-41.svg" style="width: 0.8rem;height: 0.8rem">
					</i>
					<span>项目设置</span>
				</button>
                <script>
                    var Ste_up  =   true;
                    function GetSteUp(){
                        if(Ste_up == true){
                            $('#setUp').show();
                            Ste_up  =   false;
                        }else {
                            $('#setUp').hide();
                            Ste_up  =   true;

                        }
                    }

                </script>
			</span>
        </div>
    </div>
</div>
<div class="clear">
    <div class="workbenchBase__subRow___2tLWr">
        <div class="workbenchBase__left___1BwwV">
            <div class="workbenchBase__overview___31QpK" onclick="location.href='./staging_project.html?key_id=<?=$key_id?>'">
				<span class="workbenchBase__tab___h81TO <? if($cmd == 'staging_project'){?> workbenchBase__active___2iCKn <? }?> ">概览</span>
                <i aria-label="图标: double-right" class="anticon anticon-double-right workbenchBase__icon___1Rpyi">
                    <img src="/lushu/static/svg/icon-42.svg" style="width: 0.8rem;height: 0.8rem">
                </i>
                <div class="workbenchBase__verticalLine___1gQXg ant-divider ant-divider-vertical"></div>
            </div>
            <div class="clear tabsNav__tabNav___1-jmV
                        workbenchBase__tabGroup___n9yG5">
                <div class="tabsNav__tabsGroup___3G2wf">
                    <span class="tabsNav__tab___cgToo <? if($cmd == 'project_demand'){?> tabsNav__active___3OOMW <? }?>" onclick="location.href='./project_demand.html?key_id=<?=$key_id?>'">项目需求</span>
                    <span class="tabsNav__tab___cgToo <? if($cmd == 'project_trip'){?> tabsNav__active___3OOMW <? }?>" onclick="location.href='./project_trip.html?key_id=<?=$key_id?>'">行程制作</span>
                    <span class="tabsNav__tab___cgToo <? if($cmd == 'project_cost'){?> tabsNav__active___3OOMW <? }?>" onclick="location.href='./project_cost.html?key_id=<?=$key_id?>'">费用核算</span>
                    <span class="tabsNav__tab___cgToo <? if($cmd == 'project_quotation'){?> tabsNav__active___3OOMW <? }?>" onclick="location.href='./project_quotation.html?key_id=<?=$key_id?>'">行程报价</span>

                </div>
            </div>
        </div>
        <div class="workbenchBase__right___13GwE">
            <button type="button" onclick="$('#release').show()" class="ant-btn workbenchBase__publishButton___dx1v2
                        ant-btn-primary">
                <span>发布路书</span>
            </button>
        </div>
    </div>
</div>



<div id="setUp" style="display:none;">
    <div class="ant-popover workbenchBase__settingPopover___2tJ3s ant-popover-placement-bottomRight" style="left: auto;right: 40px;transform-origin: 432px 0px;">
        <div class="ant-popover-content">
            <div class="ant-popover-arrow"></div>
            <div class="ant-popover-inner" role="tooltip">
                <div>
                    <div class="ant-popover-inner-content">
                        <div class="workbenchBase__settingContainer___1Pfj4">
                            <form class="ant-form ant-form-horizontal">
                                <div class="workbenchBase__titleContainer___2xwtv">
                                    <div id="antd-pro-ellipsis-171211125361237" class="index__ellipsis___29TdG workbenchBase__title___3FOm7 index__lineClamp___3S2HX">
                                        <style>#antd-pro-ellipsis-171211125361237{-webkit-line-clamp:1;-webkit-box-orient: vertical;}</style>
                                        {{project_data.title}}
                                    </div>
                                </div>
                                <div  class="workbenchBase__projectStatusContainer___14VAC">
                                    <div class="workbenchBase__operateContainer___32EtD">
                                        <div v-if="project_data.is_sale == 0" v-on:click="Complete_project" class="workbenchBase__operateItem___1sGrI">
                                            <i aria-label="图标: carry-out" class="anticon anticon-carry-out workbenchBase__icon___1Rpyi">
                                                <img src="/lushu/static/svg/icon-137.svg" style="width: 2rem;height: 2rem">
                                            </i>
                                            <span>完成项目</span>
                                        </div>
                                        <div v-if="project_data.is_sale == 0"  v-on:click="Close_project" class="workbenchBase__operateItem___1sGrI">
                                            <i aria-label="图标: close-circle" class="anticon anticon-close-circle workbenchBase__icon___1Rpyi">
                                                <img src="/lushu/static/svg/icon-138.svg" style="width: 2rem;height: 2rem">
                                            </i>
                                            <span>关闭项目</span>
                                        </div>
                                        <div v-if="project_data.is_sale != 0" v-on:click="Restore_project" class="workbenchBase__operateItem___1sGrI">
                                            <i aria-label="图标: redo" class="anticon anticon-redo workbenchBase__icon___1Rpyi">
                                                <img src="/lushu/static/svg/icon-136.svg" style="width: 2rem;height: 2rem">
                                            </i>
                                            <span>恢复制作</span>
                                        </div>
                                        <div class="workbenchBase__operateItem___1sGrI" v-on:click="Del_project">
                                            <i aria-label="图标: delete" class="anticon anticon-delete workbenchBase__icon___1Rpyi">
                                                <img src="/lushu/static/svg/icon-108.svg" style="width: 2rem;height: 2rem">
                                            </i>
                                            <span>删除项目</span>
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



<!--    完成项目-->
<?php include(dirname(__FILE__,2) . '/layout/Complete_project.php');?>
<!--    关闭项目-->
<?php include(dirname(__FILE__,2) . '/layout/Close_project.php');?>
<!--    删除项目-->
<?php include(dirname(__FILE__,2) . '/layout/Del_project.php');?>
<!--    恢复制作-->
<?php include(dirname(__FILE__,2) . '/layout/project_restore.php');?>
