
<style>
  .validate_msg{color:red};
</style>
<div class="body flex-grow-1 px-3">
	<div class="container-lg">
    <div class="car"></div>
		  <div class="card mb-4">
        <div class="card-header"><strong>Form</strong><span class="small ms-1">Create Tecaher</span></div>
          <div class="card-body">
            <div class="example">
             
				<div class="col-md-12">
          <?php
              
              error_reporting(0);
              # Error message
              $msg_schedule='<div class= "validate_msg">ជ្រើសរើសកាលវិភាគគ្រូ</div>';
              $msg_teacher='<div class= "validate_msg">បញ្ចូលឈ្មោះគ្រូ</div>';
              $msg_room='<div class= "validate_msg">បញ្ចូលឈ្មោះបន្ទប់</div>';
              $msg_timeIn='<div class= "validate_msg">បញ្ចូលម៉ោងចូល</div>';
              $msg_timeOut='<div class= "validate_msg">បញ្ចូលម៉ោងចេញ</div>';
              $msg_imgTeach='<div class= "validate_msg">សូមជ្រើសរើសរូបគ្រូ</div>';

              $err1 = $err2 = $err3 = $err4 = $err5 = $err6 = '';
              if(isset($_POST['btnAdd'])){
                $choose_schedule =$conn->real_escape_string( $_POST['cho_sche']); 
                $teach_nm = $conn->real_escape_string($_POST['txt_teachName']);
                $room = $conn->real_escape_string($_POST['txt_className']);
                $timeIn = $conn->real_escape_string($_POST['txt_timeIn']);
                $timeOut = $conn->real_escape_string($_POST['txt_timeIn']);
                #$img_teach = $conn->real_escape_string($_POST['img_teacher']);

                $fileTmp=$_FILES['img_teacher']['tmp_name'];
                $fileName=$_FILES['img_teacher']['name'];
                $fileType=$_FILES['img_teacher']['type'];
                $fileSize=$_FILES['img_teacher']['size'];

                # Image
                $filePath= "img/".$fileName;
                $fileExt= strtolower(end(explode('.',$fileName)));
                $extension = array("jpg","jpeg","png");

                # If none error
                if($choose_schedule==''){$err1=$msg_schedule;}
                if(trim($teach_nm)==''){$err2=$msg_teacher;}
                if($room==''){$err3=$msg_room;}
                if($timeIn==''){$err4=$msg_timeIn;}
                if($timeOut==''){$err5=$msg_timeOut;}
                if($fileName==''){$err6=$msg_imgTeach;}
                else{
                  if($fileSize>3000000){
                    echo "
                        <div class='alert alert-primary' role='alert'>
                        File size must be under 3MB
                      </div>
                    ";
                  }else{
                    if(in_array($fileExt,$extension)===false){
                      echo "
                          <div class='alert alert-primary' role='alert'>
                          Extension file not allowed. Chose jpeg jpg or png file
                        </div>
                      ";
                    }else{
                      if($teach_nm!='' && $room!='' && $timeIn!='' && $timeOut!='' && $fileName!='' && $choose_schedule!=''){
                        move_uploaded_file($fileTmp,"img/".$fileName);
                        $sql = "insert into tbl_teachers(
                          teacher_name,
                          class_name,
                          time_in,
                          time_out,
                          image_name,
                          img_path,
                          sche_id
                        )values(
                          ?,
                          ?,
                          ?,
                          ?,
                          ?,
                          ?,
                          ?
                        )";
                        $stmt = $conn -> prepare($sql);
                        $stmt -> bind_param("ssssssi",$teach_nm,$room,$timeIn,$timeOut,$fileName,$filePath, $choose_schedule);
                        if($stmt->execute()){
                          echo "
                            <div class='alert alert-primary' role='alert'>
                              Add scucessful
                            </div>
                          
                          ";
                          $stmt->close();
                        }else{
                          echo "
                              <div class='alert alert-danger' role='alert'>
                                Add fail
                            </div>
                          ";
                        }
                      }
                    }
                  }
                }
              }
            ?>
        </div>
				
				<div class="tab-content rounded-bottom">
          <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-267">
              <form class="row g-3" method="post" action="" enctype="multipart/form-data">	
                <div class="col-md-12">
                    <label class="form-label" for="inputState">ជ្រើសរើសកាលវិភាគគ្រូ</label>
                     <select class="form-select" id="inputState" name="cho_sche">
                       <option value="">---សូមជ្រើសរើស---</option>
                       <?php 
                              $sql=mysqli_query($conn,"select * from tbl_sche");
                              while($row = mysqli_fetch_array($sql)){
                                echo "<option value='".$row['sche_id']."'>".$row['sche_name']."</option>";
                              } 
                            ?>
                     </select>
                     <?= $err1; ?>
                  </div>
               <div class="col-md-12">
                   <label class="form-label" for="inputEmail4">ឈ្មោះគ្រូ</label>
                   <input class="form-control" type="text" name="txt_teachName" value="">
                   <?= $err2; ?>
                  </div>                 
                 <div class="col-12">
                   <label class="form-label" for="inputAddress">បន្ទប់ </label>
                   <input class="form-control" type="text" name="txt_className" value="" />
                   <?= $err3; ?>
                  </div>
		
						     <div class="col-12">
                   <label class="form-label" for="inputAddress2">ម៉ោងចូល
                   </label>
                   <input class="form-control" type="text" name="txt_timeIn" value="" />
                   <?= $err4; ?>
                  </div>
		
                 <div class="col-12">
                   <label class="form-label" for="inputAddress2">ម៉ោងចេញ </label>
                   <input class="form-control" type="text" name="txt_timeOut" value="" />
                   <?= $err5; ?>
                  </div>
                 <div class="col-12">
                   <label class="form-label" for="inputAddress2">រូបគ្រូ </label>
                   <input class="form-control" type="file" name="img_teacher" value="" />
                   <?= $err6; ?>
                  </div>
                        
                  <div class="col-12">     
                    <input class="btn btn-primary" type="submit" name="btnAdd" value="រក្សាទុក" />			
                    <input class="btn btn-secondary" type="reset"  value="Clear" />
						      </div>
                        </form>
                      </div>
                    </div>
              </div>
            </div>
          </div>
        </div>
      </div>