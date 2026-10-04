<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class AuthMiddleware {

    public function handle($next) {
        $LAVA = lava_instance();
        $LAVA->call->library('session');

        if (!$LAVA->session->userdata('logged_in')) {
            redirect('auth/login');
            return;
        }

        return $next();
    }
}