<script>

    new Vue({
        el: '#webMain',
        data: {
            resources_key:{
                title: "",
                address: "",
                page: 1,
                address_value: "",
                rating:'',
                rating_value:'全部',
                label_value:'全部'
            },
            routeList:[],
            city_list1: {
                city: [],
                user: []
            },
            city_list1_status:false,
            city_address: {
                city: [],
                user: []
            },
            message_number:0,
            message_list:[],
            message_data:{},
            page_list:[],
            project_search:{
                title:'',
                collect:0,
                address:'',
                day:{
                    number1:0,
                    number2:0
                },
                time:[],
                time_key:{
                    start:'',
                    end:''
                },
                time_value:'',
                association:'',
                asterisk:0,
                address_value:'',
                day_value:'',
                page:1
            },
            poi_value:'',
            poi_list:[],
            project_data:{
                key: "",
                title: "",
                start_time: "",
                end_time: "",
                project_code: "",
                departure: "",
                departure_name: "",
                return_to: "",
                return_to_name: "",
            },

        },
        methods: {
            GetExportList:function(e){
                var _that   =   this;

                const url   =   "<?=$_Post_url?>?cmd=project_export&list=project";

                post_url(url,_that.project_search,false,true).then(res => {
                    _that.routeList   =   res.data.data;
                    _that.GetListNumber();
                },error=>{
                    _that.routeList = [];
                });
            },
            GetListNumber:function(e){
                var _that   =   this;

                const url   =   "<?=$_Post_url?>?cmd=project_export&list=project_number";

                post_url(url,_that.project_search,false,true).then(res => {
                    _that.page_list   =   res.data.data;
                },error=>{
                    _that.page_list = {
                        previous:false,
                        next:false,
                        body:[]
                    };
                });
            },
            GetPreviouspage:function () {
                var _that   =   this;
                if(_that.page_list.previous == false){
                    return false;
                }
                _that.project_search.page--;
                _that.GetExportList();
            },
            GetNextpage:function () {
                var _that   =   this;
                if(_that.page_list.next == false){
                    return false;
                }
                _that.project_search.page++;
                _that.GetExportList();
            },
            GetPage:function (e) {
                var _that   =   this;
                _that.project_search.page = e;
                _that.GetExportList();
            },
            search_city:function(e){
                var _that   =   this;
                _that.city_list1_status   =   false;
                const url   =   "<?=$_Post_url?>?cmd=tool&list=address";
                var city    =   '';
                city    =   _that.project_city;
                if(!city){
                    return false;
                }
                var data = {
                    address:city
                };
                post_url(url,data,false).then(res => {

                    _that.city_list1.city   =   res.data.default;
                    _that.city_list1.user   =   res.data.user;
                    _that.city_list1_status   =   true;

                },error=>{
                    _that.projet_name = '';
                });
            },
            add_address:function (a,e){
                var _that   =   this;
                _that.city_list1_status   =   false
                var city    =   {
                    id:a.id,
                    value:a.region_name
                };
                try{
                    _that.project_data.address_code.forEach(function(item, index, arr) {
                        if(item.id === a.id) {
                            throw new Error('当前已有目标城市！')
                        }
                    });
                    _that.project_data.address_code.push(city);
                } catch (e) {
                    console.log(e.message);
                }
                _that.project_city = '';

            },
            search_address:function(){
                var _that   =   this;
                _that.search_address_status   =   false;
                $('.city_body').show();
                const url   =   "<?=$_Post_url?>?cmd=tool&list=address";
                var city    =   '';
                city    =   _that.resources_key.address_value;
                if(!city){
                    return false;
                }
                var data = {
                    address:city
                };
                post_url(url,data,false).then(res => {
                    _that.city_address.city   =   res.data.default;
                    _that.city_address.user   =   res.data.user;
                    _that.search_address_status   =   true;
                },error=>{

                });
            },
            add_search_address:function (e,a) {
                var _that   =   this;
                _that.resources_key.address = e.id;
                _that.resources_key.address_value = e.region_name;
                _that.city_address.city   =   [];
                _that.city_address.user   =   [];
                _that.search();
                $('.city_body').hide();

            },
            project_detail:function (e) {
                Jump_url('staging_project_export.html?key_id='+e.id);
            },
            GetMessageList:function () {
                $('#message').css('display','block');
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=message&list=MessageList";
                post_url(url,{},false,true).then(res => {
                    _that.message_list = res.data.list;
                },error=>{});
            },
            GetMessageData:function (e) {
                $('#message_content').show()
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=message&list=MessageData";
                post_url(url,{key_id:e.id},false,true).then(res => {
                    _that.message_data = res.data.list;
                    if(e.status == 0){
                        _that.message_number--;
                        e.status    =   1;
                    }
                },error=>{});
            },
            GetMessageNumber:function () {
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=message&list=MessageNumber";
                post_url(url,{},false,false).then(res => {
                    _that.message_number = res.data.number;
                    setTimeout(function (){
                        _that.GetMessageNumber();
                    },1000*60);
                },error=>{});
            },
            search_poi:function(){
                var _that   =   this;
                $('.traffic_body').show();
                const url   =   "<?=$_Post_url?>?cmd=tool&list=search_poi";
                var association    =   '';
                association    =   _that.poi_value;
                if(!association){
                    _that.poi_list  =   [];
                    return false;
                }
                var data = {
                    title:association,
                    type:1
                };
                post_url(url,data,false).then(res => {
                    _that.poi_list   =   res.data.list;
                },error=>{

                });
            },
            add_poi_address:function (e) {
                var _that   =   this;
                _that.poi_value =   e.address;
                _that.project_search.association = e.id;
                $('.traffic_body').hide();
                _that.search();
            },
            Setcollect:function () {
                var _that   =   this;
                if(_that.project_search.collect == 1){
                    _that.project_search.collect = 0 ;
                }else {
                    _that.project_search.collect = 1 ;
                }
                _that.search();
            },
            CreateProject:function (){
                var _that   =   this;
                $('.reeatedAct').css('display', 'block')
                const url   =   "<?=$_Post_url?>?cmd=project&list=default_name";

                post_url(url, {},false).then(res => {
                    _that.project.name   =   res.data.name
                },error=>{
                    _that.project.name = '';
                });
            },
            search:function(){
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=project_export&list=project";
                if(!_that.project_data.address_value){
                    _that.project_search.address    =   ''
                }
                if(!_that.project_data.address){
                    _that.project_search.address_value    =   ''
                }
                if(!_that.project_search.day_value){
                    _that.project_search.day    =  {number1:0,number2:0};
                }
                if(!_that.project_search.time_value) {
                    _that.project_search.time = [];
                    _that.project_search.time_key = {start: '', end: ''};
                }
                if(!_that.poi_value) {
                    _that.project_search.association = '';
                }
                _that.project_search.page = 1;

                post_url(url,_that.project_search,false,true).then(res => {
                    _that.routeList   =   res.data.data;
                    $('.city_body').hide();
                    $('.outDays').hide();
                    _that.GetListNumber();
                },error=>{
                    _that.project_list = [];
                });
            },

        },
        created(){
            this.GetExportList();
            this.GetMessageNumber()

        }
    })

    $('#webMain').click(function () {
        $(".label").hide(); //如果可见则隐藏
        $("#search_city").hide(); //如果可见则隐藏
        $('.city_body').hide()
    })

</script>
