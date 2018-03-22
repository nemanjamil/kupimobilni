<?php
if(isset($_GET['stranica'])) {  $stranica = filter_input(INPUT_GET, 'stranica', FILTER_SANITIZE_STRING); } else { $stranica = ''; }
if(isset($_GET['string'])) {  $string = filter_input(INPUT_GET, 'string', FILTER_SANITIZE_STRING); } else { $string = ''; }

if ($_POST) {

    if (isset($_POST['br'])) {  $br = filter_input(INPUT_POST, 'br', FILTER_SANITIZE_NUMBER_INT);  } else {  $br = '';   }
    if (isset($_POST['id'])) {  $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);  } else {  $id = '';   }

    if (isset($_POST['brSpec'])) {  $brSpec = filter_input(INPUT_POST, 'brSpec', FILTER_SANITIZE_NUMBER_INT);  } else {  $brSpec = '';   }
    if (isset($_POST['idSpec'])) {  $idSpec = filter_input(INPUT_POST, 'idSpec', FILTER_SANITIZE_NUMBER_INT);  } else {  $idSpec = '';   }



    if (isset($_POST['naziv'])) {  $naziv = filter_input(INPUT_POST, 'naziv', FILTER_SANITIZE_STRING); } else { $naziv = '';  }
    if (isset($_POST['string'])) {  $string = filter_input(INPUT_POST, 'string', FILTER_SANITIZE_STRING); } else { $string = '';  }

    // ovo je za e-mail
    if (isset($_POST['email'])) {  $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL); } else { $email = '';  }

    if ($email) {
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo  'The email address you entered is not valid';
            die;
        }
    }


} else {


    if(isset($_GET['id'])) {  $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT); } else { $id = ''; }
    if(isset($_GET['br'])) {  $br = filter_input(INPUT_GET, 'br', FILTER_SANITIZE_NUMBER_INT); } else { $br = ''; }
    if(isset($_GET['currentpage'])) {  $currentpage = filter_input(INPUT_GET, 'currentpage', FILTER_SANITIZE_NUMBER_INT); } else { $currentpage = ''; }

    if(isset($_GET['string2'])) {  $string2 = filter_input(INPUT_GET, 'string2', FILTER_SANITIZE_STRING); } else { $string2 = ''; }
    if (isset($_GET['naziv'])) { $naziv = filter_input(INPUT_GET, 'naziv', FILTER_SANITIZE_STRING); } else { $naziv = '';  }

    if (isset($_GET['email'])) {  $email = filter_input(INPUT_GET, 'email', FILTER_SANITIZE_EMAIL); } else { $email = '';  }
    // ovo sam dodao email

}


// Define the root folder and base URL for the application
function baseURL()
{
    return sprintf(
        "%s://%s%s",
        isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
        $_SERVER['SERVER_NAME'],
        dirname($_SERVER['REQUEST_URI'])
    );
}

define('BASE_URL', baseURL());



function __autoload($class)
{
    $filename = 'class/'.$class.'.php';
    include_once($filename);

    // Check to see whether the include declared the class
    if (!class_exists($class, false)) {
        trigger_error("Unable to load class: $class", E_USER_WARNING);
    }
}