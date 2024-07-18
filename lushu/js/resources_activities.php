<script>

    const vm = new Vue({
        el: '#webMain',
        data: {
            ActivitiesDate:{
                title:'',
                imgList:[],
                association:[],
                address_code:[],
                content:'',
                label:[],
                price:[],
                notice:'',
                service:'',
                notes:[],
            },
            showStr:'name',
            Name_status:true,
            Label_status:false,
            Picture_status:false,
            Location_status:false,
            Destination_status:false,
            Price_status:false,
            Notice_status:false,
            Service_status:false,
            Note_status:false,
            label_data :'',
            label:[],
            Picture_List:[],
            Picture_List_search:{
                title:'',
                page:1
            },
            NoteListData:{
                title:'',
                page:1
            },
            search_data:{
                poi_value:'',
                poi_list:[]
            },
            poi_value:'',
            project_city:'',
            association_code:[],
            city_list1_status :false,
            city_list1:[],
            price_list_status:0,
            NoteList:[],
            resources_key:{
                title: "",
                address: "",
                page: 1,
                address_value: "",
                label:'',
                label_value:'全部'
            },
            ActivitiesList:[],
            message_number:0,
            message_list:[],
            message_data:{},
            page_list:{},
            city_address: {
                city: [],
                user: []
            },
        },
        methods: {
            editClick:function (a,b) {
                var _that   =   this;
                if(_that.Label_status == true){
                    $('.btnCube2').css('display','none');
                    $('.btnCube1').css('display','block');
                    $('.tagPanel__editTagWrapPosition___dLOaA').css('display','none')
                }
                _that.Name_status = false;
                _that.Label_status = false;
                _that.Picture_status = false;
                _that.Location_status = false;
                _that.Destination_status = false;
                _that.Price_status = false;
                _that.Notice_status = false;
                _that.Service_status = false;
                _that.Note_status = false;
                console.log(a);

                switch (a) {
                    case 1:
                        _that.Name_status = true;
                        break;
                    case 2:
                        _that.Label_status = true;
                        $('.btnCube1').css('display','none');
                        $('.btnCube2').css('display','block');
                        $('.tagPanel__editTagWrapPosition___dLOaA').css('display','block');
                        break;
                    case 3:
                        _that.Picture_status = true;
                        break;
                    case 4:
                        _that.Location_status = true;
                        break;
                    case 5:
                        _that.Destination_status = true;
                        break;
                    case 6:
                        _that.Price_status = true;
                        if(_that.ActivitiesDate.price.length == 0){
                            var str =   {
                                title: "",
                                value: ''
                            };
                            _that.ActivitiesDate.price.push(str);
                        }

                        break;
                    case 7:
                        _that.Notice_status = true;
                        break;
                    case 8:
                        _that.Service_status = true;
                        break;
                    case 9:
                        _that.Note_status = true;
                        break;
                        default:
                            console.log('无数据');
                            break;

                }
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
                    _that.ActivitiesDate.label.push(str)
                    _that.label_data    =   '';
                },error=>{

                });

            },
            add_project_label:function (e) {
                var _that   =   this;
                e.status = true;
                var str = {
                    id:e.id,
                    label:e.label
                }
                try{
                    _that.ActivitiesDate.label.forEach(function(item, index, arr) {
                        if(item.id === e.id) {
                            throw new Error('当前已有目标标签！')
                        }
                    });
                    _that.ActivitiesDate.label.push(str);
                } catch (e) {
                    console.log(e.message);
                }
            },
            GetPicture_List:function () {
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=label&list=label_add";
                post_url(url,_that.Picture_List_search,false).then(res => {
                    _that.Picture_List    =   res.data.list;
                },error=>{

                });
            },
            GetActivitiesList:function () {
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=resource_activities&list=activities_list";
                post_url(url,_that.resources_key,false).then(res => {
                    _that.ActivitiesList    =   res.data.list;
                    _that.GetListNumber();
                },error=>{

                });
            },
            GetListNumber:function(e){
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=resource_activities&list=activities_number";
                post_url(url,_that.resources_key,false).then(res => {
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
                _that.GetActivitiesList();
            },
            GetNextpage:function () {
                var _that   =   this;
                if(_that.page_list.next == false){
                    return false;
                }
                _that.resources_key.page++;
                _that.GetActivitiesList();
            },
            GetPage:function (e) {
                var _that   =   this;
                _that.resources_key.page = e;
                _that.GetActivitiesList();
            },
            GetResources_img_data:function () {
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=resource_list&list=picture";
                var data = _that.Picture_List_search;
                post_url(url,data,false,true).then(res => {
                    _that.Picture_List = [];
                    res.data.list.forEach(function(item, index, arr) {
                        var str = {
                            id:item.id,
                            title:item.title,
                            url:item.url,
                            status:false
                        }
                        _that.Picture_List.push(str)
                    });
                },error=>{

                });
            },
            GetNoteList:function () {
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=resource_list&list=note";
                var data = _that.NoteListData;
                post_url(url,data,false,true).then(res => {
                    _that.NoteList = [];
                    res.data.list.forEach(function(item, index, arr) {
                        var str = {
                            id:item.id,
                            title:item.title,
                            user:item.user,
                            url:item.url,
                            status:false
                        }
                        _that.NoteList.push(str)
                    });
                },error=>{

                });
            },
            AddPicture:function (e) {
                var _that   =   this;
                var error = false;
                _that.ActivitiesDate.imgList.forEach(function(item, index, arr) {
                    if(item.id == e.id){
                        error = true;
                        e.status    =   false;
                        _that.ActivitiesDate.imgList.splice(index, 1)
                    }
                });
                if(error == false){
                    e.status    =   true;
                    _that.ActivitiesDate.imgList.push(e)
                }
            },
            DelImgList:function (e,a) {
                var _that   =   this;
                _that.Picture_List.forEach(function(item, index, arr) {
                    if(item.id == e.id){
                       item.status = false;
                    }
                });
                _that.ActivitiesDate.imgList.splice(a, 1)

            },
            AddNote:function (e) {
                var _that   =   this;
                var error = false;
                _that.ActivitiesDate.notes.forEach(function(item, index, arr) {
                    if(item.id == e.id){
                        error = true;
                        e.status    =   false;
                        _that.ActivitiesDate.notes.splice(index, 1)
                    }
                });
                if(error == false){
                    e.status    =   true;
                    _that.ActivitiesDate.notes.push(e)
                }
            },
            DelNote:function (e,a) {
                var _that   =   this;
                _that.NoteList.forEach(function(item, index, arr) {
                    if(item.id == e.id){
                       item.status = false;
                    }
                });
                _that.ActivitiesDate.notes.splice(a, 1)

            },
            search_poi:function(){
                var _that   =   this;
                $('.traffic_body').show();
                const url   =   "<?=$_Post_url?>?cmd=tool&list=search_poi";
                var association    =   '';
                association    =   _that.poi_value;
                if(!association){
                    _that.search_data.poi_list  =   [];
                    return false;
                }
                var data = {
                    title:association,
                    type:1
                };
                post_url(url,data,false).then(res => {
                    _that.search_data.poi_list   =   res.data.list;
                },error=>{

                });
            },
            add_poi_address:function (e) {
                var iframe =    $("#map_edit")[0];
                var data = {
                    id:e.id,
                    name:e.title,
                    address:e.address,
                    lng:e.lng,
                    lat:e.lat,
                }
                this.infoWindow =   iframe.contentWindow.openInfo(data);
                iframe.contentWindow.set_poi_maker('',e.lng,e.lat);
            },
            Add_POI:function (e,a) {
                var _that   =   this;
                var iframe =    $("#map_edit")[0];
                var code = {
                    value:a,
                    id:e
                }
                iframe.contentWindow.closeInfo(_that.infoWindow);
                _that.search_data.poi_list  =   [];
                _that.poi_value =   '';
                _that.ActivitiesDate.association.push(code);
                _that.association_code = _that.ActivitiesDate.association
                $('.traffic_body').hide();
            },
            Del_poi:function (e,a){
                var _that   =   this;
                _that.ActivitiesDate.association.splice(a, 1);
                _that.association_code = _that.ActivitiesDate.association;

            },
            del_city:function (e) {
                var _that   =   this;
                var str;
                str = _that.ActivitiesDate.address_code;
                str.forEach(function(item, index, arr) {
                    if(item.id === e.id) {
                        arr.splice(index, 1);
                    }
                });
                _that.ActivitiesDate.address_code  =   str;

            },
            search_city:function(e){
                var _that   =   this;
                _that.city_list1_status    =   false;
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
                    _that.city_list1.city   =   res.data.default;
                    _that.city_list1.user   =   res.data.user;
                    _that.city_list1_status   =   true;
                },error=>{
                });
            },
            add_city:function (a,e){
                var _that   =   this;
                _that.city_list1_status    =   false
                var city    =   {
                    id:a.id,
                    value:a.region_name
                };
                try{
                    _that.ActivitiesDate.address_code.forEach(function(item, index, arr) {
                        if(item.id === a.id) {
                            throw new Error('当前已有目标城市！')
                        }
                    });
                    _that.ActivitiesDate.address_code.push(city);
                } catch (e) {
                    console.log(e.message);
                }
                _that.project_city = '';

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
                _that.ActivitiesDate.price.push(str);

            },
            del_price_list:function (e) {
                var _that   =   this;
                var number = _that.ActivitiesDate.price.length;
                if(e == (number-1)){
                    return false;
                }
                _that.ActivitiesDate.price.splice(e, 1);
                _that.price_list_status =   number-2;

            },
            closeactivities:function () {
                this.ActivitiesDate = {
                    title:'',
                        imgList:[],
                        association:[],
                        address_code:[],
                        content:'',
                        label:[],
                        price:[],
                        notice:'',
                        service:'',
                        notes:[],
                };

                $('.invisibleWrapper').hide()
            },
            openactivities:function () {
                $('.invisibleWrapper').show()
            },
            postactivities:function () {
                var _that   =   this;

                const url   =   "<?=$_Post_url?>?cmd=resource_activities&list=activities";
                var data    =   {
                    title:  _that.ActivitiesDate.title,
                    notice:_that.ActivitiesDate.notice,
                    introduce:_that.ActivitiesDate.service,
                    label:[],
                    picture:[],
                    location:[],
                    destination:[],
                    notes:[],
                    reference:[],
                };

                _that.ActivitiesDate.label.forEach(function(item, index, arr) {
                    data.label.push(item.id)
                });
                _that.ActivitiesDate.imgList.forEach(function(item, index, arr) {
                    data.picture.push(item.id)
                });
                _that.ActivitiesDate.association.forEach(function(item, index, arr) {
                    data.location.push(item.id)
                });
                _that.ActivitiesDate.address_code.forEach(function(item, index, arr) {
                    data.destination.push(item.id)
                });
                _that.ActivitiesDate.notes.forEach(function(item, index, arr) {
                    data.notes.push(item.id)
                });
                _that.ActivitiesDate.price.forEach(function(item, index, arr) {
                    if(item.title  || item.value){
                        data.reference.push(item)
                    }
                });
                post_url(url,data,true,true).then(res => {
                    _that.closeactivities()
                    _that.GetActivitiesList()
                },error=>{
                });
            },
            open_details:function (e) {
                over_Time_url('./resources_activities_details.html?key_id='+e.id,200);
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
            Set_search_label:function (e,a) {
                var _that   =   this;
                _that.resources_key.label = e;
                _that.resources_key.label_value    =   a
                _that.search();
                $('.label').hide()
            },
            search_label_show:function (){
                event.stopPropagation();
                if ($(".label").is(":visible")) { //判断元素是否可见
                    $(".label").hide(); //如果可见则隐藏
                } else {
                    $(".label").show(); //如果不可见则显示
                }
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
                $('.city_body').hide();
                _that.resources_key.page = 1;


                this.GetActivitiesList();
            },
        },
        created(){
            $('.LOADING').hide()
            this.GetActivitiesList();
            this.get_label();
            this.GetResources_img_data();
            this.GetNoteList();
            this.GetMessageNumber()

        }
    })

    function Add_POI(e,a) {
        vm.Add_POI(e,a)
    }
    $('#webMain').click(function () {
        $(".label").hide(); //如果可见则隐藏
        $("#search_city").hide(); //如果可见则隐藏
        $('.city_body').hide()
    })
    function closeMap() {
        $('#modalWrap').css('display', 'none');
        parent.closeMap()
    }
</script>
