mondial.user = {};

jQuery(function() {

  jQuery('[data-button="sign-in"]').on('click', function() {

    var email = jQuery('input[name="email"]').val(),
        password = jQuery('input[name="password"]').val();

    mondial.user.signIn(email, password);

  });

  jQuery('#sign-in input').keydown(function(e) {

    if (e.keyCode == 13) {

      var email = jQuery('input[name="email"]').val(),
          password = jQuery('input[name="password"]').val();

      mondial.user.signIn(email, password);

    }

  });

  jQuery(document).on('submit', '[data-form="user"]', function(e) {

    e.preventDefault();

    var form = jQuery(this),
        errors = 0;

    if (!form.find('[name="firstname"]').val().length) errors++;
    if (!form.find('[name="lastname"]').val().length) errors++;
    if (!form.find('[name="role"]').val()) errors++;
    if (!form.find('[name="email"]').val().length) errors++;
    if (!form.find('[name="password"]').val().length) errors++;
    if (!form.find('[name="password_repeat"]').val().length) errors++;

    if (errors) {

      alert('Vul alle nodige velden in!');

    } else {

      var data = {
        firstname: form.find('[name="firstname"]').val(),
        lastname: form.find('[name="lastname"]').val(),
        role_id: form.find('[name="role"]').val(),
        email: form.find('[name="email"]').val(),
        password: form.find('[name="password"]').val(),
        password_repeat: form.find('[name="password_repeat"]').val(),
      };

      var postData = JSON.stringify(data);

      jQuery.post('/script/ajax/user-update.php', {

        data: postData

      }, function(res) {

        if (res) location.href = '/users/' + res;

      });

    }

  });

});

mondial.user.signIn = function(email, password) {

  jQuery.post('/script/ajax/sign-in.php', {

      email: email,
      password: password

  }, function(res) {

    if (res) {

      location.reload();

    } else {

      jQuery('.sign-in-box').effect('shake', { distance: 10, times: 3 }, 600);

    }

  });

}

mondial.user.signOut = function() {

  // Nothing yet

}

mondial.user.add = function() {

  jQuery.post('/script/ajax/user-form.php', function(res) {

    if (res) {

      var data = jQuery.parseJSON(res);

      var form = '';

      // Name

      form += '<form data-form="user" id="user-add">' +
              '<div data-formsection="name">' +
              '<h4>Naam</h4><br>' +
              '<input name="firstname" type="text" placeholder="Voornaam" class="half" required>' +
              '<input name="lastname" type="text" placeholder="Achternaam" class="half" required>' +
              '</div>' +
              '<br><hr><br>';

      // Role

      form += '<div data-formsection="role">' +
              '<h4>Gebruikersrol</h4><br>' +
              '<select name="role" required>';

      jQuery.each(data.roles, function(key, role) {

        form += '<option value="' + role.id + '">' + role.name + '</option>';

      });

      form += '</select>' +
              '<br><br><hr><br>' +
              '</div>';

      // E-mail address

      form += '<div data-formsection="email">' +
              '<h4>E-mailadres</h4><br>' +
              '<input name="email" type="email" placeholder="E-mailadres" required>' +
              '</div>' +
              '<br><hr><br>';

      // Password

      form += '<div data-formsection="password">' +
              '<h4>Wachtwoord</h4><br>' +
              '<input name="password" type="password" placeholder="Wachtwoord" class="half" required>' +
              '<input name="password_repeat" type="password" placeholder="Bevestigen" class="half" required>' +
              '</div>';

      form += '<br><br><span class="hint">Overige informatie kan later aan het profiel worden toegevoegd.</span><br>';

      form += '<br><br>' +
              '<button data-submit>Toevoegen</button>' +
              '</form>';

      mondial.dialog.createShow('user-add', form, 'Nieuwe gebruiker', true);

    }

  });

}
