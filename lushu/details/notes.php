<div id="note_details" style="position: absolute;display: none;">
    <div class="tripViewPop tripNotePop">
        <div class="detailBox">
            <div class="btnClose " onclick="$('#note_details').hide()">
                <img src="/lushu/static/svg/icon-11.svg" style="width: 1rem;height: 1rem">
            </div>
            <div class="tripViewPopCont tripViewNote article">
                <div class="cardTitle">
                    <span class="spanTitle">{{details_note.title}}</span>
                </div>
                <div  v-html="details_note.content" class="articleCont articleTxt editCont">

                </div>
                <div class="destinationTitle">相关地点</div>
                <div class="relatedPoi">
                    <div class="address"  v-for="item in details_note.association" :key="item.id">
                        <i class="tos-icon icon-location"></i> {{item.value}}
                    </div>
                </div>
                <div class="cities" v-for="(item,index) in details_note.address" :key="index">
                    <i class="tos-icon icon-destination"></i>
                    <span class="item ">
                        <span class="countryName">{{item}}</span>
				    </span>
                </div>
            </div>
        </div>
    </div>
</div>