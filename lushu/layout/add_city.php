<div class="agenda__addCity___2iNo2">
    <form class="ant-form ant-form-horizontal">
        <div class="destinationAutoComplete__container___2u6IR agenda__addCityInput___2j2xI destinationAutoComplete__hasBorder___3-Prs">
            <div class="ant-row ant-form-item">
                <div class="ant-form-item-control-wrapper">
                    <div class="ant-form-item-control has-success">
						<span class="ant-form-item-children">
							<div id="dest" class="ant-select-show-search ant-select-auto-complete ant-select ant-select-combobox ant-select-enabled ant-select-allow-clear">
								<div class="ant-select-selection ant-select-selection--single" role="combobox" aria-autocomplete="list" aria-haspopup="true" aria-controls="fcf481a6-13bb-4169-ab95-d5d5682a4273" aria-expanded="false" data-__meta="[object Object]" data-__field="[object Object]">
									<div class="ant-select-selection__rendered">
										<ul>
											<li class="ant-select-search ant-select-search--inline">
												<div class="ant-select-search__field__wrap">
													<span class="ant-select-search__field ant-input-affix-wrapper">
														<span class="ant-input-prefix">
															<i aria-label="图标: location" class="anticon anticon-location destinationAutoComplete__icon___2aPbK">
																<img src="/lushu/static/svg/icon-25.svg" style="width: 1rem;height: 1rem">
															</i>
														</span>
														<input v-model="schedule.city_value" @input="search_city(1)"  class="ant-input ant-input-dark" placeholder="搜索城市" type="text" value="">
													</span>
													<span class="ant-select-search__field__mirror">&nbsp;</span>
												</div>
											</li>
										</ul>
									</div>
									<span class="ant-select-selection__clear" unselectable="on" style="user-select: none;">
										<i aria-label="图标: close-circle" class="anticon anticon-close-circle ant-select-clear-icon">
											<img src="/lushu/static/svg/icon-113.svg" style="width: 1rem;height: 1rem">
										</i>
									</span>
									<span class="ant-select-arrow" unselectable="on" style="user-select: none;">
										<i aria-label="图标: down" class="anticon anticon-down ant-select-arrow-icon">
											<img src="/lushu/static/svg/icon-114.svg" style="width: 1rem;height: 1rem">
										</i>
									</span>
								</div>
							</div>
							<div  style="position: absolute; top: 0px; left: 0px; width: 100%;">
								<div>
									<div class="ant-select-dropdown ant-select-dropdown--single ant-select-dropdown-placement-bottomLeft" style="width: 352px; left: 0px; top: 35px;">
										<div id="fcf481a6-13bb-4169-ab95-d5d5682a4273" style="overflow: auto; transform: translateZ(0px);">
											<ul role="listbox" class="ant-select-dropdown-menu  ant-select-dropdown-menu-root ant-select-dropdown-menu-vertical" tabindex="0">
												<li v-for="(item,index) in schedule.city_list" :key="index" role="option" :name="item.region_name" v-on:click="add_project_city(item)" class="ant-select-dropdown-menu-item destinationAutoComplete__optionContainer___1fGuO " >
													<div>
														<div class="destinationAutoComplete__top___1sU7J">{{item.region_name}}</div>
														<div class="destinationAutoComplete__bottom___Ja_yO">
															<div class="destinationAutoComplete__country___W6oO0">{{item.en_name}} {{item.parent.region_name}}</div>
														</div>
													</div>
												</li>
<!--												<li role="option" class="ant-select-dropdown-menu-item destinationAutoComplete__createButtonContainer___2u0b_ ant-select-dropdown-menu-item-disabled" unselectable="on" aria-disabled="true" aria-selected="false" style="user-select: none;">-->
<!--													<button type="button" class="ant-btn ant-btn-primary ant-btn-block">-->
<!--														<span>新建城市</span>-->
<!--													</button>-->
<!--												</li>-->
											</ul>
										</div>
									</div>
								</div>
							</div>
						</span>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>