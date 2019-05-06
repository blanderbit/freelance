<?php include(VIEW_HEADER); ?>

<main>

  <div class="main-header">

    <div class="tabs">

      <a href="/" class="header-tab <?php if (is_path('', 1)) echo 'active'; ?>">Dag</a>
      <a href="/calendar/week" class="header-tab <?php if ($calendar_show == 'week') echo 'active'; ?>">Week</a>
      <a href="/calendar/month" class="header-tab <?php if ($calendar_show == 'month') echo 'active'; ?>">Maand</a>

    </div>

    <div class="tabs">

      <form id="filter" action="<?php echo full_path(); ?>" method="get">

        <select name="role">

          <option value="any" default>Alle rollen</option>
          <option value="2" <?php if ($_GET['role'] == 2) echo 'selected'; ?>>Alleen beveiligers</option>
          <option value="3" <?php if ($_GET['role'] == 3) echo 'selected'; ?>>Alleen aspirant beveiligers</option>
          <option value="4" <?php if ($_GET['role'] == 4) echo 'selected'; ?>>Alleen straatcoaches</option>
          <option value="5" <?php if ($_GET['role'] == 5) echo 'selected'; ?>>Alleen hosts</option>

        </select>

        <select name="status">

          <option value="any" default>Alle statusen</option>
          <option value="unconfirmed" <?php if ($_GET['status'] == 'unconfirmed') echo 'selected'; ?>>Niet aangemeld</option>
          <option value="confirmed" <?php if ($_GET['status'] == 'confirmed') echo 'selected'; ?>>Aangemeld</option>

        </select>

      </form>

    </div>

    <div data-search="all" class="search-container">

      <input type="search" placeholder="Overal zoeken">

      <div class="search-results-container">

        <div class="search-results"></div>

      </div>

    </div>

    <?php include(VIEW_SNIPPET . 'user-menu.php'); ?>

  </div>

  <div class="main-content">

    <?php include(VIEW_SNIPPET . 'alerts.php'); ?>

    <div class="content-header">

      <div class="content-title">

        <h2><?php echo date('j F', strtotime($this_date)); ?> <span style="font-weight:600;"><?php echo date('Y', strtotime($this_date)); ?></span></h2>

      </div>

      <div class="time-nav">

        <a href="/dashboard/<?php echo date('d-m-Y', strtotime($this_date . ' -1 day')); ?><?php echo get_params(); ?>">&lt;</a>
        <a href="/dashboard/<?php echo date('d-m-Y', strtotime($this_date . ' +1 day')); ?><?php echo get_params(); ?>">&gt;</a>

      </div>

    </div>

    <br><br>

    <div data-planner="<?php echo $this_date; ?>" class="planner-container">

      <div class="planner-locations-container">

        <div class="planner-location-header">

          <div class="location-title">Locatie</div>
          <div data-action="shift-add" class="shift-add-icon">+</div>

        </div>

        <div class="planner-locations"></div>

      </div>

      <div class="planner-shifts-container">

        <div class="planner-timeline">

        <?php for ($x = 0; $x <= 23; $x++) { ?>

          <div class="planner-time">

            <?php echo sprintf('%02d', $x) . ':00'; ?>

          </div>

        <?php } ?>

        </div>

        <div class="planner-shifts"></div>

      </div>

    </div>

  </div>

</main>

<?php include(VIEW_FOOTER); ?>
