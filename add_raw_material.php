<?php
include './backend/auth.php';
ini_set('display_errors', 1);
error_reporting(E_ALL);
// include './insert_raw.php';
include './update_raw.php';
include './delete_raw.php';

// exit;
$successMessage = '';
$errorMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $entry_date = $_POST['entry_date'];
  $name_supplier = $_POST['name_supplier'];
  $name_material = $_POST['name_material'];
  $raw_type = $_POST['raw_type'];
  $van_wise = $_POST['van_wise'];
  $without_van = $_POST['without_van'];
  $weight_material = $_POST['weight_material'];
  $bill_no  = $_POST['bill_no'];
  $total_amount = $_POST['total_amount'];


  // print_r($_POST);
  // exit;

  if (!empty($entry_date) && !empty($name_supplier)) {
    $sql = "INSERT INTO raw_material(entry_date,name_supplier,raw_material_type,name_material,van_wise,without_van,weight_material,bill_no,total_amount) 
    VALUES ('$entry_date','$name_supplier','$raw_type','$name_material', '$van_wise','$without_van','$weight_material','$bill_no','$total_amount')";
    if ($conn->query($sql) === TRUE) {
      // Set a session variable to indicate success
      $_SESSION['submitted'] = true;

      // Store success message
      $successMessage = "Form submitted successfully!";
    } else {
      $errorMessage = "Error: " . $conn->error;
    }
  } else {
    $errorMessage = "Please fill in all fields.";
  }
}
if (isset($_SESSION['submitted']) && $_SESSION['submitted'] == true) {
  // Unset the session variable to prevent resubmission on page refresh
  unset($_SESSION['submitted']);
}


?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <link rel="stylesheet" href="./src/css/adminlte.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <style>
    .content-wrapper {
      /* background-color: #fff; */
    }

    .content-wrapper {
      background-color: #fff;
    }

    form {
      display: block;
      padding-top: 10px;
      margin-top: 30px;
      margin-bottom: 30px;
      border-radius: 10px;
      background-color: rgb(235 235 235);
    }

    .form-row {
      padding: 20px;
      margin: 20px;
    }

    .form-button {
      margin: 30px;
    }

    #myTable_wrapper {
      padding: 10px 15px;
    }

    .dt-buttons {
      margin: 15px 0px;
    }

    .form-inline {
      background: #fff;
    }
  </style>
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <?php include './header.php'; ?>
    <div class="content-wrapper">
      <section class="content">

        <!-- Show success or error messages -->
        <?php
        if (!empty($successMessage)) {
          echo "<h4 style='color: green;'>$successMessage</h4>";
        }

        if (!empty($errorMessage)) {
          echo "<h4 style='color: red;'>$errorMessage</h4>";
        }
        ?>

        <div class="container-fluid">
          <form action="" method="POST">
            <div class="form-row">
              <div class="form-group col-md-2">
                <label for="date">Date</label>
                <input type="date" class="form-control" id="entry_date" name="entry_date" placeholder="Date">
              </div>
              <div class="form-group col-md-3">
                <label for="supplier_name">Name Of The Supplier</label>
                <input type="text" class="form-control" id="supplier_name" name="name_supplier" placeholder="Name">
              </div>
              <div class="form-group col-md-3">
                <label for="supplier_name">Type Of Raw Material</label>
                <!-- <input type="text" class="form-control" id="supplier_name" name="name_supplier" placeholder="Name"> -->
                <select name="raw_type" id="" class="form-control" >
                  <option value="Building Structure">Building Structure</option>
                  <option value="Duct">Duct</option>
                  <option value="Pipes">Pipes</option>
                  <option value="Filtters">Filtters</option>
                  <option value="Hopper">Hopper</option>
                  <option value="Others">Others</option>
                </select>
              </div>
              <div class="form-group col-md-2">
                <label for="material_name">Name Of The Material</label>
                <input type="text" class="form-control" id="material_name" name="name_material" placeholder="Material">
              </div>
              <div class="form-group col-md-2">
                <label for="van_material">Van wise Material</label>
                <input type="text" class="form-control" id="van_material" name="van_wise" placeholder="Material">
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-3">
                <label for="without_van_material">Without Van Material</label>
                <input type="text" class="form-control" id="without_van_material" name="without_van" placeholder="Material">
              </div>
              <div class="form-group col-md-3">
                <label for="weight">Weight Of Material</label>
                <input type="text" class="form-control" id="weight" name="weight_material" placeholder="Weight">
              </div>
              <div class="form-group col-md-3">
                <label for="bill">Bill No</label>
                <input type="text" class="form-control" id="bill" name="bill_no" placeholder="Bill">
              </div>
              <div class="form-group col-md-3">
                <label for="total">Total Amount Of Material</label>
                <input type="text" class="form-control" id="total" name="total_amount" placeholder="Amount">
              </div>
            </div>
            <button type="submit" class="btn form-button btn-primary" id="raw_material" name="form_submit">Submit</button>
          </form>
        </div>
      </section>
      
      <table class="table table-bordered" id="myTable">
        <thead>
          <tr>
            <th>SL.No</th>
            <th>Date</th>
            <th>Name of The Supplier</th>
            <th>Name Of The Material</th>
            <th>Van Wise Material</th>
            <th>Without Van Material</th>
            <th>Weight Of Material</th>
            <th>Bill No</th>
            <th>Total Amount Of Material</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $sql = "SELECT * FROM `raw_material` WHERE 1";
          $result = $conn->query($sql);
        
          while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
              <td><?php echo $row['id']; ?></td>
              <td><?php echo $row['entry_date']; ?></td>
              <td><?php echo $row['name_supplier']; ?></td>
              <td><?php echo $row['name_material']; ?></td>
              <td><?php echo $row['van_wise']; ?></td>
              <td><?php echo $row['without_van']; ?></td>
              <td><?php echo $row['weight_material']; ?></td>
              <td><?php echo $row['bill_no']; ?></td>
              <td><?php echo $row['total_amount']; ?></td>
              <td>
                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editModal<?php echo $row['id']; ?>">
                  <i class="fa-solid fa-pen-to-square"></i>
                </button>
                <form action="" method="POST" style="display:inline;">
                  <input type="hidden" name="Id" value="<?php echo $row['id']; ?>">
                  <button type="submit" name="delete" class="btn btn-danger btn-sm">
                    <i class="fa-solid fa-trash"></i>
                  </button>
                </form>
              </td>
            </tr>

            <!-- Edit Modal -->
            <div class="modal fade" id="editModal<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel<?php echo $row['id']; ?>" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Edit Supplier</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                      <input type="hidden" name="Id" value="<?php echo $row['id']; ?>">

                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Date</label>
                            <input type="text" class="form-control" name="Date" value="<?php echo $row['Date']; ?>" required>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Name Of The Supplier</label>
                            <input type="text" class="form-control" name="name_supplier" value="<?php echo $row['name_supplier']; ?>" required>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Name Of The Material</label>
                            <input type="text" class="form-control" name="name_material" value="<?php echo $row['name_material']; ?>" required>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Van wise Material</label>
                            <input type="text" class="form-control" name="van_wise" value="<?php echo $row['van_wise']; ?>" required>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Without Van Material</label>
                            <input type="text" class="form-control" name="without_van" value="<?php echo $row['without_van']; ?>" required>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Weight Of Material</label>
                            <input type="text" class="form-control" name="weight_material" value="<?php echo $row['weight_material']; ?>" required>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Bill No</label>
                            <input type="text" class="form-control" name="bill_no" value="<?php echo $row['bill_no']; ?>" required>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Total Amount Of Material</label>
                            <input type="text" class="form-control" name="total_amount" value="<?php echo $row['total_amount']; ?>" required>
                          </div>
                        </div>
                      </div>

                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="submit" class="btn btn-primary">Update</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          <?php } ?>
        </tbody>
      </table>


      <?php include './footer.php'; ?>
    </div>

    <!-- JS Dependencies -->
    <script src="./src/js/jquery.min.js"></script>
    <script src="./src/js/bootstrap.bundle.min.js"></script>
    <script src="./src/js/adminlte.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>

    <script>
      $(document).ready(function() {
        // Initialize DataTable with export buttons
        const table = $('#myTable').DataTable({
          dom: 'Bfrtip',
          buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
        });

        // Edit button click handler
        $('#myTable').on('click', '.editBtn', function() {
          const row = $(this).closest('tr');
          const rowData = table.row(row).data();

          // Simulating new data input
          const newName = prompt("Enter new name:", rowData[1]);
          const newEmail = prompt("Enter new email:", rowData[2]);
          const newPhone = prompt("Enter new phone:", rowData[3]);
          const newAddress = prompt("Enter new address:", rowData[4]);
          const newCity = prompt("Enter new city:", rowData[5]);
          const newCountry = prompt("Enter new country:", rowData[6]);
          const newZip = prompt("Enter new ZIP:", rowData[7]);

          if (newName && newEmail && newPhone && newAddress && newCity && newCountry && newZip) {
            table.row(row).data([rowData[0], newName, newEmail, newPhone, newAddress, newCity, newCountry, newZip, rowData[8]]).draw();
          }
        });

        // Delete button click handler
        $('#myTable').on('click', '.deleteBtn', function() {
          const row = $(this).closest('tr');
          table.row(row).remove().draw();
        });
      });
    </script>

    <script>
      $(function() {
        $('#raw_material').submit()
      })
    </script>

</body>

</html>