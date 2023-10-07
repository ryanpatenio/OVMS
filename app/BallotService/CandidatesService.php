<?php
 namespace App\BallotService;


 use App\Models\Candidates;
 use App\BallotService\StatusRepository;
 use App\Models\Parties;
 use App\Models\Position;
 use Illuminate\Support\Facades\Auth;
 use App\Models\Ballot;
 use Illuminate\Support\Facades\DB;
 use App\Http\Requests\CandidatesFormRequest;


class CandidatesService{


    private $statusResponse;

    public function __construct(StatusRepository $statusResponse){

        $this->statusResponse = $statusResponse;

    }

    public function CandidatesData(){
     return  DB::table('candidates')
     ->crossJoin('positions')
     ->crossJoin('ballots')
     ->select('candidates.candidate_id', 'candidates.candidate_name', 'positions.position_name', 'ballots.ballot_name')
     ->where('ballots.ballot_id','=',DB::raw('candidates.ballot_id'))
     ->where('candidates.position_id','=',DB::raw('positions.position_id'))
     ->where('ballots.id',Auth::id())
     ->get();

     }

     public function getAllBallotData(){
        return Ballot::where('id',Auth::id())
        ->where('publish_status','0')->get([
            'ballot_id','ballot_name'
        ]);
     }

public function getBallotPositionById($ballot_id){
    return Position::where('ballot_id',$ballot_id)->get(['position_id','position_name']);
}

public function showPartiesById($ballot_id){
    return Parties::where('ballot_id',$ballot_id)->get(['party_id','party_name']);
}

public function Store($request){

    if($request->ballot_id != 0 ||$request->ballot_id != null ){
       // not null
        $create = Candidates::create($request->only('candidate_name','ballot_id','position_id','party_id'));
        if($create){
            return $this->statusResponse->status('success',200);
        }
        return $this->statusResponse->status('processing_error',400);
        //return $request;
    }else{
        return $this->statusResponse->status('ballot_id_err',400);
    }

}
public function editCandidate($candidate_id){

    $find = DB::table('candidates')
    ->select(
        'ballots.ballot_id',
        'ballots.ballot_name',
        'candidates.candidate_id',
        'candidates.candidate_name',
        'positions.position_id',
        'positions.position_name',
        'parties.party_id',
        'parties.party_name'
         )
    ->leftJoin('ballots','candidates.ballot_id','=','ballots.ballot_id')
    ->leftJoin('positions','candidates.position_id','=','positions.position_id')
    ->leftJoin('parties','candidates.party_id','=','parties.party_id')
    ->where('candidates.candidate_id','=',$candidate_id)
    ->first();
    if(!$find){
        return 'error';

    }
    return response()->json([
        'data' => $find,
    ]);


}

public function updateCandidateById($request){
    $find = Candidates::where('candidate_id',$request->candidate_id)->firstOrFail();
    if(!$find){
        return $this->statusResponse->status('error_find',400);
    }
    $update = Candidates::where('candidate_id',$request->candidate_id)
    ->update($request->only('ballot_id','candidate_name','position_id','party_id'));

    if($update){
        return $this->statusResponse->status('success',200);
    }
   return $this->statusResponse->status('error_process',400);
}

}



?>
