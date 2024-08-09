<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $userId = $request->query('id');
        $password = $request->query('password');

        // Cek kredensial
        if ($userId === 'admin' && $password === 'admin123') {
            return response()->json([
                [
                    'idCount' => '1',
                    'userId' => $userId
                ]
            ]);
        } elseif ($userId === 'sales' && $password === 'sales123') {
            return response()->json([
                [
                    'idCount' => '2',
                    'userId' => $userId
                ]
            ]);
        } else {
            return response()->json([
                [
                    'idCount' => '0'
                ]
            ]);
        }
    }
}
