<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.1/assets/img/favicons/favicon.ico">

    <title>Allocation</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.1/examples/starter-template/">

    <!-- Bootstrap core CSS -->
    <link href="dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="starter-template.css" rel="stylesheet">

  </head>

  <body>

    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="AllocationView.php">Allocation<span class="sr-only">(current)</span></a>
          </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">

         
              <a href="index.php" class='btn btn-outline-light my-2 my-sm-2' role='button' style='margin:5px;'>Logout</a>
    
          </form>
      </div> 
    </nav>

    <main role="main" class="container">

      <div class="starter-template">
        <?php
              session_start();

              $conn = mysqli_connect("127.0.0.1", "root", "", "studentAllocation");
              $sql="SELECT * FROM Login WHERE Id='".$_SESSION['id']."'";
              $result = mysqli_query($conn,$sql);
              while($row = mysqli_fetch_assoc($result))
                $out = $row['resultOut'];

                echo "<br><br><br><br>";

                
            if($out == 'Y')
            {
                $sql="SELECT * FROM Allocation WHERE Id='".$_SESSION['id']."';";
                $result = mysqli_query($conn,$sql);
                $row = mysqli_fetch_array($result);
               
                $gno = $row['GroupNo'];
                $topic = $row['Name'];

                $sql="SELECT * FROM Allocation WHERE GroupNo='".$gno."';";
                  $result = mysqli_query($conn,$sql);
                  $count=mysqli_num_rows($result);
                  $sr=1;

                if($count>0)
                {
                  echo "<br><center><strong style='font-size:150%; color:green'>Group No : ".$gno."</strong></center>";
                  echo "<br><center><strong style='font-size:150%; color:green'>Topic : ".$topic."</strong></center>";
                  echo "<br>";
                
                  $search_URL="https://scholar.google.com/scholar?q="; // Google Search Query URL  
                  $link=$search_URL.$topic;
                  echo "<h6 style='color: red;'><center><a href='".$link."' target='_blank'>Click here for the Materials</a></center> </h6>";


                  echo "
                  <table class='table'>
                    <thead  class='table-active'>
                      <tr>
                        <th scope='col'>Id</th>
                        <th scope='col'>Type</th>
                      </tr>
                    </thead>
                    <tbody>
                  ";
                    while($count > 0) 
                        {
                            while($row = mysqli_fetch_assoc($result))
                            {
                              $Id=$row['Id'];
                              $Type=$row['Type'];

                              if($Type=="s1"){
                                $Type = "Student";
                               }
                               if($Type=="s2"){
                                $Type = "Supervisor";
                               }
                              
                              echo "<tr>
                                      <th scope='row'>$Id</th>
                                      <td>$Type</td>
                                    </tr>";
                            }
                            $count=$count-1;  
                        }
                        echo "</tbody>
                        </table>";
                  }

                else{
                    echo "<center><strong style='font-size:150%; color:brown'>You're not allocated to any topics</strong></center>";
                  }
              }

            
            else{
            echo "<br><br><br><br><center><strong style='font-size:150%; color:brown'>Allocation is not published yet</strong></center>";
          }
              
            ?>
        
      </div>

    </main><!-- /.container -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="../../assets/js/vendor/popper.min.js"></script>
    <script src="dist/js/bootstrap.min.js"></script>
  </body>
</html>
  
          
                          
                       
