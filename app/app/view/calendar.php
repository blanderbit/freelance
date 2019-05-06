<?php include(VIEW_HEADER); ?>

<main>

  <div class="main-header">

    <div class="tabs">

      <a href="/" class="header-tab <?php if (is_path('', 1)) echo 'active'; ?>">Dag</a>
      <a href="/calendar/week<?php echo get_params(); ?>" class="header-tab <?php if ($calendar_show == 'week') echo 'active'; ?>">Week</a>
      <a href="/calendar/month<?php echo get_params(); ?>" class="header-tab <?php if ($calendar_show == 'month') echo 'active'; ?>">Maand</a>

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

    <?php if ($calendar_show == 'day') include (VIEW . 'calendar/day.php'); ?>
    <?php if ($calendar_show == 'week') include (VIEW . 'calendar/week.php'); ?>
    <?php if ($calendar_show == 'month') include (VIEW . 'calendar/month.php'); ?>

  </div>

</main>

<?php include(VIEW_FOOTER); ?>
