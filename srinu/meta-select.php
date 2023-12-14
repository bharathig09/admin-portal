<?php
require_once("config.php");
?>

<!DOCTYPE html>
<html lang="en">

<body>

<?php
$sql = "SELECT * FROM meta where status='1'  ORDER BY meta_id DESC";
$result = $conn->query($sql);

                   
if ($result->num_rows > 0) {
    echo "<table id='count-table' class='table table-striped table-bordered'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>SNo</th>";
    echo "<th>Name</th>";
    echo "<th>Property</th>";
    echo "<th>Content</th>";
    echo "<th>Menu</th>";
    echo "<th>Tag</th>";
    echo "<th>Course</th>";
    echo "<th>Action</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";

    $count = 0;
    while ($row = $result->fetch_assoc()){


            $qry2 = mysqli_query($conn, "select menu_name from menus where status='1' and menu_id='{$row['menu_id']}'") or die(mysqli_error($conn));
             $res2 = mysqli_fetch_assoc($qry2);
        
             $qry3 = mysqli_query($conn, "select tag_name from tags where status='1' and tag_id='{$row['tag_id']}'") or die(mysqli_error($conn));
             $res3 = mysqli_fetch_assoc($qry3);
        
            $qry4 = mysqli_query($conn, "select course_name from courses where status='1' and course_id='{$row['course_id']}'") or die(mysqli_error($conn));
            $res4 = mysqli_fetch_assoc($qry4);   

        echo "<tr>";
        echo "<td>" .++$count. "</td>";
        echo "<td>" . $row["name"] . "</td>";
        echo "<td>" . $row["property"] . "</td>";
        echo "<td>" . $row["content"] . "</td>";
        echo "<td>" . $res2["menu_name"] . "</td>";
        echo "<td>" . $res3["tag_name"] . "</td>";
        echo "<td>" . $res4["course_name"] . "</td>";
        echo "<td>";
        echo "<div class='dropdown'>";
        echo "<a href='#' data-bs-toggle='dropdown' class='btn dropdown-toggle' aria-expanded='false'><i class='fa fa-ellipsis-v'
        aria-hidden='true'></i></a>";
        echo "<div class='dropdown-menu' style=''>";
        echo "<a href='#' class='dropdown-item has-icon updateBtn'   data-id='" . $row['meta_id'] . "' data-name='" . $row['name'] . "' data-property='" . $row['property'] . "' data-content='" . $row['content'] . "' data-menu='" . $row['menu_id'] . "' data-tag='" . $row['tag_id'] . "' data-course='" . $row['course_id'] . "'><i class='far fa-edit'></i> Update</a>";
        
        echo "<div class='dropdown-divider'></div>";
        echo "<a href='#' class='dropdown-item has-icon deleteBtn' data-id='" . $row['meta_id'] ."'><i class='far fa-trash-alt'></i> Delete</a>";
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
