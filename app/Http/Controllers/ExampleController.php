<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Validation;
use App\User;

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
        $app_id_server_side = "588119041338106";
        $access_token = $request->input('accesstoken');
        $graph_url = 'https://graph.facebook.com/debug_token?input_token=' 
            . $access_token . 
            '&access_token=588119041338106|d45ab402e24564e38f3bd7144172f3a7';
        $graph_data = @file_get_contents($graph_url);

        if (!$graph_data || !json_decode($graph_data)->data->is_valid) {
            return "NOT VALID";
        } else {
            //User has a legit access token from Facebook to our app

            $user = User::where('facebook_user_id', json_decode($graph_data)->data->user_id)->first();
            if ($user) {
                //user already exists
                return $user;
            } else{
                //create new
                $user = new User;
                $user->facebook_user_id = json_decode($graph_data)->data->user_id;
                $user->facebook_access_token = $access_token;
                $user->save();
                return $user;  
                return [json_decode($graph_data)]; 
                return "Welcome to Chronicle";
            }
        }
        return ["err"];
    }

    
}
