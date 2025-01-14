<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class MainController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('index', compact('categories'));
    }


    public function contacts()
    {
        return view('client.contacts');
    }

    public function sendEmail(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
            'message' => 'required|min:3'
        ]);


        // dd($request->all());
        $name = $request->name;
        $email = $request->email;
        $message = $request->message;

        mail('kudriashova.ag@gmail.com', 'From site', "$name, $email, $message");

        // return redirect()->route('contacts');
        return to_route('contacts')->with('success', 'Email sent');

        // return redirect()->back();
    }
}
