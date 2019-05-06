<?php

if (count(cards_expired()) > 0) {

  $alert['errors'][] = count(cards_expired()) . ' beveiligingspassen zijn verlopen. <a href="/expiring/cards">Bekijk</a>.';

}

if (count(contracts_expired()) > 0) {

  $alert['errors'][] = count(contracts_expired()) . ' contracten zijn verlopen. <a href="/expiring/contracts">Bekijk</a>';

}

if (count(ids_expired()) > 0) {

  $alert['errors'][] = count(ids_expired()) . ' identiteitsbewijzen zijn verlopen. <a href="/expiring/identifications">Bekijk</a>.';

}

if (count(cards_expiring()) > 0) {

  $alert['warnings'][] = count(cards_expiring()) . ' beveiligingspassen verlopen binnen de komende 3 maanden. <a href="/expiring/cards">Bekijk</a>.';

}

if (count(contracts_expiring()) > 0) {

  $alert['warnings'][] = count(contracts_expiring()) . ' contracten verlopen binnen de komende 40 dagen. <a href="/expiring/contracts">Bekijk</a>.';

}

if (count(ids_expiring()) > 0) {

  $alert['warnings'][] = count(ids_expiring()) . ' identiteitsbewijzen verlopen deze maand. <a href="/expiring/identifications">Bekijk</a>.';

}

?>

<?php if (count($alert['errors']) > 0) { ?>

  <div class="alert-error">

    <h3>Waarschuwing</h3>

    <br>

    <?php foreach ($alert['errors'] as $error) { ?>

      <?php echo '&bull; ' . $error . '<br>'; ?>

    <?php } ?>

  </div>

<?php } ?>

<?php if (count($alert['warnings']) > 0) { ?>

  <div class="alert-warning">

    <h3>Waarschuwing</h3>

    <br>

    <?php foreach ($alert['warnings'] as $warning) { ?>

      <?php echo '&bull; ' . $warning . '<br>'; ?>

    <?php } ?>

  </div>

<?php } ?>

<?php if (count($alert['warnings']) > 0 && count($alert['errors']) > 0) echo '<br>'; ?>
