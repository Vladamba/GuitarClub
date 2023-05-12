<?php
$pageContent = renderTemplate("main.php");
$layoutContent = renderTemplate('../header_footer.php',
    ['content' => $pageContent, 'title' => 'Guitars&\m/', 'directory' => '../header_footer.css']);

echo $layoutContent;

function renderTemplate(string $filename, $tags = NULL) : string {
    $s = file_get_contents($filename);
    if ($tags == NULL) {
        return $s;
    }
    foreach ($tags as $key => $value) {
        if ($key === 'directory') {
            $s = str_replace("<!-- $key -->", "<link rel=\"stylesheet\" href=\"$value\"/>", $s);
        }
        $s = str_replace("<!-- $key -->", $value, $s);
    }
    return $s;
}