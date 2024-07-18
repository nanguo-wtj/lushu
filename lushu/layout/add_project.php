<div class="reeatedAct" style="display: none;">
    <div class="ant-modal-mask"></div>
    <div tabindex="-1" class="ant-modal-wrap ant-modal-centered" role="dialog" aria-labelledby="rcDialogTitle7">
        <div role="document" class="ant-modal modalOrderPage" style="width:420px; transform-origin: 531.5px -29px;">
            <div tabindex="0" style="width: 0px; height: 0px; overflow:hidden;">sentinelStart</div>
            <div class="ant-modal-content" style="width:420px; ">
                <button aria-label="Close" class="ant-modal-close">
                    <span class="ant-modal-close-x">
                        <i aria-label="图标: close" class="anticon anticon-close ant-modal-close-icon" onclick="$('.reeatedAct').css('display','none')">
                           <img src="/lushu/static/svg/icon-11.svg" style="width: 1rem;height: 1rem">
                        </i>
                    </span>
                </button>
                <div class="ant-modal-header">
                    <div class="ant-modal-title" id="rcDialogTitle7">创建出行项目</div>
                </div>
                <div class="ant-modal-body">
                        <div class="ant-row ant-form-item">
                            <div class="ant-form-item-label">
                                <label for="title" class="" title="">
                                    <span  class="createProjectModal__tripTitle___3_s8W">项目标题：</span>
                                </label>
                            </div>
                            <div class="ant-form-item-control-wrapper">
                                <div class="ant-form-item-control has-success">
                                    <span class="ant-form-item-children">
                                        <input placeholder="请输入项目标题" maxlength="24" type="text" id="title"  v-model="project.name"  class="ant-input" value="">
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="ant-row ant-form-item createProjectModal__inquiryButton___2lx9S">
                                <div class="ant-form-item-control-wrapper">
                                    <div class="ant-form-item-control">
                                        <span class="ant-form-item-children">
                                            <span style="display: inline-block; cursor: not-allowed;
                              width: 100%;">
                                                <button disabled="" type="button" class="ant-btn ant-btn-primary ant-btn-lg ant-btn-block"  style="pointer-events: none;">
                                                    <span>记录项目需求</span>
                                                </button>
                                            </span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="ant-row ant-form-item">
                                <div class="ant-form-item-control-wrapper">
                                    <div class="ant-form-item-control">
                                        <span class="ant-form-item-children">
                                            <button type="button" v-on:click="Add_project(1)" class="ant-btn ant-btn-lg ant-btn-block">
                                                <span>规划行程路线</span>
                                            </button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="ant-row ant-form-item createProjectModal__bottomFormItem___3L9ar">
                            <div class="ant-form-item-control-wrapper">
                                <div class="ant-form-item-control">
                                    <span class="ant-form-item-children" >
<!--                                        <span onclick="$('.addAother').css('display','block')">-->
<!--                                            <i aria-label="图标: usergroup-add" class="anticon anticon-usergroup-add">-->
<!--                                               <img src="/lushu/static/svg/icon-13.svg" style="width: 1rem;height: 1rem">-->
<!--                                            </i>-->
<!--                                            <button type="button" class="ant-btn ant-btn-plain">-->
<!--                                                <span>添加协作者</span>-->
<!--                                            </button>-->
<!--                                        </span>-->
                                        <button type="button" v-on:click="Add_project(2)" class="ant-btn createProjectModal__skip___bNtue ant-btn-plain">
                                            <span>跳过</span>
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div>
                </div>
            </div>

        </div>
    </div>
</div>
