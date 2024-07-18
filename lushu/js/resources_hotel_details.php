
<script>
    const vm = new Vue({
        el: '#webMain',
        data: {
            key_id:'<?=$key_id?>',
            project_city:'',
            resources_data:{
                title:'加载中....'
            },
            project_data:{
                key_id:'<?=$key_id?>',
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
                superior: "",
                rating: 0,
                facilities_s: [],
                policy: ""
            },
            city_list1: {
                city: [],
                user: []
            },
            city_list1_status:false,
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
            facilities:[
                {
                    name:'早餐',
                    class_s:'icon-hotelBreakfast',
                    status:false
                },
                {
                    name:'WIFI',
                    class_s:'icon-hotelWiFi',
                    status:false
                },
                {
                    name:'浴缸',
                    class_s:'icon-hotelBath',
                    status:false
                },
                {
                    name:'班车服务',
                    class_s:'icon-airportBus',
                    status:false
                },
                {
                    name:'风景',
                    class_s:'icon-hotelView',
                    status:false
                },
                {
                    name:'餐厅',
                    class_s:'icon-hotelRestaurant',
                    status:false
                },
                {
                    name:'健身房',
                    class_s:'icon-hotelFitnessCentre',
                    status:false
                },
                {
                    name:'游泳池',
                    class_s:'icon-hotelSwimmingPool',
                    status:false
                },
                {
                    name:'干洗',
                    class_s:'icon-hotelDryClean',
                    status:false
                },
                {
                    name:'停车场',
                    class_s:'icon-hotelParking',
                    status:false
                },


            ],
            label:[{
                id:1,
                label:'正在加载中请稍等！',
                status:false
            }],
            label_data:'',
            price_list_status:0,
            rating:0,
            search_data:{
                poi_value:'',
                poi_list:[]
            }
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
                    _that.label.forEach(function(item, index, arr) {
                        var stsuts  =   Get_inarray(item.id,_that.project_data.label);
                        if(stsuts == true) {
                            item.status = true;
                        }
                    });
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
                var _that   =   this;
                _that.project_data.policy    =   $('#policy').html();
                console.log(this.project_data)
                const url   =   "<?=$_Post_url?>?cmd=resource&list=hotel_add";
                post_url(url,this.project_data,true).then(res => {
                    hotel_close();
                    _that.GetResourcesdata();

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
            GetResourcesdata:function (e) {
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=resource_details&list=hotel";
                post_url(url,{key_id:_that.key_id},false,true).then(res => {
                    _that.resources_data   =   res.data;
                    _that.project_data.superior_id =   res.data.superior_id;
                    _that.project_data.title =   res.data.title;
                    _that.project_data.en_title =   res.data.en_title;
                    _that.project_data.other_title =   res.data.other_title;
                    _that.project_data.map_address =   res.data.map_address;
                    _that.project_data.address =   res.data.address;
                    _that.project_data.type =   res.data.type_id;
                    _that.project_data.phone =   res.data.phone;
                    _that.project_data.official_web =   res.data.official_web;
                    _that.project_data.opening_hours =   res.data.opening_hours;
                    _that.project_data.consumption =   res.data.consumption;
                    _that.project_data.traffic =   res.data.traffic;
                    _that.project_data.time_reference =   res.data.time_reference;
                    _that.project_data.introduction =   res.data.introduction;
                    _that.project_data.address_code =   res.data.address_code_list;
                    _that.project_data.label        =   res.data.label;
                    _that.project_data.price_list        =   res.data.price_list;
                    _that.project_data.rating        =   res.data.rating;
                    _that.rating        =   res.data.rating;
                    _that.project_data.lng        =   res.data.lng;
                    _that.project_data.lat        =   res.data.lat;
                    SetEditorContent(res.data.guide);
                    var number = _that.project_data.price_list.length;
                    _that.price_list_status =   number-1;
                    _that.project_data.facilities_s  =   res.data.facilities;
                    var facilities  =   res.data.facilities;
                    if(facilities.length > 0){
                        facilities.forEach(function(item, index, arr) {
                            if(item > 0){
                                _that.facilities[item].status = true;
                            }
                        });
                    }

                    $('#policy').html(res.data.policy)
                    console.log(res.data.policy);
                },error=>{
                });
            },
            Hotel_add:function () {
                var _that   =   this;
                $('#Hotel_add').show()
                setTimeout(function (){
                    var iframe =    $("#map_edit")[0];
                    console.log('坐标点')
                    console.log(_that.project_data.lng)
                    console.log(_that.project_data.lat)
                    iframe.contentWindow.Set_Center(_that.project_data.lng,_that.project_data.lat);
                    var code    =   iframe.contentWindow.set_poi_maker(1,_that.project_data.lng,_that.project_data.lat);
                    code.on('dragend', function() {//拖动坐标获取新坐标
                        var number  =   iframe.contentWindow.get_adderss_number(code);
                        iframe.contentWindow.Set_Center(number.lng,number.lat);
                        _that.project_data.map_address   =   number.lng+','+number.lat

                        console.log('最新坐标：',number )
                    });
                },1000);
            },
            Set_rating:function (e){
                var _that   =   this;
                var str =   e;
                _that.project_data.rating = str;
                _that.rating = str;

            },
            Set_project_facilities:function (e,a){
                var _that   =   this;
                var status  =   false;
                var key =   0;
                _that.project_data.facilities_s.forEach(function(item, index, arr) {
                    if(item === a) {
                        key =   index;
                        e.status = false;
                        status  =   true;
                    }
                });

                if(status == false){
                    _that.project_data.facilities_s.push(a);
                    e.status = true;
                }else {
                    _that.project_data.facilities_s.splice(key, 1);
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
            openDelPoi:function () {
                $('#poi_del').show();
            },
            DelPoi:function () {
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=resource&list=DelResource";
                post_url(url,{key_id:_that.key_id},true,true).then(res => {
                    Jump_url('./resources_hotel.html');
                },error=>{
                });
            },
            SetContent:function (e) {
                this.project_data.guide  = e;
            }


        },
        created(){
            // `this` 指向 vm 实例
            this.GetResourcesdata();
            this.get_label();
        }
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


    function SetEditorContent(e) {
        editor.setHtml(e)
    }
</script>
