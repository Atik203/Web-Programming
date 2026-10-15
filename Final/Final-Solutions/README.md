# Final Solutions — all 6 papers, exam-pattern answers

Every answer file is written in the **same code pattern as `../cheatsheet.html`**
(state outside the function, STAGE comments, fixed ids/names, `calcAlloc`,
`$sql1` → `fetch_assoc()` loop → `$conn->close()`), so practising these files
drills the cheat sheet for the real 2-hour exam.

## Files

| Paper | Q1 (HTML + JS) | Q2 (PHP) | Q3 (PHP + MySQL) |
|---|---|---|---|
| **243** (Fall 2024) | [Guess the Number](243_q1_guess_number.html) | [Pizza Party](243_q2_pizza_party.php) | [student_final](243_q3_student_final.php) |
| **251** | [Password Strength](251_q1_password_strength.html) | [Venue Booking](251_q2_venue_booking.php) | [employee_final](251_q3_employee_final.php) |
| **252** (Summer 2025) | [Calorie Tracker](252_q1_calorie_tracker.html) | [Movie Screens](252_q2_movie_screens.php) | [sales_data](252_q3_sales_data.php) |
| **253** (Fall 2025) | [CT Marks](253_q1_ct_marks.php) | [Sales Event](253_q2_sales_event.php) | [book_loans](253_q3_book_loans.php) |
| **261 Set A** (Spring 2026) | [Study Tracker](261a_q1_study_tracker.html) | [Academic Credits](261a_q2_academic_credits.php) | [tourist_spot](261a_q3_tourist_spot.php) |
| **261 Set B** | [Vitals Monitor](261b_q1_vitals_monitor.html) | [Rover Battery](261b_q2_rover_battery.php) | [book_info](261b_q3_book_info.php) |

(253 Q1 is a PHP question in the paper — that is why it ends in `.php`.)

## How to run

**`.html` files** — double-click to open in the browser. (243 Q1's secret number
is random by design — that is the question.)

**`.php` files** — either:
- CLI: `& "G:\xampp\php\php.exe" 243_q2_pizza_party.php` — prints the form page
  (open it in a browser, or use the server below, to fill it in and see the result),
- or copy the folder into `htdocs` and open it through Apache,
- or run a local server: `& "G:\xampp\php\php.exe" -S localhost:8000` inside this
  folder and open `http://localhost:8000/243_q2_pizza_party.php`.

Fill the form and submit — the result prints under the form.

**Q3 files need MySQL running.** Locally that is XAMPP MySQL on **port 3307**
(the 5th argument of `new mysqli(...)`, with a comment in each file). After the
UPDATE tasks change data, reset everything before trying again:

    Get-Content ..\MySQL\01_schema.sql | & "G:\xampp\mysql\bin\mysql.exe" -u root -P 3307

(or just import `MySQL/01_schema.sql` again in phpMyAdmin.)

## Exam notes

1. **DB/table creation is plain SQL** written first (or clicked together in
   phpMyAdmin) — it is NOT PHP. Every Q3 file carries the full
   `CREATE DATABASE / CREATE TABLE / INSERT` as a comment block at the top,
   ready to copy. Only the tasks under it ("write full PHP–MySQL code") are PHP.
2. On the exam PC, MySQL runs on the **default port** — drop the 5th `mysqli`
   argument there. The `3307` here is only because local XAMPP uses 3307.
3. UPDATE tasks are not all idempotent (252 Q3-3, 253 Q3-3, 261A Q3-2, 261B Q3-5)
   — re-run the reset command above before another attempt.
4. Known paper quirks are documented in the file headers (e.g. 253 Q2's sample
   table contradicts its written rule — the code follows the **written rule**).

## Which cheat-sheet box each file uses

Every file's header comment names its exact boxes; the summary:

| Pattern | Boxes | Used by |
|---|---|---|
| JS form + state outside + STAGE pipeline | 1, 2, 6 | all Q1 `.html` |
| Random number formula | 3 | 243 Q1 |
| Difficulty engines: guess / password rules / risk | 7B, 7C, 7D | 243, 251, 261B Q1 |
| Array push + history | 8 | 261A Q1 |
| PHP form skeleton (`btnSubmit`) | 10 | the 7 form `.php` files (Q2s + 253 Q1) |
| Whole items only (ceil) + wasted money | 12, 16 | 243/251/252/261B Q2 |
| Best 2 of 3 CTs | 13A | 253 Q1 |
| Classifier ladder + target difference | 13B | 253 Q2, 261A Q2 |
| SQL: GROUP BY / guarded UPDATE / CASE / HAVING | 17–21 | all Q3 |
| mysqli bridge (connect → query → loop → close) | 22 | all Q3 |

Big-picture mapping and trap list: `../Final_Exam_Analysis.md`.
