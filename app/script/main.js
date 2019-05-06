var mondial = {},
    searchCooldown = false;

mondial.employer = {};
mondial.location = {};
mondial.task = {};
mondial.file = {};
mondial.availability = {};
mondial.postCooldown = false;
mondial.postTimeout = {};
Dropzone.autoDiscover = false;

jQuery(function() {

  /* FILE UPLOAD -- DROPZONE
  ============================= */

  if (jQuery('#user-dropzone').length) {

    var userDropzone = new Dropzone('#user-dropzone');

    userDropzone.on('sending', function(file, xhr, data) {

      var user_uid = jQuery('#user-dropzone').data('useruid');
      data.append('user_uid', user_uid)

    });

    userDropzone.on('complete', function() {

      location.reload();

    });

  }

  /* FILTER
  ============================= */

  jQuery('form#filter').on('change', function() { jQuery(this).submit(); });

  /* USER MENU
  ============================= */

  jQuery('.user-menu').on('click', function(e) {

      e.stopPropagation();

      jQuery(this).toggleClass('opened');

      var dropdown = jQuery(this).find('.menu-dropdown');

      if (jQuery(this).hasClass('opened')) {

        var dropHeight = jQuery(this).find('.menu-items').outerHeight();

        dropdown.css({'height':dropHeight});

      } else {

        dropdown.css({'height':0});

      }

  });

  /* SEARCH
  ============================= */

  jQuery(document).on('click', function() {

    jQuery('[data-search] .search-results').hide();

  });

  jQuery('[data-search] input').on('click', function(e) {

      e.stopPropagation();

      jQuery('[data-search] .search-results').show();

  });

  /* SEARCH
  ============================= */

  jQuery('[data-search] input').on('keyup', function() {

    clearTimeout(searchCooldown);

    var haystack = jQuery(this).parents('[data-search]').data('search');
    var input = jQuery(this).val();

    if (input.length >= 2) {

      searchCooldown = window.setTimeout(function(haystack, input) {

        jQuery.post('/script/ajax/search.php', {

          haystack: haystack,
          needle: input

        }, function(res) {

          if (res) {

            jQuery('[data-search] .search-results')
              .empty()
              .show();

            var obj = jQuery.parseJSON(res);

            jQuery.each(obj, function(key, value) {

              jQuery('[data-search] .search-results')
                .append('<a href="' + value.url + '" class="search-result">' + value.name + '</a>');

            });

          }

        });

      }, 600, haystack, input);

    } else {

      jQuery('[data-search] .search-results').hide();

    }

  });

  jQuery(window).resize(function() {

    if (this.resizeTO) clearTimeout(this.resizeTO);
    this.resizeTO = setTimeout(function() {

      jQuery(this).trigger('resizeEnd');

    }, 500);

  });

  /* EMPLOYER
  ============================= */

  jQuery(document).on('submit', '[data-form="employer"]', function(e) {

    e.preventDefault();

    var form = jQuery(this),
        errors = 0;

    if (!form.find('[name="name"]').val().length) errors++;

    if (errors) {

      alert('Vul alle nodige velden in!');

    } else {

      var data = {
        name: form.find('[name="name"]').val()
      };

      var postData = JSON.stringify(data);

      jQuery.post('/script/ajax/employer-update.php', {

        data: postData

      }, function(res) {

        if (res) location.href = '/employers/' + res;
        else alert('Error');

      });

    }

  });

  /* LOCATION
  ============================= */

  jQuery(document).on('dblclick', '[data-location]', function(e) {

    e.stopPropagation();
    mondial.location.edit(jQuery(this).data('location'));

  });

  jQuery(document).on('submit', '[data-form="location"]', function(e) {

    e.preventDefault();

    var form = jQuery(this),
        errors = 0;

    if (!form.find('[name="employer"]').val().length) errors++;

    if (errors) {

      alert('Vul alle nodige velden in!');

    } else {

      var data = {
        employer_id: form.find('[name="employer"]').val(),
        name: form.find('[name="name"]').val(),
        dress_code: form.find('[name="dress_code"]').val(),
        street: form.find('[name="street"]').val(),
        street_number: form.find('[name="street_number"]').val(),
        street_extra: form.find('[name="street_extra"]').val(),
        postal: form.find('[name="postal"]').val(),
        city: form.find('[name="city"]').val(),
        country: form.find('[name="country"]').val()
      };

      if (form.find('[name="location"]').length) data.id = form.find('[name="location"]').val();
      else data.id = 0;

      var postData = JSON.stringify(data);

      jQuery.post('/script/ajax/location-update.php', {

        data: postData

      }, function(res) {

        if (res) location.reload();

      });

    }

  });

  /* TASK
  ============================= */

  jQuery(document).on('dblclick', '[data-task]', function(e) {

    e.stopPropagation();
    mondial.task.edit(jQuery(this).data('task'));

  });

  jQuery(document).on('submit', '[data-form="task"]', function(e) {

    e.preventDefault();

    var form = jQuery(this),
        errors = 0;

    if (!form.find('[name="user"]').val()) errors++;

    if (errors) {

      alert('Vul alle nodige velden in!');

    } else {

      var data = {
        user_id: form.find('[name="user"]').val(),
        description: form.find('[name="description"]').val(),
        time_start: form.find('[name="date_start"]').val() + ' ' + form.find('[name="time_start"]').val(),
        time_end: form.find('[name="date_end"]').val() + ' ' + form.find('[name="time_end"]').val()
      };

      if (form.find('[name="complete"]').is(':checked')) data.complete = 1;
      else data.complete = 0;

      if (form.find('[name="task"]').length) data.id = form.find('[name="task"]').val();
      else data.id = 0;

      var postData = JSON.stringify(data);

      jQuery.post('/script/ajax/task-update.php', {

        data: postData

      }, function(res) {

        if (res) location.reload();

      });

    }

  });

  /* AVAILABILITY
  ============================= */

  jQuery(document).on('dblclick', '[data-availability]', function(e) {

    e.stopPropagation();
    mondial.availability.edit(jQuery(this).data('availability'));

  });

  jQuery(document).on('submit', '[data-form="availability"]', function(e) {

    e.preventDefault();

    var form = jQuery(this),
        errors = 0;

    if (!form.find('[name="user"]').val()) errors++;

    if (errors) {

      alert('Vul alle nodige velden in!');

    } else {

      var data = {
        user_id: form.find('[name="user"]').val(),
        type_id: form.find('[name="type"]').val(),
        comment: form.find('[name="comment"]').val(),
        time_start: form.find('[name="date_start"]').val() + ' ' + form.find('[name="time_start"]').val(),
        time_end: form.find('[name="date_end"]').val() + ' ' + form.find('[name="time_end"]').val(),
        repeat: form.find('[name="repeat"]').val()
      };

      if (form.find('[name="id"]').length) data.id = form.find('[name="id"]').val();
      else data.id = 0;

      var postData = JSON.stringify(data);

      jQuery.post('/script/ajax/availability-update.php', {

        data: postData

      }, function(res) {

        if (res) location.reload();

      });

    }

  });

});

$.expr[':'].icontains = $.expr.createPseudo(function(text) {

  return function(e) {

    return $(e).text().toUpperCase().indexOf(text.toUpperCase()) >= 0;

  };

});

mondial.getParameter = function(parameterName) {

  var result = null,
      tmp = [];
  var items = location.search.substr(1).split("&");
  for (var index = 0; index < items.length; index++) {
      tmp = items[index].split("=");
      if (tmp[0] === parameterName) result = decodeURIComponent(tmp[1]);
  }

  return result;

}

mondial.decimalToTime = function(decimal) {

  var decimalTimeString = decimal;
  var decimalTime = parseFloat(decimalTimeString);
  decimalTime = decimalTime * 60 * 60;
  var hours = Math.floor((decimalTime / (60 * 60)));
  decimalTime = decimalTime - (hours * 60 * 60);
  var minutes = Math.floor((decimalTime / 60));
  decimalTime = decimalTime - (minutes * 60);
  var seconds = Math.round(decimalTime);
  if (hours < 10) hours = "0" + hours;
  if (minutes < 10) minutes = "0" + minutes;
  if (seconds < 10) seconds = "0" + seconds;

  return (hours + ":" + minutes);

}

/* EMPLOYER
============================= */

mondial.employer.add = function() {

  jQuery.post('/script/ajax/employer-form.php', function(res) {

    if (res) {

      var data = jQuery.parseJSON(res);

      var form = '';

      // Name

      form += '<form data-form="employer" id="employer-add">' +
              '<div data-formsection="name">' +
              '<h4>Bedrijfsnaam</h4><br>' +
              '<input name="name" type="text" placeholder="Bedrijfsnaam" required>' +
              '</div>';

      form += '<br><br><span class="hint">Overige informatie kan later aan het profiel worden toegevoegd.</span><br>';

      form += '<br><br>' +
              '<button data-submit>Toevoegen</button>' +
              '</form>';

      mondial.dialog.createShow('employer-add', form, 'Nieuwe opdrachtgever', true);

    }

  });

}

/* LOCATION
============================= */

mondial.location.add = function(selectEmployer = 'default') {

  jQuery.post('/script/ajax/location-form.php', function(res) {

    if (res) {

      var data = jQuery.parseJSON(res);

      var form = '';

      // Employer select

      form += '<form data-form="location">' +
              '<div data-formsection="employer">' +
              '<h4>Opdrachtgever</h4><br>' +
              '<select name="employer" required>';

      if (selectEmployer == 'default') form += '<option selected disabled>Maak een keuze</option>';

      jQuery.each(data.employers, function(key, employer) {

        if (employer.id == selectEmployer) form += '<option value="' + employer.id + '" selected>' + employer.name + '</option>';
        else form += '<option value="' + employer.id + '">' + employer.name + '</option>';

      });

      form += '</select>' +
              '<br><br><hr><br>' +
              '</div>';

      // Location name

      form += '<div data-formsection="name">' +
              '<h4>Naam</h4><br>' +
              '<input name="name" type="text" placeholder="Naam">' +
              '</div>' +
              '<br><hr><br>';

      // Address fields

      form += '<div data-formsection="address">' +
              '<h4>Adresgegevens</h4><br>' +
              '<input name="street" type="text" placeholder="Straat" class="half">' +
              '<input name="street_number" type="number" placeholder="Huisnummer" class="quarter">' +
              '<input name="street_extra" type="text" placeholder="Extra" class="quarter">' +
              '<input name="postal" type="text" placeholder="Postcode" class="half">' +
              '<input name="city" type="text" placeholder="Plaats" class="half">' +
              '<input name="country" type="text" placeholder="Land">' +
              '</div>' +
              '<br><hr><br>';

      // Dress code

      form += '<div data-formsection="dress_code">' +
              '<h4>Kleding</h4><br>' +
              '<input name="dress_code" type="text" placeholder="Kleding">' +
              '</div>';

      form += '<br><br>' +
              '<button data-submit>Toevoegen</button>' +
              '</form>';

      mondial.dialog.createShow('location-add', form, 'Nieuwe locatie', true);

    }

  });

}

mondial.location.edit = function(id) {

  jQuery.post('/script/ajax/location-form.php', {

    id: id

  }, function(res) {

    if (res) {

      var data = jQuery.parseJSON(res);

      var form = '';

      // Employer select

      form += '<form data-form="location">' +
              '<input name="location" type="hidden" value="' + data.location.id + '">' +
              '<div data-formsection="employer">' +
              '<h4>Opdrachtgever</h4><br>' +
              '<select name="employer" required>';

      jQuery.each(data.employers, function(key, employer) {

        if (employer.id == data.location.employer_id) form += '<option value="' + employer.id + '" selected>' + employer.name + '</option>';
        else form += '<option value="' + employer.id + '">' + employer.name + '</option>';

      });

      form += '</select>' +
              '<br><br><hr><br>' +
              '</div>';

      // Location name

      form += '<div data-formsection="name">' +
              '<h4>Naam</h4><br>' +
              '<input name="name" type="text" value="' + data.location.name + '" placeholder="Naam">' +
              '</div>' +
              '<br><hr><br>';

      // Address fields

      form += '<div data-formsection="address">' +
              '<h4>Adresgegevens</h4><br>' +
              '<input name="street" type="text" value="' + data.location.street + '" placeholder="Straat" class="half">' +
              '<input name="street_number" type="number" value="' + data.location.street_number + '" placeholder="Huisnummer" class="quarter">' +
              '<input name="street_extra" type="text" value="' + data.location.street_extra + '" placeholder="Extra" class="quarter">' +
              '<input name="postal" type="text" value="' + data.location.postal + '" placeholder="Postcode" class="half">' +
              '<input name="city" type="text" value="' + data.location.city + '" placeholder="Plaats" class="half">' +
              '<input name="country" type="text" value="' + data.location.country + '" placeholder="Land">' +
              '</div>' +
              '<br><hr><br>';

      // Dress code

      form += '<div data-formsection="dress_code">' +
              '<h4>Kleding</h4><br>' +
              '<input name="dress_code" type="text" value="' + data.location.dress_code + '" placeholder="Kleding">' +
              '</div>';

      form += '<br><br>' +
              '<button data-submit>Opslaan</button>' +
              '</form>';

      mondial.dialog.createShow('location-edit', form, 'Locatie bewerken', true);

    }

  });

}

/* TASK
============================= */

mondial.task.add = function(date = 'today', selectUser = 'default') {

  jQuery.post('/script/ajax/task-form.php', function(res) {

    if (res) {

      var data = jQuery.parseJSON(res);

      var form = '';

      // User select

      form += '<form data-form="task">' +
              '<div data-formsection="user">' +
              '<h4>Gebruiker</h4><br>' +
              '<select name="user" required>';

      if (selectUser == 'default') form += '<option selected disabled>Maak een keuze</option>';

      jQuery.each(data.users, function(key, user) {

        if (user.id == selectUser) form += '<option value="' + user.id + '" selected>' + user.firstname + ' ' + user.lastname + '</option>';
        else form += '<option value="' + user.id + '">' + user.firstname + ' ' + user.lastname + '</option>';

      });

      form += '</select>' +
              '<br><br><hr><br>' +
              '</div>';

      // Date and time

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
              '<input type="date" name="date_end" value="' + date + '" class="date-time" required><input type="time" name="time_end" value="09:00" class="date-time" required>' +
              '</td>' +
              '</tr>' +
              '</table>' +
              '</div>' +
              '<br><hr><br>';

      // Task description

      form += '<div data-formsection="description">' +
              '<h4>Taakomschrijving</h4><br>' +
              '<input name="description" type="text" placeholder="Taakomschrijving">' +
              '</div>';

      form += '<br><br>' +
              '<button data-submit>Toevoegen</button>' +
              '</form>';

      mondial.dialog.createShow('task-add', form, 'Nieuwe taak', true);

    }

  });

}

mondial.task.edit = function(id) {

  jQuery.post('/script/ajax/task-form.php', {

    id: id

  }, function(res) {

    if (res) {

      var data = jQuery.parseJSON(res);

      var form = '';

      form += '<form data-form="task">' +
              '<input name="task" type="hidden" value="' + data.task.id + '">';

      // User select

      form += '<div data-formsection="user">' +
              '<h4>Gebruiker</h4><br>' +
              '<select name="user" required disabled>';

      jQuery.each(data.users, function(key, user) {

        if (user.id == data.task.user_id) form += '<option value="' + user.id + '" selected>' + user.firstname + ' ' + user.lastname + '</option>';
        else form += '<option value="' + user.id + '">' + user.firstname + ' ' + user.lastname + '</option>';

      });

      form += '</select>' +
              '<br><br><hr><br>' +
              '</div>';

      // Date and time

      form += '<form data-form="task">' +
              '<div data-formsection="datetime">' +
              '<h4>Datum &amp; tijd</h4><br>' +
              '<table style="margin:0;padding:0;">' +
              '<tr>' +
              '<td>' +
              '<input type="date" name="date_start" value="' + data.task.date_start + '" class="date-time" required><input type="time" name="time_start" value="' + data.task.time_start + '" class="date-time" required>' +
              '</td>' +
              '<td style="padding:0 16px;">-</td>' +
              '<td>' +
              '<input type="date" name="date_end" value="' + data.task.date_end + '" class="date-time" required><input type="time" name="time_end" value="' + data.task.time_end + '" class="date-time" required>' +
              '</td>' +
              '</tr>' +
              '</table>' +
              '</div>' +
              '<br><hr><br>';

      // Task description

      form += '<div data-formsection="description">' +
              '<h4>Taakomschrijving</h4><br>' +
              '<input name="description" type="text" value="' + data.task.description + '" placeholder="Taakomschrijving">' +
              '<br><br><hr><br>' +
              '</div>';

      // Complete

      form += '<div data-formsection="complete">';

      if (data.task.complete == 1) form += '<input id="task-complete" name="complete" type="checkbox" checked>';
      else form += '<input id="task-complete" name="complete" type="checkbox">';


      form += '<label for="task-complete">Voltooid</label>' +
              '</div>';

      form += '<br><br>' +
              '<button data-submit>Opslaan</button>' +
              '</form>';

      mondial.dialog.createShow('task-edit', form, 'Taak bewerken', true);

    }

  });

}

mondial.task.complete = function(id) {

  jQuery.post('/script/ajax/task-complete.php', {

    id: id

  }, function(res) {

    if (res) location.reload();

  });

}

/* FILES
============================= */

mondial.file.delete = function(file) {

  jQuery.post('/script/ajax/file-delete.php', {

    file: file

  }, function(res) {

    if (res) location.reload();

  });

}

/* AVAILABILITY
============================= */

mondial.availability.add = function(date = 'today', selectUser = 'default') {

  if (!mondial.postCooldown) {

    mondial.postCooldown = true;
    mondial.postTimeout = setTimeout(function() { mondial.postCooldown = false; }, 3000);

    jQuery.post('/script/ajax/availability-form.php', function(res) {

      if (res) {

        var data = jQuery.parseJSON(res);

        var form = '';

        // User select

        form += '<form data-form="availability">' +
                '<div data-formsection="user">' +
                '<h4>Gebruiker</h4><br>' +
                '<select name="user" required>';

        if (selectUser == 'default') form += '<option selected disabled>Maak een keuze</option>';

        jQuery.each(data.users, function(key, user) {

          if (user.id == selectUser) form += '<option value="' + user.id + '" selected>' + user.firstname + ' ' + user.lastname + '</option>';
          else form += '<option value="' + user.id + '">' + user.firstname + ' ' + user.lastname + '</option>';

        });

        form += '</select>' +
                '<br><br><hr><br>' +
                '</div>';

        // Availability

        form += '<div data-formsection="type">' +
                '<h4>Beschikbaarheid</h4><br>' +
                '<select name="type" required>';

        jQuery.each(data.types, function(key, type) {

          form += '<option value="' + type.id + '">' + type.description + '</option>';

        });

        form += '</select>' +
                '<br><br><hr><br>' +
                '</div>';

        // Date and time

        if (date == 'today') date = data.date;

        form += '<div data-formsection="period">' +
                '<h4>Periode</h4><br>' +
                '<table style="margin:0;padding:0;">' +
                '<tr>' +
                '<td>' +
                '<input type="date" name="date_start" value="' + date + '" class="date-time" required><input type="time" name="time_start" value="09:00" class="date-time" required>' +
                '</td>' +
                '<td style="padding:0 16px;">-</td>' +
                '<td>' +
                '<input type="date" name="date_end" value="' + date + '" class="date-time" required><input type="time" name="time_end" value="09:00" class="date-time" required>' +
                '</td>' +
                '</tr>' +
                '<tr>' +
                '<td>' +
                'Herhalen iedere ' +
                '</td>' +
                '<td>' +
                '<select name="repeat">' +
                '<option value="0">Niet herhalen</option>' +
                '<option value="1">Dag</option>' +
                '<option value="2">Week</option>' +
                '<option value="3">Maand</option>' +
                '<option value="4">Jaar</option>' +
                '</select>' +
                '</td>' +
                '</tr>' +
                '</table>' +
                '<br><hr><br>' +
                '</div>';

        // Comment

        form += '<div data-formsection="comment">' +
                '<h4>Opmerking</h4><br>' +
                '<input type="text" name="comment" placeholder="Opmerking">' +
                '</div>';

        form += '<br><br>' +
                '<button data-submit>Toevoegen</button>' +
                '</form>';

        mondial.dialog.createShow('availability-add', form, 'Nieuw Beschikbaar / Onbeschikbaar', true);

      }

    });

  }

}

mondial.availability.edit = function(id) {

  jQuery.post('/script/ajax/availability-form.php', {

    id: id

  }, function(res) {

    if (res) {

      var data = jQuery.parseJSON(res);

      var form = '';

      // User select

      form += '<form data-form="availability">' +
              '<input name="id" type="hidden" value="' + data.availability.id + '">' +
              '<div data-formsection="user">' +
              '<h4>Gebruiker</h4><br>' +
              '<select name="user" required disabled>';

      jQuery.each(data.users, function(key, user) {

        if (user.id == data.availability.user_id) form += '<option value="' + user.id + '" selected>' + user.firstname + ' ' + user.lastname + '</option>';
        else form += '<option value="' + user.id + '">' + user.firstname + ' ' + user.lastname + '</option>';

      });

      form += '</select>' +
              '<br><br><hr><br>' +
              '</div>';

      // Availability

      form += '<div data-formsection="type">' +
              '<h4>Beschikbaarheid</h4><br>' +
              '<select name="type" required>';

      jQuery.each(data.types, function(key, type) {

        if (type.id == data.availability.type_id) form += '<option value="' + type.id + '" selected>' + type.description + '</option>';
        else form += '<option value="' + type.id + '">' + type.description + '</option>';

      });

      form += '</select>' +
              '<br><br><hr><br>' +
              '</div>';

      // Date and time

      form += '<form data-form="task">' +
              '<div data-formsection="datetime">' +
              '<h4>Periode</h4><br>' +
              '<table style="margin:0;padding:0;">' +
              '<tr>' +
              '<td>' +
              '<input type="date" name="date_start" value="' + data.availability.date_start + '" class="date-time" required><input type="time" name="time_start" value="' + data.availability.time_start + '" class="date-time" required>' +
              '</td>' +
              '<td style="padding:0 16px;">-</td>' +
              '<td>' +
              '<input type="date" name="date_end" value="' + data.availability.date_end + '" class="date-time" required><input type="time" name="time_end" value="' + data.availability.time_end + '" class="date-time" required>' +
              '</td>' +
              '</tr>' +
              '<tr>' +
              '<td>' +
              'Herhalen iedere ' +
              '</td>' +
              '<td>' +
              '<select name="repeat">' +
              '<option value="0">Niet herhalen</option>' +
              '<option value="1">Dag</option>' +
              '<option value="2">Week</option>' +
              '<option value="3">Maand</option>' +
              '<option value="4">Jaar</option>' +
              '</select>' +
              '</td>' +
              '</tr>' +
              '</table>' +
              '</div>' +
              '<br><hr><br>';

      // Comment

      form += '<div data-formsection="comment">' +
              '<h4>Opmerking</h4><br>' +
              '<input type="text" name="comment" value="' + data.availability.comment + '" placeholder="Opmerking">' +
              '</div>';

      form += '<br><br>' +
              '<button data-submit>Opslaan</button>' +
              '</form>';

      mondial.dialog.createShow('availability-edit', form, 'Beschikbaar / Onbeschikbaar bewerken', true);

    }

  });

}
