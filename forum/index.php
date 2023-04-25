<?php
$pageContent = renderTemplate("main.php");
$layoutContent = renderTemplate('../header_footer.php',
    ['content' => $pageContent, 'title' => 'Forum for guitarists', 'directory' => '../header_footer.css']);

echo $layoutContent;

function renderTemplate(string $filename, $tags = NULL) : string {
    $s = file_get_contents($filename);
    if ($tags != NULL) {
        foreach ($tags as $key => $value) {
            if ($key === 'directory') {
                $s = str_replace("<!-- $key -->", "<link rel=\"stylesheet\" href=\"$value\"/>", $s);
            }
            $s = str_replace("<!-- $key -->", $value, $s);
        }
    }
    return $s;
}