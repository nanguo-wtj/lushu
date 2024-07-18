<div class="plannerMain__cell___2Vav9 enter-today"
     <?php if($style){?> style="left: calc((100% - 240px) * 0.15 + 0px);width: calc((100% - 240px) * 0.5);" <?}else{?> style="left: calc((100% - 240px) * 0.3333 + 208px); width: calc((100% - 240px) * 0.3333); z-index: 10;" <?php }?>>
    <div class="plannerMain__plannerPanelWrap___3vIXb plannerMain__default___Le6uz">
        <div class="plannerPanel__plannerPanel___3vpy8 overview__panel___B44Tg">
            <div class="plannerPanel__header___3iE-t">
                <h2>今日介绍</h2>
                <div class="plannerPanel__headerActions___2-0JG">
                    <button type="button" class="ant-btn ant-btn-primary"  onclick="$('.XCJS').css('display','block')">
                        <span>编辑</span>
                    </button>
                </div>
            </div>
            <div class="plannerPanel__body___l2w7l">
                <div class="overview__panelInner___3xdxN">
                    <div class="widgets__globalParagraph___2aU6y">
                        <div v-html="project_data.content">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
