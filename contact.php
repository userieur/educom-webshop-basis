<!DOCTYPE html>
<html lang="nl-NL">
<html>
    <head>
        <title>Contact</title>
        <link rel="stylesheet" href="CSS/stylesheet.css">
    </head>
    <body>
    <?php
        require_once("Validations/validation.php");
            var_dump($_POST);
            $valid_form = False;
            $fname = $lname = $email = $phone = $sex = $pref = $story = "";
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $fname = validate_input("fname", "name");
                $lname = validate_input("lname", "name");
                $email = validate_input("email", "email");
                $phone = validate_input("phone", "phone");
                $sex = validate_input("sex", "select_one");
                $pref = validate_input("pref", "select_one");
                $story = validate_input("story", "none");
                $valid_form = check_no_errors($fname, $lname, $email, $phone, $sex, $pref);
                if (inarray(false, $desired_input_check, true) === false) {
                    $valid_form = True;
                }
            }
        ?>
        <h1>Contact</h1>
        <div>
            <ul class="menu">
                <li><a href="index.html">HOME</a></li>
                <li><a href="about.html">ABOUT</a></li>
                <li><a class="active" href="contact.php">CONTACT</a></li>
            </ul> 
        </div>
        <?php /* if ($valid_form == False) { */?> 
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form">
                <div>
                    <label class="otherlabel" for="sex">Aanhef:</label>
                    <select required name="sex" id="sex" placeholder="...">
                        <option value="" disabled>Kies</option>
                        <option <?php if ($sex["value"]=="man") echo "selected";?> value="man">Dhr.</option>
                        <option <?php echo ($sex["value"]=="woman") ? "selected" : "";?> value="woman">Mevr.</option>
                    </select>
                    <span class="error"><? echo $sex["error"] ?></span>
                </div>
                <label class="otherlabel" for="fname">Voornaam:</label>
                <input  type="text" 
                        id="fname" 
                        name="fname" 
                        value="<?php echo $fname;?>" 
                        placeholder="Jan">
                        <br>
                
                <label class="otherlabel" for="lname">Achternaam:</label>
                <input type="text" id="lname" name="lname" value="<?php echo $lname;?>" placeholder="van der Straat"><br>
                
                <label class="otherlabel" for="email">E-Mail Adres:</label>
                <input type="email" id="email" name="email" value="<?php echo $email;?>" placeholder="jan.vanderstraat@provider.com"><br>
                
                <label class="otherlabel" for="phone">Telefoonnummer:</label>
                <input type="tel" id="phone" name="phone" pattern="[0-9]{2}[0-9]{8}|[0-9]{3}[0-9]{7}" value="<?php echo $phone;?>" placeholder="06 12345678 / 010 1234567" ><br>
                
                <p>Ik word het liefst benaderd via:</p>
                <input type="radio" id="tel" name="pref" <?php if (isset($pref) && $pref=="Telefoon") echo "checked";?> value="Telefoon">
                <label for="tel">Telefoon</label>
                <input type="radio" id="mail" name="pref" <?php if (isset($pref) && $pref=="E-Mail") echo "checked";?> value="E-Mail">
                <label for="mail">E-Mail</label><br>
                <br>
                <label for="story">Reden van contact:</label><br>
                <textarea id="story" name="story" rows="4" cols="50" value="<?php echo $story;?>" placeholder="reden van contact"></textarea>
                <input type="submit" value="Verstuur">
            </div>
                <br>
            <br><br>
        </form>         
        <div class="footer">
            <p>Copyright &copy; <script>document.write(new Date().getFullYear())</script> Roland Felt</p>
        </div>    
    </body>
</html>


</body>
</html> 