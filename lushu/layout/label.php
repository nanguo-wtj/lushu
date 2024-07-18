<div class="label" style="position: absolute; top: 0px; left: 0px; width:
        100%;display: none;">

    <div onclick="$('.label').css('display', 'none')">
        <div class="ant-dropdown ant-dropdown-placement-bottomCenter" style="left: 845px; top: 160px;">
            <ul class="ant-dropdown-menu tagFilter__menu___1foH8
              ant-dropdown-menu-light ant-dropdown-menu-root
              ant-dropdown-menu-vertical" onclick="(function (event) {
              event= event || window.event;
              console.log(event);
              event.stopPropagation()})()" role="menu">
<!--                <div class="tagFilter__searchTagBar___2bJnB">-->
<!--                    <span class="ant-input-affix-wrapper">-->
<!--                        <span class="ant-input-prefix">-->
<!--                            <i aria-label="图标: search" class="anticon anticon-search">-->
<!--                                <img src="/lushu/static/svg/icon-92.svg" style="width: 1rem;height: 1rem">-->
<!--                            </i>-->
<!--                        </span>-->
<!--                        <input placeholder="搜索标签名称"  type="text" oninput="" class="ant-input" value="">-->
<!--                    </span>-->
<!--                </div>-->
                <div class="tagFilter__tagContainer___3TpEe">
                    <div class="ant-tag ant-tag-checkable tagFilter__tag___2gbqb" v-on:click="Set_search_label(0,'全部')">全部</div>
                    <div v-for="(item,index) in label" :key="index"  v-on:click="Set_search_label(item.id,item.label)" :style="resources_key.label_value == item.label? 'background-color: #00b2b4;color: white;':''"  class="ant-tag ant-tag-checkable tagFilter__tag___2gbqb" >{{item.label}}</div>

                </div>
            </ul>
        </div>
    </div>
</div>