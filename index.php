<?php

    include_once('./vendor/autoload.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lifetrack Test</title>
</head>
<body>
    <form action="#">
        <input type="text" placeholder="Studies Per Day" id="studies_per_day" />
        <input type="text" placeholder="Study Growth (%)" id="study_growth" />
        <input type="text" placeholder="Months to forecast" id="months_to_forecast" />
        <button id="form_submit">Submit</button>
    </form>    
</body>
</html>
