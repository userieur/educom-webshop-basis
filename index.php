<?php
    require_once("Presentation/pagebuilder.php");
    require_once("Business/basics.php");
    // echo ($_SERVER["PHP_SELF"]);
    // echo var_dump($_SERVER);

    $data=NULL;
    $page = getRequestedPage();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $processed = processRequest($page);
        // var_dump($processed);
        $page = $processed['page'];
        // echo($page);
        $data = $processed['data'];
        // var_dump($data);
    }
    $pageTitle = createTitle($page);
    showResponsePage($page, $pageTitle, $data);

    // VAR-DUMP Template
    // echo '<br> Ik ben bij ************ : <br>';
    // var_dump($*********);


?>