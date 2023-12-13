

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
                            <label for="course_name" class="form-label">Course Name</label>
                            <input type="text" class="form-control" name="course_name" id="course_name">
                    
                            <label for="course_des" class="form-label">Course Description</label>
                            <textarea class="form-control" name="course_des" id="course_des" rows="3"></textarea>

                            <label for="course_image" class="form-label">Course Image</label>
                            <input type="file" class="form-control" name="course_image" id="course_image" accept="image/*">

                            <label for="course_share_image" class="form-label">Course Share Image</label>
                            <input type="file" class="form-control" name="course_share_image" id="course_share_image" accept="image/*">

                            <!-- <label for="course_banner_image" class="form-label">Course Banner Image</label>
                            <input type="file" class="form-control" name="course_banner_image" id="course_banner_image" accept="image/*"> -->

                            <label for="course_share_description" class="form-label">Course share discription</label>
                            <textarea class="form-control" name="course_share_description" id="course_share_description" rows="3"></textarea>

                            <!-- <label for="related_course[]" class="form-label">Related Courses</label>
                            <select class="form-control select2" multiple="" name="related_course[]" id="related_course">
                            <option>JAVA</option>
                            <option>.NET</option>
                            <option>REACT</option>
                            <option>PHYTHON</option>
                            <option>PHP</option>
                            <option>NODE.JS</option>
                            <option>DATA SCIENCE</option>
                            <option>DATA ANALYTICS</option>
                            </select> -->

                            <!-- <label for="iframe_url" class="form-label">Iframe Url</label>
                            <input type="text" class="form-control" name="iframe_url" id="iframe_url"> -->

                            <!-- <label for="lessons" class="form-label">Lessons</label>
                            <input type="text" class="form-control" name="lessons" id="lessons"> -->

                            <div class="d-grid mt-4">
                            <button type="submit" name="save" class="btn btn-primary">Submit</button>
                            </div>
                            
                            <!-- <label for="course_image" class="form-label">Course Image</label>
                            <input type="file" class="form-control" name="course_image" id="course_image"> -->

                        </form>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h4>Table With State Save</h4>
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
                                    <!-- <div class="dataTables_scroll">
                                        <div class="dataTables_scrollHead" style="overflow: hidden; position: relative; border: 0px; width: 100%;">
                                            <div class="dataTables_scrollHeadInner" style="box-sizing: content-box; width: 898.8px; padding-right: 0px;">
                                                <table class="table table-striped table-hover dataTable no-footer" style="width: 898.8px; margin-left: 0px;" role="grid">
                                                    <thead>
                                                    
                                                    </thead>
                                                </table>
                                            </div> -->
                                        <!-- </div> -->
                                        <div class="dataTables_scrollBody" style="position: relative; overflow: auto; width: 100%;">
                                            <table class="table table-striped table-hover dataTable no-footer" id="save-stage" style="width: 100%;" role="grid" aria-describedby="save-stage_info">
                                                <tr>
                                                    <th>Course Name</th>
                                                    <th>Course Description</th>
                                                    <th>Course Image</th>
                                                    <th>Course Share Image</th>
                                                    <!-- <th>Course Banner Image</th> -->
                                                    <th>Course share discription</th>
                                                    <!-- <th>Related Courses</th> -->
                                                </tr>
                                                <tbody id="courseTableBody">

                                                </tbody>
                                            </table>
                                        </div>
                                    <!-- </div> -->
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
                </div>
            </div>
        </section>
    </div>


<?php include 'footer.php'?>
    <script>
    
    $(document).ready(function () {
    // $("#addcourse").submit(function (e) {
    //     e.preventDefault();
    //     $.ajax({
    //         type: "POST",
    //         url: "http://localhost/admin_template/insert_course.php",
    //         data: $(this).serialize(),
    //         success: function (data) {
    //             $('#addcourse')[0].reset();
    //             console.log(data);
    //             fetchInsertedData();
    //         },
    //         error: function (error) {
    //             console.error(error); 
    //         }
    //     });
    // });
    
    $("#addcourse").submit(function (e) {
        e.preventDefault();

        var formData = new FormData(this);

        $.ajax({
            type: "POST",
            url: "http://localhost/admin_template/insert_course.php",
            data: formData,
            contentType: false, 
            processData: false,
            success: function (data) {
                $('#addcourse')[0].reset();
                console.log(data);
                fetchInsertedData();
            },
            error: function (error) {
                console.error(error);
            }
        });
    });

    // function fetchInsertedData() {
    //     $.ajax({
    //         type: "GET", 
    //         url: "http://localhost/admin_template/fetch_courses.php", 
    //         success: function (data) {
    //             $("#courseTableBody").empty();
    //             var courses = JSON.parse(data);
    //             courses.forEach(function (course) {
    //                 $("#courseTableBody").append("<tr><td>" + course.course_name + "</td><td>" + course.course_description + "</td></tr>");
    //             });
    //         },
    //         error: function (error) {
    //             console.error(error);
    //         }
    //     });
    // }

    function fetchInsertedData() {
        $.ajax({
            type: "GET",
            url: "http://localhost/admin_template/fetch_courses.php",
            success: function (data) {
                $("#courseTableBody").empty();
                var courses = JSON.parse(data);
                courses.forEach(function (course) {
                    var row = "<tr><td>" + course.course_name + "</td><td>" + course.course_description + "</td>";
                    
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
                    // if (course.course_banner_image) {
                    //     row += "<td><img src='" + course.course_banner_image + "' alt='Course Banner Image' style='max-width: 100px; max-height: 100px;'></td>";
                    // } else {
                    //     row += "<td>No Image</td>";
                    // }

                    row += "<td>" + course.course_share_desc + "</td>";
                    // row += "<td>" + course.related_courses + "</td>";

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
});

  </script>
</body>

</html>