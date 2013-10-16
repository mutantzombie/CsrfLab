(function(){
"use strict";

function handler()
{
  if(this.readyState == this.DONE) {
    if(this.status == 200 &&
       this.responseText != null) {
      processData(this.responseText);
      return;
    }

    processData(null);
  }
}

function processData(s)
{
  if(s)
    document.getElementById("results").innerHTML = s;
  else
    document.getElementById("results").innerHTML = "";
}

function submitMethod()
{
  processData();

  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = handler;
  xhr.open("XCSRF", "./dragon.php");
  xhr.send();
  return false;
}

function submitSearch()
{
  processData();

  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = handler;
  xhr.open("POST", "./dragon.php");
  xhr.setRequestHeader("X-CSRF", "1");
  xhr.send();
  return false;
}

var el = document.getElementById("dragon");
if(el)
  el.onsubmit = submitSearch;
/*
else {
  var el = document.getElementById("gems");
  if(el)
    el.onsubmit = submitMethod;
}
*/
})();
