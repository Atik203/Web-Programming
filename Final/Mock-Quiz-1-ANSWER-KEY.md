# Mock Quiz 1 — ANSWER KEY & GRADING RUBRIC

> Only open after the 20 minutes are up. Grade yourself honestly, then send me your answers for a second check.

---

## Question 1 — JavaScript (3 marks)

```js
let num = Math.floor(Math.random() * (150 - 50 + 1)) + 50;
console.log(num);

if (num % 2 === 0) {
    console.log("Even");
} else {
    console.log("Odd");
}
```

**Rubric (1 mark each):**

| Mark | For |
|---|---|
| 1 | `Math.floor(Math.random() * (150 - 50 + 1)) + 50` — note the `+1`, otherwise 150 is never generated |
| 1 | `console.log(num);` |
| 1 | `num % 2 === 0` → "Even" else "Odd" |

**Common mistakes:** `Math.random() * 100 + 50` (off-by-one, 150 impossible); `num % 2 = 0` (assignment instead of comparison); forgetting `console.log`.

---

## Question 2 — PHP class (3 marks)

```php
<?php
class Book {
    public $title;
    public $price;
    public $quantity;

    public function __construct($title, $price, $quantity) {
        $this->title    = $title;
        $this->price    = $price;
        $this->quantity = $quantity;
    }

    public function calculateTotal() {
        return $this->price * $this->quantity;
    }

    public function printDetails() {
        echo "Title: " . $this->title . "<br>";
        echo "Price: " . $this->price . "<br>";
        echo "Quantity: " . $this->quantity . "<br>";
        echo "Total: " . $this->calculateTotal() . "<br>";
    }
}

$book1 = new Book("Web Programming", 450, 10);
$book1->printDetails();
?>
```

**Rubric (1 mark each):**

| Mark | For |
|---|---|
| 1 | `class Book` + properties + `__construct` with `$this->...` assignments |
| 1 | `calculateTotal()` **returns** `$this->price * $this->quantity` |
| 1 | `printDetails()` echoes all 4 values and reuses `calculateTotal()`, plus `new Book(...)` and `->printDetails()` |

**Common mistakes:** `_construct` (one underscore); `return` written as `echo`; `$this.price` (dot instead of `->`); `.` vs `+` in concatenation.

---

## Question 3 — PHP + MySQL (4 marks)

```php
<?php
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "store";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT COUNT(*) AS totalProducts, AVG(price) AS averagePrice FROM products";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "Total Products: " . $row["totalProducts"] . "<br>";
        echo "Average Price: " . $row["averagePrice"] . "<br>";
    }
} else {
    echo "0 results";
}

$conn->close();
?>
```

**Rubric:**

| Mark | For |
|---|---|
| 1 | `new mysqli(...)` with the `store` database + `connect_error` check |
| 1 | `COUNT(*) AS totalProducts, AVG(price) AS averagePrice FROM products` |
| 1 | `while ($row = $result->fetch_assoc())` loop (the fetch function) |
| 1 | `$row["totalProducts"]` / `$row["averagePrice"]` printed + `$conn->close()` |

**Common mistakes:** `fetch_assoc` without `$row =`; `$row[totalProducts]` without quotes; `$conn->query` written as `mysqli_query($conn, ...)` — both work, but be consistent; forgetting the database name in the constructor.

---

## Test your Q3 code for real

The `store` database is already created on your MySQL (port 3307). To run your answer:

1. Save your code as `my_q3.php` inside `D:\WEB\Web-Practice\Final\MySQL\`.
2. Run: `& "G:\xampp\php\php.exe" my_q3.php` (or `php -S localhost:8000` and open in the browser).
3. Expected output:

```
Total Products: 5
Average Price: 4600.000000
```

**Expected values:** products are Keyboard 1200, Mouse 800, Monitor 15000, Headphone 2500, Webcam 3500 → COUNT = 5, AVG = 4600.

---

## Scoring guide

- **9–10:** quiz-ready. Keep the traps sheet warm.
- **7–8:** solid — re-drill the section where you lost marks.
- **≤ 6:** redo the matching README section, then retake this mock tomorrow morning.

Send me your written answers and I'll grade them line by line.
