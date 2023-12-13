<?php
session_start();
$username = $_SESSION['username'];
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: login.php");
    exit;
}

?>
<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include 'config.php';
   
    $course_id = $_POST['course_id'];
    $course_name =  $_POST['course_name_input']; 
    $no_of_openings = $_POST['no_of_openings'];
    $hiring = $_POST['hiring'];
    $status = $_POST['status'];
    $created_by = $_POST['created_by'];
    $modified_by = $_POST['modified_by'];

$sql = "INSERT INTO current_opening (course_id, course_name, no_of_openings, hiring, status, created_by, modified_by) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isisiss",  $course_id, $course_name, $no_of_openings, $hiring, $status, $created_by, $modified_by);
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
    <title>Current Opening</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="icon" href="sclogo.png">

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
                                                    <label for="course_name" required>Course Name:<span
                                                            style="color: red;">*</span></label>
                                                    <!-- PHP code to fetch course names from the database -->
                                                    <?php
                                        include 'config.php';                                        
                                        // Fetch course names from the database
                                        $sql = "SELECT course_id, course_name FROM courses";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                        echo "<select id='course_name' name='course_name' class='form-control' onchange='getCourseId(this)'  required>";
                                        echo "<option value=''>Select a course</option>";
                                        // output data of each row
                                        while($row = $result->fetch_assoc()) {
                                        echo "<option value='".$row["course_id"]."'>".$row["course_name"]."</option>";
                                        }
                                        echo "</select>";
                                        } else {
                                        echo "0 results";
                                        }
                                        $conn->close();
                                        ?>
                                                </div>
                                                <div class="form-group" style="display: none;">
                                                    <label for="course_name_input">Course Name:</label>
                                                    <input type="text" class="form-control" id="course_name_input"
                                                        name="course_name_input" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="course_id">Course ID:</label>
                                                    <input type="text" class="form-control" id="course_id"
                                                        name="course_id" readonly>
                                                </div>
                        <div class="form-group">
                            <label for="no_of_openings">No of Openings:</label>
                            <input type="number" class="form-control" id="no_of_openings" name="no_of_openings">
                        </div>
                        <div class="form-group">
                            <label for="hiring">Hiring:</label>
                            <input type="text" class="form-control" id="hiring" name="hiring">
                        </div>
                        <div class="form-group">
                            <label for="status">Status:</label>
                            <input type="number" class="form-control" id="status" name="status">
                        </div>
                        <div class="form-group">
                            <label for="created_by">Created By:</label>
                            <input readonly class="form-control" id="created_by" name="created_by">
                        </div>
                        <div class="form-group">
                            <label for="modified_by">Modified by:</label>
                            <input value="" readonly class="form-control" id="modified_by" name="modified_by">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary saveBtn">Save changes</button>
                </div>
                <script>
                    function getCourseId(sel) {
                        var courseId = sel.value;
                        var courseName = sel.options[sel.selectedIndex].text;
                        document.getElementById('course_id').value = courseId;
                        document.getElementById('course_name_input').value = courseName;
                    }
                </script>
                </form>
            </div>
        </div>
    </div>
    <?php require 'header.php' ?>
    <!-- Your form goes here -->
    <div class="main-content" style="min-height: 647px;">
        <section class="section">
            <ul class="breadcrumb breadcrumb-style ">
                <li class="breadcrumb-item">
                    <h4 class="page-title m-b-0">Add Current Openings</h4>
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
                <li class="breadcrumb-item">Current Openings</li>
                <li class="breadcrumb-item">Add Current Openings</li>
            </ul>
            <div class="section-body">
                <!-- add content here -->
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-header">
                                        <h3>Current Openings<h3>
                                    </div>
                                    <form action="current_opendb.php" id="addRecordForm" method="post">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <!-- Left side inputs -->
                                                <div class="form-group">
                                                    <label for="course_name" required>Course Name:<span
                                                            style="color: red;">*</span></label>
                                                    <!-- PHP code to fetch course names from the database -->
                                                    <?php
                                        include 'congig.php';                                        
                                        // Fetch course names from the database
                                        $sql = "SELECT course_id, course_name FROM courses";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                        echo "<select id='course_name' name='course_name' class='form-control' onchange='getCourseId(this)'  required>";
                                        echo "<option value=''>Select a course</option>";
                                        // output data of each row
                                        while($row = $result->fetch_assoc()) {
                                        echo "<option value='".$row["course_id"]."'>".$row["course_name"]."</option>";
                                        }
                                        echo "</select>";
                                        } else {
                                        echo "0 results";
                                        }
                                        $conn->close();
                                        ?>
                                                </div>
                                                <div class="form-group" style="display: none;">
                                                    <label for="course_name_input">Course Name:</label>
                                                    <input type="text" class="form-control" id="course_name_input"
                                                        name="course_name_input" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="no_of_openings">No of Openings:<span
                                                            style="color: red;">*</span></label>
                                                    <input type="number" class="form-control" id="no_of_openings"
                                                        name="no_of_openings" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="created_by">Created By:</label>
                                                    <input value="<?php echo $_SESSION['username']?>" readonly
                                                        class="form-control" id="created_by" name="created_by">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <!-- Right side inputs -->
                                                <div class="form-group">
                                                    <label for="course_id">Course ID:</label>
                                                    <input type="text" class="form-control" id="course_id"
                                                        name="course_id" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="hiring">Hiring:<span
                                                            style="color: red;">*</span></label>
                                                    <input type="text" class="form-control" id="hiring" name="hiring"
                                                        required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="status">Status:<span
                                                            style="color: red;">*</span></label>
                                                    <input type="number" class="form-control" id="status" name="status"
                                                        required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="modified_by">Modified By:</label>
                                                    <input readonly class="form-control" id="modified_by"
                                                        name="modified_by">
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary submitBtn">Submit</button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <script>
                    function getCourseId(sel) {
                        var courseId = sel.value;
                        var courseName = sel.options[sel.selectedIndex].text;
                        document.getElementById('course_id').value = courseId;
                        document.getElementById('course_name_input').value = courseName;
                    }
                </script>
                <!-- <script>
    $(document).ready(function () {
        $('.submitBtn').click(function (e) {
            e.preventDefault();
            var email = $('#bootcamp_email').val();
            var contact = $('#bootcamp_contact').val();
            if (!email || !contact) {
                swal('Error', 'Please fill all the fields', 'error');
            } else {
                $('#editForm').submit();
            }
        });
    });
</script> -->
                <div class="card">
                    <div class="card-header">
                        <h4>Current Openinigs</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table" id="myTable">
                                <!-- Your table content goes here -->
                                <thead>
                                    <tr>
                                        <th style="text-align: center;">Course id</th>
                                        <th style="text-align: center;">Course name</th>
                                        <th style="text-align: center;">no of openings</th>
                                        <th style="text-align: center;">Hiring</th>
                                        <th style="text-align: center;">Status</th>
                                        <th style="text-align: center;">Created By</th>
                                        <th style="text-align: center;">Modified By</th>
                                        <th style="text-align: center;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
            // Database connection code goes here
            include 'config.php';
            $sql = "SELECT * FROM current_opening";
            $result = $conn->query($sql);
            $sno = 0;
            while($row = mysqli_fetch_assoc($result)){
                $sno = $sno + 1;
                echo "<tr>";
                echo "<td>" . $row["course_id"] . "</td>";
                echo "<td>" . $row["course_name"] . "</td>";
                echo "<td>" . $row["no_of_openings"] . "</td>";
                echo "<td>" . $row["hiring"] . "</td>";
                echo "<td>" . $row["status"] . "</td>";
                echo "<td>" . $row["created_by"] . "</td>";
                echo "<td>" . $row["modified_by"] . "</td>";
                echo '<td><button  class= "edit btn btn btn-primary"  id="' . $row['course_id'] . '">Edit</button>';
                echo '<button type="button" class="btn btn-danger deleteBtn" data-id="' . $row["course_id"] . '">Delete</button></td>';
                echo "</tr>";
              }
            $conn->close();
            ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <?php require 'footer.php' ?>
                <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
                <script>
                    $(document).ready(function () {
                        $('#myTable').DataTable();

                    });
                </script>
                <script>
                    $(document).ready(function () {
                        $('.edit').click(function () {
                            // Get the current row
                            let tr = $(this).closest('tr');

                            // Extract data from the row
                            let course_id = tr.find('td:eq(0)').text();
                            let course_name = tr.find('td:eq(1)').text();
                            let no_of_openings = tr.find('td:eq(2)').text();
                            let hiring = tr.find('td:eq(3)').text();
                            let status = tr.find('td:eq(4)').text();
                            let created_by = tr.find('td:eq(5)').text();
                            let modified_by = tr.find('td:eq(6)').text();

                            // Assign values to modal inputs
                            $('#course_name').val(course_name);
                            $('#no_of_openings').val(no_of_openings);
                            $('#hiring').val(hiring);
                            $('#status').val(status);
                            $('#created_by').val(created_by);
                            $('#modified_by').val(modified_by);
                            $('#snoEdit').val(course_id);

                            // Show the modal
                            $('#editModal').modal('show');
                        });

                        // Save changes
                        $('.saveBtn').click(function () {
                            // Collect data from the modal inputs
                            let data = {
                                course_id: $('#snoEdit').val(),
                                course_name: $('#course_name').val(),
                                no_of_openings: $('#no_of_openings').val(),
                                hiring: $('#hiring').val(),
                                status: $('#status').val(),
                                created_by: $('#created_by').val(),
                                modified_by: $('#modified_by').val()
                            };

                            // Send the data using AJAX
                            $.ajax({
                                url: 'current_open_ur.php', // The PHP file that handles the update
                                type: 'POST',
                                data: data,
                                success: function (response) {
                                    // Handle success
                                    console.log(response);
                                    $('#editModal').modal('hide');

                                    // Find the row in the table using the course_id and update its content
                                    let row = $('table').find('tr').filter(function () {
                                        return $(this).find('td:eq(0)').text() == data.course_id;
                                    });

                                    row.find('td:eq(1)').text(data.course_name);
                                    row.find('td:eq(2)').text(data.no_of_openings);
                                    row.find('td:eq(3)').text(data.hiring);
                                    row.find('td:eq(4)').text(data.status);
                                    row.find('td:eq(5)').text(data.created_by);
                                    row.find('td:eq(6)').text(data.modified_by);

                                    // Optionally, show a success message using Swal
                                    Swal.fire({
                                        title: 'Success!',
                                        text: 'Data updated successfully',
                                        icon: 'success',
                                        confirmButtonText: 'OK'
                                    });
                                },
                                error: function (xhr, status, error) {
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
                                $.post("current_open_dr.php", { course_id: id }, function (data) {
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

                        $.post("current_opendb.php", formData, function (response) {
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
                            row.append($("<td>").html('<button type="button" class="btn btn-primary editBtn" data-id="' + response.course_id + '">Edit</button><button type="button" class="btn btn-danger deleteBtn" data-id="' + response.course_id + '">Delete</button>'));

                            // Append the new row to the table
                            table.append(row);

                            // Clear the form fields after successful submission
                            $("#addRecordForm")[0].reset();
                        });
                    });
                </script>
</body>

</html>
