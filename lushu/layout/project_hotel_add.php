<div style="display: none;" id="hotel_add_poi" class="ant-drawer ant-drawer-right ant-drawer-open editAccomadation__editAccomadation___3BCbG">
    <div class="ant-drawer-mask"></div>
    <div class="ant-drawer-content-wrapper" style="width: 638px;">
        <div class="ant-drawer-content">
            <div class="ant-drawer-wrapper-body" style="overflow: auto; height: 100%;">
                <div class="ant-drawer-header">
                    <div class="ant-drawer-title">设置预订时间</div>
                    <div class="ant-drawer-right-actions">
                        <div class="ant-drawer-actions">
                            <button type="button" class="ant-btn ant-btn-primary" @click="saveLodging">
                                <span>保存</span>
                            </button>
                        </div>
                        <button @click="close_hotel" aria-label="Close" class="ant-drawer-close">
                            <i aria-label="图标: close" class="anticon anticon-close">
                                <img src="/lushu/static/svg/icon-11.svg" style="width: 1rem;height: 1rem">

                            </i>
                        </button>
                    </div>
                </div>
                <div class="ant-drawer-body">
                    <form class="ant-form ant-form-horizontal">
                        <div class="ant-row ant-form-item">
                            <div class="ant-col-3 ant-form-item-label">
                                <label for="checkIn" class="" title="入住">入住</label>
                            </div>
                            <div class="ant-col-21 ant-form-item-control-wrapper">
                                <el-select v-model="lodging.enter" placeholder="请选择">
                                    <el-option v-for="item in day_list" :key="item.day" :label="'D'+item.day" :value="item.day">
                                    </el-option>
                                </el-select>
                            </div>
                        </div>
                        <div class="ant-row ant-form-item">
                            <div class="ant-col-3 ant-form-item-label">
                                <label for="checkOut" class="" title="离店">离店</label>
                            </div>
                            <div class="ant-col-21 ant-form-item-control-wrapper">
                                <el-select v-model="lodging.outer" placeholder="请选择">
                                    <el-option v-for="item in day_list" :key="item.day" :label="'D'+item.day" :value="item.day">
                                    </el-option>
                                </el-select>
                            </div>
                        </div>
                    </form>
                    <div class="editAccomadation__accomadationMemo___31p5Q">
                        <button type="button" class="ant-btn editAccomadation__toggleMemoBtn___3gddi ant-btn-plain">
                            <i aria-label="图标: plus-circle" class="anticon anticon-plus-circle">
                                <img src="/lushu/static/svg/icon-49.svg" style="width: 1rem;height: 1rem">
                            </i>
                            <span>添加备注</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>