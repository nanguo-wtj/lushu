
<script>
    const vm =  new Vue({
        el: '#webMain',
        data: {
            key_id: '<?=$key_id?>',
            project_picture_data: {
                key_id: '<?=$key_id?>',
                association: [],
                address_code: [],
                content: '',
                picture: ''
            },
            resources_data:{
                'title':'图片详情'
            },
            city_list2_status :false,
            project_city:'',
            city_list2:[],
            project_picture:[],
            search_data:{
                poi_value:'',
                poi_list:[]
            },
            poi_value:'',
            association_list:[],
            association_code:[],
            infoWindow:'',
            association_code:[]
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
                    $('#img2').html('')
                    $('#picture2').val('');
                    this.GetResources_img_data();

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
                const url   =   "<?=$_Post_url?>?cmd=resource_details&list=picture";
                post_url(url,{key_id:_that.key_id},false,true).then(res => {
                    _that.resources_data   =   res.data;
                    _that.project_picture_data.association   =   res.data.association;
                    _that.project_picture_data.address_code   =   res.data.address_code_list;
                    _that.project_picture_data.content   =   res.data.content;
                    _that.project_picture_data.picture   =   res.data.picture;
                    _that.association_code = _that.project_picture_data.association;
                    const img = document.createElement('img')
                    img.style.height = '100%'
                    img.style.width = '100%'
                    img.src = res.data.picture
                    $('#picture2').val(res.data.picture);

                    $('#img2').html(img)
                },error=>{
                });
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
            openDelPoi:function () {
                $('#poi_del').show();
            },
            DelPoi:function () {
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=resource_img&list=DelPicture";
                post_url(url,{key_id:_that.key_id},true,true).then(res => {
                    Jump_url('./resources_picture.html');
                },error=>{
                });
            }

        },
        created(){
            this.GetResources_img_data();

        }
    })

    function Add_POI(e,a) {
        vm.Add_POI(e,a)
    }

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
