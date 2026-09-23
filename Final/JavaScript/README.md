# JavaScript — CSE 4165 Web Programming — Final Revision

> **Where it appears:** Q1 of every paper (3 marks in the quiz, 10 in the final).
> Every question has the SAME shape: **input field(s) + button + label → one function reads the input, computes something, writes feedback back to the page.**
> Learn the skeleton once — every paper is just different scoring inside it.

---

## 📖 Index

1. [Know This Cold — the universal skeleton](#1-know-this-cold--the-universal-skeleton)
2. [Random Numbers](#2-random-numbers)
3. [DOM — reading inputs, writing output](#3-dom--reading-inputs-writing-output)
4. [Conditionals & Feedback Chains](#4-conditionals--feedback-chains)
5. [Loops, Arrays & Counters](#5-loops-arrays--counters)
6. [String Methods & Regex Tests](#6-string-methods--regex-tests)
7. [Example Files — mapped to past papers](#7-example-files--mapped-to-past-papers)
8. [Traps — the marks people lose](#8-traps--the-marks-people-lose)
9. [Write From Memory — Self Test](#9-write-from-memory--self-test)
10. [How to Run the Examples](#10-how-to-run-the-examples)

---

## 1. Know This Cold — the universal skeleton

If you can write this from memory, you can answer every JS question:

```html
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>My App</title>
</head>
<body>
    <input type="text" id="myInput">
    <button onclick="handleClick()">Submit</button>
    <p id="output"></p>

    <script>
        function handleClick() {
            let value  = document.getElementById("myInput").value;
            let number = parseInt(value);
            let output = document.getElementById("output");

            // ... compute here ...

            output.innerHTML = "Feedback: " + number;
        }
    </script>
</body>
</html>
```

**The 4 moving parts** (memorise the names):

| Part | Code |
|---|---|
| Read input | `document.getElementById("id").value` |
| Convert | `parseInt(x)` (whole) / `parseFloat(x)` (decimal) |
| Compute | `if / else if / else`, counters, arrays, loops |
| Write output | `document.getElementById("id").innerHTML = "..."` |

---

## 2. Random Numbers

`Math.random()` returns a decimal `0 <= x < 1` (never exactly 1).

**Formula for a random INTEGER from `min` to `max` (both inclusive):**

```js
let num = Math.floor(Math.random() * (max - min + 1)) + min;
```

| Question asks | Code |
|---|---|
| 200 to 400 (Sample Quiz) | `Math.floor(Math.random() * 201) + 200` |
| 500 to 5000 (Final 243) | `Math.floor(Math.random() * 4501) + 500` |
| 1 to 6 (dice) | `Math.floor(Math.random() * 6) + 1` |
| 1 to 100 | `Math.floor(Math.random() * 100) + 1` |

**Why `(max - min + 1)`:** 200..400 contains 201 numbers, not 200. Forgetting the `+1` means 400 can never be generated (classic mark-loser).

**Where to put it:** if the number is a "secret" for the whole game, put it OUTSIDE the function so it is generated once:

```js
let secret = Math.floor(Math.random() * 4501) + 500;   // once, outside

function checkGuess() {
    // compare against secret ...
}
```

---

## 3. DOM — reading inputs, writing output

```js
// READ an input field — .value is ALWAYS a string
let text   = document.getElementById("nameInput").value;
let number = parseInt(text);        // "42" -> 42
let decimal = parseFloat(text);     // "3.5" -> 3.5

// WRITE to a label / <p> / <div>
document.getElementById("output").innerHTML = "Score: " + score;

// EMPTY an input after using it
document.getElementById("nameInput").value = "";

// DISABLE an input (game over / correct answer)
document.getElementById("guessInput").disabled = true;
```

**Input types you may be asked to create:**

```html
<input type="text"     id="a">        <!-- text -->
<input type="number"   id="b">        <!-- number -->
<input type="password" id="c">        <!-- password -->
<button onclick="myFunction()">Click</button>
<p id="output"></p>                   <!-- the "label field" -->
```

`<button>` vs `<input type="submit">`: inside a `<form>`, a submit button reloads the page — for JS questions always use `<button onclick="...">` **outside** any form, or `type="button"`.

---

## 4. Conditionals & Feedback Chains

**Always check from the HIGHEST range to the lowest** — once a condition is true, the rest are skipped:

```js
if (score >= 91) {
    level = "Very Strong";
} else if (score >= 71) {
    level = "Strong";
} else if (score >= 51) {
    level = "Medium";
} else if (score >= 31) {
    level = "Weak";
} else {
    level = "Very Weak";
}
```

**Comparison operators:**

| Operator | Meaning | Watch out |
|---|---|---|
| `===` | equal (use this) | `==` also works but `===` is safer |
| `!==` | not equal | |
| `>` `>=` `<` `<=` | comparisons | boundaries matter: "91+" means `>= 91` |
| `&&` / `\|\|` | and / or | |

**Ternary (one-liner, good for simple pass/fail):**

```js
let status = (total > 54) ? "Passed" : "Failed";
```

**Typical feedback chain from the papers:**

```js
if (totalCalories >= 2000)      feedback = "Goal reached! Stay mindful!";
else if (totalCalories >= 1601) feedback = "Almost at your limit!";
else if (totalCalories >= 801)  feedback = "Good progress, keep it balanced!";
else                            feedback = "You're off to a healthy start!";
```

---

## 5. Loops, Arrays & Counters

**Counters** (attempts, entries, sessions):

```js
let attempts = 0;
attempts++;                    // add 1
```

**Arrays** (storing every value the user entered):

```js
let subjects = [];             // create
subjects.push("Math");         // add item at the end
subjects.length                // how many items
subjects.join(", ")            // "Math, Physics" — for display
```

**Loop to total / average an array:**

```js
let sum = 0;
for (let i = 0; i < numbers.length; i++) {
    sum += numbers[i];
}
let average = sum / numbers.length;
```

**Useful Math functions:**

| Function | Use | Example |
|---|---|---|
| `Math.abs(x)` | absolute value `\|HR - 80\|` | `Math.abs(78 - 80)` → 2 |
| `Math.round(x)` | round to nearest integer | |
| `Math.floor(x)` | round down | random numbers |
| `Math.round(x * 100) / 100` | round to 2 decimals | 90.666… → 90.67 |
| `Math.min(a, b, c)` | smallest of three | best-two-of-three CT logic |

---

## 6. String Methods & Regex Tests

| Method | What it does | Example |
|---|---|---|
| `.length` | number of characters | `"hello123".length` → 8 |
| `.toUpperCase()` | to capitals | |
| `.toLowerCase()` | to small letters | |
| `.includes("x")` | contains text? | `"Perfect@Pass123".includes("@")` |
| `/[A-Z]/.test(s)` | has an uppercase letter? | regex test |
| `/[a-z]/.test(s)` | has a lowercase letter? | |
| `/[0-9]/.test(s)` | has a digit? | |
| `/[!@#$%^&*]/.test(s)` | has a special character? | |

These four regex tests are exactly the password-strength criteria (Final 251).

---

## 7. Example Files — mapped to past papers

| File | Paper | Key technique |
|---|---|---|
| `01_random_number.html` | **Sample Quiz Q1** | `Math.floor(Math.random() * 201) + 200`, `console.log` |
| `02_guess_game_243.html` | Final 243 Q1 | secret number, attempts counter, disable input after 5 |
| `03_password_strength_251.html` | Final 251 Q1 | scoring, regex tests, attempts > 8 warning |
| `04_calorie_tracker_252.html` | Final 252 Q1 | running total, entries counter |
| `05_study_tracker_261.html` | Final 261 Set-A Q1 | arrays, average, `join()` |
| `06_vitals_monitor_261b.html` | Final 261 Set-B Q1 | arrays, averages, `Math.abs`, risk formula |

Open any file in a browser, press **F12 → Console** to see `console.log` output.

---

## 8. Traps — the marks people lose

1. **Off-by-one random:** `Math.random() * (max - min)` is wrong — you need `(max - min + 1)`, otherwise `max` is never produced.
2. **`.value` is a string:** `"5" + 1` gives `"51"`. Always `parseInt()` / `parseFloat()` before maths.
3. **`=` vs `==` vs `===`:** `=` assigns, `===` compares. `if (x = 5)` is a bug.
4. **`innerHTML` vs `.value`:** inputs use `.value`; `<p>`/`<div>`/labels use `.innerHTML`.
5. **id mismatch:** the `id` in HTML and the string in `getElementById("...")` must match exactly (case-sensitive).
6. **Function must exist when clicked:** define the `<script>` function before the button can call it — putting `<script>` at the end of `<body>` is safest.
7. **Capital letters matter:** `Math.floor` (capital M), `console.log` (lowercase), `getElementById` (capital B, capital I, capital D).
8. **Condition order:** check `>= 91` before `>= 71`, otherwise everything above 71 says "Strong".
9. **`disabled` not `disable`:** `input.disabled = true;`
10. **Password length scoring (Final 251):** the sample outputs only match if length points count characters **beyond the 6-char minimum** — `Math.floor((len - 6) / 2) * 10`.

---

## 9. Write From Memory — Self Test

Close this file and write on paper. Tick when done without looking:

- [ ] The random-integer formula from memory: `Math.floor(Math.random() * (max - min + 1)) + min`
- [ ] Random 200–400 in one line, printed with `console.log`
- [ ] The 4 DOM lines: read `.value`, `parseInt`, write `.innerHTML`, disable `.disabled = true`
- [ ] A 5-level `if / else if` chain with the ranges from the password question
- [ ] Counter + array + average loop (`push`, `length`, `for`, `sum`)
- [ ] Regex tests for uppercase / lowercase / digit / special
- [ ] `Math.abs(x - 80)` for absolute difference
- [ ] Round to 2 decimals: `Math.round(x * 100) / 100`
- [ ] The guess-game: 5 attempts, "Too high!/Too low!/Correct!/Out of guesses!"

---

## 10. How to Run the Examples

**Option A — browser (simplest):** double-click any `.html` file → it opens in your browser. Press `F12` → **Console** tab to see `console.log` results.

**Option B — Node (just the script):** copy the code inside `<script>...</script>` into a `.js` file and run `node file.js` (Node 24 is installed).

**Quick test checklist per file:**
- `01` — click Generate several times, check the console shows 200–400.
- `02` — try the sample sequence: guess 5000 (Too high), 500 (Too low) … 5 wrong guesses → "Out of guesses!".
- `03` — try `abc` (Very Weak), `hello123` (Weak), `Strong@Pass` (Strong), `Perfect@Pass123` (Perfect Password!).
- `04` — 300 → 500 → 700 gives "Good progress, keep it balanced!".
- `05` — 4 sessions totalling 14 h shows average 3.5 and "Almost ready!".
- `06` — 80/97 → SAFE, 78/95 → WARNING, 130/80 → DANGER.
