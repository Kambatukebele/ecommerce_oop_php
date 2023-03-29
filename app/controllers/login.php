<?php

class Login extends Controller
{
    public function index()
    {
        $data['page_title'] = "Login | E-SHOP";
        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            $user = $this->load_model("User");
            $user->Login($_POST);
        }
        $this->view("eshop/login", $data);
    }
}
