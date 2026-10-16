<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Q2</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        form {
            width: 300px;
            margin: 4px auto;
            padding: 6px;
            border: 1px solid #cbd5e1;
        }

        label {
            display: block;
            margin-top: 3px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="number"],
        select {
            width: 100%;
            padding: 3px;
            margin-top: 2px;
            border: 1px solid #94a3b8;
        }

        button,
        input[type="submit"] {
            margin-top: 4px;
            padding: 3px 10px;
            background: #0284c7;
            color: #fff;
            border: none;
            cursor: pointer;
            border-radius: 2px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 4px;
        }

        th,
        td {
            border: 1px solid #cbd5e1;
            padding: 2px 4px;
            text-align: left;
        }

        th {
            background: #f1f5f9;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background: #f8fafc;
        }

        .error {
            color: #b91c1c;
            font-weight: bold;
        }

        .success {
            color: #16a34a;
        }

        .center {
            text-align: center;
        }
    </style>
</head>

<body>


    <form method="post">
        Items sold per day: <input type="number" name="items" required><br><br>
        Sale runs days: <input type="number" name="days" required><br><br>
        Target number of items: <input type="number" name="target" required><br><br>
        <input type="submit" name="btnSubmit" value="Calculate">
    </form>

    <?php


    if (isset($_POST["btnSubmit"])) {

        $items = intval($_POST["items"]);
        $days = intval($_POST["days"]);
        $target = intval($_POST["target"]);

        $total = $items * $days;

        $performance = "";
        if ($total >= 500) $performance = "Excellent";
        else if ($total >= 300 && $total < 500) $performance = "Good";
        else if ($total >= 150 && $total < 300) $performance = "Average";
        else $performance = "Poor";

        $result = "";
        if ($total > $target) $result = "Above target by " . $total - $target;
        if ($total < $target) $result = "Below target by " . $target - $total;
        else $result =  "Target met exactly";



        echo "<div>
        <h3>Total Items:  $total</h3>
        <h4>Performance: $performance </h4>
        <h5>Result: $result</h5>
        </div>";
    }
    ?>

</body>

</html>