<?php
namespace App\BallotService;

use App\Models\Ballot;
use App\Models\Parties;
use App\Models\Candidates;
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
        ->where('ballots.id',Auth::id())
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
       ->update($request->only('party_name'));
       if($update){
        return $this->StatusResponse->status('success',200);
       }
       return $this->StatusResponse->status('proccess_error',422);
    }

    public static function getPartyByIDView($party_id){
        if($party_id != null){
            $fetchParty =DB::table('parties')
            ->crossJoin('ballots')
            ->select('parties.party_id', 'parties.party_name', 'ballots.ballot_id', 'ballots.ballot_name')
            ->where('parties.ballot_id','=',DB::raw('ballots.ballot_id'))
            ->where('parties.party_id','=',$party_id)
            ->first('parties.party_id','parties.party_name','ballots.ballot_id');
            return $fetchParty;
        }
        return $this->StatusResponse->status('error_party_id',422);
    }
    public static function getAllSelectedParty($party_id){

        if($party_id != null){
            $viewPartyTableData =  DB::table('parties')
                ->crossJoin('candidates')
                ->crossJoin('positions')
                ->crossJoin('ballots')
                ->select('candidates.candidate_id', 'candidates.candidate_name', 'positions.position_name', 'ballots.ballot_name', 'parties.party_name', 'parties.party_id')
                ->where('parties.party_id','=',DB::raw('candidates.party_id'))
                ->where('candidates.position_id','=',DB::raw('positions.position_id'))
                ->where('positions.ballot_id','=',DB::raw('ballots.ballot_id'))
                ->where('parties.party_id','=',$party_id)
                ->get();
                return $viewPartyTableData;
        }
        return $this->StatusResponse->status('error_id',422);


    }

    public function getAllCandidatesNoParty($ballot_id){
        if($ballot_id != null){

            $candidateList =  DB::table('candidates')
            ->crossJoin('ballots')
            ->crossJoin('positions')
            ->select('candidates.candidate_id', 'candidates.candidate_name', 'positions.position_name')
            ->where('candidates.ballot_id','=',DB::raw('ballots.ballot_id'))
            ->where('positions.position_id','=',DB::raw('candidates.position_id'))
            ->whereNull('candidates.party_id')
            ->where('ballots.ballot_id','=',$ballot_id)
            ->get();

            return response()->json([
                'dataCandidates'=>$candidateList
            ]);
        }

        return $this->StatusResponse->status('error_id',422);
    }

    public function addCandidateToParty($request){

        if($request->candidate_id != null){
            foreach ($request->candidate_id as $id) {
                Candidates::where('candidate_id',$id)
                ->update($request->only('party_id'));

            }
            return $this->StatusResponse->status('success',200);
        }
        return $this->StatusResponse->status('processing_error',422);

    }

    public function removeCandidateInParty($candidate_id){
       $setPartyIdToNull =  Candidates::where('candidate_id',$candidate_id)
        ->update(['party_id'=> null]);

        if($setPartyIdToNull){
          return $this->StatusResponse->status('success',200);
        }

        return $this->StatusResponse->status('processing_error',422);
    }
}

?>
