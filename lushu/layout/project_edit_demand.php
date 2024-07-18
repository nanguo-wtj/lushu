<div id="edit_demand_show" style="position: absolute; top:0;display: none;">
  <div class="ant-drawer ant-drawer-right ant-drawer-open importTripTemplate__importTemplateDrawer___1YKsX">
    <div class="ant-drawer-mask"></div>
    <div class="ant-drawer-content-wrapper" style="width: 960px;">
      <div class="ant-drawer-content">
        <div class="ant-drawer-wrapper-body" style="overflow: auto; height: 100%;">
          <div class="ant-drawer-header">
            <div class="ant-drawer-title">编辑</div>
            <div class="ant-drawer-right-actions">
              <div class="ant-drawer-actions">
                  <button type="button" class="ant-btn ant-btn-primary" @click="EditDemand"><span>保存</span></button>
              </div>
              <button aria-label="Close" class="ant-drawer-close" @click="close_EditDemand">
                  <i aria-label="图标: close" class="anticon anticon-close">
                      <img src="/lushu/static/svg/icon-11.svg" style="width: 1rem;height: 1rem">
                 </i>
              </button>
            </div>
          </div>
            <div class="ant-drawer-body">
                <div>
                    需求联系人
                    <span v-for="(item,index) in project_code.user">{{item}}，</span>
                </div>
                <el-form>

                     <el-form-item label="">
                         <div class="tagPanel__createTag___ZLmvq" v-for="(item,index) in project_code.user" :key="index" style="margin-top: 10px">
                            <el-input type="text" maxlength="20" placeholder="请输入" v-model="project_code.user[index]" style="width: 220px"></el-input>
                           <button v-if="index != (project_code.user.length-1)" style="padding-right: 15px;padding-left: 15px;" type="button" v-on:click="DelUser(index)" class="ant-btn tagPanel__close___1ustW ant-btn-lg ant-btn-icon-only">
                               <i aria-label="图标: close" class="anticon anticon-close">
                                   <img src="/lushu/static/svg/icon-11.svg" style="width: 1rem;height: 1rem">
                                </i>
                            </button>
                            <button v-if="index == (project_code.user.length-1)"  style="padding-right: 15px;padding-left: 15px;" v-on:click="AddUser(project_code.user[index])" type="button" class="ant-btn tagPanel__close___1ustW ant-btn-lg ant-btn-icon-only">
                                <i aria-label="图标: check" class="anticon anticon-check">
                                    <img src="/lushu/static/svg/icon-120.svg" style="width: 1rem;height: 1rem">
                                 </i>
                            </button>
                        </div>
                    </el-form-item>
                 </el-form>
                 
                <div class="projectInquiry__title___3JZ3P" style="color: #00b2b4;
                    font-size: 24px;
                    font-weight: 700;
                    margin-bottom: 24px">
                          基本需求
                </div>
              <el-form label-width="120px" label-position="left">
                  <el-form-item label="主要目的地">
                      <el-input v-model="project_code.city"  style="width: 220px"></el-input>
                  </el-form-item>
                <el-form-item label="出游类型">
                  <el-select v-model="project_code.type" placeholder="请选择" style="width: 220px">
                    <el-option label="旅游度假" value="1"></el-option>
                    <el-option label="研学" value="2"></el-option>
                    <el-option label="商务" value="3"></el-option>
                  </el-select>
                </el-form-item>

                  <el-form-item label="景点与活动">
                   <el-input v-model="project_code.activity"  style="width: 220px"></el-input>
                </el-form-item>
                <el-form-item label="出行人数">
                    <span>
                        <span class="people_name">儿童：</span><el-input-number v-model="project_code.children"  controls-position="right"  :min="0"></el-input-number>
                    </span>
                    <span>
                       <span class="people_name" style="left: 8px">成人：</span> <el-input-number v-model="project_code.adult"  controls-position="right"  :min="0"></el-input-number>
                    </span>
                    <span>
                       <span class="people_name" style="left: 8px">老人：</span> <el-input-number v-model="project_code.old"  controls-position="right"  :min="0"></el-input-number>
                    </span>
                 
                </el-form-item>
                <el-form-item label="预算金额">
                  <el-input-number v-model="project_code.money" controls-position="right"  :min="0" ></el-input-number>
                </el-form-item>
                <el-form-item label="何时联系客户">
                 <el-date-picker
                      v-model="project_code.contact_time"
                      type="datetime"
                      placeholder="选择日期时间">
                    </el-date-picker>
                </el-form-item>
              </el-form>
             <div class="projectInquiry__title___3JZ3P" style="color: #00b2b4;
                    font-size: 24px;
                    font-weight: 700;
                    margin-bottom: 24px">
                          定制需求
                </div>
              <el-form label-width="120px" label-position="left">
                <el-form-item label="酒店要求">
                  <el-select v-model="project_code.hotel" placeholder="请选择" style="width: 220px">
                    <el-option label="无要求" value="0"></el-option>
                    <el-option label="经济型" value="1"></el-option>
                    <el-option label="舒适型" value="2"></el-option>
                    <el-option label="豪华型" value="3"></el-option>
                  </el-select>
                </el-form-item>
                 <el-form-item label="仓位要求">
                  <el-select v-model="project_code.position" placeholder="请选择" style="width: 220px">
                     <el-option label="无要求" value="0"></el-option>
                    <el-option label="经济仓" value="1"></el-option>
                    <el-option label="商务舱" value="2"></el-option>
                    <el-option label="头等舱" value="3"></el-option>
                  </el-select>
                </el-form-item>
                <el-form-item label="用餐要求">
                  <el-select v-model="project_code.dining" placeholder="请选择" style="width: 220px">
                      <el-option label="无要求" value="0"></el-option>
                    <el-option label="本地特色餐" value="1"></el-option>
                    <el-option label="中餐" value="2"></el-option>
                    <el-option label="西餐" value="3"></el-option>
                  </el-select>
                </el-form-item>
                <el-form-item label="用车要求">
                  <el-select v-model="project_code.car" placeholder="请选择" style="width: 220px">
                      <el-option label="无要求" value="0"></el-option>
                    <el-option label="舒适" value="1"></el-option>
                    <el-option label="经济" value="2"></el-option>
                    <el-option label="商务" value="4"></el-option>
                    <el-option label="豪华" value="3"></el-option>
                  </el-select>
                </el-form-item>
                <el-form-item label="导游要求">
                  <el-select v-model="project_code.guide" placeholder="请选择" style="width: 220px">
                      <el-option label="无要求" value="0"></el-option>
                    <el-option label="当地导游" value="1"></el-option>
                    <el-option label="华人导游" value="2"></el-option>
                  </el-select>
                </el-form-item>
                <el-form-item label="领队要求">
                  <el-select v-model="project_code.leader" placeholder="请选择" style="width: 220px">
                      <el-option label="无要求" value="0"></el-option>
                    <el-option label="当地领队" value="1"></el-option>
                    <el-option label="华人领队" value="2"></el-option>
                  </el-select>
                </el-form-item>
                <el-form-item label="其他要求">
                  <el-input
                      type="textarea"
                      :rows="2"
                      placeholder="请输入要求"
                      v-model="project_code.other">
                    </el-input>
                </el-form-item>
              </el-form>
            </div>
           
        </div>
      </div>
    </div>
  </div>
</div>