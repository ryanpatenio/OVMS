<?php
 namespace App\BallotService;

class StatusRepository{

    public function status($message,$statusCode){
        return response()->json([

            'message'=>$message
        ],$statusCode);
    }
}



?>
