<?php
  include_once 'dbconnnect.php';

  if (isset($_GET['userDetails'])) {
    $partId = $_GET['userDetails'];
    echo $partId;
    $query = "UPDATE request_db SET status = 'Rejected/Not Granted' WHERE request_id = $partId";
    $result = mysql_query($query);

    if (!$result) {
      echo "Sorry";
      mysql_error();
    } else {
      ?>
      <script>
      alert('Successfully Updated');
            window.location.href='viewrequestAdmin.php?success';
            </script>
        <?php

    }
  }
?>
