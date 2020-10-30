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

function ajaxConnect(method, path, params, callback) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
          callback(this);
      }
    };
    xhttp.open(method, path, true);
    xhttp.setRequestHeader("Content-Type", "application/json");
    xhttp.send(JSON.stringify(params));
}

function validateInputs() {
    const studies_per_day = document.getElementById('studies_per_day');
    const study_growth = document.getElementById('study_growth');
    const months_to_forecast = document.getElementById('months_to_forecast');

    if (studies_per_day.value == '' || study_growth == '' || months_to_forecast == '') {
        return {errors: 'Please fill up all the fields'};
    }

    return true;
}

onReady(function() {
    const form = document.getElementById('forecast_form');

    form.addEventListener('submit', function(event) {
        const isFormValid = validateInputs();
        const form_errors = document.getElementById('form_errors');
        form_errors.innerHTML = '';

        if (isFormValid === true) {
            const data = {
                studies_per_day: 10,
                study_growth: 1.3,
                months_to_forecast: 1
            }            
            ajaxConnect('POST', '/ajax.php', data, function(el) {
                console.log(el.responseText);
            });
        } else {
            console.log(isFormValid);
            form_errors.innerHTML = isFormValid.errors;
        }
        return false;
    })
})