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
$selectOrders = "SELECT  Odid,total,user_id,DATE_FORMAT(Created, '%m/%d/%Y') Date,payment_id from tbl_orders where user_id =$user_id";
$selectOrderRes = $conn->query($selectOrders);

?>
 <!-- Breadcrumb Section Begin -->
 <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Order History</h2>
                        <div class="breadcrumb__option">
                            <a href="index.php">Home</a>
                            <span>Shop</span>
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
                <?php
                        if($selectOrderRes){
                            if($selectOrderRes->num_rows>0){
                ?>
                    <div class="profile">
                            <span>My Order</span>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Total</th>
                            <th scope="col">Date</th>
                            <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                             <?php
                                while($selectRow=mysqli_fetch_array($selectOrderRes)){
                            ?>
                                    <tr>
                                    <th scope="row"><?= $selectRow['Odid'] ?> </th>
                                    <td>$ <?= $selectRow['total'] ?></td>
                                    <td><?= $selectRow['Date'] ?></td>
                                        <td><a class="btn btn-info" href="index.php?p=orderDetail&&oID=<?= $selectRow['Odid'] ?>">View Detail</a></td>
                                    </tr>
                                    <?php
                            }
                            }else{
                                echo "
                                <div class='alert alert-primary' role='alert'>
                                    No Orders
                                </div>";
                            }
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    