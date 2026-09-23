<?php
$BASE = __DIR__;

$sections = [
    'JavaScript' => ['title' => 'JavaScript', 'desc' => 'Q1 — random numbers, DOM, conditionals, loops', 'color' => '#f0db4f', 'text' => '#8a6d00'],
    'PHP'        => ['title' => 'PHP',        'desc' => 'Q2 — classes, forms, ceil() word problems',      'color' => '#777bb4', 'text' => '#4b4e8f'],
    'MySQL'      => ['title' => 'MySQL',      'desc' => 'Q3 — queries, updates, PHP mysqli bridge',        'color' => '#00758f', 'text' => '#00566a'],
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
    --bg: #f4f6fb; --card: #ffffff; --ink: #1e2433; --muted: #6b7280;
    --line: #e6e9f2; --accent: #3b5bdb; --code-bg: #101728; --code-ink: #dbe4f3;
}
* { box-sizing: border-box; margin: 0; padding: 0; }
body { font-family: "Segoe UI", system-ui, -apple-system, sans-serif; background: var(--bg); color: var(--ink); line-height: 1.55; }
.wrap { max-width: 1080px; margin: 0 auto; padding: 28px 20px 60px; }
.hero { background: linear-gradient(135deg, #1b2559 0%, #3b5bdb 100%); color: #fff; border-radius: 16px; padding: 30px 32px; margin-bottom: 24px; }
.hero h1 { font-size: 26px; letter-spacing: .2px; }
.hero p { opacity: .85; margin-top: 6px; font-size: 14.5px; }
.hero .chips { margin-top: 14px; display: flex; flex-wrap: wrap; gap: 8px; }
.chip { background: rgba(255,255,255,.15); border: 1px solid rgba(255,255,255,.25); padding: 3px 10px; border-radius: 999px; font-size: 12.5px; }
h2.sec { font-size: 15px; text-transform: uppercase; letter-spacing: 1.2px; color: var(--muted); margin: 26px 0 12px; }
.grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 18px; }
.card { background: var(--card); border: 1px solid var(--line); border-radius: 14px; overflow: hidden; box-shadow: 0 1px 2px rgba(16,24,40,.05); }
.card .head { padding: 16px 18px 12px; border-top: 4px solid var(--accent); }
.card .head h3 { font-size: 17px; }
.card .head p { font-size: 13px; color: var(--muted); margin-top: 3px; }
.files { padding: 6px 10px 12px; }
a.file { display: flex; align-items: center; gap: 10px; padding: 8px 10px; border-radius: 9px; text-decoration: none; color: var(--ink); font-size: 14px; }
a.file:hover { background: #eef1fb; }
a.file .fname { flex: 1; }
a.file .go { color: #b6bdd4; font-size: 18px; }
.badge { font-size: 10px; font-weight: 700; letter-spacing: .6px; padding: 3px 7px; border-radius: 6px; color: #fff; }
.badge.html { background: #e34f26; } .badge.php { background: #777bb4; } .badge.sql { background: #00758f; }
.badge.md { background: #64748b; } .badge.pdf { background: #b91c1c; }
.quizcard { border-left: 4px solid var(--accent); }
.past { background: var(--card); border: 1px solid var(--line); border-radius: 14px; padding: 8px 10px; }
footer { margin-top: 34px; font-size: 12.5px; color: var(--muted); text-align: center; }
footer code { background: #e8ecf7; padding: 2px 6px; border-radius: 5px; }
.topbar { margin-bottom: 18px; font-size: 14px; }
.topbar a { color: var(--accent); text-decoration: none; font-weight: 600; }
article { background: var(--card); border: 1px solid var(--line); border-radius: 14px; padding: 34px 40px; }
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

$pdfFiles = [];
foreach (glob($BASE . DIRECTORY_SEPARATOR . '*.pdf') as $p) $pdfFiles[] = ['', basename($p)];
foreach (glob($BASE . DIRECTORY_SEPARATOR . 'Final-Questions' . DIRECTORY_SEPARATOR . '*.pdf') as $p) $pdfFiles[] = ['Final-Questions', basename($p)];
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
        <h1>CSE 4165 — Web Programming Revision Hub</h1>
        <p>Final + Quiz study pack — every past-paper question, solved and verified.</p>
        <div class="chips">
            <span class="chip">Quiz: 3 questions &middot; 20 min &middot; written</span>
            <span class="chip">JavaScript &middot; PHP &middot; MySQL</span>
            <span class="chip">XAMPP MySQL :3307</span>
        </div>
    </div>

    <?php if (!empty($mockFiles)): ?>
    <h2 class="sec">Mock Quiz</h2>
    <div class="card quizcard" style="margin-bottom:4px">
        <div class="files" style="padding-top:12px">
            <?php foreach ($mockFiles as $f): ?>
                <?= file_link('', $f, $f === 'Mock-Quiz-1-ANSWER-KEY.md' ? 'Answer Key — do not open until time is up' : pretty_name($f)) ?>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>

    <h2 class="sec">Study Folders</h2>
    <div class="grid">
        <?php foreach ($sections as $dir => $meta): ?>
        <div class="card">
            <div class="head" style="border-top-color: <?= $meta['color'] ?>">
                <h3 style="color: <?= $meta['text'] ?>"><?= h($meta['title']) ?></h3>
                <p><?= h($meta['desc']) ?></p>
            </div>
            <div class="files">
                <?php foreach (scan_dir($BASE, $dir, ['md', 'html', 'php', 'sql']) as $f): ?>
                    <?= file_link($dir, $f, $f === 'README.md' ? 'Guide — read this first' : null) ?>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <?php if (!empty($pdfFiles)): ?>
    <h2 class="sec">Past Papers (PDF)</h2>
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
