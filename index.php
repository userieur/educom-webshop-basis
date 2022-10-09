<?php
    require_once("Functions/functions.php");
    echo ($_SERVER["PHP_SELF"]);
    echo var_dump($_SERVER);
    $page = getRequestedPage();
    $pageTitle = createTitle($page);
    showResponsePage($page, $pageTitle);
?>