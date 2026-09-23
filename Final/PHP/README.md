# PHP — CSE 4165 Web Programming — Final Revision

> **Where it appears:** Q2 (or Q1) of every paper. Two flavours only:
> **(A) OOP class question** — class + constructor + 2 methods + object (Sample Quiz Q2),
> **(B) word-problem function** — take 3 inputs, "whole items only", leftovers, wasted money (every final).
> Both live inside ONE `.php` file that contains the HTML form and the PHP code together.

---

## 📖 Index

1. [Know This Cold — the 3 patterns](#1-know-this-cold--the-3-patterns)
2. [PHP Basics — syntax you must not fumble](#2-php-basics--syntax-you-must-not-fumble)
3. [Classes & Objects — full template](#3-classes--objects--full-template)
4. [HTML Forms & `$_POST`](#4-html-forms--_post)
5. [The `ceil()` Word-Problem Pattern](#5-the-ceil-word-problem-pattern)
6. [Built-in Functions You Need](#6-built-in-functions-you-need)
7. [Example Files — mapped to past papers](#7-example-files--mapped-to-past-papers)
8. [PHP ↔ MySQL (the connection skeleton)](#8-php--mysql-the-connection-skeleton)
9. [Traps — the marks people lose](#9-traps--the-marks-people-lose)
10. [Write From Memory — Self Test](#10-write-from-memory--self-test)
11. [How to Run the Examples](#11-how-to-run-the-examples)

---

## 1. Know This Cold — the 3 patterns

**Pattern A — Class (Sample Quiz Q2):**

```php
<?php
class Employee {
    public $name;
    public $basicSalary;
    public $bonus;

    public function __construct($name, $basicSalary, $bonus) {
        $this->name        = $name;
        $this->basicSalary = $basicSalary;
        $this->bonus       = $bonus;
    }

    public function calculateTotalSalary() {
        return $this->basicSalary + $this->bonus;
    }

    public function printDetails() {
        echo "Total Salary: " . $this->calculateTotalSalary() . "<br>";
    }
}

$emp = new Employee("Arif", 45000, 5000);
$emp->printDetails();
?>
```

**Pattern B — One-file form + word problem:**

```php
<form method="post">
    <input type="number" name="x" required>
    <input type="submit" name="submit" value="Calculate">
</form>

<?php
if (isset($_POST["submit"])) {
    $x = $_POST["x"];
    $result = ceil($x / 10);
    echo "Result: " . $result;
}
?>
```

**Pattern C — Pass/Fail classifier:**

```php
if ($total > 54) {
    $status = "Passed";
} else {
    $status = "Failed";
}
```

---

## 2. PHP Basics — syntax you must not fumble

```php
<?php
// variables ALWAYS start with $
$name = "Arif";
$salary = 45000;

// concatenation is a DOT (.), not +
echo "Name: " . $name . "<br>";

// arithmetic: + - * / %  and ceil() for rounding UP
$total = $salary + 5000;
$half  = $total / 2;

// if / elseif / else
if ($total >= 500) {
    $grade = "Excellent";
} elseif ($total >= 300) {
    $grade = "Good";
} else {
    $grade = "Poor";
}

// HTML goes OUTSIDE the <?php ... ?> tags (or inside echo "...")
?>
```

**Echo with HTML** — both styles are accepted in the exam:

```php
echo "Total: " . $total . "<br>";          // concatenation
?>
<p>Total: <?php echo $total; ?></p>        // mixed HTML
```

---

## 3. Classes & Objects — full template

Memorise this shape. `$this` and `->` are the two things people forget.

```php
class ClassName {
    // 1) properties (no $ when you declare them? NO — always $)
    public $property1;
    public $property2;

    // 2) constructor — TWO underscores: __construct
    public function __construct($value1, $value2) {
        $this->property1 = $value1;     // $this->property = parameter
        $this->property2 = $value2;
    }

    // 3) member function that RETURNS a value
    public function calculateSomething() {
        return $this->property1 + $this->property2;
    }

    // 4) member function that PRINTS
    public function printDetails() {
        echo "Property 1: " . $this->property1 . "<br>";
        echo "Result: " . $this->calculateSomething() . "<br>";  // reuse!
    }
}

// 5) create an object and call it — no $ before the method name
$object = new ClassName("hello", 100);
$object->printDetails();
```

**Rules that earn marks:**
- `__construct` — exactly two underscores.
- Inside the class, refer to properties as `$this->property` (with `$`), never `$property` alone.
- `return` gives a value back; `echo` prints it. `calculateTotalSalary()` must **return**, `printDetails()` must **echo**.
- Calling a function on an object: `$object->method()` — the `->` (not `.`, not `=>`).

---

## 4. HTML Forms & `$_POST`

One file: the form and the PHP that processes it.

```php
<!DOCTYPE html>
<html>
<body>

<form method="post">
    Number of Students: <input type="number" name="students" required><br><br>
    <input type="submit" name="submit" value="Calculate">
</form>

<?php
if (isset($_POST["submit"])) {          // only run after the button is pressed
    $students = $_POST["students"];     // name="students" -> $_POST["students"]
    echo "You entered: " . $students;
}
?>

</body>
</html>
```

| HTML | PHP |
|---|---|
| `<input name="students">` | `$_POST["students"]` |
| `<input type="submit" name="submit">` | `isset($_POST["submit"])` |
| `method="post"` | `$_POST` (use `$_GET` for `method="get"`) |

`$_POST` values arrive as **strings**, but PHP converts them automatically in maths (`"250" * 2` → `500`).

---

## 5. The `ceil()` Word-Problem Pattern

Every final has one: **"you cannot book/buy partial X"** → always `ceil()`.

**The universal recipe:**

```php
$needed   = $a * $b;                          // 1) total required
$items    = ceil($needed / $capacity);        // 2) round UP to whole items
$supplied = $items * $capacity;               // 3) capacity of what you ordered
$leftover = $supplied - $needed;              // 4) leftover = supplied - needed
$wasted   = $leftover * $costPerUnit;         // 5) money wasted
```

**All four exam variants use the same recipe:**

| Paper | Question | `needed` | `items` | `wasted money` |
|---|---|---|---|---|
| Final 243 | Pizza party | `students × slicesPerStudent` | `ceil(needed / slicesPerPizza)` | `leftover × (1050 / slicesPerPizza)` |
| Final 251 | Venue booking | attendees (already a count) | `ceil(attendees / capacity)` | `emptySeats × costPerPerson` |
| Final 252 | Movie screens | attendees | `ceil(attendees / capacity)` | `emptySeats × ticketPrice` |
| Final 261B | Mars rover battery | `distance × energyPerMeter` | `ceil(required / capacity)` | status by `unused / carried` |

**Verified sample runs** (use these to check your code):

| Input | Output |
|---|---|
| pizza: 10, 3, 8 | 4 pizzas, 2 leftover, 262.5 wasted |
| venue: 250, 120, 80 | 4 venues, 70 empty, 8400 wasted |
| screens: 150, 60, 500 | 3 screens, 30 empty, 15000 wasted |
| rover: 1200, 8, 5000 | 9600 required, 2 modules, 400 unused, Efficient |

**Watch the distractors:** the "venue costs 15,000" / "screen costs 25,000" numbers are NOT used in the wasted-money formula (the sample outputs prove it — wasted = empty × cost per person/ticket).

---

## 6. Built-in Functions You Need

| Function | What it does | Example |
|---|---|---|
| `ceil(x)` | round **up** | `ceil(30/8)` → 4 |
| `floor(x)` | round **down** | `floor(30/8)` → 3 |
| `round(x)` | nearest | `round(3.75)` → 4 |
| `min(a, b, c)` | smallest value | best-two-of-three: `$sum - min($ct1,$ct2,$ct3)` |
| `max(a, b, c)` | largest value | |
| `abs(x)` | absolute value | |
| `number_format(x)` | thousands separators | `number_format(8400)` → `8,400` |
| `strlen($s)` | string length | |
| `count($arr)` | array length | |
| `isset($_POST["x"])` | was it submitted? | |

---

## 7. Example Files — mapped to past papers

| File | Paper | Key technique |
|---|---|---|
| `01_employee_class.php` | **Sample Quiz Q2** | class, `__construct`, return + echo methods |
| `02_pizza_party_243.php` | Final 243 Q2 | `ceil`, leftover, price-per-slice |
| `03_venue_booking_251.php` | Final 251 Q2 | `ceil`, empty seats, distractor cost |
| `04_movie_screens_252.php` | Final 252 Q2 | `ceil`, empty seats, ticket price |
| `05_ct_marks_253.php` | Final 253 Q1 | best two of three with `min()`, pass/fail |
| `06_sales_event_253.php` | Final 253 Q2 | classify + above/below/exactly target |
| `07_academic_tracking_261.php` | Final 261A Q2 | classify (120/90/60) + target difference |
| `08_mars_rover_261b.php` | Final 261B Q2 | `ceil`, unused energy, %-based status |

---

## 8. PHP ↔ MySQL (the connection skeleton)

The quiz's last question combines both. This is the whole answer shape (details in the `MySQL/` folder):

```php
<?php
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "bank";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT SUM(salary) AS total, AVG(salary) AS average FROM employees";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "Total: " . $row["total"] . "<br>";
        echo "Average: " . $row["average"] . "<br>";
    }
} else {
    echo "0 results";
}
$conn->close();
?>
```

> On your XAMPP the port is **3307**, so locally you add a 5th argument: `new mysqli("localhost", "root", "", "bank", 3307);`
> In the exam (sample code in the paper) there is **no port** — use the version above.

---

## 9. Traps — the marks people lose

1. **`$` on every variable** — `$name`, `$_POST["x"]`, `$this->salary`. `name = "x";` is wrong.
2. **`.` not `+` for joining strings** — `"Total: " . $total`, never `"Total: " + $total`.
3. **`->` vs `=>`** — `$object->method()`, `$this->property`; `=>` is only for array key-values.
4. **`__construct`** — two underscores. One underscore = the constructor never runs.
5. **`return` vs `echo`** — "calculate and return" means `return`; "display/print" means `echo`.
6. **Write `<?php ... ?>` tags on paper** — losing them loses marks.
7. **`name="submit"` is required** for `isset($_POST["submit"])` to work.
8. **`ceil` for "whole items only"** — `floor` gives too few, plain `/` gives fractions.
9. **Integer-looking outputs:** `echo 262.5` prints `262.5`; `echo 8400` prints `8400`. If the expected output shows `8,400`, use `number_format($x)` — but never on decimals (it rounds to an integer).
10. **Boundary operators:** "total > 54" means `>`, not `>=`. "91+" means `>= 91`.
11. **Check ranges highest-first** (`>= 500` before `>= 300`) or everything lands in the wrong bucket.
12. **Know the Final 253 paper's own contradiction:** it writes "Excellent: 500 or more" but its sample table shows 400 as "Excellent". `06_sales_event_253.php` follows the **written rule (500)** — in the exam, follow the written conditions.

---

## 10. Write From Memory — Self Test

- [ ] The full `Employee` class (properties, `__construct`, `calculateTotalSalary`, `printDetails`) + object creation
- [ ] The one-file form skeleton: `<form method="post">` + `if (isset($_POST["submit"]))`
- [ ] The 5 lines of the `ceil()` recipe
- [ ] `$sum - min($ct1, $ct2, $ct3)` for best-two-of-three
- [ ] The classify chain with `>=` boundaries (500/300/150)
- [ ] above/below/exactly-target with difference (three branches)
- [ ] The mysqli connect + query + `while ($row = $result->fetch_assoc())` skeleton
- [ ] `$row["columnName"]` — the column name comes from the SQL `AS` alias

---

## 11. How to Run the Examples

**Option A — browser via XAMPP Apache:** copy any `.php` file into `G:\xampp\htdocs\` and open `http://localhost/<filename>.php`. Fill the form and press Calculate.

**Option B — PHP built-in server (no Apache needed):**

```powershell
& "G:\xampp\php\php.exe" -S localhost:8000
# then open http://localhost:8000/01_employee_class.php etc.
```

Run the command from inside `D:\WEB\Web-Practice\Final\PHP`.

**Option C — syntax check only (fast, catches typos):**

```powershell
& "G:\xampp\php\php.exe" -l 02_pizza_party_243.php
```

**Expected outputs to compare against** are in the comments at the top of every file.
