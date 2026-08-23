# UIU CSE4165 / CSE465 Web Programming Midterm Cheat Sheet
> Pure HTML5 & Vanilla CSS Exam Skeletons (90 Min • 30 Marks)

---

## 1. Boilerplate & Global Reset
```html
<!DOCTYPE html><html><head><style>
* { margin:0; padding:0; box-sizing:border-box; font-family:Arial,sans-serif; }
body { background:#f4f6f8; color:#333; } a { text-decoration:none; color:inherit; }
</style></head><body> ... </body></html>
```

---

## 2. Navbar (Left Logo, Right Links/Btn)
```html
<nav class="navbar">
  <div class="logo">UIU <span style="color:#ff4419;">Desk</span></div>
  <ul class="nav-links">
    <li><a href="#" class="active">Home</a></li>
    <li><a href="#" class="btn btn-sm btn-primary">Sign Up</a></li>
  </ul>
</nav>
<style>
.navbar { display:flex; justify-content:space-between; align-items:center; padding:5px 12px; background:#fff; border-bottom:1px solid #ddd; }
.nav-links { display:flex; gap:12px; list-style:none; align-items:center; }
.nav-links a.active { color:#1d78f0; font-weight:bold; border-bottom:2px solid #1d78f0; padding-bottom:1px; }
</style>
```

---

## 3. Sidebar Dashboard (LMS / Drive / Filter)
```html
<div class="layout">
  <aside class="sidebar">
    <div class="avatar">JS</div><h3>UIU HUB</h3>
    <ul class="side-menu">
      <li class="active">Dashboard</li>
      <li>Courses</li><li>Settings</li>
    </ul>
  </aside>
  <main class="main"><!-- cards here --></main>
</div>
<style>
.layout { display:flex; min-height:100vh; }
.sidebar { width:170px; background:#0d3e86; color:#fff; padding:12px; flex-shrink:0; }
/* Colors: dark-blue#0d3e86 | teal#0976a7 | light filter: bg:#f5f6fb border-right:1px solid #e2e8f0 */
.side-menu { list-style:none; margin-top:8px; display:flex; flex-direction:column; gap:4px; }
.side-menu li { padding:5px 8px; border-radius:4px; cursor:pointer; font-size:9.5px; }
.side-menu li.active { background:rgba(255,255,255,0.22); font-weight:bold; }
.main { flex:1; padding:12px; background:#f5f6fb; }
</style>
/* Filter Sidebar variant (Spring26 Slot1 Q2 - Jobs filter panel): */
.filter-sidebar { width:200px; padding:12px; border-right:1px solid #e2e8f0; }
.filter-group h4 { font-size:9px; font-weight:bold; margin-bottom:4px; }
.filter-group label { display:flex; align-items:center; gap:5px; font-size:9px; margin-bottom:3px; }
```

---

## 4. 2-Column Split Hero / Auth Layout
```html
<div class="split-box">
  <div class="col-left">
    <h2>Launch Faster.</h2><p>Modern teams tool.</p>
    <button class="btn btn-green">Learn More</button>
  </div>
  <div class="col-right"><!-- Form / Grid --></div>
</div>
<style>
.split-box { display:flex; gap:10px; background:#eff6fe; padding:12px; border-radius:6px; }
.col-left { flex:1; display:flex; flex-direction:column; justify-content:center; gap:5px; }
.col-right { flex:1; background:#fff; padding:10px; border-radius:6px; box-shadow:0 1px 3px rgba(0,0,0,0.06); }
/* Dark left panel (Spring25 Q2): col-left { background:#0976a7; color:#fff; } */
/* Custom ratio: .col-left{flex:0.4} .col-right{flex:0.6} */
</style>
```

---

## 5. Grid Templates & KPI Stat Cards
```html
<style>
.grid-2{display:grid;grid-template-columns:1fr 1fr;gap:7px;}
.grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:7px;}
.grid-4{display:grid;grid-template-columns:repeat(4,1fr);gap:7px;}
.grid-5{display:grid;grid-template-columns:repeat(5,1fr);gap:5px;}
</style>
<div class="grid-4">
  <div class="stat-card" style="background:#1975d1;color:#fff;">
    <span>Total Users</span>
    <strong style="font-size:15px;">12,450</strong>
    <span class="stat-pill">UP +12% MONTHLY</span>
  </div>
</div>
<style>
.stat-card{padding:7px;border-radius:4px;display:flex;flex-direction:column;gap:2px;}
.stat-pill{align-self:flex-start;font-size:7px;background:rgba(255,255,255,0.25);padding:1px 4px;border-radius:5px;font-weight:bold;}
/* KPI colors: blue#1975d1 green#378b3b orange#f78100 purple#781fa0 */
</style>
```

---

## 6. Card Archetypes (Accent, Brutalist, Gradient, Event, Category)
```css
/* 1. Job Card - Left Accent Border (Spring26 Slot1 Q2) */
.job-card{background:#fff;padding:7px;border-radius:4px;border-left:4px solid #205bcb;display:flex;justify-content:space-between;align-items:center;box-shadow:0 1px 3px rgba(0,0,0,0.06);}

/* 2. Brutalist Hard Shadow Card (Spring25 Q1) */
.brutal-card{background:#fff;padding:7px;border:2px solid #000;box-shadow:4px 4px 0 #000;text-align:center;}

/* 3. Course Card - Gradient Header (Summer25 Q1) */
.course-card{background:#fff;border-radius:4px;overflow:hidden;box-shadow:0 1px 3px rgba(0,0,0,0.08);}
.course-head{background:linear-gradient(135deg,#10b981,#84cc16);color:#fff;padding:5px 8px;font-weight:bold;}
.course-body{padding:5px 8px;}

/* 4. Event/Schedule Card - Colored bg (Summer25 Q1 bottom row) */
.event-card{border-radius:6px;padding:6px 8px;color:#fff;}
/* event colors: orange#f97316 | purple#9b59b6 | teal#06b6d4 | has: small date, strong title, badge */

/* 5. Category Colored Card (Spring26 Slot2 Q1 - Drive/BookHub grid) */
.cat-card{border-radius:6px;padding:8px 10px;color:#fff;}
/* cat colors: purple#6b63ff | teal#0db0d7 | pink#ea6aa8 | blue#2c74db */
```

---

## 7. Form Skeleton + Social Auth (All Input Types)
```html
<form class="exam-form">
  <div class="fg"><label>Full Name</label><input type="text" placeholder="John Doe"></div>
  <div class="grid-2">
    <div class="fg"><label>Zone</label><select><option>North America</option></select></div>
    <div class="fg"><label>Email</label><input type="email" placeholder="email@co.com"></div>
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
.fg{display:flex;flex-direction:column;gap:1.5px;margin-bottom:3px;}
.fg label{font-size:8px;font-weight:bold;color:#475569;}
input[type="text"],input[type="email"],input[type="password"],select,textarea{width:100%;padding:3px 6px;border:1px solid #cbd5e1;border-radius:3px;font-size:8.5px;outline:none;}
input:focus,select:focus,textarea:focus{border-color:#2563eb;}
.cb-group{display:flex;gap:4px;margin-bottom:4px;}
.cb-btn{display:flex;align-items:center;gap:3px;padding:2px 5px;border:1px solid #cbd5e1;border-radius:3px;font-size:8px;cursor:pointer;background:#fff;}
</style>
/* Social Auth Buttons (Spring25 Q2 - Sign In page) */
<button class="social-btn">G  Sign in with Google</button>
<div class="grid-2" style="gap:4px;">
  <button class="social-btn">Apple</button>
  <button class="social-btn">Facebook</button>
</div>
<div class="divider"><span>OR</span></div>
.social-btn{width:100%;padding:5px;border:1px solid #ddd;border-radius:4px;background:#fff;font-size:8.5px;cursor:pointer;margin-bottom:4px;}
.divider{display:flex;align-items:center;margin:3px 0;color:#888;}
.divider::before,.divider::after{content:'';flex:1;border-bottom:1px solid #ddd;}
.divider span{padding:0 4px;font-size:7.5px;}
```

---

## 8. Buttons & Hero Banner / Footer
```css
/* Buttons */
.btn{padding:4px 8px;border:none;border-radius:3px;font-size:8.5px;font-weight:bold;cursor:pointer;text-align:center;display:inline-block;}
.btn-primary{background:#1d78f0;color:#fff;} .btn-green{background:#50ad50;color:#fff;}
.btn-red{background:#e90606;color:#fff;} .btn-orange{background:#f97316;color:#fff;}
.btn-purple{background:#781fa0;color:#fff;} .btn-dark{background:#000;color:#fff;}
.btn-outline{background:transparent;border:1.2px solid #1d78f0;color:#1d78f0;}
.btn-block{width:100%;} .btn-sm{padding:2px 5px;font-size:8px;}

/* Hero/Banner Section (Spring26 Slot2 Q2 - full-width above content) */
.banner{background:#fff;border:1px solid #e2e8f0;border-radius:6px;padding:14px 18px;margin-bottom:8px;}
/* Gradient banner: background:linear-gradient(135deg,#eb6623,#c85a32);color:#fff; */
/* Usage: <div class="banner"><h1>Title</h1><p>Desc</p><a class="btn btn-primary">CTA</a></div> */

/* Footer */
.footer{background:#000;color:#fff;text-align:center;padding:8px;font-size:9px;}
/* Gradient footer: background:linear-gradient(90deg,#f97316,#22c55e) */
```

---

## 9. Progress Bar, Badges, Avatar & Table
```css
/* Progress Bar */
/* <div class="prog-bar"><div class="prog-fill" style="width:75%;background:#3b82f6;"></div></div> */
.prog-bar{width:100%;height:5px;background:#e2e8f0;border-radius:3px;overflow:hidden;margin:2px 0;}
.prog-fill{height:100%;border-radius:3px;}

/* Badges/Pills */
.badge{display:inline-block;padding:1px 5px;border-radius:8px;font-size:7.5px;font-weight:bold;}
.badge-blue{background:#e2ebfa;color:#205bcb;} .badge-green{background:#d6f2e7;color:#0e7048;}
.badge-yellow{background:#fdebc0;color:#b45309;} .badge-orange{background:#ffe4d6;color:#c2410c;}

/* Circular Avatar */
.avatar{width:24px;height:24px;border-radius:50%;background:#536ffe;color:#fff;display:flex;align-items:center;justify-content:center;font-weight:bold;font-size:9px;flex-shrink:0;}

/* HTML Table (Summer25 Q2) */
.table{width:100%;border-collapse:collapse;background:#fff;font-size:8px;}
.table th,.table td{padding:3px 5px;text-align:left;border-bottom:1px solid #e2e8f0;}
.table th{background:#a05a2c;color:#fff;font-weight:600;}
.table tr:nth-child(even){background:#f8fafc;}
```
