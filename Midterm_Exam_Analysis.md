# UIU CSE 4165 / CSE 465 Web Programming Midterm Exam In-Depth Analysis

## 1. Exam Structure & Constraints Overview
- **Duration**: 90 Minutes (45 minutes per question)
- **Total Marks**: 30 Marks (2 Questions × 15 Marks each)
- **Tech Stack**: Pure HTML5 & Vanilla CSS (No frameworks, no external CSS libraries, no JavaScript)
- **Paper Presentation**: Black & White printed paper with **red annotated arrows pointing to exact Hex Color Codes** (`#xxxxxx`).
- **Target Strategy**: Since 45 minutes is tight for creating full pixel-accurate UI layouts from scratch, mastering **reusable structural skeletons** (Flexbox/Grid, Sidebar layout, 2-Column Split, Form Controls, KPI Cards, and Badge Pills) is essential.

---

## 2. Detailed Breakdown of All 5 Exam Papers

### 📄 Paper 1: Fall 2025 (`Mid_Fall_2025.pdf`)
| Question | Type / Topic | Visual Structure | Key CSS / HTML Concepts Required |
| :--- | :--- | :--- | :--- |
| **Q1 (15 Marks)** | **SaaS Landing Page Hero + Sign-up Card** | • Top navigation bar (Logo left, 3 links right)<br>• Outer light-blue container (`#EFF6FE`) with rounded corners<br>• Left Hero column: Heading, paragraph, 3 feature checkmark items (`#50AD50`), 2 CTA buttons (Solid green `#50AD50`, Outlined blue `#3F46A4`)<br>• Right Column: Form card ("Start Your Free Trial", 3 text inputs, checkbox agreement, full-width button `#3F46A4`, footer link) | • Flex 2-column container (`display: flex; gap: 30px`)<br>• Form layout (`flex-direction: column`)<br>• Button variants (solid vs outlined `border: 1.5px solid`)<br>• Checkbox + label inline flex |
| **Q2 (15 Marks)** | **User Analytics Dashboard** | • Top bar: Logo left, center nav links (`#C1CDFF` active tab), right user avatar circle (`#536FFE`, initials "JS") + name/role<br>• Gray dashboard canvas (`#EBEBEB`)<br>• Top Stats Grid: Left Profile Card with 2 progress bars (80% `#536FFE`, 70% `#F93536`), Center stacked task stat cards, Right Revenue Card (`30,000/-`)<br>• Bottom Section: "Recent Projects" 3 horizontal project cards with status badges (`#C1CDFF`, `#9EFE1E`, `#FEBD57`) & progress bars | • 3-Column Grid (`grid-template-columns: repeat(3, 1fr)`)<br>• Avatar circle (`border-radius: 50%`)<br>• Custom progress bar (`.progress-bg` + `.progress-fill`)<br>• Status pills (`border-radius: 20px; padding: 4px 10px`) |

---

### 📄 Paper 2: Spring 2025 (`Mid_Term_Question_251_CSE4165_A_NHn.pdf`)
| Question | Type / Topic | Visual Structure | Key CSS / HTML Concepts Required |
| :--- | :--- | :--- | :--- |
| **Q1 (15 Marks)** | **Pricing / Service Cards Grid with Brutalist Shadows** | • Two-tier top navigation (Brand Logo with colored text `#ff4419`, Right auth buttons; Subnav category links)<br>• Hero headline + subtitle with dashed underline accents<br>• 5 Horizontal pricing/service cards (`#4358b8`, `#075627`, `#d84400`, `#1372aa`, `#206fb4`)<br>• Cards feature distinct hard black drop shadow (`box-shadow: 6px 6px 0px #000; border: 2px solid #000`)<br>• Bottom footer link section (`#1d78f0`) | • 5-Column Flexbox / Grid (`display: flex; gap: 15px`)<br>• Brutalist / Hard Drop Shadow styling (`box-shadow: 6px 6px 0 #000`)<br>• Button styling with icons/emojis<br>• Multi-tier nested navigation bars |
| **Q2 (15 Marks)** | **Split-Screen Testimonial & Social Login Page** | • Top single-line nav with blue pill CTA (`#0976a7`)<br>• 50/50 Split Box:<br>  - Left Column (`#0976a7` solid teal background): Large testimonial quote in quotes, circular avatar image, author credentials.<br>  - Right Column (White background): Sign-in form, Social buttons row (Google, Apple, Facebook), Divider line with "OR", Email & Password inputs with "Show" password text inside, Red Sign-In button (`#e90606`), legal links | • 2-Column Split Container (`flex: 1` each)<br>• Social login button grid<br>• Horizontal rule divider with middle text (`display: flex; align-items: center`)<br>• Absolute/relative positioning for "Show" password inside input |

---

### 📄 Paper 3: Summer 2025 (`Mid_Term_Question_252_CSE4165_A_NHn.pdf`)
| Question | Type / Topic | Visual Structure | Key CSS / HTML Concepts Required |
| :--- | :--- | :--- | :--- |
| **Q1 (15 Marks)** | **Sidebar LMS Learning Dashboard** | • Full height layout with Left Sidebar (Dark Navy `#1e3a5f`) + Right Main Workspace (`#f0f2f5`)<br>• Sidebar: Title + 9 vertical navigation links (active highlight)<br>• Main Header: Title + Right-aligned rounded search input<br>• Row 1: 3 Course Cards with gradient top bars (Green, Red/Gold, Purple), instructor name, progress bar & letter grades<br>• Row 2: "Upcoming Classes & Deadlines" card containing 3 multi-color vibrant gradient deadline tiles (Orange, Blue-Yellow, Cyan) with tags | • Sidebar Layout (`display: flex; min-height: 100vh`)<br>• Vertical menu list (`ul { list-style: none; }`)<br>• CSS Gradients (`linear-gradient(...)`)<br>• Search bar pill (`border-radius: 20px; padding: 6px 15px`) |
| **Q2 (15 Marks)** | **Student Portal with Table, Sidebar & Form** | • Top blue navigation header bar<br>• Left Column (Cyan/Teal gradient box): Semester pill links + Important Notice card with yellow button<br>• Right Column:<br>  - Section 1: "Course Registration" Data Table with copper/brown header (`#a05a2c`), striped rows.<br>  - Section 2: "Sign Up Form" (Full Name, Student ID, Email, Password, Gradient Register button)<br>• Full-width green footer banner | • HTML Table (`<table>`, `<thead>`, `<th>`, `<td>`, `border-collapse: collapse`)<br>• Form layout beside table<br>• Two-column layout with sidebar and content |

---

### 📄 Paper 4: Spring 2026 Slot-1 (`[Slot-1] Web Mid Exam Spring 2026.pdf`)
| Question | Type / Topic | Visual Structure | Key CSS / HTML Concepts Required |
| :--- | :--- | :--- | :--- |
| **Q1 (15 Marks)** | **Admin Cloud Console & System Config Form** | • Dark Navy top header bar (`CORE-TECH`, nav links with active underline, admin status right)<br>• Row 1: 4 Stat KPI Cards (Blue `#1975d1`, Green `#378b3b`, Orange `#f78100`, Purple `#781fa0`), each with number and pill percentage tag<br>• Row 2: 2 Column panels:<br>  - Panel 1 ("System Configuration"): Server Name input, Deployment Zone `<select>` dropdown, System Description `<textarea>`<br>  - Panel 2 ("Access Permissions"): 4 boxed checkboxes (`Read`, `Write`, `Delete`, `API`), "UPDATE SETTINGS" button (`#1a237e`), "RESET" button (`#6c757d`) | • 4-Column KPI Grid (`grid-template-columns: repeat(4, 1fr)`)<br>• Form input types: `<input>`, `<select>`, `<textarea>`<br>• Custom Boxed Checkbox items (`display: flex; border: 1px solid`)<br>• Double-button action footer |
| **Q2 (15 Marks)** | **Job Board Portal with Filter Sidebar & Job Cards** | • Top Nav: Logo `UIU CareerHub`, nav links, `+ Post a Job` button (`#205bcb`)<br>• 2-Column Body (`#f5f6fb` background):<br>  - Left Sidebar (260px Filter Panel): Collapsible filter groups (`Job Type`, `Department`, `Experience`) with checkboxes, "Apply Filters" button (`#205bcb`)<br>  - Right Section ("Available Positions"): 3 Job Cards (White cards with thick colored left border `#205bcb` / `#378b3b`, job title, company, tag pills `#e2ebfa` / `#d6f2e7` / `#fdebc0`, salary right-aligned, deadline, and blue "Apply" button) | • Sidebar filter layout (Left 250px, Right `flex: 1`)<br>• Card left-accent border (`border-left: 5px solid #205bcb`)<br>• Right-aligned salary/button (`display: flex; justify-content: space-between`)<br>• Multi-colored pill badges |

---

### 📄 Paper 5: Spring 2026 Slot-2 (`[Slot-2] Web Mid Exam Spring 2026.pdf`)
| Question | Type / Topic | Visual Structure | Key CSS / HTML Concepts Required |
| :--- | :--- | :--- | :--- |
| **Q1 (15 Marks)** | **Cloud Storage App Dashboard (Dropbox/Drive clone)** | • Dark Blue Left Sidebar (`#0d3e86`): Avatar circle ("Rahim"), vertical menu, bottom settings/logout<br>• Light Blue Content (`#e9eff7` / `#cfeef3`):<br>  - Top search input bar<br>  - Section 1 ("Categories"): 4 vibrant colored cards (`#6b63ff`, `#0db0d7`, `#ea6aa8`, `#2c74db`)<br>  - Section 2 ("Files"): 5 white folder cards in a row<br>  - Section 3: Bottom 2-column split (Left: Storage usage progress bar; Right: Shared folders list with colored pills `#c8f2ef`, `#ddd8ff`, `#f8d9dd` and "+ Add more" dashed button) | • Sidebar layout + nested cards<br>• 4-column and 5-column card grids<br>• Horizontal list items with pill badges<br>• Dashed border button (`border: 1.5px dashed #aaa`) |
| **Q2 (15 Marks)** | **Book Share Hub / Hero + Categories Grid + Form** | • Top Black Nav (`#000000`) + Logo + Nav links<br>• Rust/Orange canvas (`#c85a32`):<br>  - Top Hero Banner Card (White): Title, subtitle<br>  - Bottom 2-Column Split:<br>    - Left Card: "Book Categories" containing a 2×2 grid of category boxes (Cream `#fffbeb`, Orange border `#eb6623`)<br>    - Right Card: "Share a Book" vertical form (Name, Book Title, Author, Course Code, Condition/Note textarea, Orange submit button `#f97316`)<br>• Black bottom footer banner (`#000000`) | • 2-Column Container + 2x2 nested subgrid<br>• Vertical form styling<br>• Full-width header and footer bands |

---

## 3. Recurring Patterns & Archetype Classification

Across all 10 questions, **3 dominant layout archetypes** repeat constantly:

1. **Archetype A: Dashboard / Admin / Sidebar / LMS (Found in 5/10 questions)**
   - Top Header or Left Dark Sidebar
   - Multi-column KPI Stat cards (3 to 5 columns)
   - Progress bars (`.progress-bar`, `.progress-fill`)
   - Pill badges (`.badge`, `.pill`)
   - Rounded profile avatar (`border-radius: 50%`)
2. **Archetype B: 2-Column Split / Hero + Form / Auth (Found in 4/10 questions)**
   - Split layout: Left column info/testimonial/categories, Right column form
   - Inputs: `<input type="text/email/password">`, `<select>`, `<textarea>`, `<input type="checkbox">`
   - Form buttons: Solid colored full-width or primary/secondary buttons
   - Social buttons & "OR" divider line
3. **Archetype C: Card Grid / Job Board / Pricing Table (Found in 3/10 questions)**
   - 3 to 5 Column horizontal cards
   - Hard drop shadows (`box-shadow: 5px 5px 0 #000`) or Left-border accents (`border-left: 5px solid #color`)
   - Filter sidebar on the left with form controls on the right
   - Tables with styled headers (`th`) and rows (`td`)

---

## 4. Cheat Sheet Design Blueprint (1-Page A4)

To fit everything onto **one single printed A4 page** with maximum readability and zero wasted space, the cheat sheet should be structured into **4 compact columns / dense sections** using a 9pt-10pt font:

1. **Section 1: The Fast CSS Reset & Universal Container Basics** (Reset, Body, Container, Typography)
2. **Section 2: Layout Engines** (Navbar, Sidebar + Main, 2-Col Split, 3/4/5-Col Grids)
3. **Section 3: Essential UI Components** (KPI Cards, Left-Accent Cards, Brutalist Cards, Avatars, Progress Bars, Pill Badges, Divider)
4. **Section 4: Complete Form & Table Skeletons** (Text/Email/Password Inputs, Select Dropdown, Textarea, Checkbox Groups, Primary/Outline Buttons, HTML Table)
