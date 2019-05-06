mondial.dialog = {};

jQuery(function() {

  jQuery(document).on('click', function() {

    mondial.dialog.hideAll();

  });

  jQuery('[data-showdialog]').on('click', function(e) {

    e.stopPropagation();

    mondial.dialog.show(jQuery(this).data('showdialog'));

  });

  jQuery(document).on('click', '[data-dialog]', function(e) {

    e.stopPropagation();

  });

  jQuery(document).on('click', '[data-dialog] .dialog-close', function(e) {

    e.stopPropagation();

    mondial.dialog.hideAll();

  });

});

mondial.dialog.create = function(dialog_id, content, title = 'Dialog', replace = true) {

  if (!jQuery('[data-dialogs]').length) {

    var container = '<div data-dialogs="" class="dialogs" style="display: block;">' +
                    '<div class="dialogs-container"></div>' +
                    '</div>';

    jQuery('body').append(container);

  }

  var dialog = '';

  dialog += '<div data-dialog="' + dialog_id + '" class="dialog">' +
            '<div class="dialog-header"><h3>' + title + '</h3><div class="dialog-close">x</div></div>' +
            '<div class="dialog-content">' + content + '</div>' +
            '</div>';

  if (jQuery('[data-dialog="' + dialog_id + '"]').length) {

    if (replace) jQuery('[data-dialog="' + dialog_id + '"]').replaceWith(dialog);

  } else {

    jQuery('[data-dialogs] .dialogs-container').append(dialog);

  }

}

mondial.dialog.show = function(dialog) {

  jQuery('body').css('overflow-y', 'hidden');

  var thisDialog = jQuery('[data-dialogs], [data-dialog="' + dialog + '"]');

  if (thisDialog.find('[data-dialogtab]').length) {

    var firstTab = thisDialog.find('[data-dialogtab]:first'),
        firstTabId = firstTab.data('dialogtab');

    mondial.dialog.showTab(firstTabId);

  }

  thisDialog.show();

}

mondial.dialog.createShow = function(dialog_id, content, title = 'Dialog', replace = true) {

  mondial.dialog.create(dialog_id, content, title, replace);
  mondial.dialog.show(dialog_id);

}

mondial.dialog.hideAll = function() {

  jQuery('body').css('overflow-y', 'auto');

  jQuery('[data-dialogs], [data-dialog]').hide();

}

mondial.dialog.showTab = function(tab) {

  jQuery('[data-showdialogtab]').removeClass('active');
  jQuery('[data-showdialog] .dialog-tab-content').hide();
  jQuery('[data-showdialogtab="' + tab + '"] .dialog-tab-content').addClass('active');
  jQuery('[data-dialogtab="' + tab + '"]').show();

}
