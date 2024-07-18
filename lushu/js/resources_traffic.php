
<script>
    new Vue({
        el: '#webMain',
        data: {
            resources_key:{
                title: "",
                address: "",
                label: "",
                label_value: "全部",
                type: "",
                type_value: "全部",
                page: 1,
                address_value: "",
            },
            search_address_status:false,
            city_address: {
                city: [],
                user: []
            },
            label:[{
                id:1,
                label:'正在加载中请稍等！',
                status:false
            }],
            traffic:{
                mode:[
                    {
                        name:'飞机',
                        img:"/lushu/static/svg/traffic-1.svg"
                    },
                    {
                        name:'火车',
                        img:"/lushu/static/svg/traffic-2.svg"
                    },
                    {
                        name:'渡船',
                        img:"/lushu/static/svg/traffic-3.svg"
                    },
                    {
                        name:'巴士',
                        img:"/lushu/static/svg/traffic-4.svg"
                    }
                ]
            },
            project_data:{
                mode:'请选择交通方式',
                mode_img:'',
                classes:'',
                departure_value:''
            },
            prject_data_post:{
                mode_key:0,
                departure:0,
                classes:''
            },
            city_list: {
                city: [],
                user: []
            },
            city_list1_status:false

        },
        methods: {
            search:function () {
                var _that   =   this;

                if(!_that.resources_key.address_value){
                    _that.resources_key.address = '';
                }
                if(!_that.resources_key.label_value){
                    _that.resources_key.label = '';
                }
                $("#search_city").hide(); //如果可见则隐藏
                $(".label").hide(); //如果可见则隐藏
                $('.city_body').hide();
                this.GetResourcesList();
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
            Set_search_type:function (e,a) {
                var _that   =   this;
                _that.resources_key.type = e;
                _that.resources_key.type_value    =   a
                _that.search();
                $('#search_city').hide()
            },
            Set_search_label:function (e,a) {
                var _that   =   this;
                _that.resources_key.label = e;
                _that.resources_key.label_value    =   a
                _that.search();
                $('.label').hide()
            },
            search_type_show:function (){
                event.stopPropagation();
                if ($("#search_city").is(":visible")) { //判断元素是否可见
                    $("#search_city").hide(); //如果可见则隐藏
                } else {
                    $("#search_city").show(); //如果不可见则显示
                }
            },
            search_label_show:function (){
                event.stopPropagation();
                if ($(".label").is(":visible")) { //判断元素是否可见
                    $(".label").hide(); //如果可见则隐藏
                } else {
                    $(".label").show(); //如果不可见则显示
                }
            },
            search_traffic_mode_show:function (){

                event.stopPropagation();
                if ($(".traffic_body").is(":visible")) { //判断元素是否可见
                    $(".traffic_body").hide(); //如果可见则隐藏
                } else {
                    $(".traffic_body").show(); //如果不可见则显示
                }
            },
            add_search_traffic_mode:function (e,a) {
                this.project_data.mode_img = e.img;
                this.project_data.mode  =   e.name;
                this.prject_data_post.mode_key  =   a;
                $(".traffic_body").hide(); //如果可见则隐藏
            },
            search_city:function(e){
                var _that   =   this;
                _that.city_list1_status   =   false;
                _that.city_list2_status   =   false;
                const url   =   "<?=$_Post_url?>?cmd=tool&list=address";
                var city    =   '';
                if(e == 1){
                    city    =   _that.project_data.departure_value;
                }else {
                    city    =   _that.project_data.departure_value;
                }
                if(!city){
                    return false;
                }
                var data = {
                    address:city
                };
                post_url(url,data,false).then(res => {
                    _that.city_list.city   =   res.data.default;
                    _that.city_list.user   =   res.data.user;
                    if(e == 1){
                        _that.city_list1_status   =   true;
                    }else {
                        _that.city_list2_status   =   true;
                    }
                },error=>{
                    _that.projet_name = '';
                });
            },
            add_address:function (a,e){
                var _that   =   this;
                if(e == 1){
                    _that.city_list1_status   =   false;
                }else {
                    _that.city_list2_status   =   false;
                }
                _that.prject_data_post.departure = a.id
                _that.project_data.departure_value = a.region_name
                _that.city_list = {city: [], user: []};

            },


        },
        created(){
            $('.LOADING').css('display','none')
        }
    })


</script>
