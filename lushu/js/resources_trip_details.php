<script>
    const vm =  new Vue({
        el: '#webMain',
        data: {
            key_id:'<?=$key_id?>',
            trip_key:{

            },
            project_trip_data :{
                key_id:'',
                title:'',
                association:[],
                address_code:[],
                content:'',
                picture:''
            },
            city_list1: {
                city: [],
                user: []
            },
            city_list1_status:false,
            project_city:'',
            resources_data:{
                title:'加载中....'
            },
            search_data:{
                poi_value:'',
                poi_list:[]
            },
            poi_value:'',
            association_list:[],
            association_code:[],
            infoWindow:'',

        },
        methods: {
            search_city:function(e){
                var _that   =   this;
                _that.city_list1_status   =   false;
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
            GetTripdata:function () {
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=resource_details&list=trip";
                post_url(url,{key_id:_that.key_id},false,true).then(res => {
                    _that.resources_data            =   res.data;
                    _that.project_trip_data.key_id          =   _that.key_id;
                    _that.project_trip_data.title          =  res.data.name;
                    _that.project_trip_data.association          =  res.data.association;
                    _that.association_code          =  _that.project_trip_data.association;
                    _that.project_trip_data.address_code          =  res.data.address;
                    _that.project_trip_data.content          =  res.data.notes;
                    _that.project_trip_data.picture          =  res.data.picture;
                    $('#picture').val(res.data.picture)
                    $('.keypointUploader__cover____bPP9').children().remove()
                    const img = document.createElement('img')
                    img.style.height = '100%'
                    img.style.width = '100%'
                    img.src = res.data.picture
                    // $(node).css(bac)
                    $('#img1').append(img)

                },error=>{
                });
            },
            post_trip:function () {
                console.log(this.city_data)
                var _that   =   this;
                _that.project_trip_data .picture =   $('#picture').val()
                const url   =   "<?=$_Post_url?>?cmd=resources_wonderful&list=wonderful";
                post_url(url,_that.project_trip_data ,true).then(res => {
                    _that.GetTripdata();
                    $('#trip_add').css('display', 'none')
                    _that.project_city = ''
                },error=>{
                });
            },
            add_address:function (e,a){
                this.city_data.parent_id =   e.id
                this.city_list1_status   =   false;
                this.project_city        =   e.region_name;
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
            openDelPoi:function () {
                $('#poi_del').show();
            },
            DelPoi:function () {
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=resource&list=DelTrip";
                post_url(url,{key_id:_that.key_id},true,true).then(res => {
                    Jump_url('./resources_trip.html');
                },error=>{
                });
            }
        },
        created(){
            this.GetTripdata();

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
