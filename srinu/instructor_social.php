
<?php 
session_start();
require_once("config.php");

include_once("header.php");


?>
<style>
    .required-field::before {
      content: '*';
      color: red; 
      margin-right: 3px; 
    }
  </style>
</head>
<body>

<div class="main-content">
    <section class="section">
    <ul class="breadcrumb breadcrumb-style ">
        <li class="breadcrumb-item">
          <h4 class="page-title m-b-0">Instructor</h4>
        </li>
        <li class="breadcrumb-item">
          <a href="menu.php">
            <i data-feather="home"></i></a>
        </li>
        <li class="breadcrumb-item">Social Tags</li>
    </ul>

    <div class="card">
        <div class="card-body">
            <h2 class="card-title">Instructor Social Tags</h2>

            <form method="POST" id="formData">
            <div class="row">
            <div class="col-md-4">
            <div class="form-group">
            <label for="instructor_id" class="required-field">Select Instructor:</label>
            <select class="form-control" id="instructor_id" name="instructor_id">
                <option>Select Instructor</option>
                <?php
                require_once("config.php");

                $result = $conn->query("SELECT instructor_id, instructor_name FROM instructors WHERE status = '1'");

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row["instructor_id"] . "'>" . $row["instructor_name"] . "</option>";
                    }
                } else {
                    echo "<option value='' disabled>No instructors available</option>";
                }          
            
            ?>
            </select>
            </div>
            </div>

            <div class="col-md-4">
            <div class="form-group">
                <label for="social_tags_url" class="required-field">Social Tags URL:</label>
                <input type="text" class="form-control" id="social_tags_url" name="social_tags_url">
            </div>
            </div>

            <div class="col-md-4">
            <div class="form-group">
                <label for="social_tags_type" class="required-field">Social Tags Type:</label>
                <input type="text" class="form-control" id="social_tags_type" name="social_tags_type">
            </div>
            </div>

                <input type="hidden" class="hid" name ="hid">

                <div class="col-md-12">
                <button type="submit" id="save" name="save" class="btn btn-primary float-end">submit</button> 
                </div>
                </div>

            </form>
            </div>
            </div> 

    </section>

    <div class="card" >
        <div class="card-header">
            <p class="h4 font-weight-bold"><strong>Social tags</strong></p>
        </div>
        <div class="card-body" id="myTable">

        </div>

    </div>

</div>

</body>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function () {
    $("#formData").submit(function (event) {
        event.preventDefault();

            var instructorId = $('#instructor_id').val();
            var url = $('#social_tags_url').val();
            var type = $('#social_tags_type').val();

            if (instructorId === 'Select Instructor' || !url || !type) {
                Swal.fire({
                    icon: 'error',
                    title: 'Validation Error!',
                    text: 'All fields are required!',
                });
                return;
            }
        
        console.log("Form submitted");

        $.ajax({
            url: "http://localhost/Admin/instructor_social-insert.php",
            type: "POST",
            data: $("#formData").serialize(),
            success: function (response) {
                console.log("Success:", response);
                $('.hid').val('');
                fetch();
                $("#formData")[0].reset();
                
                Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Data ' + (response.includes('inserted') ? 'inserted' : 'updated') + ' successfully.',
                    });
            },
            error: function (xhr, status, error) {
                console.log("Error:", status, error);
            }
        });
    });

    $('#myTable').on('click', '.updateBtn', function() {

        var hid=$(this).data('hid');
        var id=$(this).data('id');
        var url=$(this).data('url');
        var type=$(this).data('type');

        $('#instructor_id').val(id);
        $('#social_tags_url').val(url);
        $('#social_tags_type').val(type);
        $('.hid').val(hid);

    });

    $('#myTable').on('click', '.deleteBtn', function () {
            var instructor_social_id = $(this).data('hid');

            Swal.fire({
                title: 'Are you sure?',
                text: 'You won\'t be able to revert this!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "http://localhost/Admin/instructor_social-delete.php",
                        type: "POST",
                        data: {
                            action: 'delete',
                            hid: instructor_social_id
                        },
                        success: function (response) {
                            console.log(response);
                            Swal.fire({
                                icon: 'success',
                                title: 'Deleted Successfully',
                                text: ''
                            });
                            fetch(); 
                        },
                        error: function () {
                            console.log("Error occurred while processing the delete request.");
                        }
                    });
                }
            });
        });


    function fetch() {
        $.ajax({
            url: "http://localhost/Admin/instructor_social-select.php",
            type: "GET",
            success: function (data) {
                $('#myTable').html(data)

            }
        });

    }

    fetch();

});
</script>




<?php
include_once("footer.php");

?>

