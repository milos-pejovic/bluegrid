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
        return $this->loadUsers($request);
    }
    
    /**
     * 
     * @param type $id
     */
    public function delete($id) {
        error_log('DELETE');
        User::where('id',$id)->delete();
        return 'success';
    }
    
    private function loadUsers($request) {
        $sort_by = $request->sort_by;
        $limit = (isset($request->limit)) ? $request->limit : 15;
        
        error_log('SORT BY: ' . $request->sort_by);
        error_log('LIMIT: ' . $request->limit);
        error_log('PAGE: ' . $request->page);
        
        if ($sort_by == 'name' || $sort_by == 'email' || $sort_by == 'id')
            return User::orderBy($sort_by, 'asc')->paginate($limit);
        return User::paginate($limit);
    }
    
}
