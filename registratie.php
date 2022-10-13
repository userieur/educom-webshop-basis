<?php
    
    require_once("functions/validation.php");
    require_once("functions/formbuilder.php");

    function showRegistratieHeader() {
        echo '<h1>Halloooooooo</h1>';
    }

    function showRegistratieContent($page) {
        // $css             = should contain desired style for this form | use 'contactform' for default
        // key              = unique
        // type             = text / email / phone / select / radio / textbox / password
        // label            = label (@select / @radio is for the group)
        // placeholder      = placeholder (@select: standard option which cannot be selected @radio should be '')
        // options          = ONLY for @radio & @select: array('option id/value' => "Printed Value")
        //                    array('man' => "Mr.", woman = "Ms.") /
        //                    array('tel' => "Telephone", 'mail' => "E-Mail")
        $validForm = false;
        $allValuesandErrors = "";
        $css = 'contactform';
        $formArray = array(
            //    key            type         label                    placeholder / options
            array('uname'      , 'text'     , 'Gebruikersnaam:'      , 'Jan'),
            array('email'      , 'email'    , 'E-Mail:'              , 'j.v.d.steen@provider.com'),
            array('pword'      , 'password' , 'Wachtwoord:'          , 'vul wachtwoord in'),
            array('pwordcheck' , 'password' , 'Herhaal Wachtwoord:'  , 'herhaal wachtwoord'),
        );
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $output = validateForm($formArray);
            $allValuesandErrors = $output[0];
            $validForm = $output[1];
        }

        if ($validForm) {
            // Check bestaande data
            // Als het nog niet bestaad creeer nieuwe entry en stuur dank pagina
            // Anders is allvaluesanderrors email email bestaat al
            
            $message = 'You have registered';
            showThankYou($allValuesandErrors, $formArray, $message);
        } else {
            showForm($page, $css, $formArray, $allValuesandErrors);
        }
    }
?>


