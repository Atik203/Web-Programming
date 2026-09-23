
<!DOCTYPE html>
<html>
<head>
</head>

<body>

    <?php 
        try {
            $pdo = new PDO(
                "mysql:host=localhost;port=3307;dbname=school",
                "root",
                ""
            );
        }catch(Exception $e){
            echo "Failed to establish database connection <br>";
        }   
    ?>
    <h1>Add Student Data</h1>    
    
    <form  method = "POST">
        <div>ID:</div>
        <input type="number" name="id">
        <div>Name:</div>
        <input type="text" name="name">
        <div>Age:</div>
        <input type="number" name="age">
        <br><br>
        <input type="submit">        
    </form>

    <?php
       if( isset($_POST["id"]) && isset($_POST["name"]) && isset($_POST["age"])) {
            $id = $_POST["id"];
            $name = $_POST["name"];
            $age = $_POST["age"];

            $stmt = $pdo->prepare("INSERT INTO student (id,name,age) VALUES (?,?,?);");
            $stmt->execute([$id, $name, $age]);
       }
    ?>

    <hr>

    <h1>Student Info Table</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Age</th>
        </tr>

    </table>
</body>
</html>