
<?php  require_once "apps/autoload.php";?>

<?php
if (isset($_POST["add"])){
    $edit_id=$_GET['edit_id'];
    $edit_photo=$_GET['edit_photo'];

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

}

if (empty($name) || empty($email) || empty($cell) || empty($age) || empty($uname) || empty($gender) || empty($shift) || empty($location)){
    $mess= validationmsg("All filds are updated","info");
}elseif (!filter_var($email,FILTER_VALIDATE_EMAIL)){
    $mess=validationmsg("Invalid email","dark");
}elseif ($age<5 || $age>12){
    $mess=validationmsg("your age is not allowed");
}else{

        $photo_name = "";
        if (empty($_FILES['new_photo']['name'])) {
            $photo_name = $_POST['old_photo'];
        } else {
            $file_name = $_FILES['new_photo']['name'];
            $file_tmp_name = $_FILES['new_photo']['tmp_name'];
            $file_size = $_FILES['new_photo']['size'];

            $photo_name = md5(time() . rand()) . $file_name;

            unlink('photos/students/'.$edit_photo);
            move_uploaded_file($file_tmp_name, 'photos/students/' . $photo_name);

        }


    $conn->query("UPDATE students SET name ='$name',email='$email',cell='$cell',age='$age',username='$uname',gender='$gender',shift='$shift',location='$location',photo='$photo_name' WHERE id='$edit_id'");


    $mess = validationmsg("Data updated", "success");

}

?>
<?php

if (isset($_GET['edit_id'])){
    $edit_id=$_GET['edit_id'];

    $sql="SELECT * FROM students WHERE id='$edit_id'";
    $data=$conn->query($sql);

    $single_data=$data->fetch_assoc();
}

?>



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


<div class="wrap">
    <a class="btn btn-sm btn-primary" href="students.php">back</a>
	<div class="card shadow">
		<div class="card-body">
			<h1>Update Student</h1>
            <?php if (isset($mess)){echo $mess;} ?>
			<form action="" method="post" enctype="multipart/form-data">

               <div class="form-group">
                  <label for="" style="color:#ffffff;">Name</label>
                  <input name="name" class= "form-control" type="text" value="<?php echo $single_data['name'];?>">
               </div>

                 <div class="form-group">
                  <label for="" style="color:#ffffff">Email</label>
                  <input name="email" class= "form-control" type="text" value="<?php echo $single_data['email'];?>">
               </div>

                 <div class="form-group">
                  <label for="" style="color:#ffffff">Cell</label>
                  <input name="cell" class= "form-control" type="text" value="<?php echo $single_data['cell'];?>">
               </div>

                 <div class="form-group">
                  <label for="" style="color:#ffffff">Age</label>
                  <input name="age" class= "form-control" type="text" value="<?php echo $single_data['age'];?>">
               </div>

                 <div class="form-group">
                  <label for="" style="color:#ffffff">Username</label>
                  <input name="uname" class= "form-control" type="text" value="<?php echo $single_data['username'];?>">
               </div>

                 <div class="form-group">
                  <label for="" style="color:#ffffff">Gender</label><br>
                  <input name="gender" <?php if ($single_data['gender']=='male'){echo "checked";}?> type="radio" value="male" id="m"><label for="m">Male</label>
                  <input name="gender" <?php if ($single_data['gender']=='female'){echo "checked";}?> type="radio" value="female" id="f"><label for="f">Female</label>
               </div>

                 <div class="form-group">
                  <label for="" style="color:#ffffff">Shift</label><br>
                  <input name="shift" <?php if ($single_data['shift']=='day'){echo "checked";}?> type="radio" value="day" id="d" ><label for="d">Day</label>
                  <input name="shift" <?php if ($single_data['shift']=='night'){echo "checked";}?> type="radio" value="night" id="n" ><label for="n">Night</label>
               </div>

                 <div class="form-group">
                  <label for="" style="color:#ffffff">Location</label>
                  <select name="location" id="">
                  	<option value="">select</option>
                  	<option <?php if ($single_data['location']=='Dhaka'){echo "selected";}?> value="Dhaka">Dhaka</option>
                  	<option <?php if ($single_data['location']=='Barisal'){echo "selected";}?> value="Barisal">Barisal</option>
                  	<option <?php if ($single_data['location']=='Mymonshing'){echo "selected";}?> value="Mymonshing">Mymonshing</option>
                  	<option <?php if ($single_data['location']=='Rajshahi'){echo "selected";}?> value="Rajshahi">Rajshahi</option>
                  	<option <?php if ($single_data['location']=='Rongpur'){echo "selected";}?> value="Rongpur">Rongpur</option>
                  	<option <?php if ($single_data['location']=='Khulna'){echo "selected";}?> value="Khulna">Khulna</option>
                  	<option <?php if ($single_data['location']=='Sylet'){echo "selected";}?> value="Sylet">Sylet</option>
                  	<option <?php if ($single_data['location']=='Kumilla'){echo "selected";}?> value="Kumilla">Kumilla</option>
                  </select>
               </div>
                <div class="form-group">
                    <img style="width: 100px;" src="photos/students/<?php echo $single_data['photo']; ?>" alt="">
                    <input  name="old_photo" value="<?php echo $single_data['photo']; ?>" type="hidden">
                </div>

                 <div class="form-group">
                  <label for="" style="color:#ffffff">Photo</label>
                  <input name="new_photo" class= "form-control" type="file">
               </div>

                 <div class="form-group">
                  <input name="add" class="btn btn-danger" type="submit" value="update now">
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