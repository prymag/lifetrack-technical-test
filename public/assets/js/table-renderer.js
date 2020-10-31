const table_renderer = function(){
    
    function createHeaders() {
        const thead = document.createElement('thead');

        const tr = document.createElement('tr');

        const month_year = document.createElement('th');
        const studies = document.createElement('th');
        const cost = document.createElement('th');

        month_year.innerHTML = 'Month Year';
        studies.innerHTML = 'No. of Studies';
        cost.innerHTML = 'Cost Forecasted';

        tr.appendChild(month_year);
        tr.appendChild(studies);
        tr.appendChild(cost);

        thead.appendChild(tr);
        return thead;
    }

    /**
     * @param {object} study 
     */
    function createRow(study) {
        const tr = document.createElement('tr');

        const month_year = document.createElement('td');
        const studies = document.createElement('td');
        const cost = document.createElement('td');

        month_year.innerHTML = study.month_year;
        studies.innerHTML = study.studies_in_month;
        cost.innerHTML = study.total_cost_formatted;

        tr.appendChild(month_year);
        tr.appendChild(studies);
        tr.appendChild(cost);

        return tr;
    }

    /**
     * @param {object} data 
     */
    function createBody(data) {
        const tbody = document.createElement('tbody');

        data.forEach(study => {
            tbody.appendChild(createRow(study));
        });

        return tbody;
    }

    /**
     * @param {documentElement} el 
     * @param {object} data 
     */
    function renderTable(el, data) {
        const tbl = document.createElement('table');

        tbl.appendChild(createHeaders());
        tbl.appendChild(createBody(data));
        el.innerHTML = '';
        el.appendChild(tbl);
    }

    return {
        render: renderTable
    }
}()