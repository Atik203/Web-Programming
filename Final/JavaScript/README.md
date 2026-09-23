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
6. [Array Methods — the full toolkit](#6-array-methods--the-full-toolkit)
7. [The Three Dots — Spread & Rest](#7-the-three-dots--spread--rest)
8. [String Methods — the full toolkit](#8-string-methods--the-full-toolkit)
9. [Math, Number & Parsing Functions](#9-math-number--parsing-functions)
10. [Example Files — mapped to past papers](#10-example-files--mapped-to-past-papers)
11. [Traps — the marks people lose](#11-traps--the-marks-people-lose)
12. [Write From Memory — Self Test](#12-write-from-memory--self-test)
13. [How to Run the Examples](#13-how-to-run-the-examples)

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

**Useful Math functions:** `Math.abs`, `Math.round`, `Math.floor`, `Math.min` … — full list with examples in [section 9](#9-math-number--parsing-functions).

---

## 6. Array Methods — the full toolkit

Start from this array for every example below:

```js
let arr = ["a", "b", "c", "d", "e"];
```

**Reading & info:**

| Code | Result | Notes |
|---|---|---|
| `arr.length` | 5 | number of items |
| `arr[0]` | `"a"` | first item — indexes start at 0 |
| `arr[arr.length - 1]` | `"e"` | last item |
| `arr.indexOf("c")` | 2 | position, or -1 if not found |
| `arr.includes("c")` | true | is it in the array? |

**Adding / removing (change the original array):**

| Code | Result | Notes |
|---|---|---|
| `arr.push("f")` | 6 | add to the END (returns new length) |
| `arr.pop()` | `"f"` | remove from the END |
| `arr.unshift("z")` | 6 | add to the START |
| `arr.shift()` | `"z"` | remove from the START |

**`splice` — the swiss army knife** (removes / inserts / replaces anywhere, **changes** the original):

```js
let arr = ["a", "b", "c", "d", "e"];

arr.splice(2, 1);            // remove 1 item at index 2        -> ["a","b","d","e"]
arr.splice(1, 0, "X");       // insert "X" at index 1 (delete 0) -> ["a","X","b","d","e"]
arr.splice(2, 2, "Y");       // replace 2 items at index 2 with "Y" -> ["a","X","Y","e"]
```

Syntax: `arr.splice(start, deleteCount, item1, item2, ...)`

**`slice` — copy a piece** (does **NOT** change the original):

```js
let arr = ["a", "b", "c", "d", "e"];

arr.slice(1, 3);     // ["b", "c"]        (from index 1 up to but NOT including 3)
arr.slice(2);        // ["c", "d", "e"]   (from index 2 to the end)
arr.slice(-2);       // ["d", "e"]        (last two)
```

**splice vs slice — the one-line memory hook:** splice **s**poils the original, slice makes a **s**afe copy.

**join / reverse / sort / concat:**

```js
["Math", "Physics"].join(", ");          // "Math, Physics"      (array -> string)
["a", "b", "c"].reverse();               // ["c", "b", "a"]      (changes original)
[3, 1, 10, 2].sort();                    // [1, 10, 2, 3]        WRONG for numbers!
[3, 1, 10, 2].sort((a, b) => a - b);     // [1, 2, 3, 10]        numeric sort
["a", "b"].concat(["c"]);                // ["a", "b", "c"]      (combine arrays)
```

`sort()` without a compare function sorts **alphabetically** — `10` comes before `2`. For numbers always pass `(a, b) => a - b`.

**Bonus (not required by the papers, but common knowledge):**

```js
[1, 2, 3].forEach(n => console.log(n));        // loop through
[1, 2, 3].map(n => n * 2);                     // [2, 4, 6]      transform each
[1, 2, 3, 4].filter(n => n % 2 === 0);         // [2, 4]         keep matching
```

**Exam relevance:**
- `push` + `length` + `join` — Final 261 study tracker (subjects array).
- `Math.min` best-two-of-three — Final 253 (that is Math, not array).
- "Remove the 2nd element", "keep only the last 3" — classic quiz one-liners: `arr.splice(1, 1)`, `arr.slice(-3)`.

---

## 7. The Three Dots — Spread & Rest

One syntax `...`, two jobs:

- **Spread** = unpack an array into individual items (when *calling* / building).
- **Rest** = pack items into an array (when *defining* functions / destructuring).

**Spread — copy, merge, expand:**

```js
let arr = [1, 2, 3];

let copy   = [...arr];              // [1, 2, 3]        safe copy, original untouched
let more   = [...arr, 4, 5];        // [1, 2, 3, 4, 5]  add items
let merged = [...arr, ...[7, 8]];   // [1, 2, 3, 7, 8]  combine arrays

Math.max(...arr);                   // 3                spread into function arguments
Math.max(arr);                      // NaN              WRONG — always spread first

let chars = [..."abc"];             // ["a", "b", "c"]  string -> character array
```

**Why copy with `[...arr]`?** Plain assignment does NOT copy — both names point to the same array:

```js
let a = [1, 2, 3];

let b = a;          // b points to the SAME array
b.push(4);          // a is now [1, 2, 3, 4] too!

let c = [...a];     // c is a NEW array
c.push(5);          // a unchanged
```

**Rest — collect everything into one array:**

```js
function sum(...nums) {          // nums is an array of ALL arguments
    let total = 0;
    for (let i = 0; i < nums.length; i++) {
        total += nums[i];
    }
    return total;
}
sum(1, 2, 3, 4);                 // 10

let [first, ...rest] = [10, 20, 30, 40];
// first = 10, rest = [20, 30, 40]
```

**Where it helps in exam code:**
- Highest/lowest reading without a loop: `Math.max(...readings)` / `Math.min(...readings)`.
- Sort a copy so the original order survives: `[...scores].sort((a, b) => a - b)`.
- A helper that accepts any number of values: `function average(...nums)`.

**Three dots vs `slice()`:** both copy — `[...arr]` copies everything, `arr.slice(1, 3)` copies a piece.

---

## 8. String Methods — the full toolkit

| Method | What it does | Example → Result |
|---|---|---|
| `.length` | number of characters | `"hello".length` → 5 |
| `.toUpperCase()` | to capitals | `"Hi".toUpperCase()` → `"HI"` |
| `.toLowerCase()` | to small letters | `"Hi".toLowerCase()` → `"hi"` |
| `.trim()` | remove spaces at both ends | `"  hi  ".trim()` → `"hi"` |
| `.includes("x")` | contains text? | `"hello123".includes("123")` → true |
| `.startsWith("x")` | begins with? | `"IMG_01".startsWith("IMG")` → true |
| `.endsWith("x")` | ends with? | `"report.pdf".endsWith(".pdf")` → true |
| `.indexOf("x")` | position, or -1 | `"hello".indexOf("l")` → 2 |
| `.charAt(i)` / `str[i]` | character at index | `"hello".charAt(1)` → `"e"` |
| `.slice(start, end)` | cut by indexes (negatives allowed) | `"hello".slice(1, 3)` → `"el"`, `"hello".slice(-3)` → `"llo"` |
| `.substring(start, end)` | like slice, but no negatives | `"hello".substring(1, 3)` → `"el"` |
| `.substr(start, length)` | start + how many characters | `"hello".substr(1, 3)` → `"ell"` |
| `.split("x")` | string → array | `"English-2".split("-")` → `["English","2"]` |
| `.replace(a, b)` | replace the FIRST match | `"a-b-c".replace("-", "+")` → `"a+b-c"` |
| `.replaceAll(a, b)` | replace ALL matches | `"a-b-c".replaceAll("-", "+")` → `"a+b+c"` |
| `.repeat(n)` | repeat n times | `"ab".repeat(3)` → `"ababab"` |
| `.concat(x)` | join strings | `"a".concat("b")` → `"ab"` |

**slice vs substring vs substr:**

```js
let s = "JavaScript";

s.slice(0, 4)       // "Java"
s.substring(0, 4)   // "Java"
s.substr(0, 4)      // "Java"

s.slice(-6)         // "Script"
s.substring(-6)     // "JavaScript"   (negative becomes 0)
s.substr(-6)        // "Script"
```

**`split` — the exam favourite** (string → array):

```js
"English-2".split("-")        // ["English", "2"]    -> subject + hours in one input!
"a,b,c".split(",")            // ["a", "b", "c"]
"hello world".split(" ")      // ["hello", "world"]
"abc".split("")               // ["a", "b", "c"]     -> split into characters
```

**Regex tests (password strength — Final 251):**

```js
/[A-Z]/.test(password)        // has an uppercase letter?
/[a-z]/.test(password)        // has a lowercase letter?
/[0-9]/.test(password)        // has a digit?
/[!@#$%^&*]/.test(password)   // has a special character?
```

**Template literals** — cleaner than `+` concatenation:

```js
let msg = `Total: ${total} hours, Average: ${average}`;
```

---

## 9. Math, Number & Parsing Functions

**Math:**

| Function | Example → Result |
|---|---|
| `Math.floor(4.9)` | 4 — round down |
| `Math.ceil(4.1)` | 5 — round up |
| `Math.round(4.5)` | 5 — nearest integer |
| `Math.trunc(4.9)` | 4 — cut the decimals |
| `Math.abs(-7)` | 7 — absolute value |
| `Math.min(5, 2, 9)` | 2 — smallest |
| `Math.max(5, 2, 9)` | 9 — largest |
| `Math.pow(2, 3)` | 8 — power |
| `Math.sqrt(16)` | 4 — square root |
| `Math.random()` | 0 ≤ x < 1 (see [section 2](#2-random-numbers)) |

**Number & parsing:**

| Function | Example → Result | Note |
|---|---|---|
| `parseInt("42.9")` | 42 | string → whole number |
| `parseFloat("3.5")` | 3.5 | string → decimal |
| `Number("42")` | 42 | another conversion |
| `isNaN("abc")` | true | "is Not a Number?" |
| `(3.14159).toFixed(2)` | `"3.14"` | 2 decimals — returns a STRING |
| `Number.isInteger(5.0)` | true | whole number? |

**Rounding to 2 decimals — two ways:**

```js
let x = 90.66666;

Math.round(x * 100) / 100    // 90.67   (still a NUMBER — use in maths)
x.toFixed(2)                 // "90.67" (a STRING — use for display)
```

Exam note: the vitals monitor (Final 261B) used `Math.round(x * 100) / 100` so `79` stays `79` — `toFixed(2)` would wrongly show `"79.00"`.

---

## 10. Example Files — mapped to past papers

| File | Paper | Key technique |
|---|---|---|
| `01_random_number.html` | **Sample Quiz Q1** | `Math.floor(Math.random() * 201) + 200`, `console.log` |
| `02_guess_game_243.html` | Final 243 Q1 | secret number, attempts counter, disable input after 5 |
| `03_password_strength_251.html` | Final 251 Q1 | scoring, regex tests, attempts > 8 warning |
| `04_calorie_tracker_252.html` | Final 252 Q1 | running total, entries counter |
| `05_study_tracker_261.html` | Final 261 Set-A Q1 | arrays, average, `join()` |
| `06_vitals_monitor_261b.html` | Final 261 Set-B Q1 | arrays, averages, `Math.abs`, risk formula |
| `07_builtin_functions.html` | extra practice | every array/string/math method from sections 6–9, including the three dots, with buttons |

Open any file in a browser, press **F12 → Console** to see `console.log` output.

---

## 11. Traps — the marks people lose

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
11. **`Math.max(arr)` is `NaN`:** `max`/`min` take separate numbers, not an array — write `Math.max(...arr)`.
12. **Plain assignment does not copy an array:** `let b = a;` then `b.push(...)` also changes `a`. Copy with `[...a]` or `a.slice()`.

---

## 12. Write From Memory — Self Test

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
- [ ] Array: `push`, `pop`, `splice(start, deleteCount)`, `slice(start, end)` — and which ones change the original
- [ ] String: `split("-")` turns `"English-2"` into `["English", "2"]`
- [ ] `join(", ")` prints an array as one string
- [ ] `toFixed(2)` vs `Math.round(x * 100) / 100` — which returns a string?
- [ ] `sort((a, b) => a - b)` for numbers (plain `sort()` is alphabetical!)
- [ ] Three dots: `[...arr]` copy, `[...a, ...b]` merge, `Math.max(...arr)` spread, `function f(...nums)` rest

---

## 13. How to Run the Examples

**Option A — browser (simplest):** double-click any `.html` file → it opens in your browser. Press `F12` → **Console** tab to see `console.log` results.

**Option B — Node (just the script):** copy the code inside `<script>...</script>` into a `.js` file and run `node file.js` (Node 24 is installed).

**Quick test checklist per file:**
- `01` — click Generate several times, check the console shows 200–400.
- `02` — try the sample sequence: guess 5000 (Too high), 500 (Too low) … 5 wrong guesses → "Out of guesses!".
- `03` — try `abc` (Very Weak), `hello123` (Weak), `Strong@Pass` (Strong), `Perfect@Pass123` (Perfect Password!).
- `04` — 300 → 500 → 700 gives "Good progress, keep it balanced!".
- `05` — 4 sessions totalling 14 h shows average 3.5 and "Almost ready!".
- `06` — 80/97 → SAFE, 78/95 → WARNING, 130/80 → DANGER.
- `07` — click each button, read the results in the console — every method from sections 6–9 on one page, including the "Spread / Rest (three dots)" button.
