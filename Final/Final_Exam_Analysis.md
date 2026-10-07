# UIU CSE4165 / CSE465 Web Programming Final Exam Analysis & Strategy Guide

## 1. Exam Structure & Blueprint Overview

- **Duration**: 2 Hours (120 Minutes — approx. 40 minutes per question)
- **Total Marks**: 30 Marks (3 Questions × 10 Marks each)
- **Question Distribution**:
  - **Q1: JavaScript (10 Marks)** — Interactive DOM Mini-Application (Input fields + Event Button + Calculation/Feedback Label).
  - **Q2: PHP (10 Marks)** — Server-Side Computation & Form Processing (Resource allocation with `ceil()`, target evaluation, or OOP class).
  - **Q3: PHP & MySQL (10 Marks)** — Database Schema Creation, DML/DDL, SQL queries, and full PHP `mysqli` connection & loop scripts.
- **Exam Delivery**: Written on paper / lab exam. All papers require **complete, syntactically correct code** (HTML, JavaScript, PHP, SQL inside PHP).
- **Core Pattern Discovery**: Across all 5 past exam trimesters (**243**, **251**, **252**, **253**, **261 Set-A**, **261 Set-B**), the questions reuse **identical algorithmic and architectural skeletons**, varying only in problem domain narratives, formulas, and field names.

---

## 2. Comprehensive Trimester-by-Trimester Paper Breakdown

### 📜 Paper 1: Fall 2024 (Trimester 243)
| Question | Domain | Key Mechanism & Formulas | Marks |
|:---|:---|:---|:---:|
| **Q1 (JS)** | **Secret Number Guessing Game** | Random number between 500–5000: `Math.floor(Math.random() * 4501) + 500`. 5 attempts limit, feedback `"Too high!"`, `"Too low!"`, `"Correct!"`, `"Out of guesses!"`. Disable input on win/loss. | 10 |
| **Q2 (PHP)** | **Pizza Party Allocator** | Inputs: `students`, `slicesPerStudent`, `slicesPerPizza`.<br>• `needed = students * slicesPerStudent`<br>• `pizzas = ceil(needed / slicesPerPizza)`<br>• `leftover = (pizzas * slicesPerPizza) - needed`<br>• `wasted = leftover * (1050 / slicesPerPizza)`. | 10 |
| **Q3 (MySQL)** | **Student Final Grades (`student_final`)** | Table: `StudentID`, `StudentName`, `CourseID`, `CourseTitle`, `Grade`, `LetterGrade`.<br>1. `SELECT LetterGrade, COUNT(*) GROUP BY LetterGrade`<br>2. `UPDATE ... SET LetterGrade = 'C' WHERE Grade < 75 AND LetterGrade <> 'D'`<br>3. `UPDATE ... SET Grade = Grade + 5 WHERE Grade > 80 AND Grade + 5 <= 90`<br>4. Popular courses: `SELECT CourseTitle, COUNT(*) GROUP BY CourseTitle ORDER BY COUNT(*) DESC`. | 10 |

---

### 📜 Paper 2: Spring 2025 (Trimester 251)
| Question | Domain | Key Mechanism & Formulas | Marks |
|:---|:---|:---|:---:|
| **Q1 (JS)** | **Password Strength Meter** | Target 100 pts. Scoring:<br>• Length: `Math.floor((len - 6) / 2) * 10` (min 6 chars)<br>• Uppercase (`/[A-Z]/`): +15<br>• Lowercase (`/[a-z]/`): +15<br>• Digits (`/[0-9]/`): +20<br>• Special (`/[!@#$%^&*]/`): +25<br>Feedback tiers: 0–30 (Very Weak), 31–50 (Weak), 51–70 (Medium), 71–90 (Strong), 91+ (Very Strong), 100+ ("Perfect Password!"). > 8 attempts warning. | 10 |
| **Q2 (PHP)** | **Tech Fest Venue Booking** | Inputs: `attendees`, `costPerPerson`, `capacity`.<br>• `venues = ceil(attendees / capacity)`<br>• `emptySeats = (venues * capacity) - attendees`<br>• `wasted = emptySeats * costPerPerson`<br>*(Distractor: Venue cost 15,000 BDT is not part of empty seats formula)*. | 10 |
| **Q3 (MySQL)** | **Employee Records (`employee_final`)** | Table: `EmployeeID`, `EmployeeName`, `DepartmentID`, `DepartmentName`, `Salary`, `PerformanceRating`.<br>1. Rating counts across all departments.<br>2. `UPDATE ... SET PerformanceRating = 'C' WHERE Salary < 40000 AND PerformanceRating <> 'D'`<br>3. `UPDATE ... SET Salary = Salary + 5000 WHERE Salary > 50000 AND Salary + 5000 <= 60000`<br>4. Largest department first: `GROUP BY DepartmentName ORDER BY COUNT(*) DESC`.<br>*(Paper specifically printed mysqli template code)*. | 10 |

---

### 📜 Paper 3: Summer 2025 (Trimester 252)
| Question | Domain | Key Mechanism & Formulas | Marks |
|:---|:---|:---|:---:|
| **Q1 (JS)** | **Daily Calorie Tracker** | Daily goal: 2000 cal. Running total accumulator.<br>• Tiers: 0–800 ("Healthy start"), 801–1600 ("Good progress"), 1601–1999 ("Almost at limit"), 2000+ ("Goal reached!").<br>• > 10 entries warning: `"Be cautious of frequent snacking!"`. | 10 |
| **Q2 (PHP)** | **Movie Night Screen Allocator** | Inputs: `attendees`, `capacity`, `ticketPrice`.<br>• `screens = ceil(attendees / capacity)`<br>• `empty = (screens * capacity) - attendees`<br>• `wasted = empty * ticketPrice`<br>*(Distractor: Screen rental 25,000 BDT)*. | 10 |
| **Q3 (MySQL)** | **Sales Data (`sales_data` in `sundarban`)** | Table: `SaleID`, `ProductName`, `CategoryID`, `CategoryName`, `Quantity`, `Revenue`.<br>1. `SELECT CategoryName, SUM(Revenue) GROUP BY CategoryName`<br>2. `UPDATE ... SET CategoryName = 'Low Performing' WHERE Revenue < 40000`<br>3. `UPDATE ... SET Revenue = Revenue * 1.10 WHERE Revenue > 70000`<br>4. Correlated Subquery / CASE: Top Seller if `Revenue > (SELECT AVG(s2.Revenue) FROM sales_data s2 WHERE s2.CategoryID = s1.CategoryID)`. | 10 |

---

### 📜 Paper 4: Fall 2025 (Trimester 253)
| Question | Domain | Key Mechanism & Formulas | Marks |
|:---|:---|:---|:---:|
| **Q1 (PHP)** | **CT & Exam Marks Processor** | Inputs: 3 CT marks, midterm mark, final mark.<br>• Best 2 of 3 CT: `$ctAvg = ($ct1 + $ct2 + $ct3 - min($ct1, $ct2, $ct3)) / 2`<br>• `total = $ctAvg + $mid + $final`<br>• Status: `total > 54` ? "Passed" : "Failed". | 10 |
| **Q2 (PHP)** | **Event Sales Planning** | Inputs: `soldPerDay`, `days`, `target`.<br>• `totalSold = soldPerDay * days`<br>• Tiers: 500+ (Excellent), 300+ (Good), 150+ (Average), < 150 (Poor).<br>• Comparison against target: Exactly met (diff 0), Above target by diff, Below target by diff. | 10 |
| **Q3 (MySQL)** | **Campus Library Loans (`book_loans`)** | Table: `LoanID`, `StudentName`, `BookTitle`, `DaysOverdue`, `PenaltyFee`, `Status`.<br>1. `SELECT Status, COUNT(*) GROUP BY Status HAVING COUNT(*) > 1`<br>2. `UPDATE ... SET Status = 'Grace Period', PenaltyFee = 0 WHERE Status = 'Overdue' AND DaysOverdue < 7`<br>3. `UPDATE ... SET PenaltyFee = PenaltyFee * 1.1 WHERE PenaltyFee > 20.00 AND PenaltyFee * 1.1 <= 50.00`<br>4. `SELECT BookTitle, SUM(PenaltyFee) AS TotalFee GROUP BY BookTitle ORDER BY TotalFee DESC`. | 10 |

---

### 📜 Paper 5: Spring 2026 Set-A (Trimester 261 Set-A)
| Question | Domain | Key Mechanism & Formulas | Marks |
|:---|:---|:---|:---:|
| **Q1 (JS)** | **Weekly Study Hours Tracker** | Inputs: `subjectName`, `studyHours`. Weekly goal: 20 hrs.<br>• Arrays: `subjects.push(name)`, `sessions++`, running total hours.<br>• Average: `totalHours / sessions`.<br>• Tiers: 0–5, 6–12, 13–19, 20+.<br>• > 7 sessions warning: `"Increase your study time!"`. Display `subjects.join(", ")`. | 10 |
| **Q2 (PHP)** | **Academic Tracking System** | Inputs: `creditsPerCourse`, `coursesCompleted`, `targetCredits`.<br>• `total = creditsPerCourse * coursesCompleted`<br>• Tiers: 120+ (Excellent), 90+ (Good), 60+ (Average), < 60 (Poor).<br>• Comparison against target: Exactly met, Above target by diff, Below target by diff. | 10 |
| **Q3 (MySQL)** | **Tourism Spot Database (`tourist_spot`)** | Table: `SpotID`, `SpotName`, `Region`, `Category`, `Rating`, `EntryFee`, `VisitorsPerYear`.<br>1. `SELECT SpotName, Region, Rating WHERE Rating > 4.5 OR SpotName LIKE '%Beach%' ORDER BY Rating DESC`<br>2. `UPDATE ... SET Rating = Rating + 0.2, EntryFee = EntryFee * 1.1 WHERE Rating BETWEEN 4.0 AND 4.5 AND EntryFee > 0`<br>3. `SELECT Category, COUNT(*), AVG(Rating), SUM(VisitorsPerYear) GROUP BY Category HAVING AVG(Rating) > 4.4 ORDER BY AVG(Rating) DESC`<br>4. `SELECT Region, SUM(EntryFee * VisitorsPerYear) AS Revenue GROUP BY Region HAVING Revenue > 1000000 ORDER BY Revenue DESC`. | 10 |

---

### 📜 Paper 6: Spring 2026 Set-B (Trimester 261 Set-B)
| Question | Domain | Key Mechanism & Formulas | Marks |
|:---|:---|:---|:---:|
| **Q1 (JS)** | **Patient Vitals Health Monitor** | Inputs: `heartRate`, `spO2`. Running reading arrays.<br>• `avgHR = sumHR / count`, `avgSpO2 = sumSpO2 / count`<br>• Formula: `RiskScore = (100 - spO2) * 2 + Math.abs(heartRate - 80) * 0.5`<br>• Tiers: `<= 10` ("SAFE"), `11–20` ("WARNING"), `> 20` ("DANGER"). | 10 |
| **Q2 (PHP)** | **Mars Rover Battery Allocator** | Inputs: `distance`, `energyPerMeter`, `capacity`.<br>• `required = distance * energyPerMeter`<br>• `modules = ceil(required / capacity)`<br>• `carried = modules * capacity`<br>• `unused = carried - required`<br>• Status: `(unused / carried) <= 0.10` (Efficient), `<= 0.25` (Acceptable), `> 0.25` (Wasteful). | 10 |
| **Q3 (MySQL)** | **Bookshop Inventory (`book_info`)** | Table: `BookID`, `BookTitle`, `Author`, `Category`, `Price`, `Stock`.<br>1. `SELECT * WHERE Category = 'Programming' ORDER BY Price DESC`<br>2. `SELECT BookTitle, Author, Price WHERE Price > 400 AND Category = 'Programming'`<br>3. `SELECT Category, COUNT(*) GROUP BY Category`<br>4. Total Net Worth: `SELECT SUM(Price * Stock) AS NetWorth FROM book_info`<br>5. `UPDATE book_info SET Price = Price * 0.90 WHERE Category = 'Language'` + display updated rows. | 10 |

---

## 3. The 3 Master Pillars & Universal Code Archetypes

### 🏛️ Pillar 1: JavaScript Interactive Applications (Q1)
Every single JS final exam question requires:
1. An HTML form with 1 or 2 `<input>` fields and a `<button onclick="...">`.
2. An output container (`<p id="output">` or `<label id="output">`).
3. Persistent state variables defined **outside** the handler function (accumulators, counters, arrays, secret keys).
4. An event function that extracts values via `document.getElementById(...).value`, parses numbers, computes values, evaluates conditional thresholds, and writes via `innerHTML`.

#### The 4 Universal JS Archetypes:
```
+----------------------------------------------------------------------------------+
| JS ARCHETYPE 1: RANDOM GUESS GAME (Final 243)                                    |
| • Secret: Math.floor(Math.random() * (max - min + 1)) + min (outside function)  |
| • Attempts counter (attempts++ <= 5)                                             |
| • Feedback: "Too high!", "Too low!", "Correct!"                                  |
| • State termination: input.disabled = true; button.disabled = true;             |
+----------------------------------------------------------------------------------+
| JS ARCHETYPE 2: SCORING / REGEX EVALUATOR (Final 251)                            |
| • String extraction: let p = input.value; let score = 0;                        |
| • Criteria: /[A-Z]/.test(p), /[0-9]/.test(p), Math.floor((len-6)/2)*10          |
| • Multi-level ladder: if (score >= 91) ... else if (score >= 71) ...            |
| • Attempt tracking & fallback hints                                              |
+----------------------------------------------------------------------------------+
| JS ARCHETYPE 3: SESSION ACCUMULATOR / TRACKER (Final 252, 261-A)                 |
| • Running total: total += enteredVal; count++;                                  |
| • Array collection: list.push(name);                                             |
| • Average computation: let avg = total / count;                                  |
| • High session warnings (> 7 or > 10 entries)                                    |
+----------------------------------------------------------------------------------+
| JS ARCHETYPE 4: DUAL-METRIC HEALTH / LIVE FORMULA (Final 261-B)                  |
| • Two inputs: val1, val2                                                         |
| • Historical averages with arrays & Math.abs()                                   |
| • Formula: (100 - spo2) * 2 + Math.abs(hr - 80) * 0.5                            |
| • Status classification: SAFE / WARNING / DANGER                                 |
+----------------------------------------------------------------------------------+
```

---

### 🏛️ Pillar 2: PHP Business Logic & Problem Solving (Q2)
Every PHP question is implemented either as a single self-contained script containing an HTML `<form method="post">` and PHP processor (`if(isset($_POST["submit"]))`), or as a standalone function / OOP class.

#### The 3 Universal PHP Archetypes:
```
+----------------------------------------------------------------------------------+
| PHP ARCHETYPE 1: THE ceil() WHOLE-UNIT RESOURCE ALLOCATOR                        |
| (Pizza 243, Venues 251, Movie Screens 252, Mars Rover 261B)                      |
| • Step 1: $needed = $demand * $rate;                                             |
| • Step 2: $units  = ceil($needed / $capacity);   <-- NON-NEGOTIABLE              |
| • Step 3: $supplied = $units * $capacity;                                        |
| • Step 4: $leftover = $supplied - $needed;                                       |
| • Step 5: $wastedCost = $leftover * $costPerItem;                                |
| • Note: Ignore distractor venue/screen flat costs; rely on unit price!           |
+----------------------------------------------------------------------------------+
| PHP ARCHETYPE 2: PROGRESS EVALUATOR & TARGET COMPARATOR                          |
| (Sales 253, Academic Credits 261A)                                               |
| • Total: $total = $rate * $count;                                                |
| • Classification: if ($total >= 120) "Excellent" elseif ($total >= 90) "Good"... |
| • Target comparison:                                                             |
|   if ($total == $target) -> "Target met exactly (0 difference)"                  |
|   elseif ($total > $target) -> "Above target by " . ($total - $target)           |
|   else -> "Below target by " . ($target - $total)                                |
+----------------------------------------------------------------------------------+
| PHP ARCHETYPE 3: BEST-OF-N FILTER & OOP CLASS                                    |
| (CT Marks 253, Sample Quiz Employee Class)                                       |
| • Best 2 of 3: ($ct1 + $ct2 + $ct3 - min($ct1, $ct2, $ct3)) / 2                  |
| • Class template: properties (public $x), __construct, member methods, $this->  |
| • Object instantiation: $obj = new ClassName(...); $obj->method();              |
+----------------------------------------------------------------------------------+
```

---

### 🏛️ Pillar 3: PHP & MySQL Full Integration (Q3)
Exam papers explicitly mandate: **"write full PHP–MySQL code, not just SQL queries"**.
The question consists of DDL/DML table creation, followed by 4 distinct query types executed inside a PHP `mysqli` wrapper.

#### The 4 Universal SQL Query Patterns:
1. **Group Aggregation with Conditional Filter**:
   ```sql
   SELECT Category, COUNT(*) AS Total, AVG(Rating) AS AvgRate
   FROM table_name
   GROUP BY Category
   HAVING COUNT(*) > 1; -- Or HAVING AVG(Rating) > 4.4
   ```
2. **Guarded Conditional UPDATE (Preventing overshoot)**:
   ```sql
   UPDATE table_name
   SET Fee = Fee * 1.10
   WHERE Fee > 20.00 AND Fee * 1.10 <= 50.00;
   ```
3. **Compound Selective Filter (`OR`, `LIKE`, `BETWEEN`)**:
   ```sql
   SELECT SpotName, Region, Rating
   FROM tourist_spot
   WHERE Rating > 4.5 OR SpotName LIKE '%Beach%'
   ORDER BY Rating DESC;
   ```
4. **Calculated Columns & Net Total**:
   ```sql
   SELECT SUM(Price * Stock) AS TotalNetWorth FROM book_info;
   ```

#### The Master PHP-MySQL Bridge Skeleton:
```php
<?php
$conn = new mysqli("localhost", "root", "", "dbname");
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }

// 1. SELECT Query with Multi-Row Loop
$sql = "SELECT Category, COUNT(*) AS Total FROM products GROUP BY Category";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo $row["Category"] . ": " . $row["Total"] . "<br>";
    }
}

// 2. UPDATE Query
$updateSql = "UPDATE products SET Price = Price * 1.1 WHERE Price < 50";
if ($conn->query($updateSql) === TRUE) {
    echo "Updated successfully";
}

$conn->close();
?>
```

---

## 4. Common Exam Traps & "Mark Losers"

| Area | Trap Description | Correct Implementation |
|:---|:---|:---|
| **JS** | `.value` returns a `string`. Adding `"5" + 5` produces `"55"`. | Always parse: `parseInt(input.value)` or `parseFloat(input.value)`. |
| **JS** | Off-by-one in random integer formula. | Always `+ 1`: `Math.floor(Math.random() * (max - min + 1)) + min`. |
| **JS** | Using `.disable = true` instead of `.disabled`. | `input.disabled = true;` |
| **JS** | Inverted condition order in `if-else` ladders. | Check the highest values first: `>= 91` before `>= 71`. |
| **PHP** | Missing `$` on variable names or properties inside class. | `$name`, `$this->name` (note: no `$` on the property after `->`). |
| **PHP** | String concatenation using `+` instead of `.`. | Use dot: `"Total: " . $total`. |
| **PHP** | Forgetting `ceil()` for whole units, producing decimal pizzas/venues. | `$units = ceil($needed / $capacity);` |
| **PHP** | Using flat venue/screen rental costs in the wasted money formula. | Wasted money is always `empty_units * unit_rate` (ticket/seat cost). |
| **MySQL** | Running `UPDATE` without a `WHERE` guard. | Always include precise `WHERE` conditions. |
| **MySQL** | Using `WHERE` for aggregate functions instead of `HAVING`. | `HAVING COUNT(*) > 1`, never `WHERE COUNT(*) > 1`. |
| **MySQL** | Column alias mismatch in PHP fetch. | If SQL has `AS Total`, PHP must access `$row["Total"]`. |

---

## 5. Cheat Sheet Architecture Blueprint (2-Page A4)

To guarantee a comprehensive reference that fits onto exactly **2 pages of A4 paper** (no margins, 3 columns per page):

### Page 1 Blueprint: Core Skeletons & JavaScript Mastery
- **Header**: UIU CSE4165 Final Exam Cheat Sheet — 2-Page Ultra-Dense Master Reference
- **Col 1**:
  - Box 1: Universal JS Architecture & Form-To-DOM Skeleton (Inputs, button, output, parsing)
  - Box 2: Random Number Generation (Formula, range table, game state logic)
  - Box 3: Arrays, Loops & Math Helpers (`push`, `pop`, `join`, `slice`, `Math.abs`, `Math.round`)
- **Col 2**:
  - Box 4: JS Archetype 1 — Secret Number Guessing Game (Final 243 full code)
  - Box 5: JS Archetype 2 — Password Strength Evaluator with Regex (Final 251 full code)
- **Col 3**:
  - Box 6: JS Archetype 3 — Session History Accumulator & Study Tracker (Final 252 & 261A)
  - Box 7: JS Archetype 4 — Patient Vitals Health Monitor with Live Risk Score (Final 261B)
  - Box 8: JS Common Traps & Syntax Checklist

### Page 2 Blueprint: PHP Server Logic & MySQL Integration
- **Col 1**:
  - Box 9: PHP Universal Form & POST Handler Skeleton (`$_POST`, `isset`, `method="post"`)
  - Box 10: PHP OOP Class Template (`__construct`, methods, `$this->`, object creation)
  - Box 11: Best-of-3 CT Marks Calculator (`min()`, average, Pass/Fail)
- **Col 2**:
  - Box 12: PHP Resource Allocator `ceil()` Pattern (Pizza 243, Venues 251, Screens 252, Rover 261B)
  - Box 13: Target Progress & Performance Comparator (Sales 253, Credits 261A)
  - Box 14: PHP Traps & Distractor Traps (Venue flat fee vs empty seats)
- **Col 3**:
  - Box 15: Master PHP ↔ MySQL Bridge Skeleton (Full `mysqli` connection, query, multi-row loop, close)
  - Box 16: The 4 Must-Know SQL Queries (GROUP BY HAVING, Guarded UPDATE, BETWEEN/LIKE, Computed Net Worth)
  - Box 17: DDL Schema Templates (`CREATE DATABASE`, `CREATE TABLE`, `INSERT INTO`) & Final Exam Quick Lookup Matrix
