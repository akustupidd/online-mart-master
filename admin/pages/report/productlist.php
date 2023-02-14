<div class="body flex-grow-1 px-3">
		<div class="container-lg">
          <div class="car"></div>
		  <div class="card mb-4">
            <div class="card-header"><strong>Products</strong></div>
            <div class="card-body">
              <div class="example">
              <form class="row g-3" method="POST" action="index.php?pt=productlist" enctype="multipart/form-data">	
                
                <div class="col-md-5">
                   <label class="form-label" for="inputEmail4">Product Name</label>
                   <input class="form-control" type="text" name="txt_Pname" value="">
                  </div>                 
                  <div class="col-md-5">
                    <label class="form-label" for="inputState">Category</label>
                     <select class="form-select" id="inputState" name="cho_Cat">
                     <option value="" selected disabled hidden>Choose here</option>
                       <?php 
                              $sql=mysqli_query($conn,"select * from tbl_category");
                              while($row = mysqli_fetch_array($sql)){
                                echo "<option value='".$row['Cid']."'>".$row['Cname']."</option>";
                              } 
                            ?>
                     </select>
                  </div>                        
                  <div class="col-2">     
                    <input class="btn btn-primary" style="margin-top:30px" type="submit" name="btnSearch" value="Search" />			
                    		
						      </div>
                  
                  </form>
                <div class="tab-content rounded-bottom">
                  <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-359">
                    <table class="table table-hover">
                      <thead>
                        <tr align="center">
                          <th scope="col">#</th>
                          <th scope="col">Photo</th>
                          <th scope="col">Product Name</th>
                          <th scope="col">Price</th>
                          <th scope="col">Stock</th>
                          <th scope="col">Category</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        error_reporting(0);
                        if(isset($_POST['btnSearch'])){
                          $keyCat = $_POST['cho_Cat'];
                          $keySearch = $_POST['txt_Pname'];
                          if(isset($keyCat) && isset($keySearch)){
                            $sql="    SELECT
                                      Pid,
                                      Pname,
                                      Pprice,
                                      Pstock,
                                      Cname,
                                      Pimg 
                                    FROM
                                      tbl_products
                                      NATURAL JOIN tbl_category 
                                    where Cid in ('$keyCat')
                                    and Pname like '%$keySearch%';";
                          }else if(isset($keySearch) && !isset($keyCat)){
                            $sql="    SELECT
                                    Pid,
                                    Pname,
                                    Pprice,
                                    Pstock,
                                    Cname,
                                    Pimg 
                                  FROM
                                    tbl_products
                                    NATURAL JOIN tbl_category 
                                  where Pname like '%$keySearch%';";
                          }else if(isset($keyCat)&& !isset($keySearch)){
                            $sql="    SELECT
                                      Pid,
                                      Pname,
                                      Pprice,
                                      Pstock,
                                      Cname,
                                      Pimg 
                                    FROM
                                      tbl_products
                                      NATURAL JOIN tbl_category 
                                    where Cid in ('$keyCat')";
                          }
                        }else{
                          $sql="    SELECT
                                        Pid,
                                        Pname,
                                        Pprice,
                                        Pstock,
                                        Cname,
                                        Pimg 
                                      FROM
                                        tbl_products
                                        NATURAL JOIN tbl_category 
                                      ORDER BY
                                        Pid desc;";
                        }
                        $result = $conn->query($sql);#$result = mysqli_query($conn,$sql);
                        echo $keyCat;
                        if($result){
                          if($result->num_rows>0){
                              while($row=$result->fetch_array()){
                          ?>
                          <tr align="center">
                            <th scope="row"><?= $row['Pid'] ?></th>
                            <td >
                            <?php
                              echo '<img src="data:image/jpeg;base64,'.base64_encode($row['Pimg']) .'" width = "80"  />';
                              ?>
                            </td>
                            <td><?= $row['Pname'] ?></td>
                            <td><?= $row['Pprice'] ?></td>
                            <td><?= $row['Pstock'] ?></td>
                            <td><?= $row['Cname'] ?></td>
                            <td>
                            <a class="btn btn-primary" href="index.php?pt=editproduct&&pid=<?= $row['Pid'] ?>">Edit</a>
                            <a class="btn btn-danger" onclick="return confirm('Are you sure, You want to delete this ID?')" href="pages/delete.php?id=<?= $row['Pid'] ?>&from=Plist">Delete</a>
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