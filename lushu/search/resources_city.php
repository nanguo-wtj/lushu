<div class="pageFilter__pageFilterRow___2A-U3 clear">
    <form class="ant-form ant-form-horizontal" @submit.prevent="search">
        <input type="submit" value="on" style="display: none">
        <span class="pageFilter__pageFilterCell___2PklM">
            <span class="ant-input-affix-wrapper" style="width:320px">
                <span class="ant-input-prefix">
                    <i aria-label="图标: search" class="anticon anticon-search">
                        <img src="/lushu/static/svg/icon-16.svg" style="width: 1rem;height: 1rem">
                    </i>
                </span>
				<input type="text" v-model="resources_key.title" placeholder="搜索关键字" value="" class="ant-input ant-input-dark">
            </span>
        </span>
    </form>
    <span class="pageFilter__pageFilterCell___2PklM pageFilter__right___ArpIX">
		<button onclick="$('.add').css('display', 'block')" type="button" class="ant-btn ant-btn-primary ant-btn-lg">
			<i aria-label="图标: plus" class="anticon anticon-plus">
				<svg viewbox="64 64 896 896" class="" data-icon="plus" width="1em" height="1em" fill="currentColor" aria-hidden="true" focusable="false">
					<path d="M830.37 464H547.13V180.86a47.94 47.94 0 1 0-95.88 0V464H168a47.94 47.94 0 0 0 0 95.88h283.25v283.28a47.94 47.94 0 1 0 95.88 0V559.92h283.24a47.94 47.94 0 0 0 0-95.88z">
					</path>
				</svg>
			</i>
			<span>新建城市</span>
		</button>
	</span>
</div>