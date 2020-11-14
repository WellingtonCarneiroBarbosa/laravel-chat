<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class MessageController extends Controller
{
    /**
     * Return all messages between logged in user and user
     * provided by param.
     *
     * @param \App\Models\User $user
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        try {
            $userId = $user->id;
            $userIdLoggedIn = Auth::user()->id;

            /**
             * * [from = $userId && to = $userIdLoggedIn]
             *
             * * OR
             *
             * * [from = $userIdLoggedIn && to = $userId]
             *
             * * Most recent should be the last message on chat.
             */
            $messages = Message::where(
                function ($query) use($userId, $userIdLoggedIn) {
                    $query->where([
                        "from" => $userId,
                        "to" => $userIdLoggedIn
                    ]);
                }
            )->orWhere(
                function ($query) use($userId, $userIdLoggedIn) {
                    $query->where([
                        "from" => $userIdLoggedIn,
                        "to" => $userId
                    ]);
                }
            )->orderBy('created_at', 'ASC')->get();

            return response()->json(['messages' => $messages], Response::HTTP_OK);
        } catch(\Exception $e) {
            if(config('app.debug'))
                return response()->json(['message' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);

            return response()->json(['message' => "Something went wrong!"], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'content' => 'required',
                'to' => 'required',
            ]);

            $message = Message::create([
                "from" => $request->user()->id,
                "to" => $validatedData["to"]["id"],
                "content" => $validatedData["content"]
            ]);

            return response()->json(['message' => $message], Response::HTTP_CREATED);
        } catch(\Exception $e) {
            if(config('app.debug'))
                return response()->json(['message' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);

            return response()->json(['message' => "Something went wrong!"], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
