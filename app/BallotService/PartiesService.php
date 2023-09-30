<?php
namespace App\BallotService;

use App\Models\Ballot;
use App\Models\Parties;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\BallotService\StatusRepository;


class PartiesService{

    private $StatusResponse;

    public function __construct(StatusRepository $statusResponse){

        $this->StatusResponse = $statusResponse;

    }

    public static function ShowBallot(){
        $data = Ballot::where('id',Auth::id())
        ->where('publish_status','0')
        ->get(['ballot_id','ballot_name']);
        return $data;
    }


    //note!! when using First() in laravel Eloquent DB builder
    //you can only use this if you want to return JSON format but in Array
    // or Compact Laravel it will not work!
    public static function ShowParties(){
        // $party = DB::table('ballots')
        // ->select('ballots.ballot_name','parties.party_name','parties.party_id','ballots.ballot_id')
        // ->leftJoin('parties','parties.ballot_id','=','ballots.ballot_id')
        // ->where('ballots.ballot_status',0)
        // ->where('ballots.publish_status',0)
        // ->get();

        $party = DB::table('parties')
        ->crossJoin('ballots')
        ->select('parties.party_id', 'ballots.ballot_id', 'parties.party_name', 'ballots.ballot_name')
        ->where('parties.ballot_id','=',DB::raw('ballots.ballot_id'))
        ->where('parties.status','=',0)
        ->get();

      return $party;
    }

    public function StoreParty($request){
        $store = Parties::create($request->only('ballot_id','party_name'));
        if($store){
          return  $this->StatusResponse->status('success',200);
        }
        return $this->StatusResponse->status('error_request',400);

    }
    public function getPartyByID($party_id){
        if($party_id != null){
            $find = DB::table('parties')
            ->crossJoin('ballots')
            ->select('ballots.ballot_id','parties.party_id','parties.party_name','ballots.ballot_name')
            ->where('parties.ballot_id','=',DB::raw('ballots.ballot_id'))
            ->where('parties.party_id',$party_id)
            ->where('parties.status','=',0)
            ->get(['party_id','party_name','ballot_id']);


           return response()->json([
            'data'=>$find,
           ]);
        }
        return $this->StatusResponse->status('error_find',400);
    }
    public function UpdateParty($request){
       $update = Parties::where('party_id',$request->party_id)
       ->update($request->only('party_name','ballot_id'));
       if($update){
        return $this->StatusResponse->status('success',200);
       }
       return $this->StatusResponse->status('proccess_error',422);
    }
}

?>
