<?php

class User
{
    private $error = "";

    public function Signup($POST)
    {
        $data = array();

        $db = Database::getInstance();

        $data['name'] = trim($POST['name']);
        $data['email'] = trim($POST['email']);
        $data['password'] = trim($POST['password']);
        $password2 = trim($POST['password2']);


        if (empty($data['email']) || !preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i", $data['email'])) {

            $this->error .= "Please enter a valid email <br>";
        }

        if (empty($data['name']) || !preg_match("/^[a-zA-Z]+$/", $data['name'])) {

            $this->error .= "Please enter a valid name <br>";
        }

        if ($data['password'] !== $password2) {
            $this->error .= "Password do not match <br>";
        }

        if (strlen($data['password']) < 5) {
            $this->error .= "Password must be at least 4 characters long <br>";
        }


        /**
         * CHECK IF EMAIL ALREADY EXIST
         */
        $sql = "SELECT * FROM users WHERE email = :email limit 1";
        $arr['email'] = $data['email'];
        $check = $db->read($sql, $arr);

        if (is_array($check)) {
            $this->error .= "This email is already in use <br>";
        }

        /**
         * CHECK IF EMAIL ALREADY EXIST
         */

        $data['url_adress'] = $this->get_random_string_max(60);
        $arr = false;
        $sql = "SELECT * FROM users WHERE url_adress = :url_adress limit 1";
        $arr['url_adress'] = $data['url_adress'];
        $check = $db->read($sql, $arr);

        if (is_array($check)) {
            $data['url_adress'] = $this->get_random_string_max(60);
        }

        if ($this->error == "") {

            $data['rank'] = "customer";

            $data['date'] = date("Y-m-d H:i:s");

            $data['password'] = hash('sha1', $data['password']);

            $query = "INSERT INTO users(url_adress, name, email, password, rank, date) VALUES (:url_adress, :name, :email, :password, :rank, :date)";


            $result = $db->write($query, $data);

            if ($result) {

                header("Location:" . ROOT . "login");
                die;
            }
        }

        $_SESSION['error'] = $this->error;
    }

    public function Login($POST)
    {
        $data = array();

        $db = Database::getInstance();


        $data['email'] = trim($POST['email']);
        $data['password'] = trim($POST['password']);



        if (empty($data['email']) || !preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i", $data['email'])) {

            $this->error .= "Please enter a valid email <br>";
        }

        if ($this->error == "") {


            $data['password'] = hash('sha1', $data['password']);

            $sql = "SELECT * FROM users WHERE email = :email && password = :password limit 1";
            $result = $db->read($sql, $data);

            if (is_array($result)) {

                $_SESSION['user_url'] = $result[0]->url_adress;
                header("Location:" . ROOT . "home");
                die;
            }

            $this->error .= "Wrong email and password <br>";
        }

        $_SESSION['error'] = $this->error;
    }

    public function get_user($url)
    {
    }

    private function get_random_string_max($length)
    {
        $array = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');
        $text = "";

        $length = rand(4, $length);
        for ($i = 0; $i < $length; $i++) {
            $random = rand(0, 61);
            $text .= $array[$random];
        }

        return $text;
    }

    public function check_login($redirect = false, $allowerd = [])
    {

        $db = Database::getInstance();
        $arr = false;
        $arr['url'] = $_SESSION['user_url'];
        $query = "SELECT rank FROM users WHERE url_adress = :url LIMIT 1";
        $result = $db->read($query, $arr);

        if (is_array($result)) {

            return $result[0];
        }
        if (count($allowerd) > 0 && in_array($row->rank, $allowerd)) {
        } else {
            header("Location: " . ROOT . "login");
            die;
        }

        if (isset($_SESSION['user_url'])) {

            $data['url_adress'] = $_SESSION['user_url'];
            $query = "SELECT * FROM users WHERE url_adress = :url_adress LIMIT 1";
            $result = $db->read($query, $data);

            if (is_array($result)) {

                return $result[0];
            }
        }

        if ($redirect) {
            header("Location:" . ROOT . "login");
            die;
        }

        return false;
    }

    public function logout()
    {

        if (isset($_SESSION['user_url'])) {

            unset($_SESSION['user_url']);
        }

        header("Location:" . ROOT . "home");
        die;
    }
}
