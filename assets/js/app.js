/*
* RFM (V1.0)
* made by N!LAXY#6666
_____   _________________________  ___  __
___  | / /___  _/__  /___    |_  |/ / \/ /
__   |/ / __  / __  / __  /| |_    /__  /
_  /|  / __/ /  _  /___  ___ |    | _  /
/_/ |_/  /___/  /_____/_/  |_/_/|_| /_/

*/
var rfm = {
    version: '1.2.0',
    api_url: 'https://api.reyfm.de/v3/channel-sequence',
    debug: true,
    is_darkmode: true,
    created_channel_view: false,
    initialized_ticker: false,
    time: {
        sequence_update: 15000,
    },
    init: function() {
        console.log('RFM (V' + rfm.version + ')\nmade by N!LAXY#6666');
        rfm.log('App Initialisiert!');
        rfm.darkmode.init();
        if ($("body").hasClass("startpage")) {
            $("#back").removeClass('pointer').removeAttr('id').addClass('version').text('v' + rfm.version);
            $("#playlist").remove();
            rfm.getChannelSequence.init();
            rfm.personalMessage.init();
            rfm.pageControl.init();
            rfm.intro.init();
        } else if ($("body").hasClass("content-channel")) {
            $("#logo, #back").bind("click", function() {
                window.location.href = "/";
            });
            rfm.log('Content-Channel Detected!');
        } else {
            $("#logo, #back").bind("click", function() {
                window.location.href = "/";
            });
            $("#playlist").remove();
            rfm.getChannelSequence.init();
        }
        rfm.modal.init();
        rfm.checkLocalstorage.init();
        rfm.socket.init();
        rfm.push.init();
        rfm.imgProtect.init();
    },
    intro: {
        init: function() {
            if (localStorage.getItem("first_visit") === null) {
                localStorage.setItem('first_visit', "false");
                $("#wrapper").prepend('<div id="intro"><div class="content"><img style="width:120px;" src="https://cdn.reyfm.de/img/logo.png"><h1 style="font-family:reyfm_black;">WILLKOMMEN! 👋</h1><p style="font-size:30px;">Du scheinst neu hier zu sein, wähle einfach einen Musik-Channel deiner Wahl und es kann los gehen!<br><hr><b style="font-family:reyfm_black;">PROTIP:</b> In den Einstellungen findest du viele nützliche Features! 🤗</p><button class="btn-hover channel-color-1" onclick="rfm.intro.close();">JETZT HÖREN!</button></div></div>');
                $('#header').addClass("blur-overlay");
                $('#content').addClass("blur-overlay");
            }
        },
        close: function() {
            $('#header').removeClass("blur-overlay");
            $('#content').removeClass("blur-overlay");
            $('#intro').fadeOut("slow");
            setTimeout(function() {
                $('#intro').remove();
            }, 1000);
        }
    },
    socket: {
        init: function() {
            rfm.socket = io.connect('https://socket.reyfm.de');
            if ($("body").hasClass("content-channel")) {
                if ((localStorage.getItem("settings.hearts") === "true") || (localStorage.getItem("settings.chat") === "true")) {
                    rfm.socket.on('connect', function() {
                        rfm.socket.emit('room', chn);
                        rfm.log('Verbindung zum Socket Server hergestellt!');
                    });
                    rfm.socket.on('disconnect', function() {
                        rfm.log('Verbindung zum Socket Server verloren!');
                    });
                    if (localStorage.getItem("settings.hearts") === "true") {
                        rfm.socket.on('connect', function() {
                            $(".herzchen").show();
                        });
                        rfm.socket.on('disconnect', function() {
                            $(".herzchen").hide();
                        });
                        player.hearts.init();
                    } else {
                        $(".herzchen").hide();
                    }
                    if (localStorage.getItem("settings.chat") === "true") {
                        $("#chat").show();
                        player.chat.init();
                    }
                }
            }
        }
    },
    push: {
        init: function() {
            rfm.socket.on("push", (data) => {
                rfm.modal.open(data.message);
            });
        }
    },
    darkmode: {
        init: function() {
            if (rfm.is_darkmode === true) {
                rfm.darkmode.apply();
            }
        },
        apply: function() {
            if (!$("body").hasClass("content-channel")) {
                $(".coverart .cover").attr("src", "https://cdn.reyfm.de/img/dark_blank.jpg");
                $("#wave").css("filter", "grayscale(1) brightness(0.5)");
                $('.mticker').each(function() {
                    $(this).attr('data-bgcolor', '#2c2c2c')
                });
            }
        }
    },
    preloader: {
        init: function() {
            setTimeout(function() {
                $("#preloader").fadeOut(500);
            }, 500);
        }
    },
    modal: {
        init: function() {
            var modal = document.getElementById('modal');
            window.onclick = function(event) {
                if (event.target == modal) {
                    $('#header').removeClass("blur-overlay");
                    $('#content').removeClass("blur-overlay");
                    $('#playlist').removeClass("blur-overlay");
                    $('#modal').fadeOut("slow");
                }
            }
            $("#modal span").bind("click", function() {
                rfm.modal.close();
            });
        },
        open: function(content) {
            $('#modal-box').html(content);
            $('#header').addClass("blur-overlay");
            $('#content').addClass("blur-overlay");
            $('#playlist').addClass("blur-overlay");
            $('#modal').fadeIn("slow");
        },
        close: function() {
            $('#header').removeClass("blur-overlay");
            $('#content').removeClass("blur-overlay");
            $('#playlist').removeClass("blur-overlay");
            $('#modal').fadeOut("slow");
        }
    },
    pageControl: {
        init: function() {
            $("#next").bind("click", function() {
                rfm.pageControl.next();
            });
            $("#prev").bind("click", function() {
                rfm.pageControl.prev();
            });
        },
        prev: function() {
            $("#next").delay(250).fadeIn(250);
            $("#prev").fadeOut(250);
            $("#page2").fadeOut(250);
            $("#page1").delay(250).fadeIn(250);
        },
        next: function() {
            $("#next").fadeOut(250);
            $("#prev").delay(250).fadeIn(250);
            $("#page2").delay(250).fadeIn(250);
            $("#page1").fadeOut(250);
        }
    },
    getChannelSequence: {
        init: function() {
            rfm.getChannelSequence.update();
            rfm.log('Channel-Sequence Initialisiert!');
        },
        update: function() {
            rfm.log('Updating Channel-Sequence...');
            $.get({
                url: rfm.api_url + '?r=' + rfm.rnd(),
                dataType: 'json',
                success: function(data) {
                    rfm.log('API erfolgreich geladen.');
                    if ($("body").hasClass("startpage")) {
                        $('.channel').each(function(i, obj) {
                            $(this).attr('id', 'channel-' + data.sequence[i]);
                        });
                        rfm.log('Channel IDs zugewiesen!');
                        var createChannels = (function() {
                            return function() {
                                if (!rfm.created_channel_view) {
                                    rfm.created_channel_view = true;
                                    $.each(data.channels, function(key, value) {
                                        $("#channel-" + key).parent().removeClass("desktop");
                                        $("#channel-" + key).addClass("pointer");
                                        $("#channel-" + key + " .coverart").prepend('<img class="play" src="https://cdn.reyfm.de/img/play-icon-shadow.png">');
                                    });
                                    if (localStorage.getItem("settings.extended_view") === "true") {
                                        $("#pagecontrol").remove();
                                        $('#container').css({
                                            'top': '75px',
                                            'left': 'unset',
                                            'transform': 'unset',
                                            'position': 'relative',
                                            'width': '925px'
                                        });
                                        $('#page1').css({
                                            'display': 'block'
                                        });
                                        $('#page2').css({
                                            'display': 'block'
                                        });
                                    }
                                    rfm.log('Channels erstellt!');
                                }
                            };
                        })();
                        createChannels();
                        $.each(data.channels, function(key, value) {
                            $("#channel-" + key).unbind("click");
                            $("#channel-" + key + " .name").text("#" + value.name);
                            $("#channel-" + key + " #coverart").hide();
                            $("#channel-" + key + " #coverart").attr("src", value.coverurl);
                            $("#channel-" + key + " #coverart").fadeIn("slow");
                            setTimeout(function() {
                                $("#channel-" + key + " #coverart-bg").attr("src", value.coverurl);
                            }, 1000);
                            $("#channel-" + key + " .meta h1").text(value.artist);
                            $("#channel-" + key + " .meta h2").text(value.title);
                            $("#channel-" + key).bind("click", function() {
                                window.location.href = value.name;
                            });
                        });
                        $("#live").remove();
                        if (data.live == "true") {
                            $("#channel-1").prepend('<div id="live"></div>');
                        }
                    }
                    $('.listeners').text(data.all_listeners);
                    rfm.preloader.init();
                    //rfm.lightSweep.init();
                    var initializeTicker = (function() {
                        return function() {
                            if (!rfm.initialized_ticker) {
                                rfm.initialized_ticker = true;
                                setTimeout(function() {
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
            setTimeout(function() {
                rfm.getChannelSequence.update();
            }, rfm.time.sequence_update);
        }
    },
    personalMessage: {
        init: function() {
            var timehours = new Date().getHours();
            var timemsg;
            var morning = ('Guten Morgen');
            var afternoon = ('Hi');
            var evening = ('Guten Abend');
            if (timehours >= 6 && timehours < 13) {
                timemsg = morning;
            } else if (timehours >= 13 && timehours < 20) {
                timemsg = afternoon;
            } else if (timehours >= 20 || timehours < 6) {
                timemsg = evening;
            }
            if (localStorage.getItem("settings.username") === null) {
                return false;
            } else {
                var username = localStorage.getItem('settings.username');
                $("#username").text(timemsg + ', ' + username + '! 👋');
            }
        }
    },
    imgProtect: {
        init: function() {
            var o = this;
            $("img").mousedown(function(e) {
                e.preventDefault()
            });
            $("body").on("contextmenu", function(e) {
                return false;
            });
        }
    },
    lightSweep: {
        init: function() {
            setTimeout(function() {
                rfm.lightSweep.loop("#logo", 1000, 10000);
            }, 1000);
        },
        loop: function(target, speed, time) {
            setTimeout(function() {
                rfm.lightSweep.loop(target, speed, time);
            }, time);
            rfm.lightSweep.run(target, speed);
        },
        run: function(target, speed) {
            $({
                A: 0
            }).animate({
                A: speed
            }, {
                step: function(A) {
                    var dA = 15;
                    $(target).css("-webkit-mask", "-webkit-gradient(radial, 0 0, " + A + ", 0 0, " + (A + dA) + ", from(rgb(0, 0, 0)), color-stop(0.5, rgba(0, 0, 0, 0.2)), to(rgb(0, 0, 0)))");
                },
                duration: 3000
            });
        }
    },
    checkLocalstorage: {
        init: function() {
            if (localStorage.getItem("settings.loadbalancer") === null) {
                localStorage.setItem('settings.loadbalancer', 'true');
            }
            if (localStorage.getItem("settings.quality") === null) {
                localStorage.setItem('settings.quality', '192kbps');
            }
            if (localStorage.getItem("settings.quality") !== "320kbps" && localStorage.getItem("settings.quality") !== "192kbps" && localStorage.getItem("settings.quality") !== "128kbps") {
                localStorage.setItem('settings.quality', '192kbps');
            }
            if (localStorage.getItem("settings.autoplay") === null) {
                localStorage.setItem('settings.autoplay', 'false');
            }
            if (localStorage.getItem("settings.bassboost") === null) {
                localStorage.setItem('settings.bassboost', '1');
            }
            if (localStorage.getItem("settings.hearts") === null) {
                localStorage.setItem('settings.hearts', 'true');
            }
            if (localStorage.getItem("settings.chat") === null) {
                localStorage.setItem('settings.chat', 'false');
            }
            var n = localStorage.getItem('visits');
            if (n === null) {
                n = 0;
            }
            n++;
            localStorage.setItem('visits', n);
            if (localStorage.getItem("visits") === "25") {
                rfm.modal.open('<h1 style="font-family:reyfm_black;">😱 Socialmedia?</h1>Auch wir haben sowas!<br>Falls du uns noch nicht Folgst, folge uns jetzt auf <b><a style="font-family:reyfm_black;" href="instagram">Instagram</a></b>, <b><a style="font-family:reyfm_black;" href="twitter">Twitter</a></b> oder adde uns auf <b><a style="font-family:reyfm_black;" href="snapchat">Snapchat</a></b></p>');
            } else if (localStorage.getItem("visits") === "50") {
                rfm.modal.open('<h1 style="font-family:reyfm_black;">👾 Discord?</h1>Komm doch auf unseren Discord Server, wir warten schon auf dich!<br><b><a href="discord">Discord beitreten</a></b></p>');
            }
        }
    },
    mticker: {
        d: 0,
        init: function() {
            if ('undefined' === typeof Marquee3k) {
                $.getScript("js/libs/m3000.js", rfm.mticker.activate);
            } else {
                rfm.mticker.activate();
            }
        },
        activate: function() {
            Marquee3k.init({
                selector: 'mtickercontent'
            });
            $('.mticker').each(function() {
                if ($("body").hasClass("content-channel")) {
                    $(this).css("border-radius", "0px");
                    $(this).css("transform", "translateX(0%) translateY(calc(0% - 0.5px))");
                }
                $(this).find('.mtickercontent').css({
                    color: $(this).attr('data-color')
                });
                $(this).find('.mtickercontent a').css({
                    color: $(this).attr('data-color')
                });
                $(this).css({
                    background: ($(this).attr('data-type') === "0") ? 'transparent' : $(this).attr('data-bgcolor')
                });
            });
            window.setTimeout(function() {
                Marquee3k.refreshAll();
            }, 500);
            window.addEventListener('m3k_cloned', function(e) {}, false);
        },
    },
    escapeOutput: function(toOutput) {
        return toOutput.replace(/\&/g, '&amp;').replace(/\</g, '&lt;').replace(/\>/g, '&gt;').replace(/\"/g, '&quot;').replace(/\'/g, '&#x27').replace(/\//g, '&#x2F');
    },
    rnd: function() {
        return Math.ceil(Math.random() * 100000);
    },
    log: function(s) {
        if ('undefined' !== typeof console && rfm.debug) {
            console.log('RFM_APP > ' + s);
        }
    }
};
$(document).ready(rfm.init);
