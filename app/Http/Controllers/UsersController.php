<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
    /**
     * 
     * @param Request $request
     * @return type
     */
    public function index(Request $request) {
        $nameSearchParam = isset($request->searchName) ? $request->searchName : '';
        $emailSearchParam = isset($request->searchEmail) ? $request->searchEmail : '';
        
        $sort_by = $request->sort_by;
        $limit = (isset($request->limit)) ? $request->limit : 15;
        
        if ($sort_by == 'name' || $sort_by == 'email' || $sort_by == 'id') {
            return User::where('name', 'like', '%' . $nameSearchParam . '%')
                    ->where('email', 'like', '%' . $emailSearchParam . '%')
                    ->orderBy($sort_by, 'asc')
                    ->paginate($limit);
        } else {
            return User::where('name', 'like', '%' . $nameSearchParam . '%')
                    ->where('email', 'like', '%' . $emailSearchParam . '%')
                    ->paginate($limit);
        }
    }

    /**
     * 
     * @param type $id
     * @return string
     */
    public function delete(Request $request, $id) {
        User::where('id', $id)->delete();
        return 'success';
    }

    /**
     * 
     * @param Request $request
     * @return type
     */
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
    
    /**
     * 
     * @param Request $request
     * @param type $id
     * @return type
     */
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
