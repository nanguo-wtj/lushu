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
            release:{
                WeChatView_url:'',
                WeChatView_img_url:'',
            },
            Project_time:[]
        },
        methods: {
            Edit_project_post:function(){
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=project&list=detail";
                post_url(url,_that.project_data,true).then(res => {
                    over_Time_url('project_edit.html?key_id='+_that.project_data.key);
                },error=>{
                });
            },
            GetProjectData:function () {
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=project&list=Project_data";
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
                const url   =   "<?=$_Post_url?>?cmd=project&list=Project_day";
                post_url_no(url,{key_id:_that.key_id},false,true).then(res => {
                    _that.day_list  =   res.data.day;
                    _that.traffic_list  =   res.data.traffic;
                    _that.GetProjectData();

                },error=>{
                    $('#add_projects').show()

                });
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
            Get_ProjectLog:function (){
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=project&list=Project_log";
                post_url_no(url,{key_id:_that.key_id},false).then(res => {
                    _that.project_log  =   res.data;
                },error=>{
                    // Jump_url('./');
                });
            },
            Get_projectItinerary:function (){
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=project&list=GetItinerary";
                post_url_no(url,{key_id:_that.key_id},false).then(res => {
                    _that.project_list.OverviewOfItinerary  =   res.data;
                },error=>{
                    // Jump_url('./');
                });
            },
            Add_ProjectLogShow:function(e,a){
                var _that   =   this;
                _that.project_log_code.key    =   e.id;
                _that.project_log_code.index    =   a;
                _that.project_log_data =   '';

                $('.edit_mark').show();
                if(e.msg){
                    _that.project_log_status    =   true;
                    _that.project_log_data    =   e.msg;
                }
            },
            Add_ProjectLogPost:function (e){
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=project_auxiliary&list=project_log";
                post_url(url,{key_id:_that.project_log_code.key,project_id:_that.key_id,data:_that.project_log_data},true).then(res => {
                    _that.project_log[_that.project_log_code.index].msg   =   _that.project_log_data;
                    $('.edit_mark').css('display', 'none');
                    _that.project_log_status =   false;
                    _that.project_log_data =   '';
                },error=>{
                    // Jump_url('./');
                });
            },
            Del_ProjectLogPost:function (e){
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=project_auxiliary&list=project_log";
                post_url(url,{key_id:_that.project_log_code.key,project_id:_that.key_id,data:''},false).then(res => {
                    _that.project_log[_that.project_log_code.index].msg   =   '';
                    $('.edit_mark').css('display', 'none');
                    _that.project_log_status =   false;
                    _that.project_log_data =   '';
                },error=>{
                    // Jump_url('./');
                });
            },
            open_project:function () {
                if(this.project_data.is_sale == 1){
                    PopUpPrompt('该项目已关闭，需要恢复制作中状态才可进行编辑!',7);
                    return false;
                }
                if(this.project_data.is_sale == 2){
                    PopUpPrompt('该项目已完成，需要恢复制作中状态才可进行编辑!',7);
                    return false;
                }
                Jump_url('./project_edit.html?key_id='+this.key_id);

            },
            GetTravelRoute:function () {
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=project_information&list=TravelRoute";
                post_url_no(url,{key_id:_that.key_id},false,true).then(res => {
                    _that.TravelRoute   =   res.data
                },error=>{
                    // Jump_url('./');
                });
            },
            Getbooking:function () {
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=project_information&list=Getbooking";
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
            CompleteProjectPost:function () {
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=project&list=Complete";

                post_url(url,{key_id:_that.key_id},false,true).then(res => {
                    $('#setUp').hide();
                    $('#Complete_project').hide();
                    _that.GetProjectData();
                },error=>{});
            },
            Close_project_Post:function () {
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=project&list=Close";

                post_url(url,{key_id:_that.key_id},false,true).then(res => {
                    _that.GetProjectData();
                    $('#setUp').hide();
                    $('#Close_project').hide();
                },error=>{});
            },
            Delete_project_Post:function () {
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=project&list=Delete";
                post_url(url,{key_id:_that.key_id},false,true).then(res => {
                    over_Time_url('/lushu/project.html',1000);
                    $('#setUp').hide();
                    $('#Del_project').hide();
                },error=>{});
            },
            Restore_project_Post:function () {
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=project&list=Restore";
                post_url(url,{key_id:_that.key_id},false,true).then(res => {
                    _that.GetProjectData();
                    $('#setUp').hide();
                    $('#Restore').hide();
                },error=>{});
            },
            Getdetails_note_data:function (e) {
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=resource_details&list=note";
                post_url(url,{key_id:e},false,true).then(res => {
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
                const url   =   "<?=$_Post_url?>?cmd=resource_details&list=resource&type=view";
                post_url(url,{key_id:e},false,true).then(res => {
                    _that.details_poi =   res.data;
                    _that.details_poi.type =   res.data.type_id;
                    _that.details_poi.address_code =   res.data.address_code_list;
                    $('#poi_details').show();
                },error=>{
                });
            },
            Getdetails_Tripdata:function (e) {
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=resource_details&list=trip";
                post_url(url,{key_id:e},false,true).then(res => {
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
            WeChatView:function () {
                $('#WeChatView').show();
                let url = '<?=$_Home_url?>/lushu/share.html?key_id='+this.key_id;
                this.release.WeChatView_url =   url;
                this.release.WeChatView_img_url =  "<?=$_Post_url?>?cmd=tool&list=GetQRcode&v="+url;
            },
            PdfView:function () {
                Jump_new_url('./project_pdf_view.html?key_id='+this.key_id);
            },
            ItineraryView:function () {
                Jump_new_url('./Itinerary_view.html?key_id='+this.key_id);
            },
            ItineraryPdfView:function () {
                Jump_new_url('./Itinerary_pdf_view.html?key_id='+this.key_id);
            },
            copyInput:function() { // 获取要复制的input元素
                let input = document.getElementById('WeChatView_url'); // 选择input元素中的文本
                input.select();
                input.setSelectionRange(0, 99999);
                // 为了兼容不同长度的文本 // 尝试复制选中的文本
                try {
                    let successful = document.execCommand('copy');
                    if(successful) {
                        PopUpPrompt('成功复制到剪贴板',1);
                    }else {
                        PopUpPrompt('无法复制文本',3);

                    }

                } catch (err) {
                    let inputs = document.getElementById('WeChatView_url').value;

                    // 使用Clipboard API复制文本到剪贴板
                    navigator.clipboard.writeText(inputs).then(function() {
                        // 提示用户已成功复制
                        alert('');
                        PopUpPrompt('内容已复制到剪贴板',1);
                    }).catch(function(error) {
                        // 处理复制失败的情况
                        PopUpPrompt('复制失败',3);

                    });
                } // 取消选择，以免干扰用户
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
            this.GetProjectDay();
            this.Get_ProjectLog();
            this.Get_projectItinerary();
            this.GetTravelRoute();
            this.Getbooking();

        }
    })



</script>
