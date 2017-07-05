<?php
  include_once 'dbconnnect.php';

  if (isset($_GET['userDetails'])) {
    $partId = $_GET['userDetails'];
    echo $partId;
    $query = "UPDATE task_db SET completed = 'Yes' WHERE taskID = $partId";
    $result = mysql_query($query);

    if (!$result) {
      echo "Sorry";
      mysql_error();
    } else {
      ?>
      <script>
      alert('Successfully Updated');
            window.location.href='viewtask.php?success';
            </script>
        <?php

    }
  }
?>
