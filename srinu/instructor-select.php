<?php
require_once("config.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    
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
        echo "<td>" . $row["created_date_time"] . "</td>";
        echo "<td>";
        echo "<div class='dropdown'>";
        echo "<a href='#' data-bs-toggle='dropdown' class='btn dropdown-toggle' aria-expanded='false'><i class='fa fa-ellipsis-v'
        aria-hidden='true'></i></a>";
        echo "<div class='dropdown-menu' style=''>";
        echo "<a href='#' class='dropdown-item has-icon updateBtn' data-id='" . $row['instructor_id'] . "' data-name='" . $row['instructor_name'] . "' data-about='" . $row['about_instructor'] . "' data-desg='" . $row['instructor_designation'] . "' data-image='" . $row['instructor_profile_image'] . "'><i class='far fa-edit'></i> Update</a>";
        
        echo "<div class='dropdown-divider'></div>";
        echo "<a href='#' class='dropdown-item has-icon  deleteBtn' data-id='" . $row['instructor_id'] ."'><i class='far fa-trash-alt'></i> Delete</a>";
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


<script>
    $(document).ready(function () {
        $('#instructor-table').DataTable({
            "pagingType": "full_numbers", 
            "lengthMenu": [10, 25, 50, 75, 100], 
            "pageLength": 10, 
            "order": [[0, 'asc']],
        });
    });
</script>

</body>
</html>
