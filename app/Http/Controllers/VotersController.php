<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BallotService\BallotService;
use App\BallotService\VotersService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\VotersAddRequest;
use App\Http\Requests\editVotersRequest;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\addCandidateToVotersRequest;


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
        return view('voters.vote-now');

    }

    public function search(Request $request){
        return $this->VotersService->searchCandidateByName($request->name);
    }

    public function find(Request $request){
        return $this->VotersService->findAndFetch($request->candidate_id);
    }

    public function addToVoter(addCandidateToVotersRequest $request){
        return $this->VotersService->addCandidateAsVoters($request);
    }

    public function editVoters(Request $request){
        return $this->VotersService->getVotersDataById($request->ID);
    }
    public function update(editVotersRequest $request){
        return $this->VotersService->updateVoters($request);
    }

    public function destroyVoters(Request $request){
        return $this->VotersService->destroy($request->ID);
    }



}
