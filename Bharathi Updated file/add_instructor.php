<?php 

include_once("header.php");


?>
<body>

<div class="main-content">
    <section class="section">
    <ul class="breadcrumb breadcrumb-style ">
        <li class="breadcrumb-item">
          <h4 class="page-title m-b-0">Add Instructor</h4>
        </li>
        <li class="breadcrumb-item">
          <a href="menu.php">
            <i data-feather="home"></i></a>
        </li>
        <li class="breadcrumb-item">Instructor</li>
    </ul>

    <div class="card">
        <div class="card-body">
            <h4> Add Instructor</h4>

            <form method="POST" enctype="multipart/form-data" id="formData">

                <div class="row">

                <div class="col-md-6">
                <div class="form-group">
                    <label for="instructor_name">Instructor Name:</label>
                    <input type="text" class="form-control" id="instructor_name" name="instructor_name">
                </div>
                </div>

                <div class="col-md-6">
                <div class="form-group">
                    <label for="about_instructor">About Instructor:</label>
                    <textarea class="form-control" id="about_instructor" name="about_instructor" rows="4"></textarea>
                </div>
                </div>

                <div class="col-md-6">
                <div class="form-group">
                    <label for="instructor_designation">Instructor Designation:</label>
                    <input type="text" class="form-control" id="instructor_designation" name="instructor_designation">
                </div>
                </div>

                <div class="col-md-6">
                <div class="form-group">
                    <label for="instructor_profile_image">Instructor Profile Image:</label>
                    <input type="file" class="form-control" id="instructor_profile_image" name="instructor_profile_image" accept="image/*">
                </div>
                </div>

                <input type="hidden" class="Iid" name="Iid">

                <div class="d-flex justify-content-center">

                <button type="submit" id="save" name="save" class="btn btn-primary" >submit</button> 
                </div>

                </div>

            </form>
        </div>
        </div>

    </section>

    <!-- <div class="card" id="myTable">

    </div> -->
    <div class="card" >
        <div class="card-header">
            <p class="h4"><strong>Instructor Table</strong></p>
        </div>
        <div class="card-body" id="myTable">
        </div>

    </div>

</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
include_once("footer.php");

?>

<script>
$(document).ready(function () {
    $("#formData").submit(function (event) {
            event.preventDefault();
            var instructorName = $('#instructor_name').val();
            var aboutInstructor = $('#about_instructor').val();
            var instructorDesignation = $('#instructor_designation').val();
            var image = $('#instructor_profile_image').val();

            if (!instructorName || !aboutInstructor || !instructorDesignation || !image) {
                Swal.fire({
                    icon: 'error',
                    title: 'Validation Error!',
                    text: 'All fields are required!',
                });
                return;
            }
        
        $.ajax({
            url: "http://localhost/admin_template/instructor-insert.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            processData: false,
            success: function (response) {
                console.log(response); 
                fetch();

                if (isEditMode) {
                    $('#instructor_name').val('');
                    $('#about_instructor').val('');
                    $('#instructor_designation').val('');
                    $('#instructor_profile_image').val('');
                    $('.Iid').val('');
                    isEditMode = false; // Reset edit mode after clearing fields
                }
               
            },
            error: function () {
                console.log("Error occurred while processing the form.");
            }
        });
    });

    $('#myTable').on('click', '.updateBtn', function() {

        var id=$(this).data('id');
        var name=$(this).data('name');
        var about=$(this).data('about');
        var desg=$(this).data('desg');
        var image=$(this).data('image');

        $('#instructor_name').val(name);
        $('#about_instructor').val(about);
        $('#instructor_designation').val(desg);
        $('#instructor_profile_image_preview').attr('src', 'images/' + image);
        $('.Iid').val(id);

        isEditMode = true;


    })

    $('#myTable').on('click', '.deleteBtn', function () {
            var instructorId = $(this).data('id');

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
                        url: "http://localhost/admin_template/instructor-delete.php",
                        type: "POST",
                        data: {
                            action: 'delete',
                            Iid: instructorId
                        },
                        success: function (response) {
                            console.log(response);
                            fetch(); // Reload the table after deletion
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
                url: "http://localhost/admin_template/instructor-select.php",
                type: "GET",
                success: function (data) {
                    $('#myTable').html(data)

                }
        });

    }

    fetch();

    });

</script>

</body>
</html>




