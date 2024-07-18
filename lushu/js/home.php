<script>
    new Vue({
        el: '#webMain',
        data: {
            user_data:{

            },
            tourism_list:[]
        },
        methods: {
            GetUserData:function () {
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=tool&list=Gettourism";
                post_url(url,{},false,true).then(res => {
                    _that.tourism_list = res.data.list;
                },error=>{
                });
            }
        },
        created(){
            this.GetUserData();


        }
    })



</script>
