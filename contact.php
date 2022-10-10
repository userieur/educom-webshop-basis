<?php
    require_once("functions/validation.php");
    require_once("functions/formbuilder.php")
    
    function showContactHeader () {
        echo '<h1>Contact Us</h1>';
    }

    function showContactContent($page) {
        // $css             = should contain desired style for this form | use 'contactform' for default
        // key              = unique
        // type             = text / email / phone / select / radio / textbox
        // label            = label (@select / @radio is for the group)
        // placeholder      = placeholder (@select: standard option which cannot be selected @radio should be '')
        // options          = ONLY for @radio & @select: array('option id/value' => "Printed Value")
        //                    array('man' => "Mr.", woman = "Ms.") /
        //                    array('tel' => "Telephone", 'mail' => "E-Mail")
        $css = 'contactform';
        $formArray = array(
            //    key       type        label                                placeholder / options
            array('sex'   , 'select'  , 'Aanhef:'                          , 'Kies'
                                                                           ,  array('man'   => "Dhr."
                                                                           ,        'woman' => "Mevr.")),
            array('fname' , 'text'    , 'Voornaam:'                        , 'Jan'),
            array('lname' , 'text'    , 'Achternaam:'                      , 'van der Steen'),
            array('email' , 'email'   , 'E-Mail:'                          , 'j.v.d.steen@provider.com'),
            array('phone' , 'phone'   , 'Telefoon:'                        , '0612345678 / 0101234567'),
            array('pref'  , 'radio'   , 'Ik word het liefst benaderd via:' , ''
                                                                           ,  array('tel'   => "Telefoon"
                                                                           ,        'mail'  => "E-Mail")),
            array('story' , 'textbox' , 'Reden van contact:'               , 'Jan'),
        );

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $output = validateForm($formArray);
            $allValuesandErrors = $output[0];
            $validForm = $output[1];
        }

        if ($validForm) {
            showThankYou($allValuesandErrors);
        } else {
            showForm($page, $css, $formArray);
        }
    }

?>



