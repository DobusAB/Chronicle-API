<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class ExampleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    function login(Request $request) {
        $access_token = $request->input('accesstoken');
        $graph_url = 'https://graph.facebook.com/debug_token?input_token=' 
            . $access_token . 
            '&access_token=588119041338106|d45ab402e24564e38f3bd7144172f3a7';
        $userId = json_decode(file_get_contents($graph_url))->data->app_id;
        
        return [$userId];
    }

    
}
