<?php
require_once("config.php");
?>

<!DOCTYPE html>
<html lang="en">
<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> -->

<body>

<?php
$sql = "SELECT ist.*, i.instructor_name FROM instructor_social_tags ist JOIN instructors i ON ist.instructor_id = i.instructor_id WHERE ist.status='1' ORDER BY ist.instructor_social_tags_id DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table id='instructor-table' class='table table-striped table-bordered'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>SNo</th>";
    echo "<th>Instructor</th>";
    echo "<th>Social Url</th>";
    echo "<th>Social Types</th>";
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
        echo "<td>" . $row["instructor_social_tags_url"] . "</td>";
        echo "<td>" . $row["instructor_social_tags_type"] . "</td>";
        echo "<td>" . $row["created_date_time"] . "</td>";
        echo "<td>";
        echo "<div class='dropdown'>";
        echo "<a href='#' data-bs-toggle='dropdown' class='btn dropdown-toggle' aria-expanded='false'><i class='fa fa-ellipsis-v'
        aria-hidden='true'></i></a>";
        echo "<div class='dropdown-menu' style=''>";
        echo "<a href='#' class='dropdown-item has-icon updateBtn'  data-hid='" . $row['instructor_social_tags_id'] . "' data-id='" . $row['instructor_id'] . "' data-url='" . $row['instructor_social_tags_url'] . "' data-type='" . $row['instructor_social_tags_type'] . "'><i class='far fa-edit'></i>Update</a>";
        
        echo "<div class='dropdown-divider'></div>";
        echo "<a href='#' class='dropdown-item has-icon  deleteBtn' data-hid='" . $row['instructor_social_tags_id'] ."'><i class='far fa-trash-alt'></i> Delete</a>";
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
            "pagingType": "full_numbers", 
            "lengthMenu": [10, 25, 50, 75, 100], 
            "pageLength": 10, 
            "order": [[0, 'asc']], 
        });
    });
</script>

</body>
</html>
