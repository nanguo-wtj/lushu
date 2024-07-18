
<div v-if="eatDlg" class="plannerMain__cell___2Vav9" style="left: 512px; width: 400px; z-index: 21;">
    <div class="plannerMain__plannerPanelWrap___3vIXb plannerMain__edit___N0q2x">
        <div class="plannerPanel__plannerPanel___3vpy8 meals__panel___21ir2">
            <div class="plannerPanel__header___3iE-t">
                <h2>用餐信息</h2>
                <div class="plannerPanel__headerActions___2-0JG">
                    <button type="button" class="ant-btn" @click="eatDlg = false;$('#day_poi').show();"><span>取消</span></button>
                    <button type="button" class="ant-btn ant-btn-primary" @click="chageEatInfo"><span>保存</span></button>
                </div>
            </div>
            <div class="plannerPanel__body___l2w7l">
                <div class="meals__panelInner___5kchN">
                    <form class="ant-form ant-form-horizontal">
                        <div class="ant-row ant-form-item">
                            <div class="ant-col-4 ant-form-item-label">
                                <label for="breakfast" class="ant-form-item-required" title="早餐">早餐</label>
                            </div>
                            <div class="ant-col-20 ant-form-item-control-wrapper">
                                <select class="eat" name="breakfast" id="breakfast"  v-model="eatingInfo.breakfast">
                                    <option value="">请选择</option>
                                    <option value="自理">自理</option>
                                    <option value="包含">包含</option>
                                </select>
                            </div>
                        </div>
                        <div class="ant-row ant-form-item">
                            <div class="ant-col-4 ant-form-item-label">
                                <label for="lunch" class="ant-form-item-required" title="午餐">午餐</label>
                            </div>
                            <div class="ant-col-20 ant-form-item-control-wrapper">
                               <select  class="eat" name="lunch" id="lunch"  v-model="eatingInfo.lunch">
                                   <option value="">请选择</option>
                                    <option value="自理">自理</option>
                                    <option value="包含">包含</option>
                                </select>
                            </div>
                        </div>
                        <div class="ant-row ant-form-item">
                            <div class="ant-col-4 ant-form-item-label">
                                <label for="dinner" class="ant-form-item-required" title="晚餐">晚餐</label>
                            </div>
                            <div class="ant-col-20 ant-form-item-control-wrapper">
                                <select class="eat" name="dinner" id="dinner" v-model="eatingInfo.dinner">
                                    <option value="">请选择</option>
                                    <option value="自理">自理</option>
                                    <option value="包含">包含</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>