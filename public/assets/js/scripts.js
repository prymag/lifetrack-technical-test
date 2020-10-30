function onReady(callbackFunc) {
    if (document.readyState !== 'loading') {
        // Document is already ready, call the callback directly
        callbackFunc();
    } else if (document.addEventListener) {
        // All modern browsers to register DOMContentLoaded
        document.addEventListener('DOMContentLoaded', callbackFunc);
    } else {
        // Old IE browsers
        document.attachEvent('onreadystatechange', function() {
        if (document.readyState === 'complete') {
            callbackFunc();
        }
        });
    }
}

function loadDoc() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
          console.log(this.responseText);
      }
    };
    xhttp.open("POST", "/ajax.php", true);
    xhttp.send();
  }

onReady(function() {
    const form = document.getElementById('forecast_form');

    form.addEventListener('submit', function(event) {
        loadDoc();
        return false;
    })
})