<?php
include_once "apps/autoload.php";
?>

<?php
if (isset($_GET['delete_id'])){
    $delete_id=$_GET['delete_id'];
    $delete_photo=$_GET['photo'];

   $sql="DELETE FROM students WHERE id='$delete_id'";
    $conn->query($sql);

    unlink('photos/students/' .$delete_photo);
    header('location:students.php');

}

if (isset($_GET['active_id'])){
    $active_id=$_GET['active_id'];

    $sql="UPDATE students SET status='active' WHERE id='$active_id'";
    $conn->query($sql);

    header('location:students.php');

}


if (isset($_GET['inactive_id'])){
    $inactive_id=$_GET['inactive_id'];

    $sql="UPDATE students SET status='inactive' WHERE id='$inactive_id'";
    $conn->query($sql);

    header('location:students.php');

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Development Area</title>
	<!-- ALL CSS FILES  -->
    <link rel="stylesheet" href="assets/fonts/css/all.css">
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/responsive.css">
</head>
<body>
	
	

	<div class="wrap-table">
        <a class="btn btn-sm btn-primary" href="index.php">Add new student</a>
		<div class="card shadow ">
			<div class="card-body">
				<h2>All Students Data</h2>
				<table class="table table-striped">
					<thead>
						<tr>
							<th>#</th>
							<th>Name</th>
							<th>Email</th>
							<th>Cell</th>
							<th>Gender</th>
							<th>Shift</th>
							<th>Location</th>
							<th>Photo</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
                    <?php
                    $data=$conn->query("SELECT * FROM students");

                    $i=1;
                    while ($student_db_data=$data->fetch_assoc()):

                    ?>
						<tr>
							<td><?Php  echo $i; $i++; ?></td>
							<td><?php echo $student_db_data['name'];?></td>
							<td><?php echo $student_db_data['email'];?></td>
							<td><?php echo $student_db_data['cell'];?></td>
							<td><?php echo $student_db_data['gender'];?></td>
							<td><?php echo $student_db_data['shift'];?></td>
							<td><?php echo $student_db_data['location'];?></td>
							<td><img style="width: 60px;height: 60px" src="photos/students/<?php echo $student_db_data['photo'];?>" alt=""></td>
							<td>
                                <?php if ($student_db_data['status']=='inactive'):?>
                                    <a class="btn btn-sm btn-success" href="?active_id=<?php echo $student_db_data['id'];?>"><i class="far fa-thumbs-up"></i></a>;

                                <?php elseif ($student_db_data['status']=='active'): ?>
                                    <a class="btn btn-sm btn-danger" href="?inactive_id=<?php echo $student_db_data['id'];?>"><i class="far fa-thumbs-down"></i></a>;
                                <?php endif; ?>
								<a class="btn btn-sm btn-info" href="profile.php?student_id=<?php echo $student_db_data['id'];?>"><i class="fas fa-eye"></i></a>
								<a class="btn btn-sm btn-warning" href="edit.php?edit_id=<?php echo $student_db_data['id'];?>"><i class="far fa-edit"></i></a>
								<a id="delete_btn" class="btn btn-sm btn-danger" href="?delete_id=<?php echo $student_db_data['id'];?>&photo=<?php echo $student_db_data['photo'];?>"><i class="fas fa-trash-alt"></i></a>
							</td>
						</tr>
                    <?php  endwhile; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	








	<!-- JS FILES  -->

<script src="assets/js/jquery-3.5.1.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/custom.js"></script>

    <script>
       $('a#delete_btn').click(function (){
        let conf= confirm('Are you sure?');

        if (conf==true){
            return true;
        }else {
            return false;
        }
       });

    </script>
</body>
</html>