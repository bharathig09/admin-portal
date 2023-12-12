<?php include 'header.php'; ?>
<div class="main-content">
        <section class="section">
          <ul class="breadcrumb breadcrumb-style ">
            <li class="breadcrumb-item">
              <h4 class="page-title m-b-0">Technologies</h4>
            </li>
            <li class="breadcrumb-item">
              <a href="dashboard.html">
                <i data-feather="home"></i></a>
            </li>
            <li class="breadcrumb-item">Course</li>
            <li class="breadcrumb-item">Technologies</li>
          </ul>
            <div class="section-body">

                <div class="container mt-5">
                    <div class="row justify-content-center">
                    <div class="card col-md-6">
                        <div class="card-header">
                            <h2>Technologies Form</h2>
                        </div>
                        <div class="card-body">
                            <form method="POST" class="mt-4" id="technologies">
                                <input type="hidden" name="technology_id" id="technology_id">

                            <div class="form-group">
                            <label for="technology_name" class="form-label"><h6>Technology Name <span>*</span></h6></label>
                            <input type="text" class="form-control" name="technology_name" id="technology_name" required>
                            </div>

                            <div class="d-flex justify-content-center mt-4">
                            <button type="submit" name="save" class="btn btn-primary">Submit</button>
                            </div>
                                
                                <!-- <label for="course_image" class="form-label">Course Image</label>
                                <input type="file" class="form-control" name="course_image" id="course_image"> -->

                            </form>
                        </div>
                    </div>
                    </div>
                </div>
                

                <!-- <div class="card">
                    <div class="card-header">
                        <h4>Technologies Data</h4>
                    </div>
                    <div class="card-body">
                    <table id="technologies_table" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Tag Name</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody id="technologyTableBody">
                        </tbody>
                    </table>
                    </div>
                </div> -->
                <div id="technologiestablediv"></div>
            </div>
        </section>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!--footer-->
<?php include 'footer.php'?>

<script>
    $(document).ready(function () {

        $("#technologies").submit(function (e) {
            e.preventDefault();
            var formData = new FormData(this);
            var url = ($("#technology_id").val() !== "") ? "http://localhost/admin_template/update_technology.php" : "http://localhost/admin_template/insert_technology.php";

            $.ajax({
                type: "POST",
                url: url,
                data: formData,
                contentType: false,
                processData: false,
                success: function (data) {
                    $('#technologies')[0].reset();
                    $("#technology_id").val("");
                    fetchInsertedData();

                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Technology inserted successfully!',
                        showConfirmButton: false,
                        timer: 1500
                    });
                },
                error: function (error) {
                    console.error(error);
                }
            });
        });;

        function fetchInsertedData() {
            $.ajax({
                type: "GET",
                url: "http://localhost/admin_template/fetch_technologies.php",
                success: function (data) {
                $('#technologiestablediv').html(data)
            }
            });
        }

        fetchInsertedData();
        

        window.updatetechnology = function (technologyId) {
            $.ajax({
                type: "GET",
                url: "http://localhost/admin_template/update_fetch_technology.php?technology_id=" + technologyId,
                success: function (data) {
                    var technologyData = JSON.parse(data);

                    $("#technology_id").val(technologyData.technology_id);
                    $("#technology_name").val(technologyData.technology_name);

                    $('html, body').animate({
                        scrollTop: $("#technologies").offset().top
                    }, 500);
                },
                error: function (xhr, status, error) {
                    console.error("Error fetching course data for update:", status, error);
                }
            });
        }

        window.deletetechnology = function (technologyId) {
            // Confirm before deleting
            Swal.fire({
                title: 'Are you sure?',
                text: 'You won\'t be able to revert this!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Perform the delete operation using AJAX
                    $.ajax({
                        type: "GET",
                        url: "http://localhost/admin_template/delete_technology.php?technology_id=" + technologyId,
                        success: function (data) {
                            console.log(data);
                            fetchInsertedData(); // Reload the technology table after deletion

                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: 'Technology deleted successfully!',
                                showConfirmButton: false,
                                timer: 1500
                            });
                        },
                        error: function (xhr, status, error) {
                            console.error("Error deleting technology:", status, error);
                        }
                    });
                }
            });
        }
    });
</script>

<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script> -->

</body>
</html>