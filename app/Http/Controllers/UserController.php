<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{

    public function __construct()
    {
        //ovaj index sse odnosi na users\index.blade.php - tamo ne treba autentifikacija
        $this->middleware('auth')->except('index');
                                    //only('index) -znači da primjeni samo na toj stranici
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            $users = User::all();
            //vraća index.blade.php
            return view ('users.index', compact('users'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$request['email'];
        //request ('email');
        
        //Validacija kao array parametara
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:3'
        ]);

        $user = new User();
        $user->name = $request['name'];  //imena iz name="name" forms \views\users\create.blade.php
        $user->email = $request['email'];
        $user->password = bcrypt($request['password']);
        $user->save();  //ugrađena funkcija save iz laravela
        
        //ovaj withFlashMessage treba dodati i u \views\users\index.blade.php
        return redirect()->route('users.index')->withFlashMessage('Korisnik je uspješno kreiran');

        //redirecta stranicu na sve korsinike nakon pritiska na gumb Kreiraj
        //return redirect('/users');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //traži usera
        $user = User::find($id);

        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(user $user)
    {
        //$user = User::find($id);
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, user $user)
    {
                //dd($request);
                $request->validate([
                    'name'      => 'required|string|max:255',
                    'email'     => 'required|email|max:255|unique:users,email,'.$user->id,
                    'password'  => 'nullable|min:3'
                ]);
                //$user =User::find($id);
                $user->name = $request['name'];
                $user->email = $request['email'];
                if (!empty($request['password'])) {
                    $user->password = bcrypt($request['password']);
                }
                $user->save();
                return redirect()->route('users.index')->withFlashMessage("Korisnik $user->name uspješno je ažuriran.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(user $user)
    {
        //$user = User::find($id);
        $user->delete();
        return redirect()->route('users.index')->withFlashMessage("Korisnik $user->name obrisan je uspješno.");
    }

      
    // Dohvati sve komentare vezane uz usera
    public function comments(){
        return $this->hasMany(Comment::class,)
    }
}
