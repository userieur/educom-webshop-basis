<?php
    // Identifying the requested page + all functions
    function getRequestedPage() {     
        $requested_type = $_SERVER['REQUEST_METHOD']; 
        if ($requested_type == 'POST') { 
            $requested_page = getPostVar('page','home'); 
        } else { 
            $requested_page = getUrlVar('page','home'); 
        } 
        return $requested_page;
        // returns name of page, such as 'about', or 'home' if page is invalid 
    }

    function getPostVar($key, $default='') { 
        $value = filter_input(INPUT_POST, $key); 
        return isset($value) ? $value : $default; 
    } 

    function getUrlVar($key, $default='') { 
        $value = filter_input(INPUT_GET, $key);
        return isset($value) ? $value : $default;  
    }

    // Constructing the requested page + all functions
    function showResponsePage($page, $pageTitle) {
        beginDocument(); 
        showHeadSection($pageTitle); 
        showBodySection($page); 
        endDocument(); 
    }

    function beginDocument() { 
        echo '<!doctype html> 
              <html>';
    } 

    function createTitle($page) {
        if ($page == 'about') {
            $pageTitle = 'About the Awesome Exploits of A Junior Programmer';
        } elseif ($page == 'home') {
            $pageTitle = 'Home is where you feel safe';
        } elseif ($page == 'contact') {
            $pageTitle = 'All your data are belong to (contact) us';
        } else {
            $pageTitle = ucfirst($page);
        }
        return $pageTitle;
    }

    function showHeadSection($pageTitle) {
        echo '<head>
                <title>' . $pageTitle . '</title>
                <link rel="stylesheet" href="CSS/stylesheet.css">
              </head>';
    } 

    function showBodySection($page) { // Zou je niet hier eenmaal de switch doen? Omdat je toch maar 1 pagina per keer kan openen
        // Als je dan callHeader en callBody functies maakt en die overal hetzelfde noemt, hoef je niet in elke subfunctie apart
        // showXHeader of showXBody of showXY te doen
        echo '    <body>' . PHP_EOL; 
        showHeader($page);
        showMenu($page); 
        showContent($page); 
        showFooter(); 
        echo '    </body>' . PHP_EOL; 
    } 

    function endDocument() { 
        echo  '</html>'; 
    } 

    function showHeader($page) { 
        switch ($page) { 
            case 'home':
                require_once('home.php');
                showHomeHeader();
                break;
            case 'about':
                require_once('about.php');
                showAboutHeader ();
                break;
            case 'contact':
                require_once('contact.php');
                showContactHeader ();
                break;
            case 'registratie':
                require_once('registratie.php');
                showRegistratieHeader ();
                break;
            default:
                require_once('home.php');
                showHomeHeader();
                break;
        }   
    } 

    function showMenu($page) { 
        echo '<ul class="menu">
                <li><a class="' . (($page == "home") ? "active" : "") . '"href="index.php?page=home">Home</a></li>
                <li><a class="' . (($page == "about") ? "active" : "") . '"href="index.php?page=about">About</a></li>
                <li><a class="' . (($page == "contact") ? "active" : "") . '"href="index.php?page=contact">Contact</a></li>
                <li><a class="' . (($page == "registratie") ? "active" : "") . '"href="index.php?page=registratie">Registratie</a></li>
              </ul>';        
    }

    function showContent($page) { 
        switch ($page) { 
            case 'home':
                require_once('home.php');
                showHomeContent();
                break;
            case 'about':
                require_once('about.php');
                showAboutContent ();
                break;
            case 'contact':
                require_once('contact.php');
                showContactContent ($page);
                break;
            case 'registratie':
                require_once('registratie.php');
                showRegistratieContent ($page);
                break;
            default:
                require_once('home.php');
                showHomeContent();
                break;
        }     
    } 

    function showFooter() {
        echo ' 
            <footer>
                <p>Copyright &copy; <script>document.write(new Date().getFullYear())</script> Roland Felt</p>
            </footer>
            ';
    } 
?>