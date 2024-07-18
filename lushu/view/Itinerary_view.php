<?php include(dirname(__FILE__,2) . '/layout/header.php');?>
<body>
<div id="itineraryMain" class="trial">
    <!--
        <img class="watermark" src="https://static.lushu.com/images/watermark.svg" />
     -->
    <div>
        <div class="itineraryHead">
            <h2>{{project_data.title}}</h2>
            <div class="tripRoute">{{project_data.city}}</div>
        </div>
        <div class="itineraryBody">

            <div class="tripDate">{{project_data.start_time}} ~ {{project_data.end_time}}</div>


            <div class="itineraryTable">
                <div class="tr">
                    <div class="th"><div class="tdInner">日期</div></div>
                    <div class="th"><div class="tdInner">日程安排</div></div>
                    <div class="th"><div class="tdInner">住宿</div></div>
                    <div class="th"><div class="tdInner">城际交通</div></div>
                </div>


                <div v-for="(item,index) in TravelRoute" :key="index" class="tr js-no-breakdown">
                    <div class="td">
                        <div class="tdInner">
                            <h3 class="day">D{{item.day}}</h3>

                            <div class="date">{{item.time}}</div>
                            <div class="weekDay">{{item.work}}</div>



                            <ul class="cities">
                                <li class="city"  v-for="(a,b) in  item.city" :key="b">
                                    <div class="title">
                                        <i v-if="index == 0 && b == 0" class="icon-point"></i>
                                        {{a.value}}</div>
<!--                                    <div class="sub">Lu'an</div>-->
                                </li>

                            </ul>

                        </div>
                    </div>
                    <div class="td">
                        <div class="tdInner">

                            <ol class="agenda">
                                <li  v-for="(a,b) in item.schedule" class="agendaItem">
                                    {{b+1}}  {{a.title}}
                                </li>
                            </ol>

                        </div>
                    </div>
                    <div class="td" v-if="item.hotel">
                        <div class="tdInner">

                            <div class="hotel">
                                <i class="icon-tag-2-hotel"></i>
                                <div class="title" v-if="item.hotel.name">{{item.hotel.name.title}}</div>
<!--                                <div class="address sub">江苏省 扬州市 广陵区国庆路119号</div>-->
                            </div>

                        </div>
                    </div>
                    <div class="td">
                        <div class="tdInner">
                            <ol class="agenda">
                                <li  v-for="(a,b) in item.traffic" class="agendaItem">
                                    {{a.startingPoint.region_name}}~{{a.destination.region_name}}
                                    <br>{{a.Traffic_value}}
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>




            </div>

        </div>
    </div>
</div>




</body>