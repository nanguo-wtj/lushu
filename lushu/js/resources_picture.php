
<script>
    const vm =  new Vue({
        el: '#webMain',
        data: {
            project_picture_data: {
                association: [],
                address_code: [],
                content: '',
                picture: ''
            },
            resources_key:{
                title: "",
                address: "",
                page: 1,
                address_value: "",
            },
            city_list2_status :false,
            project_city:'',
            city_list2:[],
            project_picture:[],
            search_address_status:false,
            city_address: {
                city: [],
                user: []
            },
            search_data:{
                poi_value:'',
                poi_list:[]
            },
            poi_value:'',
            association_list:[],
            association_code:[],
            infoWindow:'',
            message_number:0,
            message_list:[],
            message_data:{},
            page_list:{}
        },
        methods: {
            post_picture:function () {
                var _that   =   this;
                _that.project_picture_data.picture = $('#picture2').val();
                const url   =   "<?=$_Post_url?>?cmd=resource_img&list=picture";
                post_url(url,_that.project_picture_data,true).then(res => {
                    var str =   {
                        id:res.data.key_id,
                        title:res.data.title,
                        url:res.data.url,
                    }
                    _that.project_picture.unshift(str);
                    $('.add-poi').css('display', 'none')
                    $('#img2').html(`<span class="pictureUploader__roundCorner___3J8rd widgets__lushuBackgroundImage___3XMmZ widgets__noImg___CsB0Z">
                                                        <div class="widgets__noImgCont___blaq6">
                                                            <i aria-label="图标: picture" class="anticon anticon-picture" style="font-size: 192px;">
                                                               <img src="/lushu/static/svg/icon-104.svg" style="width: 5rem;height: 5rem">
                                                            </i>
                                                        </div>
                                                    </span>`)
                    $('#picture2').val('');
                    _that.project_picture_data = {
                        association: [],
                        address_code: [],
                        content: '',
                        picture: ''
                    }
                },error=>{
                });
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
                    _that.city_list2.city   =   res.data.default;
                    _that.city_list2.user   =   res.data.user;
                    _that.city_list2_status   =   true;
                },error=>{
                });
            },
            del_city:function (e) {
                var _that   =   this;
                var str;
                str = _that.project_picture_data.address_code;
                str.forEach(function(item, index, arr) {
                    if(item.id === e.id) {
                        arr.splice(index, 1);
                    }
                });
                _that.project_picture_data.address_code  =   str;

            },
            add_city:function (a,e){
                var _that   =   this;
                _that.city_list2_status    =   false
                var city    =   {
                    id:a.id,
                    value:a.region_name
                };
                try{
                        _that.project_picture_data.address_code.forEach(function(item, index, arr) {
                            if(item.id === a.id) {
                                throw new Error('当前已有目标城市！')
                            }
                        });
                        _that.project_picture_data.address_code.push(city);
                } catch (e) {
                    console.log(e.message);
                }
                _that.project_city = '';

            },
            GetResources_img_data:function () {
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=resource_list&list=picture";
                var data = _that.resources_key;
                post_url(url,data,false,true).then(res => {
                    _that.project_picture = res.data.list;
                    _that.GetListNumber()
                },error=>{

                });
            },
            GetListNumber:function(e){
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=resource_list&list=picture_number";
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
                _that.GetResources_img_data();
            },
            GetNextpage:function () {
                var _that   =   this;
                if(_that.page_list.next == false){
                    return false;
                }
                _that.resources_key.page++;
                _that.GetResources_img_data();
            },
            GetPage:function (e) {
                var _that   =   this;
                _that.resources_key.page = e;
                _that.GetResources_img_data();
            },

            get_details(e){
                Jump_url('/lushu/resources_picture_details.html?key_id='+e);

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


                this.GetResources_img_data();
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
                _that.project_picture_data.association.push(code);
                _that.association_code = _that.project_picture_data.association
                $('.traffic_body').hide();
            },
            Del_poi:function (e,a){
                var _that   =   this;
                _that.project_picture_data.association.splice(a, 1);
                _that.association_code = _that.project_picture_data.association;

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
            this.GetResources_img_data();
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

    function upFile2(node) {
        const imageUpload = document.createElement('input');
        imageUpload.type = 'file'
        imageUpload.addEventListener('change', handleImageUpload);
        function handleImageUpload(event) {
            const files = event.target.files;
            const formData = new FormData();
            formData.append('file', files[0]);
            const url   =   "<?=$_Post_url?>?cmd=tool&list=picture";
            post_url_form(url,formData,true).then(res => {
                console.log(res);
                $('#picture2').val(res.data.url);
                const imagePath = URL.createObjectURL(files[0])

                $('.pictureUploader__cover___MOiqv').children().remove()
                const img = document.createElement('img')
                img.style.height = '100%'
                img.style.width = '100%'
                img.src = imagePath
                // $(node).css(bac)
                $('#img2').append(img)
            },error=>{

            });;
        }
        imageUpload.click()
    }

    function addNewPoi() {
        $('.modalWrap').css('display', 'block');


    }
    function closeMap() {
        $('.modalWrap').css('display', 'none');
    }
</script>
