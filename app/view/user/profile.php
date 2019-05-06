<?php include(VIEW_HEADER); ?>

<script>

    $(document).ready(function(){

        let current_region_id = $('#region-select').val();
        let current_city_id = $("#city-select").val();
        $('#city-select').empty().prop("disabled", true);

        if (Number(current_region_id) !== 0){
            $('#spinner').show();
            $.ajax({
                method: "GET",
                url: getHost() + "/public/api/get_city.php?region_id=" + current_region_id,
            })
            .done(function(data) {
                appendCitiesOptions(data);
                Number(current_region_id) !== 0 && $('#city-select').val(current_city_id).prop("disabled", false);
            })
            .fail(function(xhr) {
                console.log('error', xhr);
            });
        }

        $('#region-select').change(function(){
            let changed_region_id = $(this).val();
            let citySelectSelector = $('#city-select');
            citySelectSelector.empty().prop("disabled", true);

            if ( Number(changed_region_id) === 0 ){
                $('#region-select').find("option[selected=" + 'selected' + "]").attr('selected', false);
                citySelectSelector.find("option[selected=" + 'selected' + "]").attr('selected', false);

                $('#region-select').val(0);
                citySelectSelector.empty().append(getCityDefaultValue()).val(0);

                $('#region-select').find("option[value=" + 0 + "]").attr('selected', true);
                citySelectSelector.find("option[value=" + 0 + "]").attr('selected', true);
            } else {
                $('#spinner').show();

                $.ajax({
                    method: "GET",
                    url: getHost() + "/public/api/get_city.php?region_id=" + changed_region_id
                })
                .done(function(data) {
                    appendCitiesOptions(data);
                    citySelectSelector.prop("disabled", false);

                })
                .fail(function(xhr) {
                    console.log('error', xhr);
                });
            }


        });
    });

    function appendCitiesOptions(data){
        $('#city-select')
            .empty()
            .append(getCityDefaultValue());

        data.forEach(function(item){
            let option = document.createElement("option");
            option.value = item.city_id;
            option.text = item.title_en;
            $('#city-select').append(option);
        });

        $('#spinner').hide();
    }

    function getCityDefaultValue() {
        let option = document.createElement("option");
        option.value = 0;
        option.selected = true;
        option.text = 'select city';
        return option;
    }

    function getHost() {
        return `${location.protocol}//${window.location.host}`;
    }
</script>

<style>
    .skill-input-container {
        width: 100%;
    }
    .skill-input-container input {
        display: inline;
        width: 75%;
    }
    .skill-input-container button {
        display: inline;
        margin-left: 10px;
    }
    .custom-button {
        width: 50px;
        height: 50px;
        border-radius: 50%;
    }
    .custom-button div {
        transform: translateX(-1px);
    }
    .add-button-container {
        display: flex;
        align-items: center;
        justify-content: center;
        margin-top: 5px;
    }
    .spinner-container {
        display: flex;
        justify-content: center;
        align-items: center;
    }
    #spinner {
        position: absolute;
        display: none;
        width: 30px;
        height: 30px;
        border: 3px solid #bfbfbf85;
        border-radius: 50%;
        border-top-color: #0000009e;
        animation: spin 1s ease-in-out infinite;
        -webkit-animation: spin 1s ease-in-out infinite;
    }
    @keyframes spin {
        to { -webkit-transform: rotate(360deg); }
    }
    @-webkit-keyframes spin {
        to { -webkit-transform: rotate(360deg); }
    }

</style>

<main>

    <div class="main-header">

        <div data-search="users" class="search-container">

            <input type="search" placeholder="Zoek werknemer">

            <div class="search-results-container">

                <div class="search-results"></div>

            </div>

        </div>

        <?php include(VIEW_SNIPPET . 'user-menu.php'); ?>

    </div>

    <div class="main-content">

        <div class="employee-profile">

            <h2><?php echo $this_user['firstname'] . ' ' . $this_user['lastname']; ?></h2>

            <br><br>

            <div class="profile-left">

                <form id="user-data" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post"
                      class="boxed-sections" enctype="multipart/form-data">

                    <input name="user_uid" type="hidden" value="<?php echo $this_user['uid']; ?>">

                    <div class="boxed-section">

                        <h3>Details</h3>

                        <br>

                        <table class="no-padding">

                            <tr>

                                <td>Status</td>
                                <td colspan="2">
                                    <select name="profile_status">
                                        <option value="0">Unpublished</option>
                                        <option <?php echo $this_user['profile_status'] == 1 ? 'selected' : '';?> value="1">Published</option>
                                    </select>
                                </td>

                            </tr>

                            <tr>

                                <td>Avatar</td>
                                <?php
                                $current_avatar = !empty($this_user['avatar']) ? '/file/avatars/'.$this_user['uid'].'/'.$this_user['avatar'] : '/image/unknown_person.png'
                                ?>
                                <td colspan="2">

                                    <label class="user_avatar">
                                        <img src="<?php echo($current_avatar); ?>" />
                                        <input type="file" name="user_avatar">
                                    </label>
                                    <input type="hidden" name="old_user_avatar" value="<?php echo $this_user['avatar'] ?>" />
                                </td>

                            </tr>

                            <tr>

                                <td>Naam</td>

                                <td colspan="2">

                                    <input name="firstname" type="text" placeholder="Voornaam"
                                           value="<?php echo $this_user['firstname']; ?>" class="half" required>
                                    <input name="lastname" type="text" placeholder="Achternaam"
                                           value="<?php echo $this_user['lastname']; ?>" class="half" required>

                                </td>

                            </tr>

                            <tr>

                                <td>Geboortedatum</td>

                                <td colspan="2"><input name="birthdate" type="date" value="<?php echo $this_user['birthdate']; ?>"
                                                       required></td>

                            </tr>

                            <tr>

                                <td>Age</td>

                                <td colspan="2">
                                    <input name="age" type="number" min="0" value="<?php echo intval($this_user['age']); ?>" required>
                                </td>

                            </tr>

                            <tr>

                                <td>Location</td>

                                <td colspan="2">
                                    <input name="location" type="text" value="<?php echo $this_user['location']; ?>" required>
                                </td>

                            </tr>

                            <tr>

                                <td>Language</td>

                                <td colspan="2">
                                    <select name="languages[]" multiple>
                                        <?php
                                            foreach ((array)$this_user['languages_list'] as $id=>$language) {
                                                echo('<option value="'.$id.'" '.(in_array($id, $this_user['user_languages']) ? 'selected' : '').'>'.$language.'</option>');
                                            }
                                        ?>
                                    </select>
                                </td>

                            </tr>

                            <tr>

                                <td>Years experience</td>

                                <td colspan="2">
                                    <input name="years_experience" type="text" value="<?php echo $this_user['years_experience']; ?>" required>
                                </td>

                            </tr>

                            <tr>

                                <td>Relevant training</td>

                                <td colspan="2">
                                    <input name="relevant_training" type="text" value="<?php echo $this_user['relevant_training']; ?>" required>
                                </td>

                            </tr>

                            <tr>

                                <td>Rol</td>

                                <td colspan="2">

                                    <select name="role" required>

                                        <?php foreach ($user->roles() as $role) { ?>

                                            <?php if ($role['id'] == $this_user['role_id']) { ?>

                                                <option value="<?php echo $role['id']; ?>"
                                                        selected><?php echo $role['name']; ?></option>

                                            <?php } else { ?>

                                                <option value="<?php echo $role['id']; ?>"><?php echo $role['name']; ?></option>

                                            <?php } ?>

                                        <?php } ?>

                                    </select>

                                </td>

                            </tr>

                            <tr>

                                <td>In bezit van auto</td>

                                <td colspan="2">
                                    <select name="drivers_license">

                                        <option value="0">Nee</option>
                                        <option value="1" <?php echo $this_user['drivers_license'] == 1 ? 'selected' : '1'; ?>>Ja</option>


                                    </select>

                                </td>

                            </tr>

                            <tr>

                                <td>Skills (max 15)</td>
                                <td class="skill-input-container">
                                    <?php
                                    foreach ($this_user['skills'] as &$skill){
                                        echo('<div><input class="skill-input" name="skills[]" type="text" value="'.$skill['name'].'" placeholder="You skill" maxlength="80" /><button type="button" class="custom-button delete-button"><div>X</div></button></div>');
                                    }
                                    ?>
                                </td>

                                <td width="60" class="add-button-container">&nbsp;
                                    <button type="button" class="custom-button add-button">
                                        <div>+</div>
                                    </button>
                                </td>

                            </tr>
                            <script>
                                $( "body" ).on('click', '.delete-button', function() {
                                    $(this).parent().remove();
                                });

                               $( ".add-button" ).click(function() {
                                   $('.skill-input-container')
                                   .append('<div>' +
                                               '<input class="skill-input" ' +
                                                       'name="skills[]" ' +
                                                       'type="text" ' +
                                                       'placeholder="You skill" ' +
                                                       'maxlength="80" />' +
                                               '<button type="button" class="custom-button delete-button">' +
                                               '<div>X</div>' +
                                               '</button>' +
                                           '</div>');
                               });
                            </script>

                            <tr>
                                <td>Hourly rate</td>
                                <td colspan="2">
                                    <select name="hourly_rate">
                                        <option value="0">not set</option>
                                        <?php
                                        foreach ($hourly_rates as &$hourly_rate) {
                                            echo('<option '.($hourly_rate['id'] == $this_user['hourly_rate'] ? 'selected' : '').' value="'.$hourly_rate['id'].'">'.$hourly_rate['title'].' ('.$hourly_rate['rate'].')</option>');
                                        }
                                        ?>
                                    </select>
                                </td>

                            </tr>

                            <tr>
                                <td>Over mij</td>
                                <td colspan="2">
                                    <textarea name="about_me"><?php echo $this_user['about_me'] ?></textarea>
                                </td>

                            </tr>

                        </table>

                    </div>

                    <div class="boxed-section">

                        <h3>Gebruikersgegevens</h3>

                        <br>

                        <table class="no-padding">

                            <tr>

                                <td>E-mailadres</td>
                                <td><input name="email" type="email" value="<?php echo $this_user['email']; ?>"
                                           required></td>

                            </tr>

                            <tr>

                                <td>Wachtwoord</td>
                                <td>

                                    <input name="password" type="password" placeholder="Wachtwoord" class="half">
                                    <input name="password-repeat" type="password" placeholder="Herhaal wachtwoord"
                                           class="half">

                                </td>

                            </tr>

                        </table>

                    </div>
<!-- PLACE TO WORK START -->
                    <div class="boxed-section">

                        <h3>Place to work</h3>
                        <select name="place_to_work">
                            <?php
                            foreach ($this_user['places_to_work'] as $place_id=>$place_name){
                                if($place_name == $this_user['place_to_work']){
                                    $selected = 'selected="select"';
                                }else{
                                    $selected = '';
                                }
                                echo('<option '.$selected.' value="'.$place_id.'">'.$place_name.'</option>');
                            }
                            ?>
                        </select>

                    </div>
<!-- PLACE TO WORK END -->
                    <div class="boxed-section">

                        <h3>Contactgegevens</h3>

                        <br>

                        <table class="no-padding">

                            <tr>

                                <td>Telefoonnummer</td>
                                <td><input name="phone" type="text" value="<?php echo $this_user['phone']; ?>"></td>

                            </tr>

                        </table>

                    </div>

                    <div class="boxed-section">

                        <h3>Adresgegevens</h3>

                        <br>

                        <input name="street" type="text" value="<?php echo $this_user['street']; ?>"
                               placeholder="Straat" class="half">
                        <input name="street_number" type="number" value="<?php echo $this_user['street_number']; ?>"
                               placeholder="Nummer" class="quarter">
                        <input name="street_extra" type="text" value="<?php echo $this_user['street_extra']; ?>"
                               placeholder="Extra" class="quarter">

                        <br>

                        <input name="postal" type="text" value="<?php echo $this_user['postal']; ?>"
                               placeholder="Postcode" class="half">
                        <!--input name="city" type="text" value="<?php echo $this_user['city']; ?>" placeholder="Plaats"
                               class="half"-->

                        <br>

                        <input name="country" type="text" value="<?php echo $this_user['country']; ?>"
                               placeholder="Land">


                        <select name="region"  id="region-select">
                            <option value="0">Select region</option>
                            <?php

                            foreach ($this_user['regions'] as &$region) {
                                echo('<option '.(($this_user['region'] == $region['region_id']) ? 'selected="selected"' : '').' value="'.$region['region_id'].'">'.$region['title_en'].'</option>');
                            }
                            ?>
                        </select>

                        <div class="spinner-container">
                            <div id="spinner"></div>
                            <select name="city" id="city-select">
                                <option value="0">Select city</option>
                                <?php
                                    foreach ($this_user['cities'] as &$city) {
                                        echo('<option '.(($this_user['city'] == $city['city_id']) ? 'selected="selected"' : '').' value="'.$city['city_id'].'">'.$city['title_en'].'</option>');
                                    }
                                ?>
                            </select>
                        </div>

                    </div>

                    <div class="boxed-section">

                        <h3>Identificatie</h3>

                        <br>

                        <table class="no-padding">

                            <tr>

                                <td>Nationaliteit</td>

                                <td><input name="nationality" type="text"
                                           value="<?php echo $this_user['nationality']; ?>" placeholder="Nationaliteit">
                                </td>

                            </tr>

                            <tr>

                                <td>Geboorteplaats</td>

                                <td>

                                    <input name="birth_city" type="text" value="<?php echo $this_user['birth_city']; ?>"
                                           placeholder="Plaats" class="half">
                                    <input name="birth_country" type="text"
                                           value="<?php echo $this_user['birth_country']; ?>" placeholder="Land"
                                           class="half">

                                </td>

                            </tr>

                            <tr>

                                <td>Identificatie &amp; verloopdatum</td>

                                <td>

                                    <select name="identification" class="half">

                                        <?php foreach (identification_types() as $ident) { ?>

                                            <?php if ($ident['id_id'] == $this_user['id_id']) { ?>
                                                <option value="<?php echo $ident['id_id']; ?>"
                                                        selected><?php echo $ident['name']; ?></option>
                                            <?php } else { ?>
                                                <option
                                                value="<?php echo $ident['id_id']; ?>"><?php echo $ident['name']; ?></option><?php } ?>

                                        <?php } ?>

                                    </select>

                                    <input name="id_exp" type="date" value="<?php echo $this_user['id_exp']; ?>"
                                           class="half">

                                </td>

                            </tr>

                            <tr>

                                <td>BSN</td>

                                <td><input name="csn" type="number" value="<?php echo $this_user['csn']; ?>"
                                           placeholder="BSN"></td>

                            </tr>

                            <tr>

                                <td>Lengte</td>
                                <td><input name="length" type="number" step="any"
                                           value="<?php echo $this_user['length']; ?>"></td>

                            </tr>

                        </table>

                    </div>

                    <div class="boxed-section">

                        <h3>Contract &amp; pas</h3>

                        <br>

                        <table class="no-padding">

                            <tr>

                                <td>Type contract</td>
                                <td><input name="contract_type" type="number" step="any"
                                           value="<?php echo $this_user['wage']; ?>"></td>

                            </tr>

                            <tr>

                                <td>In dienst sinds</td>
                                <td><input name="service_start" type="date"
                                           value="<?php echo $this_user['service_start']; ?>"></td>

                            </tr>

                            <tr>

                                <td>Uurloon</td>
                                <td><input name="wage" type="number" step="any"
                                           value="<?php echo $this_user['wage']; ?>"></td>

                            </tr>

                            <tr>

                                <td>Rijskostenvergoeding</td>
                                <td><input name="travel_cost" type="number" step="any"
                                           value="<?php echo $this_user['travel_cost']; ?>"></td>

                            </tr>

                            <tr>

                                <td>Contract begin &amp; eind-datum</td>
                                <td>
                                    <input name="contract_start" type="date"
                                           value="<?php echo $this_user['contract_start']; ?>" class="half">
                                    <input name="contract_end" type="date"
                                           value="<?php echo $this_user['contract_end']; ?>" class="half">

                                </td>

                            </tr>

                            <tr>

                                <td>Pasnummer &amp; verloopdatum</td>

                                <td>

                                    <input name="card_number" type="number"
                                           value="<?php echo $this_user['card_number']; ?>" placeholder="Pasnummer"
                                           class="half">
                                    <input name="card_exp" type="date" value="<?php echo $this_user['card_exp']; ?>"
                                           class="half">

                                </td>

                            </tr>

                        </table>

                    </div>

                    <div class="boxed-section">
<!--
                        <h3>Kledingmaten</h3>

                        <br>

                        <table class="no-padding">
                            <tr>
                                <td>T-shirt</td>
                                <td>
                                    <select name="sizes_shirt">
                                        <option value="1">XS</option>
                                        <option value="2">S</option>
                                        <option value="3">M</option>
                                        <option value="4">L</option>
                                        <option value="5">XL</option>
                                        <option value="6">XXL</option>
                                    </select>
                                </td>
                            </tr>

                            <tr>

                                <td>Broek</td>

                                <td><input name="sizes_pants" type="number" step="any"
                                           value="<?php echo $this_user['clothing']['pants']; ?>" placeholder="Broek">
                                </td>

                            </tr>

                            <tr>

                                <td>Kostuum</td>

                                <td><input name="sizes_costume" type="number" step="any"
                                           value="<?php echo $this_user['clothing']['costume']; ?>"
                                           placeholder="Kostuum"></td>

                            </tr>

                            <tr>

                                <td>Schoenmaat</td>

                                <td><input name="sizes_shoes" type="number" step="any"
                                           value="<?php echo $this_user['clothing']['shoes']; ?>"
                                           placeholder="Schoenmaat"></td>

                            </tr>

                        </table>
-->
                        <br><br>

                        <input type="submit" value="Opslaan" class="button">

                    </div>

                </form>

                <!-- USER PORTFOLIO BEGIN -->
                <form id="user-portfolio" action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="post" class="boxed-sections" enctype="multipart/form-data">
                    <div class="boxed-section">
                        <h3>User portfolio</h3>

                        <div>
                            <input type="file" name="upload_portfolio_item[]" multiple="multiple" />
                            <button type="submit" name="upload_portfolio_items">Upload</button>
                        </div>
                </form>

                <div class="portfolio-grid">
                    <?php
                    foreach ($this_user['portfolio'] as $portfolio_item) {
                        echo('
                            <form id="user-portfolio-'.$portfolio_item['id'].'" action="'.$_SERVER['REQUEST_URI'].'" method="post" class="boxed-sections" enctype="multipart/form-data">
                                <div class="portfolio-grid-item">
                                    <img src="/file/user-portfolio/'.$portfolio_item['uid'].'/'.$portfolio_item['crop_size'].'" />
                                    <div class="section-header portfolio-grid-item-control-panel">
                                        <div class="header-left">
                                            <span class="filename">'.pathinfo($portfolio_item['full_size'], PATHINFO_BASENAME).'</span>
                                        </div>
                                        <div class="header-right">
                                            <input type="hidden" name="filename" value="'.$portfolio_item['full_size'].'" />
                                            <input type="hidden" name="user_id" value="'.$this_user['id'].'" />
                                            <button type="submit" name="delete_portfolio_item" value="'.$portfolio_item['id'].'">x</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        ');
                    }
                    ?>
                    <div class="clr"></div>
                </div>

            </div>

            <!-- USER PORTFOLIO END -->

            <div class="boxed-sections">

                <div class="boxed-section">

                    <h3>User video</h3>

                    <div>
                        <form id="add-user-video" action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="post" class="" enctype="multipart/form-data">
                            <input type="file" name="upload_user_video" />
                            <?php
                            $videos_count = count($this_user['videos']);
                            $foreign_video = 0;
                            for($i=0;$i<$videos_count; $i++){
                                if((isset($this_user['videos'][$i]['source'])) and ($this_user['videos'][$i]['source'] != 'local')){
                                    echo('<input type="text" id="link-to-video-'.$this_user['videos'][$i]['id'].'" name="link_to_video" placeholder="Paste link to video" value="'.$this_user['videos'][$i]['filename_or_link'].'" />');
                                    $foreign_video++;
                                }
                                echo('<button name="delete_user_video" value="'.$this_user['videos'][$i]['id'].'">Delete video</button>');
                            }
                            if($foreign_video == 0){
                                echo('<input type="text" id="link-to-video" name="link_to_video" placeholder="Paste link to video" value="" />');
                            }
                            ?>
                            <button type="submit" name="add_user_video">Add video</button>
                        </form>


                        <?php
                            $filename_or_link;
                            foreach ($this_user['videos'] as $usr){
                                $filename_or_link = $usr['filename_or_link'];
                            }
                        ?>

                        <video width="320" height="240" controls style="margin-top: 15px;">
                            <source src="<?= $filename_or_link ?>">
                            Your browser does not support the video tag.
                        </video>

                    </div>
                </div>

            </div>


            </div>

            <div class="profile-right">

                <!-- TASKS START -->

                <div class="boxed-sections">

                    <div class="boxed-section">

                        <div class="section-header">

                            <div class="header-left"><h3>Takenlijst</h3></div>
                            <div class="header-right">

                                <span onClick="mondial.task.add('today', <?php echo $this_user['id']; ?>);"
                                      class="button">Nieuwe taak</span>

                            </div>

                        </div>

                        <br>

                        <?php if (!count($this_user['tasks'])) {
                            echo 'Deze gebruiker heeft nog geen taken.';
                        } else { ?>

                            <table class="list">

                                <tr>

                                    <th></th>
                                    <th></th>
                                    <th>Datum</th>
                                    <th>Tijd</th>
                                    <th></th>

                                </tr>

                                <?php foreach ($this_user['tasks'] as $task) { ?>

                                    <tr data-task="<?php echo $task['id']; ?>">

                                        <?php if ($task['complete']) { ?>

                                            <td class="icon" style="width:44px;">
                                                <div class="list-icon icon-completed"
                                                     onClick="mondial.task.complete('<?php echo $task['id']; ?>')"></div>
                                            </td>

                                        <?php } else { ?>

                                            <td class="icon" style="width:44px;">
                                                <div class="list-icon icon-complete"
                                                     onClick="mondial.task.complete('<?php echo $task['id']; ?>')"></div>
                                            </td>

                                        <?php } ?>

                                        <td><?php echo $task['description']; ?></td>
                                        <td><?php echo date('j M Y', strtotime($task['time_start'])); ?></td>
                                        <td><?php echo date('H:i', strtotime($task['time_start'])); ?></td>
                                        <td class="icon" style="text-align:right;">
                                            <div class="list-icon icon-edit"
                                                 onClick="mondial.task.edit(<?php echo $task['id']; ?>)"></div>
                                        </td>

                                    </tr>

                                <?php } ?>

                            </table>

                        <?php } ?>

                    </div>

                </div>

                <!-- TASKS END -->

                <div class="boxed-sections">

                    <div class="boxed-section">

                        <div class="section-header">

                            <div class="header-left"><h3>Geplande diensten</h3></div>
                            <div class="header-right">

                                <span class="button button-left">Versturen</span>
                                <a href="/export?type=user-shifts&user=<?php echo $this_user['id']; ?>&period=upcoming"
                                   target="_blank" class="button button-inner">Exporteren</a>
                                <span class="button button-right"
                                      onClick="mondial.shift.add('today', 'default', <?php echo $this_user['id']; ?>);">Nieuwe dienst</span>

                            </div>

                        </div>

                        <br>

                        <table class="list">

                            <?php if (!count($shifts_upcoming)) {
                                echo 'Er zijn nog geen diensten gepland.';
                            } else { ?>

                                <tr>

                                    <th></th>
                                    <th>Datum</th>
                                    <th>Van</th>
                                    <th>Tot</th>
                                    <th>Lengte</th>
                                    <th>Pauze</th>
                                    <th>Opdrachtgever</th>
                                    <th>Locatie</th>
                                    <th></th>

                                </tr>

                            <?php } ?>

                            <?php foreach ($shifts_upcoming as $shift) { ?>

                                <tr data-shift="<?php echo $shift['uid']; ?>">

                                    <td class="checkbox"><input type="checkbox"></td>
                                    <td><?php echo date('j M Y', strtotime($shift['time_start'])); ?></td>
                                    <td><?php echo date('H:i', strtotime($shift['time_start'])); ?></td>
                                    <td><?php echo date('H:i', strtotime($shift['time_end'])); ?></td>
                                    <td><?php echo number_format($shift['hours'], 2, ',', '.') ?>u</td>
                                    <td><?php if ($shift['break']) echo $shift['break'] . 'm'; ?></td>
                                    <td>
                                        <a href="/employers/<?php echo $shift['employer_id']; ?>"><?php echo $shift['employer_name']; ?></a>
                                    </td>
                                    <td><?php echo $shift['location']; ?></td>
                                    <td style="text-align:right;">
                                        <div class="icon-edit"
                                             onClick="mondial.shift.edit('<?php echo $shift['uid']; ?>')"></div>
                                    </td>

                                </tr>

                            <?php } ?>

                        </table>

                    </div>

                    <div class="boxed-section">

                        <div class="section-header">

                            <div class="header-left"><h3>Voltooide diensten</h3></div>
                            <div class="header-right">

                                <a href="/export?type=user-shifts&user=<?php echo $this_user['id']; ?>&period=complete"
                                   target="_blank" class="button">Exporteren</a>

                            </div>

                        </div>

                        <br>

                        <table class="list">

                            <?php if (!count($shifts_completed)) {
                                echo 'Er zijn nog geen diensten voltooid.';
                            } else { ?>

                                <tr>

                                    <th></th>
                                    <th>Datum</th>
                                    <th>Van</th>
                                    <th>Tot</th>
                                    <th>Lengte</th>
                                    <th>Pauze</th>
                                    <th>Opdrachtgever</th>
                                    <th>Locatie</th>
                                    <th></th>

                                </tr>

                            <?php } ?>

                            <?php foreach ($shifts_completed as $shift) { ?>

                                <tr data-shift="<?php echo $shift['uid']; ?>">

                                    <td class="checkbox"><input type="checkbox"></td>
                                    <td><?php echo date('j M Y', strtotime($shift['time_start'])); ?></td>
                                    <td><?php echo date('H:i', strtotime($shift['time_start'])); ?></td>
                                    <td><?php echo date('H:i', strtotime($shift['time_end'])); ?></td>
                                    <td><?php echo number_format($shift['hours'], 2, ',', '.') ?>u</td>
                                    <td><?php if ($shift['break']) echo $shift['break'] . 'm'; ?></td>
                                    <td>
                                        <a href="/employers/<?php echo $shift['employer_id']; ?>"><?php echo $shift['employer_name']; ?></a>
                                    </td>
                                    <td><?php echo $shift['location']; ?></td>
                                    <td style="text-align:right;">
                                        <div class="icon-edit"
                                             onClick="mondial.shift.edit('<?php echo $shift['uid']; ?>')"></div>
                                    </td>

                                </tr>

                            <?php } ?>

                        </table>

                    </div>

                    <!-- LATE START -->

                    <div class="boxed-section">

                        <div class="section-header">

                            <div class="header-left"><h3>Telaatkomsten</h3></div>
                            <div class="header-right"></div>

                        </div>

                        <br>

                        <table class="list">

                            <?php if (!count($shifts_late)) {
                                echo 'Er zijn geen telaatkomsten geregistreerd.';
                            } else { ?>

                                <tr>

                                    <th></th>
                                    <th>Datum</th>
                                    <th>Van</th>
                                    <th>Tot</th>
                                    <th>Te laat</th>
                                    <th>Opdrachtgever</th>
                                    <th>Locatie</th>
                                    <th></th>

                                </tr>

                            <?php } ?>

                            <?php foreach ($shifts_late as $shift) { ?>

                                <tr data-shift="<?php echo $shift['uid']; ?>">

                                    <td class="checkbox"><input type="checkbox"></td>
                                    <td><?php echo date('j M Y', strtotime($shift['time_start'])); ?></td>
                                    <td><?php echo date('H:i', strtotime($shift['time_start'])); ?></td>
                                    <td><?php echo date('H:i', strtotime($shift['time_end'])); ?></td>
                                    <td><span style="color:#e74c3c;font-weight:600;"><?php echo $shift['late']; ?>
                                            minuten</span></td>
                                    <td>
                                        <a href="/employers/<?php echo $shift['employer_id']; ?>"><?php echo $shift['employer_name']; ?></a>
                                    </td>
                                    <td><?php echo $shift['location']; ?></td>
                                    <td style="text-align:right;">
                                        <div class="icon-edit"
                                             onClick="mondial.shift.edit('<?php echo $shift['uid']; ?>')"></div>
                                    </td>

                                </tr>

                            <?php } ?>

                        </table>

                    </div>

                    <!-- LATE END -->

                </div>

                <!-- AVAILABILITY START -->

                <div class="boxed-sections">

                    <div class="boxed-section">

                        <div class="section-header">

                            <div class="header-left"><h3>Beschikbaar / Onbeschikbaar</h3></div>
                            <div class="header-right">
                                <button onClick="mondial.availability.add('today', <?php echo $this_user['id']; ?>)">
                                    Toevoegen
                                </button>
                            </div>

                        </div>

                        <table class="list">

                            <tr>

                                <th></th>
                                <th></th>
                                <th>Van</th>
                                <th>Tot</th>
                                <th>Opmerking</th>

                            </tr>

                            <?php foreach ($this_user['availability'] as $availability) { ?>

                                <tr data-availability="<?php echo $availability['id']; ?>">

                                    <td class="<?php if (!$availability['type_id']) echo 'available'; else echo 'unavailable'; ?>">
                                        &bull;
                                    </td>
                                    <td><?php echo $availability['type']; ?></td>
                                    <td><?php echo date('j M Y H:i', strtotime($availability['time_start'])); ?></td>
                                    <td><?php echo date('j M Y H:i', strtotime($availability['time_end'])); ?></td>
                                    <td><?php echo $availability['comment']; ?></td>

                                </tr>

                            <?php } ?>

                        </table>

                    </div>

                </div>

                <div class="boxed-sections">

                    <div class="boxed-section">

                        <div class="section-header">

                            <div class="header-left"><h3>Availability</h3></div>
                            <div class="header-right"></div>

                        </div>
                        <form action="" method="post">
                            <table class="no-padding week">

                                <tr>

                                    <th>Day</th>
                                    <th><label for="availability-monday">Monday</label></th>
                                    <th><label for="availability-tuesday">Tuesday</label></th>
                                    <th><label for="availability-wednesday">Wednesday</label></th>
                                    <th><label for="availability-thursday">Thursday</label></th>
                                    <th><label for="availability-friday">Friday</label></th>
                                    <th><label for="availability-saturday">Saturday</label></th>
                                    <th><label for="availability-sunday">Sunday</label></th>

                                </tr>

                                <tr>

                                    <td></td>
                                    <td><input <?php echo($this_user['user_weekday_availability']['monday'] != '0' ? 'checked' : '') ?> id="availability-monday" name="availability_monday" type="checkbox" /></td>
                                    <td><input <?php echo($this_user['user_weekday_availability']['tuesday'] != '0' ? 'checked' : '') ?> id="availability-tuesday" name="availability_tuesday" type="checkbox" /></td>
                                    <td><input <?php echo($this_user['user_weekday_availability']['wednesday'] != '0' ? 'checked' : '') ?> id="availability-wednesday" name="availability_wednesday" type="checkbox" /></td>
                                    <td><input <?php echo($this_user['user_weekday_availability']['thursday'] != '0' ? 'checked' : '') ?> id="availability-thursday" name="availability_thursday" type="checkbox" /></td>
                                    <td><input <?php echo($this_user['user_weekday_availability']['friday'] != '0' ? 'checked' : '') ?> id="availability-friday" name="availability_friday" type="checkbox" /></td>
                                    <td><input <?php echo($this_user['user_weekday_availability']['saturday'] != '0' ? 'checked' : '') ?> id="availability-saturday" name="availability_saturday" type="checkbox" /></td>
                                    <td><input <?php echo($this_user['user_weekday_availability']['sunday'] != '0' ? 'checked' : '') ?> id="availability-sunday" name="availability_sunday" type="checkbox" /></td>

                                </tr>

                                <tr>

                                    <td colspan="1">Num of hours</td>
                                    <td colspan="7">
                                        <select name="availability_num_of_hours">
                                            <?php
                                                echo('<option '.($this_user['user_weekday_availability']['hours'] == 0 ? 'selected' : '').' value="0">not set</option>');
                                                for($i=0; $i<8;){
                                                    $i = $i + 2;
                                                    echo('<option '.($this_user['user_weekday_availability']['hours'] == $i ? 'selected' : '').' value="'.$i.'">'.$i.'</option>');
                                                }
                                            ?>
                                        </select>
                                    </td>

                                </tr>
                                <tr>

                                    <td colspan="7">
                                        <input type="hidden" name="availability_list_id" value="<?php echo $this_user['user_weekday_availability']['id']; ?>"/>
                                        <button type="submit" name="change_availability" class="">Save changes</button>
                                    </td>

                                </tr>

                            </table>

                        </form>

                    </div>

                </div>

                <!-- AVAILABILITY END -->

                <div class="boxed-sections">

                    <div class="boxed-section">

                        <div class="section-header">

                            <div class="header-left"><h3>Uitbetalingen</h3></div>
                            <!--<div class="header-right"><button data-submit>Exporteren</button></div>-->

                        </div>

                        <br>

                        <table class="list">

                            <tr>

                                <th>Maand</th>
                                <th>Uren</th>
                                <th>Schatting</th>
                                <th>Uitbetaald</th>

                            </tr>

                            <?php foreach ($this_user['paychecks'] as $date => $paycheck) { ?>

                                <tr>

                                    <td><?php echo date('F Y', strtotime($date)); ?></td>
                                    <td></td>
                                    <td>&euro; <?php echo number_format($paycheck, 2, ',', '.'); ?></td>
                                    <td></td>

                                </tr>

                            <?php } ?>

                        </table>

                    </div>

                </div>
<!-- COMMENTS BEGIN -->
                <div class="boxed-sections">

                    <div class="boxed-section">

                        <div class="section-header">

                            <div class="boxed-section header"><h3>Reviews</h3></div>

                        </div>
                            <?php
                            foreach ($this_user['user_rewiews'] as $rewiew) {
                                echo('
                            <form id="edit-user-rewiew-'.$rewiew['id'].'" action="'.$_SERVER['REQUEST_URI'].'" method="post">
                            <table class="no-padding">
                                <tr>
                                    <td>
                                        Author:
                                    </td>
                                    <td>
                                        <input required maxlength="255" type="text" name="rewiew_author" value="'.$rewiew['author'].'" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Company name:
                                    </td>
                                    <td>
                                        <input maxlength="255" type="text" name="rewiew_company_name" value="'.$rewiew['company_name'].'" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Company site:
                                    </td>
                                    <td>
                                        <input maxlength="255" type="text" name="rewiew_company_site" value="'.$rewiew['company_site'].'" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Rating:
                                    </td>
                                    <td>
                                        <select name="rewiew_rating">
                                            <option '.($rewiew['rating'] == 0 ? 'selected="select"' : '').' value="0">not set</option>
                                            <option '.($rewiew['rating'] == 1 ? 'selected="select"' : '').' value="1">1</option>
                                            <option '.($rewiew['rating'] == 2 ? 'selected="select"' : '').' value="2">2</option>
                                            <option '.($rewiew['rating'] == 3 ? 'selected="select"' : '').' value="3">3</option>
                                            <option '.($rewiew['rating'] == 4 ? 'selected="select"' : '').' value="4">4</option>
                                            <option '.($rewiew['rating'] == 5 ? 'selected="select"' : '').' value="5">5</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <textarea required maxlength="500" name="rewiew_text" placeholder="Text rewiew. Max 500 symbols">'.$rewiew['review'].'</textarea>
                                    </td>
                                </tr>
                                <tr class="boxed-section">
                                    <td colspan="2">
                                        <div class="section-header">
                                            <input type="hidden" name="rewiew_id" value="'.$rewiew['id'].'" />
                                            <div class="header-left">
                                                <button type="submit" name="delete_rewiew" class="">Delete rewiew</button>
                                            </div>
                                            <div class="header-right">
                                                <button type="submit" name="edit_rewiew" class="">Save changes</button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </form>
                            ');
                        }
                        ?>
                    </div>

                    <div class="boxed-section">

                        <div class="section-header">

                            <div class="header"><h3>Add new rewiew</h3></div>

                        </div>

                        <form id="add-user-rewiew" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
                            <table class="no-padding">
                                <tr>
                                    <td>
                                        <input maxlength="255" name="rewiew_author" required type="text" placeholder="Rewiew author" /><br>
                                        <input maxlength="255" name="rewiew_company_name" type="text" placeholder="Company name" />
                                        <input maxlength="255" name="rewiew_company_site" type="text" placeholder="Company site" />
                                        <select name="rewiew_rating">
                                            <option value="0">Rating</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <textarea required maxlength="500" name="rewiew_text" placeholder="Text rewiew. Max 500 symbols"></textarea>
                                    </td>
                                </tr>
                                <tr class="section-header">
                                    <td class="header-left">&nbsp;</td>
                                    <td class="header-right">
                                        <input type="hidden" name="user_id" value="<?php echo(explode('/', $_SERVER['REQUEST_URI'])[2]); ?>" />
                                        <button type="submit" name="new_rewiew" class="">Add new rewiew</button>
                                    </td>
                                </tr>
                            </table>
                        </form>

                    </div>

                </div>

                <div class="boxed-sections">

                    <div class="boxed-section">
                        <div class="section-header">

                            <div class="header"><h3>Previous work experience</h3></div>

                        </div>

                        <?php
                        if(!empty($this_user['previous_work_experience'])){
                            echo('<div class="boxed-section">');
                                foreach ($this_user['previous_work_experience'] as $previous_work_experience) {
                                    echo('
                                    <form id="edit-prewious-work-experience-'.$previous_work_experience['id'].'" action="'.$_SERVER['REQUEST_URI'].'" method="post" enctype="multipart/form-data">
                                    
                                        <div class="section-header">
            
                                            <div class="header-left"><input type="text" name="title" value="'.$previous_work_experience['title'].'" /></div>
                                            <div class="header-right">
                                                <img src="/file/previous-work-experience/'.$previous_work_experience['uid'].'/company-logo/'.$previous_work_experience['logo_file_name'].'" width="70px" /><br>
                                                <input type="file" name="new_company_logo" />
                                                <input type="hidden" name="old_company_logo" value="/file/previous-work-experience/'.$previous_work_experience['uid'].'/company-logo/'.$previous_work_experience['logo_file_name'].'" />
                                            </div>
            
                                        </div>
                                        
                                        <div>
                                            <label>
                                                Description
                                                <textarea name="description" maxlength="1000" required>'.$previous_work_experience['description'].'</textarea>
                                            </label>
                                        </div>
                                        <div>
                                            <label>
                                                Date start<br>
                                                <input type="date" name="start_to_work" value="'.$previous_work_experience['start_to_work'].'" required />
                                            </label>
                                            <label>
                                                Date stop<br>
                                                <input class="half" type="date" name="stop_to_work" value="'.$previous_work_experience['stop_to_work'].'" />
                                                <label class="half"><input type="checkbox" name="contract_end_current_time" '.($previous_work_experience['contract_end_current_time'] == 1 ? 'checked' : '').' /> Heden</label>
                                            </label>
                                        </div>
                                        <div class="section-header">
                                            <div class="header-left">
                                                <button type="submit" name="delete_record_of_previous_work_experience" class="">Delete</button>
                                            <div class="header-right">
                                                <input type="hidden" name="record_id" value="'.$previous_work_experience['id'].'" />
                                                <input type="hidden" name="uid" value="'.$this_user['uid'].'" />
                                                <button type="submit" name="update_record_of_previous_work_experience" class="">Save changes</button>
                                            </div>
                                        </div>
                                        </div>
                                        
                                    </form>');
                                }
                            echo('</div>');
                        }else{
                            echo('No prewious work expirience');
                        }

                        ?>
                    </div>

                    <div class="boxed-section">

                        <div class="section-header">

                            <div class="header"><h3>Add previous work experience</h3></div>

                        </div>

                        <form id="prewious-work-experience" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" enctype="multipart/form-data">
                            <table class="no-padding">
                                <tr>
                                    <td>
                                        Company logo
                                    </td>
                                    <td>
                                        <input type="file" name="company_logo" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Titile
                                    </td>
                                    <td>
                                        <input type="text" name="title" maxlength="254" required />
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Description
                                    </td>
                                    <td>
                                        <textarea name="description" maxlength="1000" required></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Start to work
                                    </td>
                                    <td>
                                        <input type="date" name="start_to_work" required />
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Stop to work
                                    </td>
                                    <td>
                                        <input type="date" name="stop_to_work" class="half" />
                                        <label class="half"><input type="checkbox" name="contract_end_current_time" <?php echo $this_user['contract_end_current_time'] == 1 ? 'checked' : '' ?>/> Heden</label>
                                    </td>
                                </tr>
                                <tr class="section-header">
                                    <td colspan="2" align="right">
                                        <input type="hidden" name="uid" value="<?php echo $this_user['uid']; ?>" />
                                        <button type="submit" name="new_record_of_previous_work_experience" class="">Add new record of previous work experience</button>
                                    </td>
                                </tr>
                            </table>
                        </form>

                    </div>

                </div>
<!-- COMMENTS END -->
                <div class="boxed-sections">

                    <div class="boxed-section">

                        <div class="section-header">

                            <div class="header-left"><h3>Bestanden</h3></div>

                        </div>

                        <br>

                        <form action="/upload" id="user-dropzone" class="dropzone"
                              data-useruid="<?php echo $this_user['uid']; ?>">

                            <div class="fallback">

                                <input name="file" type="file" multiple/>

                            </div>

                        </form>

                    </div>

                    <div class="boxed-section">

                        <table class="list">

                            <?php if (!count($this_user['files'])) {
                                echo 'Er zijn nog geen bestanden geupload.';
                            } else { ?>

                                <tr>

                                    <th>Bestand</th>
                                    <th>Geupload</th>
                                    <th>Grootte</th>
                                    <th></th>
                                    <th></th>

                                </tr>

                            <?php } ?>

                            <?php foreach ($this_user['files'] as $user_file) { ?>

                                <tr>

                                    <td>
                                        <a href="/file/<?php echo $this_user['uid']; ?>/<?php echo $user_file['name']; ?>"
                                           target="_blank"><?php echo $user_file['name']; ?></a></td>
                                    <td><?php echo date('j M Y', strtotime($user_file['created'])); ?></td>
                                    <td><?php echo number_format(round($user_file['size'] / 1000, 2), 2, ',', '.'); ?>
                                        kB
                                    </td>
                                    <td class="icon" style="text-align:right;width:32px;"><a
                                                href="/file/<?php echo $this_user['uid']; ?>/<?php echo $user_file['name']; ?>"
                                                target="_blank" class="list-icon icon-download"></a></td>
                                    <td class="icon" style="text-align:right;width:32px;">
                                        <div class="list-icon icon-delete"
                                             onClick="mondial.file.delete('<?php echo $this_user['uid']; ?>/<?php echo $user_file['name']; ?>')"></div>
                                    </td>

                                </tr>

                            <?php } ?>

                        </table>

                    </div>

                </div>

                <div class="boxed-sections">

                    <div class="boxed-section">

                        <div class="section-header">

                            <div class="header-left"><h3>Diplomas</h3></div>

                        </div>

                        <br>

                        <form action="/add-education-sertificats" id="add-education-sertificats-dropzone" class=""
                              data-useruid="<?php echo $this_user['uid']; ?>" method="post" enctype="multipart/form-data">

                            <div class="fallback dropzone">

                                <input name="education-certificats[]" type="file" multiple/>

                            </div>
                            <label><input type="radio" name="education-certificats-type" value="diploma" required> Diplomas</label>
                            <label><input type="radio" name="education-certificats-type" value="certificate" required> Certificate</label>


                            <input type="hidden" name="user_id" value="<?php echo($this_user['id']); ?>">
                            <input type="hidden" name="user_uid" value="<?php echo($this_user['uid']); ?>">
                            <input type="text" name="education-certificate-title" required />
                            <input type="submit" value="Send">
                        </form>

                    </div>

                    <div class="boxed-section">

                        <table class="list">

                            <?php if (!count($this_user['user_education_certificats'])) {
                                echo 'Er zijn nog geen bestanden geupload.';
                            } else { ?>

                                <tr>

                                    <th>File</th>
                                    <th>Type</th>
                                    <th></th>
                                    <th></th>

                                </tr>

                            <?php } ?>

                            <?php foreach ($this_user['user_education_certificats'] as $user_education_certificate) {

                                if(file_exists(APP.'/education-certificats/'.$user_education_certificate['type'].'/'.$this_user['uid'].'/'.$user_education_certificate['file_name'])){
                                    echo('
                                    <tr>

                                        <td>
                                            <a href="/education-certificats/'.$user_education_certificate['type'].'/'.$this_user['uid'].'/'.$user_education_certificate['file_name'].'" target="_blank">'.$user_education_certificate['title'].'</a>
                                        </td>
                                        <td>'.$user_education_certificate['type'].'</td>
                                        <td class="icon" style="text-align:right;width:32px;">
                                            <a href="/education-certificats/'.$user_education_certificate['type'].'/'.$this_user['uid'].'/'.$user_education_certificate['file_name'].'" target="_blank" class="list-icon icon-download"></a>
                                        </td>
                                        <td class="icon" style="text-align:right;width:32px;">
                                            <div class="list-icon icon-delete" onClick="mondial.file.delete('.$this_user['uid'].'/'.$user_education_certificate['file_name'].')"></div>
                                        </td>
    
                                    </tr>
                                    ');
                                }

                                ?>



                            <?php } ?>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    </div>

</main>

<?php include(VIEW_FOOTER); ?>
