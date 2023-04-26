<?php

$search_param = $_POST["search"];
$search_area = $_POST["area"];

if(isset($_POST["search"]) && isset($_POST["area"])){

//  connect to database
$host = "localhost";
$dbuser = "id20192972_doctors_data";
$dbpass = "Qwerty@12345";
$dbname = "id20192972_doctor_data";

$conn = new mysqli($host, $dbuser, $dbpass, $dbname);
//  if ($conn -> connect_errno) {
//         echo "Failed to connect to MySQL: " . $conn -> connect_error;
//         exit();
//     }
//     else{
//         echo "Connected";
//     }
$sql = "SELECT * FROM `Doctor` WHERE DoctorArea like '%".$search_area."%' and DoctorCategory like '%".$search_param."%'";

$result = $conn->query($sql);

if($result->num_rows > 0){
    $data = '<div class="searchresult">
<b class="easy-steps-to">Doctor Found In Your Area</b>';
$doctor_data = "";

    while($row = $result->fetch_assoc()){
        $doctorid = $row["ID"];
        $doctorname = $row["DoctorName"];
        $doctorinfo = $row["DoctorInformation"];
        $doctorimage = $row["DoctorImage"];
        
        $doctor_data = $doctor_data.'<div class="search-doctor">
        <div class="search-doctor1"></div>
        <div class="search-doctor-rectangle3"></div>
        <img id="search_btn"
          class="user-account-icon"
          alt=""
          src="'.$doctorimage.'"
        /><b class="search-doctor2">'.$doctorname.'</b
        ><b class="find-best-doctors-container"
          ><p class="discovering-a-doctor">'.$doctorinfo.'</p></b
        >
      </div>';
    }

    $doctor_data = $doctor_data.'</div>';

     
}else{
    $data = '<div class="searchresult">
    <b class="easy-steps-to">No Doctor Found In Your Area</div>';
}

// Sending response back to the request
// echo json_encode($data);

}else{
    $data = '<div class="searchresultt">
    <b class="easy-steps-to">Bad Query</div>';
}
$data = $data.$doctor_data;
echo $data;

?> 
