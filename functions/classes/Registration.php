<?php

/**
 * Handles the user registration
 * @author Panique
 * @link http://www.php-login.net
 * @link https://github.com/panique/php-login-advanced/
 * @license http://opensource.org/licenses/MIT MIT License
 */
class Registration {

    private $db_connection = null;
    public $registration_successful = false;
    public $verification_successful = false;
    public $errors = array();
    public $messages = array();

    public function __construct() {
        if (session_status() <> PHP_SESSION_ACTIVE) {
            session_start();
        }
        if (isset($_POST["register"])) {
            $this->registerNewUser($_POST['user_name'], $_POST['user_email'], $_POST['user_password_new'], $_POST['user_password_repeat'], $_POST["captcha"], $_POST['user_class'], $_POST['user_orgnization']);
        } else if (isset($_GET["id"]) && isset($_GET["verification_code"])) {
            $this->verifyNewUser($_GET["id"], $_GET["verification_code"]);
        }
    }

    private function databaseConnection() {
        if ($this->db_connection != null) {
            return true;
        } else {
            try {
                $this->db_connection = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
                return true;
            } catch (PDOException $e) {
                $this->errors[] = MESSAGE_DATABASE_ERROR;
                return false;
            }
        }
    }

    private function registerNewUser($user_name, $user_email, $user_password, $user_password_repeat, $captcha, $user_class, $user_orgnization) {
        $user_name = trim($user_name);
        $user_email = trim($user_email);
        $user_class = trim($user_class);
        $user_orgnization = trim($user_orgnization);


        if (strtolower($captcha) != strtolower($_SESSION['captcha'])) {
            $this->errors[] = MESSAGE_CAPTCHA_WRONG;
            echo "Error in MESSAGE_CAPTCHA_WRONG";
        } elseif (empty($user_name)) {
            $this->errors[] = MESSAGE_USERNAME_EMPTY;
            echo "Error in MESSAGE_USERNAME_EMPTY";
        } elseif (empty($user_password) || empty($user_password_repeat)) {
            $this->errors[] = MESSAGE_PASSWORD_EMPTY;
            echo "Error in MESSAGE_PASSWORD_EMPTY";
        } elseif ($user_password !== $user_password_repeat) {
            $this->errors[] = MESSAGE_PASSWORD_BAD_CONFIRM;
            echo "Error in MESSAGE_PASSWORD_BAD_CONFIRM";
        } elseif (strlen($user_password) < 6) {
            $this->errors[] = MESSAGE_PASSWORD_TOO_SHORT;
            echo "Error in MESSAGE_PASSWORD_TOO_SHORT";
        } elseif (strlen($user_name) > 64 || strlen($user_name) < 2) {
            $this->errors[] = MESSAGE_USERNAME_BAD_LENGTH;
            echo "Error in MESSAGE_USERNAME_BAD_LENGTH";
        } elseif (!preg_match('/^[a-z\d]{2,64}$/i', $user_name)) {
            $this->errors[] = MESSAGE_USERNAME_INVALID;
            echo "Error in MESSAGE_USERNAME_INVALID";
        } elseif (empty($user_email)) {
            $this->errors[] = MESSAGE_EMAIL_EMPTY;
            echo "Error in MESSAGE_EMAIL_EMPTY";
        } elseif (strlen($user_email) > 64) {
            $this->errors[] = MESSAGE_EMAIL_TOO_LONG;
            echo "Error in MESSAGE_EMAIL_TOO_LONG";
        } elseif (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
            $this->errors[] = MESSAGE_EMAIL_INVALID;
            echo "Error in MESSAGE_EMAIL_INVALID";
        } else if ($this->databaseConnection()) {


            $query_check_user_name = $this->db_connection->prepare('SELECT user_name, user_email FROM users WHERE user_name=:user_name OR user_email=:user_email');
            $query_check_user_name->bindValue(':user_name', $user_name, PDO::PARAM_STR);
            $query_check_user_name->bindValue(':user_email', $user_email, PDO::PARAM_STR);
            $query_check_user_name->execute();
            $result = $query_check_user_name->fetchAll();
            if (count($result) > 0) {
                for ($i = 0; $i < count($result); $i++) {
                    $this->errors[] = ($result[$i]['user_name'] == $user_name) ? MESSAGE_USERNAME_EXISTS : MESSAGE_EMAIL_ALREADY_EXISTS;
                }
            } else {

                $hash_cost_factor = (defined('HASH_COST_FACTOR') ? HASH_COST_FACTOR : null);
                $user_password_hash = password_hash($user_password, PASSWORD_DEFAULT, array('cost' => $hash_cost_factor));
                $user_activation_hash = sha1(uniqid(mt_rand(), true));

                $query_new_user_insert = $this->db_connection->prepare('INSERT INTO users (user_name, user_password_hash, user_email, user_activation_hash, user_registration_ip, user_registration_datetime, user_class, user_orgnization) VALUES(:user_name, :user_password_hash, :user_email, :user_activation_hash, :user_registration_ip, now(), :user_class, :user_orgnization)');
                $query_new_user_insert->bindValue(':user_name', $user_name, PDO::PARAM_STR);
                $query_new_user_insert->bindValue(':user_password_hash', $user_password_hash, PDO::PARAM_STR);
                $query_new_user_insert->bindValue(':user_email', $user_email, PDO::PARAM_STR);
                $query_new_user_insert->bindValue(':user_activation_hash', $user_activation_hash, PDO::PARAM_STR);
                $query_new_user_insert->bindValue(':user_registration_ip', $_SERVER['REMOTE_ADDR'], PDO::PARAM_STR);
                $query_new_user_insert->bindValue(':user_class', $user_class, PDO::PARAM_STR);
                $query_new_user_insert->bindValue(':user_orgnization', $user_orgnization, PDO::PARAM_STR);

                $query_new_user_insert->execute();

                $user_id = $this->db_connection->lastInsertId();
                if ($query_new_user_insert) {
                        $this->messages[] = MESSAGE_VERIFICATION_MAIL_SENT;
                        $this->registration_successful = true;
                        $_SESSION['user_name'] = $user_name;
                        $_SESSION['user_logged_in'] = 1;
/* This code is for sending the verification email, it is not needed now, Thanks mother fucker email. 
 *                    
 * if ($this->sendVerificationEmail($user_id, $user_email, $user_activation_hash)) {
                        $this->messages[] = MESSAGE_VERIFICATION_MAIL_SENT;
                        $this->registration_successful = true;
   echo "query_new_user_insert<br>";
                } else {
                        $query_delete_user = $this->db_connection->prepare('DELETE FROM users WHERE user_id=:user_id');
                        $query_delete_user->bindValue(':user_id', $user_id, PDO::PARAM_INT);
                        $query_delete_user->execute();

                        $this->errors[] = MESSAGE_VERIFICATION_MAIL_ERROR;
                           echo "MESSAGE_VERIFICATION_MAIL_ERROR<br>";                        
                    }
*/                } else {
                    $this->errors[] = MESSAGE_REGISTRATION_FAILED;
                }
            }
        }
    }

    public function sendVerificationEmail($user_id, $user_email, $user_activation_hash) {
        require_once ('functions/libraries/PHPMailer.php');
        $mail = new PHPMailer;
        if (EMAIL_USE_SMTP) {
            $mail->IsSMTP();
            $mail->SMTPAuth = EMAIL_SMTP_AUTH;
            if (defined(EMAIL_SMTP_ENCRYPTION)) {
                $mail->SMTPSecure = EMAIL_SMTP_ENCRYPTION;
            }
            $mail->Host = EMAIL_SMTP_HOST;
            $mail->Username = EMAIL_SMTP_USERNAME;
            $mail->Password = EMAIL_SMTP_PASSWORD;
            $mail->Port = EMAIL_SMTP_PORT;
        } else {
            $mail->IsMail();
        }
        $mail->From = EMAIL_VERIFICATION_FROM;
        $mail->FromName = EMAIL_VERIFICATION_FROM_NAME;
        $mail->AddAddress($user_email);
        $mail->Subject = EMAIL_VERIFICATION_SUBJECT;
        $link = EMAIL_VERIFICATION_URL . '?id=' . urlencode($user_id) . '&verification_code=' . urlencode($user_activation_hash);
        $mail->Body = EMAIL_VERIFICATION_CONTENT . ' ' . $link;
        if (!$mail->Send()) {
            $this->errors[] = MESSAGE_VERIFICATION_MAIL_NOT_SENT . $mail->ErrorInfo;
            return false;
        } else {
            return true;
        }
    }

    public function verifyNewUser($user_id, $user_activation_hash) {
        if ($this->databaseConnection()) {
            $query_update_user = $this->db_connection->prepare('UPDATE users SET user_active = 1, user_activation_hash = NULL WHERE user_id = :user_id AND user_activation_hash = :user_activation_hash');
            $query_update_user->bindValue(':user_id', intval(trim($user_id)), PDO::PARAM_INT);
            $query_update_user->bindValue(':user_activation_hash', $user_activation_hash, PDO::PARAM_STR);
            $query_update_user->execute();

            if ($query_update_user->rowCount() > 0) {
                $this->verification_successful = true;
                $this->messages[] = MESSAGE_REGISTRATION_ACTIVATION_SUCCESSFUL;
            } else {
                $this->errors[] = MESSAGE_REGISTRATION_ACTIVATION_NOT_SUCCESSFUL;
            }
        }
    }

}
