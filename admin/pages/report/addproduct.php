
<div class="body flex-grow-1 px-3">
	<div class="container-lg">
    <div class="car"></div>
		  <div class="card mb-4">
        <div class="card-header"><strong>Add Product</strong></div>
          <div class="card-body">
            <div class="example">
             
				<div class="col-md-12">
          <?php
              
              error_reporting(0);
              if(isset($_POST['btnAdd'])){
                $choose_cate =$conn->real_escape_string( $_POST['cho_Cat']); 
                $Pname = $conn->real_escape_string($_POST['txt_Pname']);
                $Pprice = $conn->real_escape_string($_POST['txt_Price']);
                $Stock = $conn->real_escape_string($_POST['txt_stock']);
                #$img = $conn->real_escape_string($_POST['img_Product']);
                #$img_teach = $conn->real_escape_string($_POST['img_teacher']);

                # If none error
                
                if(!empty($_FILES['img_Product']['name'])){
                    $fileName=basename($_FILES['img_Product']['name']);
                    $fileType=pathinfo($fileName,PATHINFO_EXTENSION);
                    $allowExtension=array('jpg','jpeg','png');
                    if(in_array($fileType,$allowExtension)){
                        $image = $_FILES['img_Product']['tmp_name'];
                        $imageContent=addslashes(file_get_contents($image));
                        $sql = "insert into tbl_products(
                            Pname,
                            Pprice,
                            Pstock,
                            Cid,
                            Pimg,
                            Created
                          )values(
                            '$Pname',
                            '$Pprice',
                            '$Stock',
                            '$choose_cate',
                            '$imageContent',
                            Now()
                          )";
                          $result=$conn->query($sql);
                          if(!$result){
                            echo "
                              <div class='alert alert-danger' role='alert'>
                                Add Fail
                              </div>
                            
                            ";
                          }else{
                            echo "
                                <div class='alert alert-primary' role='alert'>
                                Add scucessful
                            </div>
                            ";
                          }
                    }else{
                        echo "
                        <div class='alert alert-danger' role='alert'>
                            Sorry, only JPG, JPEG, PNG files are allowed to upload.
                       </div>
                       ";
                    }
                }else{
                    echo "
                         <div class='alert alert-danger' role='alert'>
                         Select image to upload
                        </div>
                        ";
                }
              }
            ?>
        </div>
				
		<div class="tab-content rounded-bottom">
          <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-267">
              <form class="row g-3" method="post" action="" enctype="multipart/form-data">	
                
                <div class="col-md-12">
                   <label class="form-label" for="inputEmail4">Product Name</label>
                   <input class="form-control" type="text" name="txt_Pname" value="">
                  </div>                 
                  <div class="col-md-12">
                    <label class="form-label" for="inputState">Category</label>
                     <select class="form-select" id="inputState" name="cho_Cat">
                       
                       <?php 
                              $sql=mysqli_query($conn,"select * from tbl_category");
                              while($row = mysqli_fetch_array($sql)){
                                echo "<option value='".$row['Cid']."'>".$row['Cname']."</option>";
                              } 
                            ?>
                     </select>
                  </div>
                  <div class="col-12">
                   <label class="form-label" for="inputAddress">Price </label>
                   <input class="form-control" type="text" name="txt_Price" value="" />
                  </div>
		
						     <div class="col-12">
                   <label class="form-label" for="inputAddress2">Stock</label>
                   <input class="form-control" type="text" name="txt_stock" value="" />
                  </div>
                 
                 <div class="col-12">
                   <label class=" " for="inputAddress2">Image</label>
                   <input class="form-control" type="file" name="img_Product" value="" />
                  </div>
                        
                  <div class="col-12">     
                    <input class="btn btn-primary" type="submit" name="btnAdd" value="Add New" />			
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
      <script>
        $("input").change(function(e) {
            for (var i = 0; i < e.originalEvent.srcElement.files.length; i++) {
                
                var file = e.originalEvent.srcElement.files[i];
                
                var img = document.createElement("img");
                var reader = new FileReader();
                reader.onloadend = function() {
                    img.src = reader.result;
                }
                reader.readAsDataURL(file);
                $("input").after(img);
            }
            });
      </script>