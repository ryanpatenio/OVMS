<?php

namespace App\Http\Controllers;

use App\BallotService\BallotService;
use App\Models\Ballot;

use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\BallotRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\PositionRequest;

class BallotAdminController extends Controller
{

    private $BallotService;

    public function __construct(BallotService $BallotService){

        $this->BallotService = $BallotService;

    }

    //DASHBOARD
    public function index(){
        if(Gate::denies('manage-ballots')){
            abort(403);
        }
        return view('ballotAdmin.dashboard-body');
    }

    //MyBallot SideBar
    public function MyBallotsIndex(){
        $ballots = $this->BallotService->showBallotData();

        return view('ballotAdmin.ballot.ballot-dashboard',compact('ballots'));
    }
    public function RedirectAddBallot(){
        return view('ballotAdmin.ballot.add-ballot');
    }
    //end of MyBallot SideBar



    //Results Controller
    public function ResultsIndex(){
        return view('ballotAdmin.results.index');
    }
    //end of Results Controller

    //Profile Controller
    public function ProfileIndex(){
        return view('ballotAdmin.profile.index');
    }
    //end of Profile Controller

    //Position Controller
    public function PositionIndex(){
        $ballots = $this->BallotService->showBallotData();

            return view('ballotAdmin.position.index',compact('ballots'));
    }
    public function showPositionForm($ballot_id){

        $ballot = $this->BallotService->getBallotById($ballot_id);

            return view('ballotAdmin.position.view-ballot-pos',compact('ballot'));

    }


    //End of Position Controller



//Storing and updating Data and Fetch
public function AddBallot(BallotRequest $request){

   $ballot= Ballot::create($request->validated());
    if($ballot){
       return response()->json(['status'=>'success']);
    }
    return response()->json(['status'=>'Unexpected Error!'],JsonResponse::HTTP_UNPROCESSABLE_ENTITY);

}

public function EditBallot($ballot_id){
    if(Gate::denies('manage-ballots')){
        abort(403);
    }
    $ballotData = $this->BallotService->getBallotById($ballot_id);

    return view('ballotAdmin.ballot.edit-ballot',compact('ballotData'));

}

public function updateBallot(BallotRequest $request){
    if(Gate::denies('manage-ballots')){
        abort(403);
    }
    $save = $this->BallotService->updateMyBallot($request);
   return $save;
}


public function addPosition(Request $request){
    if(Gate::denies('manage-ballots')){
        abort(403);
    }

    $checkIfExist = Position::where('position_name','=',$request->position_name)
    ->where('ballot_id',$request->ballot_id)->first();

    if(is_null($checkIfExist)){
        //Position Name is not already Exist
        $position= Position::create($request->all());
        return response()->json(['status'=>'success'],200);
    }else{
        //Position Name is already Exist! return status code 400 Bad Request
        return response()->json([
            'error'   =>  true,
            'message'   =>  'pos_unique_err'
        ], 400);

    }

    return response()->json(['status'=>'error'],JsonResponse::HTTP_UNPROCESSABLE_ENTITY);

}

public function getPositionData(Request $request){
    $pos_id = $request->pos_id;
    $find = Position::where('position_id',$pos_id)->first();
    if($find){
        return response()->json([
            'data'=>$fetchPos = $this->BallotService->getPositionById($pos_id),
        ]);
    }
    return response()->json([
        'error'=>true,
        'message'=>'error_find_id'

    ],400);
}
public function updatePosition(Request $request){
    return $save = $this->BallotService->updatePosById($request);
}

public function fetchPosData($ballot_id){
    if(Gate::denies('manage-ballots')){
        abort(403);
    }

    $PosData = $this->BallotService->fetchPositionData($ballot_id);
    return response()->json([
        'position'=> $PosData,

    ]);
}

}
