<?php
    require_once("Validations/validation.php");
    
    function showContactHeader () {
        echo '<h1>Contact Us</h1>';
    }

    function showContactContent() {
        $validForm = false;
        $fname = $lname = $email = $phone = $sex = $pref = $story = "";
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $output = checkForErrors('fname', 'lname', 'email', 'phone', 'sex', 'pref', 'story');
            $allValuesandErrors = $output[0];
            $validForm = $output[1];
            $fname = $output['fname'];
            $lname = $output['lname'];
            $email = $output['email'];
            $phone = $output['phone'];
            $sex = $output['sex'];
            $pref = $output['pref'];
            $story = $output['story'];
        }
        if ($validForm) {
            echo'
                <h3>You are Amazing</h3>
                <h5>The data you entered:</h5>
                <div>
                    <p>Voornaam:</p><br>' . $fname['value'] . '
                    <p>Achternaam:</p><br>' . $lname['value'] . '
                    <p>E-Mail Adres:</p><br>' . $email['value'] . '
                    <p>Telefoon:</p><br>' . $phone['value'] . '
                    <p>Geslacht:</p><br>' . $sex['value'] . '
                    <p>Communicatievoorkeur:</p><br>' . $pref['value'] . '
                    <p>Reden van contact:</p><br>' . $story['value'] . '
                </div>
            ';
        } else {
            echo '
                <h3>Contactform
                <h5>Voor je shit hieronder in:</h5>
                <form method="POST" action="index.php">
                    <div class="form">

                        <label class="otherlabel" for="sex">Aanhef:</label>
                        <select required name="sex" id="sex" placeholder="...">
                            <option selected value="" disabled>Kies</option>
                            <option ' . ((isset($sex['value']) && $sex['value'] == 'man') ? "selected" : "") . 'value="man">Dhr.</option>
                            <option ' . ((isset($sex['value']) && $sex['value'] == 'woman') ? "selected" : "") . 'value="woman">Mevr.</option>
                        </select><br>
                        <span class="error">' . (isset($sex['error']) ? $sex['error'] : "") . '</span>

                        <label class="otherlabel" for="fname">Voornaam:</label>
                        <input  
                            type="text" id="fname" name="fname" 
                            value="' . (isset($fname['value']) ? $fname['value'] : "") . '"
                            placeholder="Jan"><br>
                        <span class="error">' . (isset($fname['error']) ? $fname['error'] : "") . '</span>

                        <label class="otherlabel" for="lname">Achternaam:</label>
                        <input  
                            type="text" id="lname" name="lname" 
                            value="' . (isset($lname['value']) ? $lname['value'] : "") . '"
                            placeholder="van der Straat"><br>
                        <span class="error">' . (isset($lname['error']) ? $lname['error'] : "") . '</span>

                        <label class="otherlabel" for="email">E-Mail Adres:</label>
                        <input  
                            type="email" id="email" name="email" 
                            value="' . (isset($email['value']) ? $email['value'] : "") . '"
                            placeholder="jan.vanderstraat@provider.com"><br>
                        <span class="error">' . (isset($email['error']) ? $email['error'] : "") . '</span>

                        <label class="otherlabel" for="phone">Telefoon:</label>
                        <input
                            type="phone" id="phone" name="phone" pattern="[0-9]{2}[0-9]{8}|[0-9]{3}[0-9]{7}
                            value="' . (isset($phone['value']) ? $phone['value'] : "") . '"
                            placeholder="0612345678 / 0101234567"
                        <span class="error">' . (isset($phone['error']) ? $phone['error'] : "") . '</span>

                        <p>Ik word het liefst benaderd via:</p>
                        <input type="radio" id="tel" name="pref" ' . ((isset($pref['value']) && $pref['value'] == 'Telefoon') ? "checked" : "") . 'value="Telefoon">
                        <label for="tel">Telefoon</label>
                        <input type="radio" id="mail" name="pref" ' . ((isset($pref['value']) && $pref['value'] == 'E-Mail') ? "checked" : "") . 'value="E-Mail">
                        <label for="mail">E-Mail</label><br>
                        <br>

                        <label for="story">Reden van contact:</label><br>
                        <textarea id="story" name="story" rows="4" cols="50" 
                                  value="' . (isset($story['value']) ? $story['value'] : ""). '" 
                                  placeholder="reden van contact"></textarea>

                        <input type="submit" value="Verstuur">
                    </div>
                </form>
            ';
        }
    }    
?>