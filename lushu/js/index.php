<script>

    new Vue({
        el: '#webMain',
        data: {
            project_list:[
                // {
                //     id:'123',
                //     title:'测试数据',
                //     time:'2023-11-14 17:00',
                //     setout:{
                //         time:'出发时间待定',
                //         adress:'出发地点待定',
                //         duration:'时长待定'
                //     },
                //     trip:'行程待定',
                //     user:{
                //         name:'测试'
                //     }
                // }
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
            city_list2_status:false,
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
            production:[],
            completed:[],
            trendStatus:false,
            message_number:0,
            message_list:[],
            message_data:{},
            ResourcesAll:[],
            Project_time:[]
        },
        methods: {
            Getproject_list:function(){
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=project_list&list=project";
                post_url(url, {},false,true).then(res => {
                    _that.project_list   =   res.data.data
                },error=>{
                    _that.project_list = [];
                });
            },
            GetResourcesAll:function(){
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=tool&list=GetResourcesAll";
                post_url(url, {},false,true).then(res => {
                    _that.ResourcesAll   =   res.data.list
                },error=>{
                    _that.ResourcesAll = [];
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
                        over_Time_url('project_trip.html?key_id='+res.data.key,500);
                    }
                },error=>{
                    _that.projet_name = '';
                });
            },
            project_detail:function (e) {
                event.cancelBubble = true;
                if(e.is_status == 0){
                    Jump_url('project_trip.html?key_id='+e.id);
                }else {
                    Jump_url('staging_project.html?key_id='+e.id);
                }
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
            Get_project_numberDay(){
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=home&list=statisticsDay";
                post_url(url,{},false).then(res => {
                    _that.production    =   res.data.production;
                    _that.completed    =   res.data.completed;
                    setTimeout(function (){
                        Set_code(res.data.production,'制作中');
                    },500);
                },error=>{

                });
            },
            set_Project_day:function (e) {
                var _that   =   this;
                if(e == 1){
                    _that.trendStatus =   false;
                    setTimeout(function (){
                        Set_code(_that.production,'制作中');
                    },500);
                } else {
                    _that.trendStatus =   true;
                    setTimeout(function (){
                        Set_code(_that.completed,'已完成');
                    },500);
                }
            },
            Edit_project:function (e){
                event.cancelBubble = true;
                console.log(e)
                if(e.is_sale == 1){
                    PopUpPrompt('该项目已关闭，需要恢复制作中状态才可进行编辑!',7);
                    return false;
                }
                if(e.is_sale == 2){
                    PopUpPrompt('该项目已完成，需要恢复制作中状态才可进行编辑!',7);
                    return false;
                }
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

                const url   =   "<?=$_Post_url?>?cmd=project&list=detail";
                post_url(url,_that.project_data,true).then(res => {

                    over_Time_url('project_edit.html?key_id='+_that.project_data.key);
                },error=>{});
            },
            Copy_project:function (e) {
                event.cancelBubble = true;
                if(e.is_status == 0){
                    PopUpPrompt('请填写行程基础信息后！再次操作',7);
                    return false;
                }

                $('#Copy_project').show();

                this.Copy_data = {
                    title:e.title,
                    demand:false,
                    make:true,
                    cost:false,
                    quotation:false,
                    status:true,
                    key_id:e.id
                };
            },
            Complete_project:function (e) {
                event.cancelBubble = true;
                if(e.is_sale != 0){return false;}
                if(e.is_status == 0){
                    PopUpPrompt('请填写行程基础信息后！再次操作',7);
                    return false;
                }                $('#Complete_project').show();
                this.Complete_data = {
                    key_id:e.id
                };
            },
            Close_project:function (e) {
                event.cancelBubble = true;
                if(e.is_sale != 0){return false;}
                if(e.is_status == 0){
                    PopUpPrompt('请填写行程基础信息后！再次操作',7);
                    return false;
                }                $('#Close_project').show();
                this.Close_data = {
                    key_id:e.id
                };

            },
            Del_project:function (e) {
                event.cancelBubble = true;
                $('#Del_project').show();
                this.Delete_data = {
                    key_id:e.id
                };

            },
            Copy_project_type:function (e) {
                var _that   =   this;

                switch (e) {
                    case 1:
                        if(_that.Copy_data.demand == false){
                            _that.Copy_data.demand = true;
                        }else {
                            _that.Copy_data.demand = false;
                        }
                        break;
                    case 2:
                        if(_that.Copy_data.make == false){
                            _that.Copy_data.make = true;
                            _that.Copy_data.status = true;
                            $('#CopyCost').removeClass('ant-checkbox-disabled');
                            $('#CopyQuotation').removeClass('ant-checkbox-disabled');
                        }else {
                            _that.Copy_data.make = false;
                            _that.Copy_data.status = false;
                            _that.Copy_data.cost = false;
                            _that.Copy_data.quotation = false;
                            setTimeout(function (){
                                $('#CopyCost').addClass('ant-checkbox-disabled');
                                $('#CopyQuotation').addClass('ant-checkbox-disabled');
                            },500);

                        }
                        break;
                    case 3:
                        if(_that.Copy_data.status == true){
                            if(_that.Copy_data.cost == false){
                                _that.Copy_data.cost = true;
                            }else {
                                _that.Copy_data.cost = false;
                            }
                        }
                        break;
                    case 4:
                        if(_that.Copy_data.status == true) {
                            if (_that.Copy_data.quotation == false) {
                                _that.Copy_data.quotation = true;
                            } else {
                                _that.Copy_data.quotation = false;
                            }
                        }
                        break;
                }
            },
            Copy_Post:function () {
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=project_export&list=Copy";
                post_url(url,_that.Copy_data,true,true).then(res => {
                    $('#Copy_project').hide();
                    _that.Getproject_list();
                    _that.Get_project_number();
                    _that.Get_project_numberDay();
                },error=>{});
            },
            CompleteProjectPost:function () {
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=project&list=Complete";

                post_url(url,_that.Complete_data,true,true).then(res => {
                    $('#Complete_project').hide();
                    _that.Getproject_list();
                    _that.Get_project_number();
                    _that.Get_project_numberDay();
                },error=>{});
            },
            Close_project_Post:function () {
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=project&list=Close";

                post_url(url,_that.Close_data,true,true).then(res => {
                    $('#Close_project').hide();
                    _that.Getproject_list();
                    _that.Get_project_number();
                    _that.Get_project_numberDay();
                },error=>{});
            },
            Delete_project_Post:function () {
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=project&list=Delete";
                post_url(url,_that.Delete_data,true,true).then(res => {
                    $('#Del_project').hide();
                    _that.Getproject_list();
                    _that.Get_project_number();
                    _that.Get_project_numberDay();
                },error=>{});
            },
            Collect:function (e) {
                event.cancelBubble = true;
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=project&list=Collect";
                post_url(url,{key_id:e.id},true,false).then(res => {
                    _that.Getproject_list();
                    _that.Get_project_number();
                    _that.Get_project_numberDay();
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
            },
            openProjectPicker:function() {
                this.$refs.dateProjectTime.focus()
            },
            addProjectTime:function () {
                var _that = this;
                console.log('时间区间')
                var start_time    =   _that.getFormdate(_that.Project_time[0]);
                var end_time    =   _that.getFormdate(_that.Project_time[1]);
                _that.project_data.start_time   =   start_time;
                _that.project_data.end_time   =   end_time;

            },
            getFormdate:function (e) {
                const date = new Date(e);
                const year = date.getFullYear();
                const month = date.getMonth() + 1; // 月份是从0开始的
                const day = date.getDate();

                const formattedDate = `${year}-${month.toString().padStart(2, '0')}-${day.toString().padStart(2, '0')}`;
                return formattedDate;
            },
        },
        created(){
            // `this` 指向 vm 实例
            this.Getproject_list();
            this.Get_project_number();
            this.Get_project_numberDay();
            this.GetMessageNumber()
            this.GetResourcesAll()
        }
    })
    function selectCheck(node) {
        if ($(node).hasClass('ant-checkbox-checked')) {
            $(node).removeClass('ant-checkbox-checked')
        } else {
            $(node).addClass('ant-checkbox-checked')
        }
    }

    var chartDom = document.getElementById('main');
    var myChart = echarts.init(chartDom);
    var option = {
        color: ['#80FFA5'],
        tooltip: {
            trigger: 'axis',
            axisPointer: {
                type: 'cross',
                label: {
                    backgroundColor: '#6a7985'
                }
            }
        },
        grid:{
            show:false,
            top:'1%',    // 一下数值可为百分比也可为具体像素值
            right:'5%',
            bottom:'5%',
            left:'5%'
        },
        xAxis: [
            {
                type: 'category',
                boundaryGap: false,
                show:false,
                data: [
                    <? foreach ($Day_list as $item){?>
                    '<?=$item?>',
                    <? }?>
                ]
            }
        ],
        yAxis: [
            {
                splitLine:{
                    show:false //去掉网格线
                },
                type: 'value',
                show:false
            }
        ],
        series: [
            {
                name: '项目数量',
                type: 'line',
                stack: 'Total',
                smooth: false,
                lineStyle: {
                    width: 0
                },
                showSymbol: false,
                areaStyle: {
                    opacity: 0.8,
                    color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [
                        {
                            offset: 0,
                            color: 'rgb(128, 255, 165)'
                        },
                        {
                            offset: 1,
                            color: 'rgb(1, 191, 236)'
                        }
                    ])
                },
                emphasis: {
                    focus: 'series'
                },
                data: [0, 0, 0, 0, 0, 0, 0]
            },

        ]
    };

    option && myChart.setOption(option);
    myChart.resize();

    function Set_code(e,type) {
        var option = {

            series: [
                {
                    name: type,
                    type: 'line',
                    stack: 'Total',
                    smooth: false,
                    lineStyle: {
                        width: 0
                    },
                    showSymbol: false,
                    areaStyle: {
                        opacity: 0.8,
                        color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [
                            {
                                offset: 0,
                                color: 'rgb(128, 255, 165)'
                            },
                            {
                                offset: 1,
                                color: 'rgb(1, 191, 236)'
                            }
                        ])
                    },
                    emphasis: {
                        focus: 'series'
                    },
                    data: e
                },

            ]
        };

        myChart.setOption(option)
        myChart.resize();


    }



</script>