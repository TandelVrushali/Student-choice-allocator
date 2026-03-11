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
              <a href="Admin.html" class="btn btn-outline-light my-2 my-sm-2 rounded-0 " style="margin: 5px">Home</a>
            </div>


          </div>
        </div>
      </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mt-4">
                    <div class="card-header">
                        <h4> Search Filter by topic name</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-7">

                                <form action="" method="GET">
                                    <div class="input-group mb-3">
                                        <input type="text" name="search" required value="<?php if(isset($_GET['search'])){echo $_GET['search']; } ?>" class="form-control" placeholder="Search data">
                                        <button type="submit" class="btn btn-primary">Search</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card mt-4">
                    <div class="card-body">
                        
                                <?php 
                                    $conn = mysqli_connect("127.0.0.1", "root", "", "studentAllocation");
                                    
                                    if(isset($_GET['search']))
                                    {
                                        $filtervalues = $_GET['search'];
                                        $sql = "SELECT * FROM Topic WHERE CONCAT(Name) LIKE '%$filtervalues%' ";
                                        $result = mysqli_query($conn,$sql);
                                        $count=mysqli_num_rows($result);

                                        if($count>0){
                                            echo "
                                            <table class='table'>
                                                <thead  class='table-active'>
                                                    <tr>
                                                        <th scope='col'>Id</th>
                                                        <th scope='col'>Name</th>
                                                        <th scope='col'>Capacity</th>
                                                    </tr>
                                                </thead>
                                            <tbody>";
                                        
                                        while($count > 0){
                                            while($row = mysqli_fetch_assoc($result)){
                                                $Id=$row['TId'];
                                                $Name=$row['Name'];
                                                $Cap=$row['Capacity'];
                                                
                                                echo "<tr>
                                                        <th scope='row'>$Id</th>
                                                        <td>$Name</td>
                                                        <td>$Cap</td>
                                                    </tr>";
                                        }
                                        $count=$count-1;
                            }
                            
                             
                        }
                        echo "</tbody>
                        </table>";
              }
              else{
                  echo "<center><strong style='font-size:150%; color:brown'>No Data Found</strong></center>";
              }
                                        
            ?>
                           
                    </div>
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