<?php include(VIEW_HEADER); ?>

<main>

  <div class="main-header">

    <?php include(VIEW_SNIPPET . 'user-menu.php'); ?>

  </div>

  <div class="main-content">

    <div class="content-header">

      <div class="content-title"><h2>Velopen beveiligingspassen</h2></div>

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

            <?php foreach (cards_expired() as $card) { ?>

              <tr>

                <td><a href="/users/<?php echo $card['user_id']; ?>"><?php echo $card['firstname'] . ' ' . $card['lastname']; ?></a></td>
                <td><span style="color:#e74c3c;font-weight:600;">Verlopen</span></td>
                <td><?php echo date('m-d-Y', strtotime($card['expired'])); ?></td>

              </tr>

            <?php } ?>

            <?php foreach (cards_expiring() as $card) { ?>

              <tr>

                <td><a href="/users/<?php echo $card['user_id']; ?>"><?php echo $card['firstname'] . ' ' . $card['lastname']; ?></a></td>
                <td></td>
                <td><?php echo date('m-d-Y', strtotime($card['expires'])); ?></td>

              </tr>

            <?php } ?>

          </table>

        </div>

      </div>

    </div>

  </div>

</main>

<?php include(VIEW_FOOTER); ?>
