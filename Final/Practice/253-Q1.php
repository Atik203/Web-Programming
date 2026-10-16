<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Q2 QUICKSTART — fill the EDIT spots</title>
    <style>
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
        CT 1: <input type="number" name="ct1" required><br><br>
        CT 2: <input type="number" name="ct2" required><br><br>
        CT 3: <input type="number" name="ct3" required><br><br>
        Mid-Term: <input type="number" name="midTerm" required><br><br>
        Final : <input type="number" name="final" required><br><br>
        <input type="submit" name="btnSubmit" value="Calculate">
    </form>


    <?php

    if (isset($_POST["btnSubmit"])) {
        $ct1 = intval($_POST["ct1"]);
        $ct2 = intval($_POST["ct2"]);
        $ct3 = intval($_POST["ct3"]);
        $midTerm = intval($_POST["midTerm"]);
        $final = intval($_POST["final"]);

        $bestTwo = $ct1 + $ct2 + $ct3 - min($ct1, $ct2, $ct3);
        $avg = $bestTwo / 2;
        $total = $avg + $midTerm + $final;
        $status = ($total > 54) ? "Passed" : "Failed";

        echo "Best two CT's Total " . $bestTwo . "<br>";
        echo "Midterm marks: " . $midTerm . "<br>";
        echo "Final marks: " . $final . "<br>";
        echo "<br>";
        echo "Total Marks: " . $total . "<br>";
        echo "Status: " . $status;
    }

    ?>

</body>

</html>