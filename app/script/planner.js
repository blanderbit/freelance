mondial.planner = {};

jQuery(function() {

  if (jQuery('[data-planner]').length) {

    var planningDate = jQuery('[data-planner]').data('planner'),
        status = 'any',
        role_id = 'any';

    if (mondial.getParameter('status') != '' && mondial.getParameter('status') != 'any') status = mondial.getParameter('status');
    if (mondial.getParameter('role') > 0) role_id = mondial.getParameter('role');

    mondial.planner.loadShifts(planningDate, status, role_id);

  }

  jQuery(window).bind('resizeEnd', function() {

    if (jQuery('[data-planner]').length) {

      var planningDate = jQuery('[data-planner]').data('planner'),
          status = 'any',
          role_id = 'any';

      if (mondial.getParameter('status') != '' && mondial.getParameter('status') != 'any') status = mondial.getParameter('status');
      if (mondial.getParameter('role') > 0) role_id = mondial.getParameter('role');

      mondial.planner.loadShifts(planningDate, status, role_id);

    }

  });

  jQuery('[data-planner]').on('dblclick', '.planner-bar', function() {

    var shift_uid = jQuery(this).parents('[data-shift]').data('shift');

    mondial.shift.edit(shift_uid);

  });

  jQuery('[data-plannerfilter="employees"] input').on('keyup', function() {

    var input = jQuery(this).val();

    if (input.length >= 1) {

      jQuery('[data-shift], [data-locshift]').hide();

      jQuery.each(jQuery('[data-shift] .employee-name:icontains(' + input + ')'), function() {

      var shift_uid = jQuery(this).parents('[data-shift]').data('shift');

      mondial.planner.showShift(shift_uid);

      });


    } else {

      jQuery('[data-shift], [data-locshift]').show();

    }

  });

});

mondial.planner.loadShifts = function(date, status = 'any', role_id = 'any') {

  jQuery.post('/script/ajax/planner-load.php', {

    date: date,
    status: status,
    role_id: role_id

  }, function(res) {

    if (res) {

      var obj = jQuery.parseJSON(res);

      var hourWidth = parseInt(jQuery('.planner-time:first').outerWidth()),
          maxHours = 10;

      jQuery('[data-planner] .planner-locations').empty();
      jQuery('[data-planner] .planner-shifts').empty();

      jQuery.each(obj, function(key, value) {

        var locContent = '',
            barContent = '',
            width = value.duration * hourWidth,
            left = value.start * hourWidth;

        // Location block

        locContent += '<div data-locshift="' + value.uid + '" class="planner-location">';
        locContent += '<div>';
        locContent += '<span class="location-name">' + value.location_name + '</span>';
        locContent += '</div>';
        locContent += '</div>';

        // Bar / shift

        barContent += '<div data-shift="' + value.uid + '" class="planner-shift">';
        barContent += '<div class="planner-bar" style="width:' + width + 'px;left:' + left + 'px;">';

        barContent += '<div class="shift-time"><span class="time">' + value.time_start + ' - ' + value.time_end + '</span></div>';

        barContent += '<div class="planner-employee">';

        barContent += '<div class="employee-name">' + value.user_firstname + ' ' + value.user_lastname + '</div>';
        barContent += '<div class="employee-initials">' + value.user_initials + '</div>';

        barContent += '</div>';

        barContent += '</div>';
        barContent += '</div>';

        jQuery(locContent).appendTo('[data-planner] .planner-locations');
        jQuery(barContent).appendTo('[data-planner] .planner-shifts');

        var shiftBar = jQuery('[data-shift="' + value.uid + '"] .planner-bar');

        if (shiftBar.width() <= 300) {

          shiftBar.find('.employee-name').hide();
          shiftBar.find('.employee-initials').show();

        } else {

          shiftBar.find('.employee-initials').hide();
          shiftBar.find('.employee-name').show();

        }

        if (value.has_notes) shiftBar.addClass('shift-warning');
        if (value.confirmed) shiftBar.addClass('shift-confirmed');
        if (!value.user_available) shiftBar.addClass('shift-error');

        shiftBar.resizable({

          containment: '[data-shift="' + value.uid + '"]',
          grid: 20,
          handles: 'e, w',
          resize: function() {

            // On Resize event

            var uid = jQuery(this).parents('[data-shift]').data('shift'),
                hourWidth = parseInt(jQuery('.planner-time:first').outerWidth()),
                fromLeft = parseInt(jQuery(this).css('left')),
                width = parseInt(jQuery(this).width()),
                timeStart = 0,
                timeEnd = 0;

            timeStart = mondial.decimalToTime((fromLeft / hourWidth));
            timeEnd = mondial.decimalToTime(((fromLeft + width) / hourWidth));

            jQuery(this).find('.shift-time .time').html(timeStart + ' - ' + timeEnd);

            if (jQuery(this).width() <= 300) {

              jQuery(this).find('.employee-name').hide();
              jQuery(this).find('.employee-initials').show();

            } else {

              jQuery(this).find('.employee-initials').hide();
              jQuery(this).find('.employee-name').show();

            }

          },
          stop: function() {

            // Resize finished event

            var uid = jQuery(this).parents('[data-shift]').data('shift'),
                hourWidth = parseInt(jQuery('.planner-time:first').outerWidth()),
                fromLeft = parseInt(jQuery(this).css('left')),
                width = parseInt(jQuery(this).width()),
                timeStart = 0,
                timeEnd = 0;

            timeStart = mondial.decimalToTime((fromLeft / hourWidth));
            timeEnd = mondial.decimalToTime(((fromLeft + width) / hourWidth));

            mondial.shift.updateTime(uid, timeStart, timeEnd);

            jQuery(this).parents('[data-shift]')
              .attr({'data-timestart': timeStart, 'data-timeend': timeEnd})
              .data({'timestart': timeStart, 'timeend': timeEnd});

          }

        });

        shiftBar.draggable({

          containment: '[data-shift="' + value.uid + '"]',
          grid: [ 20, 20 ],
          axis: 'x',
          drag: function() {

            // On Drag event

            var uid = jQuery(this).parents('[data-shift]').data('shift'),
                hourWidth = parseInt(jQuery('.planner-time:first').outerWidth()),
                fromLeft = parseInt(jQuery(this).css('left')),
                width = parseInt(jQuery(this).width()),
                timeStart = 0,
                timeEnd = 0;

            timeStart = mondial.decimalToTime((fromLeft / hourWidth));
            timeEnd = mondial.decimalToTime(((fromLeft + width) / hourWidth));

            jQuery(this).find('.shift-time .time').html(timeStart + ' - ' + timeEnd);

          },
          stop: function() {

            // Drag finished event

            var uid = jQuery(this).parents('[data-shift]').data('shift'),
                hourWidth = parseInt(jQuery('.planner-time:first').outerWidth()),
                fromLeft = parseInt(jQuery(this).css('left')),
                width = parseInt(jQuery(this).width()),
                timeStart = 0,
                timeEnd = 0;

            timeStart = mondial.decimalToTime((fromLeft / hourWidth));
            timeEnd = mondial.decimalToTime(((fromLeft + width) / hourWidth));

            mondial.shift.updateTime(uid, timeStart, timeEnd);

            jQuery(this).parents('[data-shift]')
              .attr({'data-timestart': timeStart, 'data-timeend': timeEnd})
              .data({'timestart': timeStart, 'timeend': timeEnd});

          }

        });

      });

    }

  });

}

mondial.planner.hideShift = function(shift_uid) {

  jQuery('[data-shift="' + shift_uid + '"], [data-locshift="' + shift_uid + '"]').hide();

}

mondial.planner.showShift = function(shift_uid) {

  jQuery('[data-shift="' + shift_uid + '"], [data-locshift="' + shift_uid + '"]').show();

}
