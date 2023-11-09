<?php

class database
{

    public $host = DB_HOST;
    public $user = DB_USER;
    public $password = DB_PASSWORD;
    public $database = DB;
    public $conn;
    public $result;
    public $sqlConnect;

    public function __construct()
    {
        try {
            $this->conn = mysqli_connect($this->host, $this->user, $this->password, $this->database);

            if (!$this->conn) {
                die("Could not connect to database: " . mysqli_connect_error());
            }

            return $this->conn;
        } catch (Exception $e) {
            die("Could not connect to database: " . $e->getMessage());
        }
    }


    public function cleanString($string)
    {
        return $string = preg_replace("/&#?[a-z0-9]+;/i", "", $string);
    }

    public function Secure($string, $censored_words = 0, $br = true, $strip = 0, $cleanString = true)
    {
        $string = trim($string);
        if ($cleanString) {
            $string = $this->cleanString($string);
        }

        $string = mysqli_real_escape_string($this->conn, $string);
        $string = htmlspecialchars($string, ENT_QUOTES);

        if ($br) {
            $string = str_replace('\r\n', " <br>", $string);
            $string = str_replace('\n\r', " <br>", $string);
            $string = str_replace('\r', " <br>", $string);
            $string = str_replace('\n', " <br>", $string);
        } else {
            $string = str_replace('\r\n', "", $string);
            $string = str_replace('\n\r', "", $string);
            $string = str_replace('\r', "", $string);
            $string = str_replace('\n', "", $string);
        }

        if ($strip == 1) {
            $string = stripslashes($string);
        }

        $string = str_replace('&amp;#', '&#', $string);

        if ($censored_words == 1) {
            global $config;
            $censored_words = @explode(",", $config['censored_words']);
            foreach ($censored_words as $censored_word) {
                $censored_word = trim($censored_word);
                $string        = str_replace($censored_word, '****', $string);
            }
        }

        return $string;
    }


    public function fetchAllData($sql)
    {
        $data = array();
        $result = mysqli_query($this->conn,$sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = (object)$row;
        }
        return $data;
    }

    public function query($query,$params = []) {
        if (empty($params)) {
            $query = mysqli_query($this->conn , $query);
        } else {
            foreach ($params as $param) {
                $param = $this->Secure($param);
                $query = str_replace("?" , "'?'" , $query);
                $query = str_replace("?" , $param , $query);
            }
            $result = mysqli_query($this->conn, $query);
            return mysqli_fetch_assoc($result);
        }
    }

    public function update_query($query,$params = []) {
        if (empty($params)) {
            $query = mysqli_query($this->conn , $query);
        } else {
            foreach ($params as $param) {
                $param = $this->Secure($param);
                $pos = strpos($query, '?');
                if ($pos !== false) {
                    $query = substr_replace($query, "'{$param}'", $pos, 1);
                }
            }
            $result = mysqli_query($this->conn, $query);
            if ($result) {
                return true;
            } else {
                return false;
            }
        }
    }


}
