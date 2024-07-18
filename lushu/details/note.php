<div id="note_details" style="display: none;position: absolute">
    <div class="ant-drawer ant-drawer-right ant-drawer-open">
        <div class="ant-drawer-mask"></div>
        <div class="ant-drawer-content-wrapper" style="width: 824px;">
            <div class="ant-drawer-content">
                <div class="ant-drawer-wrapper-body" style="overflow: auto; height: 100%;">
                    <div class="ant-drawer-header">
                        <div class="ant-drawer-title">笔记详情</div>
                        <div class="ant-drawer-right-actions">

                            <button onclick="$('#note_details').hide()" aria-label="Close" class="ant-drawer-close">
                                <i aria-label="图标: close" class="anticon anticon-close">
                                    <img src="/lushu/static/svg/icon-11.svg" style="width: 1rem;height: 1rem">
                                </i>
                            </button>
                        </div>
                    </div>
                    <div class="ant-drawer-body">
                        <div class="tripCardPreview__title___12owE">{{details_note.title}}</div>
                        <div class="tripCardPreview__richText___2lJ1J">
                            <div v-html="details_note.content">
                            </div>
                        </div>
                        <div class="tripCardPreview__divider___pkjtE ant-divider ant-divider-horizontal"></div>
                        <div class="tripCardPreview__section___G9jCg">
                            <div class="tripCardPreview__subHeader___2LcXZ">相关地点</div>
                            <div class="relatePois__poiItem___3Mu7X" v-for="item in details_note.association" :key="item.id">
                                <i aria-label="图标: poi-method-4" class="anticon anticon-poi-method-4 relatePois__poiIcon___N8gWA">
                                    <img  src="/lushu/static/svg/icon-29.svg" style="width: 1rem;height: 1rem">
                                </i>
                                <span> {{item.value}}</span>
                            </div>
                        </div>
                        <div class="tripCardPreview__section___G9jCg">
                            <div class="relateDestinations__destinationContainer___1kzC4">
                                <div class="relateDestinations__title___YuZMc">相关目的地</div>
                                <div class="relateDestinations__destText___Huluv">
                                    <div v-for="(item,index) in details_note.address" :key="index"  class="destinationListText__destinationListText___3ly9q" style="justify-content: start;">
                                        <div class="destinationListText__item___3FMZT">
                                            <!--                                                    <span class="destinationListText__country___GMItw">中国</span>-->
                                            <span>{{item}}</span>
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