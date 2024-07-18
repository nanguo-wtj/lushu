<div id="release" style="position:absolute;z-index: 99;display: none;">
    <div class="ant-drawer ant-drawer-right ant-drawer-open publishTripDrawer__drawer___2P3UU">
        <div class="ant-drawer-mask"></div>
        <div class="ant-drawer-content-wrapper" style="width: 600px;">
            <div class="ant-drawer-content">
                <div class="ant-drawer-wrapper-body" style="overflow: auto; height: 100%;">
                    <div class="ant-drawer-header">
                        <div class="ant-drawer-title">请选择分享的方式</div>
                        <div class="ant-drawer-right-actions">
                            <button aria-label="Close" onclick="$('#release').hide();" class="ant-drawer-close">
                                <i aria-label="图标: close" class="anticon anticon-close">
                                    <img src="/lushu/static/svg/icon-11.svg" style="width: 1rem; height: 1rem;">
                                </i>
                            </button>
                        </div>
                    </div>
                    <div class="ant-drawer-body">
                        <div class="publishTripDrawer__tripContainer___3vKzB">
                            <div class="publishTripDrawer__titleContainer___1ZEDl">
								<span class="publishTripDrawer__main___1pdn3">
									<?=$ApplicationName?>
								</span>
                                <span class="publishTripDrawer__sub___25NB4">（详细行程，支持自由配置）</span>
                            </div>

                            <div class="publishTripDrawer__divider___1Ku9s ant-divider ant-divider-horizontal"></div>
                            <a class="globalLink publishTripDrawer__tripLine___30X_5" href="javascript:" v-on:click="WeChatView">
                                <div class="publishTripDrawer__icon___1p4W_">
                                    <i aria-label="图标: wechat" class="anticon anticon-wechat publishTripDrawer__wx___2tLbi">
                                        <img src="/lushu/static/svg/icon-139.svg" style="width: 2.5rem;height: 2.5rem">
                                    </i>
                                </div>
                                <div class="publishTripDrawer__content___2Ja2g">
                                    <div class="publishTripDrawer__title___3QF0t">微信H5</div>
                                    <div class="publishTripDrawer__desc___15TYb">呈现行程细节，方便微信、QQ、网页等方式发送</div>
                                </div>
                            </a>
                            <div class="publishTripDrawer__divider___1Ku9s ant-divider ant-divider-horizontal"></div>
                            <a class="globalLink publishTripDrawer__tripLine___30X_5" href="javascript:" v-on:click="PdfView">
                                <div class="publishTripDrawer__icon___1p4W_">
                                    <i aria-label="图标: file-pdf" class="anticon anticon-file-pdf publishTripDrawer__pdf___2MBIl">
                                        <img src="/lushu/static/svg/icon-140.svg" style="width: 2.5rem;height: 2.5rem">
                                    </i>
                                </div>
                                <div class="publishTripDrawer__content___2Ja2g">
                                    <div class="publishTripDrawer__title___3QF0t">PDF展示</div>
                                    <div class="publishTripDrawer__desc___15TYb">排版精美，可以打印成纸质版路线给客人</div>
                                </div>
                            </a>

                        </div>
                        <div class="publishTripDrawer__itineraryContainer___3pfeb">
                            <div class="publishTripDrawer__titleContainer___1ZEDl">
                                <span class="publishTripDrawer__main___1pdn3">行程单</span>
                                <span class="publishTripDrawer__sub___25NB4">（快速浏览路线设计的重点内容）</span>
                            </div>
                            <div class="publishTripDrawer__operateContainer___1CSsz">
                                <div class="publishTripDrawer__operateItem___otyfY" onclick="$('#Itinerary_view').show()">
                                    <i aria-label="图标: desktop" class="anticon anticon-desktop publishTripDrawer__icon___1p4W_">
                                        <img src="/lushu/static/svg/icon-141.svg" style="width: 2.5rem;height: 2.5rem">
                                    </i>
                                    <span>WEB行程单</span>
                                </div>
                                <div v-on:click="ItineraryPdfView" class="publishTripDrawer__operateItem___otyfY">
                                    <i aria-label="图标: file-pdf" class="anticon anticon-file-pdf publishTripDrawer__icon___1p4W_">
                                        <img src="/lushu/static/svg/icon-142.svg" style="width: 2.5rem;height: 2.5rem">
                                    </i>
                                    <span>PDF行程单</span>
                                </div>

                            </div>
                        </div>

                        <div></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="Itinerary_view" class="tosProjectCssMarker piecefulModal modalWrap" style="display: none;">
        <div class="publishConfigModal itineraryModal">
            <a class="closeBtn" onclick="$('#Itinerary_view').hide()">
                <i class="icon icon-close"></i>
            </a>
            <div class="modalBody">
                <div class="itineraryCont">
                    <div class="titleInfo">
                        <i class="icon-itineraryWord"></i>生成WEB行程单
                    </div>
                </div>
                <div class="btnsWrap">
                    <a class="btnBorder" onclick="$('#Itinerary_view').hide()">取消</a>
                    <a class="btnSpaceMore btnGreen" href="javascript:" v-on:click="ItineraryView" target="_blank">生成行程单</a>
                </div>
            </div>
        </div>
    </div>

</div>


<div id="WeChatView" class="piecefulModal modalWrap" style="display: none;">
    <div class="shareModal publishDialog shareWeb" style="height: 560px;">
        <a href="javascript:void(0)" class="closeBtn" onclick="$('#WeChatView').hide()">
            <i class="icon icon-close"></i>
        </a>
        <div class="shareWebContent dialogContent">
            <h3 class="dialogTitle">微信路书已成功生成</h3>
            <div class="shareUrlDesc dialogDesc">
                <h5>
                    <i class="tos-icon icon-link"></i>分享网址
                </h5>复制下方链接，发送给您的客人。
            </div>
            <label class="copyToClipboard shareUrlBox">
                <input type="text" readonly=""  v-model="release.WeChatView_url" id="WeChatView_url" :value="release.WeChatView_url">
                <span class="btnCopy btnGreen" style="padding: 12px 4px 12.5px 4px;color: white;" v-on:click="copyInput"><i class="tos-icon icon-copy"></i>复制链接</span>
            </label>
            <div class="shareQRDes dialogDesc">
                <h5>
                    <i class="tos-icon icon-QRcode"></i>路书二维码
                </h5>微信扫描二维码，将行程分享给客人。
            </div>
            <div v-id="release.WeChatView_img_url" class="downloadQR">
				<span class="qrCode" title="https://tos.lushu.com/trip/share/AoBMjzAebY9X4LYL">
					<canvas width="160" height="160" style="display: none;"></canvas>
					<img  :src="release.WeChatView_img_url" style="display: block;">
				</span>
            </div>
            <div class="reminderTxt"></div>
        </div>
    </div>
</div>