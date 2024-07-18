<script>

    new Vue({
        el: '#webMain',
        data: {
            recyclebin_list:[],
            menu:[
                {
                    index:1,
                    title:'行程路线',
                    status:true
                },
                {
                    index:2,
                    title:'POI',
                    status:false
                },
                {
                    index:3,
                    title:'图片',
                    status:false
                },
                {
                    index:4,
                    title:'笔记',
                    status:false
                },
                {
                    index:5,
                    title:'酒店',
                    status:false
                },
                {
                    index:6,
                    title:'活动与服务',
                    status:false
                },
                {
                    index:7,
                    title:'行程亮点',
                    status:false
                }
            ],
            type:1,
            message_number:0,
            message_list:[],
            message_data:{},
        },
        methods: {
            restore:function (e) {
                var _that   =   this;

                const url   =   "<?=$_Post_url?>?cmd=recyclebin&list=restore";
                var data = {
                    type: _that.type,
                    key_id:e.id
                }
                post_url(url,data,true,true).then(res => {
                    _that.Getrecyclebin_list(_that.type);
                },error=>{});
            },
            Getrecyclebin_list:function (e) {
                var _that   =   this;

                const url   =   "<?=$_Post_url?>?cmd=recyclebin&list=recyclebinList";
                var data = {
                    type: e,
                }
                _that.type = e;
                post_url(url,data,false,true).then(res => {
                    _that.recyclebin_list = res.data
                },error=>{});
            },
            GetMenu:function (e) {
                var _that   =   this;
                _that.menu.forEach(function(item, index, arr) {
                    item.status     =   false;
                });
                e.status = true;
                _that.Getrecyclebin_list(e.index)
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
            this.Getrecyclebin_list(1);
            this.GetMessageNumber();

        }
    })

    $('#webMain').click(function () {
        $(".label").hide(); //如果可见则隐藏
        $("#search_city").hide(); //如果可见则隐藏
        $('.city_body').hide()
    })

</script>
