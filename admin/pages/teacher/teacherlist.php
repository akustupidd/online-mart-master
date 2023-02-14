<div class="body flex-grow-1 px-3">
		<div class="container-lg">
          <div class="car"></div>
		  <div class="card mb-4">
            <div class="card-header"><strong>Form</strong><span class="small ms-1">Teacher List</span></div>
            <div class="card-body">
              <div class="example">
                
                <div class="tab-content rounded-bottom">
                  <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-359">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Teacher Name</th>
                          <th scope="col">Class Room</th>
                          <th scope="col">Time In</th>
                          <th scope="col">Time Out</th>
                          <th scope="col">Schedule Name</th>
                          <th scope="col">Image</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                            $sql = "select tt.teacher_id, tt.teacher_name,tt.class_name,tt.time_in,tt.time_out,tt.image_name,sche_name from tbl_teachers tt join tbl_sche ts on tt.sche_id = ts.sche_id order by tt.teacher_id desc";
                            $result = $conn->query($sql);#$result = mysqli_query($conn,$sql);
                            while($row=$result->fetch_array()){
                        ?>
                        <tr>
                          <th scope="row"><?= $row['0'] ?></th>
                         
                          <td><?= $row['1'] ?></td>
                          <td><?= $row['2'] ?></td>
                          <td><?= $row['3'] ?></td>
                          <td><?= $row['4'] ?></td>
                          <td><?= $row['6'] ?></td>
                          <td>
                            <img src="img/<?php echo $row['image_name']?>" width="50px"  alt=""/>
                          <td>
                          <a class="btn btn-primary" href="">Edit</a>
                          <a class="btn btn-danger" href="">Delete</a>
                          </td>
                          
                        </tr>
                        <?php
                          
                        }
                        $conn->close();
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