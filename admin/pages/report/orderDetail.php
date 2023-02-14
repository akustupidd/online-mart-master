<div class="body flex-grow-1 px-3">
		<div class="container-lg">
          <div class="car"></div>
		  <div class="card mb-4">
            <div class="card-header"><strong>Order Detail</strong></div>
            <div class="card-body">
              <div class="example">
                <div class="tab-content rounded-bottom">
                  <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-359">
                    <table class="table table-hover">
                      <thead>
                        <tr >
                          <th scope="col">#</th>
                          <th scope="col">Image</th>
                          <th scope="col">Product Name</th>
                          <th scope="col">Price</th>
                          <th scope="col">Qty</th>
                          <th scope="col">SubTotal</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $oid = $_GET['Od'];
                        $i=1;
                          $sql="SELECT
                                    Oid,
                                    Pimg,
                                    Pname,
                                    Price,
                                    Qty,
                                    Price*Qty Sub
                                    FROM
                                    tbl_orderdetail
                                    NATURAL JOIN tbl_products 
                                    WHERE
                                    Odid = $oid";
                            $result = $conn->query($sql);#$result = mysqli_query($conn,$sql);
                              while($row=$result->fetch_array()){
                          ?>
                          <tr >
                            <th scope="row"><?= $i++ ?></th>
                            <td>
                            <?php
                                echo '<img src="data:image/jpeg;base64,'.base64_encode($row['Pimg']) .'" width = "50" />';
                            ?>  
                            </td>
                            <td><?= $row['Pname'] ?></td>
                            <td>$ <?= $row['Price'] ?></td>
                            <td><?= $row['Qty'] ?></td>                           
                            <td>$ <?= $row['Sub'] ?></td>                           
                          </tr>
                          <?php
                            }
                        $total = "select sum(Qty) as T,sum(Qty*Price) as Total from tbl_orderdetail where Odid=$oid";
                        $totalRes = $conn->query($total);
                        $rowTotal = $totalRes->fetch_assoc();
                        ?><tr>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td >Total</td>
                          <td><?= $rowTotal['T'] ?></td>
                        <td>$ <?= $rowTotal['Total'] ?></td>
                      </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              
            </div>
          </div>
		  
        </div>
      </div>