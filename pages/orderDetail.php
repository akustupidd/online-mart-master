<style>
    .profile{
        
        
        /*background: rgba(255, 255, 255, 0.2);
        border-radius: 10px;
        padding: 40px;
        background: #f3f2ee;
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        backdrop-filter: blur(5px);
        border: 1px solid rgba(255, 255, 255, 0.3);
        -webkit-backdrop-filter: blur(5px);*/
        margin-bottom: 20px;   
    }
    .profile span {
        font-weight:bolder;
        font-size: 15px;
        text-transform: uppercase;
        letter-spacing: 2px;
        display: inline-block;
        cursor: pointer;
    }
    .profile p{
        font-size: 15px;
        text-transform: uppercase;
        letter-spacing: 2px;
        display: inline-block;
        cursor: pointer;
    }
    

</style>
<?php
$user_id = $_SESSION['id'];
$user = "select * from tbl_user where user_id=$user_id";
$userRes = $conn->query($user);
$userFetch = $userRes->fetch_assoc();
$Oid = $_GET['oID'];
$selectOrdersDetail = "select Oid,Pimg,Pname,Pprice,Qty,(Pprice*Qty) Total from tbl_orderdetail NATURAL join tbl_products where Odid = $Oid";
$selectOrderDetalilRes = $conn->query($selectOrdersDetail);

?>
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Order Detail</h4>
                        <div class="breadcrumb__links">
                            <a href="index.php">Home</a>
                            <a href="index.php?p=profile">Order History</a>
                            <span>Order Detail</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-12" style=" padding:30px"></div>
                <div class="col-4" >
                    <div class="profile">
                        <p>HI,</p>
                        <span><?= $userFetch['username'] ?>  </span><br>                        
                    </div>
                </div>
                <div class="col-8">
                    <div class="profile">
                            <span>Order Number #<?=$Oid?></span>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Image</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Price</th>
                            <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $i = 1;
                        if($selectOrderDetalilRes){
                            if($selectOrderDetalilRes->num_rows>0){
                                while($selectRow=mysqli_fetch_array($selectOrderDetalilRes)){
                            ?>
                                    <tr>
                                    <th scope="row"><?= $i++?> </th>
                                    <td>
                                        <?php
                                            echo '<img src="data:image/jpeg;base64,'.base64_encode($selectRow['Pimg']) .'" width = "100" height = "100" />';
                                        ?>        
                                    </td>
                                    <td><?= $selectRow['Pname'] ?></td>
                                    <td><?= $selectRow['Qty'] ?></td>
                                    <td>$<?= $selectRow['Pprice'] ?></td>
                                    <td>$<?= $selectRow['Total'] ?></td>
                                    
                                    </tr>
                                    <?php
                            }
                            }else{
                                
                            }
                        }else{
                            echo "Error in" . $selectOrdersDetail . " " . $conn->error;
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    