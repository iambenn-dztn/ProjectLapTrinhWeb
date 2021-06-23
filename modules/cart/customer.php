<!-- <script src="https://www.google.com/recaptcha/api.js" async defer></script> -->
<?php
require 'SENDMAIL/src/Exception.php';
require 'SENDMAIL/src/PHPMailer.php';
require 'SENDMAIL/src/SMTP.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$sqlor="";
    if(isset($_POST['name'] )){
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $sqlor="INSERT INTO tbl_order(order_name,order_number,order_mail,order_address,order_product,order_price) 
                VALUES ('$name','$phone','$email','$address','";

        // mysqli_query($conn, $sqlor);
    }



try {
    if (isset($_POST['name'])) {
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $address = $_POST['address'];
    
        //lấy ndung mail gửi đi
        $mailHTML = '';
        $mailHTML .= '<div style="text-align: center;"><p>SIEUTHISMARTPHONE</p>
    </div>
    <p>
    <b>Khách hàng:</b>' . $name . '<br>
    <b>Điện thoại:</b> ' . $phone . '<br>
    <b>Địa chỉ:</b> ' . $address . '<br>
    </p>
    
    
    <table border="1" cellspacing="0" cellpadding="10" bordercolor="#305eb3" width="100%">
    <tr bgcolor="#305eb3">
        <td width="70%"><b>
                <font color="#FFFFFF">Sản phẩm</font>
            </b></td>
        <td width="10%"><b>
                <font color="#FFFFFF">Số lượng</font>
            </b></td>
        <td width="20%"><b>
                <font color="#FFFFFF">Thành tiền</font>
            </b></td>
    </tr>';
        $sql = "SELECT * FROM product WHERE prd_id IN ($str_key)";
        $data = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_array(($data))) {
            $thanh_tien = $_SESSION['cart'][$row['prd_id']] * $row['prd_price'];

            $sqlor.=$_SESSION['cart'][$row['prd_id']]." : ".$row['prd_name']."  ;";
            $mailHTML .= ' <tr>
        <td width="70%">' . $row['prd_name'] . '</td>
        <td width="10%">' . $_SESSION['cart'][$row['prd_id']] . '</td>
        <td width="20%">' . $thanh_tien . '</td>
    </tr>';
        }
        $mailHTML .= '<tr>
        <td colspan="2" width="70%"></td>
        <td width="20%"><b>
                <font color="#FF0000">'. $tong_tien .'</font>
            </b></td>
    </tr>
    </table>
    <p>
    Cám ơn quý khách đã mua hàng tại Shop của chúng tôi, bộ phận giao hàng sẽ liên hệ với quý khách để xác nhận sau 5
    phút kể từ khi đặt hàng thành công và chuyển hàng đến quý khách chậm nhất sau 24 tiếng.
    </p>';
        $sqlor.="','".$tong_tien."')";
        //Gửi mail
        $mail = new PHPMailer(true);
    
        try {
            //Server settings
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'nguyenthediem020999@gmail.com';                     // SMTP username
            $mail->Password   = 'ahwkltjnrdccuuir';                               // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
            $mail->Port       = 587;                                    // TCP port to connect to
            $mail->CharSet = 'UTF-8';
    
            //Recipients
            $mail->setFrom('nguyenthediem020999@gmail.com', 'SIEUTHISMARTPHONE');
            $mail->addAddress($email, 'Khách hàng');     // Add a recipient
    
            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Tiêu đề';
            $mail->Body    = $mailHTML;
            mysqli_query($conn, $sqlor);
            $mail->send();
            unset($_SESSION['cart']);   
            // header('location:index.php?page_layout=success');
        } catch (Exception $e) {
            echo "Hãy nhập email để chúng tôi có thể liên hệ với bạn. {$mail->ErrorInfo}";
        }
    }
} catch (Exveption $e) {
    echo "Giỏ hàng rỗng.";
}
?>
<!--	Customer Info	-->
<div id="customer">
    <form method="post" id="info">
        <div class="row">

            <div id="customer-name" class="col-lg-4 col-md-4 col-sm-12">
                <input placeholder="Họ và tên" type="text" name="name" id="customername" class="form-control" required>
            </div>
            <div id="customer-phone" class="col-lg-4 col-md-4 col-sm-12">
                <input placeholder="Số điện thoại" type="text" name="phone" class="form-control" required>
            </div>
            <div id="customer-mail" class="col-lg-4 col-md-4 col-sm-12">
                <input placeholder="Email" type="text" name="email" class="form-control" required>
            </div>
            <div id="customer-add" class="col-lg-12 col-md-12 col-sm-12">
                <input placeholder="Địa chỉ " type="text" name="address" class="form-control" required>
            </div>

        </div>
    </form>
    <div class="row">
        <div class="by-now col-lg-6 col-md-6 col-sm-12">

            <button type="button">
                <a onclick="byNow()">
                    <b>Mua ngay</b>
                </a>
            </button>
        </div>
    </div>
</div>
<!--	End Customer Info	-->
<script>
    function byNow() {
        document.getElementById('info').submit();
    }
</script>
