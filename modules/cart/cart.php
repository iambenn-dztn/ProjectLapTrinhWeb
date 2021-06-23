<?php
if(isset($_SESSION['cart'])) {
if(isset($_POST['sbm'])) {
    $_SESSION['cart'] = $_POST['cart'];
}
$arr_key = array_keys($_SESSION['cart']);
// print_r($arr_key);
$str_key = implode(",", $arr_key);
// print_r($str_key);
$sql = "SELECT * FROM product WHERE prd_id IN ($str_key)";
$data = mysqli_query($conn, $sql);
?>
                <!--	Cart	-->
                <div id="my-cart">
                	<div class="row">
                        <div class="cart-nav-item col-lg-7 col-md-7 col-sm-12">Thông tin sản phẩm</div> 
                        <div class="cart-nav-item col-lg-2 col-md-2 col-sm-12">Tùy chọn</div> 
                        <div class="cart-nav-item col-lg-3 col-md-3 col-sm-12">Thành tiền</div>    
                    </div>  
                    <form method="post">
                       <?php  $tong_tien = 0;

                        ?>
                    <?php while($row = mysqli_fetch_array($data)) { 
                         $thanh_tien = $_SESSION['cart'][$row['prd_id']] * $row['prd_price'];
                        ?>
                    <div class="cart-item row">
                        <div class="cart-thumb col-lg-7 col-md-7 col-sm-12">
                        	<img src="admin/img/products/<?php echo $row['prd_image']; ?>">
                            <h4><?php echo $row['prd_name']; ?></h4>
                        </div> 
                        
                        <div class="cart-quantity col-lg-2 col-md-2 col-sm-12">
                        	<input type="number" id="quantity" class="form-control form-blue quantity" value="<?php echo $_SESSION['cart'][$row['prd_id']]; ?>" min="1" name="cart[<?php echo $row['prd_id']; ?>]">
                        </div> 
                        <div class="cart-price col-lg-3 col-md-3 col-sm-12"><b><?php echo $thanh_tien; ?></b><a onclick=" return delItem('<?php echo $row['prd_name']; ?>')" href="modules/cart/del_cart.php?prd_id=<?php echo $row['prd_id']; ?>">Xóa</a></div>    
                    </div>  
                        <?php 
                         $tong_tien += $thanh_tien;
                          ?>
                    <?php } ?>
                    <div class="row">
                    	<div class="cart-thumb col-lg-7 col-md-7 col-sm-12">
                        	<button id="update-cart" class="btn btn-success" type="submit" name="sbm">Cập nhật giỏ hàng</button>	
                        </div> 
                        <div class="cart-total col-lg-2 col-md-2 col-sm-12"><b>Tổng cộng:</b></div> 
                        <div class="cart-price col-lg-3 col-md-3 col-sm-12"><b><?php echo number_format($tong_tien); ?></b></div>
                    </div>
                    </form>
                               
                </div>
            <?php } else { ?>
                    <div class="alert alert-danger">
                        <strong>Giỏ hàng trống</strong>
                    </div>
            <?php }
                include "modules/cart/customer.php";
            ?> 
                <!--	End Cart	-->             
<script type="text/javascript">
    function delItem(name)
    {
        return confirm('Bạn muốn xóa sản phẩm : '+name+'?');
    }
</script>
 