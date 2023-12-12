
<?php 
session_start();

require_once("config.php");

include_once("header.php");


?>
<body>

<div class="main-content">
    <section class="section">
    <ul class="breadcrumb breadcrumb-style ">
        <li class="breadcrumb-item">
          <h4 class="page-title m-b-0">Count</h4>
        </li>
        <li class="breadcrumb-item">
          <a href="menu.php">
            <i data-feather="home"></i></a>
        </li>
        <li class="breadcrumb-item">Count</li>
    </ul>

    <div class="card">
        <div class="card-body">
            <h2 class="card-title">Count</h2>

            <form method="POST" id="formData">

            <div class="row">
            <div class="col-md-6">
            <div class="form-group">
                <label for="social_tags_url">Finished Sessions:</label>
                <input type="number" class="form-control" id="finished" name="finished">
            </div>
            </div>

            <div class="col-md-6">
            <div class="form-group">
                <label for="social_tags_type">Online Enrollment:</label>
                <input type="number" class="form-control" id="online" name="online">
            </div>
            </div>

            <div class="col-md-6">
            <div class="form-group">
                <label for="social_tags_type">Subjects Taught:</label>
                <input type="number" class="form-control" id="subjects" name="subjects">
            </div>
            </div>

            <div class="col-md-6">
            <div class="form-group">
                <label for="social_tags_type">Satisfaction Rate:</label>
                <input type="number" class="form-control" id="satisfaction" name="satisfaction">
            </div>
            </div>

                <input type="hidden" class="hid" name ="hid">
                <div class="col-md-12">
                <button type="submit" id="save" name="save" class="btn btn-primary float-end" >submit</button> 
            </div>

                </div>

            </form>
            </div>
            </div>

    </section>

    <div class="card">
        <div class="card-header">
            <p class="h4 font-weight-bold"><strong>Count Table</strong</p>

        </div>
        <div class="card-body" id="myTable">

        </div>

    </div>

</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

$(document).ready(function () {
    $("#formData").submit(function (event) {
        event.preventDefault();
            var finished = $('#finished').val();
            var online = $('#online').val();
            var subjects = $('#subjects').val();
            var satisfaction = $('#satisfaction').val();

            if (!finished || !online || !subjects || !satisfaction) {
                Swal.fire({
                    icon: 'error',
                    title: 'Validation Error!',
                    text: 'All fields are required!',
                });
                return;
            }
        
        console.log("Form submitted");

        $.ajax({
            url: "http://localhost/Admin/count-insert.php",
            type: "POST",
            data: $("#formData").serialize(),
            success: function (response) {
                console.log("Success:", response);
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

        var id=$(this).data('id');
        var finished=$(this).data('finished');
        var online=$(this).data('online');
        var subjects=$(this).data('subjects');
        var satisfaction=$(this).data('satisfaction');


        $('#finished').val(finished);
        $('#online').val(online);
        $('#subjects').val(subjects);
        $('#satisfaction').val(satisfaction);
        $('.hid').val(id);


    });

    $('#myTable').on('click', '.deleteBtn', function () {
            var count_id = $(this).data('id');

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
                        url: "http://localhost/Admin/count-delete.php",
                        type: "POST",
                        data: {
                            action: 'delete',
                            hid: count_id
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
            url: "http://localhost/Admin/count-select.php",
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

<?php
include_once("footer.php");

?>

