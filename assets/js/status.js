var url = "https://api.minetools.eu/ping/45.82.120.191/25565";
$.getJSON(url, function(r) {
 if(r.error){
    $('#rest').html('Server Offline');
   return false;
 }
var pl = '';
  $('#rest').html(r.description.replace(/ยง(.+?)/gi, '')+'<br><b>Players Online:</b> '+r.players.online+'/'+r.players.max+pl);
 $('#favicon').attr('src', r.favicon);

});
