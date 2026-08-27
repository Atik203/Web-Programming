# UIU CSE4165 / CSE465 Web Programming Midterm — Fast External CSS & HTML Architecture
> Pure HTML5 & External `style.css` Exam Reference (90 Min • 30 Marks)
> Priority: **Spring 2026 (P0)** > **Fall 2025 (P1)** > **Summer 2025 (P2)** > **Spring 2025 (P3)**

---

## 1. Setup & Global Reset
```html
<!-- index.html -->
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  ...
</body>
</html>
```
```css
/* style.css */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: Arial, sans-serif;
}
body {
  background: #f4f6f8;
  color: #333;
}
a {
  text-decoration: none;
  color: inherit;
}
```

---

## 2. Navigation Bars
```html
<!-- index.html -->
<nav class="navbar">
  <div class="logo">UIU <span style="color:#ff4419;">Desk</span></div>
  <ul class="nav-links">
    <li><a href="#" class="active">Home</a></li>
    <li><a href="#">Jobs</a></li>
    <li><a href="#" class="btn btn-sm btn-primary">Sign Up</a></li>
  </ul>
</nav>
```
```css
/* style.css */
.navbar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 6px 14px;
  background: #fff;
  border-bottom: 1px solid #ddd;
}
.nav-links {
  display: flex;
  gap: 12px;
  list-style: none;
  align-items: center;
}
.nav-links a.active {
  color: #1d78f0;
  font-weight: bold;
  border-bottom: 2px solid #1d78f0;
  padding-bottom: 1px;
}
/* Dark Navy variant (Spr26 S1 Q1 CORE-TECH): background: #1a237e; color: #fff; */
/* Black variant (Spr26 S2 Q2 Book Hub): background: #000; color: #fff; */
```

---

## 3. Sidebar & Filter Panels (P0)
```html
<!-- Dashboard Sidebar (Drive / LMS) -->
<div class="layout">
  <aside class="sidebar">
    <div class="avatar">JS</div>
    <h3>UIU HUB</h3>
    <ul class="menu">
      <li class="active">Dashboard</li>
      <li>Courses</li>
    </ul>
  </aside>
  <main class="main">
    <!-- Main Content Cards -->
  </main>
</div>

<!-- Filter Sidebar (Spr26 S1 Q2 Jobs) -->
<aside class="filter-sidebar">
  <div class="filter-group">
    <h4>Job Type</h4>
    <label class="filter-item"><input type="checkbox" checked> Full-time</label>
    <label class="filter-item"><input type="checkbox"> Remote</label>
  </div>
  <button class="btn btn-primary btn-block">Apply Filters</button>
</aside>
```
```css
/* style.css */
.layout {
  display: flex;
  min-height: 100vh;
}
.sidebar {
  width: 170px;
  background: #0d3e86;
  color: #fff;
  padding: 12px;
  flex-shrink: 0;
}
.menu {
  list-style: none;
  margin-top: 8px;
  display: flex;
  flex-direction: column;
  gap: 4px;
}
.menu li {
  padding: 5px 8px;
  border-radius: 4px;
  cursor: pointer;
  font-size: 9px;
}
.menu li.active {
  background: rgba(255,255,255,0.22);
  font-weight: bold;
}
.main {
  flex: 1;
  padding: 12px;
  background: #f5f6fb;
}
.filter-sidebar {
  width: 200px;
  padding: 12px;
  border-right: 1px solid #e2e8f0;
  background: #fff;
}
.filter-group {
  margin-bottom: 8px;
}
.filter-group h4 {
  font-size: 9.5px;
  font-weight: bold;
  margin-bottom: 4px;
}
.filter-item {
  display: flex;
  align-items: center;
  gap: 5px;
  font-size: 9px;
  margin-bottom: 3px;
  cursor: pointer;
}
```

---

## 4. Split 2-Column Hero & Full-Bleed Canvas (P0)
```html
<!-- 2-Column Split Hero (Fall25 / Spr25) -->
<div class="split" style="background:#eff6fe; padding:12px; border-radius:6px;">
  <div class="col">
    <h2>Launch Faster.</h2>
    <p>Modern teams tool.</p>
    <button class="btn btn-green">Learn More</button>
  </div>
  <div class="col card">
    <!-- Right Form / Grid Card -->
  </div>
</div>

<!-- Full-Bleed Colored Canvas (Spr26 S2 Q2 BookHub) -->
<div class="canvas" style="background:#c85a32;">
  <div class="card card-banner">
    <h1>Book Hub</h1>
  </div>
  <div class="split">
    <div class="col card">
      <!-- 2x2 Subgrid inside card -->
      <div class="grid-2">
        <div class="sub-box">CSE Books</div>
        <div class="sub-box">BBA Books</div>
      </div>
    </div>
    <div class="col card">
      <!-- Form Card -->
    </div>
  </div>
</div>
```
```css
/* style.css */
.split {
  display: flex;
  gap: 10px;
}
.split .col {
  flex: 1;
}
.split-46 .col-left {
  flex: 0.4;
}
.split-46 .col-right {
  flex: 0.6;
}
.canvas {
  padding: 14px;
  border-radius: 6px;
}
.sub-box {
  background: #fffbeb;
  border: 1px solid #eb6623;
  border-radius: 4px;
  padding: 6px;
}
```

---

## 5. Grid Templates & Stat Cards (P0)
```html
<!-- 4-Column KPI Row (Spr26 S1 Q1 CORE-TECH) -->
<div class="grid-4">
  <div class="stat-card" style="background:#1975d1;">
    <span>Total Users</span>
    <span class="stat-num">12,450</span>
    <span class="stat-pill">UP +12% MONTHLY</span>
  </div>
</div>
```
```css
/* style.css */
.grid-2 { display: grid; grid-template-columns: repeat(2, 1fr); gap: 7px; }
.grid-3 { display: grid; grid-template-columns: repeat(3, 1fr); gap: 7px; }
.grid-4 { display: grid; grid-template-columns: repeat(4, 1fr); gap: 7px; }
.grid-5 { display: grid; grid-template-columns: repeat(5, 1fr); gap: 5px; }

.stat-card {
  padding: 7px;
  border-radius: 4px;
  color: #fff;
  display: flex;
  flex-direction: column;
  gap: 2px;
}
.stat-num {
  font-size: 14px;
  font-weight: bold;
}
.stat-pill {
  align-self: flex-start;
  font-size: 6.5px;
  background: rgba(255,255,255,0.25);
  padding: 1px 4px;
  border-radius: 4px;
  font-weight: bold;
}
/* KPI Colors: Blue #1975d1, Green #378b3b, Orange #f78100, Purple #781fa0 */
/* 5-Col Plain File Cards (Spr26 S2): .file-card { background: #fff; border-radius: 4px; padding: 8px; text-align: center; } */
```

---

## 6. Card Archetypes (P0)
```html
<!-- 1. Job Card with Left-Accent Border (Spr26 S1 Q2) -->
<div class="card card-job">
  <div>
    <h4>Junior Software Engineer</h4>
    <p>Kaz Software</p>
    <span class="badge badge-blue">Full-time</span>
    <span class="badge badge-green">Onsite</span>
  </div>
  <div style="text-align:right;">
    <strong>৳35,000 - 50,000</strong><br>
    <small>Deadline: Dec 30</small><br>
    <button class="btn btn-primary btn-sm">Apply</button>
  </div>
</div>

<!-- 2. Gradient Header Course Card (Sum25 Q1) -->
<div class="card card-course">
  <div class="card-head-grad">Web Programming</div>
  <div class="card-body">
    <p>Prof. Rahman</p>
  </div>
</div>
```
```css
/* style.css */
.card {
  background: #fff;
  border-radius: 4px;
  padding: 8px;
  box-shadow: 0 1px 3px rgba(0,0,0,0.06);
}
.card-job {
  border-left: 4px solid #205bcb;
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 6px;
}
.card-brutal {
  border: 2px solid #000;
  box-shadow: 4px 4px 0 #000;
  text-align: center;
}
.card-course {
  padding: 0;
  overflow: hidden;
}
.card-head-grad {
  background: linear-gradient(135deg, #10b981, #84cc16);
  color: #fff;
  padding: 6px 8px;
  font-weight: bold;
}
.card-body {
  padding: 6px 8px;
}
.cat-card {
  border-radius: 5px;
  padding: 8px;
  color: #fff;
}
/* Category Colors: Purple #6b63ff, Teal #0db0d7, Pink #ea6aa8, Blue #2c74db */
```

---

## 7. Form Controls & Social Login
```html
<!-- Form Controls -->
<form class="form">
  <div class="form-group">
    <label>Full Name</label>
    <input class="input" type="text" placeholder="Name">
  </div>
  <div class="grid-2">
    <div class="form-group">
      <label>Zone</label>
      <select class="select"><option>USA</option></select>
    </div>
    <div class="form-group">
      <label>Email</label>
      <input class="input" type="email" placeholder="Email">
    </div>
  </div>
  <div class="form-group">
    <label>Notes</label>
    <textarea class="textarea" rows="2"></textarea>
  </div>
  <button type="submit" class="btn btn-primary btn-block">Submit</button>
</form>

<!-- Social Login & OR Divider (Spr25 Q2) -->
<button class="social-btn">G Sign in with Google</button>
<div class="grid-2">
  <button class="social-btn">Apple</button>
  <button class="social-btn">Facebook</button>
</div>
<div class="divider"><span>OR</span></div>
```
```css
/* style.css */
.form-group {
  display: flex;
  flex-direction: column;
  gap: 1px;
  margin-bottom: 3px;
}
.form-group label {
  font-size: 7.5px;
  font-weight: bold;
  color: #475569;
}
.input, .select, .textarea {
  width: 100%;
  padding: 3px 5px;
  border: 1px solid #cbd5e1;
  border-radius: 3px;
  font-size: 8px;
  outline: none;
}
.input:focus, .select:focus, .textarea:focus {
  border-color: #2563eb;
}
.social-btn {
  width: 100%;
  padding: 4px;
  border: 1px solid #ddd;
  border-radius: 3px;
  background: #fff;
  font-size: 8px;
  cursor: pointer;
  margin-bottom: 3px;
}
.divider {
  display: flex;
  align-items: center;
  margin: 3px 0;
  color: #888;
}
.divider::before, .divider::after {
  content: '';
  flex: 1;
  border-bottom: 1px solid #ddd;
}
.divider span {
  padding: 0 4px;
  font-size: 7px;
}
```

---

## 8. Boxed Permissions & Dual Buttons (P0)
```html
<!-- Boxed Permissions Row (Spr26 S1 Q1 Access Permissions) -->
<div class="cb-row">
  <label class="cb-box"><input type="checkbox" checked> Read</label>
  <label class="cb-box"><input type="checkbox"> Write</label>
  <label class="cb-box"><input type="checkbox"> Delete</label>
  <label class="cb-box"><input type="checkbox" checked> API</label>
</div>

<!-- Dual Action Buttons Footer (Spr26 S1 Q1) -->
<div class="btn-group">
  <button class="btn btn-navy" style="flex:1;">UPDATE SETTINGS</button>
  <button class="btn btn-secondary">RESET</button>
</div>
```
```css
/* style.css */
.cb-row {
  display: flex;
  gap: 5px;
  margin-bottom: 4px;
}
.cb-box {
  flex: 1;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 3px;
  padding: 3.5px 6px;
  border: 1px solid #cbd5e1;
  border-radius: 3px;
  background: #fff;
  font-size: 8px;
  cursor: pointer;
}
.btn-group {
  display: flex;
  gap: 5px;
}
```

---

## 9. Button Palette & Banner / Footer
```html
<!-- Banner & Footer -->
<div class="card card-banner">
  <h1>Buy, Sell, Exchange Books</h1>
  <p>UIU Book Hub</p>
</div>
<footer class="footer">&copy; 2026 UIU</footer>
```
```css
/* style.css */
.btn {
  padding: 3.5px 7px;
  border: none;
  border-radius: 3px;
  font-size: 8px;
  font-weight: bold;
  cursor: pointer;
  display: inline-block;
}
.btn-primary { background: #1d78f0; color: #fff; }
.btn-navy { background: #1a237e; color: #fff; }
.btn-secondary { background: #6c757d; color: #fff; }
.btn-green { background: #50ad50; color: #fff; }
.btn-red { background: #e90606; color: #fff; }
.btn-orange { background: #f97316; color: #fff; }
.btn-outline { background: transparent; border: 1.2px solid #1d78f0; color: #1d78f0; }
.btn-dashed {
  width: 100%;
  background: transparent;
  border: 1.2px dashed #94a3b8;
  color: #64748b;
  padding: 4px;
  border-radius: 4px;
  font-size: 8px;
}
.btn-block { width: 100%; }
.btn-sm { padding: 2px 4px; font-size: 7.5px; }

.card-banner {
  background: #fff;
  border: 1px solid #e2e8f0;
  border-radius: 5px;
  padding: 10px 14px;
  margin-bottom: 6px;
}
.footer {
  background: #000;
  color: #fff;
  text-align: center;
  padding: 6px;
  font-size: 8.5px;
}
/* Gradient Footer: background: linear-gradient(90deg, #f97316, #22c55e); */
```

---

## 10. Progress Bars & Storage Widget (P0)
```html
<!-- Storage Widget (Spr26 S2 Q1 Drive) -->
<div class="card">
  <div style="display:flex; justify-content:space-between;">
    <strong>Your storage</strong>
    <span style="color:#0ea5e9;">25% left</span>
  </div>
  <div class="prog-bar">
    <div class="prog-fill" style="width:75%; background:#3b82f6;"></div>
  </div>
  <small>75 GB of 100 GB are used</small>
</div>
```
```css
/* style.css */
.prog-bar {
  width: 100%;
  height: 5px;
  background: #e2e8f0;
  border-radius: 3px;
  overflow: hidden;
  margin: 2px 0;
}
.prog-fill {
  height: 100%;
  border-radius: 3px;
}
/* Dual Progress (Fall25 Q2): Blue bar width: 80% + Red bar width: 70% */
```

---

## 11. Badges, Pill-Rows & Table (P0)
```html
<!-- Pill-List Row (Spr26 S2 Q1 Shared Folders) -->
<div class="pill-row" style="background:#c8f2ef;">
  <span>Keynote files</span>
  <span class="tag">Team</span>
</div>

<!-- HTML Table (Summer25 Q2) -->
<table class="table">
  <thead>
    <tr><th>Course</th><th>Code</th><th>Cr</th></tr>
  </thead>
  <tbody>
    <tr><td>Web Prog</td><td>CSE201</td><td>3.0</td></tr>
  </tbody>
</table>
```
```css
/* style.css */
.badge {
  display: inline-block;
  padding: 1px 5px;
  border-radius: 8px;
  font-size: 7px;
  font-weight: bold;
}
.badge-blue { background: #e2ebfa; color: #205bcb; }
.badge-green { background: #d6f2e7; color: #0e7048; }
.badge-yellow { background: #fdebc0; color: #b45309; }
.badge-orange { background: #ffe4d6; color: #c2410c; }

.pill-row {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 5px 8px;
  border-radius: 5px;
  margin-bottom: 3px;
  font-size: 8px;
}
/* Pill-row Colors: Mint #c8f2ef, Lavender #ddd8ff, Pink #f8d9dd */

.avatar {
  width: 22px;
  height: 22px;
  border-radius: 50%;
  background: #536ffe;
  color: #fff;
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: bold;
  font-size: 8.5px;
  flex-shrink: 0;
}
.table {
  width: 100%;
  border-collapse: collapse;
  background: #fff;
  font-size: 7.5px;
}
.table th, .table td {
  padding: 2.5px 4px;
  text-align: left;
  border-bottom: 1px solid #e2e8f0;
}
.table th {
  background: #a05a2c;
  color: #fff;
  font-weight: bold;
}
.table tr:nth-child(even) {
  background: #f8fafc;
}
```

---

## 12. Gradient Event / Deadline Tiles (Summer 2025 Q1)
```html
<div class="grid-3">
  <div class="tile-grad" style="--g1:#f97316;--g2:#ef4444">
    <small>Mon 9:00AM</small><strong>Web Programming</strong>
    <span class="badge badge-blue">Lab</span>
  </div>
  <div class="tile-grad" style="--g1:#2563eb;--g2:#eab308">
    <small>Tue 2:00PM</small><strong>Database</strong>
  </div>
  <div class="tile-grad" style="--g1:#06b6d4;--g2:#22c55e">
    <small>Wed Deadline</small><strong>Assignment</strong>
  </div>
</div>
```
```css
/* style.css */
.tile-grad {
  background: linear-gradient(135deg, var(--g1), var(--g2));
  color: #fff;
  padding: 8px 10px;
  border-radius: 6px;
  display: flex;
  flex-direction: column;
  gap: 3px;
}
/* Orange→Red: --g1:#f97316;--g2:#ef4444 | Blue→Yellow: --g1:#2563eb;--g2:#eab308 | Cyan→Green: --g1:#06b6d4;--g2:#22c55e */
```

---

## 13. Testimonial Split Panel (Spring 2025 Q2)
```html
<div class="split">
  <div class="col testimonial-panel">
    <p class="quote">&ldquo;UIU shaped my future.&rdquo;</p>
    <div class="t-author">
      <div class="avatar">AR</div>
      <div><strong>Ashraf R.</strong><p>Student, CSE</p></div>
    </div>
  </div>
  <div class="col card">
    <!-- Sign-in form goes here -->
  </div>
</div>
```
```css
/* style.css */
.testimonial-panel {
  background: #0976a7;
  color: #fff;
  padding: 20px;
  display: flex;
  flex-direction: column;
  justify-content: center;
}
.quote {
  font-size: 13px;
  font-style: italic;
  margin-bottom: 12px;
  line-height: 1.5;
}
.t-author {
  display: flex;
  align-items: center;
  gap: 8px;
}
```

---

## 14. Colored Pill-List Rows (Spring 2026 S2 Q1 Drive App)
```html
<div class="pill-list">
  <div class="prow" style="background:#c8f2ef">
    <span>📄 Keynote files</span><span class="tag">Team</span>
  </div>
  <div class="prow" style="background:#ddd8ff">
    <span>📁 Design assets</span><span class="tag">Private</span>
  </div>
  <div class="prow" style="background:#f8d9dd">
    <span>💾 Project docs</span><span class="tag">Shared</span>
  </div>
  <button class="btn btn-dashed">+ Add more</button>
</div>
```
```css
/* style.css */
.prow {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 5px 8px;
  border-radius: 6px;
  margin-bottom: 4px;
  font-size: 8.5px;
}
/* Mint #c8f2ef | Lavender #ddd8ff | Pink #f8d9dd */
.pill-list .btn-dashed {
  margin-top: 4px;
  font-size: 8px;
}
```

