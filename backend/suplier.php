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
					    url: "pos_pic_sup.php",
					    method: "post",
					    processData: false,
					    contentType: false,
					    data: formData,
					    success: function (data) {
					        if(data=="1"){
					        	alert("Please check picture");
					        }else{
					        	 alert(data);
					        	 window.location.href="suplier.php";
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
			$("#tbluser").on('click','.edit',function(){
					//alert("test");
					var current_row = $(this).closest("tr");
					var id= current_row.find("td").eq(0).text();
					var user = current_row.find("td").eq(1).text();
					var fname = current_row.find("td").eq(2).text();
					var lname = current_row.find("td").eq(3).text();
					var phone = current_row.find("td").eq(4).text();
					var status = current_row.find("td").eq(5).text();
					// alert(status);
					$("#txtuseridU").val(id);
					$("#txtuserU").val(user);
					$("#txtfnameU").val(fname);
					$("#txtlnameU").val(lname);
					$("#txtphonenumberU").val(phone);


					$("input[name=rgstatusU][value='"+status+"']").prop("checked",true);
					$("#updateUser").modal("show");
			});
     
         // chang status 
			$('.stat').click(function(){
					//	$("input[name=rgstatusU][value='"+status+"']").prop("checked",true)

			});

			//Click update on btnsavechange
			$("#btnsavechange").click(function(){
					//alert("test");
				var userid = $("#txtuseridU").val();
				var user = $("#txtuserU").val();
				var pass = $("#txtpassU").val();
				var fname = $("#txtfnameU").val();
				var lname = $("#txtlnameU").val();
				var txtphonenumber = $("#txtphonenumberU").val();

				var txtstatus = $("input[name='rgstatusU']:checked").val();
				
				$.post("exect_user_update.php",{userid:userid,user:user,pass:pass,fname:fname,lname:lname,txtphonenumber:txtphonenumber,status:txtstatus},function(data){
						//alert(data);
						if(data=="1"){
							 alert("Record has been updated");
							 window.location.href="suplier.php";
						}
				});
			});

			// delete 

			$("#tbluser").on("click", ".del", function(){
				var current_row = $(this).closest("tr");
				var id = current_row.find("td").eq(0).text();
				var conf = confirm("Do you want to delete?");
				if(conf == true) {
					$.post("suplier_delete.php", {userid: id}, function(data) {
						if(data == 1) {
							alert("Fail to deleted.");
							 // Remove the row from the table on successful deletion
						} else {
							alert("Record has been deleted.");
							window.location.href="suplier.php";
						}
					});
				}
			});


		});
</script>
<p id="sql"></p>
<h5 class="card-title" align="center">Suplier Info</h5>
<div class="container">
	<div align="right" style="margin: 10px;"><a href="#" class="btn btn-primary" id="userAdd"> Add New Suplier</a></div>
	<table class="table " id="tbluser">
			<thead>
					<tr class="bg-primary text-white" align="center">
						<td> ID</td>
						<td>Full Name</td>
						<td>Email</td>
						<td>Phone Number</td>
						<td>Address</td>
						<td>Picture</td>
						<td>Gender</td>
						<td width="200px">Action</td>
					</tr>
			</thead>
			<tbody>
				<?php 

				$sql = "SELECT * FROM suplier";
				$result = $conn->query($sql);
				if($result->num_rows > 0){
					while($row = $result->fetch_assoc()){
						$id = $row["id"];
						$sname = $row["sname"];
						$gender = $row["gender"];
						$gmail = $row["email"];
						$phone = $row["phone"];
						$address = $row["adress"];
						$picture = $row["picture"];
						echo "<tr>
								<td>".$id."</td>
								<td>".$sname."</td>
								<td>".$gmail."</td>
								<td>".$phone."</td>
								<td>".$address."</td>
								<td><img src=\"../suplier/$picture\" width=\"100px\" height=\"100px\"></td>
								<td>".$gender."</td>

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
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Customer</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        	<form id="cusform" enctype= "multipart/form-data">
        			<div class="row">
        				<div class="col">
        					FullName:
        					<input type="text" class="form-control" id="sname" name="sname">
        				</div>
        			</div> 

        			<div class="row">
        				<div class="col">
        					Email:
        					<input type="email" class="form-control" id="email" name="email">
        				</div>
        			</div> 
        			<div class="row">
        				<div class="col">
        					Gender:
        					<select class="form-select" id="slgender" name="slgender">
        							<option value="Male">Male</option>
        							<option value="Female">Female</option>
        					</select>
        				</div>
        			</div>
					<div class="row">
        				<div class="col">
        					Tel:
        					<input type="text" class="form-control" id="phone" name="phone">
        				</div>
        			</div> 
					<div class="row">
        				<div class="col">
        					Address:
        					<input type="text" class="form-control" id="address" name="address">
        				</div>
        			</div> 
        			<div class="row">
        				<div class="col">
        					Picture
        					<input type="file" class="form-control" id="txtfile" name="txtfile">
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
        	<form>
        			<div class="row">
        				<div class="col">
        					<input type="txtuseridU" class="form-control" id="txtuseridU" name="txtuseridU">
        					Username:

        					<input type="txtuserU" class="form-control" id="txtuserU">
        				</div>
        			</div> 

        			<div class="row">
        				<div class="col">
        					Password:
        					<input type="password" class="form-control" id="txtpassU">
        				</div>
        			</div> 
        			<div class="row">
        				<div class="col">
        					First Name:
        					<input type="text" class="form-control" id="txtfnameU">
        				</div>
        			</div>
        			<div class="row">
        				<div class="col">
        					Last Name:
        					<input type="text" class="form-control" id="txtlnameU">
        				</div>
        			</div>

        			<div class="row">
        				<div class="col">
        					Phone Number:
        					<input type="text" class="form-control" id="txtphonenumberU">
        				</div>
        			</div>
        			<div class="row">
        				<div class="col">
        					Status:
        					<input type="radio" name="rgstatusU" value="0"> Active
        					<input type="radio" name="rgstatusU" value="1"> Inactived
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
