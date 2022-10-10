<?php
    function showRegistratieHeader() {
        echo '<h1>Halloooooooo</h1>';
    }

    function showRegistratieContent() {
        echo '<h3>Lorem Ipsum</h3>
              <div>
                    <p>"Lorem ipsum dolor sit amet, consectetur <br> adipiscing elit, sed do eiusmod tempor 
                    incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis
                    nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
                    Duis aute irdfgsdfgdfgdfgdzxure dolor in reprehenderit in voluptate velit esse cillum dolore 
                    eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt
                    in culpa qui officia deserunt mollit anim id est laborum."</p>
              </div>';
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
