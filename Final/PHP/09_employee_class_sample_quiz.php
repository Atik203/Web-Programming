<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Employee Class</title>
</head>
<body>

<?php
// ============================================================================
// SAMPLE QUIZ — Q2 (3 marks) : FULL ANSWER
// Class Employee: constructor(name, basicSalary, bonus) + 2 member functions
// ============================================================================

class Employee {
    // properties
    public $name;
    public $basicSalary;
    public $bonus;

    // constructor — initializes the properties
    public function __construct($name, $basicSalary, $bonus) {
        $this->name        = $name;
        $this->basicSalary = $basicSalary;
        $this->bonus       = $bonus;
    }

    // member function 1 — calculates and returns total salary
    public function calculateTotalSalary() {
        return $this->basicSalary + $this->bonus;
    }

    // member function 2 — displays everything, reusing function 1
    public function printDetails() {
        echo "Name: " . $this->name . "<br>";
        echo "Basic Salary: " . $this->basicSalary . "<br>";
        echo "Bonus: " . $this->bonus . "<br>";
        echo "Total Salary: " . $this->calculateTotalSalary() . "<br>";
    }
}

// create an object and call printDetails()
$employee1 = new Employee("Arif Rahman", 45000, 5000);
$employee1->printDetails();

echo "<hr>";

$employee2 = new Employee("Marium Khan", 52000, 8000);
$employee2->printDetails();
?>

</body>
</html>
