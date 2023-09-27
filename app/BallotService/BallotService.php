<?php
 namespace App\BallotService;


 use App\BallotService\StatusRepository;
 use App\Models\Position;
 use Illuminate\Support\Facades\Auth;
 use App\Models\Ballot;

 class BallotService{

    private $statusResponse;

    public function __construct(StatusRepository $statusResponse){

        $this->statusResponse = $statusResponse;

    }

    public function showBallotData(){
       return  Ballot::where('id',Auth::id())->get(['ballot_id','ballot_name','ballot_key','id']);
    }

    public function getBallotById($ballot_id){
        return  Ballot::where('ballot_id',$ballot_id)->where('id',Auth::id())->firstOrFail();
    }

    public function updateMyBallot($request){
        $find = Ballot::where('id',Auth::id())->where('ballot_id',$request->id)->first();

        if($find){
            $save = Ballot::where('ballot_id',$request->id)->update($request->only('ballot_name','details','ballot_key'));
            if($save){
                return $this->statusResponse->status('success',200);
            }
            return $this->statusResponse->status('error_save',400);

        }
        return $this->statusResponse->status('error_find',400);

    }

    public function getPositionById($pos_id){
        return Position::where('position_id',$pos_id)->get(['position_id','position_name']);
    }

    public function updatePosById($request){
        $find = Position::where('position_id',$request->position_id)->first();
        if($find){
           $save = Position::where('position_id',$request->position_id)->update($request->only('position_name'));
          return $this->statusResponse->status('success',200);
        }
        return $this->statusResponse->status('err_find',400);
    }

    public function fetchPositionData($ballot_id){
      return Position::where('ballot_id',$ballot_id)->get(['position_id','position_name']);
    }


 }


?>


