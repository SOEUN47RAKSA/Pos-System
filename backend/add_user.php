<!-- <?php
    $conn = new mysqli("localhost", "root", "", "bol");
    if ($conn->connect_error) {
        die("Connection Failed: " . $conn->connect_error);
    }
?>

<?php 
	include("header.php");
	include("../connection.php");
?>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

     <!-- <link rel="stylesheet" href="style.css">  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="jquery.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

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
            
           
       

                    $(document).ready(function() {
                        // When Edit button is clicked
                        $(".edit").on("click", function() {
                            // Get the row associated with the edit button
                            var row = $(this).closest("tr");
                            
                            // Extract data from the row
                            var userID = row.find("td:eq(0)").text();
                            var fullName = row.find("td:eq(1)").text();
                            var username = row.find("td:eq(2)").text();
                            var email = row.find("td:eq(3)").text();
                            var phoneNumber = row.find("td:eq(4)").text();
                            var sex = row.find("td:eq(5)").text();
                            var year = row.find("td:eq(6)").text();
                            var skill = row.find("td:eq(7)").text();
                            
                            // Populate the form fields with the extracted data
                            $("#userid").val(userID);
                            $("#txtfull_name").val(fullName);
                            $("#txtusername").val(username);
                            $("#txtemail").val(email);
                            $("#txtphone").val(phoneNumber);
                            $("#txtsex").val(sex);
                            $("#txtyear").val(year);
                            $("#txtskill").val(skill);
                            
                            // Scroll to the top of the form
                            $("html, body").animate({ scrollTop: $("#tbl").offset().top }, 500);
                            
                            // Change Save button functionality to Update
                            $("#btnsave").hide();
                            $("#btnsavechange").show();
                        });
                        
                        // When Save Change button is clicked
                        $(document).ready(function() {
    // When Save Change button is clicked
                                $("#btnsavechange").on("click", function() {
                                    // Get the updated values from the form fields
                                    var userID = $("#userid").val();
                                    var fullName = $("#txtfull_name").val();
                                    var username = $("#txtusername").val();
                                    var email = $("#txtemail").val();
                                    var phoneNumber = $("#txtphone").val();
                                    var sex = $("#txtsex").val();
                                    var year = $("#txtyear").val();
                                    var skill = $("#txtskill").val();
                                    
                                    // Send an AJAX request to update the data
                                    $.ajax({
                                        url: "update.php",
                                        method: "POST",
                                        data: {
                                            id: userID,
                                            full_Name: fullName,
                                            user: username,
                                            email: email,
                                            phoner: phoneNumber,
                                            sex: sex,
                                            year: year,
                                            skill: skill
                                        },
                                        success: function(response) {
                                            // Handle success response
                                            alert("Data updated successfully!");
                                            // You may want to perform additional actions after the update
                                            window.location.reload();
                                        },
                                        error: function(xhr, status, error) {
                                            // Handle error response
                                            console.error(xhr.responseText);
                                            alert("An error occurred while updating data. Please try again later.");
                                        }
                                    });
                                });
                            });

                        $(document).ready(function() {
                            // When Delete button is clicked
                            $(".del").on("click", function() {
                                // Get the row associated with the delete button
                                var row = $(this).closest("tr");
                                
                                // Extract the user ID from the row
                                var userID = row.find("td:eq(0)").text();
                                
                                // Confirm with the user before deleting
                                var confirmDelete = confirm("Are you sure you want to delete this record?");
                                
                                if (confirmDelete) {
                                    // Send an AJAX request to delete the record
                                    $.ajax({
                                        url: "del.php", // URL to the script that handles the delete operation
                                        method: "POST",
                                        data: { id: userID }, // Send the user ID to identify the record to delete
                                        success: function(response) {
                                            // Handle success response
                                            alert("Record deleted successfully!");
                                            // You may want to perform additional actions after the deletion
                                            // For example, you can remove the row from the table
                                            row.remove();
                                        },
                                        error: function(xhr, status, error) {
                                            // Handle error response
                                            console.error(xhr.responseText);
                                            alert("An error occurred while deleting the record. Please try again later.");
                                        }
                                    });
                                }
                            });
                        });
                    });




        //     $(function(){

        //             $("#wrapedit").hide();

        //             $("#btnsave").click(function(){
        //                 var full_name = $("#txtfull_name").val();
        //                 var username =$("#txtusername").val();
        //                 var pass = $("#txtpass").val();
        //                 var email = $("#txtemail").val();
        //                 var sex= $("#txtsex").val();
        //                 var phone = $("#txtphone").val();
        //                 var skill = $("#txtskill").val();
        //                 var year  = $("#txtyear").val();
        //             //alert(user+""+pass+""+fname);

        //             $error =0;
        //             if(username==""){
        //                 $("#userError").html("Empty username.");
        //                 $error=1;
        //             }
        //             if(pass==""){
        //                 $("#passError").html("Empty password.");
        //                 $error=1;
        //             }

        //             if($error==0){
        //                 $.post("update.php",{full_name: full_name,user:username,password:pass, email: email, sex: sex, phone: phone,skill:skill ,year: year }, function(data){
        //                 //alert(data);
        //                 if(data==1){
        //                     alert("Record has been added");
        //                     window.location.href="add_user.php";
        //                 }
        //                 });

        //             }

        //             });

        //             // delete 
        //             $("#tbl").on('click','.del', function(){
        //                 //alert('test');
        //                 var current_row = $(this).closest("tr");
        //                 var id=current_row.find('td').eq(0).text();

        //                 var conf = confirm("Do you want to delete this record?");
                        
        //                 if(conf==true){
        //                 //alert(id);
        //                 $.post('del.php',{userid:id},function(data){
        //                     alert(data);
        //                     window.location.href="form.php";
        //                 });
        //                 }
                        
        //             });

        //             //select data for updating 
        //             $("#tbl").on('click', '.edit', function(){
        //     $("#wrapsave").hide();
        //     $("#wrapedit").show();
        //     var current_row = $(this).closest("tr");
            
        //     var id = current_row.find('td').eq(0).text();
        //     var full_name = current_row.find('td').eq(1).text();
        //     var username = current_row.find('td').eq(2).text();
        //     var gmail = current_row.find('td').eq(3).text(); // Assuming email is in the fourth column
        //     var phone = current_row.find('td').eq(4).text();
        //     var sex = current_row.find('td').eq(5).text();
        //     var year = current_row.find('td').eq(6).text();
        //     var skill = current_row.find('td').eq(7).text();

        //     // Set the values of form fields with the data from the selected row
        //     $("#userid").val(id);
        //     $("#txtfull_name").val(full_name);
        //     $("#txtusername").val(username);
        //     $("#txtemail").val(gmail); // Corrected to match the HTML ID
        //     $("#txtphone").val(phone);
        //     $("#txtsex").val(sex);
        //     $("#txtyear").val(year);
        //     $("#txtskill").val(skill);
        // });


        //             // function update 

        //             
                    
                            

                        
        //                 });
                                            

                    
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
                                <label for="id" class="form-label">User ID:</label>
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
								<td colspan="2" align="right" height="40px">
									<div id="wrapsave">
									<button type="button" id="btnsave"> Save Now</button>
									</div>
									<div id="wrapedit">
									<button type="button" id="btnsavechange">Save Change</button>
									<button type="button" id="btncancel">Cancel</button>
									</div>
								</td>
                                <!-- <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <button type="button" class="btn btn-primary w-100" id="btnsavechange">Save Change</button>
                                        </div>
                                        <div class="col-md-4">
                                            <button type="button" class="btn btn-secondary w-100" id="btncancel">Cancel</button>
                                        </div>
                                        <div align="right" style="margin: 10px;"><a href="index.php" class="btn btn-primary">HOME</a></div>
                                    </div>
                                </div> -->
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



<h5 class="card-title" align="center">Member Registration Form</h5>
<div class="container">
	 <div align="right" style="margin: 10px;"><a href="add_user.php" class="btn btn-primary"> Add New Member</a></div>
	<table class="table table-bordered" id="tbl">
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
								<td><a href='#' class='edit btn btn-outline-info'><i class='bi bi-pencil-square' class=\"edit\"></i>Edit</a> | 
								<a href='#' class='del btn btn-outline-danger'><i class=\"bi bi-trash\"  class=\"del\"></i>Delete</a>
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>

<div class="container mt-8 mx-auto my-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card border-5 bg-success">
                <div class="card-header bg-danger rounded-3 text-white">
                    <h1 class="card-title mb-4">Bridge Of Love Register</h1>
                </div>
                <div class="card-body">
                    <form id="form">
                        <div class="mb-3">
                            <label for="userid" class="form-label">User ID:</label>
                            <input type="text" id="userid" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="txtfull_name" class="form-label"><b>Full Name</b></label>
                            <input type="text" class="form-control" id="txtfull_name">
                        </div>
                        <div class="mb-3">
                            <label for="txtusername" class="form-label"><b>Username</b></label>
                            <input type="text" class="form-control" id="txtusername">
                        </div>
                        <div class="mb-3">
                            <label for="txtpass" class="form-label"><b>Password</b></label>
                            <input type="password" class="form-control" id="txtpass">
                        </div>
                        <div class="mb-3">
                            <label for="txtemail" class="form-label"><b>Email</b></label>
                            <input type="email" class="form-control" id="txtemail">
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="txtsex" class="form-label">Sex:</label>
                                <input type="text" class="form-control" id="txtsex">
                            </div>
                            <div class="col-md-6">
                                <label for="txtskill" class="form-label">Skill:</label>
                                <input type="text" class="form-control" id="txtskill">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="txtphone" class="form-label">Phone Number:</label>
                                <input type="text" class="form-control" id="txtphone">
                            </div>
                            <div class="col-md-6">
                                <label for="txtyear" class="form-label">Years</label>
                                <input type="text" class="form-control" id="txtyear">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <button class="btn btn-primary w-100" id="btnlogin">Create Account</button>
                            </div>
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

<script>
    $(document).ready(function() {
        // Your JavaScript code here
    });
</script>

</body>
</html> -->
