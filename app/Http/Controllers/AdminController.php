<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;



class AdminController extends Controller
{
    public function index()
    {
        $admin = User::all();
        return view('admin/index', compact('admin'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone_number' => 'required',
            'password' => 'required|string|min:8'
        ]);

        // Buat pengguna baru
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        $user->password = Hash::make($request->password); // Hash password
        $user->remember_token = Str::random(10);
        $user->save();

        return redirect()->route('admin.index')->with('success', 'Data Berhasil Ditambahkan');
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone_number' => 'required',
            'password' => '',
        ]);

        if ($request["password"] == null) {
            $request->request->remove('password');
        } else {
            $request["password"] = bcrypt($request->password);
        }

        $admin = User::find($id);
        $admin->update($request->all());

        return redirect()->route('admin.index')->with('success', 'Data Berhasil Diubah');
    }

    public function destroy($id)
    {
        return redirect()->route('admin.index');
    }
}
