<?php
$sql = "SELECT * FROM tbl_order";
$query = mysqli_query($conn, $sql);
?>
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Danh sách đơn hàng</li>
			</ol>
		</div>
        <!--/.row-->
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Danh sách đơn hàng</h1>
			</div>
		</div><!--/.row-->
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-body">
                        <table 
                            data-toolbar="#toolbar"
                            data-toggle="table">

						    <thead>
						    <tr>
                                <th>ID</th>
                                <th>Tên khách hàng</th>
                                <th>Số điện thoại</th>
                                <th>Email</th>
                                <th>Địa chỉ</th>
                                <th>Sản phẩm</th>
                                <th>Tổng tiền</th>
						    </tr>
                            </thead>
                            <tbody>
                                    <?php
                                    while($row = mysqli_fetch_array($query)){
                                    ?>
                                    <tr>
                                        <td style=""><?php echo $row['order_id'];?></td>
                                        <td style=""><?php echo $row['order_name'];?></td>
                                        <td style=""><?php echo $row['order_number'];?></td>
                                        <td style=""><?php echo $row['order_mail'];?></td>
                                        <td style=""><?php echo $row['order_address'];?></td>
                                        <td style=""><?php echo $row['order_product'];?></td>
                                        <td style=""><?php echo $row['order_price'];?></td>
                                        <td class="form-group">
                                            <a href="index.php?page_layout=edit_order&order_id=<?php echo $row['order_id'];?>" class="btn btn-primary"><i class="glyphicon glyphicon-pencil"></i></a>
                                            <a onclick="return delOrder('<?php echo $row['order_id'];?>')" href="del_order.php?order_id=<?php echo $row['order_id'];?>" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
                                        </td>
                                    </tr>
                                    <?php
                                    }
                                    ?>
                                 </tbody>
						</table>
                    </div>
				</div>
			</div>
		</div><!--/.row-->	
	</div>	<!--/.main-->

	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap-table.js"></script>	
<script type="text/javascript">
    function delOrder(id)
    {
        return confirm('Bạn muốn xóa đơn hàng: '+id+' ?');
    }
</script>
