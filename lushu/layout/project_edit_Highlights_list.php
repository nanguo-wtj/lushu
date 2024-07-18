<div class="plannerMain__cell___2Vav9 enter-light" style="left:196px;width:calc((100% - 240px) * 0.3333);z-index:10">
    <div class="plannerMain__plannerPanelWrap___3vIXb plannerMain__default___Le6uz">
        <div class="plannerPanel__plannerPanel___3vpy8 keypoints__panel___2jVIq">
            <div class="plannerPanel__header___3iE-t">
                <div>
                    <h2>行程亮点</h2>
                </div>
                <div class="plannerPanel__headerActions___2-0JG" onclick="$('.addLight').show()">
                    <button type="button" class="ant-btn ant-btn-primary">
                        <span>编辑</span>
                    </button>
                </div>
            </div>
            <div class="plannerPanel__body___l2w7l">
                <div class="keypoints__panelInner___2ZJXG">
                    <div>
                        <div class="ant-row" style="margin-left:-4px;margin-right:-4px">


                            <div v-for="item in data.Highlights_list" :key="item.id" v-on:click="Getdetails_Tripdata(item.id)" style="padding-left:4px;padding-right:4px" class="ant-col-12 widgets__draggable___3E4Xh">
                                <div class="tripElementAddControl__tripElementAddControl___2ffiM tripElementAddControl__control___30rqE tripElementAddControl__actionRemove___3MeKw tripElementAddControl__positionRightTop___pk2DG">
                                    <div class="tripElementAddControl__btns___3cfir">
                                        <button v-on:click="del_project_trip(item,2)" type="button" class="ant-btn tripElementAddControl__btnRemove___3jsJE ant-btn-danger ant-btn-circle ant-btn-sm ant-btn-icon-only">
                                            <i aria-label="图标: delete" class="anticon anticon-delete">
                                                <img src="/lushu/static/svg/icon-48.svg" style="    width: 0.7rem; height: 0.7rem; margin-top: -4px;">
                                            </i>
                                        </button>
                                    </div>
                                    <div class="keypoint__keypoint___18gVZ tripElementAddControl__element___3LZTR tripElementAddControl__keypoint___i-JiB" style="margin-bottom:8px">
                                        <div class="keypoint__cover___ffcTY">
                                            <span :style='"background-image:url("+item.url+")"' class="widgets__lushuBackgroundImage___3XMmZ"></span>
                                        </div>
                                        <div class="keypoint__cont___1W55z">
                                            <h4 class="keypoint__title___EAnXu">{{item.title}}</h4>
                                            <div class="keypoint__description___oofnF">
                                                {{item.content}}
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
</div>
