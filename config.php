<?php
session_start();
require_once "vendor/autoload.php";

$servername = "110.4.46.121";
$username = "asmida";
$password = "abc123";
$dbname = "imbr";

/*$servername = "localhost";
$username = "root";
$password = "";
$dbname = "imbr";*/


$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// Google Client
$google_client = new Google_Client();
$google_client->setClientId('200181232739-bpon661ssifa0f16lgjd2k1u40ps9243.apps.googleusercontent.com');
$google_client->setClientSecret('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');
$google_client->setRedirectUri('http://www.imbungaraya.com.my/index.php');
$google_client->addScope('email');

// Facebook
$fb = new Facebook\Facebook([
    'app_id' => '349657884054868',
    'app_secret' => '75089e698b888a984e9c6d1276858f88',
    'default_graph_version'=>'v2.10'
]);
$helper = $fb->getRedirectLoginHelper();
$fb_login_url = $helper->getLoginUrl('http://www.imbungaraya.com.my/');
if (isset($_GET['code'])) {
    $goToken=$google_client->fetchAccessTokenWithAuthCode($_GET['code']);
    if (!isset($goToken['error'])) {//access success
        $google_client->setAccessToken($goToken['access_token']);
        $_SESSION['go_access_token']=$goToken['access_token'];
        $google_service = new Google_Service_Oauth2($google_client);
        $data = $google_service->userinfo->get();
        
        if(!empty($data['email'])){
            $_SESSION['email']=$data['email'];
            $user_name = $_SESSION['email'];
        }
        if(!empty($data['picture'])){
            $_SESSION['picture']=$data['picture'];
            $profile_pic=$_SESSION['picture'];
        }
        $_SESSION["loginType"]='google';
        echo '<script language="javascript">
        document.location="register.php";
        </script>';
    }else{
       
        try {
            $accesstoken = $helper->getAccessToken();
            
            if (isset($accesstoken)) {
                
                $_SESSION['fac_access_token']=(string) $accesstoken;
                // header("location:index.php");
                if (isset($_SESSION['fac_access_token'])) {
                    $fb->setDefaultAccessToken($_SESSION['fac_access_token']);
                    $fb_response = $fb->get('/me?fields=name,first_name,last_name,email');
                    $fb_response_picture = $fb->get('/me/picture?redirect=false&height=200');
                    $fb_user = $fb_response->getGraphUser();
                    $picture = $fb_response_picture->getGraphUser();
                    // $_SESSION['fb_user_id'] = $fb_user->getProperty('id');
                    // $_SESSION['fb_user_name'] = $fb_user->getProperty('name');
                    $_SESSION['email'] = $fb_user->getProperty('email');
                    // $_SESSION['fb_user_pic'] = $picture['url'];
                    $_SESSION["loginType"]='facebook';
                    echo '<script language="javascript">
                    document.location="register.php";
                    </script>';
                        
                }
            }
        } catch (\Throwable $th) {
            echo '<script language="javascript">
            alert("'. $th.'");
            </script>';
        }
        
    }

}

?>