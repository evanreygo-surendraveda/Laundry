<?php

namespace App\Http\Controllers;

use App\User;
use App\Member;
use App\Paket;
USE App\Transaksi;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::count();
        $members = Member::count();
        $pakets = Paket::count();
        $transaksis = Transaksi::count();

        $widget = [
            'users' => $users,
            'members' => $members,
            'pakets' => $pakets,
            'transaksis' => $transaksis
        ];

        return view('home', compact('widget'));
    }
}
