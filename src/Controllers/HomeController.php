<?php

namespace App\Controllers;

class HomeController
{
    public function index()
    {
        return json_encode([
            'message' => 'API PicPay Simplificado está online!'
        ]);
    }
}
