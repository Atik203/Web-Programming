# UIU Web Programming Midterm Exam — 1-Page A4 Cheat Sheet
> **Exam Parameters**: 90 Minutes | 2 Questions × 15 Marks = 30 Marks | Pure HTML5 + Raw CSS

---

## 1. Global Boilerplate & Reset
```html
<!DOCTYPE html>
<html>
<head>
<style>
  * { margin: 0; padding: 0; box-sizing: border-box; font-family: Arial, sans-serif; }
  body { background: #f4f6f8; color: #333; }
  a { text-decoration: none; color: inherit; }
</style>
</head>
<body> ... </body>
</html>
```

---

## 2. Universal Navigation Bar (Left Logo, Right Links/Buttons)
```html
<nav class="navbar">
  <div class="logo">UIU <span style="color:#ff4419;">Desk</span></div>
  <ul class="nav-links">
    <li><a href="#" class="active">Home</a></li>
    <li><a href="#">Jobs</a></li>
    <li><a href="#" class="btn btn-sm">Sign Up</a></li>
  </ul>
</nav>
```
```css
.navbar { display: flex; justify-content: space-between; align-items: center; padding: 10px 20px; background: #fff; border-bottom: 1px solid #ddd; }
.nav-links { display: flex; gap: 16px; list-style: none; align-items: center; }
.nav-links a.active { color: #1d78f0; font-weight: bold; border-bottom: 2px solid #1d78f0; padding-bottom: 2px; }
```

---

## 3. Sidebar Dashboard Layout (LMS / Drive / Cloud Storage)
```html
<div class="layout">
  <aside class="sidebar">
    <div class="avatar">JS</div>
    <h3>UIU HUB</h3>
    <ul class="side-menu">
      <li class="active">Dashboard</li>
      <li>Courses</li>
      <li>Settings</li>
    </ul>
  </aside>
  <main class="main">
    <!-- Main content cards / forms -->
  </main>
</div>
```
```css
.layout { display: flex; min-height: 100vh; }
.sidebar { width: 220px; background: #0d3e86; color: #fff; padding: 20px; flex-shrink: 0; }
.side-menu { list-style: none; margin-top: 15px; display: flex; flex-direction: column; gap: 8px; }
.side-menu li { padding: 8px 12px; border-radius: 6px; cursor: pointer; font-size: 12px; }
.side-menu li.active { background: rgba(255,255,255,0.2); }
.main { flex: 1; padding: 24px; background: #f5f6fb; }
```

---

## 4. 2-Column Split Hero / Split Form
```html
<div class="split-box">
  <div class="col-left">
    <h1>Launch Faster.</h1>
    <p>Modern teams tool.</p>
    <button class="btn btn-green">Learn More</button>
  </div>
  <div class="col-right">
    <!-- Form Card -->
  </div>
</div>
```
```css
.split-box { display: flex; gap: 20px; background: #eff6fe; padding: 24px; border-radius: 10px; }
.col-left { flex: 1; display: flex; flex-direction: column; justify-content: center; gap: 12px; }
.col-right { flex: 1; background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.06); }
/* Custom ratio: .col-left { flex: 0.4; } .col-right { flex: 0.6; } */
```

---

## 5. Grids & KPI Stat Cards
```css
.grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }
.grid-3 { display: grid; grid-template-columns: repeat(3, 1fr); gap: 12px; }
.grid-4 { display: grid; grid-template-columns: repeat(4, 1fr); gap: 12px; }
.grid-5 { display: grid; grid-template-columns: repeat(5, 1fr); gap: 10px; }
```
```html
<div class="grid-4">
  <div class="stat-card" style="background:#1975d1; color:#fff;">
    <div class="stat-label">Total Users</div>
    <div class="stat-val">12,450</div>
    <span class="stat-pill">UP +12% MONTHLY</span>
  </div>
</div>
```
```css
.stat-card { padding: 14px; border-radius: 8px; display: flex; flex-direction: column; gap: 6px; }
.stat-val { font-size: 20px; font-weight: 800; }
.stat-pill { align-self: flex-start; font-size: 9px; background: rgba(255,255,255,0.25); padding: 2px 6px; border-radius: 10px; font-weight: bold; }
```

---

## 6. Card Archetypes (Left Accent, Brutalist Shadow, Gradient Header)
```css
/* 1. Job Card with Left Colored Border */
.job-card { background: #fff; padding: 14px; border-radius: 6px; border-left: 5px solid #205bcb; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 1px 4px rgba(0,0,0,0.06); }

/* 2. Brutalist Hard Shadow Card */
.brutal-card { background: #fff; padding: 16px; border-radius: 4px; border: 2px solid #000; box-shadow: 6px 6px 0px #000; text-align: center; }

/* 3. Course Card with Gradient Header */
.course-card { background: #fff; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 6px rgba(0,0,0,0.08); }
.course-head { background: linear-gradient(135deg, #10b981, #84cc16); color: #fff; padding: 12px; font-weight: bold; }
.course-body { padding: 12px; }
```

---

## 7. Form Controls (Text, Select, Textarea, Boxed Checkboxes)
```html
<form class="exam-form">
  <div class="fg">
    <label>Full Name</label>
    <input type="text" placeholder="Enter full name">
  </div>
  <div class="grid-2">
    <div class="fg">
      <label>Deployment Zone</label>
      <select><option>North America (East)</option></select>
    </div>
    <div class="fg">
      <label>Work Email</label>
      <input type="email" placeholder="user@corp.com">
    </div>
  </div>
  <div class="fg">
    <label>System Description / Note</label>
    <textarea rows="2" placeholder="Enter notes..."></textarea>
  </div>
  <div class="cb-group">
    <label class="cb-btn"><input type="checkbox" checked> Read</label>
    <label class="cb-btn"><input type="checkbox"> Write</label>
    <label class="cb-btn"><input type="checkbox"> API</label>
  </div>
  <button type="submit" class="btn btn-primary btn-block">Submit</button>
</form>
```
```css
.fg { display: flex; flex-direction: column; gap: 3px; margin-bottom: 8px; }
.fg label { font-size: 10px; font-weight: bold; color: #475569; }
input[type="text"], input[type="email"], input[type="password"], select, textarea {
  width: 100%; padding: 6px 9px; border: 1px solid #cbd5e1; border-radius: 5px; font-size: 11px; outline: none;
}
input:focus, select:focus, textarea:focus { border-color: #2563eb; }
.cb-group { display: flex; gap: 8px; margin-bottom: 10px; }
.cb-btn { display: flex; align-items: center; gap: 5px; padding: 5px 10px; border: 1px solid #cbd5e1; border-radius: 5px; font-size: 11px; cursor: pointer; background: #fff; }
```

---

## 8. Micro-Widgets (Progress Bars, Badges, Avatar, Table, Divider)
```css
/* Progress Bar */
.prog-bar { width: 100%; height: 8px; background: #e2e8f0; border-radius: 4px; overflow: hidden; margin: 6px 0; }
.prog-fill { height: 100%; border-radius: 4px; }

/* Status Badges */
.badge { display: inline-block; padding: 3px 8px; border-radius: 12px; font-size: 9px; font-weight: bold; }
.badge-blue { background: #e2ebfa; color: #205bcb; }
.badge-green { background: #d6f2e7; color: #0e7048; }
.badge-yellow { background: #fdebc0; color: #b45309; }

/* Circular Avatar */
.avatar { width: 38px; height: 38px; border-radius: 50%; background: #536ffe; color: #fff; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 12px; }

/* Data Table */
.data-table { width: 100%; border-collapse: collapse; background: #fff; border-radius: 6px; overflow: hidden; font-size: 11px; }
.data-table th, .data-table td { padding: 7px 10px; text-align: left; border-bottom: 1px solid #e2e8f0; }
.data-table th { background: #a05a2c; color: #fff; font-weight: 600; }
.data-table tr:nth-child(even) { background: #f8fafc; }

/* Divider with 'OR' */
.divider { display: flex; align-items: center; margin: 10px 0; color: #888; }
.divider::before, .divider::after { content: ''; flex: 1; border-bottom: 1px solid #ddd; }
.divider span { padding: 0 8px; font-size: 10px; }
```

---

## 9. Buttons
```css
.btn { padding: 7px 14px; border: none; border-radius: 5px; font-size: 11px; font-weight: bold; cursor: pointer; text-align: center; display: inline-block; }
.btn-primary { background: #1d78f0; color: #fff; }
.btn-green   { background: #50ad50; color: #fff; }
.btn-red     { background: #e90606; color: #fff; }
.btn-orange  { background: #f97316; color: #fff; }
.btn-outline { background: transparent; border: 1.5px solid #1d78f0; color: #1d78f0; }
.btn-dashed  { background: transparent; border: 1.5px dashed #94a3b8; color: #64748b; }
.btn-block   { width: 100%; }
.btn-sm      { padding: 4px 8px; font-size: 10px; }
```
