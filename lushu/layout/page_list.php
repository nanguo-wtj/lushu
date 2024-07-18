<div v-if="page_list.body && page_list.body.length > 0"  class="pagePanel pagePanel__pagePanel___3fszW libraryPageBase__footer___19ORW">
    <div class="widgets__paginationWrap___1QI1J">
        <ul class="ant-pagination widgets__pagination___1FNJ4 mini" >
            <li title="上一页" v-on:click="GetPreviouspage" class=" ant-pagination-prev" aria-disabled="false">
                <a class="ant-pagination-item-link">
                    <i aria-label="图标: left" class="anticon anticon-left">
                        <img src="/lushu/static/svg/icon-61.svg" style="width: 1rem;height: 1rem">
                    </i>
                </a>
            </li>
            <li v-for="(item,index) in page_list.body" :key="index" :title="(index+1)" v-on:click="GetPage(item.page)"  :class="item.status == true? 'ant-pagination-item ant-pagination-item-1 ant-pagination-item-active':'ant-pagination-item ant-pagination-item-1'" tabindex="0">
                <a>{{item.page}}</a>
            </li>

            <li title="下一页" v-on:click="GetNextpage" tabindex="0" class=" ant-pagination-next" aria-disabled="false">
                <a class="ant-pagination-item-link">
                    <i aria-label="图标: right" class="anticon anticon-right">
                        <img src="/lushu/static/svg/icon-129.svg" style="width: 1rem;height: 1rem">
                    </i>
                </a>
            </li>
        </ul>
    </div>
</div>
