<?php

namespace App\Http\Controllers;

use App\BallotService\VotersService;
use Illuminate\Http\Request;
use App\BallotService\BallotService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\VotersAddRequest;
use Illuminate\Support\Facades\Validator;


class VotersController extends Controller
{
    private $ballotService,$VotersService;

    public function __construct(BallotService $ballot,VotersService $voters){
        $this->ballotService = $ballot;
        $this->VotersService = $voters;
    }

    public function VotersIndex(){
        $Voters = $this->VotersService->showAll();

        return view('ballotAdmin.voters.index',compact('Voters'));
    }



    public function AddVoters(){
        if(Gate::denies('manage-ballots')){
            abort(403);
        }
        $ballots = $this->ballotService->showBallotData();

        return view('ballotAdmin.voters.add-voters',compact('ballots'));
    }
    public function Store(VotersAddRequest $request){
        if(Gate::denies('manage-ballots')){
            abort(403);
        }
        return $this->VotersService->addVoters($request);
    }

    public function VoteNowPage(){
        if(Gate::denies('can-vote')){
            abort(403);
        }
        return view('voters.vote-now');
    }

    public function search(Request $request){
        return $this->VotersService->searchCandidateByName($request->name);
    }




}
