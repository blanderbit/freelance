<?php include(VIEW_HEADER); ?>

<main>

  <div class="main-header">

    <?php include(VIEW_SNIPPET . 'user-menu.php'); ?>

  </div>

  <div class="main-content">

    <div class="content-header">

      <div class="content-title"><h2>Takenlijst</h2></div>

      <div class="content-options">

        <span onClick="mondial.task.add('today');" class="button">Nieuwe taak</span>

      </div>

    </div>

    <br><br>

    <div class="boxed-sections">

      <div class="boxed-section">

        <div class="expiring-list">

          <table class="list">

            <tr>

              <th></th>
              <th>Omschrijving</th>
              <th>Datum</th>
              <th>Tijd</th>
              <th>Toegewezen aan</th>
              <th></th>

            </tr>

            <?php foreach ($task_list as $task) { ?>

              <tr data-task="<?php echo $task['id']; ?>">

                <?php if ($task['complete']) { ?>

                  <td class="icon" style="width:44px;"><div class="list-icon icon-completed" onClick="mondial.task.complete('<?php echo $task['id']; ?>')"></div></td>

                <?php } else { ?>

                  <td class="icon" style="width:44px;"><div class="list-icon icon-complete" onClick="mondial.task.complete('<?php echo $task['id']; ?>')"></div></td>

                <?php } ?>

                <td><?php echo $task['description']; ?></td>
                <td><?php echo date('m-d-Y', strtotime($task['time_start'])); ?></td>
                <td><?php echo date('H:i', strtotime($task['time_start'])); ?></td>
                <td><a href="/users/<?php echo $task['user_id']; ?>"><?php echo $task['firstname'] . ' ' . $task['lastname']; ?></a></td>
                <td class="icon" style="text-align:right;"><div class="list-icon icon-edit" onClick="mondial.task.edit('<?php echo $task['id']; ?>')"></div></td>

              </tr>

            <?php } ?>

          </table>

        </div>

      </div>

    </div>

  </div>

</main>

<?php include(VIEW_FOOTER); ?>
