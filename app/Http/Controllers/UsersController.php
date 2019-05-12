<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
    public function index(Request $request) {
        $sort_by = $request->sort_by;
        $limit = (isset($request->limit)) ? $request->limit : 15;
        
        if ($sort_by == 'name' || $sort_by == 'email' || $sort_by == 'id')
            return User::orderBy($sort_by, 'asc')->paginate($limit);
        return User::paginate($limit);
    }

    public function delete($id) {
        User::where('id', $id)->delete();
        return 'success';
    }

    public function create(Request $request) {
        $this->validate(request(), [
            'name' => ['required', 'min:2'],
            'email' => ['required', 'email']
	]);
        
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        
        return $user->id;
    }
    
    public function update(Request $request, $id) {
        $user = User::find($id);
        $this->validate(request(), [
            'name' => ['required', 'min:2'],
            'email' => ['required', 'email']
	]);
        
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        
        return $user->id;
    }
}
