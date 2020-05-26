<?php

class User extends Database
{
    public function loginUser($username)
    {
        $stmt = $this->dbConn()->prepare("SELECT * FROM members WHERE username = :username");
        $stmt->execute(['username' => $username]);
        $result = $stmt->fetch();
        $row = $stmt->rowCount();

        if ($row > 0) {
            $this->setSessionUser($result);
            return $result;
        } else {
            return false;
        }

        // if ($row > 0) {
        //     $result = $stmt->fetch();
        //     // Fetch password from the DB and compare
        //     $this->setSessionUser($result);

        //     $pw_verify = password_verify($password, $result['password']);

        //     return $pw_verify ? $result : false;
        // } else {
        //     return false;
        // }
    }


    public function addUser($username, $email, $password, $first_name, $last_name)
    {
        $conn = $this->dbConn();
        $stmt = $conn->prepare('INSERT into members (`username`,`first_name`,`last_name`,`email`,`password`,`access`) VALUES (:username,:first_name,:last_name,:email,:password,:access)');

        $stmt->execute(['username' => $username, 'first_name' => $first_name, 'last_name' => $last_name, 'email' => $email, 'password' => $password, 'access' => 'user']);
    }

    public function checkUserExists($fieldname, $field)
    {
        // Check email and username if existed
        $conn = $this->dbConn();
        $stmt = $conn->prepare("SELECT * FROM members WHERE " . $fieldname . " = :" . $fieldname . "");
        $stmt->execute([$fieldname => $field]);
        $row = $stmt->rowCount();

        return $row;
    }

    public function logoutUser()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        session_destroy();
        unset($_SESSION['user_data']);
    }

    public function setSessionUser($userArray)
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        // Set user data
        $_SESSION['user_data'] = [
            'username' => $userArray['username'],
            'full_name' => $userArray['first_name'] . " " . $userArray['last_name'],
            'access' => $userArray['access']
        ];

        return $_SESSION['user_data'];
    }

    public function getSessionData()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        // Check if session user_data is set and set null
        return (isset($_SESSION['user_data'])) ? $_SESSION['user_data'] : null;
    }
}
