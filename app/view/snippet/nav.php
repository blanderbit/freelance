<nav>

  <div class="nav-header">

    <div class="logo"></div>

  </div>

  <div class="nav-content">

    <a href="/" class="<?php if (is_path('', 1)) echo 'active'; ?>" style="background-image:url(/image/icon/dashboard.svg)"></a>
    <a href="/calendar" class="<?php if (is_path('calendar', 1)) echo 'active'; ?>" style="background-image:url(/image/icon/calendar.svg)"></a>
    <a href="/users" class="<?php if (is_path('users', 1)) echo 'active'; ?>" style="background-image:url(/image/icon/employees.svg)"></a>
    <a href="/employers" class="<?php if (is_path('employers', 1)) echo 'active'; ?>" style="background-image:url(/image/icon/employers.svg)"></a>
    <a href="/tasks" class="<?php if (is_path('tasks', 1)) echo 'active'; ?>" style="background-image:url(/image/icon/tasks.svg)"><div class="uncompleted-tasks"><?php echo uncompleted_tasks(); ?></div></a>

  </div>

</nav>
