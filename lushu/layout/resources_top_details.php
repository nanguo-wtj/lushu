<?php
if(!isset($superior_name)){
    $superior_name  =   'POI库';
}
if(!isset($superior_url)){
    $superior_url  =   'resources_poi';
}
?>
<div class="mainRow basicLayout__mainRow___JOrD9">
    <div>
        <a class="globalLink basicLayout__pageTitle___3IeEK" href="./resources.html">素材库</a>
    </div>
    <div class="basicLayout__center___RAJSN basicLayout__subHeader___1ArlM">
        <div class="ant-breadcrumb ant-breadcrumb-undefined">
			<span>
				<span class="ant-breadcrumb-link">
					<a class="globalLink undefined-link" href="./<?=$superior_url?>.html"><?=$superior_name?></a>
				</span>
				<span class="ant-breadcrumb-separator">
					<i aria-label="图标: right" class="anticon anticon-right">
                        <img src="/lushu/static/svg/icon-28.svg" style="width: 1rem;height: 1rem">
					</i>
				</span>
			</span>
            <span>
				<span class="ant-breadcrumb-link">{{resources_data.title}}</span>
				<span class="ant-breadcrumb-separator">
					<i aria-label="图标: right" class="anticon anticon-right">
                         <img src="/lushu/static/svg/icon-28.svg" style="width: 1rem;height: 1rem">
					</i>
				</span>
			</span>
        </div>
    </div>
    <div>
        <div class="widgets__buttonGroup___u-3Ns">
            <button v-on:click="openDelPoi()" type="button" class="ant-btn ant-btn-plain">
                <i aria-label="图标: delete" class="anticon anticon-delete">
                    <img src="/lushu/static/svg/icon-27.svg" style="width: 1rem;height: 1rem">
                </i>
                <span>删除</span>
            </button>
            <?php if(isset($add_status)){
                if(!isset($add_type)){
                    $add_type   =   'add-poi';
                }
                ?>
            <button type="button" class="ant-btn ant-btn-primary"  v-on:click="$('.<?=$add_type?>').css('display','block');Poi_add();"><span>编辑</span></button>
            <? }?>
        </div>
    </div>
</div>
