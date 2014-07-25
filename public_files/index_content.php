<div class="container">

    <div class="row">
      <div class="col-md-6">
        <table class="table table-bordered">

          <?php
            $category_sql = "SELECT * FROM categories;";
            $category_result = $db_handler->query($category_sql);

            while ($category_row = $category_result->fetch(PDO::FETCH_OBJ)) {
              echo "<thead>";
              echo "<tr>";
              echo "<th>#</th>";
              echo "<th>" . $category_row->name . "</th>";
              echo "</thead>";
              echo "<tbody>";

              $forum_sql = "SELECT * FROM forums WHERE cat_id = " . $category_row->id . ";";
              $forum_result = $db_handler->query($forum_sql);
              $forum_rows_num = count($forum_result->fetchAll());

              if ($forum_rows_num == 0) {
                echo "<tr>";
                echo "<td>1</td>";
                echo "<td>No forums!</td>";
                echo "</tr>";
              } else {
                $forum_result = $db_handler->query($forum_sql);

                $i = 0;
                while ($forum_row = $forum_result->fetch(PDO::FETCH_OBJ)) {
                  echo "<tr>";
                  echo "<td>" . ++$i . "</td>";
                  echo "<td><a href='viewforum.php?id=" . $forum_row->id . "'>" . $forum_row->name . "</a><i>  (" . $forum_row->description . ")</i></td>";
                  echo "</tr>";
                }
              }

              echo "</tbody>";
            }

          ?>
        </table>

      </div>
    </div>
