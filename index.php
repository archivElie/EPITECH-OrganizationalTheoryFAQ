<?php

if (isset($_GET['hide']) == FALSE)
echo "
<!DOCTYPE html>
<html>
<head>
<title>FAQ  Organizationnal theory</title>
<link rel=\"stylesheet\" href=\"style/index.css?id=347\">
<link rel=\"icon\" type=\"image/png\" href=\"assets/picture/logo.png\"/>
</head>
<body>
<div class=\"debug\">
";


session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once 'src/core/index_core.php';

echo "
</div> 
<div class=\"contenair\">
<header class=\"page-header\">
<div>
<h1>FAQ ORG THEORY</h1>";


echo <<<HTML
<ul>
<li><a href="index.php?pages=home">Home</a></li>
</ul>
HTML;

echo "</div></header>

<div class=\"contentBody\">
<div class=\"content\">

";

if (isset($_GET["pages"]))
{
    $pages = htmlspecialchars($_GET["pages"]);
    $tmp = 0;
    $ta = $_SESSION["IndexCore"]->get_all_files_php("sheets/");
    
    foreach ($ta as $l){
        //        if (strpos($l, $pages.".php") === 0)
        {
            $tmp = 1;
            include ("sheets/".$l);
        }
        
    }
    if ($tmp === 0)
    echo "Error 404<br>";
    
}

if (isset($_GET['hide']) == FALSE)	    
echo"	
</div> <!-- for content item -->
</div> <!-- for contentBox -->";







echo "
</div> <!-- for container -->
</body>

</html> 
";