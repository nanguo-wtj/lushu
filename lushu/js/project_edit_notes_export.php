<!-- 引入样式 -->
<!--    <link rel="stylesheet" href="https://unpkg.com/element-ui/lib/theme-chalk/index.css">-->
<!-- 引入组件库 -->
<!--    <script src="https://unpkg.com/element-ui/lib/index.js"></script>-->

<script>
    new Vue({
        el: '#webMain',
        data: {
            key_id:'<?=$key_id?>',
            day:1,
            project_data:{
                title:  '2023测试数据',
                content:  '<p>测试</p>',
                startTime:'',
                dayNum: 2,
                startCity: '',
                endCity: '',
                cover: '',
                IDCard: '1223422'
            },
            day_list:[],
            data:{
                Highlights_id:[],
                note_id:[],
                Highlights_list:[

                ],
                note_list:[

                ],
            },
            list:{
                Highlights_list:[

                ],
                trip_list:[

                ],
                note_list:[

                ],
                img_list:[

                ],
                source_list:[

                ],
                note_status:true,
                img_status:false,
                note_note_status:true,
                note_source_status:false

            },
            city_list:[],
            city:{
                page:1,
                key:'',
            },
            city_path:[],
            city_path_list:[],
            city_path_list_value:[],
            polyline:'',
            city_day:{
                city:0,
                data:'',
                day:1
            },
            // 项目信息
            project:{
                title:'',
                startTime:'',
                dayNum: 2,
                startCity: '',
                endCity: '',
                content: '',
                IDCard: '1223422',
                url: '',
            },
            setShow: false,
            exportShow: false,
            expInfo: {
                title: 123,
                labelList: [],
                marks: [{}]
            },

            checkedCities: [],
            checkAll: false,
            cities: ['行程总览', 'D1', '行程备注', '关联行程报价'],
            isIndeterminate: false,
            // 添加标签
            addBQ: false,
            // 标签内容
            BQcont: '',
            // 导入

            tagList: [{}],
            search_note_data:{
                title:'',
                page:1,
                status:true
            },
            search_picture_data:{
                title:'',
                page:1,
                status:true
            },
            searchContentDate:"",
            ExportList:[],
            ExportListData:[],
            ExportData:{
                page:1,
                title:'',
                page_status:true
            },
            import_data:{
                key_id  :   0,
                day  :   [],
                itinerary:  false,
                notes:  false,
                quotation:  false,
                tage:[],
            },
            importShow: false,
            isImpIndeterminate: false,
            impCheckAll: false,
            tagList: [{}],
            export_day:[],
            export_data:{
                title   :   '',
                key_id  :   0,
                day  :   [],
                itinerary:  false,
                notes:  false,
                quotation:  false,
                tage:[],
            },
            AllExport:false,
            AllImport:false,
            search_Itinerary_data:{
                title:'',
                page:1,
                status:true
            },
            details_note :{
                title:'',
                content:'',
                association:[],
                address:[]
            },
        },
        methods: {
            upfile(file) {
                console.log(file)
                // 上传
                // 修改styleObject 修改project.cover x修改 styleObjec.background值为图片地址
            },
            // 打开信息设置
            setProject() {
                // 查询项目信息
                // 打开设置页面
                this.Getproject_data();
                this.setShow = true
            },
            // 保存信息设置
            saveSet() {
                this.Setproject_data();
            },
            // 导出
            expClick() {
                // 查询项目信息
                // 打开导出页面
                this.exportShow = true;
                $('#exportShow').show();

            },

            handleCheckAllChange(val) {
                this.checkedCities = val ? this.cities : [];
                this.isIndeterminate = false;
            },
            handleCheckedCitiesChange(value) {
                let checkedCount = value.length;
                this.checkAll = checkedCount === this.cities.length;
                this.isIndeterminate = checkedCount > 0 && checkedCount < this.cities.length;
            },

            handleImpCheckAllChange(val) {
                this.checkedCities = val ? this.cities : [];
                this.isImpIndeterminate = false;
            },
            handleImpCheckedCitiesChange(value) {
                let checkedCount = value.length;
                this.impCheckAll = checkedCount === this.cities.length;
                this.isImpIndeterminate = checkedCount > 0 && checkedCount < this.cities.length;
            },
            // 添加标签
            addMark() {
                // 标签内容 this.BQcont

                if (!this.BQcont) {
                    this.$message({
                        message: '请输入标签',
                        type: 'warning'
                    })
                    return
                }
                // 储存标签

                this.expInfo.marks.push({})
                this.addBQ = false
                this.BQcont = ''

            },
            get_content:function (e) {
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=resource_list&list=note";
                _that.search_note_data.key_id = _that.key_id;
                if(e){
                    _that.search_note_data.page = e;
                }
                post_url(url,_that.search_note_data,false,true).then(res => {

                    if(res.data.list.length < 1){
                        _that.search_note_data.page--;
                        _that.search_note_data.status = false;

                        return  PopUpPrompt('前面已经没有了！',7);

                    }else {
                        _that.search_note_data.status = true;
                        _that.list.note_list  =   [];
                        res.data.list.forEach(function(item, index, arr) {
                            var str =     {
                                'id'        :   item.id,
                                'url'       :   item.url,
                                'title'     :   item.title,
                                'content'      :   item.notes,
                                'user'      :   item.user,
                                'status'    :   false
                            }
                            if(_that.data.note_id.indexOf(item.id) >= 0) {
                                str.status   =   true;
                            }
                            _that.list.note_list.push(str);
                        });
                    }

                },error=>{
                    Jump_url('./');
                });
            },

            get_img:function () {
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=resource_list&list=picture";
                _that.search_picture_data.key_id = _that.key_id;

                post_url(url,_that.search_picture_data,false).then(res => {

                    if(res.data.list.length < 1){
                        if(_that.search_picture_data.page > 1){
                            _that.search_picture_data.page--;
                        }
                        _that.search_picture_data.status = false;
                        return  PopUpPrompt('前面已经没有了！',7);
                    }else {
                        _that.search_picture_data.status = true;
                        _that.list.img_list  =   res.data.list;
                    }
                },error=>{
                    //Jump_url('./');
                });
            },
            add_content:function (e,b) {
                event.cancelBubble = true;
                console.log('e',e);
                setTimeout(() => {
                    this.$forceUpdate()
                },500)

            },
            add_list_content:function (e) {
                var _that   =   this;
                console.log(_that.list.img_status);
            },
            get_day:function (e) {
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=project_export&list=GetDay";
                post_url(url,{key_id:_that.key_id},false,true).then(res => {
                    _that.day_list  =   res.data.day;
                },error=>{
                    //Jump_url('./');
                });
            },
            GetItinerary:function (e) {
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=project_export&list=GetItinerary_notes";
                post_url(url,{key_id:_that.key_id},false).then(res => {
                    _that.project_data.title  =   res.data.title;
                    _that.data.Highlights_list  =   res.data.Highlights;
                    _that.data.note_list  =   res.data.note;
                    _that.data.Highlights_id  =   res.data.Highlights_id;
                    _that.data.note_id  =   res.data.note_id;
                    _that.project_data.content  =   res.data.content;
                    SetWangeditordata(res.data.content)
                },error=>{
                    //Jump_url('./');
                });
            },


            add_project_note:function (e) {
                event.cancelBubble = true;
                console.log(e)
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=export&list=add_note_notes";
                post_url(url,{key_id:_that.key_id,note_id:e.id},true).then(res => {
                    e.status = true;
                    var str =   {
                        'id'        :   e.id,
                        'url'       :   e.url,
                        'title'     :   e.title,
                        'user'      :   e.user,
                        'content'   :   e.content
                    };
                    _that.data.note_list.push(str)
                },error=>{

                });
            },
            del_project_note:function (e,c) {
                event.cancelBubble = true;
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=export&list=del_note_notes";
                post_url(url,{key_id:_that.key_id,note_id:e.id},true).then(res => {
                    if(c){
                        _that.list.note_list.forEach(function(item, index, arr) {
                            if(item.id == e.id){
                                item.status = false;
                            }
                        });
                    }
                    _that.data.note_list.forEach(function(item, index, arr) {
                        if(item.id == e.id){
                            _that.data.note_list.splice(index, 1);
                        }
                    });

                },error=>{

                });
            },
            get_project_day:function (e){
                if(!e){
                    location.href   =   'project_edit_export.html?key_id='+this.key_id;
                }else {
                    location.href   =   'project_edit_day_export.html?key_id='+this.key_id+'&day='+e;
                }
            },
            get_day_list:function (){
                $('#project_data_day_city').show();
                this.get_city_list();
                this.get_project_city_list();

            },
            getPreviousPage:function () {
                var _that   =   this;
                if(_that.city.page == 1){
                    return  PopUpPrompt('前面已经没有了！',7);
                }
                _that.city.page  = _that.city.page-1;
                _that.get_city_list();
            },
            getNextPage:function (){
                var _that   =   this;
                // if(_that.city.page == 1){
                //     return  PopUpPrompt('前面已经没有了！',7);
                // }

                _that.city.page  = _that.city.page+1;
                _that.get_city_list();
            },
            get_city_list:function () {
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=resource_list&list=city_all";
                post_url(url,{page:_that.city.page,title:_that.city.key,project_id:_that.key_id},false).then(res => {
                    _that.city_list  =   res.data.list;
                    $('.editRoute__content___1Vp4N').scrollTop(0);
                    _that.del_city_day();
                },error=>{

                });
            },
            get_project_city_list:function () {
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=resource_list&list=project_city";
                post_url(url,{key_id:_that.key_id},false).then(res => {
                    _that.city_path = res.data.city;
                    _that.city_path_list = res.data.map_list;
                    _that.set_city();
                },error=>{

                });
            },
            add_city:function (e) {
                var _that   =   this;
                var code = [e.lng,e.lat];
                if(e.status == true){
                    e.status = false;
                }else {
                    e.status = true;
                }
                const url   =   "<?=$_Post_url?>?cmd=export&list=add_day_city";
                post_url(url,{key_id:_that.key_id,city_id:e.id,day:_that.day,number:_that.city_day.day},true).then(res => {
                    _that.get_project_city_list()
                    _that.get_day()
                },error=>{
                    return false
                });

            },
            close_prject_day_city:function () {

                this.day = 1;
                $('#project_data_day_city').hide()
            },
            set_city:function () {
                var _that   =   this;
                var iframe =    $("#map_edit")[0];
                if(_that.polyline){
                    iframe.contentWindow.del_city(_that.polyline);
                }
                if(_that.city_path_list_value){
                    _that.city_path_list_value.forEach(function(item, index) {
                        iframe.contentWindow.del_city(item);
                    });
                }
                var path = _that.city_path;
                _that.polyline    =   iframe.contentWindow.get_city(path);
                iframe.contentWindow.set_city(_that.polyline)
                _that.city_path_list_value    =   iframe.contentWindow.set_city_list(_that.city_path_list)
            },
            add_city_day:function (e) {
                var _that   =   this;
                if(_that.city_day.city){
                    $('#city_day'+_that.city_day.city).hide();
                    $('#city_'+_that.city_day.city).removeClass('editRoute__focused___1HBab');
                }
                _that.city_day.city =   e;
                $('#city_'+e).addClass('editRoute__focused___1HBab');
                $('#city_day'+e).show();
            },
            del_city_day_code:function (a,b,c) {
                var _that   =   this;
                console.log(a);
                console.log(b);
                console.log(c);
                const url   =   "<?=$_Post_url?>?cmd=export&list=del_day_city";
                post_url(url,{key_id:_that.key_id,city_id:b,day:a,key:c},true).then(res => {
                    _that.get_project_city_list()
                    _that.get_day()
                },error=>{
                    return false
                });
                window.event.stopPropagation()
            },
            del_city_day:function () {
                var _that   =   this;
                try{
                    $('#city_day'+_that.city_day.city).hide();
                    $('#city_'+_that.city_day.city).removeClass('editRoute__focused___1HBab');
                }catch (e) {
                    console.log(e);
                }
                _that.city_day.city =   0;
                _that.city_day.day =   1;
                window.event.stopPropagation()
            },
            get_day_code:function (e) {
                var _that   =   this;
                _that.day   =    e.day;
                _that.day_list.forEach(function(item, index, arr) {
                    item.status =   false;
                });
                e.status    =   true;
            },
            Post_content:function (){
                var _that   =   this;
                var content =   $('#editor-content').val();
                const url   =   "<?=$_Post_url?>?cmd=export&list=add_project_content_notes";
                post_url(url,{key_id:_that.key_id,content:content},true,true).then(res => {
                    this.GetItinerary();
                    $('.XCJS').hide();
                },error=>{
                    return false
                });
            },
            Getproject_data:function () {
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=project_export&list=Project_datas";
                post_url(url,{key_id:_that.key_id},false,true).then(res => {
                    _that.project   =   res.data;
                },error=>{
                    return false
                });
            },
            Setproject_data:function () {
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=project_export&list=editProject";
                var code = _that.project;
                code.key_id =  _that.key_id
                post_url(url,code,true,true).then(res => {
                    this.get_day();
                    this.GetItinerary();
                    this.get_content();
                    this.setShow = false

                },error=>{
                    return false
                });
            },
            upFile2:function() {
                var _that   =   this;
                $('#img2').hide()
                $('#img3').show()
                const url   =   "<?=$_Post_url?>?cmd=tool&list=picture";
                post_ImgFile('img3',url).then(res => {
                    _that.project.url   =  res;
                },error=>{
                    return false
                });



            },
            add_project_day:function () {
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=project_export&list=add_project_day";
                post_url(url,{key_id:_that.key_id},false,true).then(res => {
                    _that.get_project_city_list()
                    _that.get_day()
                },error=>{
                    return false
                });

            },
            del_project_daynumber:function (e) {
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=project_export&list=del_project_day";
                post_url(url,{key_id:_that.key_id,day:e.day},false,true).then(res => {
                    _that.get_project_city_list()

                    _that.get_day()
                },error=>{
                    return false
                });
            },
            previousPageNotes:function () {
                if(this.search_note_data.page < 2){
                    return false;
                }
                this.search_note_data.page--;
                this.search_note_data.status = true;
                this.get_content();
            },
            nextPageNotes:function () {
                if(this.search_note_data.status == false){
                    return false;
                }
                this.search_note_data.page++;
                this.get_content();
            },
            previousPagePicture:function () {
                if(this.search_picture_data.page < 2){
                    return false;
                }
                this.search_picture_data.page--;
                this.search_picture_data.status = true;
                this.get_img();
            },
            nextPagePicture:function () {
                if(this.search_picture_data.status == false){
                    return false;
                }
                this.search_picture_data.page++;

                this.get_img();
            },
            searchContent:function () {
                this.search_picture_data.title = this.searchContentDate;
                this.search_note_data.title = this.searchContentDate;
                this.get_content();
                this.get_img();
            },
            previousPageItinerary:function () {
                if(this.search_Itinerary_data.page < 2){
                    return false;
                }
                this.search_Itinerary_data.page--;
                this.search_Itinerary_data.status = true;
                this.Get_Seach_Itinerary();
            },
            nextPageItinerary:function () {
                if(this.search_note_data.status == false){
                    return false;
                }
                this.search_Itinerary_data.page++;
                this.Get_Seach_Itinerary();
            },
            switch_Itinerary:function (e) {
                var _that   =   this;
                if(e == 1){
                    _that.list.img_status = false;
                    _that.list.note_status=true;
                    // _that.search_Itinerary_data.title = ''
                }else {
                    _that.list.img_status = true;
                    _that.list.note_status=false;
                    // _that.search_Itinerary_data.title = ''
                }
                _that.Get_Seach_Itinerary();
            },
            Getdetails_note_data:function (e) {
                var _that = this;
                const url = "<?=$_Post_url?>?cmd=resource_details&list=note";
                post_url(url,{key_id:e},false,true).then(res => {
                    _that.details_note = res.data;
                    $('#note_details').show()
                },error=>{
                });
            },
        },
        created(){
            this.get_day();
            this.GetItinerary();
            this.get_content();
            this.get_img();
        }
    })



    $('#webMain').click(function () {
        $(".label").hide(); //如果可见则隐藏
        $("#search_city").hide(); //如果可见则隐藏
        $('.city_body').hide()
    })
    const E = window.wangEditor

    window.editor = E.createEditor({
        selector: '#wangeditor_content',
        html: '',
        config: {
            placeholder: '请输入...',
            MENU_CONF: {
                uploadImage: {
                    server: "<?=$_Post_url?>?cmd=tool&list=file",
                    timeout: 5 * 1000, // 5s
                    fieldName: 'file',
                    meta: { token: 'xxx', a: 100 },
                    metaWithUrl: true, // join params to url
                    headers: { Accept: 'text/x-json' },
                    maxFileSize: 10 * 1024 * 1024, // 10M
                    base64LimitSize: 5 * 1024, // insert base64 format, if file's size less than 5kb
                    onBeforeUpload(file) {
                        console.log('onBeforeUpload', file)
                        return file // will upload this file
                    },
                    onProgress(progress) {
                        console.log('onProgress', progress)
                    },
                    onSuccess(file, res) {
                        console.log('onSuccess', file, res)
                    },
                    onFailed(file, res) {
                        alert(res.message)
                        console.log('onFailed', file, res)
                    },
                    onError(file, err, res) {
                        alert(err.message)
                        console.error('onError', file, err, res)
                    },
                },
                uploadVideo: {
                    server: "<?=$_Post_url?>?cmd=tool&list=file",
                    timeout: 5 * 1000, // 5s
                    fieldName: 'file',
                    meta: { token: 'xxx', a: 100 },
                    metaWithUrl: true, // join params to url
                    headers: { Accept: 'text/x-json' },

                    maxFileSize: 100 * 1024 * 1024, // 10M

                    onBeforeUpload(file) {
                        console.log('onBeforeUpload', file)

                        return file // will upload this file
                        // return false // prevent upload
                    },
                    onProgress(progress) {
                        console.log('onProgress', progress)
                    },
                    onSuccess(file, res) {
                        console.log('onSuccess', file, res)
                    },
                    onFailed(file, res) {
                        alert(res.message)
                        console.log('onFailed', file, res)
                    },
                    onError(file, err, res) {
                        alert(err.message)
                        console.error('onError', file, err, res)
                    }
                }
            },
            onChange(editor) {
                $('#editor-content').val(editor.getHtml())
            }
        }
    })

    window.toolbar = E.createToolbar({
        editor,
        selector: '#wangeditor_column',
        config: {
            excludeKeys: ['headerSelect','group-more-style','group-more-style','color','bgColor','|','fontFamily','lineHeight','bulletedList','numberedList','todo','group-indent',
                'emotion',"insertTable","codeBlock","divider","undo","redo","fullScreen"
            ],
        }
    })

    function SetWangeditordata(e) {
        editor.setHtml(e)
    }
    function addImage(e) {
        var str =   "<img src='"+e.url+"'  >"
        var htmlStr = editor.getHtml() + str
        editor.setHtml(htmlStr)
    }
    function addNode(e){
        var htmlStr = editor.getHtml() + e.content
        editor.setHtml(htmlStr)
    }

</script>

