mondial.shift = {};

jQuery(function() {

  jQuery(document).on('dblclick', '[data-date]', function(e) {

    e.stopPropagation();
    var date = jQuery(this).data('date');
    mondial.shift.add(date);

  });

  jQuery(document).on('dblclick', '[data-shift]', function(e) {

    e.stopPropagation();
    mondial.shift.edit(jQuery(this).data('shift'));

  });

  jQuery(document).on('click', '[data-action="shift-add"]', function(e) {

    e.stopPropagation();
    var date = jQuery(this).parents('[data-planner]').data('planner');
    mondial.shift.add(date);

  });

  /* FORM NOTES
  ============================= */

  jQuery(document).on('keyup', '[data-form="shift"] [name="note"]', function(e) {

    if (e.which == 8) {

      e.preventDefault();

      var elem = jQuery(this).parents('.notes');

      if (!jQuery(this).val().length && elem.find('input[name="note"]').length > 1) {

        jQuery(this).parents('.note').remove();
        elem.find('.note:last input[type="text"]').focus();

      }

      return false;

    }

  });

  jQuery(document).on('change', '[data-form="shift"] [name="archived"]', function(e) {

    var elem = jQuery(this).parents('.note');

    if (jQuery(this).is(':checked')) elem.find('[name="note"]').css('text-decoration', 'line-through');
    else elem.find('[name="note"]').css('text-decoration', 'none');

  });

  jQuery(document).on('keypress', '[data-form="shift"] [name="note"]', function(e) {

    if (e.which == 13) {

      e.preventDefault();

      if (jQuery(this).val().length) {

        var elem = jQuery(this).parents('.notes');

        var blank = '<div class="note">' +
                    '<input type="text" name="note" placeholder="Opmerking">' +
                    '<div class="archive-checkbox"><input type="checkbox" name="archived"></div>' +
                    '</div>';

        jQuery(blank).appendTo(elem);

        notesElem.find('.note:last input[type="text"]').focus();

      }

      return false;

    }

  });

  /* FORM LOCATIONS
  ============================= */

  jQuery(document).on('change', '[data-form="shift"] select[name="employer"]', function(e) {

    var employer_id = jQuery(this).val();
    var locSelect = jQuery(this).parents('[data-form="shift"]').find('select[name="location"]');

    jQuery.post('/script/ajax/employer-locations.php', {

      employer_id: employer_id

    }, function(res) {

      if (res) {

        var data = jQuery.parseJSON(res);

        locSelect.find('option').remove();

        if (!data.length) {

          locSelect.append('<option selected disabled>Geen locaties beschikbaar</option>');

        } else {

          locSelect.append('<option selected disabled>Maak een keuze</option>');

          jQuery.each(data, function(key, location) {

            locSelect.append('<option value="' + location.id + '">' + location.name + ' - ' + location.street + ' ' + location.street_number + '</option>');

          });

        }

      }

    });

  });

  /* FORM SUBMIT
  ============================= */

  jQuery(document).on('submit', '[data-form="shift"]', function(e) {

    e.preventDefault();

    var form = jQuery(this),
        errors = 0;

    if (!form.find('[name="employer"]').val()) errors++;

    if (errors) {

      alert('Vul alle nodige velden in!');

    } else {

      var i = 0,
          notes = [];

      form.find('.note').each(function() {

        var note = jQuery(this).find('[name="note"]').val();

        var archived = 0;
        if (jQuery(this).find('[name="archived"]').is(':checked')) archived = 1;

        notes[i] = {
          note: note.toString(),
          archived: parseInt(archived)
        };

        i++;

      });

      var data = {
        location_id: form.find('[name="location"]').val(),
        user_id: form.find('[name="user"]').val(),
        time_start: form.find('[name="date_start"]').val() + ' ' + form.find('[name="time_start"]').val(),
        time_end: form.find('[name="date_end"]').val() + ' ' + form.find('[name="time_end"]').val(),
        break: form.find('[name="break"]').val(),
        late: form.find('[name="late"]').val(),
        notes: notes
      };

      if (form.find('[name="confirmed"]').is(':checked')) data.confirmed = 1;
      else data.confirmed = 0;

      if (form.find('[name="shift"]').length) data.uid = form.find('[name="shift"]').val();
      else data.uid = 0;

      var postData = JSON.stringify(data);

      jQuery.post('/script/ajax/shift-update.php', {

        data: postData

      }, function(res) {

        if (res) location.reload();

      });

    }

  });

});

/* ADD SHIFT
============================= */

mondial.shift.add = function(date = 'today', selectEmployer = 'default', selectUser = 'default') {

  if (!mondial.postCooldown) {

    mondial.postCooldown = true;
    mondial.postTimeout = setTimeout(function() { mondial.postCooldown = false; }, 3000);

    jQuery.post('/script/ajax/shift-form.php', function(res) {

      if (res) {

        var data = jQuery.parseJSON(res);

        var form = '';

        // Employer select

        form += '<form data-form="shift" id="shift-add">' +
                '<div data-formsection="employer">' +
                '<h4>Opdrachtgever</h4><br>' +
                '<select name="employer" required>';

        if (selectEmployer == 'default') form += '<option selected disabled>Maak een keuze</option>';

        jQuery.each(data.employers, function(key, employer) {

          form += '<option value="' + employer.id + '">' + employer.name + '</option>';

        });

        form += '</select>' +
                '<br><br><hr><br>' +
                '</div>';

        // Locations

        form += '<div data-formsection="location">' +
                '<h4>Locatie</h4><br>' +
                '<select name="location" required>' +
                '<option selected disabled>Selecteer eerst een opdrachtgever</option>' +
                '</select>' +
                '<br><br><hr><br>' +
                '</div>';

        // Date & Time

        if (date == 'today') date = data.date;

        form += '<div data-formsection="datetime">' +
                '<h4>Datum &amp; tijd</h4><br>' +
                '<table style="margin:0;padding:0;">' +
                '<tr>' +
                '<td>' +
                '<input type="date" name="date_start" value="' + date + '" class="date-time" required><input type="time" name="time_start" value="09:00" class="date-time" required>' +
                '</td>' +
                '<td style="padding:0 16px;">-</td>' +
                '<td>' +
                '<input type="date" name="date_end" value="' + date + '" class="date-time" required><input type="time" name="time_end" value="15:00" class="date-time" required>' +
                '</td>' +
                '</tr>' +
                '</table>' +
                '</div>' +
                '<br><hr><br>';

        // Users / employees

        form += '<div data-formsection="user">' +
                '<h4>Dienstverlener</h4><br>' +
                '<select name="user">';

        if (selectUser == 'default') form += '<option value="" selected>Niet toegewezen</option>';
        else form += '<option value="">Niet toegewezen</option>';

        jQuery.each(data.users, function(key, user) {

          if (selectUser == user.id) form += '<option value="' + user.id + '" selected>' + user.firstname + ' ' + user.lastname + '</option>';
          else form += '<option value="' + user.id + '">' + user.firstname + ' ' + user.lastname + '</option>';

        });

        form += '</select>' +
                '<br><br><hr><br>' +
                '</div>';

        // Break

        form += '<div data-formsection="break">' +
                '<h4>Uitbetaling pauze (in minuten)</h4><br>' +
                '<input name="break" type="number" placeholder="0">' +
                '</div>';

        form += '<br><br>' +
                '<button data-submit>Toevoegen</button>' +
                '</form>';

        mondial.dialog.createShow('shift-add', form, 'Nieuwe dienstverlening', true);

        if (selectEmployer != 'default') jQuery('[data-form="shift"] select[name="employer"]').val(selectEmployer).change();

      }

    });

  }

}

/* EDIT SHIFT
============================= */

mondial.shift.edit = function(uid) {

  jQuery.post('/script/ajax/shift-form.php', {

    uid: uid

  }, function(res) {

    if (res) {

      var data = jQuery.parseJSON(res);

      var form = '';

      form += '<form data-form="shift" id="shift-edit">' +
              '<input name="shift" type="hidden" value="' + data.shift.uid + '">';

      // Confirmed

      form += '<div data-formsection="confirmed">';

      if (data.shift.confirmed == 1) form += '<input id="shift-confirmed" name="confirmed" type="checkbox" checked>';
      else form += '<input id="shift-confirmed" name="confirmed" type="checkbox">';


      form += '<label for="shift-confirmed">Aangemeld</label>' +
              '<br><br><hr><br>' +
              '</div>';

      // Employer select

      form += '<div data-formsection="employer">' +
              '<h4>Opdrachtgever</h4><br>' +
              '<select name="employer" required>';

      jQuery.each(data.employers, function(key, employer) {

        if (employer.id == data.shift.employer_id) form += '<option value="' + employer.id + '" selected>' + employer.name + '</option>';
        else form += '<option value="' + employer.id + '">' + employer.name + '</option>';

      });

      form += '</select>' +
              '<br><br><hr><br>' +
              '</div>';

      // Location select

      form += '<div data-formsection="location">' +
              '<h4>Locatie</h4><br>' +
              '<select name="location" required>';

      jQuery.each(data.locations, function(key, value) {

        if (value.id == data.shift.location_id) form += '<option value="' + value.id + '" selected>' + value.name + ' - ' + value.street + ' ' + value.street_number + '</option>';
        else form += '<option value="' + value.id + '">' + value.name + ' - ' + value.street + ' ' + value.street_number + '</option>';

      });

      form += '</select>' +
              '<br><br><hr><br>' +
              '</div>';

      // Date & Time

      form += '<div data-formsection="datetime">' +
              '<h4>Datum &amp; tijd</h4><br>' +
              '<table style="margin:0;padding:0;">' +
              '<tr>' +
              '<td>' +
              '<input type="date" name="date_start" value="' + data.shift.date_start + '" class="date-time" required><input type="time" name="time_start" value="' + data.shift.time_start + '" class="date-time" required>' +
              '</td>' +
              '<td style="padding:0 16px;">-</td>' +
              '<td>' +
              '<input type="date" name="date_end" value="' + data.shift.date_end + '" class="date-time" required><input type="time" name="time_end" value="' + data.shift.time_end + '" class="date-time" required>' +
              '</td>' +
              '</tr>' +
              '</table>' +
              '</div>' +
              '<br><hr><br>';

      // Users / employees

      form += '<div data-formsection="user">' +
              '<h4>Dienstverlener</h4><br>' +
              '<select name="user">' +
              '<option value="" selected>Niet toegewezen</option>';

      jQuery.each(data.users, function(key, user) {

        if (user.id == data.shift.user_id) form += '<option value="' + user.id + '" selected>' + user.firstname + ' ' + user.lastname + '</option>';
        else form += '<option value="' + user.id + '">' + user.firstname + ' ' + user.lastname + '</option>';

      });

      form += '</select>' +
              '<br><br><hr><br>' +
              '</div>';

      // Break

      form += '<div data-formsection="break">' +
              '<h4>Uitbetaling pauze (in minuten)</h4><br>' +
              '<input name="break" type="number" value="' + data.shift.break + '">' +
              '<br><br><hr><br>' +
              '</div>';

      // Late

      form += '<div data-formsection="late">' +
              '<h4>Te laat op locatie (in minuten)</h4><br>' +
              '<input name="late" type="number" value="' + data.shift.late + '">' +
              '</div>';

      // Notes

      if (data.shift.notes.length) {

        jQuery.each(data.shift.notes, function(key, value) {

          form += '<div class="note">';

          if (value.archived == 0) {

            form += '<input type="text" name="note" value="' + value.note + '">';
            form += '<div class="archive-checkbox"><input type="checkbox" name="archived"></div>';

          } else {

            form += '<input type="text" name="note" value="' + value.note + '" style="text-decoration:line-through;">';
            form += '<div class="archive-checkbox"><input type="checkbox" name="archived" checked></div>';

          }

          form += '</div>';

        });

      }

      form += '<br><br>' +
              '<button data-submit>Opslaan</button>' +
              '</form>';

      mondial.dialog.createShow('shift-edit', form, 'Dienstverlening bewerken', true);

    }

  });

}

mondial.shift.updateTime = function(shift_uid, time_start, time_end) {

  jQuery.post('/script/ajax/update-shift-time.php', {

      shift_uid: shift_uid,
      time_start: time_start,
      time_end: time_end

  }, function(res) {

    if (res) {

      // yeah!

    }

  });

}
