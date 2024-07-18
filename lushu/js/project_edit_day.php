<script>
    const vm =  new Vue({
        el: '#webMain',
        data: {
            key_id:'<?=$key_id?>',
            day:'<?=$day?>',
            days:'<?=$day?>',
            day_code:{},
            project_data:{
                title:  '加载中......',
                content:  '<p>加载中......</p>',
            },
            day_list:[],
            data:{
                schedule_id:[],
                note_id:[],
                schedule_list:[

                ],
                note_list:[

                ],
            },
            list:{
                schedule_list:[

                ],
                trip_list:[

                ],
                note_list:[

                ],
                img_list:[

                ],
                source_list:[

                ],
                note_status:true,
                img_status:false,
                note_note_status:true,
                note_source_status:false

            },
            // 酒店列表
            hotelList: [
                {},{},{},{},{},{},{},{},{},{}
            ],
            hotelNum: 10,
            totalHotel: 50,
            // 是否添加行程
            addCityFlag: false,
             // 新增行程目的地
            add_citys: '',
            // 查询城市结果
            searchCityList: [1,2],
            // 编辑餐饮
            eatDlg: false,

            eatingInfo: {
                breakfast: '',
                lunch: '',
                dinner: ''
            },
            eatingMsg: {
                flag:false,
                breakfast: '',
                lunch: '',
                dinner: ''
            },
            city_list:[],
            city:{
                page:1,
                key:'',
            },
            city_path:[],
            city_path_list:[],
            city_path_list_value:[],
            polyline:'',
            city_day:{
                city:0,
                data:'',
                day:1
            },
            // 行程当地全部poi
            // 编辑行程选中当天游玩poiList
            selectPoiList: [],
            // 用于拖拽
             ending: null,
             dragging: null,
            // 是否展示地图
            mapShow: false,
            // 编辑行程选中
            plannerCalender__selected: 0,
            // 编辑行程选择poi 交通等
            // 编辑住宿
            lodgingShow: false,
            lodgingMsg: {
                islodging: false,
                enter: '', // 入住时间
                outer: '' // 离开时间
            },
            lodging: {
                hotel_id:0,
                enter: '', // 入住时间
                outer: '' // 离开时间
            },
            // 活动列表
            activityList: [

            ],
            showMap: false,
            // 添加交通
            setTraffic: false,

            // 行程交通列表
            trafficInfo: {
                d1: [
                    {title: '公交'}, {}, {}, {}, {}, {}
                ], // d1 第一天 行程直接交通列表
            },
            schedule:{
                column:'poi',
                list:[],
                traffic:[],
                hotel:'',
                hotel_value:{},
                day:1,
                city:[
                    {
                        id:105,
                        value:'六安'
                    }
                ],
                city_value:'',
                city_list:[],
                Traffic:{}
            },
            schedule_search:{
                page:1,
                title:'',
                type:'',
                address:''
            },

            Transportation:[
                {
                    id:1,
                    value:'飞机'
                },
                {
                    id:2,
                    value:'火车'
                },
                {
                    id:3,
                    value:'渡船'
                },
                {
                    id:4,
                    value:'巴士'
                },
                {
                    id:5,
                    value:'其他'
                }
            ],
            ListLoading:false,
            list_removeEventListener:'',
            setShow: false,
            exportShow: false,
            importShow: false,
            isImpIndeterminate: false,
            impCheckAll: false,
            poiMap: false,
            map_index:true,
            map_number:0,
            map_lat:'',
            map_lnt:'',
            Poi_city:{
                list:'',
                lists:'',
                polyline:'',
                openInfo:''
            },
            project:{
                title:'',
                startTime:'',
                dayNum: 2,
                startCity: '',
                endCity: '',
                content: '',
                IDCard: '1223422',
                url: '',
            },
            ExportList:[],
            ExportListData:[],
            ExportData:{
                page:1,
                title:'',
                page_status:true
            },
            import_data:{
                key_id  :   0,
                day  :   [],
                itinerary:  false,
                notes:  false,
                quotation:  false,
                tage:[],
            },
            importShow: false,
            isImpIndeterminate: false,
            impCheckAll: false,
            tagList: [{}],
            export_day:[],
            export_data:{
                title   :   '',
                key_id  :   0,
                day  :   [],
                itinerary:  false,
                notes:  false,
                quotation:  false,
                tage:[],
            },
            AllExport:false,
            AllImport:false,
            search_note_data:{
                title:'',
                page:1,
                status:true
            },
            search_picture_data:{
                title:'',
                page:1,
                status:true
            },
            searchContentDate:"",
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

        },
        methods: {
            // 打开信息设置
            setProject() {
                // 查询项目信息
                // 打开设置页面
                this.Getproject_data();
                this.setShow = true
            },
            // 保存信息设置
            saveSet() {

                this.Setproject_data();
            },

            get_content:function (e) {
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=resource_list&list=note";
                _that.search_note_data.key_id = _that.key_id;
                if(e){
                    _that.search_note_data.page = e;
                }
                post_url(url,_that.search_note_data,false,true).then(res => {

                    if(res.data.list.length < 1){
                        _that.search_note_data.page--;
                        _that.search_note_data.status = false;
                        if(_that.search_note_data.page > 1){
                            return  PopUpPrompt('暂无更多！',7);
                        }
                    }else {
                        _that.search_note_data.status = true;
                        _that.list.note_list  =   [];
                        res.data.list.forEach(function(item, index, arr) {
                            var str =     {
                                'id'        :   item.id,
                                'url'       :   item.url,
                                'title'     :   item.title,
                                'content'      :   item.notes,
                                'user'      :   item.user,
                                'status'    :   false
                            }
                            if(_that.data.note_id.indexOf(item.id) >= 0) {
                                str.status   =   true;
                            }
                            _that.list.note_list.push(str);
                        });
                    }

                },error=>{
                    Jump_url('./');
                });
            },

            get_img:function () {
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=resource_list&list=picture";
                _that.search_picture_data.key_id = _that.key_id;

                post_url(url,_that.search_picture_data,false).then(res => {

                    if(res.data.list.length < 1){
                        _that.search_picture_data.status = false;
                        if(_that.search_picture_data.page > 1){
                            _that.search_picture_data.page--;
                            return  PopUpPrompt('暂无更多！',7);
                        }
                    }else {
                        _that.search_picture_data.status = true;
                        _that.list.img_list  =   res.data.list;
                    }
                },error=>{
                    //Jump_url('./');
                });
            },
            add_list_content:function (e) {
                var _that   =   this;
            },
            get_day:function (e) {
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=project&list=GetDay";
                return new Promise((resolve, reject) => {
                    post_url(url,{key_id:_that.key_id,day:_that.day},false,true).then(res => {
                        _that.day_list  =   res.data.day;
                        _that.day_list.forEach(function(item, index, arr) {
                            if(item.day == _that.day){
                                _that.day_code = item;
                                console.log(_that.day_code)
                            }
                        });
                        resolve(true)
                        if(e != 2){
                            <?php
                            $class  =   req('class');
                            if($class == 'schedule'){?>
                            this.edit_Schedule();
                            <? }?>
                        }

                    },error=>{
                        Jump_url('./');
                    });
                });


            },
            GetItinerary:function (e) {
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=project&list=GetItinerary_day";
                post_url(url,{key_id:_that.key_id,day:_that.day},false).then(res => {
                    _that.project_data.title  =   res.data.title;
                    _that.data.note_list  =   res.data.note;
                    _that.data.Highlights_id  =   res.data.Highlights_id;
                    _that.data.note_id  =   res.data.note_id;
                    _that.project_data.content  =   res.data.content;
                    _that.schedule.hotel_value  =   res.data.hotel;
                    _that.eatingMsg  =   res.data.eatingMsg;
                    _that.eatingInfo.breakfast  =   res.data.eatingMsg.breakfast;
                    _that.eatingInfo.lunch  =   res.data.eatingMsg.lunch;
                    _that.eatingInfo.dinner  =   res.data.eatingMsg.dinner;
                    SetWangeditordata(res.data.content)
                },error=>{
                    Jump_url('./');
                });
            },
            add_project_note:function (e) {
                event.cancelBubble = true;
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=resource_edit&list=add_note";
                post_url(url,{key_id:_that.key_id,note_id:e.id,day:_that.day},true).then(res => {
                    e.status = true;
                    var str =   {
                        'id'        :   e.id,
                        'url'       :   e.url,
                        'title'     :   e.title,
                        'user'      :   e.user,
                        'content'   :   e.content
                    };
                    _that.data.note_list.push(str)
                },error=>{

                });
            },
            del_project_note:function (e,c) {
                event.cancelBubble = true;
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=resource_edit&list=del_note";
                post_url(url,{key_id:_that.key_id,note_id:e.id,day:_that.day},true).then(res => {
                    if(c){
                        _that.list.note_list.forEach(function(item, index, arr) {
                            if(item.id == e.id){
                                item.status = false;
                            }
                        });
                    }
                    _that.data.note_list.forEach(function(item, index, arr) {
                        if(item.id == e.id){
                            _that.data.note_list.splice(index, 1);
                        }
                    });

                },error=>{

                });
            },
            get_project_day:function (e){
                if(!e){
                    location.href   =   'project_edit.html?key_id='+this.key_id;
                }else {
                    location.href   =   'project_edit_day.html?key_id='+this.key_id+'&day='+e;
                }
            },
            get_day_list:function (){
                $('#project_data_day_city').show();
                this.get_city_list();
                this.get_project_city_list();

            },
            getPreviousPage:function () {
                var _that   =   this;
                if(_that.city.page == 1){
                   return  PopUpPrompt('暂无更多！',7);
                }
                _that.city.page  = _that.city.page-1;
                _that.get_city_list();
            },
            getNextPage:function (){
                var _that   =   this;
                _that.city.page  = _that.city.page+1;
                _that.get_city_list();
            },
            get_city_list:function (e) {
                var _that   =   this;
                if(e){
                    _that.city.page =   e;
                }
                const url   =   "<?=$_Post_url?>?cmd=resource_list&list=city_all";
                post_url(url,{page:_that.city.page,title:_that.city.key,project_id:_that.key_id},false).then(res => {
                    if(res.data.list.length < 1){
                        _that.city.page  = _that.city.page-1;
                        return  PopUpPrompt('暂无更多！',7);

                    }else {
                        _that.city_list  =   res.data.list;
                        $('.editRoute__content___1Vp4N').scrollTop(0);
                        _that.del_city_day();
                    }
                },error=>{

                });
            },
            get_project_city_list:function () {
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=resource_list&list=project_city";
                post_url(url,{key_id:_that.key_id},false).then(res => {
                    _that.city_path = res.data.city;
                    _that.city_path_list = res.data.map_list;
                    _that.set_city();
                },error=>{

                });
            },
            add_city:function (e) {
                var _that   =   this;
                var code = [e.lng,e.lat];
                if(e.status == true){
                    e.status = false;
                }else {
                    e.status = true;
                }
                const url   =   "<?=$_Post_url?>?cmd=resource_edit&list=add_day_city";
                post_url(url,{key_id:_that.key_id,city_id:e.id,day:_that.day,number:_that.city_day.day},true).then(res => {
                    _that.get_project_city_list()
                    _that.get_day()
                },error=>{
                    return false
                });

            },
            set_city:function () {
                var _that   =   this;
                var iframe =    $("#map_edit")[0];
                if(_that.polyline){
                    iframe.contentWindow.del_city(_that.polyline);
                }
                if(_that.city_path_list_value){
                    _that.city_path_list_value.forEach(function(item, index) {
                        iframe.contentWindow.del_city(item);
                    });
                }
                var path = _that.city_path;
                _that.polyline    =   iframe.contentWindow.get_city(path);
                iframe.contentWindow.set_city(_that.polyline)
                _that.city_path_list_value    =   iframe.contentWindow.set_city_list(_that.city_path_list)
            },
            add_city_day:function (e) {
                var _that   =   this;
                if(_that.city_day.city){
                    $('#city_day'+_that.city_day.city).hide();
                    $('#city_'+_that.city_day.city).removeClass('editRoute__focused___1HBab');
                }
                _that.city_day.city =   e;
                $('#city_'+e).addClass('editRoute__focused___1HBab');
                $('#city_day'+e).show();
            },
            del_city_day_code:function (a,b,c) {
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=resource_edit&list=del_day_city";
                post_url(url,{key_id:_that.key_id,city_id:b,day:a,key:c},true).then(res => {
                    _that.get_project_city_list()
                    _that.get_day()
                },error=>{
                    return false
                });
                window.event.stopPropagation()
            },
            del_city_day:function () {
                var _that   =   this;
                try{
                    $('#city_day'+_that.city_day.city).hide();
                    $('#city_'+_that.city_day.city).removeClass('editRoute__focused___1HBab');
                }catch (e) {
                    console.log(e);
                }
                _that.city_day.city =   0;
                _that.city_day.day =   1;
                window.event.stopPropagation()
            },
            get_day_code:function (e) {
                var _that   =   this;
                _that.day   =    e.day;
                _that.day_list.forEach(function(item, index, arr) {
                    item.status =   false;
                });
                e.status    =   true;
            },
            close_prject_day_city:function () {
                var _that   =   this;

                _that.day = _that.days;
                $('#project_data_day_city').hide()
                _that.day_list.forEach(function(item, index, arr) {
                    if(_that.day == item.day){
                        item.status    =   true;
                    }else {
                        item.status =   false;
                    }
                });
            },
            edit_Schedule:function(e) {
                var _that   =   this;
                this.plannerCalender__selected = 0
                $('.Schedule.hidden').removeClass('hidden')
                _that.day_list.forEach(function (item,a) {
                    if(_that.day == item.day){
                        _that.schedule.city = item.city
                        item.city.forEach(function (c,d) {
                            if(d == 0){
                                _that.schedule_search.address = c.id
                            }
                        })
                    }
                })
                _that.select_column(_that.schedule.column)

            },
            // 切换选中日期
            chengeDay:function(e) {
                if(e.day == this.day){
                    return false;
                }
                location.href   =   'project_edit_day.html?key_id='+this.key_id+'&day='+e.day+'&class=schedule';
            },
            close_edit:function(e) {
                $('.Schedule').addClass('hidden')
            },
            showMap: function(e) {
                this.mapShow = !this.mapShow
                if (this.mapShow) {
                    // 展示地图
                } else {
                    // 隐藏地图
                }
            },
            // 拖拽方法
            handleDragStart(e, item) {
              this.dragging = item;
            },
            handleDragEnd(e, item) {
                var _that   =   this;
                if (_that.ending.id === _that.dragging.id) {
                    return;
                }

              let newItems = [..._that.selectPoiList];

              const src = newItems.indexOf(_that.dragging);
              const dst = newItems.indexOf(_that.ending);
              newItems.splice(src, 1, ...newItems.splice(dst, 1, newItems[src]));
                _that.selectPoiList = newItems;

                _that.editProjectPoisort(src,dst,_that.dragging.id);

                _that.$nextTick(() => {
                    _that.dragging = null;
                    _that.ending = null;
              });
            },
            handleDragOver(e) {
              // 首先把div变成可以放置的元素，即重写dragenter/dragover
              // 在dragenter中针对放置目标来设置
              e.dataTransfer.dropEffect = "move";
            },
            handleDragEnter(e, item) {
              // 为需要移动的元素设置dragstart事件
              e.dataTransfer.effectAllowed = "move";
              this.ending = item;
            },

            chageEatInfo() {

                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=tool&list=AddDining";
                post_url(url,{key_id:_that.key_id,day:_that.day,Dining:_that.eatingInfo},false,true).then(res => {
                    _that.eatDlg = false;
                    _that.eatingMsg.status = true;
                    _that.eatingMsg.breakfast  =   _that.eatingInfo.breakfast;
                    _that.eatingMsg.lunch  =   _that.eatingInfo.lunch;
                    _that.eatingMsg.dinner  =   _that.eatingInfo.dinner;

                    $('#day_poi').show();
                },error=>{
                    return false
                });

            },
            // 新增行程目的地
            addCity(city, index) {
                // 行程插入数据库

                // 重新刷新行程列表

                // 关闭新增
                this.addCityFlag = false
            },
            setTrafficClick(item, index) {
                if (item.select) {

                } else {}
            },
            Post_content:function (){
                var _that   =   this;
                var content =   $('#editor-content').val();
                const url   =   "<?=$_Post_url?>?cmd=resource_edit&list=add_project_content";
                post_url(url,{key_id:_that.key_id,content:content,day:_that.day},true,true).then(res => {
                    this.GetItinerary();
                    $('.XCJS').hide();
                },error=>{
                    return false
                });
            },
            Getproject_data:function () {
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=project&list=Project_datas";
                post_url(url,{key_id:_that.key_id},false,true).then(res => {
                    _that.project   =   res.data;
                },error=>{
                    return false
                });
            },
            Setproject_data:function () {
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=project&list=editProject";
                var code = _that.project;
                code.key_id =  _that.key_id
                post_url(url,code,true,true).then(res => {
                    this.get_day();
                    this.GetItinerary();
                    this.get_content();
                    this.setShow = false
                },error=>{
                    return false
                });
            },
            upFile2:function() {
                var _that   =   this;

                const url   =   "<?=$_Post_url?>?cmd=tool&list=picture";
                post_ImgFile('img3',url).then(res => {
                    _that.project.url   =  res;

                },error=>{
                    return false
                });


            },
            Get_Hight:function (key) {
                var _that = this;
                if(_that.list_removeEventListener){
                    _that.list_removeEventListener.removeEventListener('scroll',function () {
                        console.log('取消监听成功！')
                    });
                    _that.list_removeEventListener  =   '';
                }
                let dom = document.getElementById(key);
                _that.list_removeEventListener  =   dom;
                dom.addEventListener('scroll', () => {
                    if(_that.ListLoading == true){
                        return false;
                    }
                    const clientHeight = dom.clientHeight;
                    const scrollTop = dom.scrollTop;
                    const scrollHeight = dom.scrollHeight;
                    if (clientHeight + scrollTop >= scrollHeight && this.totalHotel > this.hotelNum) {
                        //查询下一页酒店

                        _that.schedule_search.page++;
                        _that.select_column(_that.schedule_search.type);

                    }
                    // setTimeout(() => {
                    //     if (clientHeight + scrollTop >= scrollHeight && this.totalHotel <= this.hotelNum) {
                    //         this.$message({
                    //             message: '已经到底了',
                    //             type: 'warning'
                    //         });
                    //     }
                    // }, 100)

                })
            },
            select_column:function (e) {
                var _that   =   this;
                _that.ListLoading   =   true;
                _that.schedule.column =   e
                if(e    ==  'traffic' || e == 'hotel') {
                    _that.poiMap = true;
                    _that.OperationMap();
                    _that.poiMap = false;

                }
                if(e    !=  'traffic'){
                    _that.Get_Hight(e);
                }else {
                    _that.Get_Day_traffic();
                    _that.schedule.list =   _that.Transportation;
                    return false;
                }

                if(_that.schedule_search.type !=    e){
                    _that.schedule_search.page  =   1;
                }
                _that.schedule_search.type  =   e;
                const url   =   "<?=$_Post_url?>?cmd=resource_list&list=allResource";
                var code = _that.schedule_search;
                code.type   =   e;
                post_url(url,code,false,true).then(res => {
                    if(code.type == 'activity'){
                        _that.activityList  =   res.data.list;
                        return false;
                    }
                    if(_that.schedule_search.page   !=  1){
                        res.data.list.forEach(function (item,a) {
                            _that.schedule.list.push(item);
                        })
                    }else {
                        _that.schedule.list =   res.data.list;
                    }
                    if(res.data.list.length > 0 ){
                        _that.ListLoading   =   false;
                    }
                    _that.set_selectPoiList_status()
                    if(_that.poiMap == true ){
                        _that.open_map()
                    }
                },error=>{
                    return false
                });
            },
            search:function () {
                var _that   =   this;
                _that.schedule_search.page  =   1;
                _that.select_column(_that.schedule_search.type);
            },
            search_address:function (e) {
                var _that   =   this;
                _that.schedule_search.page  =   1;
                _that.schedule_search.address  =   e.id;
                if(_that.poiMap == true){
                    var iframe =    $("#map_poi_view")[0];
                    iframe.contentWindow.Set_Center(e.lng,e.lat)
                }
                _that.select_column(_that.schedule_search.type);

            },
            Get_Day_traffic:function () {
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=tool&list=projectDayTraffic";
                post_url(url,{key_id:_that.key_id,day:_that.day},false,true).then(res => {
                    _that.schedule.traffic = res.data.list;
                },error=>{
                    return false
                });
            },
            Set_Transportation:function (e,a){
                e.Traffic_value = a.value;
                e.Traffic = a.id;
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=tool&list=editprojectDayTraffic";
                post_url(url,{key_id:_that.key_id,day:_that.day,key:e.id,Traffic:e.Traffic},false,true).then(res => {
                    _that.Get_Day_traffic();
                },error=>{
                    return false
                });

            },
            Get_day_schedule:function () {
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=tool&list=GetProjectPoi";
                post_url(url,{key_id:_that.key_id,day:_that.day},false,true).then(res => {
                    _that.selectPoiList =   res.data.list;
                    _that.open_map();

                },error=>{
                    return false
                });
            },
            GetHotelAdd:function (e) {
                var _that   =   this;
                _that.lodging.hotel_id  =   e.id;
                _that.schedule.hotel  =   e;
                $('#hotel_add_poi').show()
                _that.lodging.enter = _that.day;
                _that.lodging.outer = _that.day;
            },
            GetHoteledit:function () {
                var _that   =   this;
                _that.lodging.hotel_id  =   _that.schedule.hotel_value.id;
                _that.schedule.hotel  =   _that.schedule.hotel_value;
                $('#hotel_add_poi').show();

                _that.lodging.enter = _that.day;
                _that.lodging.outer = _that.day;
            },
            delHotel() {
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=tool&list=DelprojectDayhotel";
                post_url(url,{key_id:_that.key_id,day:_that.day,time:_that.lodging},false,true).then(res => {
                    _that.schedule.hotel_value   =   _that.schedule.hotel;
                    _that.Get_day_schedule();
                    _that.GetItinerary();
                    _that.lodging = {
                        enter: '', // 入住时间
                        outer: '' // 离开时间
                    };
                    $('#hotel_add_poi').hide()

                },error=>{
                    return false
                });
            },
            close_hotel:function () {
                var _that   =   this;
                _that.lodging = {
                    enter: '', // 入住时间
                    outer: '' // 离开时间
                };
                $('#hotel_add_poi').hide()
            },
            saveLodging () {

                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=tool&list=projectDayHotel";
                post_url(url,{key_id:_that.key_id,day:_that.day,time:_that.lodging},false,true).then(res => {
                    _that.Get_day_schedule();
                    _that.get_day();
                    _that.GetItinerary();
                    $('#hotel_add_poi').hide()
                    $('#add_hotel').show()
                    if(_that.poiMap == true){
                        $('#poiMap').hide();
                        $('#day_poi').css('width','608px')
                        _that.poiMap    =   false;
                    }
                    _that.lodging = {
                            enter: '', // 入住时间
                            outer: '' // 离开时间
                    };
                },error=>{
                    return false
                });


            },
            add_poi:function (e) {
                event.cancelBubble = true;
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=tool&list=AddProjectPoi";
                post_url(url,{key_id:_that.key_id,day:_that.day,poi:e.id,type:e.type,title:e.title},false,true).then(res => {
                    _that.Get_day_schedule();
                    _that.selectPoiList.push(res.data.list)
                    e.select    =   true;
                },error=>{
                    return false
                });
            },
            add_pois:function (e) {
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=tool&list=AddProjectPoi";
                post_url(url,{key_id:_that.key_id,day:_that.day,poi:e.id,type:e.type,title:e.title},false,true).then(res => {
                    _that.Get_day_schedule();
                    _that.selectPoiList.push(res.data.list)
                    e.select    =   true;
                },error=>{
                    return false
                });
            },
            addActivity:function (e) {

                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=tool&list=AddProjectPoi";
                post_url(url,{key_id:_that.key_id,day:_that.day,poi:e.id,type:e.type,title:e.title},false,true).then(res => {
                    _that.Get_day_schedule();
                    _that.selectPoiList.push(res.data.list)
                    e.select    =   true;
                },error=>{
                    return false
                });
            },
            Add_day_city:function () {
                event.stopPropagation();
                $('#addCityFlag').show();
                console.log('编辑日期城市')
            },
            Del_project_poi:function (e) {
                event.cancelBubble = true;
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=tool&list=DelProjectPoi";
                post_url(url,{key_id:_that.key_id,day:_that.day,poi:e.id},false,true).then(res => {
                    _that.Get_day_schedule();
                    e.select    =   false;
                },error=>{
                    return false
                });
            },
            search_city:function(e){
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=tool&list=address";
                var city    =   '';
                city    =   _that.schedule.city_value;
                if(!city){
                    return false;
                }
                var data = {
                    address:city
                };
                post_url(url,data,false).then(res => {
                    _that.schedule.city_list   =   res.data.default;
                    res.data.user.forEach(function (item,a) {
                        _that.schedule.city_list.push(item);
                    })
                },error=>{
                    _that.schedule.city_list = [];
                });
            },
            add_project_city:function (e) {
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=resource_edit&list=add_day_city";
                post_url(url,{key_id:_that.key_id,city_id:e.id,day:_that.day,number:1},true).then(res => {
                    _that.get_day().then(res => {
                        _that.edit_Schedule()
                    },error=>{
                        console.log('日期更新失败！')
                    });
                    _that.schedule.city_list = [];
                    _that.schedule.city_value = '';
                    $("#addCityFlag").hide(); //如果可见则隐藏
                },error=>{
                    return false
                });
            },
            editProjectPoisort:function (a,b,c) {
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=tool&list=editProjectPoisort";
                a   =   a+1;
                b   =   b+1;
                post_url(url,{key_id:_that.key_id,day:_that.day,poi_sort:a,newpoi_sort:b,key:c},false).then(res => {
                    _that.Get_day_schedule();
                },error=>{
                    return false
                });
            },
            addTraffic:function (e) {
                event.cancelBubble = true;
                $('#traffic').show();
                $('#day_poi').hide();
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=tool&list=GetProjectTraffic";
                post_url(url,{key_id:_that.key_id,day:_that.day,key:e.id},false).then(res => {
                    _that.schedule.Traffic = res.data.code;
                    },error=>{
                    return false
                });
            },
            closeTraffic:function () {
                $('#traffic').hide();
                $('#day_poi').show();
                this.schedule.Traffic  =   [];
            },
            Editprojectdaytraffic:function (e) {
                // $('#traffic').hide();
                // $('#day_poi').show();
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=tool&list=editProjectTraffic";
                post_url(url,{key_id:_that.key_id,day:_that.day,key:_that.schedule.Traffic.id,traffic:e},false).then(res => {
                    _that.schedule.Traffic.traffic = e;
                    _that.Get_day_schedule();
                },error=>{
                    return false
                });
            },
            add_project_day:function () {
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=tool&list=add_project_day";
                post_url(url,{key_id:_that.key_id},false,true).then(res => {
                    _that.get_project_city_list()
                    _that.get_day(2)
                },error=>{
                    return false
                });

            },
            del_project_daynumber:function (e) {
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=tool&list=del_project_day";
                post_url(url,{key_id:_that.key_id,day:e.day},false,true).then(res => {
                    _that.get_project_city_list()
                    _that.get_day()
                },error=>{
                    return false
                });
            },
            set_selectPoiList_status:function () {
                var _that   =   this;
                var code = [];
                _that.selectPoiList.forEach(function (item,index) {
                    code.push(item.schedule)
                })
                console.log({'已选中poi：':code});

                _that.schedule.list.forEach(function (item,index) {
                    if(code.includes(item.id) == true){
                        item.select =   true;
                    }
                })
            },
            OperationMap:function () {
                var _that   =   this;
                if(_that.schedule.column ==  'traffic' || _that.schedule.column == 'hotel'){
                    $('#poiMap').hide();
                    $('#day_poi').css('width','608px')
                    _that.poiMap    =   false;
                    return false;
                }
                if(_that.poiMap == false){
                    _that.poiMap    =   true;
                    $('#poiMap').show();
                    $('#day_poi').css('width','1000px')
                    _that.open_map();
                }else {
                    $('#poiMap').hide();
                    $('#day_poi').css('width','608px')
                    _that.poiMap    =   false;
                }


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
                console.log(_that.schedule_search.type)
                switch (_that.schedule_search.type) {
                    case "poi":
                        _that.GetPoiCity(iframe, lng, lat);
                        break;
                    case "hotel":
                        _that.GetHotelCity(iframe, lng, lat);
                        break;
                    case "activity":
                        _that.GetActivityCity(iframe, lng, lat);
                        break;

                }
                iframe.contentWindow.Set_Center(lng,lat)
                iframe.contentWindow.Set_Zoom(14)
                if(_that.map_index == true){
                    iframe.contentWindow.MonitoringCenterPoint()
                }
                _that.map_index =   true;
            },
            GetPoiCity:function (e,a,b) {
                var _that   =   this;
                if(!a || !b){
                    return false;
                }
                if(_that.Poi_city.lists){
                    _that.Poi_city.lists.forEach(function(item, index) {
                        e.contentWindow.del_city(item);
                    });
                }
                const url   =   "<?=$_Post_url?>?cmd=tool&list=GetCoordinatePoints";
                post_url(url,{lng:a,lat:b},false).then(res => {
                    var code = [];
                    let picture ;
                    res.data.list.forEach(function (item,index) {
                        picture =   '/lushu/static/user/no.jpg';
                        if(item.picture){
                            picture =   item.picture;
                        }
                        code.push({
                            id: item.id,
                            name: item.title,
                            type: item.type,
                            img: picture,
                            icon:'/lushu/static/svg/icon-101.svg',
                            lng:item.lng,
                            lat:item.lat
                        });
                    })
                    _that.Poi_city.lists    =   e.contentWindow.Set_city_icon(code)
                },error=>{
                    return false
                });
            },
            GetHotelCity:function (e,a,b) {
                var _that   =   this;
                if(!a || !b){
                    return false;
                }
                if(_that.Poi_city.lists){
                    _that.Poi_city.lists.forEach(function(item, index) {
                        e.contentWindow.del_city(item);
                    });
                }
                const url   =   "<?=$_Post_url?>?cmd=tool&list=GetCoordinatePointsHotel";
                post_url(url,{lng:a,lat:b},false).then(res => {
                    var code = [];
                    res.data.list.forEach(function (item,index) {
                        code.push({
                            id: item.id,
                            name: item.title,
                            type: item.type,
                            img: '/lushu/static/user/no.jpg',
                            icon:'/lushu/static/svg/icon-103.svg',
                            lng:item.lng,
                            lat:item.lat
                        });
                    })
                    _that.Poi_city.lists    =   e.contentWindow.Set_city_icon(code)
                },error=>{
                    return false
                });
            },
            GetActivityCity:function (e,a,b) {
                var _that   =   this;
                if(!a || !b){
                    return false;
                }
                if(_that.Poi_city.lists){
                    _that.Poi_city.lists.forEach(function(item, index) {
                        e.contentWindow.del_city(item);
                    });
                }
                const url   =   "<?=$_Post_url?>?cmd=tool&list=GetCoordinatePoints";
                post_url(url,{lng:a,lat:b},false,true).then(res => {

                },error=>{
                    return false
                });
            },
            Add_POI_Day:function (e) {
                console.log({'鼠标移入':e})
                var iframe =    $("#map_poi_view")[0];
                this.Poi_city.openInfo  =   iframe.contentWindow.openInfo(e);
            },
            MonitoringCenter:function (e) {
                var _that   =   this;

                var iframe =    $("#map_poi_view")[0];
                if(!e[0] || !e[1]){
                    return false;
                }
                if(_that.map_lat == e[0]&& _that.map_lnt    ==  e[1]){
                    return  false;
                }
                _that.map_number = _that.selectPoiList.length+1;
                _that.map_lat   =   e[0];
                _that.map_lnt   =   e[1];
                switch (_that.schedule_search.type) {
                    case "poi":
                        _that.GetPoiCity(iframe, e[0], e[1]);
                        break;
                    case "hotel":
                        _that.GetHotelCity(iframe, e[0], e[1]);
                        break;
                    case "activity":
                        _that.GetActivityCity(iframe, e[0], e[1]);
                        break;

                }
            },
            impClick() {
                this.importShow = true;
                $('#importShow').show();
                this.GetExportList();
            },
            // 导出
            expClick() {
                // 查询项目信息
                this.exportShow = true;

                $('#exportShow').show();

                var _that   =   this;
                _that.export_day    =   [];
                _that.day_list.forEach(function(item, index, arr) {
                    var str =     {
                        day        :   item.day,
                        city       :   item.city,
                        status:   false
                    }
                    _that.export_day.push(str);
                });
                // 打开导出页面
                this.export_data.title    =   this.project_data.title;
                this.export_data.key_id    =   this.key_id;
                this.export_data.itinerary =   false;
                this.export_data.notes =   false;
                this.export_data.quotation =   false;

            },
            SelectExportDay:function (e) {
                if(e.status == true){
                    e.status = false;
                }else {
                    e.status    =   true;
                }
            },
            SelectExportType:function (e) {
                var _that = this;
                if(e == 1) {
                    if (_that.export_data.itinerary == true) {
                        _that.export_data.itinerary = false;
                    } else {
                        _that.export_data.itinerary = true;
                    }
                }else if(e == 2){
                    if(_that.export_data.notes == true){
                        _that.export_data.notes = false;
                    }else {
                        _that.export_data.notes    =   true;
                    }
                }else {
                    if(_that.export_data.quotation == true){
                        _that.export_data.quotation = false;
                    }else {
                        _that.export_data.quotation    =   true;
                    }
                }
            },
            ExportSave:function () {
                var _that = this;
                _that.export_data.day   =   [];
                _that.export_day.forEach(function(item, index, arr) {
                    if(item.status == true){
                        _that.export_data.day.push(item.day);
                    }
                });

                const url   =   "<?=$_Post_url?>?cmd=project_export&list=Export";
                post_url(url,_that.export_data,true,true).then(res => {
                    $('#exportShow').hide();
                },error=>{
                    return false
                });
            },
            SelectAllExport:function () {
                var _that = this;
                if(_that.AllExport == false){
                    _that.export_data.itinerary =   true;
                    _that.export_data.notes =   true;
                    _that.export_data.quotation =   true;
                    _that.AllExport =   true;
                    _that.export_day.forEach(function(item, index, arr) {
                        item.status     =   true;
                    });
                }else {
                    _that.export_data.itinerary =   false;
                    _that.export_data.notes =   false;
                    _that.export_data.quotation =   false;
                    _that.AllExport =   false;
                    _that.export_day.forEach(function(item, index, arr) {
                        item.status     =   false;
                    });
                }
            },
            GetExportList:function(e){
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=project_export&list=project";
                post_url(url,_that.ExportData,false,true).then(res => {
                    if(res.data.data.length < 1){
                        _that.ExportData.page--;
                        _that.page_status = false;
                    }else {
                        _that.ExportList   =   res.data.data;
                        _that.import_data = {
                            key_id  :   _that.ExportList[0].id,
                            day  :   [],
                            itinerary:  false,
                            notes:  false,
                            quotation:  false,
                        };
                        _that.ExportList[0].status = true;
                        _that.GetExportListData(_that.ExportList[0])
                    }
                },error=>{
                    _that.ExportList = [];
                });
            },
            GetExportListData:function(e){
                var _that   =   this;
                _that.ExportList.forEach(function(item, index, arr) {
                    item.status     =   false;
                });
                e.status = true;
                const url   =   "<?=$_Post_url?>?cmd=project_export&list=GetDay";
                post_url(url,{key_id:e.id},false,true).then(res => {
                    _that.ExportListData = res.data.day;
                },error=>{
                });
            },
            previousExport:function () {
                var _that   =   this;
                if(_that.ExportData.page < 2){
                    return false;
                }
                _that.ExportData.page--;
                _that.page_status = true;
                _that.GetExportList();
            },
            nextExport:function () {
                var _that   =   this;
                if(_that.page_status  == false){
                    return false;
                }
                _that.ExportData.page++;
                _that.GetExportList();
            },
            SelectAllImport:function () {
                var _that = this;
                if(_that.AllImport == false){
                    _that.import_data.itinerary =   true;
                    _that.import_data.notes =   true;
                    _that.import_data.quotation =   true;
                    _that.AllImport =   true;
                    _that.ExportListData.forEach(function(item, index, arr) {
                        item.status     =   true;
                    });
                }else {
                    _that.import_data.itinerary =   false;
                    _that.import_data.notes =   false;
                    _that.import_data.quotation =   false;
                    _that.AllImport =   false;
                    _that.ExportListData.forEach(function(item, index, arr) {
                        item.status     =   false;
                    });
                }
            },
            SelectImportDay:function (e) {
                if(e.status == true){
                    e.status = false;
                }else {
                    e.status    =   true;
                }
            },
            SelectImportType:function (e) {
                var _that = this;
                if(e == 1) {
                    if (_that.import_data.itinerary == true) {
                        _that.import_data.itinerary = false;
                    } else {
                        _that.import_data.itinerary = true;
                    }
                }else if(e == 2){
                    if(_that.import_data.notes == true){
                        _that.import_data.notes = false;
                    }else {
                        _that.import_data.notes    =   true;
                    }
                }else {
                    if(_that.import_data.quotation == true){
                        _that.import_data.quotation = false;
                    }else {
                        _that.import_data.quotation    =   true;
                    }
                }
            },
            PostImport:function () {
                var _that = this;
                _that.import_data.day   =   [];
                _that.ExportListData.forEach(function(item, index, arr) {
                    if(item.status == true){
                        _that.import_data.day.push(item.day);
                    }
                });
                const url   =   "<?=$_Post_url?>?cmd=project_export&list=import";
                _that.import_data.key = _that.key_id;
                post_url(url,_that.import_data,true,true).then(res => {
                    $('#importShow').hide();
                    _that.GetItinerary();

                },error=>{
                    return false
                });
            },
            previousPageNotes:function () {
                if(this.search_note_data.page < 2){
                    return false;
                }
                this.search_note_data.page--;
                this.search_note_data.status = true;
                this.get_content();
            },
            nextPageNotes:function () {
                if(this.search_note_data.status == false){
                    return false;
                }
                this.search_note_data.page++;
                this.get_content();
            },
            previousPagePicture:function () {
                if(this.search_picture_data.page < 2){
                    return false;
                }
                this.search_picture_data.page--;
                this.search_picture_data.status = true;
                this.get_img();
            },
            nextPagePicture:function () {
                if(this.search_picture_data.status == false){
                    return false;
                }
                this.search_picture_data.page++;

                this.get_img();
            },
            searchContent:function () {
                this.search_picture_data.title = this.searchContentDate;
                this.search_note_data.title = this.searchContentDate;
                this.get_content();
                this.get_img();
            },
            Getdetails_note_data:function (e) {
                var _that = this;
                const url = "<?=$_Post_url?>?cmd=resource_details&list=note";
                post_url(url,{key_id:e},false,true).then(res => {
                    _that.details_note = res.data;
                    $('#note_details').show()
                },error=>{
                });
            },
            switch_Itinerary:function (e) {
                var _that   =   this;
                if(e == 1){
                    _that.list.img_status = false;
                    _that.list.note_status=true;
                    // _that.search_Itinerary_data.title = ''
                }else {
                    _that.list.img_status = true;
                    _that.list.note_status=false;
                    // _that.search_Itinerary_data.title = ''
                }
            },
            add_content:function (e,b) {
                event.cancelBubble = true;
            },
            Close_Itinerary:function(){
                this.get_content();
                this.get_img();
                $('.XCJS').css('display','none');
            },
            Getdetails_Resources_data:function (e,a,c) {
                if(a == 6){
                    return false;
                }
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=resource_details&list=resource&type=view";
                post_url(url,{key_id:e},false,true).then(res => {
                    _that.details_poi.id =   res.data.id;
                    _that.details_poi.superior_id =   res.data.superior_id;
                    _that.details_poi.title =   res.data.title;
                    _that.details_poi.en_title =   res.data.en_title;
                    _that.details_poi.other_title =   res.data.other_title;
                    _that.details_poi.map_address =   res.data.map_address;
                    _that.details_poi.address =   res.data.address;
                    _that.details_poi.type =   res.data.type_id;
                    _that.details_poi.type_value =   res.data.type;
                    _that.details_poi.phone =   res.data.phone;
                    _that.details_poi.official_web =   res.data.official_web;
                    _that.details_poi.opening_hours =   res.data.opening_hours;
                    _that.details_poi.consumption =   res.data.consumption;
                    _that.details_poi.traffic =   res.data.traffic;
                    _that.details_poi.time_reference =   res.data.time_reference;
                    _that.details_poi.introduction =   res.data.introduction;
                    _that.details_poi.address_code =   res.data.address_code_list;
                    _that.details_poi.label        =   res.data.label;
                    _that.details_poi.price_list        =   res.data.price_list;
                    _that.details_poi.lng        =   res.data.lng;
                    _that.details_poi.lat        =   res.data.lat;
                    $('#poi_details').show();
                },error=>{
                });
            },
            Add_poiProject:function () {
                this.add_poi(this.details_poi)
                $('#poi_details').hide();
            }
        },
        created(){
            this.get_day();
            this.GetItinerary();
            this.get_content();
            this.get_img();
            this.Get_day_schedule();


        }
    })

    $('#webMain').click(function () {
        $(".label").hide(); //如果可见则隐藏
        $("#search_city").hide(); //如果可见则隐藏
        $("#addCityFlag").hide(); //如果可见则隐藏
        $('.city_body').hide()
    })
    $('#addCityFlag').click(function () {
        event.stopPropagation();
    })
    function Add_POI_Day(e) {
        vm.Add_POI_Day(e)
    }
    function Add_POI(a,b,c) {
        var code = {
            id:a,
            type:c,
            title:b
        };
        switch (vm.schedule_search.type) {
            case "poi":
                vm.add_pois(code);
                break;
            case "hotel":
                vm.GetHotelAdd(code);
                break;
            case "activity":
                vm.GetActivityCity(iframe, lng, lat);
                break;

        }

    }
    function MonitoringCenter(a) {

        vm.MonitoringCenter(a)
    }

    const E = window.wangEditor

    window.editor = E.createEditor({
        selector: '#wangeditor_content',
        html: '',
        config: {
            placeholder: '请输入...',
            MENU_CONF: {
                uploadImage: {
                    server: "<?=$_Post_url?>?cmd=tool&list=file",
                    timeout: 5 * 1000, // 5s
                    fieldName: 'file',
                    meta: { token: 'xxx', a: 100 },
                    metaWithUrl: true, // join params to url
                    headers: { Accept: 'text/x-json' },
                    maxFileSize: 10 * 1024 * 1024, // 10M
                    base64LimitSize: 5 * 1024, // insert base64 format, if file's size less than 5kb
                    onBeforeUpload(file) {
                        console.log('onBeforeUpload', file)
                        return file // will upload this file
                    },
                    onProgress(progress) {
                        console.log('onProgress', progress)
                    },
                    onSuccess(file, res) {
                        console.log('onSuccess', file, res)
                    },
                    onFailed(file, res) {
                        alert(res.message)
                        console.log('onFailed', file, res)
                    },
                    onError(file, err, res) {
                        alert(err.message)
                        console.error('onError', file, err, res)
                    },
                },
                uploadVideo: {
                    server: "<?=$_Post_url?>?cmd=tool&list=file",
                    timeout: 5 * 1000, // 5s
                    fieldName: 'file',
                    meta: { token: 'xxx', a: 100 },
                    metaWithUrl: true, // join params to url
                    headers: { Accept: 'text/x-json' },

                    maxFileSize: 100 * 1024 * 1024, // 10M

                    onBeforeUpload(file) {
                        console.log('onBeforeUpload', file)

                        return file // will upload this file
                        // return false // prevent upload
                    },
                    onProgress(progress) {
                        console.log('onProgress', progress)
                    },
                    onSuccess(file, res) {
                        console.log('onSuccess', file, res)
                    },
                    onFailed(file, res) {
                        alert(res.message)
                        console.log('onFailed', file, res)
                    },
                    onError(file, err, res) {
                        alert(err.message)
                        console.error('onError', file, err, res)
                    }
                }
            },
            onChange(editor) {
                $('#editor-content').val(editor.getHtml())
            }
        }
    })

    window.toolbar = E.createToolbar({
        editor,
        selector: '#wangeditor_column',
        config: {
            excludeKeys: ['headerSelect','group-more-style','group-more-style','color','bgColor','|','fontFamily','lineHeight','bulletedList','numberedList','todo','group-indent',
                'emotion',"insertTable","codeBlock","divider","undo","redo","fullScreen"
            ],
        }
    })

    function SetWangeditordata(e) {
        editor.setHtml(e)
    }
    function addImage(e) {
        var str =   "<img src='"+e.url+"'  >"
        var htmlStr = editor.getHtml() + str
        editor.setHtml(htmlStr)
    }
    function addNode(e){
        event.cancelBubble = true;
        var htmlStr = editor.getHtml() + e.content
        editor.setHtml(htmlStr)
    }




</script>
