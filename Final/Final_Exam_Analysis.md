# UIU CSE4165 / CSE465 Web Programming Final Exam Generalized Analysis & Strategy

## 1. Exam Blueprint & Scoring Model

- **Duration**: 2 Hours (120 Minutes &rarr; 40 minutes per question)
- **Total Marks**: 30 Marks (3 Questions &times; 10 Marks each)
- **Question Structure**:
  - **Q1 [10 Marks]**: **JavaScript Interactive Web Application** (HTML form controls + DOM event handler + persistent state/accumulator + mathematical/conditional evaluation + DOM feedback + state disabling).
  - **Q2 [10 Marks]**: **PHP Server-Side Processing & Business Logic** (Form submission via `$_POST` + resource quantization via `ceil()` OR progress classification ladder OR Best-of-N computation OR OOP class).
  - **Q3 [10 Marks]**: **PHP & MySQL Database Integration** (DDL/DML schema setup + `mysqli` database connection + 4 query patterns: selective filters, guarded conditional updates, `GROUP BY ... HAVING` aggregations, computed net totals/subqueries + loop rendering).
- **Core Strategy**: Questions are never entirely novel; they are compositions of **modular algorithmic building blocks**. Instead of memorizing specific past paper answers, master the universal building blocks below to solve *any* unseen problem.

---

## 2. Question 1: JavaScript Universal Decomposition Model

Every JS final question—regardless of whether it presents as a game, a fitness tracker, a study logger, a vital monitor, or an auth validator—is built on the exact same 5-stage pipeline:

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

## 4. Question 3: MySQL & PHP Integration Deep-Dive (Weak Point Focus)

Students lose marks in Q3 because of syntax omissions or confusion between SQL clauses. Master these distinct query responsibilities:

### 1. DDL Foundations (Table Schema)
- Always start by creating the database and table:
  ```sql
  CREATE DATABASE IF NOT EXISTS shop_db;
  USE shop_db;
  CREATE TABLE items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    category VARCHAR(50),
    price DECIMAL(10,2) DEFAULT 0.00,
    stock INT DEFAULT 0,
    rating FLOAT DEFAULT 0.0
  );
  INSERT INTO items (name, category, price, stock, rating) VALUES
  ('Item A', 'Tech', 500.00, 10, 4.8),
  ('Item B', 'Tech', 150.00, 25, 4.2);
  ```

### 2. The 5 Core SQL Query Types
| Query Type | Syntax Blueprint | Purpose / Exam Trigger |
|:---|:---|:---|
| **Selective Filter** | `SELECT cols FROM tbl WHERE (cond1 OR cond2) AND cond3 ORDER BY col DESC;` | "Display all items in category X or with rating > 4.5, sorted by price highest first" |
| **Substring Search** | `SELECT cols FROM tbl WHERE col LIKE '%keyword%';` | "SpotName contains the word 'Beach'" |
| **Range Filter** | `SELECT cols FROM tbl WHERE col BETWEEN low AND high;` | "Rating is between 4.0 and 4.5 inclusive" |
| **Group Aggregation** | `SELECT cat, COUNT(*) AS total, AVG(score) AS avg_s FROM tbl GROUP BY cat HAVING AVG(score) > 4.4;` | "For each category, show count and average, but only categories with avg > 4.4" |
| **Guarded UPDATE** | `UPDATE tbl SET price = price * 1.10 WHERE price > 20 AND price * 1.10 <= 50;` | "Increase fee by 10%, but only if resulting fee does not exceed 50" |
| **Conditional Swap** | `UPDATE tbl SET grade = 'C' WHERE score < 75 AND grade <> 'D';` | "If score < 75 and current grade is not D, change to C" |
| **Computed Total** | `SELECT SUM(price * stock) AS net_worth FROM tbl;` | "Total net worth across entire inventory" |
| **Subquery / CASE** | `SELECT name, CASE WHEN rev > (SELECT AVG(rev) FROM tbl) THEN 'High' ELSE 'Low' END AS status FROM tbl;` | "Label as Top Seller if above average" |

### 3. The Difference Between `WHERE` and `HAVING` (Critical Mark Saver)
- `WHERE` filters **raw rows** *before* any grouping or aggregation takes place.
- `HAVING` filters **grouped aggregate values** *after* `GROUP BY` has combined the rows.
- **Rule**: Never put `COUNT(*)`, `SUM()`, or `AVG()` inside a `WHERE` clause! Write `GROUP BY col HAVING COUNT(*) > 1`.

### 4. Master PHP ↔ MySQL Bridge (OOP `mysqli`)
```php
<?php
$conn = new mysqli("localhost", "root", "", "shop_db");
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }

// Reading data (SELECT)
$sql = "SELECT category, COUNT(*) AS count, AVG(price) AS avg_price FROM items GROUP BY category";
$result = $conn->query($sql);
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "Cat: " . $row["category"] . " | Count: " . $row["count"] . " | Avg: " . $row["avg_price"] . "<br>";
    }
} else {
    echo "0 results found<br>";
}

// Updating data (UPDATE / INSERT / DELETE)
$updateSql = "UPDATE items SET price = price * 1.05 WHERE stock < 5";
if ($conn->query($updateSql) === TRUE) {
    echo "Updated successfully (" . $conn->affected_rows . " rows affected)<br>";
} else {
    echo "Error updating: " . $conn->error . "<br>";
}

$conn->close();
?>
```

---

## 5. Cheat Sheet Architecture Blueprint (High-Density Generalized 2-Page A4)

- **Target Print Size**: Exactly **2 Pages A4 Portrait**, `@page { margin: 2mm; }`, body `font-size: 8.5pt`.
- **Page 1: HTML Controls + JavaScript Mechanics + PHP Foundations**:
  - Col 1: HTML5 Input Controls & Form Attributes + DOM Extraction, Strict Parsing & State Mutators.
  - Col 2: Universal JS Algorithmic Engines (Accumulators, Session Loggers, Tier Ladders, Target Difference, State Disabling).
  - Col 3: JS Built-in Functions (Math, Random Integer Formula, String manipulation, Regex, Array methods) + Single-file PHP Form Skeleton & Form Security.
- **Page 2: Advanced PHP Logic + MySQL Database Mastery + PHP-MySQL Bridge**:
  - Col 1: PHP Problem-Solving Engines (Resource Allocator `ceil()`, Progress Classifier Ladder, Best-of-N marks, OOP Class Template).
  - Col 2: SQL DDL/DML Foundations + Deep Query Mastery (Selective Filters, Substring `LIKE`, `BETWEEN`, `ORDER BY`, `LIMIT`).
  - Col 3: Advanced SQL Grouping (`GROUP BY` + `HAVING`), Guarded Arithmetic `UPDATE`, Computed Expressions (`SUM(a*b)`), and the Complete PHP `mysqli` Multi-Row Bridge + HTML Table Renderer.
