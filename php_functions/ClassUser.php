<?php


class User {

    public $asma;
    public $password;
    public $rank;
    public $sname;
    public $fname;
    public $splty;
    public $division;
    public $branch;
    public $office;
    public $idnumber;
    public $unit;
    public $dateofbirth;
    public $dateofassign;
    public $dateofrelease;
    public $admin;
    public $role;
    public $role2;
    public $role3;
    public $isLoggedIn = false;    

    function __construct() {
        if (session_id() == "") {
            session_start();
        }
        if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] == true) {
            $this->_initUser();
        }
    }

//end __construct

    public $errorType = "fatal";

    public function authenticate($user, $pass) {
        if (session_id() == "") {
            session_start();
        }
        $_SESSION['isLoggedIn'] = false;
        $this->isLoggedIn = false;
        $mysqli = new mysqli(DBHOST, DBUSER, DBPASS, DB);
        $mysqli->set_charset("utf8");
        if ($mysqli->connect_errno) {
            error_log("Cannot connect to MySQL: " .
                    $mysqli->connect_error);
            return false;
        }
        
        //$_SESSION['MyError'][0] = "Now you get into ";
        
        $safeUser = $mysqli->real_escape_string($user);
        $incomingPassword = $mysqli->real_escape_string($pass);
        //$query = "SELECT * from personnel WHERE asma ='{$safeUser}' ";
        $query = "SELECT personnel.*, divisions.* FROM personnel, divisions WHERE personnel.division = divisions.id AND personnel.asma ='{$safeUser}' ";
        if (!$result = $mysqli->query($query)) {
            error_log("Cannot retrieve account for {$user}");            
            $_SESSION['error'][] = "User not found";
            return false;
        }
        
        if ($incomingPassword  == "123456") {                       
            $this->logout();
            die(header("Location: ../pages/reset_passwd.php"));
            //error_log("Passwords for {$user} don't match");            
            return false;
        }
        
        // Will be only one row, so no while() loop needed
        $row = $result->fetch_assoc();
        $dbPassword = $row['password'];
        if ($incomingPassword  != $dbPassword) {
            error_log("Passwords for {$user} don't match");            
            return false;
        }
        
        //find the branch name from table branches
        $My_branch = $row['branch'];
        $query2= "SELECT branch from branches WHERE id ='{$My_branch}' ";
        $result2 = $mysqli->query($query2);
        $row2 = $result2->fetch_assoc();
        
        
        $this->asma = $row['asma'];
        $this->password = $row['password'];
        $this->rank = $row['rank'];
        $this->sname = $row['sname'];
        $this->fname = $row['fname'];
        $this->splty = $row['splty'];
        $this->division = $row['description'];
        $this->branch = $row2['branch'];
        $this->office = $row['office'];
        $this->idnumber = $row['idnumber'];
        $this->unit = $row['unit'];
        $this->dateofbirth = $row['dateofbirth'];
        $this->dateofassign = $row['dateofassign'];
        $this->dateofrelease = $row['dateofrelease'];
        $this->admin = $row['admin'];
        $this->role = $row['role'];
        $this->role2 = $row['role2'];
        $this->role3 = $row['role3'];
        $this->isLoggedIn = true;
        $this->_setSession();
                       
        return true;
    }

//end function authenticate

    private function _setSession() {
        if (session_id() == "") {
            session_start();
        }
        $_SESSION['asma'] = $this->asma;
        $_SESSION['password'] = $this->password;
        $_SESSION['rank'] = $this->rank;
        $_SESSION['sname'] = $this->sname;
        $_SESSION['fname'] = $this->fname;
        $_SESSION['splty'] = $this->splty;
        $_SESSION['division'] = $this->division;
        $_SESSION['branch'] = $this->branch;
        $_SESSION['office'] = $this->office;
        $_SESSION['idnumber'] = $this->idnumber;
        $_SESSION['unit'] = $this->unit;
        $_SESSION['dateofbirth'] = $this->dateofbirth;
        $_SESSION['dateofassign'] = $this->dateofassign;
        $_SESSION['dateofrelease'] = $this->dateofrelease;
        $_SESSION['admin'] = $this->admin;
        $_SESSION['role'] = $this->role;
        $_SESSION['role2'] = $this->role2;
        $_SESSION['role3'] = $this->role3;
        $_SESSION['isLoggedIn'] = $this->isLoggedIn;        
    }

//end function setSession

    private function _initUser() {
        if (session_id() == "") {
            session_start();
        }
        $this->asma = $_SESSION['asma'];
        $this->password = $_SESSION['password'];
        $this->rank = $_SESSION['rank'];
        $this->sname = $_SESSION['sname'];
        $this->fname = $_SESSION['fname'];
        $this->splty = $_SESSION['splty'];
        $this->division = $_SESSION['division'];
        $this->branch = $_SESSION['branch'];
        $this->office = $_SESSION['office'];
        $this->idnumber = $_SESSION['idnumber'];
        $this->unit = $_SESSION['unit'];
        $this->dateofbirth = $_SESSION['dateofbirth'];
        $this->dateofassign = $_SESSION['dateofassign'];
        $this->dateofrelease = $_SESSION['dateofrelease'];
        $this->admin = $_SESSION['admin'];
        $this->role = $_SESSION['role'];
        $this->role2 = $_SESSION['role2'];
        $this->role3 = $_SESSION['role3'];
        $this->isLoggedIn = $_SESSION['isLoggedIn'];        
    }

//end function initUser

    private function _resetPass($id, $pass) {
        $mysqli = new mysqli(DBHOST, DBUSER, DBPASS, DB);
        if ($mysqli->connect_errno) {
            error_log("Cannot connect to MySQL: " . $mysqli->connect_error);
            return false;
        }
        $safeUser = $mysqli->real_escape_string($id);
        $newPass = crypt($pass);
        $safePass = $mysqli->real_escape_string($newPass);
        $query = "UPDATE Customer SET password = '{$safePass}' " . "WHERE id = '{$safeUser}'";
        if (!$mysqli->query($query)) {
            return false;
        } else {
            return true;
        }
    }

//end function _resetPass

    public function logout() {
        $this->isLoggedIn = false;
        if (session_id() == "") {
            session_start();
        }
        $_SESSION['isLoggedIn'] = false;
        foreach ($_SESSION as $key => $value) {
            $_SESSION[$key] = "";
            unset($_SESSION[$key]);
        }
        $_SESSION = array();
        if (ini_get("session.use_cookies")) {
            $cookieParameters = session_get_cookie_params();
            setcookie(session_name(), ' ', time() - 28800, $cookieParameters['path'], $cookieParameters['domain'], $cookieParameters['secure'], $cookieParameters ['httponly']);
        } //end if
        session_destroy();
    }

//end function logout

    public function emailPass($user) {
        $mysqli = new mysqli(DBHOST, DBUSER, DBPASS, DB);
        if ($mysqli->connect_errno) {
            error_log("Cannot connect to MySQL: " . $mysqli->connect_error);
            return false;
        }
// first, lookup the user to see if they exist.
        $safeUser = $mysqli->real_escape_string($user);
        $query = "SELECT id,email FROM Customer WHERE email = '{$safeUser}'";
        if (!$result = $mysqli->query($query)) {
            $_SESSION['error'][] = "Unknown Error";
            return false;
        }
        if ($result->num_rows == 0) {
            $_SESSION['error'][] = "User not found";
            return false;
        }
        $row = $result->fetch_assoc();
        $id = $row['id'];
        $hash = uniqid("", TRUE);
        $safeHash = $mysqli->real_escape_string($hash);
        $insertQuery = "INSERT INTO resetPassword (email_id,pass_key,date_created,status) " . " VALUES ('{$id}','{$safeHash}',NOW(),'A')";
        if (!$mysqli->query($insertQuery)) {
            error_log("Problem inserting resetPassword row for " . $id);
            $_SESSION['error'][] = "Unknown problem";
            return false;
        }
        $urlHash = urlencode($hash);
        $site = "http://nzaharov.no-ip.biz";
        $resetPage = "/pages/reset.php";
        $fullURL = $site . $resetPage . "?user=" . $urlHash;
//set up things related to the e-mail
        $to = $row['email'];
        $subject = "Password Reset for Site";
        $message = "Password reset requested for this site.\r\n\r\n";
        $message .= "Please go to this link to reset your password:\r\n";
        $message .= $fullURL;
        $headers = "From: nikolai.zaharov@yahoo.com\r\n";
        mail($to, $subject, $message, $headers);
        return true;
    }

//end function emailPass

    public function validateReset($formInfo) {
        $pass1 = $formInfo['password1'];
        $pass2 = $formInfo['password2'];
        if ($pass1 != $pass2) {
            $this->errorType = "nonfatal";
            $_SESSION['error'][] = "Passwords don't match";
            return false;
        }
        $mysqli = new mysqli(DBHOST, DBUSER, DBPASS, DB);
        if ($mysqli->connect_errno) {
            error_log("Cannot connect to MySQL: " . $mysqli->connect_error);
            return false;
        }
        $decodedHash = urldecode($formInfo['hash']);
        $safeEmail = $mysqli->real_escape_string($formInfo['email']);
        $safeHash = $mysqli->real_escape_string($decodedHash);
        $query = "SELECT c.id as id, c.email as email FROM Customer c, resetPassword r WHERE " . "r.status = 'A' AND r.pass_key = '{$safeHash}' " . " AND c.email = '{$safeEmail}' " . " AND c.id = r.email_id";
        if (!$result = $mysqli->query($query)) {
            $_SESSION['error'][] = "Unknown Error";
            $this->errorType = "fatal";
            error_log("database error: " . $formInfo['email'] . " - " . $formInfo['hash']);
            return false;
        } else if ($result->num_rows == 0) {
            $_SESSION['error'][] = "Link not active or user not found";
            $this->errorType = "fatal";
            error_log("Link not active: " . $formInfo['email'] . " - " . $formInfo['hash']);
            return false;
        } else {
            $row = $result->fetch_assoc();
            $id = $row['id'];
            if ($this->_resetPass($id, $pass1)) {
                return true;
            } else {
                $this->errorType = "nonfatal";
                $_SESSION['error'][] = "Error resetting password";
                error_log("Error resetting password: " . $id);
                return false;
            }
        }
    }

//end function validateReset   
}

//end class User
?>