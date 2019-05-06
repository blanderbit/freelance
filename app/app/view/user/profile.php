<?php include(VIEW_HEADER); ?>

<main>

  <div class="main-header">

    <div data-search="users" class="search-container">

      <input type="search" placeholder="Zoek werknemer">

      <div class="search-results-container">

        <div class="search-results"></div>

      </div>

    </div>

    <?php include(VIEW_SNIPPET . 'user-menu.php'); ?>

  </div>

  <div class="main-content">

    <div class="employee-profile">

      <h2><?php echo $this_user['firstname'] . ' ' . $this_user['lastname']; ?></h2>

      <br><br>

      <div class="profile-left">

        <form id="user-data" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" class="boxed-sections">

          <input name="user_uid" type="hidden" value="<?php echo $this_user['uid']; ?>">

          <div class="boxed-section">

            <h3>Details</h3>

            <br>

            <table class="no-padding">

              <tr>

                <td>Naam</td>

                <td>

                  <input name="firstname" type="text" placeholder="Voornaam" value="<?php echo $this_user['firstname']; ?>" class="half" required>
                  <input name="lastname" type="text" placeholder="Achternaam" value="<?php echo $this_user['lastname']; ?>" class="half" required>

                </td>

              </tr>

              <tr>

                <td>Geboortedatum</td>

                <td><input name="birthdate" type="date" value="<?php echo $this_user['birthdate']; ?>" required></td>

              </tr>

              <tr>

                <td>Rol</td>

                <td>

                  <select name="role" required>

                  <?php foreach ($user->roles() as $role) { ?>

                    <?php if ($role['id'] == $this_user['role_id']) { ?>

                      <option value="<?php echo $role['id']; ?>" selected><?php echo $role['name']; ?></option>

                    <?php } else { ?>

                      <option value="<?php echo $role['id']; ?>"><?php echo $role['name']; ?></option>

                    <?php } ?>

                  <?php } ?>

                </td>

              </tr>

              <tr>

                <td>In bezit van auto</td>

                <td>

                  <select name="drivers_license">

                    <option>Ja</option>
                    <option>Nee</option>

                  </select>

                </td>

              </tr>

            </table>

            </select>

          </div>

          <div class="boxed-section">

            <h3>Gebruikersgegevens</h3>

            <br>

            <table class="no-padding">

              <tr>

                <td>E-mailadres</td>
                <td><input name="email" type="email" value="<?php echo $this_user['email']; ?>" required></td>

              </tr>

              <tr>

                <td>Wachtwoord</td>
                <td>

                  <input name="password" type="password" placeholder="Wachtwoord" class="half">
                  <input name="password-repeat" type="password" placeholder="Herhaal wachtwoord" class="half">

                </td>

              </tr>

            </table>

          </div>

          <div class="boxed-section">

            <h3>Contactgegevens</h3>

            <br>

            <table class="no-padding">

              <tr>

                <td>Telefoonnummer</td>
                <td><input name="phone" type="text" value="<?php echo $this_user['phone']; ?>"></td>

              </tr>

            </table>

          </div>

          <div class="boxed-section">

            <h3>Adresgegevens</h3>

            <br>

            <input name="street" type="text" value="<?php echo $this_user['street']; ?>" placeholder="Straat" class="half">
            <input name="street_number" type="number" value="<?php echo $this_user['street_number']; ?>" placeholder="Nummer" class="quarter">
            <input name="street_extra" type="text" value="<?php echo $this_user['street_extra']; ?>" placeholder="Extra" class="quarter">

            <br>

            <input name="postal" type="text" value="<?php echo $this_user['postal']; ?>" placeholder="Postcode" class="half">
            <input name="city" type="text" value="<?php echo $this_user['city']; ?>" placeholder="Plaats" class="half">

            <br>

            <input name="country" type="text" value="<?php echo $this_user['country']; ?>" placeholder="Land">

          </div>

          <div class="boxed-section">

            <h3>Identificatie</h3>

            <br>

            <table class="no-padding">

              <tr>

                <td>Nationaliteit</td>

                <td><input name="nationality" type="text" value="<?php echo $this_user['nationality']; ?>" placeholder="Nationaliteit"></td>

              </tr>

              <tr>

                <td>Geboorteplaats</td>

                <td>

                  <input name="birth_city" type="text" value="<?php echo $this_user['birth_city']; ?>" placeholder="Plaats" class="half">
                  <input name="birth_country" type="text" value="<?php echo $this_user['birth_country']; ?>" placeholder="Land" class="half">

                </td>

              </tr>

              <tr>

                <td>Identificatie &amp; verloopdatum</td>

                <td>

                  <select name="identification" class="half">

                    <?php foreach (identification_types() as $ident) { ?>

                      <?php if ($ident['id_id'] == $this_user['id_id']) { ?><option value="<?php echo $ident['id_id']; ?>" selected><?php echo $ident['name']; ?></option>
                      <?php } else { ?><option value="<?php echo $ident['id_id']; ?>"><?php echo $ident['name']; ?></option><?php } ?>

                    <?php } ?>

                  </select>

                  <input name="id_exp" type="date" value="<?php echo $this_user['id_exp']; ?>" class="half">

                </td>

              </tr>

              <tr>

                <td>BSN</td>

                <td><input name="csn" type="number" value="<?php echo $this_user['csn']; ?>" placeholder="BSN"></td>

              </tr>

              <tr>

                <td>Lengte</td>
                <td><input name="length" type="number" step="any" value="<?php echo $this_user['length']; ?>"></td>

              </tr>

            </table>

          </div>

          <div class="boxed-section">

            <h3>Contract &amp; pas</h3>

            <br>

            <table class="no-padding">

              <tr>

                <td>Type contract</td>
                <td><input name="contract_type" type="number" step="any" value="<?php echo $this_user['wage']; ?>"></td>

              </tr>

              <tr>

                <td>In dienst sinds</td>
                <td><input name="service_start" type="date" value="<?php echo $this_user['service_start']; ?>"></td>

              </tr>

              <tr>

                <td>Uurloon</td>
                <td><input name="wage" type="number" step="any" value="<?php echo $this_user['wage']; ?>"></td>

              </tr>

              <tr>

                <td>Rijskostenvergoeding</td>
                <td><input name="travel_cost" type="number" step="any" value="<?php echo $this_user['travel_cost']; ?>"></td>

              </tr>

              <tr>

                <td>Contract begin &amp; eind-datum</td>
                <td>

                  <input name="contract_start" type="date" value="<?php echo $this_user['contract_start']; ?>" class="half">
                  <input name="contract_end" type="date" value="<?php echo $this_user['contract_end']; ?>" class="half">

                </td>

              </tr>

              <tr>

                <td>Pasnummer &amp; verloopdatum</td>

                <td>

                  <input name="card_number" type="number" value="<?php echo $this_user['card_number']; ?>" placeholder="Pasnummer" class="half">
                  <input name="card_exp" type="date" value="<?php echo $this_user['card_exp']; ?>" class="half">

                </td>

              </tr>

            </table>

          </div>

          <div class="boxed-section">

            <h3>Kledingmaten</h3>

            <br>

            <table class="no-padding">
              <tr>

                <td>T-shirt</td>

                <td>

                  <select name="sizes_shirt">

                    <option value="1">XS</option>
                    <option value="2">S</option>
                    <option value="3">M</option>
                    <option value="4">L</option>
                    <option value="5">XL</option>
                    <option value="6">XXL</option>

                  </select>

                </td>

              </tr>

              <tr>

                <td>Broek</td>

                <td><input name="sizes_pants" type="number" step="any" value="<?php echo $this_user['clothing']['pants']; ?>" placeholder="Broek"></td>

              </tr>

              <tr>

                <td>Kostuum</td>

                <td><input name="sizes_costume" type="number" step="any" value="<?php echo $this_user['clothing']['costume']; ?>" placeholder="Kostuum"></td>

              </tr>

              <tr>

                <td>Schoenmaat</td>

                <td><input name="sizes_shoes" type="number" step="any" value="<?php echo $this_user['clothing']['shoes']; ?>" placeholder="Schoenmaat"></td>

              </tr>

            </table>

            <br><br>

            <input type="submit" value="Opslaan" class="button">

          </div>

        </form>

      </div>

      <div class="profile-right">

        <!-- TASKS START -->

        <div class="boxed-sections">

          <div class="boxed-section">

            <div class="section-header">

              <div class="header-left"><h3>Takenlijst</h3></div>
              <div class="header-right">

                <span onClick="mondial.task.add('today', <?php echo $this_user['id']; ?>);" class="button">Nieuwe taak</span>

              </div>

            </div>

            <br>

            <?php if (!count($this_user['tasks'])) { echo 'Deze gebruiker heeft nog geen taken.'; } else { ?>

              <table class="list">

                <tr>

                  <th></th>
                  <th></th>
                  <th>Datum</th>
                  <th>Tijd</th>
                  <th></th>

                </tr>

              <?php foreach ($this_user['tasks'] as $task) { ?>

                <tr data-task="<?php echo $task['id']; ?>">

                  <?php if ($task['complete']) { ?>

                    <td class="icon" style="width:44px;"><div class="list-icon icon-completed" onClick="mondial.task.complete('<?php echo $task['id']; ?>')"></div></td>

                  <?php } else { ?>

                    <td class="icon" style="width:44px;"><div class="list-icon icon-complete" onClick="mondial.task.complete('<?php echo $task['id']; ?>')"></div></td>

                  <?php } ?>

                  <td><?php echo $task['description']; ?></td>
                  <td><?php echo date('j M Y', strtotime($task['time_start'])); ?></td>
                  <td><?php echo date('H:i', strtotime($task['time_start'])); ?></td>
                  <td class="icon" style="text-align:right;"><div class="list-icon icon-edit" onClick="mondial.task.edit(<?php echo $task['id']; ?>)"></div></td>

                </tr>

              <?php } ?>

              </table>

            <?php } ?>

          </div>

        </div>

        <!-- TASKS END -->

        <div class="boxed-sections">

          <div class="boxed-section">

            <div class="section-header">

              <div class="header-left"><h3>Geplande diensten</h3></div>
              <div class="header-right">

                <span class="button button-left">Versturen</span>
                <a href="/export?type=user-shifts&user=<?php echo $this_user['id']; ?>&period=upcoming" target="_blank" class="button button-inner">Exporteren</a>
                <span class="button button-right" onClick="mondial.shift.add('today', 'default', <?php echo $this_user['id']; ?>);">Nieuwe dienst</span>

              </div>

            </div>

            <br>

            <table class="list">

            <?php if (!count($shifts_upcoming)) { echo 'Er zijn nog geen diensten gepland.'; } else { ?>

              <tr>

                <th></th>
                <th>Datum</th>
                <th>Van</th>
                <th>Tot</th>
                <th>Lengte</th>
                <th>Pauze</th>
                <th>Opdrachtgever</th>
                <th>Locatie</th>
                <th></th>

              </tr>

            <?php } ?>

            <?php foreach ($shifts_upcoming as $shift) { ?>

              <tr data-shift="<?php echo $shift['uid']; ?>">

                <td class="checkbox"><input type="checkbox"></td>
                <td><?php echo date('j M Y', strtotime($shift['time_start'])); ?></td>
                <td><?php echo date('H:i', strtotime($shift['time_start'])); ?></td>
                <td><?php echo date('H:i', strtotime($shift['time_end'])); ?></td>
                <td><?php echo number_format($shift['hours'], 2, ',', '.') ?>u</td>
                <td><?php if ($shift['break']) echo $shift['break'] . 'm'; ?></td>
                <td><a href="/employers/<?php echo $shift['employer_id']; ?>"><?php echo $shift['employer_name']; ?></a></td>
                <td><?php echo $shift['location']; ?></td>
                <td style="text-align:right;"><div class="icon-edit" onClick="mondial.shift.edit('<?php echo $shift['uid']; ?>')"></div></td>

              </tr>

            <?php } ?>

            </table>

          </div>

          <div class="boxed-section">

            <div class="section-header">

              <div class="header-left"><h3>Voltooide diensten</h3></div>
              <div class="header-right">

                <a href="/export?type=user-shifts&user=<?php echo $this_user['id']; ?>&period=complete" target="_blank" class="button">Exporteren</a>

              </div>

            </div>

            <br>

            <table class="list">

            <?php if (!count($shifts_completed)) { echo 'Er zijn nog geen diensten voltooid.'; } else { ?>

              <tr>

                <th></th>
                <th>Datum</th>
                <th>Van</th>
                <th>Tot</th>
                <th>Lengte</th>
                <th>Pauze</th>
                <th>Opdrachtgever</th>
                <th>Locatie</th>
                <th></th>

              </tr>

            <?php } ?>

            <?php foreach ($shifts_completed as $shift) { ?>

              <tr data-shift="<?php echo $shift['uid']; ?>">

                <td class="checkbox"><input type="checkbox"></td>
                <td><?php echo date('j M Y', strtotime($shift['time_start'])); ?></td>
                <td><?php echo date('H:i', strtotime($shift['time_start'])); ?></td>
                <td><?php echo date('H:i', strtotime($shift['time_end'])); ?></td>
                <td><?php echo number_format($shift['hours'], 2, ',', '.') ?>u</td>
                <td><?php if ($shift['break']) echo $shift['break'] . 'm'; ?></td>
                <td><a href="/employers/<?php echo $shift['employer_id']; ?>"><?php echo $shift['employer_name']; ?></a></td>
                <td><?php echo $shift['location']; ?></td>
                <td style="text-align:right;"><div class="icon-edit" onClick="mondial.shift.edit('<?php echo $shift['uid']; ?>')"></div></td>

              </tr>

            <?php } ?>

            </table>

          </div>

          <!-- LATE START -->

          <div class="boxed-section">

            <div class="section-header">

              <div class="header-left"><h3>Telaatkomsten</h3></div>
              <div class="header-right"></div>

            </div>

            <br>

            <table class="list">

            <?php if (!count($shifts_late)) { echo 'Er zijn geen telaatkomsten geregistreerd.'; } else { ?>

              <tr>

                <th></th>
                <th>Datum</th>
                <th>Van</th>
                <th>Tot</th>
                <th>Te laat</th>
                <th>Opdrachtgever</th>
                <th>Locatie</th>
                <th></th>

              </tr>

            <?php } ?>

            <?php foreach ($shifts_late as $shift) { ?>

              <tr data-shift="<?php echo $shift['uid']; ?>">

                <td class="checkbox"><input type="checkbox"></td>
                <td><?php echo date('j M Y', strtotime($shift['time_start'])); ?></td>
                <td><?php echo date('H:i', strtotime($shift['time_start'])); ?></td>
                <td><?php echo date('H:i', strtotime($shift['time_end'])); ?></td>
                <td><span style="color:#e74c3c;font-weight:600;"><?php echo $shift['late']; ?> minuten</span></td>
                <td><a href="/employers/<?php echo $shift['employer_id']; ?>"><?php echo $shift['employer_name']; ?></a></td>
                <td><?php echo $shift['location']; ?></td>
                <td style="text-align:right;"><div class="icon-edit" onClick="mondial.shift.edit('<?php echo $shift['uid']; ?>')"></div></td>

              </tr>

            <?php } ?>

            </table>

          </div>

          <!-- LATE END -->

        </div>

        <!-- AVAILABILITY START -->

        <div class="boxed-sections">

          <div class="boxed-section">

            <div class="section-header">

              <div class="header-left"><h3>Beschikbaar / Onbeschikbaar</h3></div>
              <div class="header-right"><button onClick="mondial.availability.add('today', <?php echo $this_user['id']; ?>)">Toevoegen</button></div>

            </div>

            <table class="list">

              <tr>

                <th></th>
                <th></th>
                <th>Van</th>
                <th>Tot</th>
                <th>Opmerking</th>

              </tr>

            <?php foreach ($this_user['availability'] as $availability) { ?>

              <tr data-availability="<?php echo $availability['id']; ?>">

                <td class="<?php if (!$availability['type_id']) echo 'available'; else echo 'unavailable'; ?>">&bull;</td>
                <td><?php echo $availability['type']; ?></td>
                <td><?php echo date('j M Y H:i', strtotime($availability['time_start'])); ?></td>
                <td><?php echo date('j M Y H:i', strtotime($availability['time_end'])); ?></td>
                <td><?php echo $availability['comment']; ?></td>

              </tr>

            <?php } ?>

            </table>

          </div>

        </div>

        <!-- AVAILABILITY END -->

        <div class="boxed-sections">

          <div class="boxed-section">

            <div class="section-header">

              <div class="header-left"><h3>Uitbetalingen</h3></div>
              <!--<div class="header-right"><button data-submit>Exporteren</button></div>-->

            </div>

            <br>

            <table class="list">

              <tr>

                <th>Maand</th>
                <th>Uren</th>
                <th>Schatting</th>
                <th>Uitbetaald</th>

              </tr>

            <?php foreach ($this_user['paychecks'] as $date => $paycheck) { ?>

              <tr>

                <td><?php echo date('F Y', strtotime($date)); ?></td>
                <td></td>
                <td>&euro; <?php echo number_format($paycheck, 2, ',', '.'); ?></td>
                <td></td>

              </tr>

            <?php } ?>

            </table>

          </div>

        </div>

        <div class="boxed-sections">

          <div class="boxed-section">

            <div class="section-header">

              <div class="header-left"><h3>Bestanden</h3></div>

            </div>

            <br>

            <form action="/upload" id="user-dropzone" class="dropzone" data-useruid="<?php echo $this_user['uid']; ?>">

              <div class="fallback">

                <input name="file" type="file" multiple />

              </div>

            </form>

          </div>

          <div class="boxed-section">

            <table class="list">

              <?php if (!count($this_user['files'])) { echo 'Er zijn nog geen bestanden geupload.'; } else { ?>

              <tr>

                <th>Bestand</th>
                <th>Geupload</th>
                <th>Grootte</th>
                <th></th>
                <th></th>

              </tr>

              <?php } ?>

              <?php foreach ($this_user['files'] as $user_file) { ?>

                <tr>

                  <td><a href="/file/<?php echo $this_user['uid']; ?>/<?php echo $user_file['name'];?>" target="_blank"><?php echo $user_file['name']; ?></a></td>
                  <td><?php echo date('j M Y', strtotime($user_file['created'])); ?></td>
                  <td><?php echo number_format(round($user_file['size'] / 1000, 2), 2, ',', '.'); ?> kB</td>
                  <td class="icon" style="text-align:right;width:32px;"><a href="/file/<?php echo $this_user['uid']; ?>/<?php echo $user_file['name']; ?>" target="_blank" class="list-icon icon-download"></a></td>
                  <td class="icon" style="text-align:right;width:32px;"><div class="list-icon icon-delete" onClick="mondial.file.delete('<?php echo $this_user['uid']; ?>/<?php echo $user_file['name']; ?>')"></div></td>

                </tr>

              <?php } ?>

            </table>

          </div>

        </div>

      </div>

    </div>

  </div>

</main>

<?php include(VIEW_FOOTER); ?>
