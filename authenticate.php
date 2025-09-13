<?php
require_once './database/config.php';
$is_validate = false;
$database = new Database();
$connection = $database->GetConnection();


if($_SERVER ["REQUEST_METHOD"] === "POST")
{
   $checkifExist = sprintf("SELECT * FROM useraccounts WHERE email = '%s'", 
                         $connection->real_escape_string($_POST['email']));

   $result = $connection->query($checkifExist);
   $userAccount = $result->fetch_assoc();
   
   
   if($userAccount)
   {
    if (password_verify($_POST['password'], $userAccount['password']))
    {
    session_start();
    session_regenerate_id();
    $_SESSION['user_email'] = $userAccount ['email'];
    header("Location: ./dashboard");
    exit;
    }

   }
   $is_validate = true;





}
?>