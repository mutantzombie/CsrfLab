(function(){
"use strict";

$(document).ready(function() {

$("#dragon").submit(function(event) {
  $.ajax({
//    url: "dragon.php",
    url: "http://web.site/CsrfLab/CORS/dragon.php",
    data: 'act=' + $("#act").val() + '&gems=' + $("#gems").val(),
    error: function(jqXHR, textStatus, errorThrown) {
      $("#results").html(textStatus + ", " + errorThrown);
    },
    headers: { "X-CSRF" : "1" },
    success: function(data) {
      if("object" == typeof(data)) {
        $("#results").html("Total: " + data["n"]);
      }
      else
        $("#results").html(data);
    }
  });
  return false;
});

});

})();
