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
                    <h4 class="page-title m-b-0">Reach Us</h4>
                </li>
                <li class="breadcrumb-item">
                    <a href="menu.php">
                        <i data-feather="home"></i></a>
                </li>
                <li class="breadcrumb-item">Contact</li>
            </ul>

            <div class="card">
                <div class="card-body">
                    <h2 class="card-title">Reach Us</h2>

                    <form method="POST" id="formData">

                    <div class="row">
                        <div class="col-md-6">
                        <div class="form-group">
                            <label for="social_tags_url">Contact Name:</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        </div>

                        <div class="col-md-6">
                        <div class="form-group">
                            <label for="social_tags_type">Contact Email:</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        </div>

                        <div class="col-md-6">
                        <div class="form-group">
                            <label for="social_tags_type">Contact Subject:</label>
                            <input type="text" class="form-control" id="subject" name="subject" required>
                        </div>
                        </div>

                        <div class="col-md-6">
                        <div class="form-group">
                            <label for="social_tags_type">Contact Message:</label>
                            <textarea class="form-control" id="message" name="message" required></textarea>
                        </div>
                        </div>

                        <div class="col-md-6">
                        <div class="form-group">
                            <label for="social_tags_type">Email Header:</label>
                            <textarea class="form-control" id="email_header" name="email_header" required></textarea>
                        </div>
                        </div>

                        <input type="hidden" class="hid" name="hid">

                        <div class="col-md-12">
                        <button type="submit" id="save" name="save" class="btn btn-primary float-end">submit</button>
                    </div>

                    </div>

                    </form>
                </div>
            </div>

        </section>

        <div class="card">
            <div class="card-header">
                <p class="h4"><strong>Contact Table</strong></p>
            </div>
            <div class="card-body" id="myTable">

            </div>

        </div>

    </div>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function () {
            $("#formData").submit(function (event) {
                event.preventDefault();

            var name = $('#name').val();
            var email = $('#email').val();
            var subject = $('#subject').val();
            var message = $('#message').val();
            var header = $('#email_header').val();


            if (!name || !email || !subject || !message ||!header) {
                Swal.fire({
                    icon: 'error',
                    title: 'Validation Error!',
                    text: 'All fields are required!',
                });
                return;
            }

                console.log("Form submitted");

                $.ajax({
                    url: "http://localhost/Admin/reach_us-insert.php",
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
                        initializeDataTable();
                    },
                    error: function (xhr, status, error) {
                        console.log("Error:", status, error);
                    }
                });
            });

            function initializeDataTable() {
                if (!$.fn.dataTable.isDataTable('#contact-table')) {
                $('#contact-table').DataTable({
                    "pagingType": "full_numbers",
                    "lengthMenu": [10, 25, 50, 75, 100],
                    "pageLength": 10,
                    "order": [[0, 'asc']],
                });

            }
            }

            initializeDataTable();

            $('#myTable').on('click', '.updateBtn', function () {

                var id = $(this).data('id');
                var name = $(this).data('name');
                var email = $(this).data('email');
                var subject = $(this).data('subject');
                var message = $(this).data('message');
                var email_header = $(this).data('header');

                $('#name').val(name);
                $('#email').val(email);
                $('#subject').val(subject);
                $('#message').val(message);
                $('#email_header').val(email_header);
                $('.hid').val(id);

            });

            $('#myTable').on('click', '.deleteBtn', function () {
                var contact_id = $(this).data('id');

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
                            url: "http://localhost/Admin/reach_us-delete.php",
                            type: "POST",
                            data: {
                                action: 'delete',
                                hid: contact_id
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
                    url: "http://localhost/Admin/reach_us-select.php",
                    type: "GET",
                    success: function (data) {
                        $('#myTable').html(data);
                        initializeDataTable();
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
