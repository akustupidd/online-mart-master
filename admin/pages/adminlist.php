<?php
	
	
	$id="";
	$name="";
	$gmail ="";
	$password="";
	if(isset($_GET['p']) && $_GET['p']=="adminlist"){
		error_reporting(0);
		
		$id = $_GET['id'];
		
		$sql = "Select * from tbl_admin where user_id=$id";
		$result= mysqli_query($conn, $sql);
		$row = mysqli_fetch_array($result);
		$name= $row['user_name '];
		$gmail= $row['gmail'];
		$password= $row['user_pwd'];
    $role= $row['role_id '];
		
		
		if(isset($_GET['id'])){
			$btn_name ="Update";
			$formfile="pages/update.php?id=$id";
		}else{
			$btn_name ="Add";
			$formfile="pages/insert.php";
		}
		
	}
	
?>

<div class="body flex-grow-1 px-3">
		<div class="container-lg">
          <div class="car"></div>
		  <div class="card mb-4">
            <div class="card-header"><strong>Form</strong><span class="small ms-1">Admin List</span></div>
            <div class="card-body">
              <div class="example">
                
				
				<?php
					/*if(isset(){
						
					}*/
				?>
				<div class="tab-content rounded-bottom">
                      <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-267">
                        <form class="row g-3" method="post" action="<?= $formfile; ?>"> 
						<div class="mb-3">
                          <label class="form-label" for="exampleFormControlInput1">Email admin</label>
                          <input class="form-control" id="exampleFormControlInput1" type="email" name="txt_gmail"  placeholder="name@example.com" value="<?= $gmail; ?>">
                        </div>
						
						<div class="mb-3">
                          <label class="form-label" for="exampleFormControlInput1">Password</label>
                          <input class="form-control" id="exampleFormControlInput1" name="txt_pwd" type="text" placeholder="password" value="<?= $password; ?>">
                        </div>
						
                          <div class="col-md-12">
                            <label class="form-label" for="inputEmail4">Admin Name</label>
                            <input class="form-control" type="text" name="txt_username" value="<?= $name; ?>">
                          </div>
                          <div class="col-12">
                            <label class="form-label" for="inputRole">Role ID </label>
                            <input class="form-control" type="text" name="txt_role" value="<?= $role; ?>" />
                          </div>
                          
                          <!--<div class="col-md-4">
                            <label class="form-label" for="inputState">State</label>
                            <select class="form-select" id="inputState">
                              <option selected="">Choose...</option>
                              <option>...</option>
                            </select>
                          </div>-->
						  
                          <div class="col-12">
                            
							<input class="btn btn-primary" type="submit" name="btnAdd" value="<?= $btn_name; ?>" />
							<?php
								if($btn_name=="Add"){
							?>
							<input class="btn btn-secondary" type="reset"  value="Clear" />
							<?php
								}else{
							?>
							<input class="btn btn-danger" type="button"  value="Cancel" onclick="window.location='index.php?p=adminlist'" />
							<?php
								}
							?>
							
							
							
						  </div>
                        </form>
                      </div>
                    </div>
				
				
                <div class="tab-content rounded-bottom">
                  <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-359">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Admin Name</th>
                          <th scope="col">Email</th>
                          <th scope="col">Role</th>
                        </tr>
                      </thead>
                      <tbody>
					  <?php
						$sql="select * from tbl_admin order by user_id desc";
						$result = mysqli_query($conn,$sql);
						
						while($row= mysqli_fetch_array($result)){
					  ?>
					  
                        <tr>
                          <th scope="row"><?= $row['user_id'] ?></th>
                          <td><?= $row['user_name'] ?></td>
                          <td><?= $row["gmail"] ?></td>
                          <td><?= $row["role_id"] ?></td>
						  <td>
							<a class="btn btn-primary" href="index.php?p=adminlist&&id=<?= $row['user_id']?>">Edit</a>
							<a class="btn btn-danger" href="pages/delete_ad.php?id=<?= $row['user_id'] ?>">Delete</a>
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
              
            </div>
          </div>
		  
        </div>
      </div>