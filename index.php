<?php
// Connect Database 
$Host  = "localhost";
$pass = "";
$User = "root";
$bdName = "universityproject1";
$dbConn = mysqli_connect($Host, $User, $pass, $bdName);
// CREATE students data
if (isset($_POST['st_send'])) {
    $stName = $_POST['st_name'];
    $stAge = $_POST['st_age'];
    $stCity = $_POST['st_city'];
    $stMajor = $_POST['st_major'];
    $stCreate = "INSERT INTO students VALUES (NULL , '$stName'  , '$stCity' , $stAge , '$stMajor')";
    mysqli_query($dbConn, $stCreate);
    header("location: /finalproject1/#St");
}
// READ students data
$stRead = "SELECT * FROM students";
$stData = mysqli_query($dbConn, $stRead);
// UPDATE student data
$stUpdate = false;
$stName = "";
$stAge = "";
$stCity = "";
$stMajor = "";
if (isset($_GET['stEdit'])) {
    $id = $_GET['stEdit'];
    $stUpdate = true;
    $stReturn = "SELECT `Name` , Age , City , Major FROM students WHERE ID = $id";
    $stRetData = mysqli_query($dbConn, $stReturn);
    $stRow = mysqli_fetch_assoc($stRetData);
    $stName = $stRow['Name'];
    $stAge = $stRow['Age'];
    $stCity = $stRow['City'];
    $stMajor = $stRow['Major'];
    if (isset($_POST['st_update'])) {
        $stName = $_POST['st_name'];
        $stAge = $_POST['st_age'];
        $stCity = $_POST['st_city'];
        $stMajor = $_POST['st_major'];
        $stUpdate = "UPDATE  students SET `Name` = '$stName' , Age =  $stAge , City =' $stCity' , Major = '$stMajor' WHERE ID = $id ";
        mysqli_query($dbConn, $stUpdate);
        header("location: /finalproject1/#St");
    }
}
// DELETE student
if (isset($_GET['stDel'])) {
    $id = $_GET['stDel'];
    // Delete student registeration 
    $stRegister = "DELETE FROM registered WHERE St_ID = $id ";
    mysqli_query($dbConn, $stRegister);
    // Delete student 
    $stDelete = "DELETE FROM students WHERE ID = $id";
    mysqli_query($dbConn, $stDelete);
    header("location: /finalproject1/#St");
}
// CREATE Courses data 
if (isset($_POST['Crs_send'])) {
    $CrsName = $_POST['crs_name'];
    $CrsCode = $_POST['crs_code'];
    $crsCreate = "INSERT INTO course VALUES ('$CrsCode' , '$CrsName')";
    mysqli_query($dbConn, $crsCreate);
    header("location: /finalproject1/#Crs");
}
// READ courses
$CrsRead = "SELECT * FROM course ";
$CrsRetData = mysqli_query($dbConn, $CrsRead);
// UPDATE Courses
$CrsUpdate = false;
$CrsName = "";
$CrsCode = "";
if (isset($_GET['crsEdit'])) {
    $Code = $_GET['crsEdit'];
    $CrsUpdate = true;
    $crsData = " SELECT * FROM course WHERE `CrsCode` = '$Code' ";
    $crsRet = mysqli_query($dbConn, $crsData);
    $crsRow = mysqli_fetch_assoc($crsRet);
    $CrsName = $crsRow['CrsName'];
    $CrsCode = $crsRow['CrsCode'];
    if (isset($_POST['Crs_update'])) {
        $CrsName = $_POST['crs_name'];
        $CrsCode = $_POST['crs_code'];
        $crsUpdate = "UPDATE course SET CrsName = ' $CrsName' , CrsCode = '$CrsCode' WHERE  `CrsCode` = '$Code' ";
        mysqli_query($dbConn, $crsUpdate);
        header("location: /finalproject1/#Crs");
    }
}
// Delete course
if (isset($_GET['crsDel'])) {
    $Code = $_GET['crsDel'];
    // Delete course registeration 
    $crsRegister = "DELETE FROM registered WHERE Crs_Code = '$Code'";
    mysqli_query($dbConn, $crsRegister);
    //  Delete course 
    $DelCourse = "DELETE FROM course WHERE  `CrsCode` = '$Code' ";
    mysqli_query($dbConn, $DelCourse);
    header("location: /finalproject1/#Crs");
}
// CrEAT Registeration
if (isset($_POST['register'])) {
    $stID = $_POST['st_id'];
    $crsCODE = $_POST['crs_code'];
    $semester = $_POST['semester'];
    $YEAR = $_POST['year'];
    $RegCreate = "INSERT INTO registered VALUES ($stID , '$crsCODE' , '$semester' ,' $YEAR')";
    mysqli_query($dbConn, $RegCreate);
    header("location: /finalproject1/#Reg");
}
// READ Registeratio
$ReadReg = "SELECT students.Name , course.CrsCode , course.CrsName , semester , R_year , students.ID
FROM registered INNER JOIN students 
ON registered.St_ID = students.ID 
INNER JOIN course 
ON Crs_Code = course.CrsCode";
$RegData = mysqli_query($dbConn, $ReadReg);
// UPDATE Registeration
$stID = "";
$crsCODE = "";
$semester = "";
$YEAR = "";
$regUpdate = false;
if (isset($_GET['EditCrs']) && isset($_GET['EditID'])) {
    $regUpdate = true;
    $PrimKey1 = $_GET['EditCrs'];
    $PrimKey2 = $_GET['EditID'];
    $register = "SELECT * FROM registered WHERE `St_ID` = $PrimKey2 AND `Crs_Code` = '$PrimKey1'";
    $regData = mysqli_query($dbConn, $register);
    $regRow = mysqli_fetch_assoc($regData);
    $stID = $regRow['St_ID'];
    $crsCODE = $regRow['Crs_Code'];
    $semester = $regRow['semester'];
    $YEAR = $regRow['R_year'];
    if (isset($_POST['update'])) {
        $stID = $_POST['st_id'];
        $crsCODE = $_POST['crs_code'];
        $semester = $_POST['semester'];
        $YEAR = $_POST['year'];
        $update = "UPDATE registered SET St_ID = $stID , Crs_Code = '$crsCODE' , semester = '$semester' , R_year ='$YEAR'
        WHERE `St_ID` = $PrimKey2 AND `Crs_Code` = '$PrimKey1' ";
        mysqli_query($dbConn, $update);
        header("location: /finalproject1/#Reg");
    }
}
// DELETE registeration
if (isset($_GET['DelCrs']) && isset($_GET['DelID'])) {
    $PrimKey1 = $_GET['DelCrs'];
    $PrimKey2 = $_GET['DelID'];
    $delete = "DELETE FROM registered  WHERE `St_ID` = $PrimKey2 AND `Crs_Code` = '$PrimKey1' ";
    mysqli_query($dbConn, $delete);
    header("location: /finalproject1/#Reg");
}
?>

<!-- ============================================= -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="/finalproject1/css/main.css">
    <title>Document</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top mb-5">
        <a class="navbar-brand" href="#">University System</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link " href="#St">Students</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#Crs">Course</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#Reg">Register Courses</a>
                </li>
            </ul>
        </div>
    </nav>
    <!--  ================ END NAV ================ -->
    <div class="container mb-5 mt-5" id="St">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <h3 class="text-center">Add New Student</h3>
                <div class="card">
                    <div class="card-body">
                        <form method="POST">
                            <div class="form-group">
                                <label>Student Name</label>
                                <input placeholder="staudent name" value="<?php echo $stName ?>" name="st_name" class="form-control" type="text">
                            </div>
                            <div class="form-group">
                                <label>Student Age</label>
                                <input placeholder="staudent age" value="<?php echo $stAge ?>" name="st_age" class="form-control" type="number">
                            </div>
                            <div class="form-group">
                                <label>Student City</label>
                                <input placeholder="staudent city" value="<?php echo $stCity ?>" name="st_city" class="form-control" type="text">
                            </div>
                            <div class="form-group">
                                <label>Student Major</label>
                                <input placeholder="staudent major" value="<?php echo $stMajor ?>" name="st_major" class="form-control" type="text">
                            </div>
                            <?php if ($stUpdate) : ?>
                                <button class="btn btn-primary" name="st_update">Update</button>
                            <?php else : ?>
                                <button class="btn btn-primary" name="st_send">Submit</button>
                            <?php endif ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th>Student ID</th>
                                <th>Student Name</th>
                                <th>Student Age</th>
                                <th>Student City</th>
                                <th>Student Major</th>
                                <th colspan="2">Action</th>
                            </tr>
                            <?php foreach ($stData as $data) { ?>
                                <tr>
                                    <th> <?php echo $data['ID']; ?> </th>
                                    <th> <?php echo $data['Name']; ?> </th>
                                    <th> <?php echo $data['Age']; ?> </th>
                                    <th> <?php echo $data['City']; ?> </th>
                                    <th> <?php echo $data['Major']; ?> </th>
                                    <th> <a class="btn btn-success" href="/finalproject1?stEdit=<?php echo $data['ID'] ?>&#St">Edit</a></th>
                                    <th> <a class="btn btn-danger" href="/finalproject1?stDel=<?php echo $data['ID'] ?>&#St">Delete</a></th>
                                </tr>
                            <?php } ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ========== END STUDENT =============== -->
    <div class="container mb-5 mt-5" id="Crs">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <h3 class="text-center">Add New Course</h3>
                <div class="card">
                    <div class="card-body">
                        <form method="POST">
                            <div class="form-group">
                                <label>Course Name</label>
                                <input placeholder="course name" value="<?php echo  $CrsName ?>" name="crs_name" class="form-control" type="text">
                            </div>
                            <div class="form-group">
                                <label>Course Code</label>
                                <input placeholder="course code" value="<?php echo  $CrsCode ?>" name="crs_code" class="form-control" type="text">
                            </div>
                            <?php if ($CrsUpdate) : ?>
                                <button class="btn btn-info" name="Crs_update">Update Course</button>
                            <?php else : ?>
                                <button class="btn btn-info" name="Crs_send">Add Course</button>
                            <?php endif ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th>Course Code</th>
                                <th>Course Name</th>
                                <th colspan="2">Action</th>
                            </tr>
                            <?php foreach ($CrsRetData as $data) { ?>
                                <tr>
                                    <th> <?php echo $data['CrsCode'] ?></th>
                                    <th> <?php echo $data['CrsName'] ?></th>
                                    <th> <a class="btn btn-success" href="/finalproject1?crsEdit=<?php echo $data['CrsCode'] ?>&#Crs"> Edit</a></th>
                                    <th> <a class="btn btn-danger" href="/finalproject1?crsDel=<?php echo $data['CrsCode'] ?>&#Crs">Delete</a></th>
                                </tr>
                            <?php } ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ============== END COURSE =============== -->
    <div class="container mb-5 mt-5" id="Reg">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <h3 class="text-center">Register New Course</h3>
                <div class="card">
                    <div class="card-body">
                        <form method="POST">
                            <div class="form-group">
                                <label>Student ID</label>
                                <input placeholder="staudent ID" value="<?php echo $stID ?>" name="st_id" class="form-control" type="text">
                            </div>
                            <div class="form-group">
                                <label>Course Code</label>
                                <input placeholder="course code" value="<?php echo $crsCODE ?>" name="crs_code" class="form-control" type="text">
                            </div>
                            <div class="form-group">
                                <label>Semester</label>
                                <input placeholder="semester" value="<?php echo $semester ?>" name="semester" class="form-control" type="text">
                            </div>
                            <div class="form-group">
                                <label>Year</label>
                                <input placeholder="year" value="<?php echo $YEAR ?>" name="year" class="form-control" type="text">
                            </div>
                            <?php if ($regUpdate) : ?>
                                <button class="btn btn-info" name="update">Update</button>
                            <?php else : ?>
                                <button class="btn btn-info" name="register">Register</button>
                            <?php endif ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th>Student Name</th>
                                <th>Course Code</th>
                                <th>Course ID</th>
                                <th>Semester</th>
                                <th>Year</th>
                                <th colspan="2">Action</th>
                            </tr>
                            <?php foreach ($RegData as $data) { ?>
                                <tr>
                                    <th> <?php echo $data['Name'] ?></th>
                                    <th> <?php echo $data['CrsCode'] ?></th>
                                    <th> <?php echo $data['CrsName'] ?></th>
                                    <th> <?php echo $data['semester'] ?></th>
                                    <th> <?php echo $data['R_year'] ?></th>
                                    <th> <a class="btn btn-success" href="/finalproject1?EditCrs=<?php echo $data['CrsCode'] ?>&EditID=<?php echo $data['ID'] ?>&/#Reg">Edit</a></th>
                                    <th> <a class="btn btn-danger" href="/finalproject1?DelCrs=<?php echo $data['CrsCode'] ?>&DelID=<?php echo $data['ID'] ?>&/#Reg">Delete</a></th>
                                </tr>
                            <?php } ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- =============END REGISTERATION ============= -->
</body>

</html>
<script src="js/jquery-3.6.0.min.js"></script>
<script src="js/popper.min.js"> </script>
 <script src="js/bootstrap.min.js"></script>
