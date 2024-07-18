
<script>
    const vm = new Vue({
        el: '#webMain',
        data: {
            project_trip_data:{
                title:'',
                association:[],
                address_code:[],
                content:'',
                picture:''
            },
            resources_key:{
                title: "",
                address: "",
                page: 1,
                address_value: "",
                association: "",
                association_value: "",
            },
            city_list1_status :false,
            project_city:'',
            label_data :'',
            label:[],
            city_list1:[],
            project_trip:[],
            search_address_status:false,
            city_address: {
                city: [],
                user: []
            },
            association_list: [],
            search_data:{
                poi_value:'',
                poi_list:[]
            },
            poi_value:'',
            association_code:[],
            infoWindow:'',
            message_number:0,
            message_list:[],
            message_data:{},
            page_list:{}
        },
        methods: {
            post_trip:function () {
                var _that   =   this;
                _that.project_trip_data.picture =   $('#picture').val()
                const url   =   "<?=$_Post_url?>?cmd=resources_wonderful&list=wonderful";
                post_url(url,_that.project_trip_data,true).then(res => {

                    $('#trip_add').css('display', 'none')
                    $('#img1').html('')
                    $('#picture').val('');
                    _that.project_trip_data = {
                        title:'',
                        association:[],
                        address_code:[],
                        content:'',
                        picture:''
                    };
                    _that.association_code = [];
                    _that.GetResources_trip_list();
                    _that.get_label();



                },error=>{
                });
            },
            del_association:function (e){
                var _that   =   this;
                _that.project_trip_data.association.splice(e, 1);

            },
            search_city:function(e){
                var _that   =   this;
                _that.city_list2_status    =   false;
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
            del_city:function (e) {
                var _that   =   this;
                var str;
                str = _that.project_trip_data.address_code;
                str.forEach(function(item, index, arr) {
                    if(item.id === e.id) {
                        arr.splice(index, 1);
                    }
                });
                _that.project_trip_data.address_code  =   str;

            },
            add_city:function (a,e){
                var _that   =   this;
                _that.city_list1_status    =   false
                var city    =   {
                    id:a.id,
                    value:a.region_name
                };
                try{
                    _that.project_trip_data.address_code.forEach(function(item, index, arr) {
                        if(item.id === a.id) {
                            throw new Error('当前已有目标城市！')
                        }
                    });
                    _that.project_trip_data.address_code.push(city);
                } catch (e) {
                    console.log(e.message);
                }
                _that.project_city = '';

            },
            GetResources_trip_list:function () {
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=resource_list&list=trip";
                var data = _that.resources_key;
                if(!_that.resources_key.association_value){
                    _that.resources_key.association =   ''
                }
                post_url(url,data,false,true).then(res => {
                    _that.project_trip = res.data.list;
                    _that.GetListNumber();
                },error=>{
                });
            },
            GetListNumber:function(e){
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=resource_list&list=trip_number";
                var data = _that.resources_key;
                post_url(url,data,false,true).then(res => {
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
                _that.GetResources_trip_list();
            },
            GetNextpage:function () {
                var _that   =   this;
                if(_that.page_list.next == false){
                    return false;
                }
                _that.resources_key.page++;
                _that.GetResources_trip_list();
            },
            GetPage:function (e) {
                var _that   =   this;
                _that.resources_key.page = e;
                _that.GetResources_trip_list();
            },
            get_details(e){
                Jump_url('/lushu/resources_trip_details.html?key_id='+e);

            },
            search:function () {
                var _that   =   this;

                if(!_that.resources_key.address_value){
                    _that.resources_key.address = '';
                }
                _that.resources_key.page = 1;

                $("#search_city").hide(); //如果可见则隐藏
                $(".label").hide(); //如果可见则隐藏
                $('.city_body').hide();


                this.GetResources_trip_list();
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
            search_association:function(){
                var _that   =   this;
                $('#poi_list').show();
                const url   =   "<?=$_Post_url?>?cmd=tool&list=search_poi";
                var association    =   '';
                association    =   _that.resources_key.association_value;
                if(!association){
                    _that.association_list  =   [];
                    return false;
                }
                var data = {
                    title:association
                };
                post_url(url,data,false).then(res => {
                    _that.association_list   =   res.data.list;
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
            Set_search_association:function (e) {
                var _that   =   this;
                _that.resources_key.association = e.id;
                _that.resources_key.association_value    =   e.title
                _that.search();
                $('#poi_list').hide()
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
                _that.project_trip_data.association.push(code);
                _that.association_code = _that.project_trip_data.association
                $('.traffic_body').hide();
            },
            Del_poi:function (e,a){
                var _that   =   this;
                _that.project_trip_data.association.splice(a, 1);
                _that.association_code = _that.project_trip_data.association;

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
            }



        },
    created(){
        this.GetResources_trip_list();
        this.GetMessageNumber()

    }
    })



    function Add_POI(e,a) {
        vm.Add_POI(e,a)
    }
    function upFile(node) {
        const imageUpload = document.createElement('input');
        imageUpload.type = 'file'
        imageUpload.addEventListener('change', handleImageUpload);
        function handleImageUpload(event) {
            const files = event.target.files;
            const formData = new FormData();
            formData.append('file', files[0]);
            const url   =   "<?=$_Post_url?>?cmd=tool&list=picture";
            post_url_form(url,formData,true).then(res => {
                $('#picture').val(res.data.url);
                const imagePath = URL.createObjectURL(files[0])

                $('.keypointUploader__cover____bPP9').children().remove()
                const img = document.createElement('img')
                img.style.height = '100%'
                img.style.width = '100%'
                img.src = imagePath
                // $(node).css(bac)
                $('#img1').append(img)
            },error=>{

            });;
        }
        imageUpload.click()
    }

    function addNewPoi() {
        $('.modalWrap').css('display', 'block');
        var mapIfr = $('.poi-map-canvas').get(0)
        var childWindow = mapIfr.contentWindow;
        console.log($('.search').val())
        setTimeout(() => { childWindow.getLoc($('.search').val(), true) }, 1000)

    }
    function closeMap() {
        $('.modalWrap').css('display', 'none');
        parent.closeMap()
    }
</script>
