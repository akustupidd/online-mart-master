
<style>
  .validate_msg{color:red};
</style>
<?php
error_reporting(0);
if($_SESSION['id']){
    $user_id = $_SESSION['id'];
    $user_pas = trim($_SESSION['pass']);
    ?>
   <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Checkout</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <a href="index.php?p=shop">Shop</a>
                            <span>Checkout</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h6><span class="icon_tag_alt"></span> Have a coupon? <a href="#">Click here</a> to enter your code
                    </h6>
                </div>
            </div>
            <div class="checkout__form">
            <form action="" method="POST">
                <h4>Billing Details</h4>
                <?php
                                # Check session id
                                $selectSeID="select * from tbl_session where user_id=$user_id";
                                $selectResult=$conn->query($selectSeID);
                                $rowSes=$selectResult->fetch_row();
                                $ses_id=$rowSes[0];
                                # Error message
                                $msg_first='<div class= "validate_msg">Require First Name</div>';
                                $msg_last='<div class= "validate_msg">Require First Name</div>';
                                $msg_country='<div class= "validate_msg">Require Country</div>';
                                $msg_address='<div class= "validate_msg">Require Address</div>';
                                $msg_city='<div class= "validate_msg">Require Town</div>';
                                #$msg_country='<div class= "validate_msg">Require Country</div>';
                                $msg_POSTcode='<div class= "validate_msg">Require PostCode</div>';   
                                $msg_phone='<div class= "validate_msg">Require Phone Number</div>';   
                                $msg_email='<div class= "validate_msg">Require Email</div>';   
                                $msg_password='<div class= "validate_msg">Require Account Password</div>';   
                                
                                $err1 = $err2 = $err3 = $err4 = $err5 = $err6 = $err7= $err8= $err9= '';
                                if(isset($_POST['btnSubmit'])){
                                    $selectMaxPay = "select MAX(payment_id)+1 from tbl_orders;";
                                    $selectResult = $conn->query($selectMaxPay);
                                    $rowPay = $selectResult->fetch_row();
                                    $fn = $conn->real_escape_string($_POST['txt_fn']);
                                    $ln = $conn->real_escape_string($_POST['txt_ln']);
                                    $co = $conn->real_escape_string($_POST['txt_co']);
                                    $add = $conn->real_escape_string($_POST['txt_add']);
                                    $city = $conn->real_escape_string($_POST['txt_town']);
                                    $POSTCo = $conn->real_escape_string($_POST['txt_POSTCo']);
                                    $phone = $conn->real_escape_string($_POST['txt_phone']);
                                    $email = $conn->real_escape_string($_POST['txt_email']);
                                    $password = $conn->real_escape_string($_POST['txt_pass']);
                                    if($fn ==''){$err1=$msg_first;}
                                    if($ln ==''){$err2=$msg_last;}
                                    if($co ==''){$err3=$msg_country;}
                                    if($add ==''){$err4=$msg_address;}
                                    if($city ==''){$err5=$msg_city;}
                                    if($POSTCo ==''){$err6=$msg_POSTcode;}
                                    if($phone ==''){$err7=$msg_phone;}
                                    if($email ==''){$err8=$msg_email;}
                                    if($password ==''){$err9=$msg_password;}
                                    else{
                                        if ($fn != '' && $ln != '' && $co != '' && $add != '' && $city != '' && $POSTCo != '' && $phone != ''&& $password != '') {
                                            if ($_SESSION['pass'] == $password) {
                                                # Display user id and total to insert into order table 
                                                $selectCart = "
                                                            SELECT
                                                            user_id,
                                                            SUm( c.Qty * p.Pprice ) as total
                                                            FROM
                                                            tbl_cartitem c
                                                            JOIN tbl_products p on c.Pid = p.Pid
                                                            JOIN tbl_session s on s.SesID = c.SesID
                                                            WHERE user_id=$user_id;";
                                                $resultcart = $conn->query($selectCart);
                                                while ($row = mysqli_fetch_array($resultcart)) {
                                                    #  Insert into Order Table
                                                    $insertOrder = "insert into tbl_orders (user_id,total,payment_id,Created) 
                                                                    values (?,?,?,now());";
                                                    $stmt = $conn->prepare($insertOrder);
                                                    $stmt->bind_param("iii", $row[0], $row[1], $rowPay[0]);
                                                    if ($stmt->execute()) {
                                                        echo "
                                                        <div class='alert alert-primary' role='alert'>
                                                            Your Order Has Been Placed
                                                        </div>";
                                                        # Check if user already input info
                                                        $checkIfInfoExist="select * from tbl_user_info where user_id=$user_id";
                                                        $checkInfoRes = $conn->query($checkIfInfoExist);
                                                        $rowInfo = $checkInfoRes->fetch_row();
                                                        if(count($rowInfo)==0){
                                                            # Insert Information into user info table
                                                            $insertUserInfo = "INSERT into tbl_user_info(user_id,Firstname,Lastname,country,addre,city,postcode,phone) 
                                                                                values (?,?,?,?,?,?,?,?);";
                                                            $stmtInfo = $conn->prepare($insertUserInfo);
                                                            $stmtInfo ->bind_param("isssssss",$user_id,$fn,$ln,$co,$add,$city,$POSTCo,$phone);
                                                            if(!$stmtInfo->execute()){
                                                                echo $stmtInfo->error;
                                                            }                                           
                                                        }else{
                                                            $updateInfo = "update tbl_user_info set user Firstname=$fn,Lastname=$ln,country=$co,addre=$add ,city=$city,postcode=$POSTCo,phone=$phone where user_id=$user_id";
                                                            $updateRes = $conn->query($updateInfo);
                                                        }
                                                        
                                                        # Select and insert into Order Detail table
                                                        $selectOrderDetail = "select Odid,Pid,Pprice,Qty 
                                                                            from tbl_cartitem c join tbl_session s on c.SesID = s.SesID
                                                                            join tbl_orders o on s.user_id = o.user_id
                                                                            where o.user_id=$user_id;";
                                                        $orderDetailRes = $conn->query($selectOrderDetail);
                                                        while($rowOdd=mysqli_fetch_array($orderDetailRes)){
                                                            # Update Stock
                                                            $stock = "update tbl_products set Pstock = Pstock - ".$rowOdd['Qty']." where Pid=".$rowOdd['Pid'];
                                                            $updateStock = $conn->query($stock);
                                                            #Insert Into Order Detail
                                                            $insertOrderDetail = "insert into tbl_orderdetail(Odid,Pid,Price,Qty) 
                                                                                values (?,?,?,?)";
                                                            $stmt_ODD = $conn->prepare($insertOrderDetail);
                                                            $stmt_ODD->bind_param("iiii", $rowOdd[0], $rowOdd[1], $rowOdd[2], $rowOdd[3]);
                                                            $stmt_ODD->execute();
                                                        }
                                                        # Delete Product ID from cart item table when finish Payemnt process
                                                        $delteRes = $conn->query("delete from tbl_cartitem where SesID=$ses_id");
                                                    } else {
                                                        echo "
                                                            <div class='alert alert-danger' role='alert'>
                                                                Error
                                                            </div>
                                                        ";
                                                    }
                                                }

                                            } else {
                                                echo "
                                                <div class='alert alert-danger' role='alert'>
                                                    Wrong password
                                                </div>
                                            ";
                                            }
                                       }else{
                                                echo "
                                                <div class='alert alert-alert' role='alert'>
                                                    Field Require
                                                </div>
                                            ";
                                       }
                                    }   
                                }
                            ?>
                
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Fist Name<span>*</span></p>
                                        <input type="text" name="txt_fn">
                                        <?= $err1; ?>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Last Name<span>*</span></p>
                                        <input type="text" name="txt_ln">
                                        <?= $err2; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input">
                                <p>Country<span>*</span></p>
                                <input type="text" name="txt_co" value="Cambodia">
                                <?= $err3; ?>
                            </div>
                            <div class="checkout__input">
                                <p>Address<span>*</span></p>
                                <input type="text" placeholder="Street Address" class="checkout__input__add" name="txt_add">
                                <?= $err4; ?>
                            </div>
                            <div class="checkout__input">
                                <p>Town/City<span>*</span></p>
                                <input type="text" name="txt_town">
                                <?= $err5; ?>
                            </div>
                            <div class="checkout__input">
                                <p>Postcode / ZIP<span>*</span></p>
                                <input type="text" name="txt_POSTCo">
                                        <?= $err6; ?>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Phone<span>*</span></p>
                                        <input type="text" name="txt_phone">
                                        <?= $err7;?>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Email<span>*</span></p>
                                        <input type="text" name="txt_email">
                                        <?= $err8;?>
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input">
                                <p>Account Password<span>*</span></p>
                                <input type="text" name="txt_pass">
                                        <?= $err9; ?>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h4>Your Order</h4>
                                <div class="checkout__order__products">Products <span>Total</span></div>
                                <ul>
                                <?php
                                        
                                        $sql="
                                                SELECT
                                                tp.Pname,
                                                tp.Pprice,
                                                tc.Qty 
                                            FROM
                                                tbl_cartitem tc
                                                JOIN tbl_products tp 
                                            WHERE
                                                tc.Pid = tp.Pid and tc.SesID=$ses_id
                                            ORDER BY
                                                caid asc;
                                        ";
                                        $result = mysqli_query($conn,$sql);
                                        $i=01;
                                        while ($row = mysqli_fetch_array($result)) {
                                            echo "<li>".$i++.". ".$row['Pname']."<span>$ ".$row['Qty']*$row['Pprice']."</span></li>";
                                        }
                                        ?>
                                </ul>
                                <?php
                                    $sql="select sum(c.Qty * p.Pprice) as SUM from tbl_products p join tbl_cartitem c where c.Pid=p.Pid and c.SesID=$ses_id ";
                                    $results = mysqli_query($conn,$sql);
                                    $totalResult = mysqli_fetch_array($results)
                                    ?>
                                <div class="checkout__order__subtotal">Subtotal <span>$<?php echo $totalResult['SUM'] ?></span></div>
                                <div class="checkout__order__total">Total <span>$<?php echo $totalResult['SUM'] ?></span></div>
                                <div class="checkout__input__checkbox">
                                    <label for="acc-or">
                                        Create an account?
                                        <input type="checkbox" id="acc-or">
                                        <a href="pages/signup.php"><span class="checkmark"></span></a>
                                    </label>
                                </div>
                                <p>Lorem ipsum dolor sit amet, consectetur adip elit, sed do eiusmod tempor incididunt
                                    ut labore et dolore magna aliqua.</p>
                                <button type="submit" name="btnSubmit" class="site-btn">PLACE ORDER</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <?php
        }else{
            header("location: pages/login.php");
        }
    ?>
    <!-- Checkout Section End -->

