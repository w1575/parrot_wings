<?php


namespace App\Http\Controllers\Api;


use App\Models\User;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;




class AuthController extends \App\Http\Controllers\Controller
{
    /**
     * Регистрация нового пользователя
     * @param Request $request
     * @return User|\Illuminate\Database\Eloquent\Model
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|regex:/^[a-zA-Zа-яА-ЯёЁ]{2,30}\ [a-zA-Zа-яА-ЯёЁ]{2,30}+$/u',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        return $user;
    }

    /**
     * @param Request $request
     * @return array
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        $request->validate(
            [
                'email' => 'email|required',
                'password' => 'required'
            ]
        );

        $loginData = \request(['email', 'password']);

        if (! Auth::attempt($loginData)) {
            throw ValidationException::withMessages(['password' => 'Неверный пароль или e-mail']);
        }

        $user = User::where('email', $request->email)->first();
        $token = $user->createToken('authToken');
        // $token = $request->user()->createToken($request->token_name);

        return ['token' => $token->plainTextToken];
    }
}
