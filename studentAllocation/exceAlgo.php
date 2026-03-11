<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.1/assets/img/favicons/favicon.ico">

    <title>preference submission</title>

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
          <a class="nav-link" href="exceAlgo.php">AlgoExcecution<span class="sr-only">(current)</span></a>
          </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
          <a href="Admin.html" class="btn btn-outline-light my-2 my-sm-2" role="button"style="margin:5px;">Home</a>
          <a href="index.php" class="btn btn-outline-light my-2 my-sm-2" role="button" style="margin:5px;">Logout</a>
        </form>
      </div>  
    </nav>

    <main role="main" class="container">

      <div class="starter-template">
        
<?php

$staffId = array();
$staffchoice1 = array();
$staffchoice2 = array();
$staffchoice3 = array();
$staffchoice4 = array();


$studentId = array();
$stuchoice1 = array();
$stuchoice2 = array();
$stuchoice3 = array();
$stuchoice4 = array();

$topicId = array();
$studentCapacity = array();
$staffCapacity = array();

$studentScore = array();
$staffScore = array();

$studentAllocation = array();
$staffAllocation = array();


$conn = mysqli_connect("127.0.0.1", "root", "", "studentAllocation");

$sql= "DELETE FROM `Allocation` WHERE 1";       //deleting previous allocation
mysqli_query($conn,$sql);

/* --------------------Database Store---------------------------------------- */

$sql="SELECT * FROM studentChoice;";
$result = mysqli_query($conn,$sql);

$totalStudent = mysqli_num_rows($result);

//fetching student prefrences
while($row = mysqli_fetch_assoc($result))
{
    $studentId[] = $row['Id'];
    $stuchoice1[] = $row['choice1'];
    $stuchoice2[] = $row['choice2'];
    $stuchoice3[] = $row['choice3'];
    $stuchoice4[] = $row['choice4'];
}

//fetching supervisor prefrences
$sql="SELECT * FROM supervisorChoice;";
$result = mysqli_query($conn,$sql);

while($row = mysqli_fetch_assoc($result))
{
    $staffId[] = $row['Id'];
    $staffchoice1[] = $row['choice1'];
    $staffchoice2[] = $row['choice2'];
    $staffchoice3[] = $row['choice3'];
    $staffchoice4[] = $row['choice4'];
}




/* --------------------Define capacity / My Algorithm---------------------------------------- */



if($totalStudent%4==0){
    $capacity=4;
}
else if($totalStudent%5==0){
    $capacity=5;
}
else if($totalStudent%6==0){
    $capacity=6;
}
else if($totalStudent%7==0){
    $capacity=7;
}
else if($totalStudent%8==0){
    $capacity=8;
}
else if($totalStudent%9==0){
    $capacity=9;
}
else{
    $capacity=$totalStudent;
}

$groupNo = floor($totalStudent/$capacity); //totalGroup


/* --------------------fetching Data for topic---------------------------------------- */

$sql="SELECT * FROM Topic;";
$result = mysqli_query($conn,$sql);

$sr=0;
while($row = mysqli_fetch_assoc($result))
{
    $topicId[] = $row['TId'];
    $studentCapacity[] = $capacity;
    $staffCapacity[] = 1;
}

array_splice($topicId, $groupNo);
array_splice($studentCapacity, $groupNo);

/* --------------------Assigning Default score and allocated topicId to student---------------------------------------- */

for ($i = 0; $i < $totalStudent; $i++) {
    $studentAllocation[$studentId[$i]] = "0";
    $studentScore[] = 5;
}

/*------------------- Assign topics to students according to their choice ---------------------------------*/

choiceAllocation($studentAllocation, $studentScore, $stuchoice1, $topicId, $studentId, $studentCapacity, 0);       //choice 1 -> score 0
choiceAllocation($studentAllocation, $studentScore, $stuchoice2, $topicId, $studentId, $studentCapacity, 1);       //choice 2 -> score 1
choiceAllocation($studentAllocation, $studentScore, $stuchoice3, $topicId, $studentId, $studentCapacity, 2);       //choice 3 -> score 2
choiceAllocation($studentAllocation, $studentScore, $stuchoice4, $topicId, $studentId, $studentCapacity, 3);       //choice 4 -> score 3


/*------------------- storing groupnumbers in array ---------------------------------*/

$group = array();

for ($i = 0; $i < $groupNo; $i++) {
    $group[$i]= $i+1;   //starts from 1
}

/* --------------------Assigning Default score and allocated topicId to supervisor---------------------------------------- */

for ($i = 0; $i < count($staffId); $i++) {
    $staffAllocation[$staffId[$i]] = "0";
    $staffScore[] = 5;
}


/*------------------- Assign topics to supervisor according to their choice ---------------------------------*/

choiceAllocation($staffAllocation, $staffScore, $staffchoice1, $topicId, $staffId, $staffCapacity, 0);      //choice 1 -> score 0
choiceAllocation($staffAllocation, $staffScore, $staffchoice2, $topicId, $staffId, $staffCapacity, 1);      //choice 2 -> score 1
choiceAllocation($staffAllocation, $staffScore, $staffchoice3, $topicId, $staffId, $staffCapacity, 2);      //choice 3 -> score 2
choiceAllocation($staffAllocation, $staffScore, $staffchoice4, $topicId, $staffId, $staffCapacity, 3);      //choice 4 -> score 3



/*-------------------List of All the Available topics---------------------------------*/

//topic available for student
$topicAvailable = array();
for($i=0; $i<count($topicId); $i++){
    while($studentCapacity[$i]>0){                   
        $topicAvailable[] = $topicId[$i];      
        $studentCapacity[$i]--;
    }        
}

//topic available for staff
$topicAvailableStaff = array();
for($i=0; $i<count($topicId); $i++){
    while($staffCapacity[$i]>0){                   
        $topicAvailableStaff[] = $topicId[$i];      
        $staffCapacity[$i]--;
    }        
}

/* -------------------  Random Allocation ------------------------------------- */

foreach ($studentAllocation as $key => $value) {
    if (count($topicAvailable) == 0) {
        break;
    }
    if ($value == "0") {
        $index = rand() % count($topicAvailable);
        $studentAllocation[$key] = $topicAvailable[$index];
        array_splice($topicAvailable, $index, 1); //remove random index that is allocated, from availble topic list 
    }
}

foreach ($staffAllocation as $key => $value) {
    if (count($topicAvailableStaff) == 0) {
        break;
    }
    if ($value == "0") {
        $index = rand() % count($topicAvailableStaff);
        $staffAllocation[$key] = $topicAvailableStaff[$index];
        array_splice($topicAvailableStaff, $index, 1); //remove random index that is allocated from availble topic list
    }
}

//assigning groups to students
$groupedStudents = array();

foreach ($studentAllocation as $key => $value) {
    $allocation = $value;
    
    if (!isset($groupedStudents[$allocation])) {
        $groupedStudents[$allocation] = array();
    }
    
    $groupedStudents[$allocation][] = $key;
}

//inserting final allocation details of studnets in the databse
$gno=0;
$supGroup = array();
foreach ($groupedStudents as $key => $value) {
    $gno++;

    $sql = "SELECT * FROM `Topic` WHERE TId='".$key."';";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);

    $name=$row['Name'];

    $supGroup[$key] = $gno;
    for($i=0; $i<count($value);$i++){

    $sql="INSERT INTO `Allocation`(`Id`, `Name`, `TId`, `GroupNo`,`Type`) VALUES ('".$value[$i]."','".$name."','".$key."','".$gno."','s1');";
    mysqli_query($conn,$sql);
    }


}

//assigning groups to inserting final allocation details of supervisor in the databse
foreach ($staffAllocation as $key => $value) {
    $sql = "SELECT * FROM `Topic` WHERE TId='".$value."';";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);
    $name=$row['Name'];

    $gno = $supGroup[$value];

    if($gno!=0){
        $sql="INSERT INTO `Allocation`(`Id`, `Name`, `TId`, `GroupNo`,`Type`) VALUES ('".$key."','".$name."','".$value."','".$gno."','s2');";
        mysqli_query($conn,$sql);
    }

   
    
}   

//final score
$studentS = array_sum($studentScore);
$staffS = array_sum($staffScore);

echo "<br/><br/><br/><br/><br/><br/><b>Student Score : </b>" . $studentS . "<br/><b>Staff Score : </b>" . $staffS . "<br/>";


function choiceAllocation(&$Allocation, &$S, $C, $topicId, $Id, &$capacity, $score){
    for ($i = 0; $i < count($Id); $i++) { // loop for all the user
        if ($Allocation[$Id[$i]] != "0") {
            continue;
        }
        
        for ($j = 0; $j < count($topicId); $j++) {  //loop for checking all the topic
            if ($C[$i] == $topicId[$j] && $capacity[$j] > 0) {  //if choice of student i is same as topic j and capacity of topic j is not exceeded.
                $Allocation[$Id[$i]] = $topicId[$j];
                $S[$i] = $score;
                $capacity[$j] = $capacity[$j] - 1;
                break;
            }
        }
    }
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
  
          
                          
                       
