# UIU CSE4165 / CSE465 Web Programming Midterm Cheat Sheet
> Pure HTML5 & Vanilla CSS Exam Skeletons (90 Min • 30 Marks)

---

## 1. Boilerplate & Global Reset
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

## 2. Universal Navbar (Left Logo, Right Links/Buttons)
```html
<nav class="navbar">
  <div class="logo">UIU <span style="color:#ff4419;">Desk</span></div>
  <ul class="nav-links">
    <li><a href="#" class="active">Home</a></li>
    <li><a href="#">Jobs</a></li>
    <li><a href="#" class="btn btn-sm btn-primary">Sign Up</a></li>
  </ul>
</nav>
<style>
.navbar { display: flex; justify-content: space-between; align-items: center; padding: 5px 12px; background: #fff; border-bottom: 1px solid #ddd; }
.nav-links { display: flex; gap: 12px; list-style: none; align-items: center; }
.nav-links a.active { color: #1d78f0; font-weight: bold; border-bottom: 2px solid #1d78f0; padding-bottom: 1px; }
</style>
```

---

## 3. Sidebar Dashboard Layout (LMS / Drive)
```html
<div class="layout">
  <aside class="sidebar">
    <div class="avatar">JS</div>
    <h3>UIU HUB</h3>
    <ul class="side-menu">
      <li class="active">Dashboard</li>
      <li>Courses</li><li>Settings</li>
    </ul>
  </aside>
  <main class="main"><!-- Question Content Cards --></main>
</div>
<style>
.layout { display: flex; min-height: 100vh; }
.sidebar { width: 170px; background: #0d3e86; color: #fff; padding: 12px; flex-shrink: 0; }
.side-menu { list-style: none; margin-top: 8px; display: flex; flex-direction: column; gap: 4px; }
.side-menu li { padding: 5px 8px; border-radius: 4px; cursor: pointer; font-size: 9.5px; }
.side-menu li.active { background: rgba(255,255,255,0.22); font-weight: bold; }
.main { flex: 1; padding: 12px; background: #f5f6fb; }
</style>
```

---

## 4. 2-Column Split Hero / Auth Layout
```html
<div class="split-box">
  <div class="col-left">
    <h2>Launch Faster.</h2><p>Modern teams tool.</p>
    <button class="btn btn-green">Learn More</button>
  </div>
  <div class="col-right"><!-- Form Card / Grid --></div>
</div>
<style>
.split-box { display: flex; gap: 10px; background: #eff6fe; padding: 12px; border-radius: 6px; }
.col-left { flex: 1; display: flex; flex-direction: column; justify-content: center; gap: 5px; }
.col-right { flex: 1; background: #fff; padding: 10px; border-radius: 6px; box-shadow: 0 1px 3px rgba(0,0,0,0.06); }
/* Custom ratio: .col-left { flex: 0.4; } .col-right { flex: 0.6; } */
</style>
```

---

## 5. Grid Templates & KPI Stat Cards
```html
<style>
.grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 7px; }
.grid-3 { display: grid; grid-template-columns: repeat(3, 1fr); gap: 7px; }
.grid-4 { display: grid; grid-template-columns: repeat(4, 1fr); gap: 7px; }
.grid-5 { display: grid; grid-template-columns: repeat(5, 1fr); gap: 5px; }
</style>
<div class="grid-4">
  <div class="stat-card" style="background:#1975d1; color:#fff;">
    <span style="font-size:8.5px;">Total Users</span>
    <strong style="font-size:15px;">12,450</strong>
    <span class="stat-pill">UP +12% MONTHLY</span>
  </div>
</div>
<style>
.stat-card { padding: 7px; border-radius: 4px; display: flex; flex-direction: column; gap: 2px; }
.stat-pill { align-self: flex-start; font-size: 7px; background: rgba(255,255,255,0.25); padding: 1px 4px; border-radius: 5px; font-weight: bold; }
</style>
```

---

## 6. Card Archetypes (Accent, Brutalist, Gradient)
```css
/* 1. Job Card with Left Accent Border */
.job-card { background: #fff; padding: 7px; border-radius: 4px; border-left: 4px solid #205bcb; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 1px 3px rgba(0,0,0,0.06); }

/* 2. Brutalist Hard Shadow Card (Spring 25) */
.brutal-card { background: #fff; padding: 7px; border: 2px solid #000; box-shadow: 4px 4px 0px #000; text-align: center; }

/* 3. Course Card with Gradient Header (Summer 25) */
.course-card { background: #fff; border-radius: 4px; overflow: hidden; box-shadow: 0 1px 3px rgba(0,0,0,0.08); }
.course-head { background: linear-gradient(135deg, #10b981, #84cc16); color: #fff; padding: 5px 8px; font-weight: bold; }
.course-body { padding: 5px 8px; }
```

---

## 7. Complete Form Skeleton (All Input Types)
```html
<form class="exam-form">
  <div class="fg"><label>Full Name</label><input type="text" placeholder="John Doe"></div>
  <div class="grid-2">
    <div class="fg"><label>Deployment Zone</label><select><option>North America</option></select></div>
    <div class="fg"><label>Work Email</label><input type="email" placeholder="email@co.com"></div>
  </div>
  <div class="fg"><label>Notes</label><textarea rows="2" placeholder="Notes..."></textarea></div>
  <div class="cb-group">
    <label class="cb-btn"><input type="checkbox" checked> Read</label>
    <label class="cb-btn"><input type="checkbox"> Write</label>
    <label class="cb-btn"><input type="checkbox"> API</label>
  </div>
  <button type="submit" class="btn btn-primary btn-block">Submit Form</button>
</form>
<style>
.fg { display: flex; flex-direction: column; gap: 1.5px; margin-bottom: 3.5px; }
.fg label { font-size: 8px; font-weight: bold; color: #475569; }
input[type="text"], input[type="email"], input[type="password"], select, textarea {
  width: 100%; padding: 3px 6px; border: 1px solid #cbd5e1; border-radius: 3px; font-size: 8.5px; outline: none; }
input:focus, select:focus, textarea:focus { border-color: #2563eb; }
.cb-group { display: flex; gap: 4px; margin-bottom: 4px; }
.cb-btn { display: flex; align-items: center; gap: 3px; padding: 2px 5px; border: 1px solid #cbd5e1; border-radius: 3px; font-size: 8px; cursor: pointer; background: #fff; }
</style>
```

---

## 8. Button Palette & Styles
```css
.btn { padding: 4px 8px; border: none; border-radius: 3px; font-size: 8.5px; font-weight: bold; cursor: pointer; text-align: center; display: inline-block; }
.btn-primary { background: #1d78f0; color: #fff; }
.btn-green   { background: #50ad50; color: #fff; }
.btn-red     { background: #e90606; color: #fff; }
.btn-orange  { background: #f97316; color: #fff; }
.btn-outline { background: transparent; border: 1.2px solid #1d78f0; color: #1d78f0; }
.btn-dashed  { background: transparent; border: 1.2px dashed #94a3b8; color: #64748b; }
.btn-block   { width: 100%; }
.btn-sm      { padding: 2px 5px; font-size: 8px; }
```

---

## 9. Micro-Widgets (Progress Bar, Badges, Avatar, Table & Divider)
```css
/* Progress Bar */
.prog-bar { width: 100%; height: 5px; background: #e2e8f0; border-radius: 3px; overflow: hidden; margin: 2px 0; }
.prog-fill { height: 100%; border-radius: 3px; }

/* Status Badge / Pills */
.badge { display: inline-block; padding: 1px 5px; border-radius: 8px; font-size: 7.5px; font-weight: bold; }
.badge-blue { background: #e2ebfa; color: #205bcb; }
.badge-green { background: #d6f2e7; color: #0e7048; }
.badge-yellow { background: #fdebc0; color: #b45309; }

/* Circular Avatar & Search Pill */
.avatar { width: 24px; height: 24px; border-radius: 50%; background: #536ffe; color: #fff; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 9px; flex-shrink: 0; }
.search-pill { width: 100%; max-width: 170px; padding: 3px 8px; border-radius: 12px; border: 1px solid #cbd5e1; font-size: 8.5px; outline: none; }

/* OR Divider */
.divider { display: flex; align-items: center; margin: 4px 0; color: #888; }
.divider::before, .divider::after { content: ''; flex: 1; border-bottom: 1px solid #ddd; }
.divider span { padding: 0 4px; font-size: 7.5px; }

/* HTML Data Table (Summer 25 Q2) */
.table { width: 100%; border-collapse: collapse; background: #fff; border-radius: 3px; overflow: hidden; font-size: 8px; }
.table th, .table td { padding: 3px 5px; text-align: left; border-bottom: 1px solid #e2e8f0; }
.table th { background: #a05a2c; color: #fff; font-weight: 600; }
.table tr:nth-child(even) { background: #f8fafc; }
```
