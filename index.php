<?php
$file = 'main';
$pageContent = renderTemplate("$file.php");

$layoutContent = renderTemplate('headerFooter.php', ['directory' => $file,'content' => $pageContent, 'title' => 'Guitars&\m/']);

print($layoutContent);

function renderTemplate(string $filename, $tags = NULL) : string {
    $s = file_get_contents($filename);
    if ($tags != NULL) {
        foreach ($tags as $key => $value) {
            $s = str_replace("<?= $key; ?>", $value, $s);
        }
    }
    return $s;
}