
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
					<div class="tab-content rounded-bottom">
                      <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-267">
                        
						<form class="row g-3" action="" name="form" method="post"> 
						   <input type="hidden" name="cour" value="subject_by_course">
						   <div class="col-md-5">
							<label class="form-label">Choose Course</label>
							<select class="form-select" name="">
							  <option selected>Choose...</option>
							  <option value="1">Web Based Development I</option>
							  <option value="2">Web Based Development II</option>
							  <option value="3">Design</option>
							</select>
						  </div>
						  <div class="col-md-4">
							<label class="form-label">Search Something...</label>
							<input class="form-control" type="text" name="txt_search" value="" />
						  </div>
						  <div class="col-3">
							<input style="margin-top:32px;" class="btn btn-primary" type="submit" name="btnSearch" value="Search" />
							
							<!-- Button trigger modal -->
							<button style="margin-top:32px;" type="button" class="btn btn-success" data-coreui-toggle="modal" data-coreui-target="#addSubjecToCourse">
								Add Subject
							</button>
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
                          <th scope="col">Subject Name KH</th>
                          <th scope="col">Subject Name EN</th>
                          <th scope="col">Study Time</th>
						  <th scope="col">Course Name</th>
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
	  
	  
	  
	  
<!-- Modal -->
<div class="modal fade" id="addSubjecToCourse" data-coreui-backdrop="static" data-coreui-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog">
	<div class="modal-content">
	  <div class="modal-header">
		<h5 class="modal-title" id="addSubjecToCourse">Add Subject to Course</h5>
		<button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
	  </div>
	  <div class="modal-body">
		
		<form class="row g-3" method="post" action="">
		  <div class="col-md-6">
			<label class="form-label">Subject Name KH</label>
			<input class="form-control" type="text" name="" value="">
		  </div>
		  
		  <div class="col-md-6">
			<label class="form-label">Subject Name En</label>
			<input class="form-control" type="text" name="" value="">
		  </div>
		  
		  <div class="col-12">
			<label class="form-label">Study Time </label>
			<input class="form-control" type="text" name="" value="" />
		  </div>
		  
		   <div class="col-sm-12">
			<label class="form-label">Choose Course</label>
			<select class="form-select" name="">
			  <option selected>Choose...</option>
			  <option value="1">Web Based Development I</option>
			  <option value="2">Web Based Development II</option>
			  <option value="3">Design</option>
			</select>
		  </div>
		  
		  <div class="col-12">
			<input  class="btn btn-primary" type="submit" name="btnAdd" value="Save" />
		  </div>
		</form>
		
	  </div>
	  <div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Close</button>
		<button type="button" class="btn btn-primary">Save</button>
	  </div>
	</div>
  </div>
</div>	  



<!-- Modal -->
<div class="modal fade" id="EditSubjecToCourse" data-coreui-backdrop="static" data-coreui-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog">
	<div class="modal-content">
	  <div class="modal-header">
		<h5 class="modal-title" id="EditSubjecToCourse">Edit Subject to Course</h5>
		<button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
	  </div>
	  <div class="modal-body">
		
		<form class="row g-3" method="post" action="">
		  <div class="col-md-6">
			<label class="form-label">Subject Name KH</label>
			<input class="form-control" type="text" name="" value="">
		  </div>
		  
		  <div class="col-md-6">
			<label class="form-label">Subject Name En</label>
			<input class="form-control" type="text" name="" value="">
		  </div>
		  
		  <div class="col-12">
			<label class="form-label">Study Time </label>
			<input class="form-control" type="text" name="" value="" />
		  </div>
		  
		   <div class="col-sm-12">
			<label class="form-label">Choose Course</label>
			<select class="form-select" name="">
			  <option selected>Choose...</option>
			  <option value="1">Web Based Development I</option>
			  <option value="2">Web Based Development II</option>
			  <option value="3">Design</option>
			</select>
		  </div>
		  
		  <div class="col-12">
			<input  class="btn btn-primary" type="submit" name="btnAdd" value="Save" />
		  </div>
		</form>
		
	  </div>
	  <div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Close</button>
		<button type="button" class="btn btn-primary">Save</button>
	  </div>
	</div>
  </div>
</div>	  