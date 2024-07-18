<script>
    new Vue({
        el: '#webMain',
        data: {
            key_id:'<?=$key_id?>',
            project_data:{
                title:  '2023测试数据',

            },
            Itinerary:[],
            day_list:[],
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
            copy_data: {
                title: '',

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
        },
        methods: {
            GetProjectData:function () {
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=project_export&list=Project_data";
                post_url(url,{key_id:_that.key_id},false,true).then(res => {
                    console.log('项目详情');
                    console.log(res);
                  _that.project_data.title          =   res.data.title;
                  _that.copy_data.title          =   res.data.title;
                  _that.project_data.user           =   res.data.user;
                  _that.project_data.time           =   res.data.time;
                  _that.project_data.departure      =   res.data.departure;
                  _that.project_data.day            =   res.data.day;
                  _that.project_data.city           =   res.data.city;
                  _that.project_data.update_time           =   res.data.update_time;
                  _that.project_data.export_type           =   res.data.export_type;
                  _that.project_data.url           =   res.data.url;
                },error=>{
                    // Jump_url('./');
                });
            },
            GetProjectDay:function () {
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=project_export&list=TravelRoute";
                post_url(url,{key_id:_that.key_id},false).then(res => {
                    _that.day_list  =   res.data;
                },error=>{
                    // Jump_url('./');
                });
            },
            GetItinerary:function () {
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=project_export&list=GetItinerary";
                post_url(url,{key_id:_that.key_id},false).then(res => {
                    _that.Itinerary  =   res.data;
                },error=>{
                    // Jump_url('./');
                });
            },
            GetCost:function () {
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=project_export&list=Cost";
                post_url(url,{key_id:_that.key_id},false,true).then(res => {
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
                const url   =   "<?=$_Post_url?>?cmd=project_export&list=quotation";
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
                const url   =   "<?=$_Post_url?>?cmd=project_export&list=Const_quotation";
                post_url(url,{key_id:_that.key_id},false).then(res => {
                    _that.cost_list = res.data.list;
                },error=>{
                    return false
                });
            },
            GetNotIncludedList:function () {
                var _that = this;
                const url   =   "<?=$_Post_url?>?cmd=project_export&list=NotIncluded";
                post_url(url,{key_id:_that.key_id},false).then(res => {
                    _that.not_included = res.data.list;
                },error=>{
                    return false
                });
            },
            GetPaidItemsList:function () {
                var _that = this;
                const url   =   "<?=$_Post_url?>?cmd=project_export&list=PaidItems";
                post_url(url,{key_id:_that.key_id},false).then(res => {
                    _that.PaidItemsList = res.data.list;
                },error=>{
                    return false
                });
            },
            GetSupplementList:function () {
                var _that = this;
                const url   =   "<?=$_Post_url?>?cmd=project_export&list=supplement";
                post_url(url,{key_id:_that.key_id},false).then(res => {
                    _that.supplementdata = res.data.list;
                },error=>{
                    return false
                });
            },
            Setopenquotation:function () {
                var _that =   this;
                const url   =   "<?=$_Post_url?>?cmd=project_export&list=quotation_type";
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
            DelExportProject:function () {

                var _that =   this;
                const url   =   "<?=$_Post_url?>?cmd=project_export&list=DelExportPorject";
                post_url(url,{key_id:_that.key_id},true,true).then(res => {

                    setTimeout(function (){
                        Jump_url('./resources.html');
                    },500);
                },error=>{
                    return false
                });
            },
            ExportCopy:function () {
                var _that =   this;
                const url   =   "<?=$_Post_url?>?cmd=project_export&list=ExportCopy";
                post_url(url,{key_id:_that.key_id},true,true).then(res => {
                    setTimeout(function (){
                        Jump_url('./resources.html');
                    },500);
                },error=>{
                    return false
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
            }

        },
        created(){
            this.GetProjectData();
            this.GetProjectDay();
            this.GetItinerary();
        }
    })



</script>
