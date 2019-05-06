<?php

if ($user->is_signed_in()) {

  include(MODEL . 'export.php');

  if ($_GET['type'] == 'user-list') {

    $filename = 'user';

    $titles = [
      'Voornaam',
      'Achternaam',
      'Rol',
      'E-mailadres',
      'Telefoon',
      'Adres',
      'Postcode',
      'Plaats',
      'Land',
      'Geboortedatum',
      'Nationaliteit',
      'Geboorteland',
      'Geboorteplaats',
      'Burgerservicenummer',
      'Type identificatiebewijs',
      'Verloopdatum identificatiebewijs',
      'Lengte',
      'Datum indiensttreding',
      'Loon',
      'Rijskostenvergoeding',
      'Soort contract',
      'Begindatum contract',
      'Verloopdatum contract',
      'Pasnummer',
      'Verloopdatum pas',
      'Rijbewijs',
      'T-shirt maat',
      'Kostuum maat',
      'Broekmaat',
      'Schoenmaat'
    ];

    $rows = $user->export();

  }

  if ($_GET['type'] == 'user-tasks') {

    include(MODEL . 'task.php');

    $user_id = $_GET['user'];

    $filename = 'user_tasks';

    $titles = [
      'Datum',
      'Van',
      'Tot',
      'Gebruiker',
      'Omschrijving'
    ];

    $rows = $task->export($user_id);

  }

  if ($_GET['type'] == 'user-shifts') {

    $user_id = $_GET['user'];

    $filename = 'user_shifts';

    $titles = [
      'Datum',
      'Van',
      'Tot',
      'Dienstverlener',
      'Telefoonnummer dienstverlerer',
      'Opdrachtgever',
      'Telefoonnummer opdrachtgever',
      'Locatie',
      'Adres',
      'Postcode',
      'Plaats',
      'Land'
    ];

    if ($_GET['period'] == 'upcoming') $rows = $user->shifts_export($user_id, 'UPCOMING');
    if ($_GET['period'] == 'complete') $rows = $user->shifts_export($user_id, 'COMPLETE');

  }

  if ($_GET['type'] == 'employer-list') {

    include(MODEL . 'employer.php');

    $filename = 'employer';

    $titles = [
      'Bedrijfsnaam',
      'E-mailadres',
      'Telefoonnummer',
      'Adres',
      'Postcode',
      'Plaats',
      'Land',
      'KvK-nummer',
      'IBAN-rekeningnummer'
    ];

    $rows = $employer->export();

  }

  if ($_GET['type'] == 'employer-shifts') {

    include(MODEL . 'employer.php');

    $employer_id = $_GET['employer'];

    $filename = 'employer_shifts';

    $titles = [
      'Datum',
      'Van',
      'Tot',
      'Dienstverlener',
      'Telefoonnummer dienstverlerer',
      'Opdrachtgever',
      'Telefoonnummer opdrachtgever',
      'Locatie',
      'Adres',
      'Postcode',
      'Plaats',
      'Land'
    ];

    if ($_GET['period'] == 'upcoming') $rows = $employer->shifts_export($employer_id, 'UPCOMING');
    if ($_GET['period'] == 'complete') $rows = $employer->shifts_export($employer_id, 'COMPLETE');

  }

  if ($_GET['type'] == 'locations') {

    include(MODEL . 'location.php');

    $filename = 'location';

    if (isset($_GET['employer'])) {

      $employer_id = $_GET['employer'];
      $rows = $location->export($employer_id);

    } else {

      $rows = $location->export();

    }

    $titles = [
      'Naam',
      'Opdrachtgever',
      'Adres',
      'Postcode',
      'Plaats',
      'Land',
      'Kleding'
    ];

  }

  $export->download_send_headers($filename . '_export_' . date('d-m-Y') . '.csv');
  echo $export->array2csv($rows, $titles);
  die();

}

?>
