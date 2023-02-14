
<?php
    
    if(isset($_SESSION['id'])){
        $user_id = $_SESSION['id'];
        #Check Session 
        $selectSeID="select * from tbl_session where user_id=$user_id";
        $selectResult=$conn->query($selectSeID);
        $rowSes=$selectResult->fetch_row();
        $ses_id=$rowSes[0];
        #Display Cart Item
        $is_Has="select * from tbl_cartitem c join tbl_session s where c.SesID=$ses_id";
        $productCart="
                           SELECT
                           tc.CaID,
                           tp.Pname,
                           tp.Pprice,
                           tp.Pimg,
                           tc.Qty 
                       FROM
                           tbl_cartitem tc
                           JOIN tbl_products tp 
                       WHERE
                           tc.Pid = tp.Pid and tc.SesID=$ses_id
                       ORDER BY
                           caid DESC;
                   ";
        $sql="select sum(Qty * Pprice) as SUM from tbl_cartitem where Pid=Pid and SesID=$ses_id";
    }else{
        $is_Has="select * from tbl_cartitem c join tbl_session s where c.SesID=1010";
        $productCart="
                         SELECT
                         tc.CaID,
                         tp.Pname,
                         tp.Pprice,
                         tp.Pimg,
                         tc.Qty 
                     FROM
                         tbl_cartitem tc
                         JOIN tbl_products tp 
                     WHERE
                         tc.Pid = tp.Pid and tc.SesID=1010
                     ORDER BY
                         caid DESC;
                     ";
                     #Display Total
        $sql="select sum(Qty * Pprice) as SUM from tbl_cartitem where Pid=Pid and SesID=1010";
    }
    
?>

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Shopping Cart</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.php">Home</a>
                            <span>Shopping Cart</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->






    <!-- Shoping Cart Section Begin -->
    <section class="shoping-cart spad">
	<?php 
        $checkRes=$conn->query($is_Has);
        $Res = mysqli_num_rows($checkRes);
        if($Res): 
            ?>
			<form action="pages/update.php" method="POST">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th class="shoping__product">Products</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
							
										
                            <tbody>
							
						<?php
                                            
                            $result = mysqli_query($conn,$productCart);
                            while ($row = mysqli_fetch_array($result)) {
                        ?>
								
							
                                <tr>
                                    <td class="shoping__cart__item">
                                        <?php
                                           echo '<img src="data:image/jpeg;base64,'.base64_encode($row['Pimg']) .'" width = "100" height = "100" />';
                                        ?>
                                        <h5><?=$row['Pname']?></h5>
                                    </td>
                                    <td class="shoping__cart__price">
                                         <h5>$<?=$row['Pprice']?></h5>
                                    </td>
                                    <td class="shoping__cart__quantity">
                                        <div class="quantity">
                                            <div class="pro-qty">
                                                <input type="text" value="<?=$row['Qty']?>" name="txt_qty[]">
                                            </div>
											<input type="hidden" value="<?= $row['CaID']?>" name="txt_ca[]">
                                        </div>
                                    </td>
                                    <td class="shoping__cart__total">
                                        $<?= $row['Qty'] * $row['Pprice'] ?>
                                    </td>
                                    <td class="shoping__cart__item__close">
                                       <a href="pages/delete.php?Caid=<?= $row['CaID'] ?>"> <span class="icon_close"></a></span>
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
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__btns">
                        <a href="index.php?p=shop" class="primary-btn cart-btn">CONTINUE SHOPPING</a>
                        <button type="submit" class="primary-btn cart-btn cart-btn-right"><span class="icon_loading"></span>
                            UPDATE CARD</button>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="shoping__continue">
                        <!--<div class="shoping__discount">
                            <h5>Discount Codes</h5>
                            <form action="#">
                                <input type="text" placeholder="Enter your coupon code">
                                <button type="submit" class="site-btn">APPLY COUPON</button>
                            </form>
                        </div>-->
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="shoping__checkout">
                        <h5>Cart Total</h5>
                        <ul>
                            <?php
                                
                                $results = mysqli_query($conn,$sql);
                                $totalResult = mysqli_fetch_array($results)
                                ?>
                            <ul>
                                <li>Subtotal <span>$<?php echo $totalResult['SUM'] ?></span></li>
                                <li>Total <span>$<?php echo $totalResult['SUM'] ?></span></li>
                            </ul>
                        </ul>
                        <a href="index.php?p=checkout" class="primary-btn">PROCEED TO CHECKOUT</a>
                    </div>
                </div>
            </div>
        </div>
		</form>
        <?php else:  ?>
            <div align="center">
                <h2 style="font-weight:bold">No Product in cart</h2>
            </div>
        <?php endif;?>
    </section>
    <!-- Shoping Cart Section End -->

