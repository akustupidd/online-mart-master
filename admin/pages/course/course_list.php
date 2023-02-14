<style>
	.validate_msg{color:red;}
</style>
<div class="body flex-grow-1 px-3">
		<div class="container-lg">
          <div class="car"></div>
		  <div class="card mb-4">
            <div class="card-header"><span class="small ms-1">Course List</span></div>
            <div class="card-body">
              <div class="example">
                <ul class="nav nav-tabs" role="tablist">
                  <li class="nav-item"><a class="nav-link active" data-coreui-toggle="tab" href="#preview-359" role="tab">
                      <svg class="icon me-2">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-media-play"></use>
                      </svg>Preview</a></li>
                  <li class="nav-item"><a class="nav-link" href="https://coreui.io/docs/content/tables/#hoverable-rows" target="_blank">
                      <svg class="icon me-2">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-code"></use>
                      </svg>Code</a></li>
                </ul>

                <div class="col-md-12">
                <!--start course to db-->
                  <?php
                      error_reporting(0);
                      $msg_courseKH='<div class="validate_msg">invalid_courseKH</div>';
                      $msg_courseEN ='<div class="validate_msg">valid_courseEN</div>';
                      $msg_studytime ='<div class="validate_msg">valid_studytime</div>';
                      $msg_image ='<div class="validate_msg">valida_image</div>';
                      
                      $err1 = $err2 = $err3 = $err4 = $err5 = $err6 = '';
                      
                      if(isset($_POST['btnAdd'])){
                        $txt_courseKH = $conn->real_escape_string($_POST['txt_courseKH']);
                        $txt_courseEN= $conn->real_escape_string($_POST['txt_courseEN']);
                        $txt_studytime= $conn->real_escape_string($_POST['txt_studytime']);
                        
                        #$image= $conn->real_escape_string($_POST['course_image']);
                        
                        $filetmp = $_FILES["course_image"]["tmp_name"];
                        $filename = $_FILES["course_image"]["name"];
                        $filetype= $_FILES["course_image"]["type"];
                        $filesize = $_FILES["course_image"]["size"];
                        
                        $filepath = "images/".$filename;
                        $file_ext = strtolower(end(explode('.',$filename)));
                        $extension = array("jpeg","jpg","png");
                        
                        if($txt_courseKH==''){$err1=$msg_courseKH;}
                        if($txt_courseEN==''){$err2=$msg_courseEN;}
                        if($txt_studytime==''){$err3=$msg_studytime;}
                        if($filename=='')
                        {
                          $err6=$msg_image;
                        }else{
                          if($filesize>2097152){
                            echo msgstyle("File size must be excately 2 MB","info");
                          }else{
                            if(in_array($file_ext,$extension)===false){
                              #echo "Extension not allowed. Pls choose a JPEG, JPJ and PNG file.";
                              echo msgstyle("Extension not allowed. Pls choose a JPEG, JPJ and PNG file.","info");
                            }else{
                              if($txt_courseKH!='' && $txt_courseEN!='' && $txt_studytime!='' && $filename!=''){
                                move_uploaded_file($filetmp,"images/".$filename);
                                $sql= "INSERT INTO tbl_courses(
                                  course_name_kh,
                                  course_name_en,
                                  study_time,
                                  image_name,
                                  image_path
                                )VALUES(
                                  ?,
                                  ?,
                                  ?,
                                  ?,
                                  ?
                                )";
                                
                                $stmt= $conn->prepare($sql);
                                $stmt->bind_param("sssss",$txt_courseKH,$txt_courseEN,$txt_studytime,$filename,$filepath);
                                
                                if($stmt->execute()){
                                  echo msgstyle("Added a successful","success");
                                  $stmt->close();
                                }else{
                                  echo'
                                    <div class="alert alert-danger" role="alert">
                                      Transaction Failed!
                                    </div>
                                  ';
                                }
                              }
                            }
                          }
                        }
                      }
                  ?>
                <!--end course to db-->
                <div>

                <!--start input to db-->
				          <div class="tab-content rounded-bottom">
                      <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-267">
                        <form class="row g-3" method="post" enctype="multipart/form-data">
						
                          <div class="col-md-6">
                            <label class="form-label">Course Name KH</label>
                            <input class="form-control" type="text" name="txt_courseKH" value="">
                            <?= $err1; ?>
                          </div>
						  
						              <div class="col-md-6">
                            <label class="form-label">Course Name EN</label>
                            <input class="form-control" type="text" name="txt_courseEN" value="">
                            <?= $err2; ?>
                          </div>
                          
                          <div class="col-12">
                            <label class="form-label">Study Time </label>
                            <input class="form-control" type="text" name="txt_studytime" value="" />
                            <?= $err3; ?>
                          </div>
						  
                          <div class="mb-3">
                            <label class="form-label" for="formFile">Course Image</label>
                            <input class="form-control" id="formFile" name="course_image" type="file">
                            <?= $err6; ?>
                          </div>
						  
                          <div class="col-12">
                            <input  class="btn btn-primary" type="submit" name="btnAdd" value="Save" />
                          </div>

                        </form>
                      </div>
                  </div>
                <!--end input to db-->
				
				
                    <div class="tab-content rounded-bottom">
                      <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-359">
                        <table class="table table-hover">
                                  <thead>
                                    <tr>
                                      <th scope="col">#</th>
                                      <th scope="col">Course Name KH</th>
                                      <th scope="col">Course Name EN</th>
                                      <th scope="col">Study Time</th>
                                      <th scope="col">Image</th>
                                      <th scope="col">Action</th>
                                    </tr>
                                  </thead>
                                  <tbody>
					  <?php
						$sql="select * from tbl_courses order by course_id desc";
						
						$result = mysqli_query($conn,$sql);
						
						while($row= mysqli_fetch_array($result)){
					  ?>
					  
                        <tr>
                          <th scope="row"><?= $row['course_id'] ?></th>
                          <td><?= $row[1] ?></td>
                          <td><?= $row[2] ?></td>
                          <td><?= $row[3] ?></td>
						  <td><?= $row[4] ?></td>
						  <td>
							<a class="btn btn-primary" href="index.php?p=course_list&&id=<?= $row['course_id'] ?>">Edit</a>
							
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
	  
	  
	  
	  <tbody>
					  <?php
						$sql="select * from tbl_subj order by course_id desc";
						
						$result = mysqli_query($conn,$sql);
						
						while($row= mysqli_fetch_array($result)){
					  ?>
					  
                        <tr>
                          <th scope="row"><?= $row['course_id'] ?></th>
                          <td><?= $row[1] ?></td>
                          <td><?= $row[2] ?></td>
                          <td><?= $row[3] ?></td>
						  <td><?= $row[4] ?></td>
						  <td>
							<a class="btn btn-primary" href="index.php?p=course_list&&id=<?= $row['course_id'] ?>">Edit</a>
							
						  </td>
                        </tr>
						
                       <?php
						}	
						?>
                      </tbody>