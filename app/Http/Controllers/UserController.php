<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = Validator::make($request->all(),
        ['name'=>'required|min:2',
        'email'=>'required|unique:users,email',
        'password'=>'required|max:10'
    ]);

        if ($data->fails()) {
            return response()->json([
                'status' =>442,
                'message'=>$detail->messages()
            ],442
        );
        } else {
            $insert = User::create(
                ['name'=>$request->name,
                 'email'=>$request->email,
                 'password'=>Hash::make($request->password, [
                    'rounds' => 12,
                 ])
                 ]
            );
            if ($insert) {
                return response()->json(['status'=>200,'messages'=>'données enregistréées avec success'], 200);
            } else {
                return response()->json(['status'=>500,'messages'=>'probleme au niveau de code'], 500);
            }
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function login(Request $request)
    {
        $datas = Validator::make($request->all(),['email'=>'required','password'=>'required']);
        $data = $request->only(['email','password']);

        if (Auth::attempt($data)) {
            $user = Auth::user();
            $token = $user->createToken('ma_cle_de_securite')->plainTextToken;
            return response()->json(['status'=>200,'message'=>'utilisateur connecté','token'=>$token]);


        } else{
            return response()->json(['status'=>403, 'message'=>'ce mail nexiste pas']);
        }
    }
}
