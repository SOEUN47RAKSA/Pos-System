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
			background-attachment: fixed;
			background-size: cover;
			background-repeat: no-repeat;
			background-position: center;
			background-color: #fc466b;
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
					    url: "pdb.php",
					    method: "post",
					    processData: false,
					    contentType: false,
					    data: formData,
					    success: function (data) {
					        if(data=="1"){
					        	alert("Please check picture");
					        }else{
					        	 alert(data);
					        	 window.location.href="product.php";
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

			$("#btnsavechange").click(function(){
				var form = $('#catform')[0];
				var formData = new FormData(form);

				// Add product ID to form data
				formData.append('uid', $("#uid").val());

				$.ajax({
					url: "p_edit.php", // Replace with your PHP update script
					method: "POST",
					processData: false,
					contentType: false,
					data: formData,
					success: function(data) {
						// Handle success response
						alert("Record has been added"); // Show response message
						// $('#updateUser').modal('hide'); // Hide the modal after update
						window.location.reload(); // Refresh the page or update the table
					},
					error: function(e) {
						// Handle error
						alert("Error: " + e.responseText);
					}
				});
			});

			// Select data to show on Modal for updating ...
			$("#tbluser").on('click', '.edit', function(){
				var current_row = $(this).closest("tr");
				var id = current_row.find("td:eq(0)").text();
				var pname = current_row.find("td:eq(1)").text();
				var pcode = current_row.find("td:eq(3)").text();
				var selecat = current_row.find("td:eq(4)").text();
				var qty = current_row.find("td:eq(5)").text();
				var price = current_row.find("td:eq(2)").text();
				var pic = current_row.find("td:eq(6)").find('img').attr('src');

				// Populate form fields in the update modal
				$("#uid").val(id);
				$("#pname").val(pname);
				$("#pcode").val(pcode);
				$("#selecat").val(selecat);
				$("#qty").val(qty);
				$("#price").val(price)
				$("#img").html('<img src="' + pic + '" width="100px" height="100px">');

				// Show update modal
				$("#updateUser").modal("show");
			});
					// JavaScript: Handle update operation when Save Change button is clicked
					

				
			// delete 

			$("#tbluser").on("click",".del",function(){
				var current_row = $(this).closest("tr");
				var id = current_row.find("td").eq(0).text();
				var conf = confirm("Do you want to delete?");
				if(conf==true){
					$.post("p_delet.php",{uid:id},function(data){
						if(data==1){
							alert("Record has been deleted.");
							// Reload the page after deletion
							window.location.href="product.php";
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
<h5 class="card-title" align="center">ព័ត៌មានរបស់ផលិតផល </h5>
<img src="" alt="">
<div class="container">
	<div align="right" style="margin: 10px;">
        <button class="btn btn-primary" id="userAdd"> Add New Product</button>
        <button class="btn btn-primary" id="hideTable">View Product</button>
    </div>
	<table class="table table-bordered" id="tbluser" style="display: none;">
			<thead>
					<tr class="table-primary" align="center">
						<td>Product ID</td>
						<td>Product Name</td>
						<td>Price</td>
						<td>Product code</td>
						<td>Categoryid</td>
						<td>QTY</td>
						<td>Picture</td>
						<td width="200px">Action</td>
					</tr>
			</thead>
			<tbody>
				<?php 

				$sql = "SELECT * FROM p_tbl";
				$result = $conn->query($sql);
				if($result->num_rows > 0){
					while($row = $result->fetch_assoc()){
						$id = $row["id"];
						$pname = $row["pname"];
						$pimage = $row["pimage"];
						$pcode =$row["pcode"];
						$categoryid = $row["categoryid"];
						$qty = $row["qty"];
						$price = $row["price"];
						echo "<tr>
								<td align=\"center\">".$id."</td>
								<td align=\"center\">".$pname."</td>
								<td align=\"center\">".$price."</td>
								<td align=\"center\">".$pcode."</td>
								<td align=\"center\">".$categoryid."</td>
								<td align=\"center\">".$qty."</td>
								<td align=\"center\"><img src=\"products/$pimage\" width=\"100px\" height=\"100px\"></td>

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
        <h1 class="modal-title fs-5 " id="exampleModalLabel">Add New Product</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body " id="back">
        	<form id="cusform" enctype= "multipart/form-data" class="">
        			<div class="row">
        				<div class="col">
        					Product Name:
        					<input type="text" class="form-control" id="txtpname" name="txtpname">
        				</div>
        			</div> 

        			<div class="row">
        				<div class="col">
        					<label for="text">Product Code</label>
        					<input type="text" class="form-control" id="txtpcode" name="txtpcode">
        				</div>
        			</div> 
        			<div class="row">
                      <div class="col">
                        <?php 
                        $slq = "SELECT * FROM category";
                        $result = $conn->query($slq );      
                        ?>
						
                        <label for="text">Category:</label>
                        <select name="slcat" id="slcat" class="form-control">
                            <option value="0"> Select Category</option>
                            <?php 
                            if($result->num_rows > 0){
                                while($row = $result->fetch_assoc())
                                {
                                $id = $row["catid"];
                                $catname = $row["catname"];
                                echo "<option value=\"$id\">$catname</option>";
                                }
                            }
                            ?>
                        </select>
                        </div>	
        				</div>
        			
					<div class="row">
        				<div class="col">
        					<label for="text">QTY</label>
        					<input type="text" class="form-control" id="txtqty" name="txtqty">
        				</div>
        			</div> 
					<div class="row">
        				<div class="col">
        					<label for="text">Price:</label>
        					<input type="text" class="form-control" id="txtprice" name="txtprice">
        				</div>
        			</div> 
        			<div class="row">
        				<div class="col">
        					Picture
        					<input type="file" class="form-control" id="protxtfile" name="txtfile">
							
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
        <h1 class="modal-title fs-5" id="exampleModalLabel">Update New Product</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        	<form id="catform" enctype= "multipart/form-data">
			
        			<div class="row">
					<input type="hidden" id="uid" name="uid">
					<div class="row">
        				<div class="col">
        					Product Name:
        					<input type="text" class="form-control" id="pname" name="pname">
        				</div>
        			</div> 

        			<div class="row">
        				<div class="col">
        					<label for="text">Product Code</label>
        					<input type="text" class="form-control" id="pcode" name="pcode">
        				</div>
        			</div> 
        			<div class="row">
                      <div class="col">
                        <?php 
                        $slq = "SELECT * FROM category";
                        $result = $conn->query($slq );      
                        ?>
                        <label for="text">Category:</label>
                        <select name="selecat" id="selecat" class="form-control">
                            <option value="0"> Select Category</option>
                            <?php 
                            if($result->num_rows > 0){
                                while($row = $result->fetch_assoc())
                                {
                                $id = $row["catid"];
                                $catname = $row["catname"];
                                echo "<option value=\"$id\">$catname</option>";
                                }
                            }
                            ?>
                        </select>
                        </div>	
        				</div>
        			
					<div class="row">
        				<div class="col">
        					<label for="text">QTY</label>
        					<input type="text" class="form-control" id="qty" name="qty">
        				</div>
        			</div> 
					<div class="row">
        				<div class="col">
        					<label for="text">Price:</label>
        					<input type="text" class="form-control" id="price" name="price">
        				</div>
        			</div> 
        			<div class="row">
						<div class="col">
						Picture
						<input type="file" class="form-control" id="protxtfile" name="txtfile">
						<div id="img" align="center"></div>
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
<script>
$(document).ready(function(){
    // Handle update operation when Save Change button is clicked
    $("#btnsavechange").click(function(){
        var form = $('#catform')[0];
        var formData = new FormData(form);

        $.ajax({
            url: "p_edit.php", // Replace with your PHP update script
            method: "POST",
            processData: false,
            contentType: false,
            data: formData,
            success: function(data) {
                // Handle success response
                alert(data); // Show response message
                $('#updateUser').modal('hide'); // Hide the modal after update
                window.location.reload(); // Refresh the page or update the table
            },
            error: function(e) {
                // Handle error
                alert("Error: " + e.responseText);
            }
        });
    });
});
</script>

<?php 
	include("footer.php");
?>
