$(document).ready(function() {
  $.getJSON("current_online", function(data) {
    $("#online").text(data.online);
  });
});
