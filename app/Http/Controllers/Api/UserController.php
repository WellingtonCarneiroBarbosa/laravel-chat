<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    /**
     * Return all users of the application, except
     * the logged in user
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllUsersExceptLoggedIn()
    {
        try {
            $users = User::where("id", "!=", Auth::user()->id)->orderBy("name", "ASC")->get();
            //$users = User::all();

            return response()->json([
                "users" => $users
            ], Response::HTTP_OK);
        } catch(\Exception $e) {
            if(config('app.debug'))
                return response()->json(["message" => $e->getMessage()],Response::HTTP_INTERNAL_SERVER_ERROR);

            return response()->json(["message" => "Something went wrong!"], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(User $user)
    {
        try {
            return response()->json(["user" => $user], Response::HTTP_OK);
        } catch(\Exception $e) {
            if(config('app.debug'))
                return response()->json(["message" => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);

            return response()->json(["message" => "Something went wrong!"], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function me(Request $request)
    {
        try {
            return response()->json(["user" => $request->user()], Response::HTTP_OK);
        } catch(\Exception $e) {
            if(config('app.debug'))
                return response()->json(["message" => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);

            return response()->json(["message" => "Something went wrong!"], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
