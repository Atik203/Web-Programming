# UIU CSE4165 / CSE465 Web Programming Final Exam Generalized Analysis & Strategy

## 1. Exam Blueprint & Scoring Model

- **Duration**: 2 Hours (120 Minutes &rarr; 40 minutes per question)
- **Total Marks**: 30 Marks (3 Questions &times; 10 Marks each)
- **Question Structure**:
  - **Q1 [10 Marks]**: **JavaScript Interactive Web Application** (HTML form controls + DOM event handler + persistent state/accumulator + mathematical/conditional evaluation + DOM feedback + state disabling).
  - **Q2 [10 Marks]**: **PHP Server-Side Processing & Business Logic** (Form submission via `$_POST` + resource quantization via `ceil()` OR progress classification ladder OR Best-of-N computation OR OOP class).
  - **Q3 [10 Marks]**: **PHP & MySQL Database Integration** (DDL/DML schema setup + `mysqli` database connection + deep query patterns: selective filters, guarded conditional updates, `GROUP BY ... HAVING` aggregations, multi-table `JOIN`s, subqueries & `CASE` expressions + HTML table rendering).
- **Core Strategy**: Master the universal building blocks below to solve *any* unseen problem on the exam sheet.

---

## 2. Question 1: JavaScript Universal Decomposition Model

Every JS final question is built on the 5-stage pipeline:

```
[ HTML Inputs (text/number/password) ]
              │
              ▼ (User clicks <button onclick="handleAction()">)
[ Stage 1: Extraction & Strict Parsing ]
  • let raw = document.getElementById("id").value;
  • let num = parseFloat(raw); // or parseInt(raw, 10)
              │
              ▼
[ Stage 2: Persistent State Mutation ] (Variables defined OUTSIDE function)
  • Accumulators: total += num;
  • Counters: entries++; attempts++;
  • History Arrays: list.push(item);
              │
              ▼
[ Stage 3: Algorithmic Evaluation & Calculation ]
  • Averages: let avg = total / entries;
  • Formula evaluation: e.g. (100 - x)*2 + Math.abs(y - 80)*0.5;
  • Tier Classification: if/elseif ladder (check highest threshold first!)
  • Random generation: Math.floor(Math.random() * (max - min + 1)) + min;
              │
              ▼
[ Stage 4: DOM Presentation & Feedback ]
  • output.innerHTML = `Total: ${total}, Status: ${status}`;
              │
              ▼
[ Stage 5: State Locking & Termination Guards ]
  • if (conditionMet || attempts >= limit) { input.disabled = true; }
```

### The 4 Generalized JS Building Blocks:
1. **Accumulator & Session History Block**: Takes repetitive numeric or string inputs, maintains running totals and collections, computes statistical summaries (mean, max, min), and formats history using `.join(", ")`.
2. **Threshold & Boundary Classifier Block**: Maps continuous numbers into categorical labels (e.g. Healthy/Warning/Danger, Weak/Medium/Strong, Passed/Failed). Always evaluates descending (`>= high`, then `>= mid`, then `else`).
3. **Difference & Target Comparator Block**: Measures absolute or signed distance from a target (`Math.abs(actual - target)`), producing dynamic directional feedback (Above by X, Below by X, Exact).
4. **Interactive State Machine Block**: Tracks attempt counts, compares against a hidden target (random number or policy rule), provides directional hints, and locks controls (`.disabled = true`) on completion or exhaustion.

---

## 3. Question 2: PHP Universal Problem-Solving Model

All PHP exam questions fall into one of three structural paradigms:

### Paradigm A: The Quantized Resource Allocator (`ceil()`)
- **The Concept**: Physical items, seats, pizza slices, vehicle runs, or battery modules cannot be purchased or deployed in fractions.
- **The Generalized Formula**:
  ```php
  $totalNeeded   = $demandUnits * $consumptionRate;
  $wholeItems    = ceil($totalNeeded / $capacityPerItem); // Quantization
  $totalSupplied = $wholeItems * $capacityPerItem;
  $unusedUnits   = $totalSupplied - $totalNeeded;
  $wastedCost    = $unusedUnits * $costPerSingleUnit;
  ```
- **Exam Distractor Law**: Questions often provide large flat facility costs (e.g., "venue costs 15,000 BDT", "screen rental is 25,000 BDT"). **Never** multiply unused units by flat facility costs. Wasted cost is strictly based on the per-person / per-unit rate.

### Paradigm B: Multi-Tiered Progress & Target Delta Evaluator
- **The Concept**: Calculates performance over time (`rate * units`), determines achievement bracket, and computes variance from a target.
- **The Generalized Formula**:
  ```php
  $total = $quantityPerUnit * $unitCount;
  // Bracket Classification
  if ($total >= $tier1)     { $category = "Tier 1"; }
  elseif ($total >= $tier2) { $category = "Tier 2"; }
  else                      { $category = "Tier 3"; }
  // Target Delta
  if ($total == $target)     { $msg = "Target met exactly (0 difference)"; }
  elseif ($total > $target)  { $msg = "Above target by " . ($total - $target); }
  else                       { $msg = "Below target by " . ($target - $total); }
  ```

### Paradigm C: Best-of-N Selection & OOP Encapsulation
- **Best-of-N Formula**: To take the best 2 out of 3 marks, subtract the minimum from the sum:
  `$bestAvg = ($a + $b + $c - min($a, $b, $c)) / 2;`
- **OOP Template**: Define `class Name`, declare `public $properties`, implement `__construct($p1, $p2)` using `$this->p1 = $p1`, implement member methods returning calculated values, and instantiate via `$obj = new Name(...); $obj->method();`.

---

## 4. Question 3: MySQL & PHP Deep Integration (Weak Point Focus)

### 1. DDL Foundations (Table Schema)
```sql
CREATE DATABASE IF NOT EXISTS uiu_db;
USE uiu_db;
CREATE TABLE records (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(60) NOT NULL,
  category VARCHAR(30),
  stock INT DEFAULT 0,
  fee DECIMAL(10,2),
  rating FLOAT,
  reg_date DATE,
  status VARCHAR(20)
);
```

### 2. Comprehensive SQL Query Patterns

| Query Pattern | Syntax Blueprint | UIU Exam Paper Reference |
|:---|:---|:---|
| **Selective Filter** | `SELECT title, category, rating FROM records WHERE rating > 4.5 OR title LIKE '%Beach%' ORDER BY rating DESC;` | Spring 261-A Q3 |
| **Inclusive Range** | `SELECT * FROM records WHERE rating BETWEEN 4.0 AND 4.5;` | Spring 261-A Q3 |
| **Set Membership** | `SELECT * FROM records WHERE category IN ('CSE', 'EEE');` | Quiz & Finals |
| **Group Aggregation** | `SELECT category, COUNT(*) AS total_items, AVG(rating) AS avg_rate FROM records GROUP BY category HAVING COUNT(*) > 1 AND AVG(rating) > 4.4 ORDER BY avg_rate DESC;` | Fall 253 & Spring 261-A |
| **Guarded UPDATE** | `UPDATE records SET fee = fee * 1.10 WHERE fee > 20.00 AND fee * 1.10 <= 50.00;` | Fall 243, 251, 253 |
| **Conditional Swap** | `UPDATE records SET status = 'Grace Period', fee = 0 WHERE status = 'Overdue' AND days_overdue < 7;` | Fall 253 Q3 |
| **Grand Net Worth** | `SELECT SUM(fee * stock) AS grand_total FROM records;` | Spring 261-B Q3 |
| **Scalar Subquery** | `SELECT title, fee FROM records WHERE fee > (SELECT AVG(fee) FROM records);` | General Pattern |
| **Correlated Subquery CASE** | `SELECT title, fee, CASE WHEN fee > (SELECT AVG(r2.fee) FROM records r2 WHERE r2.category = r1.category) THEN 'Top Seller' ELSE 'Regular Seller' END AS seller_tier FROM records r1;` | Summer 252 Q3 |

### 3. Multi-Table JOIN Patterns (Likely Exam Candidates)

#### A. Standard `INNER JOIN` (Enrollments & Courses)
```sql
SELECT s.name, c.title, e.grade
FROM student s
INNER JOIN enrollment e ON s.id = e.student_id
INNER JOIN course c ON e.course_id = c.id;
```

#### B. `LEFT JOIN` with Aggregation (Count per Department, including 0)
```sql
SELECT d.name, COUNT(e.id) AS emp_count
FROM department d
LEFT JOIN employee e ON d.id = e.dept_id
GROUP BY d.id;
```

#### C. Multi-Table Join with Computed Revenue
```sql
SELECT c.name, SUM(o.qty * p.price) AS total_spent
FROM customer c
JOIN orders o ON c.id = o.customer_id
JOIN product p ON o.product_id = p.id
GROUP BY c.id;
```

---

## 5. Master PHP ↔ MySQL Bridge Architecture

```php
<?php
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "uiu_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// SELECT with multi-row loop
$sql1 = "SELECT category, COUNT(*) AS total_items, AVG(fee) AS avg_fee
         FROM records GROUP BY category HAVING COUNT(*) > 1 ORDER BY avg_fee DESC";
$result1 = $conn->query($sql1);

if ($result1 && $result1->num_rows > 0) {
  while ($row = $result1->fetch_assoc()) {
    echo $row["category"] . ": " . $row["total_items"] . " (Avg: " . $row["avg_fee"] . ")<br>";
  }
} else { echo "0 results<br>"; }

// UPDATE with check
$sql2 = "UPDATE records SET fee = fee * 1.10 WHERE fee > 20 AND fee * 1.10 <= 50";
if ($conn->query($sql2) === TRUE) {
  echo "Updated (" . $conn->affected_rows . " rows)<br>";
}

$conn->close();
?>
```

---

## 6. Physical Cheat Sheet Typography Configuration

- **Target Format**: Exactly **2 Pages A4 Portrait**, `@page { size: A4 portrait; margin: 2mm; }`.
- **Card Headers (`.box-title`)**: **`8.0pt`** (font-weight: 800) for instant visibility from an exam table.
- **Inside Code & Text (`pre`, `p`, `.hint`, `.warn`, `table`)**: **Minimum `7.5pt`** (font size boosted from 5.6pt to 7.5pt for maximum readability).
- **Physical Column Balance**: Both Page 1 and Page 2 reach the bottom edge with 0 spillover onto Page 3.
