
<?php  require_once "apps/autoload.php";?>
<?php


   if (isset($_GET['student_id'])){
       $student_id=$_GET['student_id'];

       $data=$conn->query("SELECT * FROM students WHERE id='$student_id'");
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
<style>
    .profile img{
        width: 200px;
        height: 200px;
        border: 1px solid #000000;
        border-radius: 50%;
        display: block;
        margin: auto;
    }
    .profile h2{
        text-align: center;
        color: white;
        font-family: "sigmar one";
    }
    .profile h4{
        text-align: center;
        color: white;
        font-family: Candara;
    }
</style>

<div class="wrap">
    <a class="btn btn-sm btn-primary" href="students.php">Back</a>
	<div class="card shadow">
		<div class="card-body profile">
            <img src="photos/students/<?php echo $single_data['photo'];?>" alt="">
            <h2><?php echo $single_data['name'];?></h2>
            <h4><?php echo $single_data['username'];?></h4>
            <table class="table table-striped">
                <tr>
                    <td style="color: white">Name</td>
                    <td style="color: white"><?php echo $single_data['name'];?></td>
                </tr>
                <tr>
                    <td style="color: white">Email</td>
                    <td style="color: white"><?php echo $single_data['email'];?></td>
                </tr>
                <tr>
                    <td style="color: white">Cell</td>
                    <td style="color: white"><?php echo $single_data['cell'];?></td>
                </tr>
                <tr>
                    <td style="color: white">Age</td>
                    <td style="color: white"><?php echo $single_data['age'];?></td>
                </tr>
                <tr>
                    <td style="color: white">Username</td>
                    <td style="color: white"><?php echo $single_data['username'];?></td>
                </tr>
                <tr>
                    <td style="color: white">Gender</td>
                    <td style="color: white"><?php echo $single_data['gender'];?></td>
                </tr>
                <tr>
                    <td style="color: white">Shift</td>
                    <td style="color: white"><?php echo $single_data['shift'];?></td>
                </tr>
                <tr>
                    <td style="color: white">Location</td>
                    <td style="color: white"><?php echo $single_data['location'];?></td>
                </tr>

            </table>
		</div>
	</div>
</div>




	<script src="assets/js/jquery-3.5.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/custom.js"></script>
</body>
</html>