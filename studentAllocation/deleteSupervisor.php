

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.1/assets/img/favicons/favicon.ico">
    <style>
        #nav
        {
          background-color: lightgrey;
          width: 50%;
          border: 5px solid lightgrey;
          padding: 50px;
          margin: 20px;
        }
</style>
    <title></title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.1/examples/starter-template/">

    <!-- Bootstrap core CSS -->
    <link href="dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="starter-template.css" rel="stylesheet">

  </head>

  <body>
  <?php
    session_start();
    $_SESSION['Id']=htmlspecialchars($_GET["name"]);

    $conn = mysqli_connect("127.0.0.1", "root", "", "studentAllocation");
    $sql="SELECT * FROM supervisorChoice WHERE Id='".$_SESSION['Id']."';";                
    $result = mysqli_query($conn,$sql);
    $count= mysqli_num_rows($result);
  
    echo $count;
    if ($count > 0){
            $sql=" DELETE FROM supervisorChoice WHERE Id='".$_SESSION['Id']."';";                
            mysqli_query($conn,$sql);
            header("location:deleteConfirmation.php");
    }
  ?>
  </body>
</html>



 
