
<script>
    const  vm = new Vue({
        el: '#webMain',
        data: {
            key_id:'<?=$key_id?>',
            resources_data:{
                title:'加载中....'
            },
            label:[],
            label_data:'',
            project_city:'',
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
            project_note:[],
            project_picture:[],
            project_picture_data: {
                association: [],
                address_code: [],
                content: '',
                picture: ''
            },
            project_note_data:{
                title:'',
                association:[],
                label:[],
                address_code:[],
                content:'',
                picture:''
            },
            search_data:{
                poi_value:'',
                poi_list:[]
            },
            poi_value:'',
            association_list:[],
            association_code:[],
            list_Status:false,
        },
        methods: {
            GetResourcesdata:function (e) {
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=resource_details&list=resource";
                post_url(url,{key_id:_that.key_id},false,true).then(res => {
                    _that.resources_data   =   res.data;
                    var str =   {
                        id:_that.key_id,
                        value:res.data.title
                    }
                    _that.project_note_data.association.push(str)
                    _that.project_picture_data.association.push(str)

                },error=>{
                });
            },
            get_note:function () {
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=resource_list&list=note";
                var data = {
                    association_id: _that.key_id
                }
                post_url(url,data,false).then(res => {
                    _that.project_note = res.data.list;
                },error=>{

                });
            },
            get_picture:function () {
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=resource_list&list=picture";
                var data = {
                    association_id: _that.key_id
                }
                post_url(url,data,false).then(res => {
                    _that.project_picture = res.data.list;
                },error=>{

                });
            },
            del_association:function (e){
                var _that   =   this;
                _that.project_note_data.association.splice(e, 1);

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
                    _that.project_note_data.label.push(str)
                    _that.label_data    =   '';
                },error=>{

                });

            },
            del_label:function (e) {
                var _that   =   this;
                console.log(e);
                var str = _that.project_note_data.label;
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
                _that.project_note_data.label  =   str;
            },
            add_project_label:function (e) {
                var _that   =   this;
                e.status = true;
                var str = {
                    id:e.id,
                    label:e.label
                }
                try{
                    _that.project_note_data.label.forEach(function(item, index, arr) {
                        if(item.id === e.id) {
                            throw new Error('当前已有目标标签！')
                        }
                    });
                    _that.project_note_data.label.push(str);
                } catch (e) {
                    console.log(e.message);
                }
            },
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
                    if(e == 2){
                        _that.city_list2.city   =   res.data.default;
                        _that.city_list2.user   =   res.data.user;
                        _that.city_list2_status   =   true;
                    }else {
                        _that.city_list1.city   =   res.data.default;
                        _that.city_list1.user   =   res.data.user;
                        _that.city_list1_status   =   true;
                    }

                },error=>{
                });
            },
            del_city:function (e) {
                var _that   =   this;
                var str;
                if(e == 2) {
                    str = _that.project_picture_data.address_code;
                }else {
                    str = _that.project_note_data.address_code;
                }
                str.forEach(function(item, index, arr) {
                    if(item.id === e.id) {
                        arr.splice(index, 1);
                    }
                });
                if(e == 2) {
                    _that.project_picture_data.address_code  =   str;
                }else {
                    _that.project_note_data.address_code  =   str;
                }
            },
            add_city:function (a,e){
                var _that   =   this;
                _that.city_list1_status   =   false
                _that.city_list2_status   =   false
                var city    =   {
                    id:a.id,
                    value:a.region_name
                };
                try{
                    if(e == 2){
                        _that.project_picture_data.address_code.forEach(function(item, index, arr) {
                            if(item.id === a.id) {
                                throw new Error('当前已有目标城市！')
                            }
                        });
                        _that.project_picture_data.address_code.push(city);
                    }else {
                        _that.project_note_data.address_code.forEach(function(item, index, arr) {
                            if(item.id === a.id) {
                                throw new Error('当前已有目标城市！')
                            }
                        });
                        _that.project_note_data.address_code.push(city);
                    }

                } catch (e) {
                    console.log(e.message);
                }
                _that.project_city = '';

            },
            post_note:function () {
                var _that   =   this;
                _that.project_note_data.content = $('#editor-content').val();
                _that.project_note_data.picture = $('#picture').val();
                const url   =   "<?=$_Post_url?>?cmd=resource_note&list=note";
                post_url(url,_that.project_note_data,true).then(res => {
                    var str =   {
                        id:res.data.key_id,
                        title:res.data.title,
                        url:res.data.url,
                        user:res.data.user
                    }
                    _that.project_note.unshift(str);
                    $('.addNode').css('display', 'none')
                    $('#img1').html('')
                    $('#picture').val('');

                    _that.get_label();
                    _that.resources_data   =   res.data;
                    _that.project_note_data = {
                        title:'',
                        association:[],
                        label:[],
                        address_code:[],
                        content:'',
                        picture:''
                    };
                    var association =   {
                        id:_that.key_id,
                        value:_that.resources_data.title
                    }
                    _that.project_note_data.association.push(association)

                },error=>{
                });
            },
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

                    _that.get_label();
                    _that.project_picture_data = {
                        association: [],
                        address_code: [],
                        content: '',
                        picture: ''
                    }
                    var association =   {
                        id:_that.key_id,
                        value:_that.resources_data.title
                    }
                    _that.project_picture_data.association.push(association)
                },error=>{
                });
            },
            post_picture_default:function (e) {
                event.stopPropagation();
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=resource_img&list=default";
                var data    =   {
                    key_id:_that.key_id,
                    picture_id:e.id
                }
                post_url(url,data,true).then(res => {
                    _that.resources_data.picture_id =e.id
                },error=>{
                });
            },
            get_note_details(e){
                Jump_url('/lushu/resources_note_details.html?key_id='+e);
            },
            get_picture_details(e){
                Jump_url('/lushu/resources_picture_details.html?key_id='+e);
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

                if(_that.list_Status == false){
                    _that.project_note_data.association.push(code);
                    _that.association_code = _that.project_note_data.association
                }else {
                    _that.project_picture_data.association.push(code);
                    _that.association_code = _that.project_picture_data.association
                }
                $('.traffic_body').hide();
            },
            Del_poi:function (e,a){
                var _that   =   this;
                if(_that.list_Status == false){
                    _that.project_note_data.association.splice(a, 1);
                    _that.association_code = _that.project_note_data.association;
                }else {
                    _that.project_picture_data.association.splice(a, 1);
                    _that.association_code = _that.project_picture_data.association;
                }

            },
            listAdd:function (e) {
                var _that   =   this;
                if(e == 1){
                    $('.addNode').css('display','block')
                    _that.list_Status   =   false;
                }else {
                    $('.add-poi').css('display','block')
                    _that.list_Status   =   true;
                }

            },
            openDelPoi:function () {
                $('#poi_del').show();
            },
            DelPoi:function () {
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=resource&list=DelResource";
                post_url(url,{key_id:_that.key_id},true,true).then(res => {
                    Jump_url('./resources_poi.html');
                },error=>{
                });
            }


        },
        created(){
            this.GetResourcesdata();
            this.get_label();
            this.get_note();
            this.get_picture();
        }
    })
    function Add_POI(e,a) {
        vm.Add_POI(e,a)
    }

    const E = window.wangEditor

    window.editor = E.createEditor({
        selector: '#div4',
        html: '',
        config: {
            placeholder: '请输入...',
            MENU_CONF: {
                uploadImage: {
                    fieldName: 'your-fileName',
                    base64LimitSize: 10 * 1024 * 1024 // 1M 以下插入 base64
                }
            },
            onChange(editor) {
                $('#editor-content').val(editor.getHtml())
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
                console.log(res);
                $('#picture').val(res.data.url);
                const imagePath = URL.createObjectURL(files[0])
                console.log('files', files, imagePath)

                $('.pictureUploader__cover___MOiqv').children().remove()
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
    function save() {
        $('.modalWrap').css('display', 'none');
        $('.add-poi').css('display', 'none')
    }

    function dlgClose() {
        $('.modalWrap').css('display', 'none');
        $('.add-poi').css('display', 'none')
    }


    function changePoi() {
        addNewPoi()
    }

</script>