# UIU CSE4165 / CSE465 Web Programming Midterm Exam Analysis & Strategy Guide

## 1. Exam Structure & Constraints Overview

- **Duration**: 90 Minutes (Strictly 45 minutes per question)
- **Total Marks**: 30 Marks (2 Questions × 15 Marks each)
- **Tech Stack**: Pure HTML5 & Vanilla CSS (External `style.css` + `index.html` — No JavaScript, No CSS frameworks)
- **Paper Presentation**: Black & White printed paper with **red annotated arrows pointing to exact Hex Color Codes** (`#xxxxxx`).
- **Target Strategy**: 
  1. Write core modular CSS classes into `style.css` in the first 2–3 minutes.
  2. Assemble the semantic HTML in `index.html` using class names (Tailwind-like modular speed).
  3. Map the red arrow Hex color codes directly into inline styles or dedicated utility classes.

---

## 2. Priority-Weighted Hierarchy (Exam Evolution)

> **Priority Order**: **Spring 2026 (Slot 1 & Slot 2) > Fall 2025 > Summer 2025 > Spring 2025**
> *Rationale*: UIU exams evolve incrementally. Later papers incorporate earlier patterns while introducing newer components. Spring 2026 represents the current exam baseline.

### 🔴 P0 — Spring 2026 (Slot 1 + Slot 2) — Highest Priority
| Paper | Question | UI Pattern | Key Elements & New Features |
|:---|:---|:---|:---|
| **S1** | **Q1** | **Admin KPI Dashboard & Config Form** | Dark navy top navbar with active underline; 4-column KPI stat cards; **Boxed checkbox permission group** (`Read`/`Write`/`Delete`/`API`); **Dual-button action footer** (`Update Settings` navy + `Reset` gray). |
| **S1** | **Q2** | **Job Board with Filter Sidebar** | **Sidebar filter panel** (collapsible categories + checkbox lists + `Apply Filters` button); **Job cards with thick left-accent border** (`border-left: 4px solid #205bcb`); right-aligned salary, deadline & `Apply` button. |
| **S2** | **Q1** | **Cloud Storage App (Drive Clone)** | Dark navy sidebar + avatar; top search input; 4-column colored category cards; 5-column white file folder cards; **Storage usage widget** (horizontal progress bar + `25% left` badge + text summary); **Pill-list rows** (`Keynote files` with right tag `Team`); **Dashed "+ Add more" button**. |
| **S2** | **Q2** | **Book Share Hub** | Full-width black top navbar & black footer; **Full-bleed rust canvas container** (`#c85a32`) wrapping white cards; top banner hero; bottom split: Left **2×2 nested subgrid** (category boxes with orange border) + Right **vertical book submission form** (5 inputs + orange CTA). |

### 🟠 P1 — Fall 2025 — Baseline Reference
| Question | UI Pattern | Key Elements & Role |
|:---|:---|:---|
| **Q1** | **SaaS Landing Page Split Hero** | Baseline 2-column split hero (`#eff6fe` background); Left features checkmarks + solid vs outline button pairing; Right trial signup form card. |
| **Q2** | **3-Column KPI Dashboard** | Top bar with circular avatar JS (`#536ffe`); 3-column stats; Left card dual progress bars (`80%` #536ffe, `7/10` #f93536); Center stacked cards; Right revenue card; Bottom 3 horizontal project cards with status badges. |

### 🔵 P2 — Summer 2025 — Specialized Widgets
| Question | UI Pattern | Key Elements & Role |
|:---|:---|:---|
| **Q1** | **LMS Sidebar Learning Dashboard** | Dark navy sidebar with 9 vertical links; Main top search pill; 3 Course cards with **gradient header bars** (`linear-gradient(135deg, #10b981, #84cc16)`) + progress bars; Bottom 3 multi-color vibrant **gradient schedule tiles** (Orange, Blue-Yellow, Cyan). |
| **Q2** | **Student Portal (Table + Sidebar + Form)** | Cyan left sidebar (semester list + notice card); Right section with **HTML data table** (`<table>`, `<th>` with copper header `#a05a2c`, striped rows `tr:nth-child(even)`); Sign-up form below table; Full-width green gradient footer. |

### ⚪ P3 — Spring 2025 — Legacy / Niche Archetypes
| Question | UI Pattern | Key Elements & Role |
|:---|:---|:---|
| **Q1** | **Brutalist 5-Column Pricing Cards** | Two-tier navbar; 5 pricing cards with **hard black drop shadows** (`box-shadow: 4px 4px 0 #000; border: 2px solid #000`). |
| **Q2** | **Split Testimonial & Social Login** | 50/50 Split Box: Left solid teal panel (`#0976a7`) with quote & circular avatar; Right sign-in form with **social buttons row** (Google, Apple, Facebook), **"OR" divider line**, and "Show" password toggle. |

---

## 3. The 3 Master Layout Archetypes

Every single exam question maps directly into one of these 3 structural layouts:

```
+-----------------------------------------------------------------------------------+
| 1. ARCHETYPE A: SIDEBAR / DASHBOARD / ADMIN (5 of 10 Questions)                   |
| [ Left Sidebar (180px) ]  [ Top Bar: Title / Search / Avatar                    ] |
|                           [ Row 1: KPI Stat Cards Grid (3-Col or 4-Col)         ] |
|                           [ Row 2: Content Cards / Split Forms / Progress Lists ] |
+-----------------------------------------------------------------------------------+
| 2. ARCHETYPE B: 2-COLUMN SPLIT / HERO + FORM / CANVAS (4 of 10 Questions)         |
| [ Top Navbar (Full Width)                                                       ] |
| [ Outer Canvas (e.g. #eff6fe or #c85a32)                                        ] |
|   [ Left Col (Hero/Testimonial/2x2 Subgrid) ] [ Right Col (White Form Card)     ] |
| [ Footer (Full Width)                                                           ] |
+-----------------------------------------------------------------------------------+
| 3. ARCHETYPE C: CARD GRID / JOB BOARD / FILTER (3 of 10 Questions)                |
| [ Top Navbar                                                                    ] |
| [ Filter Sidebar (220px) w/ Checkboxes ]  [ Main: 3-5 Col Grids / Job Cards     ] |
|                                           [       with Left-Accent Borders      ] |
+-----------------------------------------------------------------------------------+
```

---

## 4. The External CSS Architecture (`style.css` + `index.html`)

Instead of messy inline CSS, use this clean modular CSS class system. In your exam:
1. Create `style.css` and paste the standard resets, grid engines, and component classes.
2. Link it in `index.html` via `<link rel="stylesheet" href="style.css">`.
3. In `index.html`, construct the entire UI using intuitive, semantic class names.

### Class Reference Table for Exam Quick Lookup

| Component Category | CSS Classes (`style.css`) | Purpose in Exam Questions |
|:---|:---|:---|
| **Global Reset** | `*`, `body`, `a` | Zero margins, `box-sizing: border-box`, standard font. |
| **Layouts** | `.layout`, `.sidebar`, `.main`, `.canvas` | Full-page sidebar app or full-bleed colored background. |
| **Split Columns** | `.split`, `.split-46`, `.split-sidebar` | 50/50 hero splits, 40/60 form splits, sidebar + main. |
| **Grid Engines** | `.grid-2`, `.grid-3`, `.grid-4`, `.grid-5` | 2x2 subgrids, 3-col courses, 4-col KPIs, 5-col file/pricing cards. |
| **Navigation** | `.navbar`, `.logo`, `.nav-links`, `.menu` | Top navigation bars & vertical sidebar menu lists. |
| **Card System** | `.card`, `.card-header`, `.card-job`, `.card-brutal`, `.card-banner` | Job cards (left-accent), brutalist cards, hero banners. |
| **KPI & Stat** | `.stat-card`, `.stat-num`, `.stat-pill` | 4-color KPI cards (Blue, Green, Orange, Purple) with metric pills. |
| **Forms & Inputs** | `.form-group`, `.input`, `.select`, `.textarea` | Form labels, inputs, dropdown selects, textareas. |
| **Checkboxes** | `.cb-row`, `.cb-box`, `.filter-group`, `.filter-item` | Boxed permissions (`Read`/`Write`) & vertical filter lists. |
| **Buttons** | `.btn`, `.btn-primary`, `.btn-secondary`, `.btn-green`, `.btn-red`, `.btn-outline`, `.btn-dashed`, `.btn-block`, `.btn-sm` | Solid, outline, dashed "+ Add", and dual-action buttons. |
| **Badges & Pills** | `.badge`, `.badge-blue`, `.badge-green`, `.badge-yellow`, `.badge-orange`, `.pill-row` | Status tags, category pills, and shared folder colored rows. |
| **Widgets** | `.prog-bar`, `.prog-fill`, `.storage-box`, `.avatar`, `.divider`, `.table`, `.footer` | Progress bars, storage widget, avatar circle, OR line, tables. |

---

## 5. Time-Boxed 45-Minute Exam Execution Workflow

For each 15-mark question (45 minutes total):

1. **Minutes 0–2: Identify Archetype & Color Palette**
   - Check the printed layout: Is it **Sidebar Dashboard**, **Split Hero/Auth**, or **Card Grid/Job Board**?
   - Note down all red-arrow Hex color codes.
2. **Minutes 2–5: Boilerplate & Layout Skeleton**
   - In `index.html`: write basic HTML5 structure + `<link rel="stylesheet" href="style.css">`.
   - In `style.css`: paste/write the reset + chosen layout engine (`.layout`, `.split`, or `.grid-N`).
   - Create the outer wrapper (`.navbar`, `.sidebar`, `.main`, or `.canvas`).
3. **Minutes 5–25: Core Content & Component Assembly**
   - Add cards, grids, forms, and tables using predefined class names.
   - Apply specific hex colors (either as helper classes or quick inline attributes matching red arrows).
4. **Minutes 25–35: Forms, Inputs & Action Elements**
   - Style inputs, checkbox groups, buttons, badges, and progress bars.
5. **Minutes 35–42: Spacing & Visual Alignment (Pixel Polish)**
   - Adjust `gap`, `padding`, `border-radius`, and font sizes to visually match the printed question paper.
6. **Minutes 42–45: Final Check against Question Requirements**
   - Verify all text, labels, and color annotations match the red arrows.
