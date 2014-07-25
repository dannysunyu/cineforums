<div class="container">

  <div class="row-fluid">
    <nav class="span12">
      <ul class="breadcrumb">
        <li><a href="index.php"><?php echo FORUM_NAME; ?></a><span class="divider"></span></li>
        <li class="active">forums</li>
      </ul>
    </nav>
  </div>

  <?php

    $forum_sql = "SELECT * FROM forums WHERE id = " . $validforum . ";";
    $forum_result = $db_handler->query($forum_sql);
    while ($forum_row = $forum_result->fetch(PDO::FETCH_OBJ)) {
      echo "<h3>" . $forum_row->name . "</h3>";
      echo "<br /><br />";
    }

    echo "<a class='btn btn-primary' href='newtopic.php?id=" . $validforum . "'>New Topic</a>";

    echo "<br/><br />";

    $topic_sql = "SELECT MAX( messages.date ) AS maxdate, topics.id AS topicid, topics.*, users.* " .
    "FROM messages, topics, users WHERE messages.topic_id = topics.id AND topics.user_id = users.id AND " .
    "topics.forum_id = " . $validforum . " GROUP BY messages.topic_id ORDER BY maxdate DESC;";

    $topic_result = $db_handler->query($topic_sql);
    $topic_num_rows = count($topic_result->fetchAll());
  ?>

  <?php if ($topic_num_rows == 0): ?>
    <div class="row">
      <div class="col-md-6">
        <table class="table table-bordered">
          <tbody>
            <tr>
              <td>No topics!</td>
            </tr>
          <tbody>
        </table>
      </div>
    </div>
  <?php else: ?>
     <div class="row">
        <div class="col-md-6">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>#</th>
                <th>Topic</th>
                <th>Replies</th>
                <th>Author</th>
                <th>Date Posted</th>
              </tr>
            </thead>
            <tbody>

              <?php
                $topic_result = $db_handler->query($topic_sql);

                $i = 0;
                while ($topic_row = $topic_result->fetch(PDO::FETCH_OBJ)) {
                  $msg_sql = "SELECT id FROM messages where topic_id = " . $topic_row->topicid . ";";

                  $msg_result = $db_handler->query($msg_sql);
                  $msg_row_num = count($msg_result->fetchAll());

                  echo "<tr>";
                  echo "<td>" . ++$i . "</td>";
                  echo "<td><a href='viewmessage.php?topic_id=" . $topic_row->topicid . "'>" . $topic_row->subject . "</a></td>";
                  echo "<td>" . $msg_row_num . "</td>";
                  echo "<td>" . $topic_row->username . "</td>";
                  echo "<td>" . $topic_row->date . "</td>";
                  echo "</tr>";

                }
               ?>
            </tbody>
          </table>
        </div>
      </div>
  <?php endif ?>




<?php

?>
