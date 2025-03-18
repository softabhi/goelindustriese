<?php
include './Backend/connect.php';

$query = "SELECT * FROM raw_material WHERE 1";

$result = mysqli_query($conn, $query);
//select query ended //

//company_add_details_Update_pop_up_form_started//

if (isset($_POST["Update"])) {
  $Date = $_POST['Date'];
  $name_supplier = $_POST['name_supplier'];
  $name_material = $_POST['name_material'];
  $van_wise= $_POST['van_wise'];
  $without_van = $_POST['without_van'];
  $weight_material = $_POST['weight_material'];
  $bill_no  = $_POST['bill_no'];
  $total_amount= $_POST['total_amount'];
 $sql = "UPDATE raw_material(Date,name_supplier,name_material,van_wise,without_van,weight_material,bill_no,total_amount) 
            VALUES ('$Date','$name_supplier','$name_material', '$van_wise','$without_van','$weight_material','$bill_no','$total_amount')";

    $conn->query($sql);

  }

?>