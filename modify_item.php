<!DOCTYPE html>
<html lang="en" class="no-js">
    <head>
        <meta charset="utf-8">
        <title></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
<!--         <link rel="stylesheet" href="assets/css/reset.css">
        <link rel="stylesheet" href="assets/css/supersized.css"> -->
        <!-- <link rel="stylesheet" href="assets/css/style.css"> -->
        <link rel="stylesheet" type="text/css" href="assets/bootstrap-3.3.7-dist/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="assets/bootstrap-3.3.7-dist/css/bootstrap-theme.css">
        <style type="text/css">
            .form-control{
                margin-top: 10px;
                height: 60px;
                font-size: 30px;
            }
            button{

                margin: 10px;
                font-size: 30px;
                width: 100%;
            }
            .btn{
                margin-top: 10px;
            }
        </style>
    </head>
    <body >
        <div class="container">
    <?php
    include("conn.php");
    $id=$_GET[id];
    $sql=mysql_query("select * from items where id=$id");
    $item=mysql_fetch_assoc($sql);
    ?>
            <div class="row">
                <h1 style="text-align:center;">修改配件信息</h1>
            </div>
            <input type="hidden" id="id" class="form-control"  maxlength="30" value="<?php echo $item['id'] ?>">
            <div class="row">
                <div class="col-xs-2"></div>
                <div class="col-xs-3"><h1>配件编号</h1></div>
                <div class="col-xs-6"><input type="text" id="type" class="form-control" placeholder="请输入配件编号" maxlength="20" value="<?php echo $item['type']; ?>"></div>
            </div>
            <div class="row">
                <div class="col-xs-2"></div>
                <div class="col-xs-3"><h1>配件名称</h1></div>
                <div class="col-xs-6"><input type="text" id="name" class="form-control" placeholder="请输入配件名称" maxlength="30" value="<?php echo $item['name'];?>"></div>
            </div>
            <div class="row">
                <div class="col-xs-2"></div>
                <div class="col-xs-3"><h1>配件价格</h1></div>
                <div class="col-xs-6"><input type="text" id="price" class="form-control" placeholder="请输入配件价格(元)" maxlength="15" value="<?php echo $item['price']; ?>"></div>
            </div>
            <div class="row">
                <div class="col-xs-2"></div>
                <div class="col-xs-3"><h1>配件商家</h1></div>
                <div class="col-xs-6"><input type="text" id="firm" class="form-control" placeholder="请输入配件商家" maxlength="15" value="<?php echo $item['firm']; ?>"></div>
            </div>
            <div class="row">
                <div class="col-xs-2"></div>
                <div class="col-xs-3"><h1>配件产地</h1></div>
                <div class="col-xs-6"><input type="text" id="place" class="form-control" placeholder="请输入配件产地" maxlength="15" value="<?php echo $item['place']; ?>"></div>
            </div>
            <div class="row">
                <div class="col-xs-2"></div>
                <div class="col-xs-3"><h1>配件备注信息</h1></div>
                <div class="col-xs-6"><input type="textarea" id="remarks" class="form-control" placeholder="请输入配件备注信息" maxlength="255" value="<?php echo $item['remarks']; ?>"></div>
            </div>     
            <div class="row">
                <div class="col-xs-3"></div>
                <div class="col-xs-6"><button  class="btn btn-success btn-lg btn-block" onClick="modify_ok()"><h1>修改</h1></button></div>
            </div>      
            <div class="row">
                <div class="col-xs-3"></div>
                <div class="col-xs-6"><button  class="btn btn-danger btn-lg btn-block" onClick="cancel()"><h1>取消</h1></button></div>
            </div>            
        </div>
        <!-- Javascript -->
        <script src="javascripts/jquery-1.8.2.min.js"></script>
        <script type="text/javascript" src="assets/layer-v3.1.1/layer/layer.js"></script>

    </body>
</html>

<!-- <script type="text/javascript" src="assets/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script> -->
<script type="text/javascript">

var index = parent.layer.getFrameIndex(window.name); //获取窗口索引

    function modify_ok(){
        var name=document.getElementById("name").value;
        var type=document.getElementById("type").value;
        console.log("***************sinstitute_value***************");   
        // var sinstitute = document.getElementById("institute"); //定位id
        // var sinstitute_index= sinstitute.selectedIndex; // 选中索引
        var price = document.getElementById('price').value;
        var remarks = document.getElementById('remarks').value;
        var place = document.getElementById('place').value;
        var firm = document.getElementById('firm').value;
        var id = document.getElementById('id').value;
        console.log(type);
        $.ajax({
            type: 'post',
            url : "modify_ok.php",
            data : {"name":name,"type":type,"price":price,"remarks":remarks,"id":id,"firm":firm,"place":place},
            dataType:'JSON', 
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            success : function(data) {
               // if(data['status']==1){
                    parent.layer.msg(data['msg']);
                    parent.location.reload(true);
                    parent.layer.close(index);

               // }
            },
            error : function(err) {
                alert("修改失败");
            }
        });
    }
    function cancel(){
        parent.layer.close(index);
    }
</script>
