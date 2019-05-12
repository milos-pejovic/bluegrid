<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
    public function index(Request $request, $limit = null, $sort_by = null) {
        if ($sort_by === 'name' || $sort_by === 'email')
            return User::orderBy($sort_by, 'asc')->paginate($limit);
        return User::paginate($limit);
    }
}
