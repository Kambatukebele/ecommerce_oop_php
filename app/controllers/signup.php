<?php

class Signup extends Controller
{
    public function index()
    {
        $data['page_title'] = "Signup | E-SHOP";

        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            $user = $this->load_model("User");
            $user->Signup($_POST);
        }
        $this->view("eshop/signup", $data);
    }
}
