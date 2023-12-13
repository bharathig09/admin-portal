<?php include 'header.php'; ?>
<div class="main-content">
        <section class="section">
          <ul class="breadcrumb breadcrumb-style ">
            <li class="breadcrumb-item">
              <h4 class="page-title m-b-0">Access Key</h4>
            </li>
            <li class="breadcrumb-item">
              <a href="dashboard.html">
                <i data-feather="home"></i></a>
            </li>
            <li class="breadcrumb-item">Access Key</li>
          </ul>
            <div class="section-body">

                <!-- <div class="container mt-5">
                    <div class="row justify-content-center"> -->
                        <div class="card">
                            <div class="card-header">
                                <h4>Access Key</h4>
                            </div>
                            <div class="card-body">
                                <form method="POST" class="mt-4" id="accesskey">
                                    <input type="hidden" name="access_key_id" id="access_key_id">

                                    <div class="form-group">
                                    <label for="access_key" class="form-label"><h6>Access Key <span>*</span></h6></label>
                                    <input type="text" class="form-control" name="access_key" id="access_key">
                                    </div>
                            
                                    <div class="d-flex justify-content-center mt-4">
                                    <button type="submit" name="save" class="btn btn-primary">Submit</button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    <!-- </div>
                </div> -->
                
                <div id="accesskeytablediv"></div>

            </div>
        </section>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!--footer-->
<?php include 'footer.php'?>

<script>

$(document).ready(function () {

    $("#accesskey").submit(function (e) {
        e.preventDefault();
        if ($("#access_key").val().trim() === "") {
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'Please enter the Access Key!',
            });
            return;
        }
        
        var formData = new FormData(this);
        var url = ($("#access_key_id").val() !== "") ? "http://localhost/admin_template/update_access_key.php" : "http://localhost/admin_template/insert_access_key.php";

        $.ajax({
            type: "POST",
            url: url,
            data: formData,
            contentType: false,
            processData: false,
            success: function (data) {
                $('#accesskey')[0].reset();
                $("#access_key_id").val("");
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
            url: "http://localhost/admin_template/fetch_access_key.php",
            // success: function (data) {
            //     $("#accessKeyTableBody").empty();
            //     var accesskeys = JSON.parse(data);
            //     var serialNumber = 1;
            //     accesskeys.forEach(function (access_key) {

            //     var row = "<tr id='access_keyRow_" + access_key.access_key_id + "'>";
            //     row += "<td>" + serialNumber + "</td>";
            //     serialNumber++;

            //     // Other columns
            //     row += "<td>" + access_key.access_key + "</td>";
            //     // row += "<td><button class='btn btn-info btn-sm' onclick='updateaccesskey(" + access_key.access_key_id + ")'>Update</button><button class='btn btn-danger btn-sm' onclick='deleteaccesskey(" + access_key.access_key_id + ")'>Delete</button></td>";
            //     // row += "<td></td>";
            //     row += "<td><div class='dropdown'><a href='#' data-bs-toggle='dropdown' class='btn dropdown-toggle' aria-expanded='false'>Options</a><div class='dropdown-menu' style=''><button class='btn btn-sm' onclick='updateaccesskey(" + access_key.access_key_id + ")'><i class='far fa-edit'></i>Update</button><div class='dropdown-divider'></div><button class='btn btn-sm' onclick='deleteaccesskey(" + access_key.access_key_id + ")'><i class='far fa-trash-alt'></i>Delete</button></div></td>";

            //         row += "</tr>";

            //         $("#accessKeyTableBody").append(row);
            //     });
            // },
            // error: function (xhr, status, error) {
            //     console.error("Error fetching data:", status, error);
            // }
            success: function (data) {
                $('#accesskeytablediv').html(data)
            }
        });
    }

    fetchInsertedData();
    $("#access_key_table").DataTable({
        "pagingType": "full_numbers", 
        "lengthMenu": [10, 25, 50, 75, 100], 
        "pageLength": 10, 
        "order": [[0, 'asc']], 
    });

    window.updateaccesskey = function (accessKeyId) {
            $.ajax({
                type: "GET",
                url: "http://localhost/admin_template/update_fetch_access_key.php?access_key_id=" + accessKeyId,
                success: function (data) {
                    var accessKeyData = JSON.parse(data);

                    $("#access_key_id").val(accessKeyData.access_key_id);
                    $("#access_key").val(accessKeyData.access_key);
                    
                    $('html, body').animate({
                        scrollTop: $("#accesskey").offset().top
                    }, 500);
                },
                error: function (xhr, status, error) {
                    console.error("Error fetching course data for update:", status, error);
                }
            });
    }

    window.deleteaccesskey = function (accessKeyId) {
        
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
            url: "http://localhost/admin_template/delete_access_key.php?access_key_id=" + accessKeyId,
            success: function (data) {
                console.log(data);
                fetchInsertedData();
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Acess key deleted successfully!',
                    showConfirmButton: false,
                    timer: 1500
                });
            },
            error: function (xhr, status, error) {
                console.error("Error deleting access key:", status, error);
            }
            });
        }
    });
    }
});
</script>

</body>
</html>