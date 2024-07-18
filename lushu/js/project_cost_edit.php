<script>
    new Vue({
        el: '#webMain',
        data: {
            key_id:'<?=$key_id?>',
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
            list_code:{
                Traffic:[],
                Traffic_money:0,
                hotel:[],
                hotel_money:0,
                schedule:[],
                schedule_money:0,
                money:0,
            },
            cost_data:{
                key:'',
                types:'',
                day:'',
                title:'加载中请稍候',
                type:'交通方案',
                list:[]
            }
        },
        methods: {
            GetProjectData:function () {
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=project&list=Project_data";
                post_url(url,{key_id:_that.key_id},false,true).then(res => {
                    _that.project_data          =   res.data;
                },error=>{
                    // Jump_url('./');
                });
            },
            GetProject_Cost:function () {
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=project_information&list=Cost";
                post_url(url,{key_id:_that.key_id},false).then(res => {
                    _that.list_code.Traffic =   res.data.Traffic;
                    _that.list_code.Traffic_money =   res.data.Traffic_money;
                    _that.list_code.hotel =   res.data.hotel;
                    _that.list_code.hotel_money =   res.data.hotel_money;
                    _that.list_code.schedule =   res.data.schedule;
                    _that.list_code.schedule_money =   res.data.schedule_money;
                    _that.list_code.money =   res.data.Traffic_money+res.data.hotel_money+res.data.schedule_money;
                },error=>{
                    // Jump_url('./');
                });
            },
            openCostEdit:function (e,a,b,c) {
                $('.dlg').show();
                var _that   =   this;
                _that.cost_data.title    =   a;

                switch (c){
                    case 1:
                        _that.cost_data.type    =   '交通方案';
                        break;
                    case 2:
                        _that.cost_data.type    =   '酒店住宿';
                        break;
                    case 3:
                        _that.cost_data.type    =   '活动与服务';
                        break;
                    case 4:
                        _that.cost_data.type    =   'POI';
                        break;
                }
                _that.cost_data.key    =   e;
                _that.cost_data.day    =   b;
                _that.cost_data.types    =   c;
                const url   =   "<?=$_Post_url?>?cmd=project_information&list=GetDayClassCost";
                post_url(url,{key_id:_that.key_id,key:e,day:b,type:c},false).then(res => {
                   _that.cost_data.list =   res.data
                },error=>{
                    // Jump_url('./');
                });
            },
            del_cost_list:function (e) {
                this.cost_data.list.splice(e, 1);
            },
            add_cost_list:function () {
                var str =   {
                    name:   '',
                    price:  '',
                    number: ''
                }
                this.cost_data.list.push(str);
            },
            post_cost:function () {
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=project_information&list=AddDayClassCost";
                post_url(url,{key_id:_that.key_id,key:_that.cost_data.key,day:_that.cost_data.day,type:_that.cost_data.types,data:_that.cost_data.list},true,true).then(res => {
                    $('.dlg').css('display','none')
                    _that.cost_data =   {
                        key:'',
                        types:'',
                        day:'',
                        title:'加载中请稍候',
                        type:'交通方案',
                        list:[]
                    }
                    _that.GetProject_Cost();
                },error=>{
                    // Jump_url('./');
                });
            }




        },
        created(){
            this.GetProjectData();
            this.GetProject_Cost();

        }
    })



</script>
