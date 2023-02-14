<?php
    $sql="select * from tbl_products order by Pid desc";
    if(isset($_GET['pp'])=="shop"){
        $catSelected = $_GET['Cat'];
        
        if($catSelected=='Men'){
            $sql = "select * from tbl_products ";
        }else if($catSelected=='Bag'){
            $sql = "select * from tbl_products where Cid=6";
        }else if($catSelected=='Clothing'){
            $sql="select * from tbl_products where Cid=2";
        }else if($catSelected=='Shoes'){
            $sql="select * from tbl_products where Cid=8";
        }else if($catSelected=='Access'){
            $sql="select * from tbl_products where Cid=7";
        }else if($catSelected=='lowToHigh'){
            $sql="select * from tbl_products order by Pprice asc";
        }else if($catSelected=='0to55'){
            $sql="select * from tbl_products where Pprice BETWEEN 0 and 20";
        }else{
            $sql="select * from tbl_products where Pprice BETWEEN 20 and 50";
        }
    }
    if(isset($_GET['btnSubmit'])){
    header("locatin: index.php?p=shop");
    }
?>
<style>
    .product__item__pic{
        width: 200px;
    }
</style>
 
 <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Online Mart</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.php">Home</a>
                            <span>Shop</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-5">
                    <div class="sidebar">
                        <div class="sidebar__item">
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
                            <h4>Department</h4>
                            <ul>
                            <li><a href="index.php?pp=shop&&Cat=Men">All (<?= $row2['Total'] ?>)</a></li>
                                                    <li><a href="index.php?pp=shop&&Cat=Bag">Bags (<?= $row2['Bag'] ?>)</a></li>
                                                    <li><a href="index.php?pp=shop&&Cat=Clothing">Clothing (<?= $row2['Clothing'] ?>)</a></li>
                                                    <li><a href="index.php?pp=shop&&Cat=Shoes">Shoes (<?= $row2['Shoes'] ?>)</a></li>
                                                    <li><a href="index.php?pp=shop&&Cat=Access">Accessories (<?= $row2['Access'] ?>)</a></li>
                            </ul>
                        </div>
                        <div class="sidebar__item">
                            <h4>Price</h4>
                            <div class="price-range-wrap">
                                <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
                                    data-min="10" data-max="540">
                                    <div class="ui-slider-range ui-corner-all ui-widget-header"></div>
                                    <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                    <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                </div>
                                <div class="range-slider">
                                    <div class="price-input">
                                        <input type="text" id="minamount">
                                        <input type="text" id="maxamount">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="sidebar__item sidebar__item__color--option">
                            <h4>Colors</h4>
                            <div class="sidebar__item__color sidebar__item__color--white">
                                <label for="white">
                                    White
                                    <input type="radio" id="white">
                                </label>
                            </div>
                            <div class="sidebar__item__color sidebar__item__color--gray">
                                <label for="gray">
                                    Gray
                                    <input type="radio" id="gray">
                                </label>
                            </div>
                            <div class="sidebar__item__color sidebar__item__color--red">
                                <label for="red">
                                    Red
                                    <input type="radio" id="red">
                                </label>
                            </div>
                            <div class="sidebar__item__color sidebar__item__color--black">
                                <label for="black">
                                    Black
                                    <input type="radio" id="black">
                                </label>
                            </div>
                            <div class="sidebar__item__color sidebar__item__color--blue">
                                <label for="blue">
                                    Blue
                                    <input type="radio" id="blue">
                                </label>
                            </div>
                            <div class="sidebar__item__color sidebar__item__color--green">
                                <label for="green">
                                    Green
                                    <input type="radio" id="green">
                                </label>
                            </div>
                        </div>
                        <div class="sidebar__item">
                            <h4>Popular Size</h4>
                            <div class="sidebar__item__size">
                                <label for="large">
                                    Large
                                    <input type="radio" id="large">
                                </label>
                            </div>
                            <div class="sidebar__item__size">
                                <label for="medium">
                                    Medium
                                    <input type="radio" id="medium">
                                </label>
                            </div>
                            <div class="sidebar__item__size">
                                <label for="small">
                                    Small
                                    <input type="radio" id="small">
                                </label>
                            </div>
                            <div class="sidebar__item__size">
                                <label for="tiny">
                                    Tiny
                                    <input type="radio" id="tiny">
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-7">
                    <div class="filter__item">
                        <div class="row">
                      
                            <div class="col-lg-4 col-md-5">
                                <div class="filter__sort">
                                    <span>Sort By</span>
                                    <select>
                                        <option value="0">Default</option>
                                        <option value="0">Default</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <div class="filter__found">
                                    <h6><span>(<?= $row2['Total'] ?>)</span> Products found</h6>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-3">
                                <div class="filter__option">
                                    <span class="icon_grid-2x2"></span>
                                    <span class="icon_ul"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                    <?php
                                                
                    $result = mysqli_query($conn,$sql);
                    while ($row = mysqli_fetch_array($result)) {
                                            ?>
                        <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="product__item">
                        <div class="product__item__pic set-bg">
                        <a href="index.php?p=shop-details&&Pid=<?=$row['Pid']?>">
                                                    <?php
                                                        echo '<img src="data:image/jpeg;base64,'.base64_encode($row['Pimg']) .'" />';
                                                    ?></a>
                            <ul class="product__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="pages/insert.php?pid=<?= $row['Pid'] ?>" class="add-cart" name="addCart"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6><?=$row['Pname']?></a></h6>
                            <h5>$<?=$row['Pprice']?></h5>
                        </div>
                    </div>
                </div>
                            <?php
                            }
                                        ?>
                        </div>
                
                    <div class="product__pagination">
                        <a href="#">1</a>
                        <a href="#">2</a>
                        <a href="#">3</a>
                        <a href="#"><i class="fa fa-long-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Section End -->

