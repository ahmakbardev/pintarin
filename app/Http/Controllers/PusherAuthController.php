<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Pusher\Pusher;

class PusherAuthController extends Controller
{
    public function authenticate(Request $request)
    {
        if (Auth::check()) {
            $pusher = new Pusher(
                config('broadcasting.connections.pusher.key'),
                config('broadcasting.connections.pusher.secret'),
                config('broadcasting.connections.pusher.app_id'),
                [
                    'cluster' => config('broadcasting.connections.pusher.options.cluster'),
                    'useTLS' => true
                ]
            );

            $presence_data = ['name' => Auth::user()->name];
            return $pusher->presence_auth(
                $request->input('channel_name'),
                $request->input('socket_id'),
                Auth::id(),
                $presence_data
            );
        } else {
            return response('Unauthorized', 403);
        }
    }
}
