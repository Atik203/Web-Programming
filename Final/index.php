<?php
$BASE = __DIR__;

$sections = [
    'Final-Solutions' => ['icon' => '✅', 'title' => 'Final Solutions', 'desc' => 'All 6 papers solved — exam-pattern answers (HTML/JS + PHP + MySQL) + ready-made quickstart starters', 'color' => '#16a34a', 'text' => '#15803d'],
    'JavaScript'      => ['icon' => '🟨', 'title' => 'JavaScript',      'desc' => 'Q1 — final papers 02→06 lead, method drills 07, mock-quiz warm-up last (08)', 'color' => '#f0db4f', 'text' => '#8a6d00'],
    'PHP'             => ['icon' => '🟪', 'title' => 'PHP',             'desc' => 'Q2 — final papers 02→08 lead, mock-quiz class exercise last (09)', 'color' => '#777bb4', 'text' => '#4b4e8f'],
    'MySQL'           => ['icon' => '🟦', 'title' => 'MySQL',           'desc' => 'Q3 — final query drills 03→08 lead, bridge extras 11–13, mock quiz 09–10 last', 'color' => '#00758f', 'text' => '#00566a'],
    'Practice'        => ['icon' => '🏋️', 'title' => 'Practice',        'desc' => 'Your raw timed attempts — compare them line by line against Final Solutions', 'color' => '#0ea5e9', 'text' => '#0369a1'],
];

function h($s) {
    return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}

function pretty_name($file) {
    $name = pathinfo($file, PATHINFO_FILENAME);
    $name = str_replace(['_', '-'], ' ', $name);
    return ucwords($name);
}

function md_inline($text) {
    $text = h($text);
    $text = preg_replace('/\*\*(.+?)\*\*/', '<strong>$1</strong>', $text);
    $text = preg_replace('/`([^`]+)`/', '<code>$1</code>', $text);
    $text = preg_replace('/\[([^\]]+)\]\(([^)]+)\)/', '<a href="$2">$1</a>', $text);
    return $text;
}

function render_markdown($md) {
    $lines = explode("\n", $md);
    $out = [];
    $inCode = false;
    $inList = false;
    $inQuote = false;
    $inTable = false;

    $closeList  = function () use (&$out, &$inList)  { if ($inList)  { $out[] = '</ul>'; $inList = false; } };
    $closeQuote = function () use (&$out, &$inQuote) { if ($inQuote) { $out[] = '</blockquote>'; $inQuote = false; } };
    $closeTable = function () use (&$out, &$inTable) { if ($inTable) { $out[] = '</tbody></table>'; $inTable = false; } };

    foreach ($lines as $line) {
        $trim = rtrim($line);

        if (strpos($trim, '```') === 0) {
            $closeList(); $closeQuote(); $closeTable();
            if ($inCode) { $out[] = '</code></pre>'; $inCode = false; }
            else         { $out[] = '<pre><code>'; $inCode = true; }
            continue;
        }
        if ($inCode) { $out[] = h($trim); continue; }

        if (trim($trim) === '') { $closeList(); $closeQuote(); $closeTable(); continue; }

        if (preg_match('/^(<br\s*\/?>\s*)+$/i', $trim)) { $closeList(); $closeQuote(); $closeTable(); $out[] = $trim; continue; }

        if (preg_match('/^-{3,}\s*$/', $trim)) { $closeList(); $closeQuote(); $closeTable(); $out[] = '<hr>'; continue; }

        if (preg_match('/^(#{1,6})\s+(.*)$/', $trim, $m)) {
            $closeList(); $closeQuote(); $closeTable();
            $lvl = strlen($m[1]);
            $id = strtolower($m[2]);
            $id = preg_replace('/[^a-z0-9\s_-]/', '', $id);
            $id = trim($id);
            $id = preg_replace('/\s/', '-', $id);
            $out[] = "<h$lvl id=\"" . h($id) . "\">" . md_inline($m[2]) . "</h$lvl>";
            continue;
        }

        if (preg_match('/^\|.*\|$/', $trim)) {
            $cells = array_map('trim', explode('|', trim($trim, '|')));
            $isSep = true;
            foreach ($cells as $c) {
                if (!preg_match('/^:?-{2,}:?$/', $c)) { $isSep = false; break; }
            }
            if ($isSep) continue;
            $closeList(); $closeQuote();
            if (!$inTable) { $out[] = '<table><tbody>'; $inTable = true; }
            $row = '<tr>';
            foreach ($cells as $c) { $row .= '<td>' . md_inline($c) . '</td>'; }
            $out[] = $row . '</tr>';
            continue;
        }
        $closeTable();

        if (strpos($trim, '> ') === 0) {
            $closeList();
            if (!$inQuote) { $out[] = '<blockquote>'; $inQuote = true; }
            $out[] = md_inline(substr($trim, 2)) . '<br>';
            continue;
        }
        $closeQuote();

        if (preg_match('/^\s*[-*]\s+(.*)$/', $trim, $m)) {
            if (!$inList) { $out[] = '<ul>'; $inList = true; }
            $item = $m[1];
            if (strpos($item, '[ ] ') === 0) {
                $out[] = '<li><span class="cb">&#9744;</span> ' . md_inline(substr($item, 4)) . '</li>';
            } else {
                $out[] = '<li>' . md_inline($item) . '</li>';
            }
            continue;
        }
        $closeList();

        $out[] = '<p>' . md_inline($trim) . '</p>';
    }

    if ($inCode) $out[] = '</code></pre>';
    $closeList(); $closeQuote(); $closeTable();
    return implode("\n", $out);
}

function scan_dir($base, $dir, $allowed) {
    $path = $base . DIRECTORY_SEPARATOR . $dir;
    if (!is_dir($path)) return [];
    $files = [];
    foreach (scandir($path) as $f) {
        if ($f === '.' || $f === '..') continue;
        $ext = strtolower(pathinfo($f, PATHINFO_EXTENSION));
        if (in_array($ext, $allowed, true)) $files[] = $f;
    }
    usort($files, function ($a, $b) {
        if ($a === 'README.md') return -1;
        if ($b === 'README.md') return 1;
        return strnatcasecmp($a, $b);
    });
    return $files;
}

function ext_badge($file) {
    $ext = strtoupper(pathinfo($file, PATHINFO_EXTENSION));
    $map = ['HTML' => 'html', 'PHP' => 'php', 'SQL' => 'sql', 'MD' => 'md', 'PDF' => 'pdf'];
    $cls = isset($map[$ext]) ? $map[$ext] : 'md';
    return '<span class="badge ' . $cls . '">' . $ext . '</span>';
}

function file_link($dir, $file, $label = null) {
    $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
    $text = $label !== null ? $label : pretty_name($file);
    if (in_array($ext, ['html', 'php', 'pdf'], true)) {
        $href = ($dir === '' ? '' : $dir . '/') . rawurlencode($file);
        $target = ' target="_blank"';
    } else {
        $href = '?view=' . rawurlencode(($dir === '' ? '' : $dir . '/') . $file);
        $target = '';
    }
    return '<a class="file" href="' . h($href) . '"' . $target . '>'
         . ext_badge($file)
         . '<span class="fname">' . h($text) . '</span>'
         . '<span class="go">&rsaquo;</span></a>';
}

$view = isset($_GET['view']) ? $_GET['view'] : null;

$CSS = <<<CSS
:root {
    --bg: #eef1f8; --card: #ffffff; --ink: #1c2433; --muted: #67718a;
    --line: #e4e8f3; --accent: #3b5bdb; --accent-2: #7048e8;
    --code-bg: #0f172a; --code-ink: #dbe4f5;
    --shadow-1: 0 1px 2px rgba(23,31,54,.05), 0 10px 28px -16px rgba(23,31,54,.22);
    --shadow-2: 0 3px 6px rgba(23,31,54,.06), 0 18px 42px -18px rgba(23,31,54,.30);
}
* { box-sizing: border-box; margin: 0; padding: 0; }
html { scroll-behavior: smooth; }
body { font-family: "Segoe UI", system-ui, -apple-system, sans-serif; background: linear-gradient(180deg, #eef1f8 0%, #e8ecf6 100%); color: var(--ink); line-height: 1.55; min-height: 100vh; }
::selection { background: var(--accent); color: #fff; }
.wrap { max-width: 1120px; margin: 0 auto; padding: 30px 20px 70px; }

/* ── Hero ─────────────────────────────────────────── */
.hero { position: relative; overflow: hidden; border-radius: 20px; padding: 34px 38px 30px; margin-bottom: 26px; color: #fff;
    background: radial-gradient(900px 340px at -5% -20%, rgba(124,86,255,.42), transparent 55%),
                radial-gradient(700px 300px at 105% -15%, rgba(56,140,255,.35), transparent 55%),
                linear-gradient(135deg, #141b3c 0%, #24306b 55%, #3b5bdb 100%);
    box-shadow: var(--shadow-2); }
.hero .kick { display: inline-flex; align-items: center; gap: 7px; background: rgba(255,255,255,.14); border: 1px solid rgba(255,255,255,.30);
    padding: 5px 14px; border-radius: 999px; font-size: 12.5px; font-weight: 700; letter-spacing: .4px; margin-bottom: 14px; }
.hero h1 { font-size: 27px; letter-spacing: .2px; }
.hero p { opacity: .88; margin-top: 7px; font-size: 14.5px; max-width: 700px; }
.hero .chips { margin-top: 16px; display: flex; flex-wrap: wrap; gap: 8px; }
.chip { background: rgba(255,255,255,.13); border: 1px solid rgba(255,255,255,.24); padding: 4px 12px; border-radius: 999px; font-size: 12.5px; }
.chip b { font-weight: 700; }

/* ── Section headers ─────────────────────────────── */
h2.sec { display: flex; align-items: center; gap: 10px; font-size: 14.5px; text-transform: uppercase; letter-spacing: 1.2px; color: var(--muted); margin: 30px 0 14px; }
h2.sec::after { content: ""; flex: 1; height: 1px; background: linear-gradient(90deg, var(--line), transparent); }

/* ── Cards ───────────────────────────────────────── */
.grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 16px; }
.grid2 { display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 16px; }
.card { background: var(--card); border: 1px solid var(--line); border-radius: 16px; overflow: hidden; box-shadow: var(--shadow-1); transition: transform .18s ease, box-shadow .18s ease; }
.card:hover { transform: translateY(-3px); box-shadow: var(--shadow-2); }
.card .head { position: relative; padding: 16px 18px 12px; border-top: 4px solid var(--accent); }
.card .head h3 { font-size: 16.5px; display: flex; align-items: center; gap: 8px; }
.card .head p { font-size: 12.8px; color: var(--muted); margin-top: 4px; padding-right: 68px; }
.count { position: absolute; top: 15px; right: 14px; font-size: 11px; font-weight: 700; color: var(--accent); background: #eef2fe; border: 1px solid #dbe3fb; padding: 3px 9px; border-radius: 999px; white-space: nowrap; }
.files { padding: 6px 10px 12px; }

/* ── File rows ───────────────────────────────────── */
a.file { display: flex; align-items: center; gap: 10px; padding: 8px 10px; border-radius: 10px; text-decoration: none; color: var(--ink); font-size: 14px; transition: background .15s, transform .15s; }
a.file:hover { background: #eef2fe; transform: translateX(3px); }
a.file .fname { flex: 1; }
a.file .go { color: #b9c1da; font-size: 17px; transition: transform .15s, color .15s; }
a.file:hover .go { transform: translateX(3px); color: var(--accent); }

/* ── Badges ──────────────────────────────────────── */
.badge { flex: none; font-size: 10px; font-weight: 700; letter-spacing: .6px; padding: 3px 8px; border-radius: 6px; color: #fff; min-width: 36px; text-align: center; }
.badge.html { background: #ea5f2d; } .badge.php { background: #7a7fb8; } .badge.sql { background: #0b89b0; }
.badge.md { background: #64748b; } .badge.pdf { background: #dc2626; }
.quizcard { border-left: 4px solid var(--accent); }
.past { background: var(--card); border: 1px solid var(--line); border-radius: 16px; padding: 8px 10px; box-shadow: var(--shadow-1); }
.past h4 { font-size: 12.5px; text-transform: uppercase; letter-spacing: .8px; color: var(--muted); padding: 8px 10px 6px; }

/* ── Article (markdown viewer) ───────────────────── */
article { background: var(--card); border: 1px solid var(--line); border-radius: 16px; padding: 34px 40px; box-shadow: var(--shadow-1); }
article h1 { font-size: 24px; margin: 6px 0 14px; }
article h2 { font-size: 19px; margin: 26px 0 10px; padding-top: 14px; border-top: 1px solid var(--line); }
article h3 { font-size: 16px; margin: 20px 0 8px; }
article p { margin: 8px 0; }
article ul { margin: 8px 0 8px 22px; }
article li { margin: 3px 0; }
article a { color: var(--accent); }
article hr { border: none; border-top: 1px solid var(--line); margin: 22px 0; }
article blockquote { border-left: 3px solid var(--accent); background: #f0f3fd; padding: 10px 14px; border-radius: 0 8px 8px 0; margin: 12px 0; }
article code { background: #eef1f8; padding: 1px 5px; border-radius: 5px; font-family: Consolas, "Courier New", monospace; font-size: 13px; }
article pre { background: var(--code-bg); color: var(--code-ink); padding: 14px 16px; border-radius: 10px; overflow-x: auto; margin: 12px 0; }
article pre code { background: none; padding: 0; color: inherit; font-size: 13px; line-height: 1.6; }
article table { border-collapse: collapse; width: 100%; margin: 12px 0; font-size: 13.5px; }
article th, article td { border: 1px solid var(--line); padding: 7px 10px; text-align: left; }
article tr:nth-child(even) { background: #f8f9fd; }
.cb { color: var(--accent); }

/* ── Footer ──────────────────────────────────────── */
.topbar { margin-bottom: 16px; font-size: 14px; }
.topbar a { color: var(--accent); text-decoration: none; font-weight: 600; }
footer { margin-top: 40px; font-size: 12.5px; color: var(--muted); text-align: center; line-height: 2; }
footer code { background: #e8edf8; border: 1px solid var(--line); padding: 2px 7px; border-radius: 6px; }
CSS;

if ($view !== null) {
    $real = realpath($BASE . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $view));
    if ($real === false || strpos($real, $BASE) !== 0 || !is_file($real)) {
        http_response_code(404);
        exit('File not found.');
    }
    $ext = strtolower(pathinfo($real, PATHINFO_EXTENSION));
    if (!in_array($ext, ['md', 'sql', 'txt'], true)) {
        http_response_code(403);
        exit('Not viewable.');
    }
    $content = file_get_contents($real);
    $body = ($ext === 'md') ? render_markdown($content) : '<pre><code>' . h($content) . '</code></pre>';
    $title = pretty_name(basename($real));
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= h($title) ?> — Web Programming Revision</title>
<style><?= $CSS ?></style>
</head>
<body>
<div class="wrap">
    <div class="topbar"><a href="index.php">&larr; Back to all files</a></div>
    <article><?= $body ?></article>
</div>
</body>
</html>
    <?php
    exit;
}

$mockFiles = scan_dir($BASE, '', ['md']);
$mockFiles = array_values(array_filter($mockFiles, function ($f) { return strpos($f, 'Mock-Quiz') === 0; }));

// Final exam papers (PDF) — kept at the TOP of the page
$paperFiles = [];
foreach (glob($BASE . DIRECTORY_SEPARATOR . 'Final-Questions' . DIRECTORY_SEPARATOR . '*.pdf') as $p) $paperFiles[] = ['Final-Questions', basename($p)];
sort($paperFiles);

// Cheat sheet lives in the top Toolkit card now; keep only the sample/mock PDF down here
$pdfFiles = [];
foreach (glob($BASE . DIRECTORY_SEPARATOR . '*.pdf') as $p) {
    if (basename($p) !== 'Final_CheatSheet.pdf') $pdfFiles[] = ['', basename($p)];
}
sort($pdfFiles);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Web Programming — Revision Hub</title>
<style><?= $CSS ?></style>
</head>
<body>
<div class="wrap">

    <div class="hero">
        <span class="kick">📣 FINAL EXAM TOMORROW — question papers pinned at the top</span>
        <h1>CSE 4165 — Web Programming Revision Hub</h1>
        <p>Every final paper (Fall 2024 → Spring 2026) solved and verified, drills in exam order, mock-quiz material moved to the bottom. Work top to bottom tonight.</p>
        <div class="chips">
            <span class="chip"><b>Final:</b> 3 questions &middot; 30 marks &middot; 2 hours</span>
            <span class="chip"><b>Q1</b> JavaScript &middot; <b>Q2</b> PHP &middot; <b>Q3</b> PHP+MySQL</span>
            <span class="chip">📄 6 papers × 3 Qs — all solved</span>
            <span class="chip">XAMPP MySQL :3307</span>
        </div>
    </div>

    <h2 class="sec">🏆 Final Exam Papers &amp; Toolkit — start here</h2>
    <div class="grid2">
        <div class="past">
            <h4>📄 Question Papers (PDF)</h4>
            <?php foreach ($paperFiles as $p): ?>
                <?= file_link($p[0], $p[1]) ?>
            <?php endforeach; ?>
        </div>
        <div class="past">
            <h4>🧭 Exam Toolkit</h4>
            <?= file_link('', 'Final_Exam_Analysis.md', 'Final Exam Analysis — what repeats on every paper &amp; attack strategy') ?>
            <?= file_link('', 'cheatsheet.html', 'Cheat sheet — interactive HTML version') ?>
            <?= file_link('', 'Final_CheatSheet.pdf', 'Cheat sheet — print version (2 pages A4)') ?>
        </div>
    </div>

    <h2 class="sec">📚 Study Folders</h2>
    <div class="grid">
        <?php foreach ($sections as $dir => $meta): ?>
        <?php $fs = scan_dir($BASE, $dir, ['md', 'html', 'php', 'sql']); ?>
        <div class="card">
            <div class="head" style="border-top-color: <?= $meta['color'] ?>">
                <h3 style="color: <?= $meta['text'] ?>"><span><?= $meta['icon'] ?></span><?= h($meta['title']) ?></h3>
                <p><?= h($meta['desc']) ?></p>
                <span class="count"><?= count($fs) ?> files</span>
            </div>
            <div class="files">
                <?php foreach ($fs as $f): ?>
                    <?= file_link($dir, $f, $f === 'README.md' ? 'Guide — read this first' : null) ?>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <?php if (!empty($mockFiles)): ?>
    <h2 class="sec">Mock Quiz — only after the final drilling is done</h2>
    <div class="card quizcard" style="margin-bottom:4px">
        <div class="files" style="padding-top:12px">
            <?php foreach ($mockFiles as $f): ?>
                <?= file_link('', $f, $f === 'Mock-Quiz-1-ANSWER-KEY.md' ? 'Answer Key — do not open until time is up' : pretty_name($f)) ?>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>

    <?php if (!empty($pdfFiles)): ?>
    <h2 class="sec">🃏 Sample Quiz Question (PDF)</h2>
    <div class="past">
        <?php foreach ($pdfFiles as $p): ?>
            <?= file_link($p[0], $p[1]) ?>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <footer>
        Reset databases: <code>Get-Content MySQL\01_schema.sql | &amp; "G:\xampp\mysql\bin\mysql.exe" -u root -P 3307</code><br>
        Run PHP files: <code>&amp; "G:\xampp\php\php.exe" -S localhost:8000</code> from the PHP folder
    </footer>

</div>
</body>
</html>
