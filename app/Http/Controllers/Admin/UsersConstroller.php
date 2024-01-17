<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UsersConstroller extends Controller
{
    
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

  
    public function store(Request $request)
    {
        //
    }


    public function show($user)
    {
        return view('admin.user.show',compact('user'));
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

   
    public function destroy($id)
    {
        //
    }
}
