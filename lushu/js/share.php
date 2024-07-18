<script>
    new Vue({
        el: '#webMain',
        data: {
            key_id:'<?=$key_id?>',
            count_list:[],
            loading: true,
            project:{
                name:'',
                collaborate:{
                    controller:[],
                    demand:[],
                    make:[],
                    calculate:[],
                    quotation:[]
                }
            },
            active: 0,
            project_data:{
                key: "<?=$key_id?>",
                title: "",
                start_time: "",
                end_time: "",
                project_code: "",
                departure: "",
                departure_name: "",
                return_to: "",
                return_to_name: "",
            },
            day_list:[],
            traffic_list:[],
            TravelRoute:[],
            booking:[],

            city_list1: {
                city: [],
                user: []
            },
            city_list1_status:false,
            city_list2: {
                city: [],
                user: []
            },
            city_list2_status:false,
            project_log:[],
            project_log_status:false,
            project_log_data:'',
            project_log_code:{
                'key':0,
                'index':0
            },
            project_list:{
                OverviewOfItinerary:[]
            },
            details_note :{
                title:'',
                content:'',
                association:[],
                address:[]
            },
            details_poi:{
                key_id:'<?=$key_id?>',
                superior_id:'',
                title: "",
                en_title: "",
                other_title: "",
                map_address: "",
                address: '',
                address_code:[],
                provincial: "",
                city: "",
                areas: "",
                type: '',
                label: [],
                phone: "",
                official_web: "",
                opening_hours: "",
                consumption: "",
                traffic: "",
                time_reference: "",
                introduction: "",
                guide: "",
                price_list: [
                    {
                        "title": "",
                        "value": ''
                    },
                ],
                superior: ""
            },
            details_trip:{
                picture:'',
                name:'',
                notes:''
            },
            list_code:{
                Traffic:[],
                Traffic_money:0,
                hotel:[],
                hotel_money:0,
                schedule:[],
                schedule_money:0,
                money:0,
            },
            quotation_top_list:[],
            cost_list:[],
            not_included:[],
            PaidItemsList:[],
            quotation_top:[],
            quotation_top_id:0,
            quotation_top_index:0,
            supplementdata:{
                id:'',
                content:'',
            },
            classification:[
                {
                    id:2,
                    value:'老人',
                    status: false
                },
                {
                    id:3,
                    value:'儿童',
                    status: false
                },
                {
                    id:4,
                    value:'婴儿',
                    status: false
                }
            ],
            day_status:true,
            day_number:0,
            selectPoiList:[],
            map_number:0,
            Poi_city:{
                list:'',
                lists:'',
                polyline:'',
                openInfo:''
            },
        },
        methods: {
            findRangeForNumber(array, number) {
                if (number<array[0]) {
                    return 0
                }
                
                if (number>= array[array.length - 1]) {
                    return array.length
                }
                for (let i = 0; i < array.length - 1; i++) {  
                    if (array[i] <= number && number < array[i + 1]) {  
                        return i + 1;  
                    }  
                }
            },
            GetProjectData:function () {
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=open_view&list=Project_data";
                post_url_no(url,{key_id:_that.key_id},false).then(res => {
                    console.log('项目详情');
                    console.log(res.data);
                    _that.project_data          =   res.data;


                },error=>{
                    // Jump_url('./');
                });
            },
            GetProjectDay:function () {
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=open_view&list=Project_day";
                post_url_no(url,{key_id:_that.key_id},false,true).then(res => {
                    _that.day_list  =   res.data.day;
                    _that.traffic_list  =   res.data.traffic;
                    _that.GetProjectData();

                },error=>{
                    $('#add_projects').show()

                });
            },
            Get_projectItinerary:function (){
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=open_view&list=GetItinerary";
                post_url_no(url,{key_id:_that.key_id},false).then(res => {
                    _that.project_list.OverviewOfItinerary  =   res.data;
                },error=>{
                    // Jump_url('./');
                });
            },
            GetTravelRoute:function () {
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=open_view&list=TravelRoute";
                post_url_no(url,{key_id:_that.key_id},false,true).then(res => {
                    _that.TravelRoute   =   res.data
                },error=>{
                    // Jump_url('./');
                });
            },
            Getbooking:function () {
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=open_view&list=Getbooking";
                post_url_no(url,{key_id:_that.key_id},false,true).then(res => {
                    _that.booking   =   res.data
                },error=>{
                    // Jump_url('./');
                });
            },
            Complete_project:function (e) {
                event.cancelBubble = true;
                if(this.project_data.is_sale != 0){return false;}
                $('#Complete_project').show();
            },
            Close_project:function (e) {
                event.cancelBubble = true;
                if(this.project_data.is_sale != 0){return false;}
                $('#Close_project').show();
            },
            Del_project:function (e) {
                event.cancelBubble = true;
                $('#Del_project').show();
            },
            Restore_project:function (e) {
                event.cancelBubble = true;
                $('#Restore').show();
            },


            Getdetails_note_data:function (e) {
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=open_view&list=note";
                post_url(url,{key_id:e,project_id:_that.key_id},false,true).then(res => {
                    _that.details_note   =   res.data;
                    $('#note_details').show()
                },error=>{
                });
            },
            Getdetails_Resources_data:function (e,a,c) {
                if(a == 6){
                    return false;
                }

                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=open_view&list=resource&type=view";
                post_url(url,{key_id:e,project_id:_that.key_i},false,true).then(res => {
                    _that.details_poi =   res.data;
                    _that.details_poi.type =   res.data.type_id;
                    _that.details_poi.address_code =   res.data.address_code_list;
                    $('#poi_details').show();
                },error=>{
                });
            },
            Getdetails_Tripdata:function (e) {
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=open_view&list=trip";
                post_url(url,{key_id:e,project_id:_that.key_id},false,true).then(res => {
                    _that.details_trip            =   res.data;
                    $('#Highlights_details').show()
                },error=>{
                });
            },
            ExpandAll:function (e,b,c){
                $("#"+e).css("max-height","unset");
                $("#"+b).hide();
                $("#"+c).show();
            },
            CloseAll:function (e,b,c) {
                $("#"+e).css("max-height","120px");
                $("#"+b).show();
                $("#"+c).hide();
            },
            GetCost:function () {
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=open_view&list=Cost";
                post_url(url,{key_id:_that.key_id},false,true).then(res => {
                    console.log(res.data)
                    _that.list_code.Traffic =   res.data.Traffic;
                    _that.list_code.Traffic_money =   res.data.Traffic_money;
                    _that.list_code.hotel =   res.data.hotel;
                    _that.list_code.hotel_money =   res.data.hotel_money;
                    _that.list_code.schedule =   res.data.schedule;
                    _that.list_code.schedule_money =   res.data.schedule_money;
                    _that.list_code.money =   res.data.Traffic_money+res.data.hotel_money+res.data.schedule_money;

                    $('#Cost').show()
                },error=>{
                    // Jump_url('./');
                });
            },
            CloseCost:function () {
                this.Cost  =   [];
                $('#Cost').hide()
            },
            GetQuotation:function () {
                this.GetQuotationList();
                this.GetConstList();
                this.GetNotIncludedList();
                this.GetPaidItemsList();
                this.GetSupplementList();
                this.Setopenquotation();
                $('#quotation').show()

            },
            CloseQuotation:function () {
                this.Cost  =   [];
                $('#quotation').hide()
            },
            openItinerary:function (e,a) {
                var _that =   this;
                _that.quotation_top_list = e.content;
                _that.quotation_top_id = e.id;
                _that.quotation_top_index = a;
            },
            GetQuotationList:function () {
                var _that = this;
                const url   =   "<?=$_Post_url?>?cmd=open_view&list=quotation";
                post_url(url,{key_id:_that.key_id},false).then(res => {
                    _that.quotation_top = res.data.list;
                    if(!_that.quotation_top_id){
                        _that.quotation_top_list = res.data.list[0].content;
                        _that.quotation_top_id = res.data.list[0].id;
                    }
                },error=>{
                    return false
                });
            },
            GetConstList:function () {
                var _that = this;
                const url   =   "<?=$_Post_url?>?cmd=open_view&list=Const_quotation";
                post_url(url,{key_id:_that.key_id},false).then(res => {
                    _that.cost_list = res.data.list;
                },error=>{
                    return false
                });
            },
            GetNotIncludedList:function () {
                var _that = this;
                const url   =   "<?=$_Post_url?>?cmd=open_view&list=NotIncluded";
                post_url(url,{key_id:_that.key_id},false).then(res => {
                    _that.not_included = res.data.list;
                },error=>{
                    return false
                });
            },
            GetPaidItemsList:function () {
                var _that = this;
                const url   =   "<?=$_Post_url?>?cmd=open_view&list=PaidItems";
                post_url(url,{key_id:_that.key_id},false).then(res => {
                    _that.PaidItemsList = res.data.list;
                },error=>{
                    return false
                });
            },
            GetSupplementList:function () {
                var _that = this;
                const url   =   "<?=$_Post_url?>?cmd=open_view&list=supplement";
                post_url(url,{key_id:_that.key_id},false).then(res => {
                    _that.supplementdata = res.data.list;
                },error=>{
                    return false
                });
            },
            Setopenquotation:function () {
                var _that =   this;
                const url   =   "<?=$_Post_url?>?cmd=open_view&list=quotation_type";
                post_url(url,{key_id:_that.key_id},false).then(res => {
                    var classification_list = res.data.list.class_view;
                    _that.classification.forEach(function(item, index, arr) {
                        if(classification_list.indexOf(item.id) >= 0) {
                            _that.classification[index].status = true;
                        }
                    });
                },error=>{
                    return false
                });
            },
            getMap_href:function (e) {
                if(e < 1){
                    return false;
                }

                var _that   =   this;
                _that.day_status = false;
                _that.day_number    =   e;
                console.log(e);
                _that.GetMap_day();

            },
            GetMap_day:function () {
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=open_view&list=GetProjectPoi";
                post_url(url,{key_id:_that.key_id,day:_that.day_number},false,true).then(res => {
                    _that.selectPoiList =   res.data.list;
                    _that.open_map();
                    _that.day_status = true;
                },error=>{
                    return false
                });
            },
            open_map:function () {
                var _that   =   this;
                if(_that.poiMap == false){
                    return false;
                }

                var iframe =    $("#map_poi_view")[0];
                if(_that.Poi_city.polyline){
                    iframe.contentWindow.del_city(_that.Poi_city.polyline);
                }
                if(_that.Poi_city.openInfo){
                    iframe.contentWindow.del_city(_that.Poi_city.openInfo);
                }
                if (_that.Poi_city.list) {
                    _that.Poi_city.list.forEach(function (item, index) {
                        iframe.contentWindow.del_city(item);
                    });
                }

                var city_code = [];
                var city_path   =   [];
                var lng,lat;
                _that.selectPoiList.forEach(function (item,index) {
                    var code = {
                        name:(index+1),
                        lng:item.lng,
                        lat:item.lat,
                    };
                    if(index == _that.map_number){
                        lng =   item.lng;
                        lat =   item.lat;
                    }
                    if(item.lng && item.lat){
                        var map_adress  =   [];
                        map_adress.push(item.lng);
                        map_adress.push(item.lat);
                        city_path.push(map_adress)
                        city_code.push(code)
                    }

                })
                console.log('行程介绍');
                console.log(city_code);
                _that.Poi_city.list = iframe.contentWindow.set_city_list_circular(city_code)
                _that.Poi_city.polyline    =   iframe.contentWindow.get_city(city_path);
                iframe.contentWindow.set_city(_that.Poi_city.polyline)
                console.log('启动地图')

                iframe.contentWindow.Set_Center(lng,lat)
                iframe.contentWindow.Set_Zoom(10)
                // if(_that.map_index == true){
                //     iframe.contentWindow.MonitoringCenterPoint()
                // }
                _that.map_index =   true;
            },

        },
        watch:{
            active(newVal, oldVal) {
                // active切换触发
            }
        },
        created(){
            this.GetProjectDay();
            this.Get_projectItinerary();
            this.GetTravelRoute();
            this.Getbooking();

        },
        mounted() {
            const that = this
            this.$nextTick(() => {
                const scrollNode = document.querySelector('.swiper-container')
                
                setTimeout(() => {
                    const scrollList = scrollNode.querySelectorAll('.getScroll')
                    const scrollTopList = []
                    scrollList.forEach((element) => {  
                      const scrollTop = scrollNode.scrollTop; // 如果 swiper-container 可以滚动，则需要考虑当前的滚动位置  
                      const elementRect = element.getBoundingClientRect();  
                      const swiperRect = scrollNode.getBoundingClientRect();  
                      const distanceFromTop = elementRect.top - swiperRect.top + scrollTop;
                      scrollTopList.push(distanceFromTop)
                    });
                    
                    scrollNode.addEventListener('scroll', function(event) {
                    //   scrollTopList
                        if(that.day_status == true){
                            const dayIndex = that.findRangeForNumber(scrollTopList, scrollNode.scrollTop)

                            if(dayIndex > 0){
                                if(that.day_number != dayIndex){
                                    that.day_number = dayIndex;
                                    that.GetMap_day();
                                }else {
                                    that.day_number = dayIndex;
                                }
                            }


                            that.active = dayIndex
                        }

                    })
                
                
                },3000)
               
            })
        }
    })



</script>
