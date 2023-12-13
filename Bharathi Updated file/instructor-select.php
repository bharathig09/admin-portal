<?php
require_once("config.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> -->

</head>
<body>

<?php
$sql = "SELECT * FROM instructors where status='1' ORDER BY instructor_id DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table id='instructor-table' class='table table-striped table-bordered'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>SNo</th>";
    echo "<th>Name</th>";
    echo "<th>Description</th>";
    echo "<th>Designation</th>";
    echo "<th>Profile Image</th>";
    echo "<th>CDT</th>";
    echo "<th>Action</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";

    $count = 0;
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" .++$count. "</td>";
        echo "<td>" . $row["instructor_name"] . "</td>";
        echo "<td>" . $row["about_instructor"] . "</td>";
        echo "<td>" . $row["instructor_designation"] . "</td>";
        echo "<td><img src='images/" . $row["instructor_profile_image"] . "' alt='" . $row["instructor_name"] . "' width='100px' height='100px'></td>";
        echo "<td>" . $row["modify_date_time"] . "</td>";
        echo "<td>";
        echo "<div class='dropdown'>";
        echo "<a href='#' data-bs-toggle='dropdown' class='btn dropdown-toggle' aria-expanded='false'><i class='fa fa-ellipsis-v'
        aria-hidden='true'></i></a>";
        echo "<div class='dropdown-menu' style=''>";
        echo "<a href='#' class='dropdown-item has-icon updateBtn' data-id='" . $row['instructor_id'] . "' data-name='" . $row['instructor_name'] . "' data-about='" . $row['about_instructor'] . "' data-desg='" . $row['instructor_designation'] . "' data-image='" . $row['instructor_profile_image'] . "'><i class='far fa-edit'></i> Edit</a>";
        
        echo "<div class='dropdown-divider'></div>";
        echo "<a href='#' class='dropdown-item has-icon text-danger deleteBtn' data-id='" . $row['instructor_id'] ."'><i class='far fa-trash-alt'></i> Delete</a>";
        echo "</div>";
        echo "</div>";
        echo "</td>";

        echo "</tr>";
    }

    echo "</tbody>";
    echo "</table>";
} else {
    echo "<p>No instructors found.</p>";
}

$conn->close();
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

<!-- Initialize DataTables -->
<script>
    $(document).ready(function () {
        $('#instructor-table').DataTable({
            "pagingType": "full_numbers", // Add pagination with next and previous buttons
            "lengthMenu": [10, 25, 50, 75, 100], // Show entries dropdown
            "pageLength": 10, // Default number of rows per page
            "order": [[0, 'asc']], // Order by the first column (SNo in this case)
        });
    });
</script>

</body>
</html>