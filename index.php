
<?php  require_once "apps/autoload.php";?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>

    <link rel="stylesheet" href="assets/fonts/css/all.css">
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/responsive.css">
	

</head>

<body>
<?php
//form data isset
if (isset($_POST["add"])){
    $name=$_POST["name"];
    $email=$_POST["email"];
    $cell=$_POST["cell"];
    $age=$_POST["age"];
    $uname=$_POST["uname"];
    if (isset($_POST["gender"])){
        $gender=$_POST["gender"];
    }
    if (isset($_POST["shift"])){
        $shift=$_POST["shift"];
    }
    $location=$_POST["location"];

    //photo getting
    $file_name=$_FILES['photo']['name'];
    $file_tmp_name=$_FILES['photo']['tmp_name'];
    $file_size=$_FILES['photo']['size'];

    $unique_file_name=md5(time().rand()).$file_name;


}
if (empty($name) || empty($email) || empty($cell) || empty($age) || empty($uname) || empty($gender) || empty($shift) || empty($location)){
    $mess= validationmsg("All filds are requred","info");
}elseif (!filter_var($email,FILTER_VALIDATE_EMAIL)){
    $mess=validationmsg("Invalid email","dark");
}elseif ($age<5 || $age>12){
    $mess=validationmsg("your age is not allowed");
}else{

    $conn->query("INSERT INTO students(name,email,cell,age,username,gender,shift,location,photo) VALUES ('$name','$email','$cell','$age','$uname','$gender','$shift','$location','$unique_file_name')");

    move_uploaded_file($file_tmp_name,'photos/students/'.$unique_file_name);

    $mess=validationmsg("Data stable","success");

}


?>
	
<div class="wrap">
    <a class="btn btn-sm btn-primary" href="students.php">All students</a>
	<div class="card shadow">
		<div class="card-body">
			<h1>Add student</h1>
            <?php if (isset($mess)){echo $mess;} ?>
			<form action="" method="post" enctype="multipart/form-data">

               <div class="form-group">
                  <label for="" style="color:#ffffff;">Name</label>
                  <input name="name" class= "form-control" type="text" placeholder="name">
               </div>

                 <div class="form-group">
                  <label for="" style="color:#ffffff">Email</label>
                  <input name="email" class= "form-control" type="text" placeholder="email">
               </div>

                 <div class="form-group">
                  <label for="" style="color:#ffffff">Cell</label>
                  <input name="cell" class= "form-control" type="text" placeholder="cell">
               </div>

                 <div class="form-group">
                  <label for="" style="color:#ffffff">Age</label>
                  <input name="age" class= "form-control" type="text" placeholder="age">
               </div>

                 <div class="form-group">
                  <label for="" style="color:#ffffff">Username</label>
                  <input name="uname" class= "form-control" type="text" placeholder="uname">
               </div>

                 <div class="form-group">
                  <label for="" style="color:#ffffff">Gender</label><br>
                  <input name="gender" type="radio" value="male" id="m"><label for="m">Male</label>
                  <input name="gender" type="radio" value="female" id="f"><label for="f">Female</label>
               </div>

                 <div class="form-group">
                  <label for="" style="color:#ffffff">Shift</label><br>
                  <input name="shift" type="radio" value="day" id="d" ><label for="d">Day</label>
                  <input name="shift" type="radio" value="night" id="n" ><label for="n">Night</label>
               </div>

                 <div class="form-group">
                  <label for="" style="color:#ffffff">Location</label>
                  <select name="location" id="">
                  	<option value="">select</option>
                  	<option value="Dhaka">Dhaka</option>
                  	<option value="Barisal">Barisal</option>
                  	<option value="Mymonshing">Mymonshing</option>
                  	<option value="Rajshahi">Rajshahi</option>
                  	<option value="Rongpur">Rongpur</option>
                  	<option value="Khulna">Khulna</option>
                  	<option value="Sylet">Sylet</option>
                  	<option value="Kumilla">Kumilla</option>
                  </select>
               </div>

                 <div class="form-group">
                  <label for="" style="color:#ffffff">Photo</label>
                  <input name="photo" class= "form-control" type="file">
               </div>

                 <div class="form-group">
                  <input name="add" class="btn btn-danger" type="submit" value="add new student">
               </div>
			</form>
		</div>
	</div>
</div>




	<script src="assets/js/jquery-3.5.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/custom.js"></script>
</body>
</html>