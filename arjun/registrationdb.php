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
   
    // Assign POST variables to corresponding variables
    $student_fname = $_POST['student_fname'];
    $student_lname = $_POST['student_lname'];
    $student_email = $_POST['student_email'];
    $student_number = $_POST['student_number'];
    $student_alt_number = $_POST['student_alt_number'];
    $student_gender = $_POST['student_gender'];
    $student_address = $_POST['student_address'];
    $student_courses = $_POST['student_courses'];
    $student_program1 = $_POST['student_program1'];
    $student_program2 = $_POST['student_program2'];
    $student_program3 = $_POST['student_program3'];
    $student_hear_aboutus = $_POST['student_hear_aboutus'];
    $student_recommend = $_POST['student_recommend'];
    $ref1 = $_POST['ref1'];
    $ref1_number = $_POST['ref1_number'];
    $ref2 = $_POST['ref2'];
    $ref2_number = $_POST['ref2_number'];
    $created_by = $_POST['created_by'];
    $modified_by = $_POST['modified_by'];

    // Prepare the SQL statement
    $sql = "INSERT INTO registration (student_fname, student_lname, student_email, student_number, student_alt_number, student_gender, student_address, student_courses, student_program1, student_program2, student_program3, student_hear_aboutus, student_recommend, ref1, ref1_number, ref2, ref2_number, created_by, modified_by) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    // Prepare and bind parameters
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssssssssssiii", $student_fname, $student_lname, $student_email, $student_number, $student_alt_number, $student_gender, $student_address, $student_courses, $student_program1, $student_program2, $student_program3, $student_hear_aboutus, $student_recommend, $ref1, $ref1_number, $ref2, $ref2_number, $created_by, $modified_by);
    
    // Execute the statement
    $stmt->execute();

    // Check for successful insertion
    if ($stmt->affected_rows > 0) {
        echo "New student record created successfully";
    } else {
        echo "Error: could not insert new student record";
    }
    
    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registration</title>
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
                    <form action="registrationdb.php" id="editForm" method="post">
                        <!-- Your form fields go here -->
                        <input type="hidden" name="snoEdit" id="snoEdit">
                        <div class="container">
            <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="student_fname">First Name:</label>
                    <input type="text" class="form-control" id="student_fname" name="student_fname" >
                </div>
                <div class="form-group">
                    <label for="student_lname">Last Name:</label>
                    <input type="text" class="form-control" id="student_lname" name="student_lname" >
                </div>
                <div class="form-group">
                    <label for="student_email">Email:</label>
                    <input type="email" class="form-control" id="student_email" name="student_email" >
                </div>
                <div class="form-group">
                    <label for="student_number">Number:</label>
                    <input type="number" class="form-control" id="student_number" name="student_number" >
                </div>
                <div class="form-group">
                    <label for="student_alt_number">Alternate Number:</label>
                    <input type="number" class="form-control" id="student_alt_number" name="student_alt_number">
                </div>
                <div class="form-group">
                    <label for="student_gender">Gender:</label>
                    <input type="text" class="form-control" id="student_gender" name="student_gender" >
                </div>
                <div class="form-group">
                    <label for="student_address">Address:</label>
                    <input type="text" class="form-control" id="student_address" name="student_address" >
                </div>
                <div class="form-group">
                    <label for="student_courses">Courses:</label>
                    <input type="text" class="form-control" id="student_courses" name="student_courses" >
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="student_program1">Program 1:</label>
                    <input type="text" class="form-control" id="student_program1" name="student_program1" >
                </div>
                <div class="form-group">
                    <label for="student_program2">Program 2:</label>
                    <input type="text" class="form-control" id="student_program2" name="student_program2">
                </div>
                <div class="form-group">
                    <label for="student_program3">Program 3:</label>
                    <input type="text" class="form-control" id="student_program3" name="student_program3">
                </div>
                <div class="form-group">
                    <label for="student_hear_aboutus">How did you hear about us?:</label>
                    <input type="text" class="form-control" id="student_hear_aboutus" name="student_hear_aboutus" >
                </div>
                <div class="form-group">
                    <label for="student_recommend">Would you recommend us?:</label>
                    <input type="text" class="form-control" id="student_recommend" name="student_recommend" >
                </div>
                <div class="form-group">
                    <label for="ref1">Reference 1:</label>
                    <input type="text" class="form-control" id="ref1" name="ref1">
                </div>
                <div class="form-group">
                    <label for="ref1_number">Reference 1 Number:</label>
                    <input type="number" class="form-control" id="ref1_number" name="ref1_number">
                </div>
                <div class="form-group">
                    <label for="ref2">Reference 2:</label>
                    <input type="text" class="form-control" id="ref2" name="ref2">
                </div>
                <div class="form-group">
                    <label for="ref2_number">Reference 2 Number:</label>
                    <input type="number" class="form-control" id="ref2_number" name="ref2_number">
                </div>
                <div class="form-group">
                    <label for="created_by">Created By:</label>
                    <input value="<?php echo $_SESSION['username']?>" readonly class="form-control" id="created_by" name="created_by">
                </div>
                <div class="form-group">
                    <label for="modified_by">Modified By:</label>
                    <input readonly class="form-control" id="modified_by" name="modified_by">
                </div>
            </div>
        </div>
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
                    <h4 class="page-title m-b-0">Add Registration</h4>
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
                <li class="breadcrumb-item">Registration</li>
                <li class="breadcrumb-item">Add Registration</li>
            </ul>
            <div class="section-body">
                <!-- add content here -->
                <div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                <div class="card-header">
                                        <h3>Student Registration</h3>
                                    </div>
                <form action="registrationdb.php" id="addRecordForm" method="post">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="student_fname">First Name:<span style="color: red;">*</span></label>
                    <input type="text" class="form-control" id="student_fname" name="student_fname" required>
                </div>
                <div class="form-group">
                    <label for="student_lname">Last Name:<span style="color: red;">*</span></label>
                    <input type="text" class="form-control" id="student_lname" name="student_lname" required>
                </div>
                <div class="form-group">
                    <label for="student_email">Email:<span style="color: red;">*</span></label>
                    <input type="email" class="form-control" id="student_email" name="student_email" required>
                </div>
                <div class="form-group">
                    <label for="student_number">Number:<span style="color: red;">*</span></label>
                    <input type="number" class="form-control" id="student_number" name="student_number" required>
                </div>
                <div class="form-group">
                    <label for="student_alt_number">Alternate Number:</label>
                    <input type="number" class="form-control" id="student_alt_number" name="student_alt_number">
                </div>
                <div class="form-group">
                    <label for="student_gender">Gender:<span style="color: red;">*</span></label>
                    <input type="text" class="form-control" id="student_gender" name="student_gender" required>
                </div>
                <div class="form-group">
                    <label for="student_address">Address:<span style="color: red;">*</span></label>
                    <input type="text" class="form-control" id="student_address" name="student_address" required>
                </div>
                <div class="form-group">
                    <label for="student_courses">Courses:<span style="color: red;">*</span></label>
                    <input type="text" class="form-control" id="student_courses" name="student_courses" required>
                </div>
                <div class="form-group">
                    <label for="created_by">Created By:</label>
                    <input value="<?php echo $_SESSION['username']?>" readonly class="form-control" id="created_by" name="created_by">
                </div>
                <div class="form-group">
                    <label for="modified_by">Modified By:</label>
                    <input readonly class="form-control" id="modified_by" name="modified_by">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="student_program1">Program 1:<span style="color: red;">*</span></label>
                    <input type="text" class="form-control" id="student_program1" name="student_program1" required>
                </div>
                <div class="form-group">
                    <label for="student_program2">Program 2:</label>
                    <input type="text" class="form-control" id="student_program2" name="student_program2">
                </div>
                <div class="form-group">
                    <label for="student_program3">Program 3:</label>
                    <input type="text" class="form-control" id="student_program3" name="student_program3">
                </div>
                <div class="form-group">
                    <label for="student_hear_aboutus">How did you hear about us?:<span style="color: red;">*</span></label>
                    <input type="text" class="form-control" id="student_hear_aboutus" name="student_hear_aboutus" required>
                </div>
                <div class="form-group">
                    <label for="student_recommend">Would you recommend us?:<span style="color: red;">*</span></label>
                    <input type="text" class="form-control" id="student_recommend" name="student_recommend" required>
                </div>
                <div class="form-group">
                    <label for="ref1">Reference 1:</label>
                    <input type="text" class="form-control" id="ref1" name="ref1">
                </div>
                <div class="form-group">
                    <label for="ref1_number">Reference 1 Number:</label>
                    <input type="number" class="form-control" id="ref1_number" name="ref1_number">
                </div>
                <div class="form-group">
                    <label for="ref2">Reference 2:</label>
                    <input type="text" class="form-control" id="ref2" name="ref2">
                </div>
                <div class="form-group">
                    <label for="ref2_number">Reference 2 Number:</label>
                    <input type="number" class="form-control" id="ref2_number" name="ref2_number">
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary submitBtn">Submit</button>
    </div>
</form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- 
<script>
    $(document).ready(function () {
        $('.submitBtn').click(function (e) {
            e.preventDefault();
            var student_fname = $('#student_fname').val();
            var student_lname = $('#student_lname').val();
            var student_email = $('#student_email').val();
            var student_number = $('#student_number').val();
            var student_alt_number = $('#student_alt_number').val();
            var student_gender = $('#student_gender').val();
            var student_address = $('#student_address').val();
            var student_courses = $('#student_courses').val();
            var student_program1 = $('#student_program1').val();
            var student_program2 = $('#student_program2').val();
            var student_program3 = $('#student_program3').val();
            var student_hear_aboutus = $('#student_hear_aboutus').val();
            var student_recommend = $('#student_recommend').val();
            var ref1 = $('#ref1').val();
            var ref1_number = $('#ref1_number').val();
            var ref2 = $('#ref2').val();
            var ref2_number = $('#ref2_number').val();
            var created_by = $('#created_by').val();
            var modified_by = $('#modified_by').val();
            if (!student_fname || !student_lname || !student_email || !student_number || !student_gender || !student_address || !student_courses || !student_program1 || !student_hear_aboutus || !student_recommend) {
                Swal.fire('Error', 'Please fill all the required fields', 'error');
            } else {
                $('#addRecordForm').submit();
            }
        });
    });
</script> -->


<div class="card">
    <div class="card-header">
        <h4>Registration</h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table" id="myTable">
                <thead>
                    <tr>
                        <th style="text-align: center;">Student ID</th>
                        <th style="text-align: center;">First Name</th>
                        <th style="text-align: center;">Last Name</th>
                        <th style="text-align: center;">Email</th>
                        <th style="text-align: center;">Contact Number</th>
                        <th style="text-align: center;">Alternate Contact</th>
                        <th style="text-align: center;">Gender</th>
                        <th style="text-align: center;">Address</th>
                        <th style="text-align: center;">Courses</th>
                        <th style="text-align: center;">Program 1</th>
                        <th style="text-align: center;">Program 2</th>
                        <th style="text-align: center;">Program 3</th>
                        <th style="text-align: center;">Hear About Us</th>
                        <th style="text-align: center;">Recommend</th>
                        <th style="text-align: center;">Reference 1</th>
                        <th style="text-align: center;">Reference 1 Number</th>
                        <th style="text-align: center;">Reference 2</th>
                        <th style="text-align: center;">Reference 2 Number</th>
                        <th style="text-align: center;">Created By</th>
                        <th style="text-align: center;">Modified By</th>
                        <th style="text-align: center;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include 'partials/_dbconnect.php';
                    $sql = "SELECT * FROM registration";
                    $result = $conn->query($sql);
                    while($row = mysqli_fetch_assoc($result)){
                        echo "<tr>";
                        echo "<td>" . $row["student_id"] . "</td>";
                        echo "<td>" . $row["student_fname"] . "</td>";
                        echo "<td>" . $row["student_lname"] . "</td>";
                        echo "<td>" . $row["student_email"] . "</td>";
                        echo "<td>" . $row["student_number"] . "</td>";
                        echo "<td>" . $row["student_alt_number"] . "</td>";
                        echo "<td>" . $row["student_gender"] . "</td>";
                        echo "<td>" . $row["student_address"] . "</td>";
                        echo "<td>" . $row["student_courses"] . "</td>";
                        echo "<td>" . $row["student_program1"] . "</td>";
                        echo "<td>" . $row["student_program2"] . "</td>";
                        echo "<td>" . $row["student_program3"] . "</td>";
                        echo "<td>" . $row["student_hear_aboutus"] . "</td>";
                        echo "<td>" . $row["student_recommend"] . "</td>";
                        echo "<td>" . $row["ref1"] . "</td>";
                        echo "<td>" . $row["ref1_number"] . "</td>";
                        echo "<td>" . $row["ref2"] . "</td>";
                        echo "<td>" . $row["ref2_number"] . "</td>";
                        echo "<td>" . $row["created_by"] . "</td>";
                        echo "<td>" . $row["modified_by"] . "</td>";
                        echo '<td><button class="edit btn btn-primary" id="' . $row['student_id'] . '">Edit</button>';
                        echo '<button type="button" class="btn btn-danger deleteBtn" data-id="' . $row["student_id"] . '">Delete</button></td>';
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
    let student_id = tr.find('td:eq(0)').text();
    let student_fname = tr.find('td:eq(1)').text();
    let student_lname = tr.find('td:eq(2)').text();
    let student_email = tr.find('td:eq(3)').text();
    let student_number = tr.find('td:eq(4)').text();
    let student_alt_number = tr.find('td:eq(5)').text();
    let student_gender = tr.find('td:eq(6)').text();
    let student_address = tr.find('td:eq(7)').text();
    let student_courses = tr.find('td:eq(8)').text();
    let student_program1 = tr.find('td:eq(9)').text();
    let student_program2 = tr.find('td:eq(10)').text();
    let student_program3 = tr.find('td:eq(11)').text();
    let student_hear_aboutus = tr.find('td:eq(12)').text();
    let student_recommend = tr.find('td:eq(13)').text();
    let ref1 = tr.find('td:eq(14)').text();
    let ref1_number = tr.find('td:eq(15)').text();
    let ref2 = tr.find('td:eq(16)').text();
    let ref2_number = tr.find('td:eq(17)').text();
    let created_by = tr.find('td:eq(18)').text();
    let modified_by = tr.find('td:eq(19)').text();

    // Assign values to modal inputs
    $('#student_fname').val(student_fname);
    $('#student_lname').val(student_lname);
    $('#student_email').val(student_email);
    $('#student_number').val(student_number);
    $('#student_alt_number').val(student_alt_number);
    $('#student_gender').val(student_gender);
    $('#student_address').val(student_address);
    $('#student_courses').val(student_courses);
    $('#student_program1').val(student_program1);
    $('#student_program2').val(student_program2);
    $('#student_program3').val(student_program3);
    $('#student_hear_aboutus').val(student_hear_aboutus);
    $('#student_recommend').val(student_recommend);
    $('#ref1').val(ref1);
    $('#ref1_number').val(ref1_number);
    $('#ref2').val(ref2);
    $('#ref2_number').val(ref2_number);
    $('#created_by').val(created_by);
    $('#modified_by').val(modified_by);
    $('#snoEdit').val(student_id);

    // Show the modal
    $('#editModal').modal('show');
  });

  // Save changes
  $('.saveBtn').click(function() {
    // Collect data from the modal inputs
    let data = {
      student_id: $('#snoEdit').val(),
      student_fname: $('#student_fname').val(),
      student_lname: $('#student_lname').val(),
      student_email: $('#student_email').val(),
      student_number: $('#student_number').val(),
      student_alt_number: $('#student_alt_number').val(),
      student_gender: $('#student_gender').val(),
      student_address: $('#student_address').val(),
      student_courses: $('#student_courses').val(),
      student_program1: $('#student_program1').val(),
      student_program2: $('#student_program2').val(),
      student_program3: $('#student_program3').val(),
      student_hear_aboutus: $('#student_hear_aboutus').val(),
      student_recommend: $('#student_recommend').val(),
      ref1: $('#ref1').val(),
      ref1_number: $('#ref1_number').val(),
      ref2: $('#ref2').val(),
      ref2_number: $('#ref2_number').val(),
      created_by: $('#created_by').val(),
      modified_by: $('#modified_by').val()
    };

    // Send the data using AJAX
    $.ajax({
      url: 'registration_ur.php', // The PHP file that handles the update
      type: 'POST',
      data: data,
      success: function(response) {
        // Handle success
        console.log(response);
        $('#editModal').modal('hide');

        // Find the row in the table using the student_id and update its content
        let row = $('table').find('tr').filter(function() {
          return $(this).find('td:eq(0)').text() == data.student_id;
        });

        row.find('td:eq(1)').text(data.student_fname);
        row.find('td:eq(2)').text(data.student_lname);
        row.find('td:eq(3)').text(data.student_email);
        row.find('td:eq(4)').text(data.student_number);
        row.find('td:eq(5)').text(data.student_alt_number);
        row.find('td:eq(6)').text(data.student_gender);
        row.find('td:eq(7)').text(data.student_address);
        row.find('td:eq(8)').text(data.student_courses);
        row.find('td:eq(9)').text(data.student_program1);
        row.find('td:eq(10)').text(data.student_program2);
        row.find('td:eq(11)').text(data.student_program3);
        row.find('td:eq(12)').text(data.student_hear_aboutus);
        row.find('td:eq(13)').text(data.student_recommend);
        row.find('td:eq(14)').text(data.ref1);
        row.find('td:eq(15)').text(data.ref1_number);
        row.find('td:eq(16)').text(data.ref2);
        row.find('td:eq(17)').text(data.ref2_number);
        row.find('td:eq(18)').text(data.created_by);
        row.find('td:eq(19)').text(data.modified_by);

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
                                $.post("registration_dr.php", { student_id: id }, function (data) {
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

                        $.post("registrationdb.php", formData, function (response) {
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
                            row.append($("<td>").html('<button type="button" class="btn btn-primary editBtn" data-id="' + response.student_id + '">Edit</button><button type="button" class="btn btn-danger deleteBtn" data-id="' + response.student_id + '">Delete</button>'));

                            // Append the new row to the table
                            table.append(row);

                            // Clear the form fields after successful submission
                            $("#addRecordForm")[0].reset();
                        });
                    });
                </script>
</body>

</html>