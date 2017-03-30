<?php
     /**
	 * 包含SDK
	 */
	require("../classes/yb-globals.inc.php");
    
    session_start();
    
    if(!isset($_SESSION['token'])){
        print('{"result":"Forbidden"}');
        die();
    }
    
    include_once "db_config.php";
    
    $username = $_SESSION['usrid'];
    $realname = $_SESSION['name'];

    try {
        $DBH = new PDO("mysql:host=$db_host;dbname=$db_database;", $db_user, $db_password,
        array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    } catch (PDOExveption $e) {
        print('{"result":"Database Fatal"}');
        die();
    }

    
    try {

        $DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if (isset($_POST['jx1'])) {
            $stmt = $DBH->prepare("UPDATE award SET award1 = ? WHERE username = {$_SESSION['usrid']}");
            $stmt->execute(array($_POST['jx1']));
        }
        if (isset($_POST['jx2'])) {
            $stmt = $DBH->prepare("UPDATE award SET award2 = ? WHERE username = {$_SESSION['usrid']}");
            $stmt->execute(array($_POST['jx2']));
        }
        if (isset($_POST['jx3'])) {
            $stmt = $DBH->prepare("UPDATE award SET award3 = ? WHERE username = {$_SESSION['usrid']}");
            $stmt->execute(array($_POST['jx3']));
        }
        if (isset($_POST['jx4'])) {
            $stmt = $DBH->prepare("UPDATE award SET award4 = ? WHERE username = {$_SESSION['usrid']}");
            $stmt->execute(array($_POST['jx4']));
        }
        if (isset($_POST['jx5'])) {
            $stmt = $DBH->prepare("UPDATE award SET award5 = ? WHERE username = {$_SESSION['usrid']}");
            $stmt->execute(array($_POST['jx5']));
        }
        if (isset($_POST['jx6'])) {
            $stmt = $DBH->prepare("UPDATE award SET award6 = ? WHERE username = {$_SESSION['usrid']}");
            $stmt->execute(array($_POST['jx6']));
        }
        if (isset($_POST['jx7'])) {
            $stmt = $DBH->prepare("UPDATE award SET award7 = ? WHERE username = {$_SESSION['usrid']}");
            $stmt->execute(array($_POST['jx7']));
        }
        if (isset($_POST['jx8'])) {
            $stmt = $DBH->prepare("UPDATE award SET award8 = ? WHERE username = {$_SESSION['usrid']}");
            $stmt->execute(array($_POST['jx8']));
        }
        if (isset($_POST['jx9'])) {
            $stmt = $DBH->prepare("UPDATE award SET award9 = ? WHERE username = {$_SESSION['usrid']}");
            $stmt->execute(array($_POST['jx9']));
        }
        if (isset($_POST['jx10'])) {
            $stmt = $DBH->prepare("UPDATE award SET award10 = ? WHERE username = {$_SESSION['usrid']}");
            $stmt->execute(array($_POST['jx10']));
        }
        if (isset($_POST['nowstate'])) {
            $stmt = $DBH->prepare("UPDATE award SET state = ? WHERE username = {$_SESSION['usrid']}");
            $stmt->execute(array($_POST['nowstate']));
        }

       print('{"result":"success"}');
       die();


    } catch (PDOException $e) {
        print_r($e);
        print('{"result":"Database Error"}');
        die();
    }

?>