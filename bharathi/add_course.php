<?php include 'header.php'; ?>
<div class="main-content">
        <section class="section">
          <ul class="breadcrumb breadcrumb-style ">
            <li class="breadcrumb-item">
              <h4 class="page-title m-b-0">Add Course</h4>
            </li>
            <li class="breadcrumb-item">
              <a href="dashboard.html">
                <i data-feather="home"></i></a>
            </li>
            <li class="breadcrumb-item">Course</li>
            <li class="breadcrumb-item">Add Course</li>
          </ul>
            <div class="section-body">

                <div class="card">
                    <div class="card-header">
                        <h2>Add Course Form</h2>
                    </div>
                    <div class="card-body">
                        <form method="POST" class="mt-4" id="addcourse">
                            <input type="hidden" name="course_id" id="course_id">

                          <!-- <label for="course_name" class="form-label">Course Name</label>
                          <input type="text" class="form-control" name="course_name" id="course_name" required>
                  
                          <label for="course_des" class="form-label">Course Description</label>
                          <textarea class="form-control" name="course_des" id="course_des" rows="3" required></textarea> -->
                          <div class="row">
                            <div class="form-group col-md-6">
                                <label for="course_name" class="form-label"><h6>Course Name<span>*</span></h6></label>
                                <input type="text" class="form-control" name="course_name" id="course_name"required>
                            </div>

                            <div class="form-group col-md-6">
                            <label for="course_image" class="form-label"><h6>Course Image<span>*</span></h6></label>
                          <input type="file" class="form-control" name="course_image" id="course_image" accept="image/*" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="course_share_image" class="form-label"><h6>Course Share Image <span>*</span></h6></label>
                                <input type="file" class="form-control" name="course_share_image" id="course_share_image" accept="image/*" required>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="course_banner_image" class="form-label"><h6>Course Banner Image <span>*</span></h6></label>
                                <input type="file" class="form-control" name="course_banner_image" id="course_banner_image" accept="image/*" required>
                            </div>
                        </div>

                          <!-- <label for="course_share_description" class="form-label">Course share discription</label>
                          <textarea class="form-control" name="course_share_description" id="course_share_description" rows="3" required></textarea> -->

                          <div class="row">
                            <div class="form-group mt-3 col-md-6">
                            <label for="related_course[]" class="form-label"><h6>Related Courses <span>*</span></h6></label>
                            <select class="form-control select2" multiple="" name="related_course[]" id="related_course" required>
                                <?php
                                    $course_qry=mysqli_query($conn,"select course_id,course_name from courses where status='1'") or die(mysqli_error($conn));
                                    while($res=mysqli_fetch_object($course_qry)){
                                        ?>
                                    <option value="<?php echo $res -> course_name?>"><?php echo $res -> course_name?></option>
                                    <?php
                                    }
                                    ?>
                            </select>
                            </div>
                            
                            <div class="form-group mt-3 col-md-6">
                                <label for="instructor" class="form-label"><h6>Instructor <span>*</span></h6></label>
                                <select class="form-select" aria-label="Default select example" name="instructor" id="instructor" required>
                                    <option selected>Select instructor</option>
                                    <?php
                                    $instructor_qry=mysqli_query($conn,"select instructor_id,instructor_name from instructors where status='1'") or die(mysqli_error($conn));
                                    while($res=mysqli_fetch_object($instructor_qry)){
                                        ?>
                                    <option value="<?php echo $res -> instructor_id?>"><?php echo $res -> instructor_name?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                          
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="iframe_url" class="form-label"><h6>Iframe Url <span>*</span></h6></label>
                                <input type="text" class="form-control" name="iframe_url" id="iframe_url">
                            </div>

                            <div class="form-group col-md-4">
                                <label for="lessons" class="form-label"><h6>Lessons <span>*</span></h6></label>
                                <input type="number" class="form-control" name="lessons" id="lessons">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="students" class="form-label"><h6>Students <span>*</span></h6></label>
                                <input type="number" class="form-control" name="students" id="students">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="course_des" class="form-label"><h6>Course Description <span>*</span></h6></label>
                            <textarea class="form-control" name="course_des" id="course_des" rows="3"required></textarea>
                        </div>

                        <div class="d-flex justify-content-center mt-4">
                          <button type="submit" name="save" class="btn btn-primary">Submit</button>
                        </div>

                        </form>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h4>Courses Data</h4>
                    </div>
                    <div class="card-body">
                    <div class="table-responsive">

                    <table id="courses_table" class="table table-striped table-bordered">
                        <thead>
                        <th>S.No</th>
                            <th>Course Name</th>
                            <th>Course Description</th>
                            <th>Course Image</th>
                            <th>Course Share Image</th>
                            <th>Course Banner Image</th>
                            <th>Course share discription</th>
                            <th>Related Courses</th>
                            <th>Iframe URL</th>
                            <th>Instructor</th>
                            <th>Lessons</th>
                            <th>Students</th>
                            <th>Action</th>
                        </tr>
                        <tbody id="courseTableBody">

                        </tbody>
                    </table>
                    </div>
                    </div>
                </div>
                <!-- <script>
                    $(document).ready(function(){
                        
                    });
                </script> -->
                <!-- <div class="card">
                    <div class="card-header">
                        <h4>Course Table Data</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div id="save-stage_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                    <div class="dataTables_length" id="save-stage_length">
                                        <label>Show 
                                            <select name="save-stage_length" aria-controls="save-stage" class="form-control form-control-sm">
                                                <option value="10">10</option>
                                                <option value="25">25</option>
                                                <option value="50">50</option>
                                                <option value="100">100</option>
                                            </select>
                                            entries</label>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div id="save-stage_filter" class="dataTables_filter">
                                        <label>Search:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="save-stage"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                        <div class="dataTables_scrollBody" style="position: relative; overflow: auto; width: 100%;">
                                            <table class="table table-striped table-hover dataTable no-footer" id="save-stage" style="width: 100%;" role="grid" aria-describedby="save-stage_info">
                                                <tr>
                                                  <th>S.No</th>
                                                    <th>Course Name</th>
                                                    <th>Course Description</th>
                                                    <th>Course Image</th>
                                                    <th>Course Share Image</th>
                                                    <th>Course Banner Image</th>
                                                    <th>Course share discription</th>
                                                    <th>Related Courses</th>
                                                    <th>Iframe URL</th>
                                                    <th>Instructor</th>
                                                    <th>Lessons</th>
                                                    <th>Students</th>
                                                    <th>Action</th>
                                                </tr>
                                                <tbody id="courseTableBody">

                                                </tbody>
                                            </table>
                                        </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-5">
                                    <div class="dataTables_info" id="save-stage_info" role="status" aria-live="polite">Showing 1 to 10 of 57 entries</div>
                                </div>
                                <div class="col-sm-12 col-md-7">
                                    <div class="dataTables_paginate paging_simple_numbers" id="save-stage_paginate">
                                        <ul class="pagination">
                                            <li class="paginate_button page-item previous disabled" id="save-stage_previous">
                                                <a href="#" aria-controls="save-stage" data-dt-idx="0" tabindex="0" class="page-link">Previous</a>
                                            </li>
                                            <li class="paginate_button page-item active">
                                                <a href="#" aria-controls="save-stage" data-dt-idx="1" tabindex="0" class="page-link">1</a>
                                            </li>
                                            <li class="paginate_button page-item ">
                                                <a href="#" aria-controls="save-stage" data-dt-idx="2" tabindex="0" class="page-link">2</a>
                                            </li>
                                            <li class="paginate_button page-item ">
                                                <a href="#" aria-controls="save-stage" data-dt-idx="3" tabindex="0" class="page-link">3</a>
                                            </li>
                                            <li class="paginate_button page-item ">
                                                <a href="#" aria-controls="save-stage" data-dt-idx="4" tabindex="0" class="page-link">4</a>
                                            </li>
                                            <li class="paginate_button page-item ">
                                                <a href="#" aria-controls="save-stage" data-dt-idx="5" tabindex="0" class="page-link">5</a>
                                            </li>
                                            <li class="paginate_button page-item ">
                                                <a href="#" aria-controls="save-stage" data-dt-idx="6" tabindex="0" class="page-link">6</a>
                                            </li>
                                            <li class="paginate_button page-item next" id="save-stage_next">
                                                <a href="#" aria-controls="save-stage" data-dt-idx="7" tabindex="0" class="page-link">Next</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>
        </section>
</div>
<!-- <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!--footer-->
<?php include 'footer.php'?>

    <script>
    
        $(document).ready(function () {

        $("#addcourse").submit(function (e) {
            e.preventDefault();
            // var isValid = true;
        // $(this).find("input, textarea, select").each(function () {
        //     if ($(this).prop('required') && $(this).val() === "") {
        //         isValid = false;
        //         return false; // Exit the loop early
        //     }
        // });

        // if (!isValid) {
        //     // Show SweetAlert for validation error
        //     Swal.fire({
        //         icon: 'error',
        //         title: 'Validation Error',
        //         text: 'Please fill in all the required fields!',
        //         confirmButtonText: 'OK'
        //     });
        //     return;
        // }
            var formData = new FormData(this);
            var url = ($("#course_id").val() !== "") ? "http://localhost/admin_template/update_course.php" : "http://localhost/admin_template/insert_course.php";

            $.ajax({
                type: "POST",
                url: url,
                data: formData,
                contentType: false,
                processData: false,
                success: function (data) {
                    $('#addcourse')[0].reset();
                    $("#course_id").val("");
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
                url: "http://localhost/admin_template/fetch_courses.php",
                success: function (data) {
                    $("#courseTableBody").empty();
                    var courses = JSON.parse(data);
                    var serialNumber = 1;
                    courses.forEach(function (course) {

                    var row = "<tr id='courseRow_" + course.course_id + "'>";
                    row += "<td>" + serialNumber + "</td>";
                    serialNumber++;

                    // Other columns
                    row += "<td>" + course.course_name + "</td><td>" + course.course_description + "</td>";
                        
                        if (course.course_image) {
                            row += "<td><img src='" + course.course_image + "' alt='Course Image' style='max-width: 100px; max-height: 100px;'></td>";
                        } else {
                            row += "<td>No Image</td>";
                        }
                        if (course.course_share_image) {
                            row += "<td><img src='" + course.course_share_image + "' alt='Course Share Image' style='max-width: 100px; max-height: 100px;'></td>";
                        } else {
                            row += "<td>No Image</td>";
                        }
                        if (course.course_banner_image) {
                            row += "<td><img src='" + course.course_banner_image + "' alt='Course banner Image' style='max-width: 100px; max-height: 100px;'></td>";
                        } else {
                            row += "<td>No Image</td>";
                        }
                        

                        row += "<td>" + course.course_share_desc + "</td>";
                        row += "<td>" + course.related_courses + "</td>";
                        row += "<td>" + course.iframe_url + "</td>";
                        row += "<td>" + course.instructor_id + "</td>";
                        row += "<td>" + course.lessons + "</td>";
                        row += "<td>" + course.students + "</td>";

                        // row += "<td><button class='btn btn-info btn-sm' onclick='updateCourse(" + course.course_id + ")'>Update</button><button class='btn btn-danger btn-sm' onclick='deleteCourse(" + course.course_id + ")'>Delete</button></td>";
                        row += "<td><div class='dropdown'><a href='#' data-bs-toggle='dropdown' class='btn dropdown-toggle' aria-expanded='false'>Options</a><div class='dropdown-menu' style=''><button class='btn btn-sm' onclick='updateCourse(" + course.course_id + ")'><i class='far fa-edit'></i>Update</button><div class='dropdown-divider'></div><button class='btn btn-sm' onclick='deleteCourse(" + course.course_id + ")'><i class='far fa-trash-alt'></i>Delete</button></div></td>";
                        // row += "<td></td>";

                        row += "</tr>";

                        $("#courseTableBody").append(row);
                    });
                },
                error: function (xhr, status, error) {
                    console.error("Error fetching data:", status, error);
                }
            });
        }

        fetchInsertedData();
        $("#courses_table").DataTable();
        

        window.updateCourse = function (courseId) {
            $.ajax({
                type: "GET",
                url: "http://localhost/admin_template/update_fetch_course.php?course_id=" + courseId,
                success: function (data) {
                    var courseData = JSON.parse(data);

                    $("#course_id").val(courseData.course_id);
                    $("#course_name").val(courseData.course_name);
                    $("#course_des").val(courseData.course_description);
                    $("#course_share_description").val(courseData.course_share_desc);
                    var relatedCourses = courseData.related_courses.split(',').map(function(item) {
                        return item.trim();
                    });
                    $("#related_course").val(relatedCourses).trigger('change');
                    $("#iframe_url").val(courseData.iframe_url);
                    $("#instructor").val(courseData.instructor_id);
                    $("#lessons").val(courseData.lessons);
                    $("#students").val(courseData.students);

                    // Scroll to the top of the form for better visibility
                    $('html, body').animate({
                        scrollTop: $("#addcourse").offset().top
                    }, 500);
                },
                error: function (xhr, status, error) {
                    console.error("Error fetching course data for update:", status, error);
                }
            });
        }

        $('#related_course').select2();
        window.deleteCourse = function (courseId) {
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
                    url: "http://localhost/admin_template/delete_course.php?course_id=" + courseId,
                    success: function (data) {
                        console.log(data);
                        fetchInsertedData(); 
                    },
                    error: function (xhr, status, error) {
                        console.error("Error deleting course:", status, error);
                    }
                    });
                }
            });
        }

        });

    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    </body>
</html>
