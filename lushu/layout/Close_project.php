<div id="Close_project" style="display:none;position: absolute">
    <div class="ant-modal-mask"></div>
    <div tabindex="-1" class="ant-modal-wrap " role="dialog">
        <div role="document" class="ant-modal ant-modal-confirm ant-modal-confirm-confirm" style="width: 416px; transform-origin: 528px 451px;">
            <div tabindex="0" style="width: 0px; height: 0px; overflow: hidden;">sentinelStart</div>
            <div class="ant-modal-content">

                <div class="ant-modal-body">
                    <div class="ant-modal-confirm-body-wrapper">
                        <div class="ant-modal-confirm-body">

                            <span class="ant-modal-confirm-title">提示</span>
                            <div class="ant-modal-confirm-content">若关闭，则该行程的下业务将不能进行编辑，是否确认？</div>
                        </div>
                        <div class="ant-modal-confirm-btns">
                            <button type="button" class="ant-btn" onclick="$('#Close_project').hide()">
                                <span>取 消</span>
                            </button>
                            <button type="button" v-on:click="Close_project_Post" class="ant-btn ant-btn-primary">
                                <span>确 认</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>