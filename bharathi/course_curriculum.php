<?php include 'header.php'; ?>
<div class="main-content">
        <section class="section">
          <ul class="breadcrumb breadcrumb-style ">
            <li class="breadcrumb-item">
              <h4 class="page-title m-b-0">Course Curriculum</h4>
            </li>
            <li class="breadcrumb-item">
              <a href="dashboard.html">
                <i data-feather="home"></i></a>
            </li>
            <li class="breadcrumb-item">Course</li>
            <li class="breadcrumb-item">Course Curriculum</li>
          </ul>
            <div class="section-body">

                <div class="card">
                    <div class="card-header">
                        <h2>Course Curriculum</h2>
                    </div>
                    <div class="card-body">
                        <form method="POST" class="mt-4" id="coursecurriculum">
                            <input type="hidden" name="curriculum_id" id="curriculum_id">

                            <div class="form-group mt-3">
                            <label for="day_no" class="form-label"><h6>Day Number <span>*</span></h6></label>
                            <input type="text" class="form-control" name="day_no" id="day_no" required>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="technology_details" class="form-label"><h6>Technology Details <span>*</span></h6></label>
                                    <input type="text" class="form-control" name="technology_details" id="technology_details" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="technology" class="form-label"><h6>Technology <span>*</span></h6></label>
                                    <select class="form-select" aria-label="Default select example" name="technology" id="technology" required>
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

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="training_time" class="form-label"><h6>Training Time <span>*</span></h6></label>
                                    <input type="text" class="form-control" name="training_time" id="training_time" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="practice_time" class="form-label"><h6>Practice Time <span>*</span></h6></label>
                                    <input type="text" class="form-control" name="practice_time" id="practice_time" required>
                                </div>
                            </div>

                            <div class="d-flex justify-content-center mt-4">
                            <button type="submit" name="save" class="btn btn-primary">Submit</button>
                            </div>

                        </form>
                    </div>
                </div>

                <div id="curriculumtablediv"></div>
                
            </div>
        </section>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!--footer-->
<?php include 'footer.php'?>

<script>

$(document).ready(function () {

    $("#coursecurriculum").submit(function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        var url = ($("#curriculum_id").val() !== "") ? "http://localhost/admin_template/update_curriculum.php" : "http://localhost/admin_template/insert_curriculum.php";

        $.ajax({
            type: "POST",
            url: url,
            data: formData,
            contentType: false,
            processData: false,
            success: function (data) {
                $('#coursecurriculum')[0].reset();
                $("#curriculum_id").val("");
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
            url: "http://localhost/admin_template/fetch_curriculum.php",
            success: function (data) {
                $('#curriculumtablediv').html(data)
            }
        });
    }

    fetchInsertedData();
    

    window.updatecurriculum = function (curriculumId) {
        $.ajax({
            type: "GET",
            url: "http://localhost/admin_template/update_fetch_curriculum.php?curriculum_id=" + curriculumId,
            success: function (data) {
                var curriculumData = JSON.parse(data);

                $("#curriculum_id").val(curriculumData.curriculum_id);
                $("#day_no").val(curriculumData.day_no);
                $("#technology_details").val(curriculumData.technology_details);
                $("#technology").val(curriculumData.technology_id);
                $("#training_time").val(curriculumData.training_time);
                $("#practice_time").val(curriculumData.practice_time);
                // $("#technology_name").val(technologyData.technology_name);
                
                $('html, body').animate({
                    scrollTop: $("#coursecurriculum").offset().top
                }, 500);
            },
            error: function (xhr, status, error) {
                console.error("Error fetching course data for update:", status, error);
            }
        });
    }

    window.deletecurriculum = function (curriculumId) {
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
                url: "http://localhost/admin_template/delete_curriculum.php?curriculum_id=" + curriculumId,
                //   data: { curriculum_id: curriculumId },
                success: function (data) {
                    console.log(data);
                    fetchInsertedData(); // Reload the curriculum table after deletion
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