<?php 
	include("header.php");
?>

<!-- Add jQuery library -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

		<script>
		// jQuery function for edit action
		$(document).ready(function(){
			$(".edit").click(function(){
				// Your edit logic here
				// For example, you can get the row data and open a modal for editing
				var row = $(this).closest("tr");
				var userId = row.find("td:eq(0)").text(); // Get User ID
				// You can do something with the userId, like passing it to an edit form
				// Open your edit modal or redirect to an edit page
				alert("Edit user with ID: " + userId);
			});
			
			// jQuery function for delete action
			$(".del").click(function(){
				// Your delete logic here
				// For example, you can confirm deletion and then make an AJAX call to delete the record
				var row = $(this).closest("tr");
				var userId = row.find("td:eq(0)").text(); // Get User ID
				var confirmation = confirm("Are you sure you want to delete user with ID: " + userId + "?");
				if (confirmation) {
					// Make an AJAX call to delete the record
					$.ajax({
						url: "del.php", // URL to your delete PHP script
						type: "POST",
						data: { userId: userId }, // Pass the user ID to delete
						success: function(response) {
							// Handle success, like removing the row from the table
							row.remove();
							alert("User deleted successfully!");
						},
						error: function(xhr, status, error) {
							// Handle error
							alert("Error deleting user: " + error);
						}
					});
				}
			});
		});
		</script>
    <?php
    $conn = new mysqli("localhost","root","","bol");
    if($conn->connect_error){
     die("Connection Failed: ".$conn->connect_error);
    }
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <script src="jquery.js"></script>
    
     <!-- <link rel="stylesheet" href="style.css">  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
</head>
<body>
<script>
     
      $(function () {
            $("#btnlogin").click(function () {
                var full_name = $("#txtfull_name").val();
                var username =$("#txtusername").val();
                var pass = $("#txtpass").val();
                var email = $("#txtemail").val();
                var sex= $("#txtsex").val();
                var phone = $("#txtphone").val();
                var skill = $("#txtskill").val();
                var year  = $("#txtyear").val();

                $.post("db_add_user.php", { full_name: full_name,user:username,password:pass, email: email, sex: sex, phone: phone,skill:skill ,year: year }, function (data) {
                  alert(data)
                    if (data == 1) {
                        alert("Record has been added");
                        location.reload();
                    } else {
                        alert("Failed to add record");
                    }
                });
            });
            $(function(){

                    $("#wrapedit").hide();

                    $("#btnsave").click(function(){
                        var full_name = $("#txtfull_name").val();
                        var username =$("#txtusername").val();
                        var pass = $("#txtpass").val();
                        var email = $("#txtemail").val();
                        var sex= $("#txtsex").val();
                        var phone = $("#txtphone").val();
                        var skill = $("#txtskill").val();
                        var year  = $("#txtyear").val();
                    //alert(user+""+pass+""+fname);

                    $error =0;
                    if(user==""){
                        $("#userError").html("Empty username.");
                        $error=1;
                    }
                    if(pass==""){
                        $("#passError").html("Empty password.");
                        $error=1;
                    }

                    if($error==0){
                        $.post("db_add_user.php",{full_name: full_name,user:username,password:pass, email: email, sex: sex, phone: phone,skill:skill ,year: year }, function(data){
                        //alert(data);
                        if(data==1){
                            alert("Record has been added");
                            window.location.href="add_user.php";
                        }
                        });

                    }

                    });

                    // delete 
                    $("#tbl").on('click','.del', function(){
                        //alert('test');
                        var current_row = $(this).closest("tr");
                        var id=current_row.find('td').eq(0).text();

                        var conf = confirm("Do you want to delete this record?");
                        
                        if(conf==true){
                        //alert(id);
                        $.post('del.php',{userid:id},function(data){
                            alert(data);
                            window.location.href="form.php";
                        });
                        }
                        
                    });

                    //select data for updating 
                    $("#tbl").on('click','.edit', function(){
                        //alert("test");
                        $("#wrapsave").hide();
                        $("#wrapedit").show();
                        var current_row = $(this).closest("tr");
                        
                        var id = current_row.find('td').eq(0).text();
                        var username = current_row.find('td').eq(1).text();
                        var fname = current_row.find('td').eq(2).text();
                        var lname = current_row.find('td').eq(3).text();
                        var phonenum = current_row.find('td').eq(4).text();
                        var status = current_row.find('td').eq(5).text();


                        $("#userid").val(id);
                        $("#txtuser").val(username);
                        $("#txtfname").val(fname);
                        $("#txtlname").val(lname);
                        $("#txtphone").val(phonenum);

                        //alert(status);
                    $('#status option[value="'+status+'"]').prop('selected', true);
                    });

                    // function update 

                    $("#btnsavechange").click(function(){

                            var userid = $("#userid").val();
                            var user = $("#txtuser").val();
                            var pass = $("#txtpass").val();
                            var fname = $("#txtfname").val();
                            var lname = $("#txtlname").val();
                            var phone = $("#txtphone").val();
                            var status = $("#status").val();
                            
                            $.post("eidit.php", { userid: userid, username: user, password: pass, fname: fname, lname: lname, phone_num: phone, status: status }, function (data) {
                            //alert(data);
                            if(data==1){
                                alert("Record has been updated");
                                window.location.href="form.php";
                            }
                            });
                            $("#btncancel").click(function(){
                                window.location.href="form.php";
                                });

                            });
                            });
                    
                            

                        
                        });
                                            

                    
                    
</script>

<div class="container mt-8 mx-auto my-5">
        <div class="row justify-content-center"> 
            <div class="col-md-5">
                <div class="card border-5 bg-success">
                    <div class="card-header bg-danger rounded-3 text-white">
                        <h1 class="card-title mb-4">Bridge Of Love Register</h1>
                    </div>
                    <div class="card-body">
                        <form id="tbl">
                             <div class="mb-3">
                                <label for="userid" class="form-label">User ID:</label>
                                <input type="text" id="userid" class="form-control">
                            </div> 
                            <div class="mb-3">
                                <label for="txtuser" class="form-label"><b>Full Name</b></label>
                                <input type="text" class="form-control" id="txtfull_name">
                            </div>
                            <div class="mb-3">
                                <label for="txtuser" class="form-label"><b>Username</b></label>
                                <input type="text" class="form-control" id="txtusername">
                            </div>
                            <div class="mb-3">
                                <label for="txtuser" class="form-label"><b>Password</b></label>
                                <input type="password" class="form-control" id="txtpass">
                            </div>
                            <div class="mb-3">
                                <label for="txtpass" class="form-label"><b>Email</b></label>
                                <input type="email" class="form-control" id="txtemail">
                                
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="txtfname" class="form-label">Sex:</label>
                                    <input type="text" class="form-control" id="txtsex">
                                </div>
                                <div class="col-md-6">
                                    <label for="txtlname" class="form-label">Skill:</label>
                                    <input type="text" class="form-control" id="txtskill">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="txtphone" class="form-label">Phone Number:</label>
                                    <input type="text" class="form-control" id="txtphone">
                                </div>
                                <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="txtphone" class="form-label">Years</label>
                                    <input type="text" class="form-control" id="txtyear">
                                </div>
                                <!-- <div class="col-md-6">
                                    <label for="status" class="form-label">Status:</label>
                                    <select class="form-control" id="status">
                                        <option value="0">Active</option>
                                        <option value="1">Inactive</option>
                                    </select>
                                </div> -->
                            </div>
                            
                            <div class="row">
                                <div class="col-md-4">
                                    <button class="btn btn-primary w-100" id="btnlogin">Create Account</button>
                                </div>
                                <tr>
            
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <button type="button" class="btn btn-primary w-100" id="btnsavechange">Save Change</button>
                                        </div>
                                        <div class="col-md-4">
                                            <button type="button" class="btn btn-secondary w-100" id="btncancel">Cancel</button>
                                        </div>
                                        <div align="right" style="margin: 10px;"><a href="index.php" class="btn btn-primary">HOME</a></div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- <div class="container mt-5">
    <h3>User List</h3>
    <table class="table table-responsive table-bordered " id="tbl"  border="1" align="center" cellspacing="0" cellpadding="5px">
        <thead class="table-success">
            <tr>
                <th>User ID</th>
                <th>Username</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Mobile Number</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // $sql = "SELECT * FROM tbl_user";
            // $result = $conn->query($sql);
            // $countrow = $result->num_rows;
            // if ($countrow > 0) {
            //     while ($row = $result->fetch_assoc()) {
            //         echo '<tr>';
            //         echo '<td>' . $row["userid"] . '</td>';
            //         echo '<td>' . $row["username"] . '</td>';
            //         echo '<td>' . $row["fname"] . '</td>';
            //         echo '<td>' . $row["lname"] . '</td>';
            //         echo '<td>' . $row["mobile_number"] . '</td>';
                    
            //         // Adding a class for the "Active" status to highlight it
            //         $statusClass = ($row["status"] == 'Active') ? 'text-success fw-bold' : '';
            //         echo '<td class="' . $statusClass . '">' . $row["status"] . '</td>';
            //         echo "<td>
            //         <button class=\"btn btn-primary\" ><a href=\"#\" class=\"edit text-white\">Edit</a></button> | 
            //         <button class=\"btn btn-danger\" ><a href=\"#\" class=\"del text-white\">Delete</a></button>
            //     </td>";

            //         echo '</tr>';
            //     }
            // }
            
            ?>
        </tbody>
    </table>
</div>


</body>
<script src="path/to/popper.js"></script>
<script src="path/to/bootstrap.js"></script>
</html> -->
<h5 class="card-title" align="center">Member Registration Form</h5>
<div class="container">
	<div align="right" style="margin: 10px;"><a href="add_user.php" class="btn btn-primary"> Add New Member</a></div>
	<table class="table table-bordered">
			<thead>
					<tr class="table-primary" align="center">
						<td>User ID</td>
						<td>FULL NAME</td>
						<td>USERNAME</td>
						<td>EMAIL</td>
						<td>Phone Number</td>
						<td>Sex</td>
						<td>Year</td>
						<td>Skill</td>
						<td width="200px">Action</td>
					</tr>
			</thead>
			<tbody>
				<?php 

				$sql = "SELECT * FROM member";
				$result = $conn->query($sql);
				if($result->num_rows > 0){
					while($row = $result->fetch_assoc()){
						$id = $row["id"];
						$fname = $row['full_name'];
						$user = $row["username"];
						$gmail = $row['gmail'];
						$phone = $row['mobile_number'];
						$sex = $row['sex']; // corrected variable name
						$year = $row['years'];
						$skill = $row['skill']; // assuming there's a 'skill' column
						echo "<tr>
								<td>".$id."</td>
								<td>".$fname."</td>
								<td>".$user."</td>
								<td>".$gmail."</td>
								<td>".$phone."</td>
								<td>".$sex."</td>
								<td>".$year."</td>
								<td>".$skill."</td>
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

<?php 
	include("footer.php");
?>
