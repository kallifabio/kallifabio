/*
* RFM PLAYER (V1.0)
* made by N!LAXY#6666
_____   _________________________  ___  __
___  | / /___  _/__  /___    |_  |/ / \/ /
__   |/ / __  / __  / __  /| |_    /__  /
_  /|  / __/ /  _  /___  ___ |    | _  /
/_/ |_/  /___/  /_____/_/  |_/_/|_| /_/

*/
var player = {
  version: '1.1.0',
  api_url: 'https://api.reyfm.de/v3/channel-sequence',
  socket: null,
  debug: true,
  initAudioContext: false,
  initPlaylist: false,
  chat_cooldown: null,
  max_hearts: 1,
  heart_explosion_chance: 0.01,
  time: {
    update: 15000,
    heart_cooldown: 500,
  },
  playing: false,
  meta: {
    artist: null,
    title: null,
    coverurl: null,
  },
  init: function () {
    $("#logo, #back").bind( "click", function() {
      window.location.href = "/";
    });
    $("#channel-player").addClass("channel-color-" + chn);
    $("#logo").addClass("black");
    rfm.imgProtect.init();
    player.waveColor.init();
    player.audioPlayer.init();
    player.channel.init();
    player.playlist.init();
    rfm.log('Player Initialisiert!');
  },
  channel: {
    init: function() {
      rfm.log('Channel Initialisiert!');
      player.channel.update();
    },
    update: function() {
      rfm.log('Updating Channel...');
      $.get({
        url: player.api_url + '?r=' + rfm.rnd(),
        dataType: 'json',
        success: function(data) {
          rfm.log('API erfolgreich geladen.');
          player.meta.artist = data.channels[chn].artist;
          player.meta.title = data.channels[chn].title;
          player.meta.coverurl = data.channels[chn].coverurl;
          if ('mediaSession' in navigator) {
            navigator.mediaSession.metadata = new MediaMetadata({
              title: player.meta.title,
              artist: player.meta.artist,
              artwork: [
                { src: player.meta.coverurl, sizes: '500x500', type: 'image/jpg' },
              ]
            });
            navigator.mediaSession.setActionHandler('play', function() {
              player.audioPlayer.playPause();
            });
            navigator.mediaSession.setActionHandler('pause', function() {
              player.audioPlayer.playPause();
            });
          }
          $('#all_listeners').text(data.all_listeners);
          $('span .listeners').text(data.channels[chn].listeners);
          $('#artist').text(player.meta.artist);
          $('#title').text(player.meta.title);
          $('#coverart').hide();
          $('#coverart').attr("src", (player.meta.coverurl));
          $("#coverart").fadeIn("slow");
          setTimeout(function(){
            $('#coverart-bg').attr("src", (player.meta.coverurl));
          }, 1000);
          rfm.preloader.init();
          //rfm.lightSweep.init();
          var initializeTicker = (function() {
            return function() {
              if (!rfm.initialized_ticker) {
                rfm.initialized_ticker = true;
                setTimeout(function(){
                  rfm.mticker.init();
                }, 500)
              }
            };
          })();
          initializeTicker();
        },
        error: function() {
          rfm.log('Ein Fehler ist aufgetreten: API nicht verfügbar.');
        }
      });
      setTimeout(function(){
        player.channel.update();
        if (player.initPlaylist) {
          player.playlist.update();
        }
      }, player.time.update);
    }
  },
  audioPlayer: {
    init: function() {
      audio = new Audio();
      audio.loop = false;
      audio.crossOrigin = "anonymous";
      playbtn = document.getElementById("cover-container");
      playbtn.addEventListener("click", player.audioPlayer.playPause);
      volumeslider = document.getElementById("volumeslider");
      volumeslider.addEventListener("mousemove", player.audioPlayer.setVolume);
      $("#volumeslider").dblclick(function() {
        player.audioPlayer.resetVolume();
      });
      audio.onerror = function() {
        rfm.log('Ein Fehler ist aufgetreten: Stream konnte nicht abgespielt werden.');
        rfm.modal.open('<h1>😴 Kein Sound?</h1><p>Es tut uns voll leid und so, aber aus irgendeinem Grund klappt die Verbindung zu unseren Streamingservern zur Zeit nicht. Bitte versuch es später nochmal.</p><p></p><a href="/" style="text-decoration:none;color:#757575;"><h1>Zur Startseite</h1></a>');
        player.audioPlayer.playPause();
      }
      player.audioPlayer.loadVolume();
      player.audioPlayer.autoPlay();
    },
    initAudioContext: function() {
      window.AudioContext = window.AudioContext || window.webkitAudioContext;
      context = new AudioContext();
      source = context.createMediaElementSource(audio);
      bassFilter = context.createBiquadFilter();
      bassFilter.type = "lowshelf";
      bassFilter.frequency.value = 200;
      bassFilter.gain.value = localStorage.getItem("settings.bassboost");
      source.connect(bassFilter);bassFilter.connect(context.destination);
    },
    playPause: function() {
      if (audio.paused) {
        if (localStorage.getItem("settings.bassboost") > 1) {
          var initAudioContext = (function () {
            return function () {
              if (!player.initAudioContext) {
                player.initAudioContext = true;
                rfm.log('Audio Context Initialisiert!');
                player.audioPlayer.initAudioContext();
              }
            };
          })();
          initAudioContext();
        }
        var availableServers = ['stream01', 'stream02', 'stream03', 'stream04', 'stream05', 'stream06'];
        var selectedServer = availableServers[Math.floor(Math.random() * availableServers.length)];
        if (localStorage.getItem("settings.loadbalancer") === "true") {
          audio.src = "https://listen.reyfm.de/" + chnName + "_" + localStorage.getItem("settings.quality") + ".mp3";
          rfm.log('Verbindung zum Loadbalancer wurde erfolgreich hergestellt!');
        } else {
          audio.src = "https://" + selectedServer + ".reyfm.de/" + chnName + "_" + localStorage.getItem("settings.quality") + ".mp3";
          rfm.log('Verbindung zu ' + selectedServer + ' wurde erfolgreich hergestellt!');
        }
        audio.load();
        audio.play();
        if ('mediaSession' in navigator) {
          navigator.mediaSession.metadata = new MediaMetadata({
            title: player.meta.title,
            artist: player.meta.artist,
            artwork: [
              { src: player.meta.coverurl, sizes: '500x500', type: 'image/jpg' },
            ]
          });
          navigator.mediaSession.setActionHandler('play', function() {
            player.audioPlayer.playPause();
          });
          navigator.mediaSession.setActionHandler('pause', function() {
            player.audioPlayer.playPause();
          });
        }
        player.playing = true;
        $("#play").css("transform","rotate(360deg)");
        rfm.log('Wiedergabe wurde gestartet!');
        setTimeout(function(){
          $("#play").attr("src", "https://cdn.reyfm.de/img/stop-icon-shadow.png");
        }, 250);
      } else {
        audio.pause();
        audio.removeAttribute('src');
        audio.load();
        player.playing = false;
        $("#play").css("transform","");
        rfm.log('Wiedergabe wurde beendet!');
        setTimeout(function(){
          $("#play").attr("src", "https://cdn.reyfm.de/img/play-icon-shadow.png");
        }, 250);
      }
    },
    setVolume: function() {
      audio.volume = volumeslider.value / 100;
      localStorage.setItem('settings.volume', audio.volume);
    },
    resetVolume: function() {
      audio.volume = 0.5;
      rfm.log('Lautstärke zurück gesetzt.');
      document.getElementById("volumeslider").value = 0.5 * 100;
    },
    loadVolume: function() {
      if (localStorage.getItem("settings.volume") === null) {
        var vol = 0.5;
        audio.volume = vol;
        rfm.log('Lautstärke wurde auf 50% gesetzt.');
        localStorage.setItem('settings.volume', audio.volume);
        document.getElementById("volumeslider").value = vol * 100;
      } else {
        var vol = localStorage.getItem('settings.volume');
        audio.volume = vol;
        rfm.log('Lautstärke von letzter Session geladen: ' + vol * 100 + '%');
        document.getElementById("volumeslider").value = vol * 100;
      }
    },
    autoPlay: function() {
      if (localStorage.getItem("settings.autoplay") === "true") {
        player.audioPlayer.playPause();
      }
    }
  },
  playlist: {
    init: function() {
      rfm.log('Playlist Initialisiert!');
      $("#playlist-button").bind("click", function() {
        var initPlaylist = (function() {
          return function() {
            if (!player.initPlaylist) {
              player.initPlaylist = true;
              player.playlist.update();
            }
          };
        })();
        initPlaylist();
        $('#header').addClass("blur-overlay");
        $('#content').addClass("blur-overlay");
        $('#playlist').fadeIn("slow");
      });
      $("#close-playlist").bind("click", function() {
        $('#header').removeClass("blur-overlay");
        $('#content').removeClass("blur-overlay");
        $('#playlist').fadeOut("slow");
      });
      var playlist = document.getElementById('playlist');
      window.onclick = function(event) {
        if (event.target == playlist) {
          $('#header').removeClass("blur-overlay");
          $('#content').removeClass("blur-overlay");
          $('#playlist').fadeOut("slow");
        }
      }
    },
    update: function() {
      rfm.log('Updating Playlist...');
      $.get('https://api.reyfm.de/playlist?chn=' + (chn) + '&r=' + rfm.rnd(), {}, function(xml) {
        var chn;
        while ($('.p-item').length > 1) {
          $('.p-item:last').remove();
        }
        rfm.log('Playlist wurde geladen!');
        $('track', xml).slice(0, 15).each(function() {
          c = $('.p-item:first').css({display: 'none'}).clone();
          $(c).find('.p-cover').attr('src', $(this).find('cover').text().trim());
          $(c).find('.p-artist').html($(this).find('artist').text().trim());
          $(c).find('.p-title').html($(this).find('title').text().trim());
          $(c).find('.p-time').html($(this).find('time').text().trim());
          $('.p-item:last').after(c);
          $('.p-item:last').css({display: 'inline-block'});
        });
        //$('.p-item:nth-child(2) .p-time').text('JETZT');
      });
    }
  },
  chat: {
    init: function () {
      if (localStorage.getItem("chat_warning") === null) {
        localStorage.setItem("chat_warning", true);
        rfm.modal.open('<h1>🚨 Achtung!</h1><p>Du hast den Chat zum ersten mal geöffnet, doch wir müssem dich warnen! Der Chat wird nicht moderiert, es kann sehr gut sein dass du auf Beleidigungen jeglicher Art stößt!</p><h1 style="font-family:reyfm_black;" onclick="rfm.modal.close();">Auf zum Chat!</h1><h1 onclick="player.chat.close();">Chat schließen! 👻</h1>');
      }
      var message = $("#message")
      var send_message = $("#send_message")
      var chatroom = $("#chatroom")
      var input = document.getElementById("message");
      input.addEventListener("keyup", function(event) {
        if (event.keyCode === 13) {
          event.preventDefault();
          send_message.click();
        }
      });
      send_message.click(function(){
        var str = message.val();
        str = str.replace(/\s+/g, '');
        if(str !== "") {
          if ((message.val().length > 0) && (message.val().length <= 320)) {
            var sendMessage = (function() {
              return function() {
                if (!player.chat_cooldown) {
                  player.chat_cooldown = true;
                  rfm.socket.emit('new_message', {
                    message : message.val()
                  })
                  message.val('');
                  setTimeout(function(){
                    player.chat_cooldown = null;
                  }, 2000)
                } else {
                  chatroom.prepend('<p class="message"><span>🤯</span> <b>Bitte warte noch einen Moment bevor du eine weitere Nachricht versendest!</b></p>');
                }
              };
            })();
            sendMessage();
          } else {
            chatroom.prepend('<p class="message"><span>🚨</span> <b>Das Text Limit liegt bei 320 Zeichen!</b></p>');
          }
        } else {
          return false;
        }
      });
      rfm.socket.on('userCount', function (data) {
        var real_users = data.userCount - 1;
        if (real_users == 1) {
          real_users = "einem";
        }
        if (real_users == 0) {
          $('#message').attr("placeholder", "Du chattest mit dir selbst...");
        } else {
          $('#message').attr("placeholder", "Du chattest mit " + real_users + " anderen Hörern...");
        }
      });
      rfm.socket.on("new_message", (data) => {
        chatroom.prepend("<p class='message'><span>" + data.username + ":</span> " +  data.message + "</p>");
      });
      rfm.socket.on("bot_message", (data) => {
        chatroom.prepend("<p class='message'>" +  data.message + "</p>");
      });
      rfm.socket.on('connect', function() {
        if (localStorage.getItem("settings.username") !== null) {
          rfm.socket.emit('change_username', {
            username : '<span style="color:' +chnColor+'" class="channel-tag">(#' + chnName.toUpperCase() + ')</span> ' + localStorage.getItem('settings.username')
          })
        } else {
          rfm.socket.emit('change_username', {
            username : '<span style="color:' +chnColor+'" class="channel-tag">(#' + chnName.toUpperCase() + ')</span> Anonym'
          })
          chatroom.prepend('<p class="message"><span>INFO:</span> Du hast dir noch keinen Nicknamen gegeben! Dies kannst du in den <a href="einstellungen"><b>Einstellungen</b></a> tun.</p>');
        }
        chatroom.prepend('<p class="message"><span>🤖</span> <b>Du wurdest erfolgreich zum Chat verbunden!</b> (Global)</p>');
      });
      rfm.socket.on('disconnect', function() {
        chatroom.prepend('<p class="message"><span>🚨</span> <b>Du hast die Verbindung zum Chat verloren...</b></p>');
      });
      rfm.socket.on('cc', function() {
        chatroom.html('<p class="message"><span>🚨</span> <b>Der Chat wurde geleert!</b></p>');
      });
      rfm.log('Chat Initialisiert!');
    },
    close: function() {
      localStorage.setItem('settings.chat', 'false');
      location.reload();
    }
  },
  waveColor: {
    init: function() {
      var v = "1.0";
      $("#wave .waveTop").css('background-image', 'url("https://cdn.reyfm.de/waves/wave-top-'+chn+'.png?v='+v+'")');
      $("#wave .waveMiddle").css('background-image', 'url("https://cdn.reyfm.de/waves/wave-mid-'+chn+'.png?v='+v+'")');
      $("#wave .waveBottom").css('background-image', 'url("https://cdn.reyfm.de/waves/wave-bot-'+chn+'.png?v='+v+'")');
    }
  },
  hearts: {
    init: function() {
      rfm.socket.on('send-heart', function(hearts) {
        //rfm.log(hearts + ' Herzen in Channel: ' + chn + ' gesendet!');
        for (var i = 0; i < hearts; i++) {
          player.hearts.spreadHeart(i, rfm.rnd());
        }
      });
      var heartButton = $('.herzchen');
      heartButton.each(function() {
        $(this).on('click', function() {
          if ($(this).hasClass("heart-clicked")) {
            return false;
          } else {
            $(this).addClass("heart-clicked");
            if (Math.random() < player.heart_explosion_chance) {
              var x = 0;
              var explosion_amount = Math.floor(Math.random() * 100) + 50;
              var hearts_explosion = setInterval(function() {
                rfm.socket.emit('send-heart', chn, 1);
                if (++x === explosion_amount) {
                  window.clearInterval(hearts_explosion);
                  setTimeout(function(){
                    $('.herzchen').removeClass("heart-clicked");
                  }, 5000);
                }
              }, 15);
              //rfm.log('Herzen wurden gesendet und der Cooldown gestartet!');
            } else {
              var hearts = Math.floor(Math.random() * player.max_hearts) + 1;
              rfm.socket.emit('send-heart', chn, hearts);
              setTimeout(function(){
                $('.herzchen').removeClass("heart-clicked");
              }, player.time.heart_cooldown);
            }
          }
        });
      });
    },
    spreadHeart: function(i, rnd, c, cc) {
      i = i + 1;
      var l = $('.herzchen')[0].getBoundingClientRect().left;
      if (Math.random() >= 0.5) {
        $('body').append('<div class="heart-particle-' + rnd + '"><span style="font-family:reyfm_icons;opacity:0;position:absolute;top:0;left:0;pointer-events:none;" class="channel-hearts-' + chn + '">&hearts;</span></div>');
      } else {
        $('body').append('<div class="heart-particle-' + rnd + '"><span style="font-family:reyfm_icons;opacity:0;position:absolute;top:0;left:0;pointer-events:none;" class="channel-second-hearts-' + chn + '">&hearts;</span></div>');
      }
      $('.heart-particle-' + rnd).css({
        top: $(window).height() - 100,
        left: l,
        position: 'fixed',
        "z-index": 0,
        "font-size": Math.random() * (+75 - +35) + +35
      }).delay((i < 10) ? i * 100 : 0).animate({
        top: "-=" + (Math.random() * $(window).height() + $(window).height() / 2),
        scale: "+=1"
      }, 2500, function() {
        $(this).remove();
      });
      $('.heart-particle-' + rnd + ' span').delay((i < 10) ? i * 100 : 0).animate({
        left: "-=" + Math.random() * $(window).width() / 4,
        opacity: ((i === 3) ? 1 : Math.random() * .75)
      }, 500).animate({
        left: "+=" + Math.random() * $(window).width() / 4
      }, 500).animate({
        left: "-=" + Math.random() * $(window).width() / 4
      }, 500).animate({
        left: "+=" + Math.random() * $(window).width() / 4
      }, 500).animate({
        left: "-=" + Math.random() * $(window).width() / 4,
        opacity: 0
      }, 500);
    }
  }
};
$(document).ready(player.init);
