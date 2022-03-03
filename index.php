<?php
//============== index.php for Wayne and Minjia's app 20/2/22 ==========================================================
//======================================================================================================================

// Ideas for this app were developed from Lee, J et al, SimpleExample app and from ideas gained by following these tutorials:

    // 1. https://www.youtube.com/watch?v=R-ydcTTrR5s - Tutorial 1 - routing
    // 2. https://www.youtube.com/watch?v=fAng7nIQKpM - Tutorial 2 -
    // 3. https://www.youtube.com/watch?v=DQT5sDO1_Ck&t=784s -Tutorial 3
    // 4. https://www.youtube.com/watch?v=2vNijEnRBfg -Tutorial 4
    // 5. https://www.youtube.com/watch?v=2vNijEnRBfg - Adding Bootstrap and user Authentication to Fatfree PHP MVC Project
    // 6. https://www.youtube.com/watch?v=nU4PPWV5MXg - Template Hierarchy in Fat-Free PHP Framework Sample Project
    // 7. https://www.youtube.com/watch?v=iQHpNjobhJ8 - Displaying data sets and creating a Rest API with the Fat-Free PHP Framework

// The notation means class->method.

// Start of index.php: Bootstrap  App ==================================================================================

// Create f3 object and load new instance
$home = '/home/'.get_current_user();
$f3 = include $home.'/AboveWebRoot/fatfree-master/lib/base.php'; //  Fat Free Framework library files
$f3 = Base::instance(); // Establish an instance of Fat Free Framework

//Global variables -
$f3->config('app/setup.cfg');
$f3-> mset(
    ['AUTOLOAD' => $home.'/AboveWebRoot/autoload/;'.$home.'/AboveWebRoot/ServerImages/; app/controllers/; app/models/',
    // F3 will autoload all classes from these 4 locations when needed
     'SITE' => $f3->get('SCHEME') . '://' . $f3->get('HOST') . $f3->get('BASE') . '/',
    'UI' => 'app/views/; app/assets/images/',
    'UPLOADS' => $home.'/AboveWebRoot/ServerImages/']
    // set folder destination for uploads, away from users
);

// Temp located functions ==============================================================================================
//======================================================================================================================

// Error handling
$f3->set(// what to do if something goes wrong.
    'ONERROR', 
    function ($f3) {
        $f3->set('html_title', 'Error: ' . $f3['ERROR']['code']);
        $f3->set('DUMP', catchData($f3['ERROR']));
        $f3->set('content', 'error.html');
        echo Template::instance()->render('template.html');
    }
);

function catchData($var)
{
    ob_start(); //Start remembering everything that would normally be outputted, but don't quite do anything with it yet.
    var_dump($var); //dumps information about one or more variables - without line above, this would be output in the browser
    $output = ob_get_contents(); // Gets the contents of the output buffer without clearing it.
    ob_end_clean(); //erase the output buffer and turn off output buffering
    return $output;
}

//// adapted from SpYk3HH at https://stackoverflow.com/questions/3776682/php-calculate-age
// function getAge($date) { // YYYY-mm-dd format
//    return intval(substr(date('YYYY-mm-dd') - date('YYYY-mm-dd', strtotime($date)), 0, -4));
//}

//    function email ($toName, $toAddress)  {
//        $mail = new SMTP('smtp.gmail.com', 465, 'SSL', 'account@gmail.com', 'secret');
//        $mail->set('from', '<no-reply@Friend.com>');
//        $mail->set('to', '"$toName" $toAddress');
//        $mail->set('subject', 'Welcome');
//        $mail->send(\Template::instance()->render('\ui\email\emailwelcome.txt'));
//    }


// Application Routings ================================================================================================
//======================================================================================================================
$f3->config('app/routes.cfg');
// Could have kept routing here using the format: $f3->route(pattern: 'GET /xyz', handler: 'abc');
//$f3->route('GET /', 'PageController->render');
//======================================================================================================================

new Session(); // needed to enable UserController->authentication
$f3->run(); // Run the FFF engine

// End of index.php=====================================================================================================
