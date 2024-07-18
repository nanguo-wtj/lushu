<div id="Complete_project" style="display: none;position: absolute">
    <div class="ant-modal-mask"></div>
    <div tabindex="-1" class="ant-modal-wrap " role="dialog">
        <div role="document" class="ant-modal ant-modal-confirm ant-modal-confirm-confirm" style="width: 416px; transform-origin: 532px 402px;">
            <div tabindex="0" style="width: 0px; height: 0px; overflow: hidden;">sentinelStart</div>
            <div class="ant-modal-content">

                <div class="ant-modal-body">
                    <div class="ant-modal-confirm-body-wrapper">
                        <div class="ant-modal-confirm-body">

                            <span class="ant-modal-confirm-title">提示</span>
                            <div class="ant-modal-confirm-content">
                                <span>本行程中的<span class="projectLibrary__unfinishModules___1Rnkb">项目需求、行程制作、费用核算、行程报价</span>尚未完成，您是否确认忽略以上内容？</span>
                            </div>
                        </div>
                        <div class="ant-modal-confirm-btns">
                            <button type="button" class="ant-btn" onclick="$('#Complete_project').hide();">
                                <span>取 消</span>
                            </button>
                            <button type="button" class="ant-btn ant-btn-primary" v-on:click="CompleteProjectPost">
                                <span>确 认</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>