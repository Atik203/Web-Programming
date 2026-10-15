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
        Input A: <input type="number" name="valA" required><br><br>
        Input B: <input type="number" name="valB" required><br><br>
        <input type="submit" name="btnSubmit" value="Calculate">
    </form>


    <?php

if (isset($_POST["btnSubmit"])) {
    // STAGE 1: Extract (EDIT: real field names)
    $a = floatval($_POST["valA"]);
    $b = floatval($_POST["valB"]);

    // STAGE 2: Compute — EDIT: demo is a*b; put the real formula here
    $res = $a * $b;
    // word problem?  $r = calcAlloc($a, $b, 8, 105);  then echo $r["units"] etc.

    // STAGE 3: Echo results (EDIT: the question's outputs)
    echo "<h3>Result</h3>";
    echo "Result: " . $res . "<br>";
}
?>

</body>

</html>