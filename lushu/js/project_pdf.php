<script>
    new Vue({
        el: '#webMain',
        data: {
            key_id:'<?=$key_id?>',
            project_data:{
                key: "<?=$key_id?>",
                title: "",
                start_time: "",
                end_time: "",
                project_code: "",
                departure: "",
                departure_name: "",
                return_to: "",
                return_to_name: "",
            },


        },
        methods: {
            GetProjectData:function () {
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=project&list=Project_data";
                post_url(url,{key_id:_that.key_id},false,true).then(res => {
                    _that.project_data          =   res.data;

                },error=>{
                    // Jump_url('./');
                });
            },
            GetProjectDataPdf:function () {
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=Download&list=quotation_pdf";
                post_url(url,{key_id:_that.key_id},false,true).then(res => {
                    location.href   =   res.data.file;
                },error=>{
                    // Jump_url('./');
                });
            },
        },
        created(){
            this.GetProjectData();
            this.GetProjectDataPdf();

        }
    })



</script>
