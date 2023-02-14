<div class="body flex-grow-1 px-3">
		<div class="container-lg">
          <div class="car"></div>
		  <div class="card mb-4">
            <div class="card-header"><strong>Orders</strong></div>
            <div class="card-body">
              <div class="example">
              <form class="row g-3" method="post" action="" enctype="multipart/form-data">	                
                  <div class="col-md-5" align="center">   
                  <?php 
                              $sqlCurrent=mysqli_query($conn,"select Current_date,min(Created) as min from tbl_orders");
                              $rowCurrent = $sqlCurrent->fetch_assoc();
                  ?>
                  <label for="start">From Date</labl>
                    <input type="date" id="start" name="trip-start"
                          value="2023-01-17"
                          min="<?= $rowCurrent['min'] ?>" max="<?= $rowCurrent['Current_date'] ?>">
                     <label for="start">To Date</label>
                    <input type="date" id="start" name="trip-end"
                          value="<?= $rowCurrent['Current_date'] ?>"
                          min="<?= $rowCurrent['min'] ?>" max="<?= $rowCurrent['Current_date'] ?>">
                  </div>                        
                  <div class="col-2">     
                    <input class="btn btn-primary" type="submit" name="btnSearch" value="Search" />			
						      </div>
                  </form>
                <div class="tab-content rounded-bottom">
                  <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-359">
                    <table class="table table-hover">
                      <thead>
                        <tr >
                          <th scope="col">#</th>
                          <th scope="col">Username</th>
                          <th scope="col">Total</th>
                          <th scope="col">Date</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $i = 1;
                        if(isset($_POST['btnSearch'])){
                          $df = $_POST['trip-start'];
                          $dt = $_POST['trip-end'];
                          if(isset($df) || isset($dt)){
                                  $sql="    SELECT
                                              Odid,
                                              username,
                                              total,
                                              payment_id,
                                              DATE_FORMAT(Created, '%m/%d/%Y') as date
                                            FROM
                                              tbl_orders
                                              NATURAL JOIN tbl_user 
                                            where Created >= '$df' and Created <= '$dt'
                                            order by Created asc;";
                            $result = $conn->query($sql);
                          }
                        }else{
                          $sql="    SELECT
                                      Odid,
                                      username,
                                      total,
                                      payment_id,
                                      DATE_FORMAT(Created, '%m/%d/%Y') as date
                                    FROM
                                      tbl_orders
                                      NATURAL JOIN tbl_user 
                                      order by Created asc ";
                            $result = $conn->query($sql);#$result = mysqli_query($conn,$sql);
                        }
                        if($result){
                          if($result->num_rows>0){
                              while($row=$result->fetch_array()){
                          ?>
                          <tr >
                            <th scope="row"><?= $i++ ?></th>
                            <td><?= $row['username'] ?></td>
                            <td>$ <?= $row['total'] ?></td>
                            <td><?= $row['date'] ?></td>
                            <td>
                            <a class="btn btn-info" href="index.php?pt=orderDetail&&Od=<?=$row['Odid'] ?>">View Detail</a>
                            </td>
                          </tr>
                          <?php
                            }
                          }else{
                            echo "<tr><td colspan='8'><div class='alert alert-dark ' align= 'center' role='alert'>No Data Found</div></td></tr>";
                          }
                          $conn->close();
                        }else{
                          echo "Error " . $conn->$error;
                        }
                        ?>
                        
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              
            </div>
          </div>
		  
        </div>
      </div>