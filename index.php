<?php 
//1. Db connevction
$conn = mysqli_connect("localhost", "root", "", "curd_oklabs_01_db") or die("could not be connected");
$msg = '';
    if(isset($_GET['submit_btn'])){
      //2. build the query
    //   Always filterd or santized the data 
    $fname = mysqli_real_escape_string($conn, $_GET['fname']);
    $lname = mysqli_real_escape_string($conn, $_GET['lname']);
    $email = mysqli_real_escape_string($conn, $_GET['email']);
    $monumber = mysqli_real_escape_string($conn, $_GET['monumber']);
    $password = mysqli_real_escape_string($conn, $_GET['password']);
    $salt = rand(1000,100000);
    $sql = "INSERT INTO students_tbl (`name`, `surname`, `email`, `password`, `salt`, `monumber`) VALUES('$fname','$lname','$email','$password','$salt','$monumber')";
    // 3.excute the query
       mysqli_query($conn,$sql) or die(mysqli_error($conn));
    //4. display the query
     $msg = "<div class='alert alert-success' role='alert'> Data inserted Successfully..</div>";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <?php echo $msg; ?>
     <form class="bg-white shadow-lg p-5 w-25 m-auto mt-5" action="<?php echo $_SERVER['PHP_SELF']?>" method="GET">
            <div class="mb-3">
                <label for="name" class="form-label">First Name</label>
                <input required name="fname" type="text" class="form-control" id="name" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="lname" class="form-label">First Name</label>
                <input required name="lname" type="text" class="form-control" id="lname" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input required name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="number" class="form-label">Mobile Number</label>
                <input required name="monumber" type="number" class="form-control" id="number" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input required name = "password" type="password" class="form-control" id="password">
            </div>
            <div class="mb-3">
                <label for="cpassword" class="form-label">Confirm Password</label>
                <input  required name = "cpassword" type="cpassword" class="form-control" id="cpassword">
            </div>
            <!-- <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div> -->
            <button type="submit" name="submit_btn" class="btn btn-primary">Submit</button>
            </form>
            <div class="container">
              
            <table class="table mt-5" >
                <thead class=>
                    <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Surname</th>
                    <th scope="col">Email</th>
                    <th scope="col">Mobile No</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                
                <tbody>
                <?php 
                 //2. buld the query
                   $sql = "SELECT * FROM students_tbl ";
                 //3. excute the query
                  $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                  $count = mysqli_num_rows($result);
                   // check for NOR
                   // if NOR > 0 Data avilable
                    if($count>0){
                        while($row= mysqli_fetch_assoc($result)){ ?>
                    <tr>
                    <td><?php echo $row['id']?></td>
                    <td><?php echo $row['name']?></td>
                    <td><?php echo $row['surname']?></td>
                    <td><?php echo $row['email']?></td>
                    <td><?php echo $row['monumber']?></td>
                    <td>
                        <button class="btn btn-sm mx-1  btn-success ">VIEW</button>
                        <button class="btn btn-sm mx-1  btn-info ">EDIT</button>
                        <button class="btn btn-sm mx-1  btn-danger ">DELETE</button>
                    </td>
                    </tr>
                    <?php } }?>
                </tbody>
            </table>
            </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>
<?php mysqli_close($conn); ?>