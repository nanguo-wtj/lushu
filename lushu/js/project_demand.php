
<script>
    new Vue({
        el: '#webMain',
        data: {
            key_id:'<?=$key_id?>',
            day:1,
            project_data:{
                title:  '2023测试数据',
                content:  '<p>测试</p>',
            },
            day_list:[],
            edit_demand_show: false,
            project:{
                basicTableList:[


                ],
                customizeTableList:[

                ],
                peopleList: [

                ]
            },
            project_code: {},
            people:{
                name:''
            },
            project_log:[],
            project_log_status:false,
            project_log_data:'',
            project_log_code:{
                'key':0,
                'index':0
            },
            release:{
                WeChatView_url:'',
                WeChatView_img_url:'',
            }
        },
        methods: {
            GetProjectData:function () {
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=project&list=Project_data";
                post_url(url,{key_id:_that.key_id},false,true).then(res => {
                    console.log('项目详情');
                    console.log(res);
                    _that.project_data.title          =   res.data.title;
                    _that.project_data.user           =   res.data.user;
                    _that.project_data.time           =   res.data.time;
                    _that.project_data.departure      =   res.data.departure;
                    _that.project_data.day            =   res.data.day;
                    _that.project_data.city           =   res.data.city;
                    this.$set(_that.project_data,'is_sale',res.data.is_sale);

                },error=>{
                    // Jump_url('./');
                });
            },
            editDemandClick() {

                if(this.project_data.is_sale == 1){
                    PopUpPrompt('该项目已关闭，需要恢复制作中状态才可进行编辑!',7);
                    return false;
                }
                if(this.project_data.is_sale == 2){
                    PopUpPrompt('该项目已完成，需要恢复制作中状态才可进行编辑!',7);
                    return false;
                }

                $('#edit_demand_show').show();
                this.GetProjectDemand();
            },
            Get_ProjectLog:function (){
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=project&list=Project_log";
                post_url(url,{key_id:_that.key_id},false).then(res => {
                    _that.project_log  =   res.data;
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
            GetProjectDemand:function () {
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=project_information&list=demand";
                post_url(url,{key_id:_that.key_id},false,true).then(res => {
                    _that.project.basicTableList          =   res.data.basicTableList;
                    _that.project.customizeTableList          =   res.data.customizeTableList;
                    _that.project.peopleList          =   res.data.peopleList;
                    _that.project_code          =   res.data.project_code;
                    if(_that.project_code.user.length < 1){
                        _that.project_code.user.push('')
                    }
                },error=>{
                    // Jump_url('./');
                });
            },
            EditDemand:function () {
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=project_information&list=EditDemand";
                post_url(url,{key_id:_that.key_id,data:_that.project_code},false).then(res => {
                    _that.close_EditDemand();
                    _that.GetProjectDemand();

                },error=>{
                    // Jump_url('./');
                });
            },
            AddUser:function (e) {
                if(!e){
                    PopUpPrompt('请填写当前内容！',7);
                    return false;
                }
                var _that   =   this;
                _that.project_code.user.push('');

            },
            DelUser:function (e) {
                var _that   =   this;
                _that.project_code.user.splice(e, 1);
            },
            close_EditDemand:function () {
                $('#edit_demand_show').hide();
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
            }



        },
        created(){
            $('.LOADING').css('display','none')
            this.GetProjectData();
            this.Get_ProjectLog();
            this.GetProjectDemand();


        }
    })



</script>
