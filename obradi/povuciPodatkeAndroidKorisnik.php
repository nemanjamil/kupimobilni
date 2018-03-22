<?php
// hvatamo sifru P iz GETA
$login_check = $_GET['p'];

// proveramo MAIL
$email = filter_var($email, FILTER_VALIDATE_EMAIL);
if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
    // Not a valid email
    // validirano mail, ako nije dobar onda stavljamo error
    $o['tag'] = 'login';
    $o['success'] = false;
    $o['error'] = 1;
    $o['error_msg'] =  "The email address you entered is not valid.";

    echo json_encode($o, JSON_UNESCAPED_UNICODE);
    exit();
}

if (isset($email, $login_check)) {
    $email = filter_input(INPUT_GET, 'email', FILTER_SANITIZE_EMAIL);
    $login_check = trim($login_check); // The hashed password.
    $sta = $sesKor->loginIos($email, $login_check);

    if ($sta) {

        echo $sta;
        exit();

        // ovde ima 3 odgovora od loginIos

       /* // 1 login Check BRUTE
        $o['tag'] = 'login';
        $o['success'] = false;
        $o['error'] = 4;
        $o['error_msg'] = 'Account is LOCKED!';

        // 2 sve je ok
        $o['tag'] = 'login';
		$o['success'] = true;
        $o['error'] = 0;
        $o['uid'] = $sad['KomitentId'];
        // i ovde dolaze svi podaci od KOMITENTA

        // 3 Incorrect email or password
        $o['tag'] = 'login';
        $o['success'] = false;
        $o['error'] = 5;
        $o['error_msg'] = 'Incorrect email or password!';*/


    } else {

        // ako ne postoji user
        $o['tag'] = 'login';
        $o['success'] = false;
        $o['error'] = 2;
        $o['error_msg'] = 'Nema korisnika u bazi';

        echo json_encode($o, JSON_UNESCAPED_UNICODE);
        exit();

    }
} else {

    // ako nema podataka
    $o['tag'] = 'login';
    $o['success'] = false;
    $o['error'] = 3;
    $o['error_msg'] = 'Nije poslat mail ili hash pass';

    echo json_encode($o, JSON_UNESCAPED_UNICODE);
    exit();

}

?>
