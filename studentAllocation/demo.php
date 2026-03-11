<?php

$staffFile = fopen("staff.txt", "r") or die("Unable to open file!");
$studentFile = fopen("students.txt", "r") or die("Unable to open file!");
$topicFile = fopen("topics.txt", "r") or die("Unable to open file!");

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

$sql= "DELETE FROM `Allocation` WHERE 1";
mysqli_query($conn,$sql);

/* --------------------Database Store---------------------------------------- */

$sql="SELECT * FROM studentChoice;";
$result = mysqli_query($conn,$sql);

$s1 = mysqli_num_rows($result);

while($row = mysqli_fetch_assoc($result))
{
    $studentId[] = $row['Id'];
    $stuchoice1[] = $row['choice1'];
    $stuchoice2[] = $row['choice2'];
    $stuchoice3[] = $row['choice3'];
    $stuchoice4[] = $row['choice4'];
}

echo "<br/><b>Student</b><br/>";
print_r($studentId);
echo "<br/>";
print_r($stuchoice1);
echo "<br/>";
print_r($stuchoice2);
echo "<br/>";
print_r($stuchoice3);
echo "<br/>";
print_r($stuchoice4);


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

echo "<br/><b>Staff</b><br/>";
print_r($staffId);
echo "<br/>";
print_r($staffchoice1);
echo "<br/>";
print_r($staffchoice2);
echo "<br/>";
print_r($staffchoice3);
echo "<br/>";
print_r($staffchoice4);




/* --------------------Define capacity / My Algorithm---------------------------------------- */

//$s1 =15;

if($s1%4==0){
    $capacity=4;
}
else if($s1%5==0){
    $capacity=5;
}
else if($s1%6==0){
    $capacity=6;
}
else if($s1%7==0){
    $capacity=7;
}
else if($s1%8==0){
    $capacity=8;
}
else if($s1%9==0){
    $capacity=9;
}
else{
    $capacity=$s1;
}

$groupNo = floor($s1/$capacity);

echo "<br/><b>Student group numbers</b><br/>";
echo $groupNo;

/* --------------------Reading Data from project File---------------------------------------- */

$sql="SELECT * FROM Topic;";
$result = mysqli_query($conn,$sql);

$sr=0;
while($row = mysqli_fetch_assoc($result))
{
    $topicId[] = $row['TId'];
    $studentCapacity[] = $capacity;
    $staffCapacity[] = 1;
}

echo "<br/><b>Topic</b><br/>";
print_r($topicId);
print_r($studentCapacity);


echo "<br/>";       
array_splice($topicId, $groupNo);
print_r($topicId);
array_splice($studentCapacity, $groupNo);
print_r($studentCapacity);



/* --------------------Assigning Default score and allocated topicId to student---------------------------------------- */

for ($i = 0; $i < $s1; $i++) {
    $studentAllocation[$studentId[$i]] = "0";
    $studentScore[] = 5;
}

echo "<br/><br/><b>Student AllocationPrev</b><br/>";
print_r($studentAllocation);

/*------------------- Assign topics to students according to their choice ---------------------------------*/

choiceAllocation($studentAllocation, $studentScore, $stuchoice1, $topicId, $studentId, $studentCapacity, 0);
choiceAllocation($studentAllocation, $studentScore, $stuchoice2, $topicId, $studentId, $studentCapacity, 1);
choiceAllocation($studentAllocation, $studentScore, $stuchoice3, $topicId, $studentId, $studentCapacity, 2);
choiceAllocation($studentAllocation, $studentScore, $stuchoice4, $topicId, $studentId, $studentCapacity, 3);

echo "<br/><br/><b>Student AllocationAfter</b><br/>";
print_r($studentAllocation);

/*------------------- Assign topics to students according to their choice ---------------------------------*/

$group = array();

for ($i = 0; $i < $groupNo; $i++) {
    $group[$i]= $i+1;
}

echo "<br/><br/><br/><b>Group</b><br/><br/>";
print_r($group);

/* --------------------Assigning Default score and allocated topicId to student---------------------------------------- */

for ($i = 0; $i < count($staffId); $i++) {
    $staffAllocation[$staffId[$i]] = "0";
    $staffScore[] = 5;
}

echo "<br/><br/><b>Staff AllocationPrev</b><br/>";
print_r($staffAllocation);

/*------------------- Assign topics to students according to their choice ---------------------------------*/

choiceAllocation($staffAllocation, $staffScore, $staffchoice1, $topicId, $staffId, $staffCapacity, 0);
choiceAllocation($staffAllocation, $staffScore, $staffchoice2, $topicId, $staffId, $staffCapacity, 1);
choiceAllocation($staffAllocation, $staffScore, $staffchoice3, $topicId, $staffId, $staffCapacity, 2);
choiceAllocation($staffAllocation, $staffScore, $staffchoice4, $topicId, $staffId, $staffCapacity, 3);

echo "<br/><br/><b>Staff AllocationAfter</b><br/>";
print_r($staffAllocation);

/*-------------------List of All the projects Available---------------------------------*/

$topicAvailable = array();
for($i=0; $i<count($topicId); $i++){
    while($studentCapacity[$i]>0){                   
        $topicAvailable[] = $topicId[$i];      
        $studentCapacity[$i]--;
    }        
}


$topicAvailableStaff = array();
for($i=0; $i<count($topicId); $i++){
    while($staffCapacity[$i]>0){                   
        $topicAvailableStaff[] = $topicId[$i];      
        $staffCapacity[$i]--;
    }        
}

echo "<br/><br/><b>Student Capacity</b><br/>";
print_r($studentCapacity);

echo "<br/><br/><b>Available topics Student</b><br/>";
print_r($topicAvailable);

echo "<br/><br/><b>Available topics Staff</b><br/>";
print_r($topicAvailableStaff);


/* -------------------  Random Allocation ------------------------------------- */

foreach ($studentAllocation as $key => $value) {
    if (count($topicAvailable) == 0) {
        break;
    }
    if ($value == "0") {
        $index = rand() % count($topicAvailable);
        $studentAllocation[$key] = $topicAvailable[$index];
        array_splice($topicAvailable, $index, 1);
    }
}

foreach ($staffAllocation as $key => $value) {
    if (count($topicAvailableStaff) == 0) {
        break;
    }
    if ($value == "0") {
        $index = rand() % count($topicAvailableStaff);
        $staffAllocation[$key] = $topicAvailableStaff[$index];
        array_splice($topicAvailableStaff, $index, 1);
    }
}

//sort($studentAllocation);

    echo "<br/><br/><br/>";
    echo "<b>Final Allocation</b>";

$groupedStudents = array();

foreach ($studentAllocation as $key => $value) {
    $allocation = $value;
    
    if (!isset($groupedStudents[$allocation])) {
        $groupedStudents[$allocation] = array();
    }
    
    $groupedStudents[$allocation][] = $key;
}

echo "<br/><br/><b> Group </b><br/><br/>"; 
print_r($groupedStudents);

$gno=0;
foreach ($groupedStudents as $key => $value) {
    echo "<br/><br/><b> Group $key </b><br/><br/>";
    print_r($value);
    $gno++;

    $sql = "SELECT * FROM `Topic` WHERE TId='".$key."';";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);

    $name=$row['Name'];

    for($i=0; $i<count($value);$i++){
        echo $i. " ".$value[$i];

        $sql="INSERT INTO `Allocation`(`Id`, `Name`, `TId`, `GroupNo`, `Type`) VALUES ('".$value[$i]."','".$name."','".$key."','".$gno."','s1');";
        mysqli_query($conn,$sql);
    }
}

foreach ($staffAllocation as $key => $value) {
    echo "<br/><br/><b> Group $value </b><br/><br/>";
    print_r($key);
    
}

echo "<br/><br/><br/>";

$countedValues = array_count_values($studentAllocation); 
 
foreach ($countedValues as $key => $value) { 
    //if ($value > 1) { 
        echo "<br/>$key - $value\n"; 
  //  } 
} 

$studentS = array_sum($studentScore);
$staffS = array_sum($staffScore);

echo "<br/><br/><b>Student Score : </b>" . $studentS . "<br/><b>Staff Score : </b>" . $staffS . "<br/>";

/*
$outputFile = fopen("output.txt", "w");
if ($outputFile) {
   
    foreach ($Allocation as $key => $value) {
        fwrite($outputFile, $key . " " . $value . "\n");
    }
   fwrite($outputFile, array_sum($S));
    fclose($outputFile);
}
*/

/* -------------------Closing Files----------------------------------------- */

fclose($staffFile);
fclose($projectFile);
fclose($studentFile);


function choiceAllocation(&$Allocation, &$S, $C, $topicId, $Id, &$capacity, $score){
    for ($i = 0; $i < count($Id); $i++) {
        if ($Allocation[$Id[$i]] != "0") {
            continue;
        }
        
        for ($j = 0; $j < count($topicId); $j++) {      //not needed loop
            if ($C[$i] == $topicId[$j] && $capacity[$j] > 0) {
                $Allocation[$Id[$i]] = $topicId[$j];
                $S[$i] = $score;
                $capacity[$j] = $capacity[$j] - 1;
                break;
            }
        }
    }
}
?>