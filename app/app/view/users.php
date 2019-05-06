<?php include(VIEW_HEADER); ?>

<main>

  <div class="main-header">

    <div class="tabs">

    </div>

    <div data-search="users" class="search-container">

      <input type="search" placeholder="Zoek werknemer">

      <div class="search-results-container">

        <div class="search-results"></div>

      </div>

    </div>

    <?php include(VIEW_SNIPPET . 'user-menu.php'); ?>

  </div>

  <div class="main-content">

    <div class="content-header">

      <div class="content-title"><h2>Werknemers</h2></div>

      <div class="content-options">

        <a href="/export?type=user-list" target="_blank" class="button button-left">Exporteren</a>
        <span onClick="mondial.user.add();" class="button button-right" >Nieuwe gebruiker</span>

      </div>

    </div>

    <br><br>

    <?php if ($_GET['type'] == 'list') { ?>

      <div class="user-list">

        <table class="list">

          <tr>

            <th></th>
            <th>Rol</th>
            <th>Telefoonnummer</th>
            <th>E-mailadres</th>

          </tr>

          <?php foreach ($user->list_all() as $this_user) { ?>

            <tr>

              <td><h3><?php echo $this_user['firstname'] . ' ' . $this_user['lastname']; ?></h3></td>
              <td><?php echo $this_user['role_name']; ?></td>
              <td><?php echo $this_user['phone']; ?></td>
              <td><?php echo $this_user['email']; ?></td>

            </tr>

          <?php } ?>

        </table>

      </div>

    <?php } else { ?>

      <div class="employee-grid">

        <?php foreach ($user->list_all() as $this_user) { ?>

          <div class="profile-card">

            <div class="card-picture">

              <div class="picture"></div>

            </div>

            <div class="card-profile">

              <span class="card-name"><?php echo $this_user['firstname'] . ' ' . $this_user['lastname']; ?> (<?php echo $this_user['age']; ?>)</span>
              <br>
              <span class="card-title"><?php echo $this_user['role_name']; ?></span>

            </div>

            <div class="card-details">

              <?php echo $this_user['phone']; ?> &bull; <?php echo $this_user['email']; ?>

            </div>

            <div class="card-link">

              <a href="/users/<?php echo $this_user['id']; ?>">Ga naar profiel</a>

            </div>

          </div>

        <?php } ?>

      </div>

    <?php } ?>

  </div>

</main>

<?php include(VIEW_FOOTER); ?>
