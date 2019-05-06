<?php include(VIEW_HEADER); ?>

<main>

  <div class="main-header">

    <?php include(VIEW_SNIPPET . 'user-menu.php'); ?>

  </div>

  <div class="main-content">

    <div class="content-header">

      <div class="content-title"><h2>Velopen contracten</h2></div>

      <div class="content-options">

        <a href="/export?type=employer-list" target="_blank" class="button">Exporteren</a>

      </div>

    </div>

    <br><br>

    <div class="boxed-sections">

      <div class="boxed-section">

        <div class="expiring-list">

          <table class="list">

            <tr>

              <th></th>
              <th></th>
              <th>Verloopt</th>

            </tr>

            <?php foreach (contracts_expired() as $contract) { ?>

              <tr>

                <td><a href="/users/<?php echo $contract['user_id']; ?>"><?php echo $contract['firstname'] . ' ' . $contract['lastname']; ?></a></td>
                <td><span style="color:#e74c3c;font-weight:600;">Verlopen</span></td>
                <td><?php echo date('m-d-Y', strtotime($contract['expired'])); ?></td>

              </tr>

            <?php } ?>

            <?php foreach (contracts_expiring() as $contract) { ?>

              <tr>

                <td><a href="/users/<?php echo $contract['user_id']; ?>"><?php echo $contract['firstname'] . ' ' . $contract['lastname']; ?></a></td>
                <td></td>
                <td><?php echo date('m-d-Y', strtotime($contract['expires'])); ?></td>

              </tr>

            <?php } ?>

          </table>

        </div>

      </div>

    </div>

  </div>

</main>

<?php include(VIEW_FOOTER); ?>
