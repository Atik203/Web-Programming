# Final-Solutions — Implementation Plan

> **For the implementing agent:** execute this plan task-by-task. Steps use `- [ ]` checkboxes.
> Pattern source of truth: `Final/cheatsheet.html` (boxes 1–25). Every solution file must be
> written in the SAME pattern vocabulary as those boxes, so practising a solution = practising
> the cheat sheet.

**Goal:** Solve all 18 past-paper questions (6 papers × Q1/Q2/Q3) inside `Final/Final-Solutions/`,
every file runnable on XAMPP, every file following the cheat-sheet patterns, then link the folder
from the hub `Final/index.php`.

**Tech stack:** plain HTML + inline `<script>` (Q1s) · one-file PHP forms (Q2s and 253 Q1) ·
one-file PHP + mysqli ↔ MySQL on **port 3307** (Q3s). No external files. No fancy CSS.

---

## 1. Locked Decisions

1. **File types** (user): Q1 = `.html` with JS inside; Q2/Q3 = `.php` with HTML inside.
   Exception: **253 Q1 is a PHP question in the paper** → `.php`.
2. **DB creation is NOT part of the PHP answer.** No paper says "create the DB/table using PHP".
   The creation is plain SQL. So each Q3 file contains:
   - a top **comment block** = full `CREATE DATABASE / USE / CREATE TABLE / INSERT` with the
     paper's exact values (= the exam part the user writes/creates manually via phpMyAdmin), plus
     a "reset" hint;
   - the **runnable code** = mysqli bridge (port 3307) that runs the paper's 4 task items and
     prints results (satisfies "write full PHP–MySQL code" where asked).
3. **Local DBs already exist on :3307** — verified `SHOW DATABASES`: `uiuweb_final`,
   `uiutech_final`, `sundarban`, `campus_library`, `tourism`, `uiu_bookshop`, seeded with the
   question-exact values in `MySQL/01_schema.sql`. Reset data by re-running that file.
4. **No extra features.** Only what each question asks. Basic inline style at most (plain form
   stack like the existing examples; CSS optional and tiny).
5. Solutions are a *new* coordinated set; existing `JavaScript/`, `PHP/`, `MySQL/` examples stay
   untouched as reference material.

## 2. File Inventory (18 + README)

| File | Paper · Question | Type | Maps to cheat-sheet boxes |
|---|---|---|---|
| `243_q1_guess_number.html` | 243 Q1 – secret number 500–5000, 5 tries | html+js | 1, 2, 3, 6, 7B |
| `243_q2_pizza_party.php` | 243 Q2 – pizzas, leftover slices, wasted BDT | php | 10, 12, 16 |
| `243_q3_student_final.php` | 243 Q3 – uiuweb_final.student_final | php+mysql | 18, 22, 23 |
| `251_q1_password_strength.html` | 251 Q1 – score 0–100+, levels, tries>8 | html+js | 1, 2, 6, 7C |
| `251_q2_venue_booking.php` | 251 Q2 – venues, empty seats, wasted BDT | php | 10, 12, 16 |
| `251_q3_employee_final.php` | 251 Q3 – uiutech_final.employee_final | php+mysql | 18, 22, 23 |
| `252_q1_calorie_tracker.html` | 252 Q1 – running total, goal 2000, entries>10 | html+js | 1, 2, 6 |
| `252_q2_movie_screens.php` | 252 Q2 – screens, empty seats, wasted BDT | php | 10, 12, 16 |
| `252_q3_sales_data.php` | 252 Q3 – sundarban.sales_data | php+mysql | 18, 19, 22, 23 |
| `253_q1_ct_marks.php` | 253 Q1 – best 2 of 3 CTs + mid + final | php | 10, 13A, 16 |
| `253_q2_sales_event.php` | 253 Q2 – classify + target delta | php | 10, 13B |
| `253_q3_book_loans.php` | 253 Q3 – campus_library.book_loans | php+mysql | 18, 22, 23 |
| `261a_q1_study_tracker.html` | 261A Q1 – subjects + hours, avg, goal 20 | html+js | 1, 2, 6, 8 |
| `261a_q2_academic_credits.php` | 261A Q2 – classify 120/90/60 + target delta | php | 10, 13B |
| `261a_q3_tourist_spot.php` | 261A Q3 – tourism.tourist_spot | php+mysql | 18, 20, 22, 23 |
| `261b_q1_vitals_monitor.html` | 261B Q1 – HR/SpO2 averages + risk score | html+js | 1, 2, 3, 6, 7D |
| `261b_q2_rover_battery.php` | 261B Q2 – modules, unused energy, efficiency | php | 10, 12, 16 |
| `261b_q3_book_info.php` | 261B Q3 – uiu_bookshop.book_info | php+mysql | 18, 19, 22, 23 |
| `README.md` | — | small guide: how to run + paper→file→box map | — |

## 3. Templates — the "same pattern" contract

### Template A — JS solutions (5 files)

Fixed names in **every** file (taken from cheat sheet Box 6, so the muscle memory transfers):

```html
<input type="text" id="fVal" placeholder="...">            <!-- or type/ids the question needs -->
<button id="btn" onclick="processApp()">Submit</button>    <!-- SAME function name everywhere -->
<p id="msgOut"></p>                                        <!-- SAME output id everywhere -->
<script>
  // STAGE 0: State Variables OUTSIDE Function!
  let runningTotal = 0, sessionCount = 0;
  let itemHistory = [];                 // question-specific extras: secret, attempts, arrays...

  function processApp() {
    // STAGE 1: Extract & Parse          (.value -> parseInt/parseFloat)     [Box 2]
    // STAGE 2: Mutate State             (runningTotal +=, sessionCount++)    [Box 6]
    // STAGE 3: Compute                  (average = total / sessions)        [Box 6]
    // STAGE 4: Evaluation Ladder        (highest range first!)              [Box 6 + 7]
    //          + attempt-guard ("> N tries without goal" questions)         [Box 6]
    // STAGE 5: Render DOM               (msgOut.innerHTML = `...`)          [Box 2/6]
    // STAGE 6: Termination Lock         (only where asked: 243 disable)     [Box 2]
  }
</script>
```

Per-file logic (exact ladders from the papers):

| File | Inputs (ids) | State | Ladder / formula | Guard / lock |
|---|---|---|---|---|
| 243 | `fVal` (text) | `secret` (Box 3: `Math.floor(Math.random()*4501)+500`), `attempts` | correct → "Correct!"; else Too high/Low; on 5th wrong append "Out of guesses!" | disable input+btn on correct/5 tries (asked: "optionally disable") |
| 251 | `fVal` (password) | `attempts`, `reachedStrong` | Box 7C scoring (len≥6: `floor((len-6)/2)*10`, +15/+15/+20/+25); levels 91/71/51/31; ≥100 → "Perfect Password!" | attempts>8 && !Strong → "Need practice!" + tips text |
| 252 | `fVal` (number) | `runningTotal`, `sessionCount` | ladder ≥2000 / ≥1601 / ≥801 / else (exact messages from paper) | entries>10 && total<2000 → "Be cautious of frequent snacking!" |
| 261a | `fName` (subject), `fVal` (hours) | total, sessions, `itemHistory` | avg = total/sessions; ladder 20+/13+/6+/else | sessions>7 && total<20 → "Increase your study time!" |
| 261b | `fVal` (HR), `fVal2` (SpO2) | two arrays | avg HR, avg SpO2, `risk = (100-spo2)*2 + Math.abs(hr-80)*0.5`; round with `Math.round(x*100)/100`; ternary SAFE (≤10) / WARNING (≤20) / DANGER | — |

### Template B — PHP form solutions (7 files)

Fixed pattern in every file (cheat sheet Box 10 + 16):

```php
<form method="post">
  Field: <input type="number" name="field1" required><br><br>
  <input type="submit" name="btnSubmit" value="Calculate">   <!-- SAME name everywhere -->
</form>
<hr>
<?php
if (isset($_POST["btnSubmit"])) {
  // read with floatval()/intval(), compute, echo "<h3>Result</h3>" + labeled lines
}
?>
```

Two sub-shapes, chosen by the question's wording:

- **B1 — "Write a PHP function … whole items only"** (243, 251, 252, 261b Q2):
  exactly the Box 16 helper + Box 12 formula:

  ```php
  function calcAlloc($demand, $rate, $cap, $cost = 0) {
    $needed   = $demand * $rate;              // Box 12 line 1
    $units    = ceil($needed / $cap);         // Box 12 line 2  (round UP)
    $supplied = $units * $cap;                // Box 12 line 3
    $left     = $supplied - $needed;          // Box 12 line 4
    return ["needed" => $needed, "units" => $units, "left" => $left,
            "wasted" => $left * $cost];
  }
  ```

  - 243: `calcAlloc($students, $slicesPerStudent, $slicesPerPizza, 1050/$slicesPerPizza)`
  - 251: `calcAlloc($attendees, 1, $venueCapacity, $costPerPerson)` (distractor 15,000 never used)
  - 252: `calcAlloc($attendees, 1, $seatCapacity, $ticketPrice)` (distractor 25,000 never used)
  - 261b: `calcAlloc($distance, $energyPerMeter, $batteryCapacity, 0)` + Box 12 ratio status
    (`$ratio = $left / $supplied` → ≤10% Efficient, ≤25% Acceptable, else Wasteful)

- **B2 — "Write a PHP program"** (253 Q1, 253 Q2, 261a Q2): inline code, no function.
  - 253 Q1 (Box 13A + 16): `$best2 = $ct1+$ct2+$ct3 - min($ct1,$ct2,$ct3); $ctAvg = $best2/2;`
    `$total = $ctAvg+$midterm+$final;` `$status = ($total > 54) ? "Passed" : "Failed";`
  - 253 Q2 / 261a Q2 (Box 13B): `$total = $rate * $count;` ladder Excellent/Good/Average/Poor
    (500/300/150 — 261a: 120/90/60) + 3-branch target delta ("Target met exactly (0 difference)" /
    "Above target by X" / "Below target by X").

### Template C — PHP + MySQL solutions (6 files, Q3)

`.php` file = minimal HTML wrapper + bridge in the Box 22 shape:

```php
<!DOCTYPE html><html><head><meta charset="UTF-8"><title>FINAL 243 Q3</title></head>
<body>
<h2>FINAL 243 Q3 — uiuweb_final.student_final</h2>
<?php
// PART 1 — EXAM: create database + table (paste into phpMyAdmin / write in exam, plain SQL):
//   CREATE DATABASE uiuweb_final;  USE uiuweb_final;
//   CREATE TABLE student_final ( ... );   INSERT INTO student_final VALUES ( ... );
// Reset local data: re-run Final/MySQL/01_schema.sql

$servername = "localhost"; $username = "root"; $password = ""; $dbname = "...";
$port = 3307;   // XAMPP port — in the exam: drop the 5th argument
$conn = new mysqli($servername, $username, $password, $dbname, $port);
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }

// Task 1 — SELECT + loop                                        [Box 22 + 23]
$sql1 = "...";  $result1 = $conn->query($sql1);
if ($result1 && $result1->num_rows > 0) {
  while ($row = $result1->fetch_assoc()) { echo $row["..."] . "...<br>"; }
} else { echo "0 results<br>"; }

// Task 2 / Task 3 — guarded UPDATEs                              [Box 22]
$sql2 = "UPDATE ...";  if ($conn->query($sql2) === TRUE) { echo "Updated (" . $conn->affected_rows . " rows)<br>"; }
...
$conn->close();
?>
</body></html>
```

- Tasks run in the paper's 1→2→3→4 order (order matters: 252 task 4 reads task-3-updated values).
- Output: an `<h3>Task n — …</h3>` line before each block's results; keep labels from the paper.
- Per-paper SQL = the already-written, verified queries in `MySQL/03..08_queries_*.sql`
  (same text, wrapped as `$sql1…$sql4` in PHP).

## 4. Tasks

### Task 1 — Write the 5 JS files (Template A)
- [ ] Create all 5 `.html` files with the fixed ids/names above and header comments naming the paper + cheat-sheet boxes.
- [ ] Verify each against the paper's sample rows with a scripted headless-Chrome run (temp copy per file, injected test script sets inputs + auto-clicks + writes readings into the page; original file never modified). Cases:
  - 243 — force `secret = 37` in the test copy: `50,25,35,38,37` → "Too high!, Too low!, Too low!, Too high!, Correct!"; fresh copy `10,50,90,80,85` → 5th says "…Out of guesses!" and input disabled.
  - 251 — `abc` → Very Weak (15); `hello123` → Weak (45); `Strong@Pass` → Strong (75); `Perfect@Pass123` → "Perfect Password!" (115).
  - 252 — `300,500,700` → total 1500, "Good progress, keep it balanced!"; fresh `1000,800,300` → "Goal reached! Stay mindful!"; 12 entries totalling <2000 → "Be cautious of frequent snacking!".
  - 261a — `English-2, English-3, Bangla-4, Physics-5` → total 14, avg 3.5, subjects list, "Almost ready!"; 8 sessions totalling 15 h → "Increase your study time!".
  - 261b — `80/97` → avg 80/97, risk 6 → SAFE; then `78/95` → 79/96, risk 11 → WARNING; then `130/80` → 96/90.67, risk 65 → DANGER.

### Task 2 — Write the 7 PHP form files (Template B)
- [ ] Create all 7 files (B1 for 243/251/252/261b Q2; B2 for 253 Q1, 253 Q2, 261a Q2), header comments with paper ref + cheat-sheet boxes + sample line.
- [ ] Lint each: `& "G:\xampp\php\php.exe" -l <file>` → "No syntax errors".
- [ ] Verify by CLI include with sample `$_POST` (script loops the sample rows, greps expected values):
  - pizza `10/3/8` → 4, 2, 262.5 · `7/2/6` → 3, 4, 700 · `12/2/4` → 6, 0, 0
  - venue `250/120/80` → 4, 70, 8400 · `180/150/100` → 2, 20, 3000 · `300/100/75` → 4, 0, 0
  - screens `150/60/500` → 3, 30, 15000 · `280/100/400` → 3, 20, 8000 · `320/120/350` → 3, 40, 14000
  - rover `1200/8/5000` → 9600, 2, 400, Efficient · `1500/9/4000` → 13500, 4, 2500, Acceptable · `1000/6/5000` → 6000, 2, 4000, Wasteful
  - sales event `25/12/300` → 300, Good, "Target met exactly (0 difference)" · `40/10/350` → 400, Excellent, "Above target by 50 items" · `15/10/200` → 150, Average, "Below target by 50 items" · `8/10/120` → 80, Poor, "Below target by 40 items"
  - academic `4/30/120` → 120, Excellent, exactly 0 · `3/35/100` → 105, Good, above 5 · `3/25/90` → 75, Average, below 15 · `4/10/60` → 40, Poor, below 20
  - CT marks (paper's table is an image; use its rule): `20/15/10` + mid 15 + final 25 → best2 35, avg 17.5, total 57.5 → Passed; and a failing case e.g. `10/10/10` + 10 + 20 → total 40 → Failed.

### Task 3 — Write the 6 Q3 files (Template C)
- [ ] Create all 6 files (PART 1 DDL comment block + bridge + task outputs).
- [ ] Lint each with `php -l`.
- [ ] Verify runnable end-to-end with MySQL on 3307; before each file re-run `01_schema.sql` (UPDATEs mutate data), then `php.exe` the file and check:
  - 243: grades A2 B2 C1 D1 · Jasica untouched (already D) · only Karim 85→90 · courses Web Programming 3, Project Management 2, SAD 1 (desc).
  - 251: ratings B2 A1 C1 · Sabbir stays C · only Marium 52000→57000 · Software Dev 2, QA 1, UI/UX 1.
  - 252: Electronics 395,000 · Furniture 136,000 · Accessories 50,000 · Bottle+Pen → "Low Performing" · Laptop→385,000, Desk→79,200 · Top Seller: Laptop, Desk, Bottle vs Regular: Mouse, Chair, Pen.
  - 253: status counts Returned 2, Overdue 3 (HAVING>1) · Barkat+Rahim → Grace Period, fee 0 · Jabbar 24→26.4, Karim 30→33 · per-book totals: Data Structures 33, Operating Systems 26.4, others 0 (desc).
  - 261a: task 1 (before updates) → Cox's Bazar 4.9, Ratargul 4.8, Shat Gambuj 4.7, Kuakata 4.5 (desc) · task 2 updates BOTH qualifying spots — Sundarbans 4.3→4.5 & 150→165, Paharpur 4.1→4.3 & 30→33 (2 rows) · task 3 (after task 2, ratings shifted): averages Beach 4.7, Nature 4.65, Heritage 4.5 — all > 4.4; visitors 240000 / 140000 / 110000, desc · task 4 (after task 2): KHL 13,200,000 · SYL 6,000,000 · BGH 2,100,000 · NWG 1,320,000 (CTG/PTU = 0, free entry), desc.
  - 261b: Programming desc → 600/550/450 · Price>400 & Programming → Database Guide, Python Mastery, Web Basics · counts Programming 3, Language 2, Business 1 · net worth 23,650 · Language ×0.9 → 270, 315.
  - Across all 6: values above are cross-checked against the header comments of `MySQL/03..08_queries_*.sql` during execution (established baseline). Note: `affected_rows` counts *changed* rows — an UPDATE that re-sets an identical value correctly reports 0 (243 task 2 → 0: Jasica already D; 251 task 2 → 0: Sabbir already C).

### Task 4 — Write `Final-Solutions/README.md`
- [ ] Short guide: one line per paper (Q1/Q2/Q3 file links), how to run (browser for `.html`; `php -S` or XAMPP for `.php`; MySQL 3307 + reset command), and the pattern→cheat-sheet-box map. Keep it short — navigation only.

### Task 5 — Update hub `Final/index.php`
- [ ] Add one entry at the top of the `$sections` array (before JavaScript):

  ```php
  'Final-Solutions' => ['title' => 'Final Solutions', 'desc' => 'All 6 papers solved — exam-pattern answers (HTML/JS + PHP + MySQL)', 'color' => '#16a34a', 'text' => '#15803d'],
  ```

  The existing `scan_dir` + `file_link` already handle `.html`/`.php` (open in new tab) and put README first — no other code change.
- [ ] Verify: `php.exe -l index.php` then `php.exe index.php` (CLI) and check the output contains all 19 links (`243_q1…` … `261b_q3…`, README).

### Task 6 — Pattern audit (the coordination proof)
- [ ] Grep checks across `Final-Solutions/`:
  - `processApp\(\)` → 5 files · `STAGE 1` → 5 files · `id="msgOut"` → 5 files
  - `name="btnSubmit"` + `isset(\$_POST\["btnSubmit"\])` → 7 form files (Q2s + 253 Q1); the 6 Q3 files are plain scripts, no form
  - `function calcAlloc\(` → 4 files · `\$sql1` + `while \(\$row = \$result1->fetch_assoc\(\)\)` → 6 files · `\$conn->close\(\)` → 6 files
- [ ] `git status` — confirm only `Final-Solutions/*`, `Final/index.php`, and this plan file are added/changed.

## 5. Review Focus (risks to keep an eye on)

1. **Random secret (243)** — not deterministically testable; test copy overrides `secret` before
   clicking. Never touch the real file for testing.
2. **UPDATE tasks mutate the shared DB** — always reset with `01_schema.sql` before each Q3 run;
   affected-rows output is expected (`1 row` for 243 update, `2 rows` for 251, etc. — compare).
3. **Task-order dependence (252)** — task 4's "Top Seller vs Regular" runs on task-3-updated
   revenue. Keep the paper's order and verify against the query file comments.
4. **253 Q2 written-vs-sample contradiction** — README trap #12: the paper's table shows 400 as
   "Excellent" but the rule says ≥500 is Excellent. Follow the WRITTEN rule (as the existing
   example does); keep the existing note comment.
5. **Boundary operators** — `> 54` (253 Q1) is strict; ladders use `>=` and are checked
   highest-first; BETWEEN is inclusive. Sample tables are the final judge.
6. **Ports** — code files use 3307 locally with a comment "exam: drop the 5th argument". Do not
   remove the port (files must run on this machine), keep the comment so exam recall stays right.

## 6. Done criteria

- 18 solution files + README exist in `Final/Final-Solutions/`, all lint-clean / interaction-tested.
- Every paper sample row listed in Task 1–3 checks out (or the discrepancy is documented).
- Hub shows the new "Final Solutions" card with 19 working links.
- No changes to existing example files or the cheat sheet.
