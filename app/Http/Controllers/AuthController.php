<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\Note;
use App\Notifications\ResetPassword;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Image;

class AuthController extends Controller
{

    public function register(Request $request)
    {
     
        $request->validate(
            [
                'name' => 'required|min:15',
                'telephone' => 'required|numeric|digits:11',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6',
                'national_id' => 'required|unique:users',
            ]
        );

        if (!preg_match('/\p{Arabic}/u', $request->name)) return response()->json(['errors' => ['name' => ['يجب ان يكون الاسم رباعي باللغة العربية']]], 405);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->password2 = $request->password;
        $user->address = $request->address;
        $user->telephone = $request->telephone;
        $user->department_id = $request->department_id;
        $user->national_id = $request->national_id;
        $user->nationality = $request->nationality;
        $user->save();
        return response()->json(['status' => 'success'], 200);
    }
  


  

   
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function user()
    {

        return response()->json([
            'status' => 'success',
            'data' => Auth::user()->only('id', 'department_id', 'name', 'permissions', 'telephone') //->append(['permissions'])
        ]);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            //    'expires_in' => auth()->factory()->getTTL()*60
        ], 200)->header('Authorization', $token);
    }







    protected function resetAuth(array $guards = null)
    {
        $guards = $guards ?: array_keys(config('auth.guards'));

        foreach ($guards as $guard) {
            $guard = $this->app['auth']->guard($guard);

            if ($guard instanceof \Illuminate\Auth\SessionGuard) {
                $guard->logout();
            }
        }
    }
  

  


    public function sendResetCode(Request $request)
    {
        // $user = User::where('email', $request->email)->first();
        // if ($user == null) {
        //     return \response()->json(['error' => 'This email not registered'], 404);
        // }
        // $code = (string) Str::uuid();
        // $user->update(['reset' => $code]);
        // $user->notify(new ResetPassword(['reset_code' => $code]));
        // return \response()->json(['success' => 'mail was sent to your email please check your email'], 202);
    }


    public function resetPassword(Request $request)
    {
        // $user = User::where('reset', $request->code)->first();
        // if (!$user) {
        //     return \response()->json(['error' => 'reset code invalied'], 404);
        // }
        // $user->update(['password' => bcrypt($request->new_password)]);
        // return \response()->json(['success' => 'password was changed you can login with new password'], 202);
    }

    public function account_activation(Request $request)
    {
        // if (Auth::user()->r_password === $request->serial) {
        //     Auth::user()->account_state = 'active';
        //     Auth::user()->save();
        //     return 'account activated';
        // } else {
        //     return response()->json(['error' => 'incorrect serial'], 404);
        // }
    }
}
