<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Promise\Utils;

class PublisherController extends Controller
{
    public function publish(Request $request, $topic)
    {
        $get_subscribers = Subscriber::where('topic', $topic)->get();
        $data['topic'] = $topic;
        $data['message'] = collect($request->all());

        //Check if there are subscribers
        if(count($get_subscribers)){
            $client = new Client();
            $subscribers = [];

            foreach ($get_subscribers as $subscriber) {
                $subscribers[] = $client->requestAsync('GET', $subscriber->url);
            }
            //initiate the POST request
            $responses = Utils::settle($subscribers)->wait();
            $fulfilled = 0;
            $rejected = 0;
            foreach ($responses as $response) {
               $state = $response['state'];
               if($state == 'fulfilled'){
                    $fulfilled += 1;
               }elseif($state == 'rejected'){
                    $rejected += 1;
               }
            }
            return response()->json(['message' => $fulfilled.' published and '. $rejected.' failed'], 200);
        }

        return response()->json(['message' => 'No  subscriber Found'], 200);

    }
}
