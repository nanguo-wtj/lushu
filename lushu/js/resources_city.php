<script>
    new Vue({
        el: '#webMain',
        data: {
            city_key:{

            },
            city_list:[],
            city_data:{
                region_name:'',
                en_name:'',
                parent_id:0,
                coordinate:'',
                address:'',
            },
            resources_key:{
                title: "",
                page: 1,
            },
            city_list1: {
                city: [],
                user: []
            },
            city_list1_status:false,
            project_city:'',
            search_data:{
                poi_value:'',
                poi_list:[]
            },
            message_number:0,
            message_list:[],
            message_data:{},
            page_list:{}
        },
        methods: {
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
                });
            },
            GetCityList:function () {
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=resource_list&list=city";

                post_url(url,_that.resources_key,false,true).then(res => {
                    _that.city_list   =   res.data.list
                    _that.GetListNumber();
                },error=>{
                    _that.resources_List = [];
                });
            },
            GetListNumber:function(e){
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=resource_list&list=city_number";

                post_url(url,_that.resources_key,false,true).then(res => {
                    _that.page_list   =   res.data.list;
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
                _that.resources_key.page--;
                _that.GetCityList();
            },
            GetNextpage:function () {
                var _that   =   this;
                if(_that.page_list.next == false){
                    return false;
                }
                _that.resources_key.page++;
                _that.GetCityList();
            },
            GetPage:function (e) {
                var _that   =   this;
                _that.resources_key.page = e;
                _that.GetCityList();
            },
            add_city:function () {
                console.log(this.city_data)

                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=resource_city&list=city";
                post_url(url,_that.city_data,true).then(res => {
                    var str =   {
                            region_name:'',
                            en_name:'',
                            parent_id:0,
                            coordinate:''
                        }
                    _that.GetCityList();
                    $('#city_add').css('display', 'none')
                    _that.city_data = str
                    _that.project_city = ''
                },error=>{
                });
            },
            add_address:function (e,a){
                this.city_data.parent_id =   e.id
                this.city_list1_status   =   false;
                this.project_city        =   e.region_name;
            },
            get_details(e){
                Jump_url('/lushu/resources_city_details.html?key_id='+e);
            },
            search:function () {
                var _that   =   this;
                _that.resources_key.page = 1;

                this.GetCityList();
            },
            search_address_map:function () {
                var _that   =   this;
                $('#searchResultsPopup').show()
                if(!_that.city_data.address){
                    return false;
                }
                if(_that.search_data.poi_value == _that.city_data.address){
                    return  false;
                }
                var iframe =    $("#map_edit")[0];
                _that.search_data.poi_value =   _that.city_data.address;
                iframe.contentWindow.autoInput(_that.city_data.address).then(res => {
                    console.log(res)
                    _that.search_data.poi_list =   res.tips;
                },error=>{

                    _that.search_data.poi_list =   [];
                });


            },
            add_poi_address:function (e) {
                var _that   =   this;
                _that.city_data.coordinate   =   e.location.lng+','+e.location.lat
                _that.city_data.address   =   e.name+','+e.district;
                _that.search_data.poi_list   =   [];
                var iframe =    $("#map_edit")[0];
                _that.search_data.poi_value =   _that.city_data.address;
                var code    =   iframe.contentWindow.set_poi_maker(e.name,e.location.lng,e.location.lat);
                code.on('dragend', function() {//拖动坐标获取新坐标
                    var number  =   iframe.contentWindow.get_adderss_number(code);
                    iframe.contentWindow.Set_Center(number.lng,number.lat);
                    _that.city_data.coordinate   =   number.lng+','+number.lat

                    console.log('最新坐标：',number )
                });
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
            }
        },
        created(){
            this.GetCityList();
            this.GetMessageNumber()

        }
    })
</script>
