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
            project_log:[],
            project_log_status:false,
            project_log_data:'',
            project_log_code:{
                'key':0,
                'index':0
            },
            quotation_top:[],
            cost_list:[],
            not_included:[],
            PaidItemsList:[],
            supplementdata:{
                id:'',
                content:'',
            },
            quotation_top_list:[],
            quotation_top_id:0,
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
                    console.log(res.data);
                    _that.project_data          =   res.data;

                },error=>{
                    // Jump_url('./');
                });
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
            GetQuotationList:function () {
                var _that = this;
                const url   =   "<?=$_Post_url?>?cmd=project_quotation&list=quotation";
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
                const url   =   "<?=$_Post_url?>?cmd=project_quotation&list=Const";
                post_url(url,{key_id:_that.key_id},false).then(res => {
                    _that.cost_list = res.data.list;
                },error=>{
                    return false
                });
            },
            GetNotIncludedList:function () {
                var _that = this;
                const url   =   "<?=$_Post_url?>?cmd=project_quotation&list=NotIncluded";
                post_url(url,{key_id:_that.key_id},false).then(res => {
                    _that.not_included = res.data.list;
                },error=>{
                    return false
                });
            },
            GetPaidItemsList:function () {
                var _that = this;
                const url   =   "<?=$_Post_url?>?cmd=project_quotation&list=PaidItems";
                post_url(url,{key_id:_that.key_id},false).then(res => {
                    _that.PaidItemsList = res.data.list;
                },error=>{
                    return false
                });
            },
            GetSupplementList:function () {
                var _that = this;
                const url   =   "<?=$_Post_url?>?cmd=project_quotation&list=supplement";
                post_url(url,{key_id:_that.key_id},false).then(res => {
                    _that.supplementdata = res.data.list;
                },error=>{
                    return false
                });
            },
            openItinerary:function (e) {
                var _that =   this;
                _that.quotation_top_list = e.content;
                _that.quotation_top_id = e.id;
            },
            Setopenquotation:function () {
                var _that =   this;
                const url   =   "<?=$_Post_url?>?cmd=project_quotation&list=quotation_type";
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
            openQuotaion:function () {
                if(this.project_data.is_sale == 1){
                    PopUpPrompt('该项目已关闭，需要恢复制作中状态才可进行编辑!',7);
                    return false;
                }
                if(this.project_data.is_sale == 2){
                    PopUpPrompt('该项目已完成，需要恢复制作中状态才可进行编辑!',7);
                    return false;
                }
                Jump_url('./project_quotation_edit.html?key_id='+this.key_id);

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
            this.GetProjectData();
            this.Get_ProjectLog();
            this.Setopenquotation();
            this.GetQuotationList();
            this.GetConstList();
            this.GetNotIncludedList();
            this.GetPaidItemsList();
            this.GetSupplementList();
        }
    })



</script>
