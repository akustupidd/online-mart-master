
<div class="body flex-grow-1 px-3">
	<div class="container-lg">
    <div class="car"></div>
		  <div class="card mb-4">
        <div class="card-header"><strong>Edit Product</strong></div>
          <div class="card-body">
            <div class="example">
             
				<div class="col-md-12">
          <?php
              
              error_reporting(0);
          $pid = $_GET["pid"];
          $selectProduct = "select * from tbl_products NATURAL join tbl_category where Pid = $pid";
          $resultProduct = $conn->query($selectProduct);
          $rowProduct = $resultProduct->fetch_assoc();
          $name=$rowProduct['Pname'];
          $price=$rowProduct['Pprice'];
          $stock=$rowProduct['Pstock'];
          $cid=$rowProduct['Cid'];
          $img=$rowProduct['Pimg'];

              if(isset($_POST['btnUpdate'])){
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
                        $sql = "
                                UPDATE tbl_products 
                                SET Pname ='$Pname',
                                Pprice =$Pprice,
                                Pstock =$Stock,
                                Cid =$choose_cate,
                                Pimg='$imageContent'
                                WHERE
                                  Pid=$pid";
                          $result=$conn->query($sql);
                          if(!$result){
                            echo "
                              <div class='alert alert-danger' role='alert'>
                                Update Fail
                              </div>
                            
                            ";
                          }else{
                            echo "
                                <div class='alert alert-primary' role='alert'>
                                Update scucessful
                            </div>
                            ";
                          }
                    }else{
                        echo "
                        <div class='alert alert-danger' role='alert'>
                            Sorry,only JPG, JPEG, PNG files are allowed to upload.
                       </div>
                       ";
                    }
                }else{
                  $sql = "
                          UPDATE tbl_products 
                          SET Pname ='$Pname',
                          Pprice =$Pprice,
                          Pstock =$Stock,
                          Cid =$choose_cate
                          WHERE
                            Pid=$pid";
                  $result=$conn->query($sql);
                }
              }
            ?>
        </div>
				
		<div class="tab-content rounded-bottom">
          <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-267">
              <form class="row g-3" method="post" action="" enctype="multipart/form-data">	
                
                <div class="col-md-12">
                   <label class="form-label" for="inputEmail4">Product Name</label>
                   <input class="form-control" type="text" name="txt_Pname" value="<?=$name?>">
                  </div>                 
                  <div class="col-md-12">
                    <label class="form-label" for="inputState">Category</label>
                     <select class="form-select" id="inputState" name="cho_Cat">
                       
                       <?php 
                              $sql=mysqli_query($conn,"select * from tbl_category");
                              while($row = mysqli_fetch_array($sql)){
                         $selected = '';
                         if($row['Cid']==$cid){
                           $selected = "selected";
                           
                         }
                                echo "<option $selected value='".$row['Cid']."'>".$row['Cname']."</option>";
                              } 
                            ?>
                     </select>
                  </div>
                  <div class="col-12">
                   <label class="form-label" for="inputAddress">Price </label>
                   <input class="form-control" type="text" name="txt_Price" value="<?=$price?>" />
                  </div>
		
						     <div class="col-12">
                   <label class="form-label" for="inputAddress2">Stock</label>
                   <input class="form-control" type="text" name="txt_stock" value="<?=$stock?>" />
                  </div>
                 
                 <div class="col-12">
                   <label class=" " for="inputAddress2">Image</label>
                   <input class="form-control" type="file" name="img_Product" value="<?=$image?>" />
                  </div>
                        
                  <div class="col-12">     
                    <input class="btn btn-primary" type="submit" name="btnUpdate" value="Update" />			
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