<?php
namespace App;

if (session_status() != PHP_SESSION_ACTIVE)
    session_start();



$_SESSION["dirmaster"] = $_SERVER['DOCUMENT_ROOT'].":8080/organifaq/";

//require_once $_SESSION["dirmaster"]."function/PaymentAmountMissmatchException.php";

class IndexCore {
    /*=================BASIC==================*/
    function __construct () {
        $_SESSION["dirmaster"] = $_SERVER['DOCUMENT_ROOT'].":8080/organifaq/";
       // $this->test_all_core();
    }

    function __destruct () {
    }

    function test_all_core(){        
        $this->test_index_core();
    }
    /*=================BASIC==================*/

    /*
    ** this function get all the files that get .php extension in the directory
    */
    function get_all_files_php ($directory)
    {
        $var = [];
        $tab = scandir ($directory);
        foreach($tab as $file){
        $filepath = pathinfo($file);
        if ($filepath['extension'] === 'php')
            $var[] = $file;
        else if ($filepath['extension'] === 'phtml')
            $var[] = $file;
        }
//        print_r($var);
        return $var;
    }

    /*
    ** this function encrypt things !
    */
    function encrypt_password($name, $pswd)
    {
        $pswd = $pswd.$GLOBALS['EXT'].$name;
        $pswd = hash_hmac("sha256", $pswd, $GLOBALS['KEY']);
        $pswd = hash_hmac("whirlpool", $pswd, $GLOBALS['KEY']);
        $pswd = hash_hmac("sha1", $pswd, $GLOBALS['KEY']);
        return $pswd;
    }

    function go($loc)
    {
        header("Location: $loc");
        exit();
    }


    function test_index_core()
    {
        echo "The IndexCore is Ok !<br>";
    }
    
}



$_SESSION["IndexCore"] = new IndexCore();