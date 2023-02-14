<div class="body flex-grow-1 px-3">
		<div class="container-lg">
          <div class="car"></div>
		  <div class="card mb-4">
            <div class="card-header"><strong>Customers</strong></div>
            <div class="card-body">
              <div class="example">
                <div class="tab-content rounded-bottom">
                  <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-359">
                    <table class="table table-hover">
                      <thead>
                        <tr >
                          <th scope="col">#</th>
                          <th scope="col">ID</th>
                          <th scope="col">User Name</th>
                          <th scope="col">First Name</th>
                          <th scope="col">Last Name</th>
                          <th scope="col">Country</th>
                          <th scope="col">Address</th>
                          <th scope="col">City</th>
                          <th scope="col">Postcode</th>
                          <th scope="col">PhoneNumber</th>
                          <th scope="col">Email</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $i = 1;
                        $sql="select * from tbl_user_info join tbl_user using (user_id)";
                        $result = $conn->query($sql);#$result = mysqli_query($conn,$sql);
                        if($result){
                          if($result->num_rows>0){
                              while($row=$result->fetch_array()){
                          ?>
                          <tr >
                            <th scope="row"><?= $i++ ?></th>
                            <td><?= $row['user_id'] ?></td>
                            <td><?= $row['username'] ?></td>
                            <td><?= $row['Firstname'] ?></td>
                            <td><?= $row['Lastname'] ?></td>
                            <td><?= $row['country'] ?></td>
                            <td><?= $row['addre'] ?></td>
                            <td><?= $row['city'] ?></td>
                            <td><?= $row['postcode'] ?></td>
                            <td><?= $row['phone'] ?></td>
                            <td><?= $row['email'] ?></td>
                            
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