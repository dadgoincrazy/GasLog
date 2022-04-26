<?php
require_once(INC_PATH . 'header.php');

echo "<body>";

echo "<div id='page'>";

echo $nav;

echo "<div id='content-container'>";
echo "<div id='content'>";
echo $html;
echo "</div></div>";

echo "</div>"; // End #page

echo "</body>";

require_once(INC_PATH . 'footer.php');
?>