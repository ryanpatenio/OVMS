<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\BallotService\PartiesService;
use App\Http\Requests\PartyFormRequest;
use App\Http\Requests\UpdatePartyRequest;

class PartiesController extends Controller
{
    //
    private $PartiesService;

    /*  Note All the Code Found in the App/BallotService/PartiesService.php            */

    public function __construct(PartiesService $Service){
        $this->PartiesService = $Service;
    }

    //Party Homepage
    public function PartyIndex(){
        $ballotData = $this->PartiesService::ShowBallot();
        $parties = $this->PartiesService::ShowParties();

        return view('ballotAdmin.party.index',compact('ballotData','parties'));
    }
    public function viewParty($party_id){
        if(Gate::denies('manage-ballots')){
            abort(403);
        }
        $getSelectedParty = $this->PartiesService::getPartyByIDView($party_id);
        $PartyMembers = $this->PartiesService::getAllSelectedParty($party_id);

       return view('ballotAdmin.party.view-party',compact('getSelectedParty','PartyMembers'));
    }

    public function AddParty(PartyFormRequest $request){
        if(Gate::denies('manage-ballots')){
            abort(403);
        }
        return $this->PartiesService->StoreParty($request);

    }

    public function EditParty(Request $request){
        if(Gate::denies('manage-ballots')){
            abort(403);
        }
        return $this->PartiesService->getPartyByID($request->p_ID);

    }
    public function Update(UpdatePartyRequest $request){
        if(Gate::denies('manage-ballots')){
            abort(403);
        }
        return $this->PartiesService->UpdateParty($request);
    }

    public function getList(Request $request){
        if(Gate::denies('manage-ballots')){
            abort(403);
        }

        return $this->PartiesService->getAllCandidatesNoParty($request->ballot_ID);
    }

    public function storeCandidatesToParty(Request $request){
        if(Gate::denies('manage-ballots')){
            abort(403);
        }
        return $this->PartiesService->addCandidateToParty($request);
    }

    public function removeCandidate(Request $request){
        if(Gate::denies('manage-ballots')){
            abort(403);
        }
        return  $this->PartiesService->removeCandidateInParty($request->candidate_id);
    }

}
