<?php
 namespace App\BallotService;

 use App\Models\VotesDetails;
 use App\Models\Votes;
 use App\Models\Candidates;
 use Illuminate\Support\Facades\Auth;
 use Illuminate\Support\Facades\DB;
 use App\Models\Voters;
 use App\Models\User;
 use App\BallotService\StatusRepository;

class VotersService{

    private $StatusResponse;

    public function __construct(StatusRepository $statusResponse){

        $this->StatusResponse = $statusResponse;

    }

    public function showAll(){
        $data = DB::table('users')
        ->crossJoin('ballots')
        ->crossJoin('voters')
        ->select('users.id', 'users.name', 'ballots.ballot_name')
        ->where('users.id','=',DB::raw('voters.user_id'))
        ->where('ballots.ballot_id','=',DB::raw('voters.ballot_id'))
        ->where('ballots.id','=',Auth::id())
        ->whereIn('users.role',[3, 4])
        ->where('ballots.publish_status','=',0)
        ->get();

        return $data;
    }

    public function addVoters($request){
      $id = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'contact'=> $request->contact,
            'password' => $request->password,
            'role' => 3
        ])->id;
        //check if data is inserted successfully!
        if($id){
            //true
            $arrayInput = [
                'user_id'=> $id,
                'ballot_id'=> $request->ballot_id
            ];
            $saveToVoters = Voters::create($arrayInput);
            if($saveToVoters){
                return $this->StatusResponse->status('success',200);
            }
            return $this->StatusResponse->status('process_error[2]',422);

        }
        return $this->StatusResponse->status('process_error',422);
    }

    public function searchCandidateByName($name){
        $trimName = trim($name);
        if($name != null){
            $search = DB::table('candidates')
            ->crossJoin('ballots')
            ->select('candidates.candidate_id', 'candidates.candidate_name')
            ->where('candidates.ballot_id','=',DB::raw('ballots.ballot_id'))
            ->where('ballots.id','=',Auth::id())
            ->where ('candidates.candidate_name', 'LIKE', '%'. $trimName. '%')
            ->get();

            return response()->json([
                'data'=>$search
            ]);

        }


    }

    public function findAndFetch($candidate_id){

       $find =  Candidates::where('candidate_id',$candidate_id)
        ->where('user_id',null)
        ->first(['candidate_id','ballot_id','candidate_name']);

        if($find){
            //not already added in voters table
            return response()->json([
                'data'=>$find
            ]);
        }else{
            //it means this candidate is already added in Voters table
            return 0;
        }
    }

    public function addCandidateAsVoters($request){
        $id = User::create([
            'name' => $request->candidate_name,
            'email' => $request->email,
            'contact'=> $request->contact,
            'password' => $request->password,
            'role' => 4
        ])->id;
        if($id){
            $arrayInput = [
                'user_id'=> $id,
                'ballot_id'=> $request->ballot_id
            ];
            $saveToVoters = Voters::create($arrayInput);
            if($saveToVoters){
                $updateCandidateUserIdColumn = Candidates::where('candidate_id',$request->candidate_id)->update(['user_id'=> $id]);
                if($updateCandidateUserIdColumn){
                    return $this->StatusResponse->status('success',200);
                }
                return $this->StatusResponse->status('errorUpdateCandidate',400);
            }
            return $this->StatusResponse->status('errorSaveVoters',400);
        }

        return $this->StatusResponse->status('error',400);

    }

    public function getVotersDataById($ID){
        $data = User::where('id',$ID)->first(['id','name','email']);
        return response()->json([
            'data'=>$data
        ]);
    }

    public function updateVoters($request){

        $findInCandidates = Candidates::where('user_id',$request->id)->first();

            if($findInCandidates){
                //this user is a candidates
                //lets update this users

                $updateUser = User::where('id',$request->id)
                ->update(['name'=>$request->name]);

                $updateCandidate = Candidates::where('user_id',$request->id)
                ->update(['candidate_name'=>$request->name]);

                    return $this->StatusResponse->status('success',200);
            }else{
                //this user is a voters only!
                    $updateUserOnly = User::where('id',$request->id)
                    ->update(['name'=>$request->name]);

                        return $this->StatusResponse->status('success',200);
            }

        return $this->StatusResponse->status('error_find',400);

    }

    public function destroy($ID){
        if($ID != null){
            $deleted = User::where('id','=',$ID)->delete();
            if($deleted){
                return $this->StatusResponse->status('success',200);
            }
            return $this->StatusResponse->status('error_ID',400);
        }

        return $this->StatusResponse->status('Error!',400);
    }
    public function showCandidatesInVotersSide(){
        $userBallotID = Voters::where('user_id',Auth::id())
        ->first(['ballot_id']);

        $candidates = DB::table('ballots')
        ->select('ballots.ballot_id', 'ballots.ballot_name', 'candidates.candidate_name', 'positions.position_name', 'candidates.party_id', 'parties.party_name', 'candidates.candidate_id')
        ->leftJoin('candidates','ballots.ballot_id','=','candidates.ballot_id')
        ->leftJoin('positions','candidates.position_id','=','positions.position_id')
        ->leftJoin('parties','candidates.party_id','=','parties.party_id')
        ->where('ballots.ballot_id','=',$userBallotID->ballot_id)
        ->get();

        $groupedData = collect($candidates)->groupBy('position_name');
        return $groupedData;

    }

    public function submitVotes($candidate_id){

        //query that returns user voters id and ballot id
        $voters = Voters::where('user_id',Auth::id())
        ->first(['voters_id','ballot_id']);


        //set the data into array to fill the Votes table
        $arrayData = [
            'voters_id'=> $voters->voters_id,
            'ballot_id'=> $voters->ballot_id
        ];

         //lets also insert the new data in the VOtes Table (voters_id & Ballot_id)
        $recordsForVoteTable = Votes::create($arrayData)->id;

        if($recordsForVoteTable){
            //check if the candidate_id is not null
            if($candidate_id != null){

                //then lets foreach insert new data into voters_details(candidate_id & vote_id)
                    foreach ($candidate_id as $id) {
                        VotesDetails::create(['vote_id'=>$recordsForVoteTable,'candidate_id'=>$id]);
                    }

                    //lets update the database table Voters the status will 1 if the Voters is already submitted his/her vote
                    $updateVotersTable = Voters::where('user_id',Auth::id())
                    ->update(['status'=>1]);

                    if($updateVotersTable){
                        //all success
                        return $this->StatusResponse->status('success',200);
                    }
                    //didn't update
                    return $this->StatusResponse->status('Error',400);

                }
                //the candidate id is null
                return $this->StatusResponse->status('Error',400);
        }
        //error for $recordsForVoteTable
        return $this->StatusResponse->status('Error',400);


    }

    public function checkIfVotedAlready(){
        $check = Voters::where('user_id',Auth::id())
        ->first('status');

        if($check->status == '1'){
            //already voted
            return 1;
        }else{
            return 2;
        }

    }

}

?>
