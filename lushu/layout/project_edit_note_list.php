<div class="plannerMain__cell___2Vav9"
     <?php if($styles){?> style="left: calc((100% - 240px) * 0.66 + 0px);width: calc((100% - 240px) * 0.5);" <?}else{?>
     style="left:calc((100% - 240px) * 0.6666 + 220px);width:calc((100% - 240px) * 0.3333);z-index:10"
     <? }?>
>
    <div class="plannerMain__plannerPanelWrap___3vIXb plannerMain__default___Le6uz">
        <div class="plannerPanel__plannerPanel___3vpy8">
            <div class="plannerPanel__header___3iE-t">
                <h2>定制师笔记</h2>
                <div class="plannerPanel__headerActions___2-0JG">
                    <button type="button" class="ant-btn ant-btn-primary" onclick="$('.addCard').css('display','block')">
                        <span>编辑</span>
                    </button>
                </div>
            </div>
            <div class="plannerPanel__body___l2w7l card">
                <div>
                    <div>
                        <div  class="ant-row" style="margin-left: -8px; margin-right: -8px;">

                            <div v-for="item in data.note_list" :key="item.id" v-on:click="Getdetails_note_data(item.id)" class="ant-col-24 widgets__draggable___3E4Xh" style="padding-left: 8px; padding-right: 8px;">
                                <div class="tripElementAddControl__tripElementAddControl___2ffiM tripElementAddControl__control___30rqE tripElementAddControl__actionRemove___3MeKw tripElementAddControl__positionRightCenter___1PRs2">
                                    <div class="tripElementAddControl__btns___3cfir" v-on:click="del_project_note(item,2)">
                                        <button type="button" class="ant-btn tripElementAddControl__btnRemove___3jsJE ant-btn-danger ant-btn-circle ant-btn-sm ant-btn-icon-only">
                                            <i aria-label="图标: delete" class="anticon anticon-delete">
                                                <img src="/lushu/static/svg/icon-48.svg" style="    width: 0.7rem; height: 0.7rem; margin-top: -4px;">
                                            </i>
                                        </button>
                                    </div>
                                    <div class="note__noteBox___UhFwo tripElementAddControl__element___3LZTR tripElementAddControl__note___QQ-hv">
                                        <div class="note__noteCover___3XJg6" v-if="!item.url">
                                            <span class="widgets__lushuBackgroundImage___3XMmZ widgets__noImg___CsB0Z">
                                                <div class="widgets__noImgCont___blaq6">
                                                    <i aria-label="图标: picture" class="anticon anticon-picture" style="font-size: 24px;">
                                                        <svg viewBox="64 64 896 896" class="" data-icon="picture" width="1em" height="1em" fill="currentColor" aria-hidden="true" focusable="false">
                                                            <path d="M349.22 579.27l-51.7-67.55a29.39 29.39 0 0 0-46.49-.24L73.56 738.43a29.4 29.4 0 0 0 23.36 47.5l153.97-1.1c-5.96-8.41-10.52-17.67-11.98-28.18a64.81 64.81 0 0 1 12.6-48.3zm600.25 142.21L646.1 311.89a36.75 36.75 0 0 0-58.83-.3L274.16 725.6a36.74 36.74 0 0 0 29.57 58.9l616.47-4.37a36.74 36.74 0 0 0 29.27-58.61zM281.62 394.22a78.08 78.08 0 1 0-78.72-77.49 78.1 78.1 0 0 0 78.72 77.5z"></path>
                                                        </svg>
                                                    </i>
                                                </div>
                                            </span>
                                        </div>
                                        <div class="note__noteCover___3XJg6" v-if="item.url">
                                            <img :src="item.url" style="    width: 100%; height: 100%; ">
                                        </div>
                                        <div class="note__noteCont___2WJA_">
                                            <h4>{{item.title}}</h4>{{item.user}}
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
