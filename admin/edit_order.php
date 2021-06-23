<?php
//  Show Product then ID
$order_id = $_GET["order_id"];
$sql_order = "SELECT * FROM tbl_order
            WHERE order_id = $order_id";
$query_order = mysqli_query($conn, $sql_order);
$row_order = mysqli_fetch_array($query_order);

//  Update Product
if(isset($_POST["sbm"])){
    $order_name = $_POST["order_name"];
    $order_number = $_POST["order_number"];
    $order_mail = $_POST["order_mail"];
    $order_address = $_POST["order_address"];
    $order_product=$_POST["order_product"];
    $order_price=$_POST["order_price"];
    $sql = "UPDATE tbl_order
            SET order_name = '$order_name', 
                order_number = '$order_number', 
                order_mail = '$order_mail', 
                order_address = '$order_address',
                order_product = '$order_product',
                order_price = '$order_price'
            WHERE order_id = $order_id";

    mysqli_query($conn, $sql);
    header("location: index.php?page_layout=order");
}

?>

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><svg class="glyph stroked home">
                        <use xlink:href="#stroked-home"></use>
                    </svg></a></li>
            <li><a href="">Quản lý đơn hàng</a></li>
            <li class="active"><?php echo $row_order["order_id"];?></li>
        </ol>
    </div>
    <!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Đơn hàng: <?php echo $row_order["order_id"];?></h1>
        </div>
    </div>
    <!--/.row-->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-md-6">
                        <form role="form" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Tên khách hàng</label>
                                <input type="text" name="order_name" required class="form-control" value="<?php echo $row_order["order_name"];?>" placeholder="">
                            </div>

                            <div class="form-group">
                                <label>Số điện thoại</label>
                                <input type="number" name="order_number" required value=<?php echo $row_order["order_number"];?> class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" name="order_mail" required value="<?php echo $row_order["order_mail"];?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Địa chỉ</label>
                                <input type="text" name="order_address" required value="<?php echo $row_order["order_address"];?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Sản phẩm</label>
                                <input type="text" name="order_product" required value="<?php echo $row_order["order_product"];?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Tổng tiền</label>
                                <input type="text" name="order_price" required value="<?php echo $row_order["order_price"];?>" class="form-control">
                            </div>
                    </div>
                    <div class="col-md-6">
                        <button type="submit" name="sbm" class="btn btn-primary">Cập nhật</button>
                    </div>
                    </form>
                </div>
            </div>
        </div><!-- /.col-->
    </div><!-- /.row -->

</div>
<!--/.main-->