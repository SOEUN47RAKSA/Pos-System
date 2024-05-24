<?php 
	include("header.php");
?>
<script type="text/javascript">
	$(function(){
		// Edit category
		$("#tblcat").on('click','.edit',function(){
			var current_row = $(this).closest("tr");
			var catid = current_row.find("td").eq(0).text();
			var catname = current_row.find("td").eq(2).text();
			var picture = current_row.find("td").eq(1).html();
			var status = current_row.find("td").eq(4).html();

			$("#catid").val(catid);
			$("#txteditcatname").val(catname);
			$("#pict").html(picture);

			$("#updateCategory").modal("show");
		});

		// Insert category
		$("#userAdd").click(function(){
			$("#insertCategory").modal("show");
		});

		// Save change for edit
		$("#btnsavechange").click(function(){
			var form = $('#catform')[0];				
			var formData = new FormData(form);

			$.ajax({
			    url: "edit_cat.php",
			    method: "post",
			    processData: false,
			    contentType: false,
			    data: formData,
			    success: function (data) {
			        if(data=="1"){
			        	alert("Update success");
			        	window.location.href="category.php";
			        } else {
			        	alert("Update failed. Please try again.");
			        }
			    },
			    error: function (e) {
			        console.log(e);
			        alert("An error occurred while processing your request.");
			    }
			});
		});

		// Save new category
		$("#btnsaveinsert").click(function(){
			var form = $('#insertForm')[0];				
			var formData = new FormData(form);

			$.ajax({
			    url: "add_cat.php",
			    method: "post",
			    processData: false,
			    contentType: false,
			    data: formData,
			    success: function (data) {
			        if(data=="1"){
			        	alert("Please check picture");
			        } else {
			        	alert("New category added successfully.");
			        	window.location.href="category.php";
			        }
			    },
			    error: function (e) {
			        console.log(e);
			        alert("An error occurred while processing your request.");
			    }
			});
		});
	});
</script>

<!-- Category List -->
<h3>Category List</h3>
<div class="container">
	<div align="right" style="margin: 10px;">
		<a href="#" class="btn btn-primary" id="userAdd">Add New Category</a>
	</div>
	<table class="table table-bordered" id="tblcat">
		<thead>
			<tr class="table-primary" align="center">
				<td>Category ID</td>
				<td>Category Picture</td>
				<td>Category Name</td>
				<td>Status</td>
				<td width="200px">Action</td>
			</tr>
		</thead>
		<tbody>
			<?php 
			$sql = "SELECT * FROM category";
			$result = $conn->query($sql);
			if($result->num_rows > 0){
				while($row = $result->fetch_assoc()){
					$id = $row["catid"];
					$catname = $row["catname"];
					$picture = $row["picture"];
					$status = $row["status"];
					
					echo "<tr>
							<td>".$id."</td>
							<td><img src=\"category../$picture\" width=\"100px\"></td>
							<td>".$catname."</td>
							<td>".$status."</td>					
							<td>
								<a href='#' class='edit btn btn-outline-info'><i class='bi bi-pencil-square'></i>Edit</a> | 
								<a href='#' class='del btn btn-outline-danger'><i class=\"bi bi-trash\"></i>Delete</a>
							</td>
						</tr>";
				}
			}
			?>	
		</tbody>
	</table>	
</div>

<!-- Update Modal -->
<div class="modal fade" id="updateCategory" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title fs-5" id="exampleModalLabel">Update Category</h1>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form id="catform" enctype="multipart/form-data">
					<div class="row">
						<div class="col">
							<input type="hidden" class="form-control" id="catid" name="catid">
							<label for="txteditcatname">Title:</label>
							<input type="text" class="form-control" id="txteditcatname" name="txteditcatname">
						</div>
					</div> 
					<div class="row">
						<div class="col">
							<label for="txteditfile">Picture:</label>
							<input type="file" class="form-control" id="txteditfile" name="txteditfile">
							<div id="pict" align="center"></div>
						</div>
					</div>
					<div class="row">
						<div class="col">
							Status
							<select id="editstatus" name="editstatus" class="form-select">
								<option value="0">Active</option>
								<option value="1">Inactive</option>
							</select>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" id="btnsavechange">Save Change Now</button>
			</div>
		</div>
	</div>
</div>
<!-- End Update Modal -->

<!-- Insert Modal -->
<div class="modal fade" id="insertCategory" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title fs-5" id="exampleModalLabel">Add New Category</h1>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form id="insertForm" enctype="multipart/form-data">
				<div class="row">
						<div class="col">
							<label for="txtcatname">Title:</label>
							<input type="text" class="form-control" id="txtcatname" name="txtcatname">
						</div>
					</div> 
					<div class="row">
						<div class="col">
							<label for="txtfile">Picture:</label>
							<input type="file" class="form-control" id="txtfile" name="txtfile">
							<div id="pict" align="center"></div>
						</div>
					</div>
					<div class="row">
						<div class="col">
							Status
							<select id="status" name="status" class="form-select">
								<option value="0">Active</option>
								<option value="1">Inactive</option>
							</select>
						</div>
					</div>
				
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" id="btnsaveinsert">Save New Category</button>
			</div>
		</div>
	</div>
</div>
<!-- End Insert Modal -->

<?php 
	include("footer.php");
?>
