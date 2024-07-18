<script>

    new Vue({
        el: '#webMain',
        data: {
            label:[],
            label_data:'',
            message_number:0,
            message_list:[],
            message_data:{},
        },
        methods: {
            get_label:function () {
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=resource_list&list=label";
                var data = {
                    type: 1
                }
                post_url(url,data,false,true).then(res => {
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
                post_url(url,data,true,true).then(res => {
                    var str = {
                        id:res.data.key_id,
                        label:res.data.value,
                        status:true
                    }
                    _that.label.push(str)
                },error=>{

                });

            },
            DelLabel:function (e) {
                var _that   =   this;

                const url   =   "<?=$_Post_url?>?cmd=tool&list=label_del";
                var data = {
                    key_id: e.id,
                }
                post_url(url,data,true,true).then(res => {
                    _that.get_label();

                },error=>{

                });
            },
            Update_label:function (e,a){
                var data    =   $('#content'+e).html();

                var _that   =   this;
                if(!data){
                    $('#content'+e).html(a.label);
                    return false;
                }
                const url   =   "<?=$_Post_url?>?cmd=label&list=label_add";
                var data = {
                    label: data,
                    key_id: a.id,
                    type: 1
                }
                post_url(url,data,false,false).then(res => {
                    _that.get_label();
                },error=>{

                });

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
            this.get_label();
            this.GetMessageNumber();
        }
    })

    $('#webMain').click(function () {
        $(".label").hide(); //如果可见则隐藏
        $("#search_city").hide(); //如果可见则隐藏
        $('.city_body').hide()
    })

</script>
