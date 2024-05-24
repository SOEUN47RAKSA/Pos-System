<?php 
	include("header.php");
	include("../connection.php")
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>បង្កើត​អតិថិជន</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/cesiumjs/1.78/Build/Cesium/Cesium.js"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
	<style>
		#back {
			background-image: url('uploads/logo_spi.jpg');
			background-size: cover;
			background-repeat: no-repeat;
			background-position: center;
			opacity: 90%;
		}
	</style>
</head>
<body>

<!-- Modal -->
<script>
		$(function(){
			// click on add user to show modal
			$("#userAdd").click(function(){
					//alert("test");
				$("#addUserModal").modal('show');
			});

			// Save 
			$("#btnsave").click(function(e){

				var form = $('#cusform')[0];				
              var formData = new FormData(form);

         $.ajax({
					    url: "db_add_user.php",
					    method: "post",
					    processData: false,
					    contentType: false,
					    data: formData,
					    success: function (data) {
					        if(data=="1"){
					        	alert("User Created Successfully");
					        }else{
					        	 alert(data);
					        	 window.location.href="user.php";
					        //$("#sql").html(data);
					        }
					       
					    },
					    error: function (e) {
					        alert(e);
					    }
					});


				/*
				$.post("ex_add_customer.php",formData,function(e){
		       	alert(e);
		     });
					*/

			});

						// select data to show on Modal for updating ...
						// JavaScript: Populate update modal with customer information when edit button is clicked
					$("#tbluser").on('click', '.edit', function(){
						var current_row = $(this).closest("tr");
						var id = current_row.find("td:eq(0)").text();
						var full_name = current_row.find("td:eq(1)").text();
						var gender = current_row.find("td:eq(2)").text();
						var email = current_row.find("td:eq(3)").text();
						var phone = current_row.find("td:eq(4)").text();
						var address = current_row.find("td:eq(5)").text();
						var pic = current_row.find("td:eq(6)").find('img').attr('src');

						// Populate form fields in the update modal
						$("#userid").val(id);
						$("#txtfname").val(full_name);
						$("#slgender").val(gender);
						$("#email").val(email);
						$("#txtphone").val(phone);
						$("#address").val(address);
						$("#pict").html('<img src="' + pic + '" width="100px" height="100px">');

						// Show update modal
						$("#updateUser").modal("show");
					});

					// JavaScript: Handle update operation when Save Change button is clicked
					$("#btnsavechange").click(function(){
						var form = $('#catform')[0];                
						var formData = new FormData(form);

						$.ajax({
							url: "cus_edit.php",
							method: "post",
							processData: false,
							contentType: false,
							data: formData,
							success: function (data) {
								if(data=="1"){
									alert("Update success");
									window.location.href="customer.php";
								}
							},
							error: function (e) {
								alert(e);
							}
						});
					});

				
			// delete 

			$("#tbluser").on("click",".del",function(){
				var current_row = $(this).closest("tr");
				var id = current_row.find("td").eq(0).text();
				var conf = confirm("Do you want to delete?");
				if(conf==true){
					$.post("delette_cus.php",{userid:id},function(data){
						if(data==1){
							alert("Record has been deleted.");
							// Reload the page after deletion
							window.location.href="customer.php";
						}
					});
				}
			});

            // Hide and show table
            $("#hideTable").click(function(){
                $("#tbluser").toggle();
            });


		});
</script>
<p id="sql"></p>
<h5 class="card-title" align="center">User information...</h5>
<div class="container">
	<div align="right" style="margin: 10px;">
        <button class="btn btn-primary" id="userAdd"> Add New User</button>
        <button class="btn btn-primary" id="hideTable">View User</button>
    </div>
	<table class="table " id="tbluser" style="display: none;">
			<thead>
					<tr class="table-primary" align="center">
						<td> ID</td>
						<td>Username</td>
						<td>User Password</td>
						<td width="200px">Action</td>
					</tr>
			</thead>
			<tbody>
				<?php 

				$sql = "SELECT * FROM login_ms";
				$result = $conn->query($sql);
				if($result->num_rows > 0){
					while($row = $result->fetch_assoc()){
						$id = $row["id"];
						$username = $row["username"];
						
						
						echo "<tr>
								<td align=\"center\">".$id."</td>
								<td align=\"center\">".$username."</td>
								<td><a href='#' class='edit btn btn-outline-info'><i class='bi bi-pencil-square'></i>Edit</a> | 

								<a href='#' class='del btn btn-outline-danger'><i class=\"bi bi-trash\"></i>Delete</a>


								</td>
							</tr>";
					}
				}
				?>
				
			</tbody>
	</table>	
</div>
<!-- Start Modal -->
<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content ">
      <div class="modal-header p-3 mb-2 bg-primary text-white">
        <h1 class="modal-title fs-5 " id="exampleModalLabel">Add New Customer</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body " id="back">
        	<form id="cusform" enctype= "multipart/form-data" class="">
        			<div class="row">
        				<div class="col">
        					Username:
        					<input type="text" class="form-control" id="usrname" name="username">
        				</div>
        			</div> 

        			<div class="row">
        				<div class="col">
        					<label for="password">Password:</label>
        					<input type="password" class="form-control" id="upass" name="upass">
        				</div>
        			</div> 
        			
					

        	</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="btnsave">Save Now</button>
      </div>
    </div>
  </div>
</div>
<!-- and add modal-->


<!-- update Modal -->
<div class="modal fade" id="updateUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Update New Member</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        	<form id="catform" enctype= "multipart/form-data">
			
        			<div class="row">
					<input type="hidden" id="userid" name="userid">
					<div class="row">
        				<div class="col">
        					<label for="text">FullName</label>
        					<input type="text" class="form-control" id="txtfname" name="txtfname">
        				</div>
        			</div> 

        			<div class="row">
        				<div class="col">
        					<label for="email">Email</label>
        					<input type="email" class="form-control" id="email" name="email">
        				</div>
        			</div> 
        			<div class="row">
        				<div class="col">
        					<label for="text">Gender</label>
        					<select class="form-select" id="slgender" name="slgender">
        							<option value="Male">Male</option>
        							<option value="Female">Female</option>
        					</select>
        				</div>
        			</div>
					<div class="row">
        				<div class="col">
        					<label for="text">Phone Number</label>
        					<input type="text" class="form-control" id="txtphone" name="txtphone">
        				</div>
        			</div> 
					<div class="row">
        				<div class="col">
        					Address:
        					<input type="text" class="form-control" id="address" name="txtaddress">
        				</div>
        			</div> 
        			<div class="row">
        				<div class="col">
        					Picture
        					<input type="file" class="form-control" id="txtfile" name="txtfile">
							<div id="pict" align="center" ></div>
							
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

<?php 
	include("footer.php");
?>
