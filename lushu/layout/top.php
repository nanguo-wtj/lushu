    <div class="mainRow basicLayout__mainRow___JOrD9">
        <div>
            <a class="globalLink basicLayout__pageTitle___3IeEK" href="/"><?=$ApplicationName//程序名称?></a>
<!--            <a class="globalLink homepage__payment___2eP9N">升级版本</a>-->
        </div>
        <div class="basicLayout__center___RAJSN"></div>
        <div>
<!--                  <span class="widgets__badge___2la-Y basicLayout__badgeBtn___nKA3l">-->
<!--                      <button type="button" class="ant-btn basicLayout__disabled___3kU5S ant-btn-plain">-->
<!--                          <i aria-label="图标: file" class="anticon anticon-file">-->
<!--                               <img src="/lushu/static/svg/top-1.svg" style="width: 1rem;height: 1rem">-->
<!---->
<!--                          </i>-->
<!--                          <span>客户咨询</span>-->
<!--                      </button>-->
<!--                  </span>-->
            <span class="widgets__badge___2la-Y basicLayout__badgeBtn___nKA3l">
                <button type="button" class="ant-btn ant-btn-plain" v-on:click="GetMessageList()">
                    <i aria-label="图标: bell" class="anticon anticon-bell">
                       <img src="/lushu/static/svg/top-2.svg" style="width: 1rem;height: 1rem">
                    </i>
                    <span>提醒通知</span>
                </button>
                <span class="badgeCount widgets__count___hdsr0" v-if="message_number > 0">{{message_number}}</span>
            </span>
            <span class="basicLayout__accountInner___B2M basicLayout__accountBox___1BMK2 ant-popover-open">
                    <!-- 设置 -->
                    <div style="position: absolute; top: 0px; left: 0px;width: 100%;height: 0;">
                      <div>
                        <div class="ant-popover basicLayout__avatarOverlay___1IGRN ant-popover-placement-bottomRight ant-popover-hidden" style="right: 18px; left: auto; top: 45px; transform-origin: 300px 0px;">
                          <div class="ant-popover-content">
                            <div class="ant-popover-arrow"></div>
                            <div class="ant-popover-inner" role="tooltip">
                              <div>
                                <div class="ant-popover-inner-content">
                                  <div class="basicLayout__avatarPanel___eVLgD">
                                    <div class="basicLayout__topRow___1eTB6">
                                      <h3><?=$ApplicationName//程序名称?></h3>
<!--                                      <div class="basicLayout__versionInfo___19Ll9"><span>基础版-->
<!--                                          | </span><span class="widgets__voidLink___1jqQz-->
<!--                                            basicLayout__operation___2zsJI">升级到高级版</span>-->
<!--                                      </div>-->
                                    </div>
                                    <div class="basicLayout__btmRow___1iSzR"><a class="globalLink
                                          basicLayout__link___2vINL" href="./organization.html">企业信息</a>
                                      <div class="ant-divider ant-divider-horizontal"></div>
<!--                                      <a class="globalLink basicLayout__link___2vINL" href="./organization-members.html">成员信息</a>-->
<!--                                      <div class="ant-divider ant-divider-horizontal"></div>-->
                                      <a class="globalLink basicLayout__link___2vINL" href="./information.html">个人资料设置</a>
                                      <div class="ant-divider ant-divider-horizontal"></div>
                                      <span class="widgets__voidLink___1jqQz basicLayout__link___2vINL" onclick="Logout()">退出登录</span>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <span class="an-avatar avatar__avatar___4NUXc avatar__small___2pq7Q">
                        <span class="avatar__avatarInner___1y0H-">
                            <span  style="width:32px;height:32px;line-height:32px;font-size:18px;background-color:#599DFA"  class="ant-avatar ant-avatar-circle">
                            <? if(!$UserData['data']['avatar']){?>}
                                <span class="ant-avatar-string"><?=$UserData['data']['username']?></span>
                            <? }else{?>
                                <img  src="<?=$UserData['data']['avatar']?>" style="width:32px;height:32px;line-height:32px;font-size:18px;background-color:#599DFA">
                            <? }?>
                            </span>

                        </span>
                    </span>
                <span class="basicLayout__name___3z781" style="padding: 10px 18px 14px 16px;"><?=$UserData['data']['username']?></span>
                <i aria-label="图标: down" class="anticon anticon-down">
                      <img src="/lushu/static/svg/top-3.svg" style="width: 1rem;height: 1rem">
                </i>
            </span>
        </div>
    </div>
