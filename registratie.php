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
            $message = 'You have registered';
            showThankYou($allValuesandErrors, $formArray, $message);
        } else {
            showForm($page, $css, $formArray, $allValuesandErrors);
        }
    }
?>



<!-- Voeg nu een register pagina toe aan je webshop als op deze menu optie wordt geklikt.

    Het register scherm kent een invoerveld voor naam, e-mail, password en 
    herhaal password en een verstuur-knop.

Als de data van het registratie formulier binnenkomt, wordt gecontroleerd of alle 
velden zijn ingevuld, valide zijn, en of de password en herhaal password velden overeen komen:

    Als alle velden valide zijn en het password en herhaal password komen overeen, 
    wordt er gecontroleerd of het email adres al voorkomt in de users.txt file.

        Is het email adres al bekend wordt het registratie formulier opnieuw getoond 
        en wordt er een foutmelding bij de email gezet dat deze al bekend is.

        Is het email adres onbekend, dan wordt er een nieuwe regel toegevoegd aan de 
        users.txt file met de ingevulde data.
        
    Als niet alle velden valide zijn of de passworden komen niet overeen, dan wordt 
    het formulier weer getoond met de reeds ingevulde waarden en een foutmelding 
    achter de velden die niet correct zijn.
 -->
