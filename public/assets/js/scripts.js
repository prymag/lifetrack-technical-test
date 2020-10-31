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
    xhttp.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhttp.setRequestHeader("Content-Type", "application/json");
    xhttp.send(JSON.stringify(params));
}

function validateInputs() {
    const data = getData();

    if (data.studies_per_day == '' || data.months_forecast == '') {
        return {errors: 'Please fill up required the fields'};
    }

    return true;
}

function getData() {
    return {
        studies_per_day: parseInt(document.getElementById('studies_per_day').value),
        study_growth: parseFloat(document.getElementById('study_growth').value),
        months_forecast: parseInt(document.getElementById('months_to_forecast').value)
    }    
}



onReady(function() {
    const form = document.getElementById('forecast_form');

    form.addEventListener('submit', function(event) {
        event.preventDefault();
        const isFormValid = validateInputs();
        const form_errors = document.getElementById('form_errors');
        form_errors.innerHTML = '';

        if (isFormValid === true) {
            
            const base_tag = document.getElementById('base_tag').href;
            base_tag = base_tag.replace(/(?:\/+(\?))/, '$1').replace(/\/+$/, '') // Remove possible trailing slashes
            const ajax_url = base_tag != '' ? base_tag + '/ajax.php' : 'ajax.php';
            ajaxConnect('POST', ajax_url, getData(), function(el) {
                const result = JSON.parse(el.responseText);

                if (result.success) {
                    document.getElementById('result_wrapper').classList.remove('hidden');
                    table_renderer.render(document.getElementById('result'), result.data)
                }
            });
        } else {
            form_errors.innerHTML = isFormValid.errors;
        }
        return false;
    })
})