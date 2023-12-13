<?php include 'header.php'; ?>
<div class="main-content">
        <section class="section">
          <ul class="breadcrumb breadcrumb-style ">
            <li class="breadcrumb-item">
              <h4 class="page-title m-b-0">Courses Technologies</h4>
            </li>
            <li class="breadcrumb-item">
              <a href="dashboard.html">
                <i data-feather="home"></i></a>
            </li>
            <li class="breadcrumb-item">Course</li>
            <li class="breadcrumb-item">Courses Technologies</li>
          </ul>
            <div class="section-body">

                <div class="card">
                    <div class="card-header">
                        <h4>Courses Technologies</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" class="mt-4" id="coursestechnologies">
                            <input type="hidden" name="course_technology_id" id="course_technology_id">

                            <div class="row">
                            <div class="form-group col-md-6">
                            <select class="form-select" aria-label="Default select example" name="course" id="course">
                                <option selected>Select Course</option>
                                <?php
                                $course_qry=mysqli_query($conn,"select course_id,course_name from courses where status='1'") or die(mysqli_error($conn));
                                while($res=mysqli_fetch_object($course_qry)){
                                    ?>
                                <option value="<?php echo $res -> course_id?>"><?php echo $res -> course_name?></option>
                                <?php
                                }
                                ?>
                            </select>
                            </div>
                            

                            <div class="form-group col-md-6">
                            <select class="form-select" aria-label="Default select example" name="technology" id="technology">
                                <option selected>Select Technology</option>
                                <?php
                                $technology_qry=mysqli_query($conn,"select technology_id,technology_name from technologies where status='1'") or die(mysqli_error($conn));
                                while($res=mysqli_fetch_object($technology_qry)){
                                    ?>
                                <option value="<?php echo $res -> technology_id?>"><?php echo $res -> technology_name?></option>
                                <?php
                                }
                                ?>
                            </select>
                            </div>
                            
                            </div>
                            
                          <div class="d-flex justify-content-center mt-4">
                          <button type="submit" name="save" class="btn btn-primary">Submit</button>
                          </div>

                        </form>
                    </div>
                </div>

                <!-- <div class="card">
                    <div class="card-header">
                        <h4>Courses Technologies Data</h4>
                    </div>
                    <div class="card-body">
                    <div class="table-responsive">
                    <table id="courses-technologies-table" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Course</th>
                            <th>Technology</th>
                            <th>Action</th>
                        </tr>
                        <tbody id="courseTechnologyTableBody">

                        </tbody>
                    </table>
                    </div>
                    </div>
                </div> -->
                <div id="coursestechnologiestablediv"></div>
            </div>
        </section>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!--footer-->
<?php include 'footer.php'?>

<script>
    $(document).ready(function () {

        $("#coursestechnologies").submit(function (e) {
            e.preventDefault();

            if ($("#course").val() === "Select Course" || $("#technology").val() === "Select Technology") {
            // Show an alert or handle the case where the fields are not selected
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'Please select both Course and Technology!',
            });
            return;
        }
            var formData = new FormData(this);
            var url = ($("#course_technology_id").val() !== "") ? "http://localhost/admin_template/update_course_technology.php" : "http://localhost/admin_template/insert_course_technology.php";

            $.ajax({
                type: "POST",
                url: url,
                data: formData,
                contentType: false,
                processData: false,
                success: function (data) {
                    $('#coursestechnologies')[0].reset();
                    $("#course_technology_id").val("");
                    fetchInsertedData();
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Data inserted successfully!',
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
                url: "http://localhost/admin_template/fetch_course_technology.php",
                success: function (data) {
                $('#coursestechnologiestablediv').html(data)
            }
            });
        }

        fetchInsertedData();
        

        window.updatecoursetechnology = function (courseTechnologyId) {
            $.ajax({
                type: "GET",
                url: "http://localhost/admin_template/update_fetch_course_technology.php?course_technology_id=" + courseTechnologyId,
                success: function (data) {
                    var courseTechnologyData = JSON.parse(data);

                    $("#course_technology_id").val(courseTechnologyData.courses_technologies_id);
                
                    $("#course").val(courseTechnologyData.course_id);
                    $("#technology").val(courseTechnologyData.technology_id);
                    
                    
                    $('html, body').animate({
                        scrollTop: $("#coursestechnologies").offset().top
                    }, 500);
                },
                error: function (xhr, status, error) {
                    console.error("Error fetching course data for update:", status, error);
                }
            });
        }

        window.deletecoursetechnology = function (courseTechnologyId) {
        
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
                    
                    $.ajax({
                    type: "GET",
                    url: "http://localhost/admin_template/delete_course_technology.php?course_technology_id=" + courseTechnologyId,
                    //   data: { curriculum_id: courseTechnologyId },
                    success: function (data) {
                        console.log(data);
                        fetchInsertedData();
                    },
                    error: function (xhr, status, error) {
                        console.error("Error deleting curriculum:", status, error);
                    }
                    });
                }
            });
        }

    });
</script>

</body>
</html>