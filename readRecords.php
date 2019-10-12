<?php
$content = trim(file_get_contents("php://input"));

$decoded = json_decode($content, true);

if(isset($decoded["key1"]) && $decoded["key1"]=="")
{
    $servername = "";
    $username = "";
    $password = "";
    $dbname = "";
if(isset($decoded["operation"] ) && $decoded["operation"]=="read")
{
   
    $connect= new mysqli($servername,$username,$password,$dbname) or die("ERROR:could not connect to the database!!!");
     
    //select all data from json table
    $query1="select * from records";
    $result=$connect->query($query1);
     
    //fetech all data from json table in associative array format and store in $result variable
    $array=$result->fetch_all(MYSQLI_ASSOC);
     
    //Now encode PHP array in JSON string 
    $json=json_encode($array,true);
     
    $connect->close();
     echo $json;
}
else if(isset($decoded["operation"] ) && $decoded["operation"]=="delete")
{
   
    $connect= new mysqli($servername,$username,$password,$dbname) or die("ERROR:could not connect to the database!!!");
    $stmt = $connect->prepare("delete from  records");
    //select all data from json table
    $stmt->execute();
    $stmt->close();
$conn->close();

}
else
{
    echo 'came here logging this entry';
}

}
//connect with database demo

?>