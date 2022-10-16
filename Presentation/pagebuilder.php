<?php
    // Identifying the requested page + all functions
    require_once("Business/basics.php");
    require_once("Business/validation.php");


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

    function processRequest($page) {
        require_once('Pages/'.$page.'.php');
        $data = "";
        switch ($page) {
            case 'contact':
                $formArray = getContactData()['formArray'];
                $fileString = getContactData()['fileString'] ?? NULL;
                $data = validateForm($formArray);
                if ($data['validForm']) {
                    $page = 'thanks';
                }
                break;
            case 'registratie':
                $formArray = getRegData()['formArray'];
                $fileString = getRegData()['fileString'] ?? NULL;
                $data = validateForm($formArray, $fileString);
                if ($data['validForm']) {
                    $username = $data['uname']['value'];
                    $email = $data['email']['value'];
                    $password = $data['pword']['value'];
                    $userinfo = array($email, $username, $password);
                    storeUser($fileString, $userinfo);
                    $page = 'login';
                    $data = NULL;
                }
                break;
            case 'login':
                $formArray = getLoginData()['formArray'];
                $fileString = getLoginData()['fileString'] ?? NULL;
                $data = validateForm($formArray, $fileString);
                if ($data['validForm']) {
                    $page = 'home';
                    $data = NULL;
                }
                break;
            case 'thanks':
                //logoout
                break;
            default:
                //default
                break;
            }
        return (array('page' => $page, 'data' => $data));
    }

    // Constructing the requested page + all functions
    function showResponsePage($page, $pageTitle, $data) {
        beginDocument(); 
        showHeadSection($pageTitle); 
        showBodySection($page, $data); 
        endDocument(); 
    }

    function beginDocument() { 
        echo '<!doctype html> 
              <html>';
    } 

    function createTitle($page) {
        // $pageString = 'Pages/'.$page.'.php';
        // require_once($pageString);
        // $pagetitle = getTitle();
        $pagetitle = "doe ik weer met OOP";
        return $pagetitle;
    }

    function showHeadSection($pageTitle) {
        echo '<head>
                <title>' . $pageTitle . '</title>
                <link rel="stylesheet" href="Presentation/stylesheet.css">
              </head>';
    } 

    function showBodySection($page, $data) {
        echo '    <body>' . PHP_EOL; 
        showHeader($page);
        showMenu($page); 
        showContent($page, $data); 
        showFooter(); 
        echo '    </body>' . PHP_EOL; 
    } 

    function endDocument() { 
        echo  '</html>'; 
    } 

    function showHeader($page) { 
        require_once('Pages/'.$page.'.php');
        switch ($page) {
            case 'home':
                showHomeHeader();
                break;
            case 'about':
                showAboutHeader();
                break;
            case 'contact':
                showContactHeader();
                break;
            case 'registratie':
                showRegHeader();
                break;
            case 'thanks':
                showThanksHeader();
                break;
            case 'login':
                break;
            default:
                echo 'oepsiedasy';
                break;
        $pageString = 'Pages/'.$page.'.php';
        require_once($pageString);
        showPageHeader();
        }
    }


    function showMenu($page) { 
        echo '<ul class="menu">
                <li><a class="' . (($page == "home") ? "active" : "") . '"href="index.php?page=home">Home</a></li>
                <li><a class="' . (($page == "about") ? "active" : "") . '"href="index.php?page=about">About</a></li>
                <li><a class="' . (($page == "contact") ? "active" : "") . '"href="index.php?page=contact">Contact</a></li>
                <li><a class="' . (($page == "registratie") ? "active" : "") . '"href="index.php?page=registratie">Registratie</a></li>
                <li><a class="' . (($page == "login") ? "active" : "") . '"href="index.php?page=login">Login</a></li>
              </ul>';        
    }

    function showContent($page, $data) { 
        require_once('Pages/'.$page.'.php');
        switch ($page) { 
            case 'home':
                showHomeContent();
                break;
            case 'about':
                showAboutContent();
                break;
            case 'contact':
                $data = $data ?? getContactData()['formArray'];
                showContactContent($page, $data);
                break;
            case 'registratie':
                $data = $data ?? getRegData()['formArray'];
                showRegContent($page, $data);
                break;
            case 'thanks':
                // var_dump($data);
                $data = $data ?? getContactData()['formArray'];
                // var_dump($data);
                showThanksContent($data);
                break;
            case 'login':
                $data = $data ?? getLoginData()['formArray'];
                showLoginContent ($page, $data);
                break;
            default:
                require_once('Pages/home.php');
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