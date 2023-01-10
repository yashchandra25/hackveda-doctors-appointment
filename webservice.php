<?php 
$search_param = $_POST["search"];
$search_area = $_POST["area"];
//connect to data base
if(isset($_POST["search"]) && isset($_POST["area"])){
$host="localhost";
$dbuser="root";
$dbpass="";
$dbname="doctorsdb";
//make connection
$conn = new mysqli($host,$dbuser,$dbpass,$dbname);
$sql = "SELECT * FROM doctors WHERE area LIKE '%".$search_area."%' and info LIKE '%".$search_param."%' " ;
$result = $conn->query($sql);
if($result -> num_rows > 0){
    $data = '<div class="result">Doctor Found</div>' ;
    $doctor_data= "" ;
    while($row = $result->fetch_assoc()){
        $doctorid = $row["ID"];
        $doctorname =$row["name"];
        $doctorinfo =$row["info"];
        $doctorimage= $row["img"];
        $doctor_data = $doctor_data.
            '<div class="main">
                <div class="card">
                <img class="doc-img" src="'.$doctorimage.'" />
                </div>
                <div class="doc-name">'.$doctorname.'</div>
                <div class="doc-info">'. $doctorinfo.'</div>
            </div>' ;
        }
    }else{
        $data = '<div class="result"> No Doctor Found</div>';
        $doctor_data = "";
    }
}
else{
    $data = '<div class="query">Bad Query </div>';
    $doctor_data = "";
}
echo $data;
echo $doctor_data;
?>