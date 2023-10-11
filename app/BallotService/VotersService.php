<?php
 namespace App\BallotService;

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
        $data = DB::table('voters')
        ->crossJoin('ballots')
        ->crossJoin('users')
        ->select('users.id', 'users.name', 'users.role', 'ballots.ballot_name')
        ->where('voters.ballot_id','=',DB::raw('ballots.ballot_id'))
        ->where('voters.user_id','=',DB::raw('users.id'))
        ->where('ballots.id','=',Auth::id())
        ->where('users.role','=',3)
        ->where('ballots.publish_status','=',0)//it means this ballot not publish yet
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


}

?>
