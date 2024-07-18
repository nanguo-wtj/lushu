<script>
    new Vue({
        el: '#webMain',
        data: {
            key_id:'<?=$key_id?>',
            city_key:{

            },
            city_list:[],
            city_data:{
                key_id:'',
                region_name:'',
                en_name:'',
                parent_id:0,
                coordinate:'',
                address:''
            },
            city_list1: {
                city: [],
                user: []
            },
            city_list1_status:false,
            project_city:'',
            resources_data:{
                title:'加载中....'
            },
            search_data:{
                poi_value:'',
                poi_list:[]
            }

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
            GetCitydata:function () {
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=resource_details&list=city";
                post_url(url,{key_id:_that.key_id},false,true).then(res => {
                    _that.resources_data            =   res.data;
                    _that.city_data.key_id          =   _that.key_id;
                    _that.city_data.region_name     =   res.data.name;
                    _that.city_data.en_name         =   res.data.en_name;
                    _that.city_data.parent_id       =   res.data.parent_id;
                    _that.city_data.coordinate      =   res.data.coordinate;
                    _that.city_data.address      =   res.data.address;
                    _that.project_city      =   res.data.parent_name;
                    _that.city_data.lng        =   res.data.lng;
                    _that.city_data.lat        =   res.data.lat;



                },error=>{
                });
            },
            Poi_add:function () {
                var _that   =   this;
                $('#Poi_add').show()
                setTimeout(function (){
                    var iframe =    $("#map_edit")[0];
                    iframe.contentWindow.Set_Center(_that.city_data.lng,_that.city_data.lat);
                    var code    =   iframe.contentWindow.set_poi_maker(1,_that.city_data.lng,_that.city_data.lat);
                    code.on('dragend', function() {//拖动坐标获取新坐标
                        var number  =   iframe.contentWindow.get_adderss_number(code);
                        iframe.contentWindow.Set_Center(number.lng,number.lat);
                        _that.city_data.coordinate   =   number.lng+','+number.lat

                        console.log('最新坐标：',number )
                    });
                },1000);
            },
            add_city:function () {
                console.log(this.city_data)
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=resource_city&list=city";
                post_url(url,_that.city_data,true).then(res => {
                    _that.GetCitydata();
                    $('#city_add').css('display', 'none')
                    _that.project_city = ''
                },error=>{
                });
            },
            del_city:function (e) {
                var _that   =   this;
                var str;
                str = _that.city_data.address_code;
                str.forEach(function(item, index, arr) {
                    if(item.id === e.id) {
                        arr.splice(index, 1);
                    }
                });
                _that.city_data.address_code  =   str;

            },
            add_address:function (e,a){
                this.city_data.parent_id =   e.id
                this.city_list1_status   =   false;
                this.project_city        =   e.region_name;
            },
            get_details(e){
                Jump_url('/lushu/resources_city_details.html?key_id='+e);
            },      search_address_map:function () {
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
            openDelPoi:function () {
                $('#poi_del').show();
            },
            DelPoi:function () {
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=resource&list=DelCity";
                post_url(url,{key_id:_that.key_id},true,true).then(res => {
                    Jump_url('./resources_city.html');
                },error=>{
                });
            }
        },
        created(){
            this.GetCitydata();

        }
    })
</script>
