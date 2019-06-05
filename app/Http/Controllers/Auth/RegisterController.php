<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use App\Business;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/profile';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|string|max:255|unique:users',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{6,}$/'

        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {        
        if($data['site']==null){
            $user_type = 'Personal';
        }else $user_type = 'Business';

        $user =  User::create([
            'username' => $data['username'],
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'user_type' => $user_type,
            'description' => '',
        ]);


        if( $user_type =='Personal')
            DB::insert('insert into personal (id_user) values (?)', [$user->id_user]);
        else if( $user_type =='Business'){
            $business_user = Business::create([
                'id_user' => $user->id_user,
                'verification' => 'Pending',
                'website' => $data['site']
            ]);
        } 

        return $user;

    }
}
