<?php
require_once("config.php");
?>

<!DOCTYPE html>
<html lang="en">

<body>

<?php
$sql = "SELECT * FROM counts  ORDER BY count_id DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table id='count-table' class='table table-striped table-bordered'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>SNo</th>";
    echo "<th>Finished Sessions</th>";
    echo "<th>Online Enrollment</th>";
    echo "<th>Subjects Taught</th>";
    echo "<th>Satisfaction Rate</th>";
    echo "<th>CDT</th>";
    echo "<th>Action</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";

    $count = 0;
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" .++$count. "</td>";
        echo "<td>" . $row["finished_sessions"] . "</td>";
        echo "<td>" . $row["online_enrollment"] . "</td>";
        echo "<td>" . $row["subjects_taught"] . "</td>";
        echo "<td>" . $row["satisfaction_rate"] . "</td>";
        echo "<td>" . $row["created_date_time"] . "</td>";
        echo "<td>";
        echo "<div class='dropdown'>";
        echo "<a href='#' data-bs-toggle='dropdown' class='btn dropdown-toggle' aria-expanded='false'><i class='fa fa-ellipsis-v'
        aria-hidden='true'></i></a>";
        echo "<div class='dropdown-menu' style=''>";
        echo "<a href='#' class='dropdown-item has-icon updateBtn'   data-id='" . $row['count_id'] . "' data-finished='" . $row['finished_sessions'] . "' data-online='" . $row['online_enrollment'] . "' data-subjects='" . $row['subjects_taught'] . "' data-satisfaction='" . $row['satisfaction_rate'] . "'><i class='far fa-edit'></i> Update</a>";
        
        echo "<div class='dropdown-divider'></div>";
        echo "<a href='#' class='dropdown-item has-icon deleteBtn' data-id='" . $row['count_id'] ."'><i class='far fa-trash-alt'></i> Delete</a>";
        echo "</div>";
        echo "</div>";
        echo "</td>";

        echo "</tr>";
    }

    echo "</tbody>";
    echo "</table>";
} else {
    echo "<p>No counts found.</p>";
}

$conn->close();
?>

<!-- Initialize DataTables -->
<script>
    $(document).ready(function () {
        $('#count-table').DataTable({
            "pagingType": "full_numbers", // Add pagination with next and previous buttons
            "lengthMenu": [10, 25, 50, 75, 100], // Show entries dropdown
            "pageLength": 10, // Default number of rows per page
            "order": [[0, 'asc']], // Order by the first column (SNo in this case)
        });
    });
</script>

</body>
</html>
