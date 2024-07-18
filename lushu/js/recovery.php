<script>

    const  vm = new Vue({
        el: '#webMain',
        data: {
            project_list:[

            ],
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
            city_list1: {
                city: [],
                user: []
            },
            city_list1_status:false,
            city_list2: {
                city: [],
                user: []
            },
            search_address_status:false,
            city_list2_status:false,
            city_address: {
                city: [],
                user: []
            },
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
            },
            poi_list:[],
            poi_value:'',
            Copy_data:{
                title:'',
                demand:false,
                make:true,
                cost:false,
                quotation:false,
                status:true,
                key_id:0
            },
            Complete_data:{
                key_id:0
            },
            Delete_data:{
                key_id:0
            },
            Close_data:{
                key_id:0
            },
            Completely_data:{
                key_id:0
            },
            message_number:0,
            message_list:[],
            message_data:{},

        },
        methods: {
            Getproject_list:function(){
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=project_list&list=project_del";
                post_url(url, {},false,true).then(res => {
                    _that.project_list   =   res.data.data
                },error=>{
                    _that.project_list = [];
                });
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
            Add_project:function (e){
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=project&list=name";
                var data = _that.project;
                post_url(url,data,true).then(res => {
                    if(e == 1){
                        over_Time_url('project_trip.html?key_id='+res.data.key,500);
                    }else {
                        over_Time_url('staging_project.html?key_id='+res.data.key,500);
                    }
                },error=>{
                    _that.projet_name = '';
                });
            },

            Get_project_number(){
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=home&list=statistics";
                post_url(url,{},false).then(res => {
                    _that.count_list  =  res.data.count
                },error=>{
                    _that.count_list = [{
                        prompt:'项目制作中',
                        number:0
                    },{
                        prompt:'项目已完成',
                        number:0
                    }];
                });
            },
            Edit_project:function (e){
                event.cancelBubble = true;
                console.log(e)
                if(e.is_status == 0){
                    var str =   {
                        key: e.id,
                        title: "",
                        start_time: "",
                        end_time: "",
                        project_code: "",
                        departure: "",
                        departure_name: "",
                        return_to: "",
                        return_to_name: "",
                    };

                    this.project_data  =   str;
                    $('#add_projects').show();

                }else {
                    Jump_url('project_edit.html?key_id='+e.id);
                }
            },
            search_city:function(e){
                var _that   =   this;
                _that.city_list1_status   =   false;
                _that.city_list2_status   =   false;
                const url   =   "<?=$_Post_url?>?cmd=tool&list=address";
                var city    =   '';
                if(e == 1){
                    city    =   _that.project_data.departure_name;

                }else {
                    city    =   _that.project_data.return_to_name;
                }
                if(!city){
                    return false;
                }
                var data = {
                    address:city
                };
                post_url(url,data,false).then(res => {
                    if(e == 1){
                        _that.city_list1.city   =   res.data.default;
                        _that.city_list1.user   =   res.data.user;
                        _that.city_list1_status   =   true;
                    }else {
                        _that.city_list2.city   =   res.data.default;
                        _that.city_list2.user   =   res.data.user;
                        _that.city_list2_status   =   true;
                    }
                    console.log(_that.city_list1);
                    console.log(_that.city_list2);
                },error=>{
                    _that.projet_name = '';
                });
            },
            add_address:function (a,e){
                var _that   =   this;
                if(e == 1){
                    _that.city_list1_status   =   false
                    _that.project_data.departure    =   a.id;
                    _that.project_data.departure_name    =   a.region_name;
                }else {
                    _that.city_list2_status   =   false;
                    _that.project_data.return_to    =   a.id;
                    _that.project_data.return_to_name    =   a.region_name;
                }
            },
            Edit_project_post:function(){
                var _that   =   this;
                _that.project_data.start_time   =   $('#test-startDate-1').val();
                _that.project_data.end_time   =   $('#test-endDate-1').val();
                const url   =   "<?=$_Post_url?>?cmd=project&list=detail";
                post_url(url,_that.project_data,true).then(res => {

                    over_Time_url('project_edit.html?key_id='+_that.project_data.key);
                },error=>{


                });
            },
            search_address:function(){
                var _that   =   this;
                _that.search_address_status   =   false;
                $('.city_body').show();
                const url   =   "<?=$_Post_url?>?cmd=tool&list=address";
                var city    =   '';
                city    =   _that.project_search.address_value;
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
                _that.project_search.address = e.id;
                _that.project_search.address_value = e.region_name;
                _that.city_address.city   =   [];
                _that.city_address.user   =   [];
                _that.search();
                $('.city_body').hide();
            },
            Setprojectday:function (a,b) {
                this.project_search.day.number1 =   a;
                this.project_search.day.number2 =   b;
                this.project_search.day_value   =   a+'~'+b;
            },
            openPicker:function() {
                this.$refs.dateTime.focus()
            },
            addTime:function () {
                var _that = this;
                if(_that.project_search.time.length > 1){
                    var start_time    =   _that.getFormdate(_that.project_search.time[0]);
                    var end_time    =   _that.getFormdate(_that.project_search.time[1]);

                    _that.project_search.time_value = start_time+'~'+end_time;
                    _that.project_search.time_key.start = start_time;
                    _that.project_search.time_key.end = end_time;
                    _that.search();
                }

            },
            getFormdate:function (e) {
                const date = new Date(e);
                const year = date.getFullYear();
                const month = date.getMonth() + 1; // 月份是从0开始的
                const day = date.getDate();

                const formattedDate = `${year}-${month.toString().padStart(2, '0')}-${day.toString().padStart(2, '0')}`;
                return formattedDate;
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

            search:function(){
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=project_list&list=project_list_del";
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

                post_url(url,_that.project_search,false,true).then(res => {
                    _that.project_list   =   res.data.data
                    $('.city_body').hide();
                    $('.outDays').hide();
                    _that.$refs.dateTime.handleClose()
                },error=>{
                    _that.project_list = [];
                });
            },
            Restore:function (e) {
                event.cancelBubble = true;
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=project&list=Restore_s";
                post_url(url,{key_id:e.id},true,false).then(res => {
                    _that.Getproject_list();
                },error=>{});
            },
            Completely:function (e) {
                event.cancelBubble = true;
                $('#poi_del').show()
                this.Completely_data.key_id =   e.id;
            },
            DelPoi:function (e){
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=project&list=Completely";
                post_url(url,_that.Completely_data,true,false).then(res => {
                    $('#poi_del').hide()
                    _that.Getproject_list();
                },error=>{});
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
            // `this` 指向 vm 实例
            this.Getproject_list();
            this.Get_project_number();
            this.GetMessageNumber()

        }
    })
    function selectCheck(node) {
        if ($(node).hasClass('ant-checkbox-checked')) {
            $(node).removeClass('ant-checkbox-checked')
        } else {
            $(node).addClass('ant-checkbox-checked')
        }
    }


    function Setprojectday(a,b) {
        vm.Setprojectday(a,b);
    }


</script>

<script type="text/javascript">

    var days1, days2
    function showSider() {
        $(".ant-slider").sider({
            min: 0, //最小值
            max: 60, //最大值
            step: 1, //拖动步长
            quick: [],
            value: 30, //默认值
            callback: function (_this, value, status, count) {
                //回调函数， 反回3个参数，
                //_this : 当前元素
                //value : 选取的值
                //status : 是否选择完毕
                // count: 1 2 拖动的按钮
                if (count == 1) {
                    if (value != 0) {
                        days1 = value || days1
                    } else days1 = 0

                } else {
                    if (value != 0) {
                        days2 = value || days2
                    } else days2 = 0
                }
                if (!(!days1 & !days2)) {
                    days1 = days1 || 0
                    days2 = days2 || 0
                    if (days2 >= days1) {

                        Setprojectday(days1,days2);
                    } else {
                        Setprojectday(days2,days1);
                    }
                }
            }
        });
    }



    function selectCheck(node) {
        if ($(node).hasClass('ant-checkbox-checked')) {
            $(node).removeClass('ant-checkbox-checked')
        } else {
            $(node).addClass('ant-checkbox-checked')
        }
    }

    function add() {
        $('.add').css('display', 'block')
    }
    function skip() {
        $('.add').css('display', 'none')
    }
    function gh() {
        $('.add').css('display', 'none');
        $('.fund').css('display', 'block');
        layui.use(function () {
            var laydate = layui.laydate;
            // 日期时间范围
            laydate.render({
                elem: '.gh-date',
                type: 'datetime',
                range: '~',
                format: 'yyyy/MM/dd'
            });
        });
    }
</script>
