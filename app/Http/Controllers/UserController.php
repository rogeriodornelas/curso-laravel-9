<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateUserFormRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::get();
        
        return view('users.index', compact('users'));
    }

    public function show($id) 
    {
        // $user = User::where('id', '=', $id)->first();
        if (!$user = User::find($id))
            return redirect()->route('users.index');

        return view('users.show', compact('user'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(StoreUpdateUserFormRequest $request)
    {
        // criando um objeto de User passando o array retornado pelo request
        $data = $request->all();
        $data['password'] = bcrypt($data['password']);
        
        $user = User::create($data);

        //isso poderia ser feito para direcionar direto para a página do novo usuário
        //return redirect()->route('users.show', $user->id)
        return redirect()->route('users.index');

        // $user = new User;
        // $user->name = $request->name;
        // $user->email = $request->email;
        // $user->password = $request->password;
        // $user->save();
    }
}
