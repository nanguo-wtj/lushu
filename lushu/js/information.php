<script>
    new Vue({
        el: '#webMain',
        data: {
            user_data:{

            },
            username_status:false,
            mailbox_status:false,
            phone_status:false,
            password_status:false,
        },
        methods: {
            GetUserData:function () {
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=user&list=GetUser";
                post_url(url,{},false,true).then(res => {
                    _that.user_data = res.data
                },error=>{
                });
            },
            upFile:function (node) {
                var _that   =   this;
                const imageUpload = document.createElement('input');
                imageUpload.type = 'file'
                imageUpload.addEventListener('change', handleImageUpload);
                function handleImageUpload(event) {
                    const files = event.target.files;
                    const formData = new FormData();
                    formData.append('file', files[0]);
                    const url   =   "<?=$_Post_url?>?cmd=tool&list=picture";
                    post_url_form(url,formData,true).then(res => {
                        _that.PostUsersculpture(res.data.url);
                    },error=>{
                    });
                }
                    imageUpload.click();
            },
            PostUsersculpture:function (e) {
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=user&list=Setusersculpture";
                post_url(url,{sculpture:e},false).then(res => {
                    _that.GetUserData();
                },error=>{
                });
            },
            SetUserData:function (e) {
                var _that   =   this;
                var data;
                switch (e) {
                    case 'username':
                        data    =   _that.user_data.username;
                        break;
                    case 'mailbox':
                        data    =   _that.user_data.mailbox;
                        break;
                    case 'phone':
                        data    =   _that.user_data.phone;
                        break;
                    case 'password':
                        data    =   {
                            OriginalPassword:_that.user_data.OriginalPassword,
                            NewPassword:_that.user_data.NewPassword,
                            NewPasswords:_that.user_data.NewPasswords
                        };
                        break;
                }
                const url   =   "<?=$_Post_url?>?cmd=user&list=SetUserData";
                post_url(url,{type:e,data:data},true).then(res => {
                    switch (e) {
                        case 'username':
                            _that.username_status = false;
                            break;
                        case 'mailbox':
                            _that.mailbox_status = false;
                            break;
                        case 'phone':
                            _that.phone_status = false;
                            break;
                        case 'password':
                            _that.password_status = false;
                            Logout();
                            break;
                    }
                    _that.GetUserData();
                },error=>{
                });

            }


        },
        created(){
            this.GetUserData();


        }
    })



</script>
