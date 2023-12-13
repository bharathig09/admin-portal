<?php
require_once("config.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instructors Table</title>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> -->

    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"> -->
</head>

<body>

    <?php
    $sql = "SELECT * FROM reach_us ORDER BY contact_id DESC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table id='contact-table' class='table table-striped table-bordered'>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>SNo</th>";
        echo "<th>Contact Name</th>";
        echo "<th>Contact Email</th>";
        echo "<th>Contact Subject</th>";
        echo "<th>Contact Message</th>";
        echo "<th>Email Header</th>";
        echo "<th>CDT</th>";
        echo "<th>Action</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";

        $count = 0;
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . ++$count . "</td>";
            echo "<td>" . $row["contact_name"] . "</td>";
            echo "<td>" . $row["contact_email"] . "</td>";
            echo "<td>" . $row["contact_subject"] . "</td>";
            echo "<td>" . $row["contact_message"] . "</td>";
            echo "<td>" . $row["email_headers"] . "</td>";
            echo "<td>" . $row["created_date_time"] . "</td>";
            echo "<td>";
            echo "<div class='dropdown'>";
            echo "<a href='#' data-bs-toggle='dropdown' class='btn dropdown-toggle' aria-expanded='false'><i class='fa fa-ellipsis-v'
            aria-hidden='true'></i></a>";
            echo "<div class='dropdown-menu' style=''>";
            echo "<a href='#' class='dropdown-item has-icon updateBtn'   data-id='" . $row['contact_id'] . "' data-name='" . $row['contact_name'] . "' data-email='" . $row['contact_email'] . "' data-subject='" . $row['contact_subject'] . "' data-message='" . $row['contact_message'] . "' data-header='" . $row['email_headers'] ."'><i class='far fa-edit'></i>Update</a>";

            echo "<div class='dropdown-divider'></div>";
            echo "<a href='#' class='dropdown-item has-icon deleteBtn' data-id='" . $row['contact_id'] . "'><i class='far fa-trash-alt'></i> Delete</a>";
            echo "</div>";
            echo "</div>";
            echo "</td>";

            echo "</tr>";
        }

        echo "</tbody>";
        echo "</table>";
    } else {
        echo "<p>No Contacts found.</p>";
    }

    $conn->close();
    ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

<!-- <script> -->
    <!-- // $(document).ready(function () {
    //     $('#contact-table').DataTable({
    //         "pagingType": "full_numbers", // Add pagination with next and previous buttons
    //         "lengthMenu": [10, 25, 50, 75, 100], // Show entries dropdown
    //         "pageLength": 10, // Default number of rows per page
    //         "order": [[0, 'asc']], // Order by the first column (SNo in this case)
    //     });
    // }); -->
<!-- </script> -->
</body>
</html>