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

    public function __construct(PartiesService $Service){
        $this->PartiesService = $Service;
    }


    public function PartyIndex(){
        if(Gate::denies('manage-ballots')){
            abort(403);
        }
        $ballotData = $this->PartiesService::ShowBallot();
        $parties = $this->PartiesService::ShowParties();

        return view('ballotAdmin.party.index',compact('ballotData','parties'));
    }
    public function viewParty(){
        if(Gate::denies('manage-ballots')){
            abort(403);
        }
        return view('ballotAdmin.party.view-party');
    }

    public function AddParty(PartyFormRequest $request){
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


}
