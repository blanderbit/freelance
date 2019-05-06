<?php include(VIEW_HEADER); ?>

<main>

  <div class="main-header">

    <div class="tabs">

      <!-- SEARCH -->

    </div>

    <div data-search="employers" class="search-container">

      <input type="search" placeholder="Zoek opdrachtgever">

      <div class="search-results-container">

        <div class="search-results"></div>

      </div>

    </div>

    <?php include(VIEW_SNIPPET . 'user-menu.php'); ?>

  </div>

  <div class="main-content">

    <div class="content-header">

      <div class="content-title"><h2>Opdrachtgevers</h2></div>

      <div class="content-options">

        <a href="/export?type=employer-list" target="_blank" class="button button-left">Exporteren</a>
        <span onClick="mondial.employer.add();" class="button button-right">Nieuwe opdrachtgever</span>

      </div>

    </div>

    <br><br>

    <div class="card-grid">

      <?php foreach ($employer->list_all() as $this_employer) { ?>

        <div class="profile-card">

          <div class="card-picture">

            <div class="picture"></div>

          </div>

          <div class="card-profile">

            <span class="card-name"><?php echo $this_employer['name']; ?></span>
            <br>
            <span class="card-title"><?php echo $this_employer['group']; ?></span>

          </div>

          <div class="card-details">

            <?php echo $this_employer['phone']; ?> &bull; <?php echo $this_employer['email']; ?>

          </div>

          <div class="card-link">

            <a href="/employers/<?php echo $this_employer['id']; ?>">Ga naar profiel</a>

          </div>

        </div>

      <?php } ?>

    </div>

  </div>

</main>

<?php include(VIEW_FOOTER); ?>
