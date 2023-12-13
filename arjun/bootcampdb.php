<?php
session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: login.php");
    exit;
}

?>
<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include 'partials/_dbconnect.php';
   
    $bootcamp_email = $_POST['bootcamp_email'];
    $bootcamp_contact = $_POST['bootcamp_contact'];
    $created_by = $_POST['created_by'];
    $modified_by = $_POST['modified_by'];

$sql = "INSERT INTO bootcamp (bootcamp_email, bootcamp_contact,  created_by, modified_by) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("siss", $bootcamp_email, $bootcamp_contact,  $created_by, $modified_by);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "New record created successfully";
    } else {
        echo "Error: could not insert new record";
    }
    $conn->close();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Bootcamp</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    
</head>
<body>  
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="bootcampdb.php" id="editForm" method="post">
                        <!-- Your form fields go here -->
                        <input type="hidden" name="snoEdit" id="snoEdit">
                        <div class="form-group">
                            <label for="bootcamp_email">Bootcamp email:</label>
                            <input type="email" class="form-control" id="bootcamp_email" name="bootcamp_email">
                        </div>
                        <div class="form-group">
                            <label for="bootcamp_contact">Bootcamp contact:</label>
                            <input type="tel" class="form-control" id="bootcamp_contact" name="bootcamp_contact">
                        </div>
                        <div class="form-group">
                            <label for="created_by">Created By:</label>
                            <input readonly class="form-control" id="created_by" name="created_by">
                        </div>
                        <div class="form-group">
                                            <label for="modified_by">Modified by:</label>
                                            <input value="<?php echo $_SESSION['username']?>" readonly class="form-control" id="modified_by" name="modified_by">
                                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary saveBtn">Save changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <?php require 'partials/_head.php' ?>
    <!-- Your form goes here -->
    <div class="main-content" style="min-height: 647px;">
        <section class="section">
            <ul class="breadcrumb breadcrumb-style ">
                <li class="breadcrumb-item">
                    <h4 class="page-title m-b-0">Add Bootcamp</h4>
                </li>
                <li class="breadcrumb-item">
                    <a href="index.php">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-home">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                            <polyline points="9 22 9 12 15 12 15 22"></polyline>
                        </svg></a>
                </li>
                <li class="breadcrumb-item">Boot camp</li>
                <li class="breadcrumb-item">Add Bootcamp</li>
            </ul>
            <div class="section-body">
                <!-- add content here -->
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                <div class="card-header">
                                <h3>Bootcamp<h3>
                                </div>
                                    <form action="bootcampdb.php" id="addRecordForm" method="post">
                                        <!-- ... (Form fields) ... -->
                                        <div class="form-group">
                                        <label for="bootcamp_email">Bootcamp email:<span style="color: red;">*</span></label>
                                        <input type="email" class="form-control" id="bootcamp_email" name="bootcamp_email" required>
                                        </div>
                                        <div class="form-group">
                                        <label for="bootcamp_contact">Bootcamp contact:<span style="color: red;">*</span></label>
                                        <input type="tel" class="form-control" id="bootcamp_contact" name="bootcamp_contact" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="created_by">Created By:</label>
                                            <input value="<?php echo $_SESSION['username']?>" readonly
                                                class="form-control" id="created_by" name="created_by">
                                        </div>
                                        <div class="form-group">
                                            <label for="modified_by">Modified By:</label>
                                            <input readonly class="form-control" id="modified_by" name="modified_by">
                                        </div>
                                        <button type="submit" class="btn btn-primary submitBtn">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <script>
    $(document).ready(function () {
        $('.submitBtn').click(function (e) {
            e.preventDefault();
            var email = $('#bootcamp_email').val();
            var contact = $('#bootcamp_contact').val();
            if (!email || !contact) {
                swal('Error', 'Please fill all the fields', 'error');
            } else {
                $('#addRecordForm').submit();
            }
        });
    });
</script> -->
                 <div class="card">
                 <div class="card-header">
                 <h4>Bootcamp</h4>
                 </div>
                 <div class="card-body">
                 <div class="table-responsive">
                 <table class="table" id="myTable">
                 <!-- Your table content goes here -->
                 <thead>
                        <tr>
                            <th style="text-align: center;">Bootcamp id</th>
                            <th style="text-align: center;">Bootcamp email</th>
                            <th style="text-align: center;">Bootcamp contact</th>
                            <th style="text-align: center;">Created By</th>
                            <th style="text-align: center;">Modified By</th>
                            <th style="text-align: center;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
            // Database connection code goes here
            include 'partials/_dbconnect.php';
            $sql = "SELECT * FROM bootcamp";
            $result = $conn->query($sql);
            $sno = 0;
            while($row = mysqli_fetch_assoc($result)){
                $sno = $sno + 1;
                echo "<tr>";
                echo "<td>" . $row["bootcamp_id"] . "</td>";
                echo "<td>" . $row["bootcamp_email"] . "</td>";
                echo "<td>" . $row["bootcamp_contact"] . "</td>";
                echo "<td>" . $row["created_by"] . "</td>";
                echo "<td>" . $row["modified_by"] . "</td>";
                echo '<td><button  class= "edit btn btn btn-primary"  id="' . $row['bootcamp_id'] . '">Edit</button>';
                echo '<button type="button" class="btn btn-danger deleteBtn" data-id="' . $row["bootcamp_id"] . '">Delete</button></td>';
                echo "</tr>";
              }
            $conn->close();
            ?>
                    </tbody>
                 </table>
            </div>
                 </div>
                 </div>

                <?php require 'partials/_foot.php' ?>
                <script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
                <script>
                    $(document).ready(function () {
                        $('#myTable').DataTable();

                    });
                </script>
                <script>
$(document).ready(function() {
  $('.edit').click(function() {
    // Get the current row
    let tr = $(this).closest('tr');
    
    // Extract data from the row
    let bootcamp_id = tr.find('td:eq(0)').text();
    let bootcamp_email = tr.find('td:eq(1)').text();
    let bootcamp_contact = tr.find('td:eq(2)').text();
    let created_by = tr.find('td:eq(3)').text();
    let modified_by = tr.find('td:eq(4)').text();

    // Assign values to modal inputs
    $('#bootcamp_email').val(bootcamp_email);
    $('#bootcamp_contact').val(bootcamp_contact);
    $('#created_by').val(created_by);
    $('#modified_by').val(modified_by);
    $('#snoEdit').val(bootcamp_id);

    // Show the modal
    $('#editModal').modal('show');
  });

  // Save changes
  $('.saveBtn').click(function() {
    // Collect data from the modal inputs
    let data = {
      bootcamp_id: $('#snoEdit').val(),
      bootcamp_email: $('#bootcamp_email').val(),
      bootcamp_contact: $('#bootcamp_contact').val(),
      created_by: $('#created_by').val(),
      modified_by: $('#modified_by').val()
    };

    // Send the data using AJAX
    $.ajax({
      url: 'bootcamp_ur.php', // The PHP file that handles the update
      type: 'POST',
      data: data,
      success: function(response) {
        // Handle success
        console.log(response);
        $('#editModal').modal('hide');

        // Find the row in the table using the bootcamp_id and update its content
        let row = $('table').find('tr').filter(function() {
          return $(this).find('td:eq(0)').text() == data.bootcamp_id;
        });

        row.find('td:eq(1)').text(data.bootcamp_email);
        row.find('td:eq(2)').text(data.bootcamp_contact);
        row.find('td:eq(3)').text(data.created_by);
        row.find('td:eq(4)').text(data.modified_by);

        // Optionally, show a success message using Swal
        Swal.fire({
          title: 'Success!',
          text: 'Data updated successfully',
          icon: 'success',
          confirmButtonText: 'OK'
        });
      },
      error: function(xhr, status, error) {
        // Handle error
        console.error(error);
      }
    });
  });
});


                    $(".deleteBtn").click(function () {
                        var id = $(this).data("id");
                        var button = $(this); // Reference to the delete button clicked
                        Swal.fire({
                            title: 'Are you sure?',
                            text: "You won't be able to revert this!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes, delete it!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.post("bootcamp_dr.php", { bootcamp_id: id }, function (data) {
                                    Swal.fire(
                                        'Deleted!',
                                        'Your record has been deleted.',
                                        'success'
                                    ).then(() => {
                                        // Remove the table row dynamically
                                        button.closest('tr').remove();
                                    })
                                });
                            }
                        })
                    });
                    $("#addRecordForm").submit(function (event) {
                        event.preventDefault(); // Prevent the default form submission
                        var formData = $(this).serializeArray(); // Serialize the form data

                        $.post("bootcampdb.php", formData, function (response) {
                            // Handle the response from addRecord.php
                            Swal.fire(
                                'Added!',
                                'Your new record has been added.',
                                'success'
                            )

                            // Code to add the new record to the table dynamically
                            var table = $("#myTable"); // Replace with your table's id
                            var row = $("<tr>"); // Create a new table row

                            // Assuming formData is an array of objects with keys 'name' and 'value'
                            $.each(formData, function (i, field) {
                                row.append($("<td>").text(field.value));
                            });

                            // Add the Edit and Delete buttons
                            row.append($("<td>").html('<button type="button" class="btn btn-primary editBtn" data-id="' + response.bootcamp_id + '">Edit</button><button type="button" class="btn btn-danger deleteBtn" data-id="' + response.bootcamp_id + '">Delete</button>'));

                            // Append the new row to the table
                            table.append(row);

                            // Clear the form fields after successful submission
                            $("#addRecordForm")[0].reset();
                        });
                    });
                </script>
</body>

</html>