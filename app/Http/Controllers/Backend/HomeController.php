<?php

namespace App\Http\Controllers\Backend;

use App\HelpersClass\Date;
use App\Http\Controllers\Controller;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        $users = User::with('userType')->orderByDesc('id')
            ->limit(10)
            ->get();

        $listDay = Date::getListDayInMonth();


        $viewData = [
            'users'                             => $users,
            'listDay'                           => json_encode($listDay)
        ];

        return view('backend.home.index', $viewData);
    }
}
