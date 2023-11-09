<?php


class Home extends Controller
{

    public $model;

    public function __construct()
    {
        $this->model = $this->model('delivery_users');
    }

    public function index()
    {
        if (isset($_SESSION['user_id'])) {
            $data = $this->model->getAllDeliveriesOfUser();
            $delivery_options = $this->model->getAllDeliveriesStatusOptions();
            $this->view("home", [$data, $delivery_options]);
        } else {
            $this->view("home");
        }
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] != "POST") {
            header("location: " . SITE_URL . "Home/");
            exit();
        } else {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $sql = "SELECT * FROM `delivery_users` WHERE `username` = ?";
            $result = $this->model->query($sql, [$username]);
            if ($result) {
                if (password_verify($password, $result['password'])) {
                    unset($_SESSION['invalid_credentials']);
                    $_SESSION['user_id'] = $result['id'];
                    $_SESSION['username'] = $result['username'];
                    $_SESSION['usertype'] = $result['usertype'];
                    $this->index();
                } else {
                    $_SESSION['invalid_credentials'] = "User not found or Invalid Credentials";
                    header("location: " . SITE_URL . "Home");
                }
            } else {
                $_SESSION['invalid_credentials'] = "User not found or Invalid Credentials";
                header("location: " . SITE_URL . "Home/");
            }
        }
    }

    public function logout()
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['username']);
        unset($_SESSION['usertype']);
        $this->index();
    }

    public function updateDeliveryStatus($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            if (isset($_SESSION['user_id'])) {
                $status = $_POST['status'];
                $sql = "UPDATE `delivery_point` SET `status` = ? WHERE `id` = ?";
                $this->model->update_query($sql, [$status, $id]);
                header("location: " . SITE_URL . "Home/");
                exit();
            } else {
                header("location: " . SITE_URL . "Home/");
                exit();
            }
        } else {
            header("location: " . SITE_URL . "Home/");
            exit();
        }
    }
}
