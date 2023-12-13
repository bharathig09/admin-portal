
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> -->
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css"> -->
    <!-- <script src="https://code.jquery.com/jquery-3.7.0.js"></script> -->
    <!-- <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script> -->
</head>
<body>
    <div class="card">
        <div class="card-header"><h5>Acess Keys Data</h5></div>
        <div class="card-body">
        <table id="example" class='table table-striped table-bordered' style="width:100%">
        <thead>
            <tr>
                <th>S.No</th>
                <th>Tag</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
    
        <?php
        require_once("config.php");
        $sql =mysqli_query($conn,"SELECT * FROM number_verify_access_key WHERE status='1' ORDER BY modify_date_time DESC") or die(mysqli_error($conn));
        // $result = $conn->query($sql);
        $i = 1;
        if ($sql->num_rows > 0) {
            while ($res=mysqli_fetch_object($sql)) {
        ?>
        <tr id="<?php echo $res -> access_key_id?>">
            <td><?php echo $i?></td>
            <td><?php echo $res -> access_key?></td>
            <td><div class='dropdown'>
                    <a href='#' data-bs-toggle='dropdown' class='btn dropdown-toggle' aria-expanded='false'><i class='fa fa-ellipsis-v'
        aria-hidden='true'></i></a>
                    <div class='dropdown-menu' style=''>
                        <button class='btn btn-sm' onclick='updateaccesskey(<?php echo $res -> access_key_id?>)'>
                        <i class='far fa-edit'></i>Update
                        </button>
                        <div class='dropdown-divider'></div>
                        <button class='btn btn-sm' onclick='deleteaccesskey(<?php echo $res -> access_key_id?>)'><i class='far fa-trash-alt'></i>Delete</button>
                    </div>
                </div>
            </td>
        </tr>
        <?php
        $i++;
        }
        }
        ?>

        </tbody>
        
    </table>
        </div>
    </div>
    
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

<script>
$(document).ready(function(){
        $('#example').DataTable({});
    });</script>
</html>