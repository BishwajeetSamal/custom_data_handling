<table class="table" id="table_data_for_students">
    <thead>
        <tr class="table-success">
            <th>Name</th>
            <th>Class</th>
            <th>Roll Number</th>
            <th>Email</th>
            <th>Mobile</th>
            <th>Percent (%)</th>
            <th></th>
            <th></th>


        </tr>

    </thead>
    <tbody id="table_row">
        <?php
        include('connection.php');
        $limit = 5;
        if (isset($_GET["page"])) {
            $page  = $_GET["page"];
        } else {
            $page = 1;
        };
        $start_from = ($page - 1) * $limit;

        $sql = "SELECT * FROM students ORDER BY name ASC LIMIT $start_from, $limit";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
        ?>

            <?php

            // output data of each row
            while ($row = $result->fetch_assoc()) {

            ?>

                <tr id="<?php echo $row['id'] ?>">

                    <td class="inline_edit_data"><?php echo $row["name"]; ?></td>
                    <td class="inline_edit_data"><?php echo $row["class"]; ?></td>
                    <td class="inline_edit_data"><?php echo $row["roll_no"]; ?></td>
                    <td class="inline_edit_data"><?php echo $row["email"]; ?></td>
                    <td class="inline_edit_data"><?php echo $row["mob"]; ?></td>
                    <td class="inline_edit_data"><?php echo $row["percentage"]; ?></td>
                    <td class="inline_edit_data" id="update"><button class="btn btn-info" onclick="updateFun('<?php echo $row['id']; ?>')">Edit</button></td>
                    <td><button class="btn btn-danger" onclick="deleteFun('<?php echo $row['id']; ?>')">Delete</button></td>

                </tr>
        <?php
            }
        }
        $conn->close();

        ?>

    </tbody>
</table>