<?php

class Admin extends Controller
{
    public function index()
    {
        $user = $this->load_model("User");
        $user_data = $user->check_login(true, ["admin"]);

        if(is_object($user_data)){

            $data['user_data'] = $user_data; 
        }

        $data['page_title'] = "Admin | E-SHOP";
        $this->view("eshop/admin/index", $data);
    }
}
