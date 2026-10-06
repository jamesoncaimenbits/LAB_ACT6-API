<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

if (!function_exists('handle_cors')) {
    function handle_cors()
    {
        $allowed = config_item('allow_origin');
        $request_origin = $_SERVER['HTTP_ORIGIN'] ?? '';

        if (is_array($allowed)) {
            if (in_array($request_origin, $allowed, true)) {
                header('Access-Control-Allow-Origin: ' . $request_origin);
                header('Vary: Origin');
            }
        } elseif ($allowed === '*' || !$allowed) {
            header('Access-Control-Allow-Origin: *');
        } else {
            header('Access-Control-Allow-Origin: ' . $allowed);
            header('Vary: Origin');
        }

        header('Access-Control-Allow-Methods: GET, POST, PUT, PATCH, DELETE, OPTIONS');
        header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
        header('Access-Control-Max-Age: 86400');

        if (($_SERVER['REQUEST_METHOD'] ?? '') === 'OPTIONS') {
            http_response_code(204);
            exit;
        }
    }
}