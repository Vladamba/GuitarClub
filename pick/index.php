<?php
$content = file_get_contents('main.tpl');
$header_footer = file_get_contents('../header_footer.tpl');
$header_footer = str_replace('{content}', $content, $header_footer);
echo $header_footer;