<ul class="ant-pagination mini" >
    <li title="上一页"  v-on:click="<?=$PreviousPage?>" class=" ant-pagination-prev" >
        <a class="ant-pagination-item-link">
            <i aria-label="图标: left" class="anticon anticon-left">
                <img src="/lushu/static/svg/icon-61.svg" style="width: 1rem;height: 1rem">
            </i>
        </a>
    </li>
    <li title="1" class="ant-pagination-item ant-pagination-item-1 ant-pagination-item-active" tabindex="0">
        <a>{{<?=$page?>}}</a>
    </li>
    <li title="下一页"  v-on:click="<?=$NextPage?>" class=" ant-pagination-next" >
        <a class="ant-pagination-item-link">
            <i aria-label="图标: right" class="anticon anticon-right">
                <img src="/lushu/static/svg/icon-63.svg" style="width: 1rem;height: 1rem">
            </i>
        </a>
    </li>
</ul>