# CSE 4165 / CSE 465 Web Programming — Final Revision Pack

Everything for tomorrow's Final in one folder. Open `index.php` through XAMPP
Apache (or `php -S localhost:8000`) — it is the hub that links every file in
exam-first order.

> **Exam shape:** 3 questions × 10 marks, 2 hours.
> Q1 = JavaScript app · Q2 = PHP processing · Q3 = PHP + MySQL integration.
> Every paper recycles the same 3 templates with different numbers/names.

---

## Tonight's order (final is tomorrow)

1. **Final Exam Papers** — the question PDFs are pinned at the top of the hub.
   Do **261A + 261B** first (Spring 2026 = closest to tomorrow), then 253,
   then a fast pass over 243 / 251 / 252.
2. **Final Solutions** — check your blind attempts against these. Start every
   answer from a `quickstart*` file: `quickstart.html` (Q1),
   `quickstart-q2.php` (Q2), `quickstart-q3.php` (Q3 with 4 task slots).
3. **Exam Toolkit** — `Final_Exam_Analysis.md` (the strategy + trap list) and
   `cheatsheet.html` / `Final_CheatSheet.pdf` (2-page print version).
4. **Drill folders** — `JavaScript`, `PHP`, `MySQL` (READMEs at the top of each).
5. **Practice** — your raw timed attempts; compare line by line, don't rewrite.
6. **Mock quiz** — LAST resort only; the real final recycles paper questions.

---

## Folder map

| Path | What it is |
|---|---|
| `Final-Questions/` | 6 real final papers (243, 251, 252, 253, 261 A+B) as PDF docs |
| `Final-Solutions/` | Every paper solved in the exact cheat-sheet code pattern, + quickstart exam starters |
| `JavaScript/` | Q1 drills; **finals `02→06` first**, method toolkit `07`, mock warm-up `08` last |
| `PHP/` | Q2 drills; **finals `02→08` first**, mock class exercise `09` last |
| `MySQL/` | Q3 drills; **final query files `03→08` first**, bridge extras `11–13`, mock quiz `09–10` last |
| `Practice/` | Untouched timed attempts (261-A, 253) against the clock |
| `index.php` | The hub UI — links everything, final-first |
| `Final_Exam_Analysis.md` | Generalized paper analysis, SQL pattern table, strategy |
| `cheatsheet.html` / `Final_CheatSheet.pdf` | The 2-page A4 cheat sheet (source / print copy) |
| `Mock-Quiz-1-ANSWER-KEY.md` | Mock quiz grading rubric — don't open until a mock is finished |
| `Sample Quiz Question.pdf` | The quiz the mock was modelled on |

**Numbering convention (as of Oct 2026):** every drill folder leads with the
real final papers; anything derived from the *sample/mock quiz* (the old
`01_random_number.html`, `01_employee_class.php`, `02_queries_sample_quiz.sql`,
`09_php_mysql_bridge.php`) was renamed to the end of its folder.

---

## How to run things

**Hub (recommended):** start PHP's built-in server and open the hub:

```powershell
cd D:\WEB\Web-Practice\Final
& "G:\xampp\php\php.exe" -S localhost:8000
&start http://localhost:8000/index.php
```

**Past papers (PDF)** — open from the hub, no setup needed.

**Q1 `.html` drills** — double-click, works offline in any browser.

**Q2 `.php` drills** — run through the same server (`http://localhost:8000/PHP/02_pizza_party_243.php`),
copy into `htdocs`, or boot a server inside a folder. Fill the form → result prints under it.

**Q3 PHP+MySQL** — needs XAMPP MySQL (local port **3307**). Load/reset all 11
question datasets with:

```powershell
Get-Content MySQL\01_schema.sql | & "G:\xampp\mysql\bin\mysql.exe" -u root -P 3307
```

Re-run after every UPDATE drill (they change the rows permanently). In the real
exam room MySQL is on the default port — drop the 5th `mysqli` argument there.

**Pure SQL drills:** `Get-Content MySQL\06_queries_253.sql | & "G:\xampp\mysql\bin\mysql.exe" -u root -P 3307`
(each file prints its expected output in the comments).

---

## What repeats on every paper (30-second summary)

1. **Q1 JS:** inputs + button → read `.value` → parse → mutant state OUTSIDE the
   function (total / count / array) → if–else-if ladder **highest first** →
   `innerHTML` → disable on limit. Accent grids: 261 (array + average + join;
   vitals + `Math.abs` risk formula).
2. **Q2 PHP:** ① `ceil()` quantizer + leftover × per-unit cost (flat facility
   costs are distractors!), ② classify ladder + target delta, ③ best-2-of-3 =
   `sum − min()`. On paper contradictions, follow the WRITTEN rule.
3. **Q3 SQL:** GROUP BY count (+`HAVING`), guarded UPDATE, arithmetic bonus with
   `AND old-op ≤ limit` inside WHERE, GROUP BY + `ORDER BY Total DESC` — all
   wrapped in the mysqli bridge (connect → query → `fetch_assoc` loop → close).

Details, traps and full code shapes: `Final_Exam_Analysis.md` + folder READMEs.
