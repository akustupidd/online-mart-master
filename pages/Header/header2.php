<?php
    #print_r($_SESSION);
    #print_r($_SESSION);
    if(isset($_SESSION['id'])){
        $user_id = $_SESSION['id'];
        $user_pas = $_SESSION['pass'];
        $selectSeID="select * from tbl_session where user_id=$user_id";
        $selectResult=$conn->query($selectSeID);
        $rowSes=$selectResult->fetch_row();
        $ses_id=$rowSes[0];
        $sql = "SELECT sum( tp.Pprice * tc.Qty ) total, sum( tc.Qty ) count FROM tbl_cartitem tc JOIN tbl_products tp where tc.Pid= tp.Pid and tc.SesID=$ses_id  ";
        $result = $conn->query($sql);
        $row=$result->fetch_assoc();
        $id = $_SESSION['id'];
        $name = "select username from tbl_user where user_id =$id";
        $nameresult=$conn->query($name);
        $namerow=$nameresult->fetch_assoc();
    }else{
        $sql = "SELECT sum( tp.Pprice * tc.Qty ) total, sum( tc.Qty ) count FROM tbl_cartitem tc JOIN tbl_products tp where tc.Pid=tp.Pid and SesID=1010 ";
        $result = $conn->query($sql);
        $row=$result->fetch_assoc();
    }
        

    ?>
    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="header__top__left">
                            <ul>
                                <li><i class="fa fa-envelope"></i> OnlineMart.com</li>
                                <li>Free Delivery for all Order of $99</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="header__top__right">
                            <div class="header__top__right__social">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-linkedin"></i></a>
                                <a href="#"><i class="fa fa-pinterest-p"></i></a>
                            </div>
                            <div class="header__top__right__language">
                                <img src="img/language.png" alt="">
                                <div>English</div>
                                <span class="arrow_carrot-down"></span>
                                <ul>
                                 
                                    <li><a href="#">English</a></li>
                                    <li><a href="#">Khmer</a></li>
                                </ul>
                            </div>
                            <div class="header__top__right__auth">
                            <?php       
                                    if(isset($_SESSION['id'])): ?>
                                    <a href="index.php?p=profile">Welcome: <?= $namerow['username'] ?></a>
                                    <a href="pages/logout.php" >Log Out</a>
                                    <?php   else: ?>
                                    <a href="pages/login.php"> Login</a>
                                <?php endif; ?>
								
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="header__logo">
                        <a href="./index.php"><img src="img/logo.png" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-7">
                    <nav class="header__menu">
                        <ul>
                            <li><a href="./index.php">Home</a></li>
                            <li><a href="index.php?p=shop">Shop</a></li>
                            <li><a href="index.php?p=contact">Contact</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-2">
                    <div class="header__cart">
                        <ul>
                            <li><a href="index.php?p=favorite"><i class="fa fa-heart"></i> <span><?=$row['count'] ?></span></a></li>
                            <li><a href="index.php?p=shoping-cart"><i class="fa fa-shopping-bag"></i> <span><?=$row['count'] ?></span></a></li>
                        </ul>
                        <div class="header__cart__price">item: <span>$<?=$row['total'] ?></span></div>
                    </div>
                </div>
            </div>
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    <!-- Header Section End -->

    <!-- Hero Section Begin -->
    <section class="hero hero-normal">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="hero__categories">
                        <div class="hero__categories__all">
                            <i class="fa fa-bars"></i>
                            <?php 
                          $sql2="select count(Pid) as Total,
                           count(case when Cid=2 then 1 end) as Clothing,
                           count(case when Cid=6 then 1 end) as Bag,
                            count(case when Cid=8 then 1 end) as Shoes,
                            count(case when Cid=7 then 1 end) as Access
                            from tbl_products
                            ";
                            $result2=mysqli_query($conn,$sql2);
                            $row2=$result2->fetch_assoc();
                         ?>
                            <span>All departments</span>
                        </div>
                        <ul>
                            <li><a href="index.php?pp=shop&&Cat=Men">All (<?= $row2['Total'] ?>)</a></li>
                                                    <li><a href="index.php?pp=shop&&Cat=Bag">Bags (<?= $row2['Bag'] ?>)</a></li>
                                                    <li><a href="index.php?pp=shop&&Cat=Clothing">Clothing (<?= $row2['Clothing'] ?>)</a></li>
                                                    <li><a href="index.php?pp=shop&&Cat=Shoes">Shoes (<?= $row2['Shoes'] ?>)</a></li>
                                                    <li><a href="index.php?pp=shop&&Cat=Access">Accessories (<?= $row2['Access'] ?>)</a></li>
                            </ul>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="hero__search">
                        <div class="hero__search__form">
                            <form method="POST" action="index.php?p=shop">
                                <div class="hero__search__categories" name="cho_Cat">
                                    All Categories
                                    <span class="arrow_carrot-down"></span>
                                </div>
                                <input type="text" placeholder="What do yo u need?" name="txt_Pname" value="">
                                <button type="submit" class="site-btn" name="btnSearch" value="Search">SEARCH</button>
                            </form>
                        </div>
							
                        <div class="hero__search__phone">
                            <div class="hero__search__phone__icon">
                                <a href=" https://linktr.ee/Chheng07"><i class="fa fa-phone"></i></a>
                            </div>
                            <div class="hero__search__phone__text">
                                <h5>+855 96 401 9586</h5>
                                <span>support 24/7 time</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->