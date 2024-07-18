<!-- 导入顶部数据  -->
<?php include(dirname(__FILE__,2) . '/layout/header.php');?>
<style>
  /* reset */
  html,
  body,
  h1,
  h2,
  h3,
  h4,
  h5,
  h6,
  div,
  dl,
  dt,
  dd,
  ul,
  ol,
  li,
  p,
  blockquote,
  pre,
  hr,
  figure,
  table,
  caption,
  th,
  td,
  form,
  fieldset,
  legend,
  input,
  button,
  textarea,
  menu {
    margin: 0;
    padding: 0;
  }

  ul,
  li {
    list-style-type: none
  }

  h1 {
    font-size: 26px;
  }

  p {
    font-size: 14px;
    margin-top: 10px;
  }

  pre {
    background: #eee;
    border: 1px solid #ddd;
    border-left: 4px solid #f60;
    padding: 15px;
    margin-top: 15px;
  }

  h2 {
    font-size: 20px;
    margin-top: 20px;
  }

  .case {
    margin-top: 15px;
  }

  #callback {
    float: left;
    margin-left: 12px;
    height: 33px;
    line-height: 33px;
    border: 1px solid #d7d7d7;
    padding: 0 10px;
  }

  .inputDuration__popover___2DN4h {
    padding: 0px 16px 12px;
  }
  .people_name{
      background-color: #f5f7fa;
      padding: 11px 0px 11px 10px;
      text-align: center;
      border: 1px solid #eaeaea;
      border-radius: 4px;
      position: relative;
      left: 2px;
      color: #74716d;
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
              <div class="pagePanel__pagePanelContainer___3FpIY">
                <div
                  class="pagePanel pagePanel__pagePanel___3fszW contentBase__contentContainer___2oebb pagePanel__auto___1xn2A">
                  <div class="contentBase__headerContainer___aQ_Tu">
                    <div class="contentBase__statusContainer___1r1Jm">
                      <span class="ant-dropdown-trigger">
                        <span class="planStatus__container___3-d71 planStatus__editable___1-vdr">
                          <i aria-label="图标: consult-status-0" class="anticon anticon-consult-status-0 planStatus__statusOngoing___TLUgv">
                            <img src="/lushu/static/svg/icon-34.svg" style="width: 1rem;height: 1rem">
                          </i>
                          <span class="planStatus__status___2m1rw" v-if="project_data.is_sale == 0">正在进行</span>
                          <span class="planStatus__status___2m1rw" v-else >已完成</span>
                        </span>
<!--                        <i aria-label="图标: down" class="anticon anticon-down contentBase__icon___3i5zd">-->
<!--                          <img src="/lushu/static/svg/icon-118.svg" style="width: 1rem;height: 1rem">-->
<!--                        </i>-->
                      </span>
                    </div>
                    <span class="contentBase__editContainer___3yjO8">
                      <span style="display:inline-block;" class="contentBase__disabledBtn___32fHw">
                        <button type="button" class="ant-btn ant-btn-plain" @click="editDemandClick">
                          <i aria-label="图标: edit" class="anticon anticon-edit">
                            <img src="/lushu/static/svg/icon-46.svg" style="width: 1rem;height: 1rem">
                          </i>
                          <span class="contentBase__editWord___I9w5V">编辑</span>
                        </button>
                      </span>
                    </span>
                    <span class="contentBase__actionsContainer___prlIt"></span>
                  </div>
                  <div class="contentBase__contentContainerInner___6KAPZ">
                    <div class="projectInquiry__inquiryContainer___dnS-6">
                      <div class="projectInquiry__contactContainer___SpPfj">
                        <div class="projectInquiry__left___df9ek">
                          需求联系人 ：
                            <span v-for="(item,index) in project.peopleList">{{item.name}}</span>

<!--                          <span style="display:inline-block;cursor:not-allowed"-->
<!--                            class="projectInquiry__disabledBtn___I3HEx">-->
<!--                            <button disabled preventspace="true" style="pointer-events:none" type="button"-->
<!--                              class="ant-btn">-->
<!--                              <span>查看全部客户</span>-->
<!--                            </button>-->
<!--                          </span>-->
                        </div>
                      </div>
                      <div class="projectInquiry__basicRequirementsContainer___24dZI">
                        <div class="projectInquiry__title___3JZ3P">
                          基本需求
                        </div>
                        <div class="projectInquiry__basicContainer___2DgEE">
                          <div class="ant-table-wrapper">
                            <div class="ant-spin-nested-loading">
                              <div class="ant-spin-container">
                                <div
                                  class="ant-table ant-table-default ant-table-bordered ant-table-without-column-header ant-table-scroll-position-left">
                                  <div class="ant-table-content">
                                    <div class="ant-table-body">
                                      <table class="">
                                        <colgroup>
                                          <col style="width:160px;min-width:160px">
                                          <col>
                                        </colgroup>
                                        <tbody class="ant-table-tbody">
                                          <tr v-for="item,index in project.basicTableList" :key="index" class="ant-table-row ant-table-row-level-0" data-row-key="destinations">
                                            <td class="">
                                              <span style="padding-left:0px"
                                                class="ant-table-row-indent indent-level-0"></span>
                                              <span>{{item.title}}：</span>
                                            </td>
                                            <td class="">
                                              <span class="projectInquiry__content___RyxSX">
                                                <div class="destinationListText__destinationListText___3ly9q">
                                                  <div class="destinationListText__item___3FMZT">
                                                    <span>{{item.value}}</span>
                                                  </div>
                                                </div>
                                              </span>
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
                      <div class="projectInquiry__basicRequirementsContainer___24dZI">
                        <div class="projectInquiry__title___3JZ3P">
                          定制需求
                        </div>
                        <div class="projectInquiry__basicContainer___2DgEE">
                          <div class="ant-table-wrapper">
                            <div class="ant-spin-nested-loading">
                              <div class="ant-spin-container">
                                <div
                                  class="ant-table ant-table-default ant-table-bordered ant-table-without-column-header ant-table-scroll-position-left">
                                  <div class="ant-table-content">
                                    <div class="ant-table-body">
                                      <table class="">
                                        <colgroup>
                                          <col style="width:160px;min-width:160px">
                                          <col>
                                        </colgroup>
                                        <tbody class="ant-table-tbody">
                                          <tr v-for="(item,index) in project.customizeTableList" :key="index" class="ant-table-row ant-table-row-level-0" data-row-key="hotel">
                                            <td class="">
                                              <span style="padding-left:0px"
                                                class="ant-table-row-indent indent-level-0"></span>
                                              <span>{{item.title}}：</span>
                                            </td>
                                            <td class="">
                                              <span class="projectInquiry__content___RyxSX">{{item.value}}</span>
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
                </div>
                  <div class="pagePanel pagePanel__pagePanel___3fszW contentBase__rightContainer___1aBtT pagePanel__sider___3KzU1" style="flex:0 0 320px;max-width:320px;min-width:320px;width:320px">
                      <div class="operators__operatorsContainer___23nYo">
                          <div class="operators__title___2E9fz">
                              负责成员
                          </div>
                          <span>
                            <span>
                                <span class="an-avatar avatarPlus__avatar___A1CVN operators__avatar___h2-h4 avatar__avatar___4NUXc">
                                    <span class="avatar__avatarInner___1y0H-">
                                        <span style="background-color:#599DFA" class="ant-avatar ant-avatar-circle">
                                            <span class="ant-avatar-string">{{project_data.user}}</span>
                                        </span>
                                    </span>
                                </span>
                            </span>
<!--                            <button type="button" class="ant-btn ant-btn-circle ant-btn-lg ant-btn-icon-only">-->
<!--                                <i aria-label="图标: plus" class="anticon anticon-plus">-->
<!--                                    <img src="/lushu/static/svg/icon-60.svg" style="width: 1rem;height: 1rem">-->
<!--                                </i>-->
<!--                            </button>-->
                          </span>
                      </div>
                      <div>
                          <?php $project_log_type = 2; include(dirname(__FILE__,2) . '/layout/project_log.php');?>
                      </div>
                  </div>
              </div>

            </div>
          </div>

        </div>

      </div>
    </div>
<!--编辑-->
     <?php include(dirname(__FILE__,2) . '/layout/project_edit_demand.php');?>
      <?php include(dirname(__FILE__,2) . '/layout/release.php');//发布路书详情?>

  </div>


</body>

</html>