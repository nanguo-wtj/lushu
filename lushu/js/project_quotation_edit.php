<script>
    new Vue({
        el: '#webMain',
        data: {
            key_id:'<?=$key_id?>',
            project_data:{
                key: "<?=$key_id?>",
                title: "",
            },
            quotation_top_status:true,
            cuoct_status:false,
            not_included_status:false,
            quotation_top_data:{
                time:''
            },
            quotation_top:[],
            quotation_top_id:0,
            quotation_top_list:[

            ],
            quotation_top_lists:[],
            cost_list:[],
            cost_data: {
                    id:'',
                    title:'',
                    content:'',
                },
            not_included_data: {
                id:'',
                title:'',
                content:'',
            },
            loading:false,
            loadings:true,
            previous_id:-1,
            NotPrevious_id:-1,
            not_included:[],
            PaidItemsList:[],
            PaidItemsStatus:false,
            PaidItemsData:{
                id:'',
                title:'',
                content:'',
            },
            PaidItemsId:-1,
            supplementStatsu:false,
            supplementdata:{
                id:'',
                content:'',
            },
            supplementdatas:{
                id:'',
                content:'',
            },
            classification:[
                {
                    id:2,
                    value:'老人',
                    status: false
                },
                {
                    id:3,
                    value:'儿童',
                    status: false
                },
                {
                    id:4,
                    value:'婴儿',
                    status: false
                }
            ],
            grading:[
                {
                    value:'经济',
                    status: false
                },
                {
                    value:'奢华',
                    status: false
                }
            ],
            grading_user:[
            ],
            addUserTypeStatus:false,
            grading_data:'',
        },
        methods: {
            GetProjectData:function () {
                var _that   =   this;
                const url   =   "<?=$_Post_url?>?cmd=project&list=Project_data";
                post_url(url,{key_id:_that.key_id},false,true).then(res => {
                    console.log('项目详情');
                    console.log(res.data);
                    _that.project_data          =   res.data;
                },error=>{
                    // Jump_url('./');
                });


            },
            open_time:function (e) {
                var _that = this;
                _that.quotation_top_status = e
                _that.quotation_top_lists   =   [];
                _that.quotation_top_list.forEach(function (item,index) {
                    var str = {
                        title:  item.title,
                        adult:item.adult,
                        old:item.old,
                        children:item.children,
                        baby:item.baby,
                    };
                    _that.quotation_top_lists.push(str);
                })
            },
            openPicker:function() {
                this.$refs.dateTime.focus()
            },
            addTime:function () {
                var _that = this;
                console.log('时间区间')
                var start_time    =   _that.getFormdate(_that.quotation_top_data.time[0]);
                var end_time    =   _that.getFormdate(_that.quotation_top_data.time[1]);
                var str = {
                    title:  start_time+'~'+end_time,
                    adult:'',
                    old:'',
                    children:'',
                    baby:'',
                };
                _that.quotation_top_lists.push(str);
                _that.quotation_top_data.time   =   '';
            },
            getFormdate:function (e) {
                const date = new Date(e);
                const year = date.getFullYear();
                const month = date.getMonth() + 1; // 月份是从0开始的
                const day = date.getDate();

                const formattedDate = `${year}-${month.toString().padStart(2, '0')}-${day.toString().padStart(2, '0')}`;
                return formattedDate;
            },
            Delquotation_top_lists:function (e){
                var _that = this;
                _that.quotation_top_lists.splice(e, 1);
            },
            open_const:function (e,a) {
                var _that = this;
                console.log('项目id');
                console.log(_that.previous_id);
                if(_that.previous_id >= 0){
                    _that.cost_list[_that.previous_id].status = false;
                }
                _that.cost_data.id =   e.id;
                _that.previous_id =   a;
                _that.cost_data.title =   e.title;
                _that.cost_data.content =   e.content;
                e.status    =   true;
                this.cuoct_status = false;

            },
            close_const:function () {
                var _that = this;
                _that.cost_data.id =   '';
                if(_that.previous_id >= 0){
                    _that.cost_list[_that.previous_id].status = false;
                }
                _that.previous_id =   -1;
                _that.cost_data.title =   '';
                _that.cost_data.content =   '';
                this.cuoct_status = false;

            },
            addcuoct:function () {
                var _that = this;
                _that.cost_data.id =   '';
                _that.cost_data.title =   '';
                _that.cost_data.content =   '';
                _that.cuoct_status  =   true;
                if(_that.previous_id >= 0){
                    _that.cost_list[_that.previous_id].status = false;
                }
                _that.previous_id =   -1;
            },
            open_not_included:function (e,a) {
                var _that = this;
                if(_that.NotPrevious_id >= 0){
                    _that.not_included[_that.NotPrevious_id].status = false;
                }
                _that.not_included_data.id =   e.id;
                _that.NotPrevious_id =   a;
                _that.not_included_data.content =   e.content;
                e.status    =   true;
                this.not_included_status = false;

            },
            close_not_included:function () {
                var _that = this;
                _that.not_included_data.id =   '';
                if(_that.NotPrevious_id >= 0){
                    _that.not_included[_that.NotPrevious_id].status = false;
                    console.log(_that.not_included[_that.NotPrevious_id]);
                }
                _that.NotPrevious_id =   -1;
                _that.not_included_data.title =   '';
                _that.not_included_data.content =   '';
                this.not_included_status = false;

            },
            addnot_included:function () {
                var _that = this;
                _that.not_included_data.id =   '';
                _that.not_included_data.title =   '';
                _that.not_included_data.content =   '';
                _that.not_included_status  =   true;
                if(_that.NotPrevious_id >= 0){
                    _that.not_included[_that.NotPrevious_id].status = false;
                }
                _that.NotPrevious_id =   -1;
            },
            open_PaidItems:function (e,a) {
                var _that = this;
                if(_that.PaidItemsId >= 0){
                    _that.PaidItemsList[_that.PaidItemsId].status = false;
                }
                _that.PaidItemsData.id =   e.id;
                _that.PaidItemsId =   a;
                _that.PaidItemsData.title = e.title;
                _that.PaidItemsData.content =   e.content;
                _that.PaidItemsStatus  =   false;
                e.status    =   true;
            },
            close_PaidItems:function () {
                var _that = this;
                _that.PaidItemsData.id =   '';
                console.log(_that.PaidItemsId);
                if(_that.PaidItemsId >= 0){
                    _that.PaidItemsList[_that.PaidItemsId].status = false;
                }
                _that.PaidItemsId =   -1;
                _that.PaidItemsData.title =   '';
                _that.PaidItemsData.content =   '';
                this.PaidItemsStatus = false;

            },
            addPaidItems:function () {
                var _that = this;
                _that.PaidItemsData.id =   '';
                _that.PaidItemsData.title =   '';
                _that.PaidItemsData.content =   '';
                _that.PaidItemsStatus  =   true;
                if(_that.PaidItemsId >= 0){
                    _that.PaidItemsList[_that.PaidItemsId].status = false;
                }
                _that.PaidItemsId =   -1;
            },
            open_supplement:function () {
                var _that = this;
                _that.supplementdatas.id = _that.supplementdata.id;
                _that.supplementdatas.content = _that.supplementdata.content;
                _that.supplementStatsu    =   true;
            },
            close_supplement:function () {
                var _that = this;
                _that.supplementdatas.id = '';
                _that.supplementdatas.content = '';
                _that.supplementStatsu    =   false;
            },
            GetQuotationList:function () {
                var _that = this;
                const url   =   "<?=$_Post_url?>?cmd=project_quotation&list=quotation";
                post_url(url,{key_id:_that.key_id},false).then(res => {
                    _that.quotation_top = res.data.list;
                    if(!_that.quotation_top_id){
                        _that.quotation_top_list = res.data.list[0].content;
                        _that.quotation_top_id = res.data.list[0].id;
                    }





                },error=>{
                    return false
                });
            },
            Setopenquotation:function () {
                var _that =   this;

                const url   =   "<?=$_Post_url?>?cmd=project_quotation&list=quotation_type";
                post_url(url,{key_id:_that.key_id},false).then(res => {

                    var classification_list = res.data.list.class_view;
                    _that.classification.forEach(function(item, index, arr) {
                        if(classification_list.indexOf(item.id) >= 0) {
                            _that.classification[index].status = true;
                        }
                    });

                    var grading_list = res.data.list.class_type;
                    _that.grading.forEach(function(item, index, arr) {
                        if(grading_list.indexOf(item.value) >= 0) {
                            item.status = true;
                        }
                    });
                    res.data.list.class_type_user.forEach(function(item, index, arr) {
                        _that.grading_user.push({
                            value:item,
                            status:false
                        })
                    });
                },error=>{
                    return false
                });
            },
            Setquotation:function () {
                var _that =   this;
                var code    =   {
                    classification:[],
                    grading:[],
                    grading_user:[]
                };
                var str;
                _that.classification.forEach(function(item, index, arr) {
                    if(item.status === true) {
                        str =   item.value
                        code.classification.push(str);
                    }
                });
                _that.grading.forEach(function(item, index, arr) {
                    if(item.status === true) {
                        str =   item.value
                        code.grading.push(str);
                    }
                });
                _that.grading_user.forEach(function(item, index, arr) {
                        str =   item.value
                        code.grading_user.push(str);
                });
                console.log(code)
                const url   =   "<?=$_Post_url?>?cmd=project_quotation&list=classification";
                post_url(url,{key_id:_that.key_id,code:code},false,true).then(res => {
                    $('.setPrise').css('display', 'none')
                    _that.quotation_top_id  =   0;
                    _that.GetQuotationList();
                },error=>{
                    return false
                });
            },
            opneUserType:function () {
              var _that =   this;
                _that.grading_data   =   ''
              if(_that.addUserTypeStatus == false){
                  _that.addUserTypeStatus   =   true
              }else {
                  _that.addUserTypeStatus   =   false
              }
            },
            addUserType:function () {
                var _that =   this;
                var str =   {
                    value: _that.grading_data,
                    status: false
                };
                _that.grading_data  =   '';
                _that.addUserTypeStatus  =   false;
                _that.grading_user.push(str);
            },
            delgrading_user:function (e) {
                this.grading_user.splice(e, 1);

            },
            item_status:function (e) {
                if(e.status == false){
                    e.status = true
                }else {
                    e.status = false
                }
            },
            openItinerary:function (e) {
                var _that =   this;
                _that.quotation_top_list = e.content;
                _that.quotation_top_id = e.id;
                _that.quotation_top_status = true;
            },
            post_time:function () {
                var _that =   this;
                const url   =   "<?=$_Post_url?>?cmd=project_quotation&list=setTime";
                post_url(url,{key_id:_that.key_id,key:_that.quotation_top_id,data:_that.quotation_top_lists},false,true).then(res => {
                    _that.GetQuotationList();
                    _that.quotation_top_list   =   _that.quotation_top_lists;
                    _that.quotation_top_status = true;

                },error=>{
                    return false
                });
            },
            GetConstList:function () {
                var _that = this;
                const url   =   "<?=$_Post_url?>?cmd=project_quotation&list=Const";
                post_url(url,{key_id:_that.key_id},false).then(res => {
                    _that.cost_list = res.data.list;
                },error=>{
                    return false
                });
            },
            Post_const:function () {
                var _that =   this;
                const url   =   "<?=$_Post_url?>?cmd=project_quotation&list=setConst";
                post_url(url,{key_id:_that.key_id,data:_that.cost_data},false,true).then(res => {
                    _that.GetConstList();
                    _that.cuoct_status = false;

                },error=>{
                    return false
                });
            },
            GetNotIncludedList:function () {
                var _that = this;
                const url   =   "<?=$_Post_url?>?cmd=project_quotation&list=NotIncluded";
                post_url(url,{key_id:_that.key_id},false).then(res => {
                    _that.not_included = res.data.list;
                },error=>{
                    return false
                });
            },
            Post_NotIncluded:function () {
                var _that =   this;
                const url   =   "<?=$_Post_url?>?cmd=project_quotation&list=setNotIncluded";
                post_url(url,{key_id:_that.key_id,data:_that.not_included_data},false,true).then(res => {
                    _that.GetNotIncludedList();
                    _that.not_included_status = false;

                },error=>{
                    return false
                });
            },
            GetPaidItemsList:function () {
                var _that = this;
                const url   =   "<?=$_Post_url?>?cmd=project_quotation&list=PaidItems";
                post_url(url,{key_id:_that.key_id},false).then(res => {
                    _that.PaidItemsList = res.data.list;
                },error=>{
                    return false
                });
            },
            Post_PaidItems:function () {
                var _that =   this;
                const url   =   "<?=$_Post_url?>?cmd=project_quotation&list=setPaidItems";
                post_url(url,{key_id:_that.key_id,data:_that.PaidItemsData},false,true).then(res => {
                    _that.GetPaidItemsList();
                    _that.PaidItemsStatus = false;

                },error=>{
                    return false
                });
            },
            GetSupplementList:function () {
                var _that = this;
                const url   =   "<?=$_Post_url?>?cmd=project_quotation&list=supplement";
                post_url(url,{key_id:_that.key_id},false).then(res => {
                    _that.supplementdata = res.data.list;
                },error=>{
                    return false
                });
            },
            Post_supplement:function () {
                var _that =   this;
                const url   =   "<?=$_Post_url?>?cmd=project_quotation&list=setsupplement";
                post_url(url,{key_id:_that.key_id,data:_that.supplementdatas},false,true).then(res => {
                    _that.GetSupplementList();
                    _that.supplementStatsu = false;

                },error=>{
                    return false
                });
            },
            Del_quotation:function (e,type) {
                event.stopPropagation();
                var _that =   this;
                const url   =   "<?=$_Post_url?>?cmd=project_quotation&list=DelQuotation";
                post_url(url,{key_id:_that.key_id,key:e},false,true).then(res => {
                    switch (type) {
                        case 1:
                            _that.GetConstList()
                            break;
                        case 2:
                            _that.GetNotIncludedList()
                            break;
                        case 3:
                            _that.GetPaidItemsList()
                            break;

                    }
                },error=>{
                    return false
                });
            }
        },
        created(){
            this.GetProjectData();
            this.GetQuotationList();
            this.GetConstList();
            this.GetNotIncludedList();
            this.GetPaidItemsList();
            this.GetSupplementList();
            this.Setopenquotation();
        }
    })



</script>
