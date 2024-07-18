
<script>
    var project_html    =   '';
    const vm =  new Vue({
        el: '#webMain',
        data: {
            key_id: '<?=$key_id?>',
            resources_data:{
                'title':'笔记详情'
            },
            project_note_data:{
                key_id:'<?=$key_id?>',
                title:'',
                association:[],
                label:[],
                address_code:[],
                content:'',
                picture:''
            },
            city_list1_status :false,
            project_city:'',
            label_data :'',
            label:[],
            city_list1:[],
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
            post_note:function () {
                var _that   =   this;
                _that.project_note_data.content = $('#editor-content').val();
                _that.project_note_data.picture = $('#picture').val();
                const url   =   "<?=$_Post_url?>?cmd=resource_note&list=note";
                post_url(url,_that.project_note_data,true).then(res => {

                    $('.addNode').css('display', 'none')
                    $('#img1').html('')
                    $('#picture').val('');

                    _that.GetResources_note_data();
                    _that.project_note_data = {
                        key_id:_that.key_id,
                        title:'',
                        association:[],
                        label:[],
                        address_code:[],
                        content:'',
                        picture:''
                    };


                },error=>{
                });
            },
            del_association:function (e){
                var _that   =   this;
                _that.project_note_data.association.splice(e, 1);

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
                str = _that.project_note_data.address_code;
                str.forEach(function(item, index, arr) {
                    if(item.id === e.id) {
                        arr.splice(index, 1);
                    }
                });
                _that.project_note_data.address_code  =   str;

            },
            add_city:function (a,e){
                var _that   =   this;
                _that.city_list1_status    =   false
                var city    =   {
                    id:a.id,
                    value:a.region_name
                };
                try{
                    _that.project_note_data.address_code.forEach(function(item, index, arr) {
                        if(item.id === a.id) {
                            throw new Error('当前已有目标城市！')
                        }
                    });
                    _that.project_note_data.address_code.push(city);
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
            GetResources_note_data:function () {
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=resource_details&list=note";
                post_url(url,{key_id:_that.key_id},false,true).then(res => {
                    _that.resources_data   =   res.data;
                    _that.project_note_data.title   =   res.data.name;
                    _that.project_note_data.association   =   res.data.association;
                    _that.project_note_data.address_code   =   res.data.address_code_list;
                    _that.project_note_data.label   =   res.data.label;
                    _that.project_note_data.content   =   res.data.content;
                    _that.association_code = _that.project_note_data.association;

                    $('#editor-content').val(res.data.content)
                    project_html   =   res.data.content;
                    if(res.data.picture){
                        _that.project_note_data.picture   =   res.data.picture;
                        const img = document.createElement('img')
                        img.style.height = '100%'
                        img.style.width = '100%'
                        img.src = res.data.picture
                        $('#picture').val(res.data.picture);
                        $('#img1').html(img)
                    }else {
                        _that.project_note_data.picture   =   '';
                        $('#picture1').val('');

                    }


                    read_wang();


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
                _that.project_note_data.association.push(code);
                _that.association_code = _that.project_note_data.association
                $('.traffic_body').hide();
            },
            Del_poi:function (e,a){
                var _that   =   this;
                _that.project_note_data.association.splice(a, 1);
                _that.association_code = _that.project_note_data.association;

            },
            openDelPoi:function () {
                $('#poi_del').show();
            },
            DelPoi:function () {
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=resource_note&list=delNote";
                post_url(url,{key_id:_that.key_id},true,true).then(res => {
                    Jump_url('./resources_note.html');
                },error=>{
                });
            }
        },
        created(){
            this.GetResources_note_data();
            this.get_label();

        }
    })

    function Add_POI(e,a) {
        vm.Add_POI(e,a)
    }


    function read_wang(){
        const E = window.wangEditor

        window.editor = E.createEditor({
            selector: '#div4',
            html: project_html,
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
            }        })
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
