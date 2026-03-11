<?php
session_start();

if(isset($_POST["submit"]))
{

    $error="";
    $flag=0;
    $Id = $_SESSION['id'];
    $c1 = $_POST['c1'];
    $c2 = $_POST['c2'];
    $c3 = $_POST['c3'];
    $c4 = $_POST['c4'];



   if($c1==$c2){
        $error = "choice 1 and choice 2 cannot be same <br/>";
        $flag=1;
    }
    if($c1==$c3){
        $error = "choice 1 and choice 3 cannot be same <br/>";
        $flag=1;
    }
    if($c1==$c4){
        $error =  "choice 1 and choice 4 cannot be same <br/>";
        $flag=1;
    }
    if($c2==$c3){
        $error = "choice 2 and choice 3 cannot be same <br/>";
        $flag=1;
    }
    if($c2==$c4){
        $error =  "choice 2 and choice 4 cannot be same <br/>";
        $flag=1;
    }
    if($c3==$c4){
        $error = "choice 3 and choice 4 cannot be same <br/>";
        $flag=1;
    }

    $conn = mysqli_connect("127.0.0.1", "root", "", "studentAllocation");
    $sql="SELECT * FROM studentChoice WHERE Id='".$Id."';";
    $result = mysqli_query($conn,$sql);
    $count=mysqli_num_rows($result);

    $sql="SELECT * FROM Topic";
    $result = mysqli_query($conn,$sql);

    while($row = mysqli_fetch_assoc($result)){
      if($c1 == $row['Name']){
        $c1=$row['TId'];
      }
      if($c2 == $row['Name']){
        $c2=$row['TId'];
      }
      if($c3 == $row['Name']){
        $c3=$row['TId'];
      }
      if($c4 == $row['Name']){
        $c4=$row['TId'];
      }


    }


   if($flag==0){

    if($count>0){
        
        $Confirmation =  "<script> window.confirm('Do you want to update your choice?'); </script>";

        echo $Confirmation;

        if ($Confirmation == true) {
           $sql = "UPDATE `studentChoice` SET choice1='".$c1."', choice2='".$c2."', choice3='".$c3."',choice4='".$c4."' WHERE Id='".$Id."';";
           mysqli_query($conn,$sql);
           echo "<script type='text/javascript'>alert('Choice Updated Successfully');</script>";
        }
    }

    else{
        $sql="INSERT INTO `studentChoice` (`Id`, `choice1`, `choice2`, `choice3`, `choice4`) values('".$Id."','".$c1."','".$c2."','".$c3."','".$c4."');";
        mysqli_query($conn,$sql);

        echo "<script type='text/javascript'>alert('Choice Submitted Successfully');</script>";
    }
                
    }
   
     
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title></title>
    <script type="text/javascript" >
      function preventBack(){window.history.forward();}
      setTimeout("preventBack()", 0);
      window.onunload=function(){null};
    </script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito+Sans:200,300,400,700,900|Roboto+Mono:300,400,500"> 
    <link rel="stylesheet" href="fonts/icomoon/style.css">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/animate.css">
    
    
    <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">
    <link rel="stylesheet" href="css/fl-bigmug-line.css">
  
    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/style.css">
    
  </head>
  <body>
  
  <div class="site-wrap">

    <div class="site-mobile-menu">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div> <!-- .site-mobile-menu -->

      <div class="site-navbar bg-dark">
        <div class="container py-1">
          <div class="row align-items-center">

            <div class="col-4 col-md-4 col-lg-8">
              
            </div>
      
            <div class="col-8 col-md-8 col-lg-4 text-right">
            <a href="student.html" class="btn btn-outline-light my-2 my-sm-2" role="button"style="margin:5px;">Home</a>
            <a href="index.php" class="btn btn-outline-light my-2 my-sm-2" role="button" style="margin:5px;">Logout</a>
            </div>


          </div>
        </div>
      </div>
    </div>
  
    <div class="unit-5 overlay" style="background-image: url('images/hero_bg_1.jpg');">
      <div class="container text-center">
        <h2 class="mb-0">Add Student Prefrence</h2>
        <p class="mb-0 unit-6"><span>student prefrence</span></p>
      </div>
    </div>


    <div class="site-section bg-light" style="padding: 10px">
      <div class="container">
        <div class="row">

          <div class="col-md-12 col-lg-6 mb-5" style="margin : 0% 25%">
          
            <form class="p-5 bg-white" method="POST">

            <h6 style="color: red;"><?php echo $error; ?> </h6>

                <div class="row form-group">

                <?php
              session_start();
              $Id = $_SESSION['id'];
              $conn = mysqli_connect("127.0.0.1", "root", "", "studentAllocation");
              $sql="SELECT * FROM Topic;";
              $result = mysqli_query($conn,$sql);
              $count=mysqli_num_rows($result);
              $sr=1;

              echo "<br><br><br><br>";

              if($count>0)
              {
                  echo "
                  <table class='table'>
                    <thead  class='table-active'>
                      <tr>
                        <th scope='col'>Topic</th>
                        <th scope='col'>Choice1</th>
                        <th scope='col'>Choice2</th>
                        <th scope='col'>Choice3</th>
                        <th scope='col'>Choice4</th>
                      </tr>
                    </thead>
                    <tbody>
                  ";
                    while($count > 0) 
                        {
                            while($row = mysqli_fetch_assoc($result))
                            {
                            
                              $topic=$row['Name'];
                              
                              echo "<tr>
                                      <th scope='row'>$topic</th>
                                      <td><input type='radio' name='c1' id='c1' value='$topic'></td>
                                      <td><input type='radio' name='c2' id='c2' value='$topic'></td>
                                      <td><input type='radio' name='c3' id='c3' value='$topic'></td>
                                      <td><input type='radio' name='c4' id='c4' value='$topic'></td>
                                   </tr>";
                            }
                            $count=$count-1;  
                        }
                        echo "</tbody>
                        </table>";
              }
              else{
                  echo "<center><strong style='font-size:150%; color:brown'>No Data Found</strong></center>";
              }
            ?>

             

            <center>
              <div class="row form-group">
                <div class="col-md-12">
                  <input type="submit" name="submit" value="Submit" class="btn btn-primary  py-2 px-4 rounded-0">
                  <input type="reset"  name="reset" value="Reset" class="btn btn-primary  py-2 px-4 rounded-0">
                </div>
              </div>
            </center>

            </form>
          </div>

          
        </div>
      </div>
    </div>

   


  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/jquery.countdown.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/bootstrap-datepicker.min.js"></script>
  <script src="js/aos.js"></script>

  <script src="js/main.js"></script>
    
  </body>
</html>
