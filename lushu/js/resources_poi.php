<script>

    const vm = new Vue({
        el: '#webMain',
        data: {
            resources_List:[

            ],
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
            project_city:'',
            project_data:{
                title: "",
                en_title: "",
                other_title: "",
                map_address: "",
                address: '',
                address_code:[],
                provincial: "",
                city: "",
                areas: "",
                type: 1,
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
            project_type:[
                {
                    name:'餐饮',
                    class_s:'icon-tag-1-food',
                    status:true
                },
                {
                    name:'游览',
                    class_s:'icon-tag-4-tour',
                    status:false
                },
                {
                    name:'购物',
                    class_s:'icon-tag-5-shopping',
                    status:false
                },

                {
                    name:'娱乐',
                    class_s:'icon-tag-6-entertainment',
                    status:false
                },

                {
                    name:'住宿',
                    class_s:'icon-tag-2-hotel',
                    status:false
                },

                {
                    name:'交通',
                    class_s:'icon-tag-3-traveling',
                    status:false
                },

            ],
            label:[{
                id:1,
                label:'正在加载中请稍等！',
                status:false
            }]
            ,label_data:'',
            price_list_status:0,
            search_address_status:false,
            city_address: {
                city: [],
                user: []
            },
            search_data:{
                poi_value:'',
                poi_list:[]
            },
            message_number:0,
            message_list:[],
            message_data:{},
            page_list:{}
        },
        methods: {
            search_city:function(e){
                var _that   =   this;
                _that.city_list1_status   =   false;
                _that.city_list2_status   =   false;
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
                    if(e == 1){
                        _that.city_list1.city   =   res.data.default;
                        _that.city_list1.user   =   res.data.user;
                        _that.city_list1_status   =   true;
                    }else {
                        _that.city_list2.city   =   res.data.default;
                        _that.city_list2.user   =   res.data.user;
                        _that.city_list2_status   =   true;
                    }
                },error=>{
                    _that.projet_name = '';
                });
            },
            add_address:function (a,e){
                var _that   =   this;
                _that.city_list1_status   =   false
                var city    =   {
                    id:a.id,
                    value:a.region_name
                };
                try{
                    _that.project_data.address_code.forEach(function(item, index, arr) {
                        if(item.id === a.id) {
                            throw new Error('当前已有目标城市！')
                        }
                    });
                    _that.project_data.address_code.push(city);
                } catch (e) {
                    console.log(e.message);
                }
                _that.project_city = '';

            },
            get_label:function () {
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=resource_list&list=label";
                var data = {
                    type: 1
                }
                post_url(url,data,false).then(res => {
                    _that.label = res.data.list
                },error=>{

                });
            },
            add_label:function (){
                var _that   =   this;
                if(!_that.label_data){
                    return false;
                }
                const url   =   "<?=$_Post_url?>?cmd=label&list=label_add";
                var data = {
                    label: _that.label_data,
                    type: 1
                }
                post_url(url,data,false).then(res => {
                    var str = {
                        id:res.data.key_id,
                        label:res.data.value,
                        status:true
                    }
                    _that.label.push(str)
                    _that.project_data.label.push(str)
                    _that.label_data    =   '';
                },error=>{

                });

            },
            post_poi(){
                console.log(this.project_data)
                const url   =   "<?=$_Post_url?>?cmd=resource&list=add";
                post_url(url,this.project_data,true).then(res => {
                    over_Time_url('/lushu/resources_poi_details.html?key_id='+res.data.key_id,500);
                },error=>{

                });
            },
            del_city:function (e) {
                var _that   =   this;
                console.log(e);
                var str = _that.project_data.address_code;
                str.forEach(function(item, index, arr) {
                    if(item.id === e.id) {
                        arr.splice(index, 1);
                    }
                });

                _that.project_data.address_code  =   str;
            },
            del_label:function (e) {
                var _that   =   this;
                console.log(e);
                var str = _that.project_data.label;
                str.forEach(function(item, index, arr) {
                    if(item.id === e.id) {
                        arr.splice(index, 1);
                    }
                });
                _that.label.forEach(function(item, index, arr) {
                    if(item.id === e.id) {
                        item.status = false;
                    }
                });
                _that.project_data.label  =   str;
            },
            GetResourcesList:function () {
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=resource_list&list=resource";

                post_url(url,_that.resources_key,false,true).then(res => {
                    _that.resources_List   =   res.data.list
                    _that.GetListNumber();
                },error=>{
                    _that.resources_List = [];
                });
            },
            GetListNumber:function(e){
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=resource_list&list=resource_number";

                post_url(url,_that.resources_key,false,true).then(res => {
                    _that.page_list   =   res.data.list;
                },error=>{
                    _that.page_list = {
                        previous:false,
                        next:false,
                        body:[]
                    };
                });

            },
            GetPreviouspage:function () {
                var _that   =   this;
                if(_that.page_list.previous == false){
                    return false;
                }
                _that.resources_key.page--;
                _that.GetResourcesList();
            },
            GetNextpage:function () {
                var _that   =   this;
                if(_that.page_list.next == false){
                    return false;
                }
                _that.resources_key.page++;
                _that.GetResourcesList();
            },
            GetPage:function (e) {
                var _that   =   this;
                _that.resources_key.page = e;
                _that.GetResourcesList();
            },
            Set_project_type:function (e,a){
                this.project_data.type  =   a;
                this.project_type.forEach(function (item,a) {
                    item.status = false;
                })
                e.status = true;
            },
            add_project_label:function (e) {
                var _that   =   this;
                e.status = true;
                var str = {
                    id:e.id,
                    label:e.label
                }
                try{
                    _that.project_data.label.forEach(function(item, index, arr) {
                        if(item.id === e.id) {
                            throw new Error('当前已有目标标签！')
                        }
                    });
                    _that.project_data.label.push(str);
                } catch (e) {
                    console.log(e.message);
                }
            },
            del_price_list:function (e) {
                var _that   =   this;
                var number = _that.project_data.price_list.length;
                if(e == (number-1)){
                    return false;
                }
                _that.project_data.price_list.splice(e, 1);
                _that.price_list_status =   number-2;

            },
            add_price_list:function (a,e){
                var _that   =   this;
                if(!a.title && !a.value){
                    return  false;
                }
                if(e < _that.price_list_status){
                    return false;
                }
                _that.price_list_status++;
                var str =   {
                    title: "",
                    value: ''
                };
                _that.project_data.price_list.push(str);

            },
            get_details(e){
                Jump_url('/lushu/resources_poi_details.html?key_id='+e);

            },
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
                _that.resources_key.page = 1;


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
            search_address_map:function () {
                var _that   =   this;
                $('#searchResultsPopup').show()
                if(!_that.project_data.address){
                    return false;
                }
                if(_that.search_data.poi_value == _that.project_data.address){
                    return  false;
                }
                var iframe =    $("#map_edit")[0];
                _that.search_data.poi_value =   _that.project_data.address;
                iframe.contentWindow.autoInput(_that.project_data.address).then(res => {
                    console.log(res)
                    _that.search_data.poi_list =   res.tips;
                },error=>{

                    _that.search_data.poi_list =   [];
                });


            },
            add_poi_address:function (e) {
                var _that   =   this;
                _that.project_data.map_address   =   e.location.lng+','+e.location.lat
                _that.project_data.address   =   e.name+','+e.district;
                _that.search_data.poi_list   =   [];
                var iframe =    $("#map_edit")[0];
                _that.search_data.poi_value =   _that.project_data.address;
                var code    =   iframe.contentWindow.set_poi_maker(e.name,e.location.lng,e.location.lat);
                code.on('dragend', function() {//拖动坐标获取新坐标
                    var number  =   iframe.contentWindow.get_adderss_number(code);
                    iframe.contentWindow.Set_Center(number.lng,number.lat);
                    _that.project_data.map_address   =   number.lng+','+number.lat

                    console.log('最新坐标：',number )
                });
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
            SetContent:function (e) {
                this.project_data.guide  = e;
            }
        },
        created(){
            // `this` 指向 vm 实例
            this.GetResourcesList();
            this.get_label();
            this.GetMessageNumber()

        }
    })

    $('#webMain').click(function () {
        $(".label").hide(); //如果可见则隐藏
        $("#search_city").hide(); //如果可见则隐藏
        $('.city_body').hide()
    })



    const E = window.wangEditor

    window.editor = E.createEditor({
        selector: '#div4',
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
                vm.SetContent(editor.getHtml())
                // 选中文字
            }
        }
    })

    window.toolbar = E.createToolbar({
        editor,
        selector: '#div3',
        config: {
            excludeKeys: ['headerSelect','group-more-style','group-more-style','color','bgColor','|','fontFamily','lineHeight','bulletedList','numberedList','todo','group-indent',
                'emotion',"insertTable","codeBlock","divider","undo","redo","fullScreen"
            ],
        }
    })

</script>
