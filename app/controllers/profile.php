<?php

class Profile extends Controller
{
    public function index()
    {
        $user = $this->load_model("User");
        $user_data = $user->check_login(true);

        if(is_object($user_data)){

            $data['user_data'] = $user_data; 
        }

        $data['page_title'] = "Profile | E-SHOP";
        
        $this->view("eshop/admin/profile", $data);
    }
}
