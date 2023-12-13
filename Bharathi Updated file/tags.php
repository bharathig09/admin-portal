<?php include 'header.php'; ?>
<div class="main-content">
        <section class="section">
          <ul class="breadcrumb breadcrumb-style ">
            <li class="breadcrumb-item">
              <h4 class="page-title m-b-0">Tags</h4>
            </li>
            <li class="breadcrumb-item">
              <a href="dashboard.html">
                <i data-feather="home"></i></a>
            </li>
            <li class="breadcrumb-item">Tags</li>
          </ul>
            <div class="section-body">
                <!-- <div class="container mt-5">
                    <div class="row justify-content-center"> -->
                        <div class="card">
                            <div class="card-header">
                                <h4>Tags</h4>
                            </div>
                            <div class="card-body">
                                <form method="POST" class="mt-4" id="tags">
                                    <input type="hidden" name="tag_id" id="tag_id">

                                    <div class="form-group">
                                        <label for="tag_name" class="form-label"><h6>Tag Name <span>*</span></h6></label>
                                        <input type="text" class="form-control" name="tag_name" id="tag_name">
                                    </div>

                                    <div class="mt-4 d-flex justify-content-center">
                                        <button type="submit" name="save" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    <!-- </div>
                </div> -->

                <!-- Table -->
                <div id="tagstablediv">

                </div>

            </div>
        </section>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script> -->

<!--footer-->
<?php include 'footer.php'?>
<script>

$(document).ready(function () {

    $("#tags").submit(function (e) {
        e.preventDefault();
        var tagName = $('#tag_name').val();

        if (!tagName) {
            Swal.fire({
                icon: 'error',
                title: 'Validation Error!',
                text: 'Tag Name is required!',
            });
            return;
        }
        var formData = new FormData(this);
        var url = ($("#tag_id").val() !== "") ? "http://localhost/admin_template/update_tag.php" : "http://localhost/admin_template/insert_tag.php";

        $.ajax({
            type: "POST",
            url: url,
            data: formData,
            contentType: false,
            processData: false,
            success: function (data) {
                $('#tags')[0].reset();
                $("#tag_id").val("");
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
            url: "http://localhost/admin_template/fetch_tag.php",
            success: function (data) {
                $('#tagstablediv').html(data)
            }
        });
        
    }
    

    fetchInsertedData();

    window.updatetag = function (tagId) {
            $.ajax({
                type: "GET",
                url: "http://localhost/admin_template/update_fetch_tag.php?tag_id=" + tagId,
                success: function (data) {
                    var tagData = JSON.parse(data);

                    $("#tag_id").val(tagData.tag_id);
                    $("#tag_name").val(tagData.tag_name);
                    
                    $('html, body').animate({
                        scrollTop: $("#technologies").offset().top
                    }, 700);
                },
                error: function (xhr, status, error) {
                    console.error("Error fetching course data for update:", status, error);
                }
            });
    }

    
    window.deletetag = function (tagId) {
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
                    url: "http://localhost/admin_template/delete_tag.php?tag_id=" + tagId,
                    success: function (data) {
                        console.log(data);
                        fetchInsertedData();

                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Tag deleted successfully!',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    },
                    error: function (xhr, status, error) {
                        console.error("Error deleting tag:", status, error);
                    }
                });
            }
        });
    }


    
});
</script>


</body>
</html>