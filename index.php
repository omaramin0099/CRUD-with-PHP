<?php


$host = "localhost";
$user = "root";
$pass = "";
$DB = "shop";
$connect = mysqli_connect($host, $user, $pass, $DB);


$edit = FALSE;

// =====================CREATE===========================
if (isset($_POST['Send'])) {
    $name = $_POST['Name'];
    $address = $_POST['Address'];
    $phone = $_POST['Phone'];

    $insert = "INSERT INTO customers VALUES(null, '$name', '$address', '$phone')";
    mysqli_query($connect, $insert);
}

// =====================READ===========================

$select = "SELECT * FROM customers";
$selected = mysqli_query($connect, $select);


// =====================DELETE===========================


if (isset($_GET['delete'])) {
    $ID = $_GET['delete'];
    $delete = "DELETE FROM customers WHERE id = $ID ";
    mysqli_query($connect, $delete);
    header("location:/CRUD-with-PHP/index.php");
}

// =====================Update===========================


$Name = "";
$Address = "";
$Phone = "";

if (isset($_GET['edit'])) {
    $edit = TRUE;
    $ID = $_GET['edit'];
    $UpSelect = "SELECT * FROM customers WHERE id = $ID";
    $UpSelected = mysqli_query($connect, $UpSelect);
    $row = mysqli_fetch_assoc($UpSelected);
    $Name = $row['name'];
    $Address = $row['address'];
    $Phone = $row['phone'];
    if (isset($_POST['Update'])) {
        $Name = $_POST['Name'];
        $Address = $_POST['Address'];
        $Phone = $_POST['Phone'];

        $update = "UPDATE customers SET name = '$Name' , address = '$Address' , phone = '$Phone' where id = $ID";
        mysqli_query($connect, $update);

        $Name = "";
        $Address = "";
        $Phone = "";
        $edit = FALSE;

        header("location:/CRUD-with-PHP/index.php");
    }
}


?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="./assets/Table/Table.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>

<body>

    <h1 class="text-info text-center">CRUD with PHP</h1>
    <div class="container col-6 my-3">
        <div class="card">
            <div class="card-body">
                <form method="POST">
                    <div class="form-group">
                        <label>Customer Name</label>
                        <input name="Name" value="<?php echo $Name ?>" type="text" placeholder="Name" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Customer Phone</label>
                        <input name="Phone" value="<?php echo $Phone ?>" type="text" placeholder="Phone" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Customer Address</label>
                        <input name="Address" type="text" value="<?php echo $Address ?>" placeholder="Address" class="form-control">
                    </div>
                    <?php if ($edit) : ?>
                        <button name="Update" class="btn btn-block btn-info w-50 mx-auto my-2 ">Update</button>
                    <?php else : ?>
                        <button name="Send" class="btn btn-block btn-primary w-50 mx-auto my-2 ">Send Data</button>
                    <?php endif ?>
                </form>

            </div>
        </div>
    </div>


    <!-- <div class="container col-8 my-3">
        <div class="card">
            <div class="card-body">

                <table class="table table-dark">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Address</th>
                            <th scope="col">Phone</th>
                            <th class="text-center" scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php foreach ($selected as $data) { ?>
                            <tr>

                                <td><?php echo $data['id'];  ?></td>
                                <td><?php echo $data['name'];  ?></td>
                                <td><?php echo $data['address'];  ?></td>
                                <td><?php echo $data['phone'];  ?></td>
                                <td class="text-center"><a href="index.php?delete=<?php echo $data['id'] ?>" class="btn btn-danger ">Delete</a>
                                    <a href="index.php?edit=<?php echo $data['id'] ?>" class="btn btn-info ">Update</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div> -->


    <div class="">
        <div class="container">
            <div class="table-responsive custom-table-responsive">
                <table class="table custom-table">
                    <thead style="background-color: #111;">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Address</th>
                            <th scope="col">Phone</th>
                            <th class="text-center" scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($selected as $data) { ?>

                            <tr scope="row">
                                <td><?php echo $data['id'];  ?></td>
                                <td><?php echo $data['name'];  ?></td>
                                <td><?php echo $data['address'];  ?></td>
                                <td><?php echo $data['phone'];  ?></td>
                                <td class="text-center"><a href="index.php?delete=<?php echo $data['id'] ?>" class="btn btn-danger ">Delete</a>
                                    <a href="index.php?edit=<?php echo $data['id'] ?>" class="btn btn-info ">Update</a>
                                </td>
                            </tr>
                        <?php } ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>










    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
</body>

</html>