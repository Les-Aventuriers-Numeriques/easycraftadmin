// ------------------------------------------------------------------------ //
// FONCTIONS
// ------------------------------------------------------------------------ //

var AUTOUPDATE_CHAT = true;

/**
 * Envoie un message sur le chat
 */
function sendTextMsg() {
  var textmsg_input = $('input#textmsg');
  var textmsg = textmsg_input.val();

  if (textmsg == '' || textmsg == null) {
    return;
  }

  $.post('ajax/textmsg', {textmsg: textmsg},
    function(data) {
      textmsg_input.val('');
      updateChat();
    }
  );
}

/**
 * Récupère le nom du joueur
 */
function getPlayerName(element) {
  return element.parent().parent().parent().parent().parent().attr('id').replace('tr_', '');
}

function getPlayerTr(player_name) {
  return $('tr[id="tr_'+player_name+'"]');
}

/**
 * Affiche une boite de dialogue modale
 */
function showModalDialog(modal_name, title, params, close, save) {
  var modal = $('div#modal_dialog');

  $.get('ajax/modal/'+modal_name, params,
    function (data) {
      modal.html('<div class="modal-header">'+
          '<a class="close" data-dismiss="modal">×</a>'+
          '<h3>'+title+'</h3>'+
        '</div>'+
        '<div class="modal-body">'+
          data+
        '</div>'+
        '<div class="modal-footer">'+
          '<a href="#" class="btn" data-dismiss="modal">'+close+'</a>'+
          '<a href="#" class="btn btn-primary" id="modal_apply">'+save+'</a>'+
        '</div>');

      modal.modal('show');
    }
  );
}

/**
 * Récupère via *AJAX les derniers contenus du chat
 */
function getLatestChatContent() {
  var response = jQuery.parseJSON($.ajax({
      type: 'GET',
      url: 'ajax/getlatestchat',
      async: false,
      success: function(data) {
          return data;
      }
  }).responseText);

  return response;
}

/**
 * Met à jour le chat avec les derniers messages
 */
function updateChat() {
  if (!AUTOUPDATE_CHAT) {
    return;
  }

  var chat = $('pre#chat_content');
  chat.empty();

  var chat_last_content = getLatestChatContent();

  for (i = 0; i <= chat_last_content.length - 1; i++) {
    var time = new Date(chat_last_content[i].time * 1000);

    var hours = time.getHours();
    var minutes = time.getMinutes();
    var seconds = time.getSeconds();

    if (hours.toString().length == 1) {
      hours = '0'+hours;
    }

    if (minutes.toString().length == 1) {
      minutes = '0'+minutes;
    }

    if (seconds.toString().length == 1) {
      seconds = '0'+seconds;
    }

    var time = hours+":"+minutes+":"+seconds;

    var player_name = chat_last_content[i].player;
    var message = chat_last_content[i].message;

    chat.append("["+time+"] "+player_name+" : "+message+"\n");
  }
}

$(document).ready(function() {
  // Tooltips sur le menu et le contenu des pages
  $('div.navbar, div.container').tooltip({
    selector: "a[rel=tooltip]",
    placement: "bottom"
  });

  // Popovers
  $('div.container').popover({
    selector: "a[rel=popover], span[rel=popover]"
  });

  // ------------------------------------------------------------------------ //
  // EVENEMENTS
  // ------------------------------------------------------------------------ //

  if ($('pre#chat_content').length == 1) { // Si le chat est affiché
    updateChat(); // Affichage des derniers contenus dans le chat
    setInterval(function() { updateChat(); }, 5000);// Actualisation auto du chat toutes les 5 secondes
  }

  // Actualisation manuelle du chat
  $('a#chat_refresh').click(function (event) {
    if (!AUTOUPDATE_CHAT) {
      $('a#chat_pause').button('toggle');
      AUTOUPDATE_CHAT = true;
    }

    updateChat();
    event.preventDefault();
  });

  // Pause de l'actualisation manuelle du chat
  $('a#chat_pause').click(function (event) {
    if (!AUTOUPDATE_CHAT) {
      AUTOUPDATE_CHAT = true;
    } else {
      AUTOUPDATE_CHAT = false;
    }

    event.preventDefault();
  });

  // Envoi de texte normal sur le chat lors du clic sur le bouton Envoyer
  $('a#go_textmsg').click(function (event) {
    sendTextMsg();
    event.preventDefault();
  });

  // Envoi de texte normal sur le chat lorsque la touche Entrée est appuyée sur l'input
  $('input[id="textmsg"]').keypress(function(event) {
    var key_code = (event.keyCode ? event.keyCode : event.which);
    if (key_code == 13) { // Entrée
      sendTextMsg();
    }
  });

  // Changement de la météo
  $('a#server_switchweather').click(function(event) {
    $.get('ajax/switchweather',
      function (data) {

      }
    );

    event.preventDefault();
  });

  // Changement de l'heure
  $('a[class*="server_changetime"]').click(function(event) {
    var time = $(this).attr('id');

    $.post('ajax/changetime', {time: time},
      function (data) {

      }
    );

    event.preventDefault();
  });

  // Utilisation de la whitelist
  $('a[class*="server_whitelistuse"]').click(function(event) {
    var use = $(this).attr('id');

    $.post('ajax/whitelistuse', {use: use},
      function (data) {

      }
    );

    event.preventDefault();
  });

  // Rechargement de la whitelist
  $('a#server_whitelistreload').click(function(event) {
    $.get('ajax/whitelistreload',
      function (data) {

      }
    );

    event.preventDefault();
  });

  // ----- Actions sur les plugins ----------------------- //

  // Désactiver un plugin
  $('a[class*="plugin_disable"]').click(function(event) {
    var tr = $(this).parent().parent();
    var plugin_name = tr.attr('id').replace('tr_', '');

    $.post('ajax/plugin/disable', {plugin_name: plugin_name},
      function (data) {
        tr.children('td').children('a.plugin_disable').hide();
        tr.children('td').children('a.plugin_enable').show();

        tr.children('td').children('span.label-important').show();
        tr.children('td').children('span.label-success').hide();
      }
    );

    event.preventDefault();
  });

  // Activer un plugin
  $('a[class*="plugin_enable"]').click(function(event) {
    var tr = $(this).parent().parent();
    var plugin_name = tr.attr('id').replace('tr_', '');

    $.post('ajax/plugin/enable', {plugin_name: plugin_name},
      function (data) {
        tr.children('td').children('a.plugin_enable').hide();
        tr.children('td').children('a.plugin_disable').show();

        tr.children('td').children('span.label-success').show();
        tr.children('td').children('span.label-important').hide();
      }
    );

    event.preventDefault();
  });

  // ----- Menu déroulant des actions sur les joueurs ----------------------- //

  // Inventaire d'un joueur
  $('a[class*="player_inv"]').click(function(event) {
    var player_name = getPlayerName($(this));

    showModalDialog('player_inv', 'Inventaire de '+player_name, {player_name: player_name}, 'Fermer', 'Fermer');

    event.preventDefault();
  });

  // Ejecter joueur
  $('a[class*="player_kick"]').click(function(event) {
    var player_name = getPlayerName($(this));

    showModalDialog('player_kick', 'Ejecter '+player_name, {player_name: player_name}, 'Annuler', 'Ejecter');

    event.preventDefault();
  });

  // Bannir joueur
  $('a[class*="player_ban"]').click(function(event) {
    var player_name = getPlayerName($(this));

    showModalDialog('player_ban', 'Bannir '+player_name, {player_name: player_name}, 'Annuler', 'Bannir');

    event.preventDefault();
  });

  // Opper un joueur
  $('a[class*="player_op"]').click(function(event) {
    var player_name = getPlayerName($(this));
    var tr = getPlayerTr(player_name);

    $.post('ajax/player/op', {player_name: player_name},
      function (data) {
        tr.children('td.player_name_op').append($('<span class="label label-important player_admin">Admin</span>'));
        tr.children('td.player_actions').children('div.btn-group').children('ul.dropdown-menu').children('li.player_op').hide();
        tr.children('td.player_actions').children('div.btn-group').children('ul.dropdown-menu').children('li.player_deop').show();
      }
    );

    event.preventDefault();
  });

  // Dé-opper un joueur
  $('a[class*="player_deop"]').click(function(event) {
    var player_name = getPlayerName($(this));
    var tr = getPlayerTr(player_name);

    $.post('ajax/player/deop', {player_name: player_name},
      function (data) {
        tr.children('td.player_name_op').children('span.player_admin').remove();
        tr.children('td.player_actions').children('div.btn-group').children('ul.dropdown-menu').children('li.player_deop').hide();
        tr.children('td.player_actions').children('div.btn-group').children('ul.dropdown-menu').children('li.player_op').show();
      }
    );

    event.preventDefault();
  });

  // Téléporter un joueur
  $('a[class*="player_tp"]').click(function(event) {
    var player_name = getPlayerName($(this));

    showModalDialog('player_tp', 'Téléporter '+player_name, {player_name: player_name}, 'Annuler', 'Téléporter');

    event.preventDefault();
  });

  // Supprimer le joueur de la whitelist
  $('a[class*="player_delfromwhitelist"]').click(function(event) {
    var player_name = getPlayerName($(this));

    $.post('ajax/player/delfromwhitelist', {player_name: player_name},
      function (data) {

      }
    );

    event.preventDefault();
  });

  // Donner un objet à un joueur
  $('a[class*="player_give"]').click(function(event) {
    var player_name = getPlayerName($(this));

    showModalDialog('player_give', 'Donner un objet '+player_name, {player_name: player_name}, 'Annuler', 'Donner');


  });
});