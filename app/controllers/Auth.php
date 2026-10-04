<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Auth extends Controller {

    public function __construct() {
        parent::__construct();
        $this->call->library('session');
    }

    public function login() {
        if ($this->request->method() == 'post') {
            $username = $this->request->post('username');
            $password = $this->request->post('password');

            if ($username === 'jameson' && $password === 'user123') {
                $this->session->set_userdata('logged_in', true);
                $this->session->set_userdata('username', $username);
                redirect('products');
            } else {
                $data['error'] = 'Invalid username or password.';
                $this->call->view('auth/login', $data);
                return;
            }
        }
        $this->call->view('auth/login');
    }

    public function logout() {
        $this->session->unset_userdata('logged_in');
        $this->session->unset_userdata('username');
        redirect('auth/login');
    }
}