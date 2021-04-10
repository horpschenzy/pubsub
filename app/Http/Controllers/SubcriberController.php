<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubcriberController extends Controller
{
    public function store(Request $request, $topic)
    {
       
       $validate  = Validator::make($request->all(), [
            'url' => ['required', 'url', 'max:255'],
        ]);

        if($validate->fails())
        {
            return response()->json([
                'message' => $validate->messages()->first()
            ], 400);
        }

        $data = $request->only(['url']);
        $data['topic'] = $topic;

        $subscriber = new Subscriber($data);
        
        if($subscriber->save()){
            return response()->json([
                'url' => $request->url,
                'topic' => $topic,
            ], 201);
        }

        return response()->json(['message' => 'Error subscribbing to the topic'], 400);
    }
}
