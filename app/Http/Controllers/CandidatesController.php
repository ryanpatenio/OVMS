<?php

namespace App\Http\Controllers;


use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\BallotService\StatusRepository;
use App\BallotService\CandidatesService;
use App\Http\Requests\CandidatesFormRequest;
use App\Http\Requests\CandidateUpdateRequest;

class CandidatesController extends Controller
{
        /*  Note All the Code Found in App/BallotService/BallotService.php         */   
        /* for Status Response Found in App/BallotService/StatusRepository.php  */  
    private $CandidatesService,$StatusResponse;

    public function __construct(CandidatesService $CandidatesService,StatusRepository $StatusResponse){


        $this->CandidatesService = $CandidatesService;
        $this->StatusResponse = $StatusResponse;


    }

    //home page of Candidates
    public function MyCandidatesIndex(){
        if(Gate::denies('manage-ballots')){
            abort(403);
        }

        $candidates = $this->CandidatesService->CandidatesData();
        $ballots = $this->CandidatesService->getAllBallotData();

        //return 2 Arrays
        return view('ballotAdmin.candidates.index',compact('candidates','ballots'));
    }

    //this function will search all position data from specific ballot id
    public function GetPositionByBallotId(Request $request){
        if(Gate::denies('manage-ballots')){
            abort(403);
        }
        $ballot_id = $request->ballot_id;
            $find = Position::where('ballot_id',$ballot_id)->first();
            if($find){
                return response()->json([
                    'data'=> $this->CandidatesService->getBallotPositionById($ballot_id),
                    'data_parties'=> $this->CandidatesService->showPartiesById($ballot_id),
                ]);
            }
           // return $this->StatusResponse->status('error_find',400);
            return response()->json([
                'message'=>'error_find',
                'data_id'=>$ballot_id,

            ],400);
    }

    public function StoreCandidates(CandidatesFormRequest $request){
        return $this->CandidatesService->Store($request);
        //return $this->CandidatesService->StoreCandidates($request);
    }
    public function EditCandidate(Request $request){
      return  $this->CandidatesService->editCandidate($request->candidate_id);
    }

    public function UpdateCandidate(CandidateUpdateRequest $request){
        return $this->CandidatesService->updateCandidateById($request);
    }


}
