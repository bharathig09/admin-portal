
<?php 

include_once("header.php");


?>
<body>

<div class="main-content">
    <section class="section">
    <ul class="breadcrumb breadcrumb-style ">
        <li class="breadcrumb-item">
          <h4 class="page-title m-b-0">Meta</h4>
        </li>
        <li class="breadcrumb-item">
          <a href="menu.php">
            <i data-feather="home"></i></a>
        </li>
        <li class="breadcrumb-item">Meta</li>
    </ul>

    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Meta</h4>

            <form method="POST" id="formData">

            <div class="row">
            <div class="col-md-6">
            <div class="form-group">
                <label for="meta_name">Name</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>
            </div>

            <div class="col-md-6">
            <div class="form-group">
                <label for="social_tags_type">Property</label>
                <input type="text" class="form-control" id="property" name="property">
            </div>
            </div>

            <div class="col-md-6">
            <div class="form-group">
                <label for="social_tags_type">Content</label>
                <input type="text" class="form-control" id="content" name="content">
            </div>
            </div>


            <div class="col-md-6">
            <div class="form-group">
            <label for="instructor_id" class="required-field">Menu</label>
            <select class="form-control" id="menu_id" name="menu_id">
                <option>Select Menu</option>
                <?php
                require_once("config.php");

                $result = $conn->query("SELECT menu_id, menu_name FROM menus WHERE status = '1'");

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row["menu_id"] . "'>" . $row["menu_name"] . "</option>";
                    }
                } else {
                    echo "<option value='' disabled>No menus available</option>";
                }          
            
            ?>
            </select>
            </div>
            </div>

            <div class="col-md-6">
            <div class="form-group">
            <label for="instructor_id" class="required-field">Tag</label>
            <select class="form-control" id="tag_id" name="tag_id">
                <option>Select Menu</option>
                <?php
                require_once("config.php");

                $result = $conn->query("SELECT tag_id, tag_name FROM tags WHERE status = '1'");

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row["tag_id"] . "'>" . $row["tag_name"] . "</option>";
                    }
                } else {
                    echo "<option value='' disabled>No tags available</option>";
                }          
            
            ?>
            </select>
            </div>
            </div>

            <div class="col-md-6">
            <div class="form-group">
            <label for="instructor_id" class="required-field">Course</label>
            <select class="form-control" id="course_id" name="course_id">
                <option>Select Menu</option>
                <?php
                require_once("config.php");

                $result = $conn->query("SELECT course_id, course_name FROM courses WHERE status = '1'");

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row["course_id"] . "'>" . $row["course_name"] . "</option>";
                    }
                } else {
                    echo "<option value='' disabled>No courses available</option>";
                }          
            
            ?>
            </select>
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
            <p class="h4 font-weight-bold"><strong>Meta Table</strong</p>

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
            var name = $('#name').val();
            var property = $('#property').val();
            var content = $('#content').val();
            var menu = $('#menu_id').val();
            var tag = $('#tag_id').val();
            var course = $('#course_id').val();


            if (!name || !property || !content || !menu || !tag ||!course) {
                Swal.fire({
                    icon: 'error',
                    title: 'Validation Error!',
                    text: 'All fields are required!',
                });
                return;
            }
        
        console.log("Form submitted");

        $.ajax({
            url: "http://localhost/Admin/meta-insert.php",
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
        var name=$(this).data('name');
        var property=$(this).data('property');
        var content=$(this).data('content');
        var menu=$(this).data('menu');
        var tag=$(this).data('tag');
        var course=$(this).data('course');


        $('#name').val(name);
        $('#property').val(property);
        $('#content').val(content);
        $('#menu').val(menu);
        $('#tag').val(tag);
        $('#course').val(course);
        $('.hid').val(id);


    });

    $('#myTable').on('click', '.deleteBtn', function () {
            var meta_id = $(this).data('id');

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
                        url: "http://localhost/Admin/meta-delete.php",
                        type: "POST",
                        data: {
                            action: 'delete',
                            hid: meta_id
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
            url: "http://localhost/Admin/meta-select.php",
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

