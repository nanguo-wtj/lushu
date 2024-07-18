<script>
    new Vue({
        el: '#webMain',
        data: {
            key_id:'<?=$key_id?>',
            resources_data:{
                title:'加载中....'
            },
            template_name:'',
            template_list:[],
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
            default_id:0,
            default_s:{
                id: 0,
                title: "",
                name: "标准模版",
                type: null,
                picture: [
                    // {
                    //     id: "5",
                    //     value: "/upfiles/801/20231122/1700631890666918-20231122.jpg"
                    // },
                ],
                introduction: "",
                information: null,
                details: "",
                note: ""
            }

        },
        methods: {
            GetResourcesdata:function (e) {
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=resource_details&list=hotel";
                post_url(url,{key_id:_that.key_id},false,true).then(res => {
                    _that.resources_data   =   res.data;
                    _that.template_name = _that.resources_data.user+'创建的模版'
                },error=>{
                });
            },
            Set_default_code:function(res,c){
                var _that   =   this;
                var data = {};
                data.id    =       0;
                data.title    =       res.title;
                data.name    =       '标准模版';
                data.type      =       res.type;
                data.introduction      =       res.introduction;
                data.details      =       res.guide;
                data.picture    =   [];

                if(res.picture_id){
                    data.picture.push({
                        id:res.picture_id,
                        value:res.picture
                    });
                }
                var str =   [];
                if(res.en_title){str.push({title:'英文名称', value:res.en_title})}
                if(res.other_title){str.push({title:'其他语言名称', value:res.other_title})}
                if(res.address){str.push({title:'地址', value:res.address})}
                if(res.phone){str.push({title:'电话', value:res.phone})}
                if(res.official_web){str.push({title:'官方网站', value:res.official_web})}
                if(res.consumption){str.push({title:'消费', value:res.consumption})}
                if(res.traffic){str.push({title:'交通', value:res.traffic})}
                if(res.opening_hours){str.push({title:'开放时间', value:res.opening_hours})}
                if(res.time_reference){str.push({title:'建议游玩时间', value:res.time_reference})}
                data.information      =       str;
                _that.template_list.unshift(data)
                if(c == 0){
                    _that.default_s = data;
                }
            },
            Set_default_s:function (e) {
                console.log(e);
                var _that   =   this;
                _that.default_s     =       e;
                _that.default_id     =       e.id;
            },
            Set_default_id:function (e) {
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=resource&list=template_hotel";
                post_url(url,{key_id:_that.key_id,default:e},true).then(res => {
                    _that.resources_data.default  =   e
                },error=>{
                });
            },
            Gettemplate_list:function () {
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=resource_list&list=template_hotel";
                post_url(url,{superior_id:_that.key_id},false).then(res => {
                    _that.template_list =   [];
                    res.data.list.forEach(function(item, index, arr) {
                        if(_that.resources_data.default == item.id){
                            _that.default_s = item;
                            _that.default_id = item.id;
                        }
                        _that.template_list.push(item)
                    });
                    _that.Set_default_code(_that.resources_data,_that.resources_data.default);
                },error=>{
                });
            },
            add_template:function(){
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=resource&list=template_hotel_add";
                post_url(url,{name:_that.template_name,title:_that.resources_data.title,superior_id:_that.key_id},true).then(res => {
                    _that.Gettemplate_list();
                    close_add_template();
                    $('.newCenterModal').css('display', 'block')
                },error=>{
                });
            },
            post_poi:function () {

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
            }
        },
        created(){
            // `this` 指向 vm 实例
            this.GetResourcesdata();
            this.Gettemplate_list();
        }
    })
</script>