mondial.calendar = {};

jQuery(function() {

  if (jQuery('[data-calendar]').length) {

    var from_date = jQuery('[data-calendar] [data-date]:first').data('date'),
        to_date = jQuery('[data-calendar] [data-date]:last').data('date'),
        role_id = 'any',
        status = 'any';

    if (mondial.getParameter('status') != '' && mondial.getParameter('status') != 'any') status = mondial.getParameter('status');
    if (mondial.getParameter('role') > 0) role_id = mondial.getParameter('role');

    mondial.calendar.loadShifts(from_date, to_date, status, role_id);
    mondial.calendar.loadBirthdays(from_date, to_date);

  }

});

mondial.calendar.loadShifts = function(from_date, to_date, status = 'any', role_id = 'any') {

  jQuery.post('/script/ajax/load-shifts.php', {

    from_date: from_date,
    to_date: to_date,
    status: status,
    role_id: role_id

  }, function(res) {

    if (res) {

      var obj = jQuery.parseJSON(res);

      jQuery('[data-shift]').remove();

      jQuery.each(obj, function(key, value) {

        var content = '<div data-shift="' + value.uid + '" class="calendar-shift">' + value.time_start + ' - ' + value.time_end + '<br>';

        content += '<span class="location-name">' + value.location_name + '</span><br>';

        if (value.user_uid) content += '<span class="user-name">' + value.user_name + '</span>';
        else content += '<span class="user-name">?</span>';

        content += '</div>'

        jQuery('[data-events="' + value.date_start + '"]')
          .append(content);

        var shiftEvent = jQuery('[data-shift="' + value.uid + '"]');

        if (value.has_notes) shiftEvent.addClass('shift-warning');
        if (!value.user_uid) shiftEvent.addClass('shift-unassigned');
        if (!value.user_available) shiftEvent.addClass('shift-error');
        if (value.confirmed) shiftEvent.addClass('shift-confirmed');

      });

    }

  });

}

mondial.calendar.loadBirthdays = function(from_date, to_date) {

  jQuery.post('/script/ajax/load-birthdays.php', {

    from_date: from_date,
    to_date: to_date

  }, function(res) {

    if (res) {

      var obj = jQuery.parseJSON(res);

      jQuery('[data-birthday]').remove();

      jQuery.each(obj, function(key, value) {

        jQuery('[data-events$="-' + value.date + '"]')
          .append('<div data-birthday class="calendar-event calendar-birthday" style="background-color:#' + value.color + ';">' + value.firstname + ' ' + value.lastname + '</div>');

      });

    }

  });

}
