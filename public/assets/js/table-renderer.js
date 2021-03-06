const table_renderer = function(){
    
    const number_formatter = Intl.NumberFormat();
    const currency_formatter = Intl.NumberFormat('en-us', { style: 'currency', currency: 'USD' });

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
        studies.innerHTML = number_formatter.format(study.studies_in_month);
        cost.innerHTML = currency_formatter.format(study.total_cost);

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

    function createFooter(data) {
        const tfoot = document.createElement('tfoot');

        const tr = document.createElement('tr');

        const label = document.createElement('th');
        label.innerHTML = 'Total';

        const total_studies = document.createElement('th');
        total_studies.innerHTML = 0;

        const total_costs = document.createElement('th');
        total_costs.innerHTML = 0;

        data.forEach(study => {
            total_studies.innerHTML = parseInt(total_studies.innerHTML) + study.studies_in_month;
            total_costs.innerHTML = parseFloat(total_costs.innerHTML) + parseFloat(study.total_cost); // remove the '$'
        });

        total_studies.innerHTML = number_formatter.format(total_studies.innerHTML);
        total_costs.innerHTML = currency_formatter.format(total_costs.innerHTML, )

        tr.appendChild(label);
        tr.appendChild(total_studies);
        tr.appendChild(total_costs);

        tfoot.appendChild(tr);

        return tfoot;
    }

    /**
     * @param {documentElement} el 
     * @param {object} data 
     */
    function renderTable(el, data) {
        const tbl = document.createElement('table');

        tbl.appendChild(createHeaders());
        tbl.appendChild(createBody(data));
        tbl.appendChild(createFooter(data));
        el.innerHTML = '';
        el.appendChild(tbl);
    }

    return {
        render: renderTable
    }
}()