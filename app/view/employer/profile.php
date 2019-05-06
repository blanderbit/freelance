<?php include(VIEW_HEADER); ?>

<main>

  <div class="main-header">

    <div data-search="employers" class="search-container">

      <input type="search" placeholder="Zoek opdrachtgever">

      <div class="search-results-container">

        <div class="search-results"></div>

      </div>

    </div>

    <?php include(VIEW_SNIPPET . 'user-menu.php'); ?>

  </div>

  <div class="main-content">

    <div class="employer-profile">

      <h2><?php echo $this_employer['name']; ?></h2>

      <br><br>

      <div class="profile-left">

        <form id="employer-data" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" class="boxed-sections">

          <div class="boxed-section">

            <h3>Details</h3>

            <br>

            <input name="employer_uid" type="hidden" value="<?php echo $this_employer['uid']; ?>">

            <table class="no-padding">

              <tr>

                <td>Bedrijfsnaam</td>

                <td>

                  <input name="name" type="text" placeholder="Bedrijfsnaam" value="<?php echo $this_employer['name']; ?>">

                </td>

              </tr>

            </table>

            </select>

          </div>

          <div class="boxed-section">

            <h3>Contactgegevens</h3>

            <br>

            <table class="no-padding">

              <tr>

                <td>E-mailadres</td>
                <td><input name="email" type="email" value="<?php echo $this_employer['email']; ?>"></td>

              </tr>

              <tr>

                <td>Telefoonnummer</td>
                <td><input name="phone" type="text" value="<?php echo $this_employer['phone']; ?>"></td>

              </tr>

            </table>

          </div>

          <div class="boxed-section">

            <h3>Adresgegevens</h3>

            <br>

            <input name="street" type="text" value="<?php echo $this_employer['street']; ?>" placeholder="Straat" class="half">
            <input name="street_number" type="number" value="<?php echo $this_employer['street_number']; ?>" placeholder="Nummer" class="quarter">
            <input name="street_extra" type="text" value="<?php echo $this_employer['street_extra']; ?>" placeholder="Extra" class="quarter">

            <br>

            <input name="postal" type="text" value="<?php echo $this_employer['postal']; ?>" placeholder="Postcode" class="half">
            <input name="city" type="text" value="<?php echo $this_employer['city']; ?>" placeholder="Plaats" class="half">

            <br>

            <input name="country" type="text" value="<?php echo $this_employer['country']; ?>" placeholder="Land">

          </div>

          <div class="boxed-section">

            <h3>Bedrijf</h3>

            <br>

            <table class="no-padding">

              <tr>

                <td>IBAN</td>
                <td><input name="iban" type="text" value="<?php echo $this_employer['iban']; ?>"></td>

              </tr>

              <tr>

                <td>KvK-nummer</td>
                <td><input name="kvk" type="number" value="<?php echo $this_employer['kvk']; ?>"></td>

              </tr>

            </table>

            <br><br>

            <input type="submit" class="button" value="Opslaan">

          </div>

        </form>

        <div class="boxed-sections">

          <div class="boxed-section">

            <div class="section-header">

              <div class="header-left"><h3>Locaties</h3></div>
              <div class="header-right">

                <a href="/export?type=locations&employer=<?php echo $this_employer['id']; ?>" target="_blank" class="button button-left">Exporteren</a>
                <span onClick="mondial.location.add(<?php echo $this_employer['id']; ?>);" class="button button-right">Nieuwe locatie</span>

              </div>

            </div>

            <br>

            <table class="list">

              <tr>

                <th>Naam</th>
                <th>Kleding</th>
                <th>Adres</th>
                <th>Postcode</th>
                <th>Plaats</th>
                <th></th>

              </tr>

            <?php foreach ($employer->locations($this_employer['id']) as $location) { ?>

              <tr data-location="<?php echo $location['id']; ?>">

                <td><?php echo $location['name']; ?></td>
                <td><?php echo $location['dress_code']; ?></td>
                <td><?php echo $location['address']; ?></td>
                <td><?php echo $location['postal']; ?></td>
                <td><?php echo $location['city']; ?></td>
                <td style="text-align:right;"><div class="icon-edit" onClick="mondial.location.edit('<?php echo $location['id']; ?>')"></div></td>

              </tr>

            <?php } ?>

            </table>

          </div>

        </div>

      </div>

      <div class="profile-right">

        <div class="boxed-sections">

          <div class="boxed-section">

            <div class="section-header">

              <div class="header-left"><h3>Geplande diensten</h3></div>
              <div class="header-right">

                <a href="/export?type=employer-shifts&employer=<?php echo $this_employer['id']; ?>&period=upcoming" target="_blank" class="button button-left">Exporteren</a>
                <span onClick="mondial.shift.add('today', <?php echo $this_employer['id']; ?>);" class="button button-right">Nieuwe dienst</span>

              </div>

            </div>

            <br>

            <table class="list">

              <tr>

                <th></th>
                <th>Datum</th>
                <th>Van</th>
                <th>Tot</th>
                <th>Dienstverlener</th>
                <th>Lengte</th>
                <th>Pauze</th>
                <th>Locatie</th>
                <th></th>
                <th></th>

              </tr>

            <?php foreach ($employer->shifts($this_employer['id'], 'UPCOMING') as $shift) { ?>

              <tr data-shift="<?php echo $shift['uid']; ?>">

                <td class="checkbox"><input type="checkbox"></td>
                <td><?php echo date('j M Y', strtotime($shift['time_start'])); ?></td>
                <td><?php echo date('H:i', strtotime($shift['time_start'])); ?></td>
                <td><?php echo date('H:i', strtotime($shift['time_end'])); ?></td>
                <td><a href="/users/<?php echo $shift['user_id']; ?>"><?php echo $shift['user_name']; ?></a></td>
                <td><?php echo number_format($shift['hours'], 2, ',', '.') ?>u</td>
                <td><?php if ($shift['break']) echo $shift['break'] . 'm'; ?></td>
                <td><?php echo $shift['location']; ?></td>
                <td><?php echo $shift['address']; ?>, <?php echo $shift['city']; ?></td>
                <td style="text-align:right;"><div class="icon-edit" onClick="mondial.shift.edit('<?php echo $shift['uid']; ?>')"></div></td>

              </tr>

            <?php } ?>

            </table>

          </div>

          <div class="boxed-section">

            <div class="section-header">

              <div class="header-left"><h3>Voltooide diensten</h3></div>
              <div class="header-right">

                <a href="/export?type=employer-shifts&employer=<?php echo $this_employer['id']; ?>&period=complete" target="_blank" class="button">Exporteren</a>

              </div>

            </div>

            <br>

            <table class="list">

              <tr>

                <th></th>
                <th>Datum</th>
                <th>Van</th>
                <th>Tot</th>
                <th>Dienstverlener</th>
                <th>Lengte</th>
                <th>Pauze</th>
                <th>Locatie</th>
                <th></th>
                <th></th>

              </tr>

            <?php foreach ($employer->shifts($this_employer['id'], 'COMPLETE') as $shift) { ?>

              <tr data-shift="<?php echo $shift['uid']; ?>">

                <td class="checkbox"><input type="checkbox"></td>
                <td><?php echo date('j M Y', strtotime($shift['time_start'])); ?></td>
                <td><?php echo date('H:i', strtotime($shift['time_start'])); ?></td>
                <td><?php echo date('H:i', strtotime($shift['time_end'])); ?></td>
                <td><a href="/users/<?php echo $shift['user_id']; ?>"><?php echo $shift['user_name']; ?></a></td>
                <td><?php echo number_format($shift['hours'], 2, ',', '.') ?>u</td>
                <td><?php if ($shift['break']) echo $shift['break'] . 'm'; ?></td>
                <td><?php echo $shift['location']; ?></td>
                <td><?php echo $shift['address']; ?>, <?php echo $shift['city']; ?></td>
                <td style="text-align:right;"><div class="icon-edit" onClick="mondial.shift.edit('<?php echo $shift['uid']; ?>')"></div></td>

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
