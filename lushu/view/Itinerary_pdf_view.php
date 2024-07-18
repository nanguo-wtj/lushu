<?php include(dirname(__FILE__,2) . '/layout/header.php');?>

<style>
    html,body{
        width: 100%;
        height: 100%;
    }
    .top{
        width: 100%;
        height: 5%;
        background-color: #21b2b3;
        color: white;
    }
    .body{
        width: 100%;
        height: 90%;
        overflow: auto;
    }
    .title{
        width: 80%;
        float: left;
        font-size: 21px;
        margin-left: 100px;
        line-height: 35px;
    }
    .content{
        width: auto;
        float: right;
        margin-right: 100px;
        font-size: 21px;
        line-height: 35px;
    }

    div{
        line-height: 45px;
        font-size: 22px!important;
        color: #737373;
    }
    span{
        font-size: 22px!important;
        color: #737373 ;
        height: 50px!important;
        line-height: 60px!important;
    }
</style>
<body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<div id="webMain" ref="pageTop">
    <div>
        <div class="emptyPageWrap" style="background-color: #fbfbfb;">
            <div class="navBarSpace">
                <div class="navBar">
                    <div class="left">
                        <a class="globalLink logo" href="/"></a>
                    </div>
                </div>
            </div>
            <div class="alertMsgCont">
                <div class="rotateWrap loading">
                    <img src="<?=$_static?>/gif/2.gif" style="width:10rem;height: 10rem">
                </div>
                <div>正在导出PDF。这可能需要几分钟时间，请耐心等候。</div>
            </div>
        </div>
    </div>
</div>


</body>

</html>