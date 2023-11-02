<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\VotersController;
use App\Http\Controllers\PartiesController;
use App\Http\Controllers\CandidatesController;
use App\Http\Controllers\BallotAdminController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


//check? authenticated users || check what role?
Route::group(['middleware'=>'auth'],function(){

    Route::group(['middleware'=>'role:admin','prefix'=>'admin'],function(){

            Route::get('/dashboard-admin',[AdminController::class,'index'])->name('admin.dashboard');

            Route::get('/super-admin-ballot',function(){
                return view('admin.ballot-folder.index');
            });
            Route::get('/super-admin-ballot-creator',function(){
                return view('admin.ballot-folder.ballot-creator.index');
            });

            // Route::get('/super-admin-dashboard',function(){
            //     return view('admin.dashboard-admin');
            // });
            Route::get('/super-admin-candidates',function(){
                return view('admin.candidates-folder.index');
            });
            Route::get('/super-admin-profile',function(){
                return view('admin.profile-folder.index');
            });
            Route::get('/super-admin-results',function(){
                return view('admin.results-folder.index');
            });
            Route::get('/super-admin-users',function(){
                return view('admin.user-folder.index');
            });
            Route::get('/super-admin-voters-index',function(){
                return view('admin.voters-folder.approved');
            });
            // Route::get('/admin-all-voters',[BallotAdminController::class,'VotersIndex'])
            // ->name('ballotAdmin.voters.index');

    });

    //for Ballot Creators
Route::group(['middleware'=>'role:ballotCreator','prefix'=>'ballotAdmin'],function(){

        Route::get('/ballot-dashboard',[BallotAdminController::class,'index'])
        ->name('ballot.index');
        Route::get('/ballot-page',[BallotAdminController::class,'MyBallotsIndex'])
        ->name('MyBallots.index');
        Route::get('/pages-add-ballot',[BallotAdminController::class,'RedirectAddBallot'])
        ->name('addBallotPage');



        //Ballot Routes Insert and Update
        Route::post('/add-ballot',[BallotAdminController::class,'AddBallot'])->name('store.ballot');
        Route::get('/edit-ballot/{ballot_id}/edit',[BallotAdminController::class,'EditBallot'])
        ->name('edit.ballot');
        Route::post('/update-ballot',[BallotAdminController::class,'updateBallot'])
        ->name('ballot.update');

        Route::post('/destroy-ballot',[BallotAdminController::class,'destroy'])
        ->name('delete.ballot');

        //End of Ballot Routes

        //Candidates Routes
        Route::get('/candidates-page',[CandidatesController::class,'MyCandidatesIndex'])
        ->name('MyCandidates.index');
        Route::post('/candidates-page',[CandidatesController::class,'GetPositionByBallotId'])
        ->name('get.position');
        Route::post('/candidates-page/add-Candidates',[CandidatesController::class,'StoreCandidates'])
        ->name('store.candidates');
        Route::post('/candidates-page/edit',[CandidatesController::class,'EditCandidate'])
        ->name('candidate.edit');

        Route::post('/candidates/update',[CandidatesController::class,'UpdateCandidate'])
        ->name('update.candidate');
        //end of Candidates Routes

        //Voters Routes
        Route::get('/voters-page',[VotersController::class,'VotersIndex'])
        ->name('voters.index');
        Route::get('/voters-page-add',[VotersController::class,'AddVotersPage'])
        ->name('voters.add');
        Route::post('/voters-page-store',[VotersController::class,'Store'])
        ->name('voter.store');

        Route::post('/voters-page/store-candidate-voterTable',[VotersController::class,'addToVoter'])
        ->name('add.candidate.to.voter');
        Route::post('/edit-voters',[VotersController::class,'editVoters'])
        ->name('edit.voters');
        Route::post('/update-voters',[VotersController::class,'update'])
        ->name('voters.update');
        Route::post('/destroy-voters',[VotersController::class,'destroyVoters'])
        ->name('delete.voters');

        //Search Bar Candidates
        Route::post('/voters-page/search',[VotersController::class,'search'])
        ->name('search.input');
        Route::post('/voters-page/find-candidates',[VotersController::class,'find'])
        ->name('find.candidates');
        //end of Voters Routes

        //Results Routes
        Route::get('/Result-pages',[BallotAdminController::class,'ResultsIndex'])
        ->name('results.index');
        //end of Results Routes

        //Profile Routes
        Route::get('/profile-page',[BallotAdminController::class,'ProfileIndex'])
        ->name('profile.index');
        //end of Profile Routes

        //Party Routes
        Route::get('/party-page',[PartiesController::class,'PartyIndex'])
        ->name('party.index');
        Route::get('/view-party-page/{party_id}/view',[PartiesController::class,'viewParty'])
        ->name('view.party');

        Route::post('/party-page/add',[PartiesController::class,'AddParty'])
        ->name('party.add');
        Route::post('/party-page/edit',[PartiesController::class,'EditParty'])
        ->name('edit.party');
        Route::post('/party-page/update',[PartiesController::class,'Update'])
        ->name('update.party');

        Route::post('/party-page/getListOfCandidatesNoParty',[partiesController::class,'getList'])
        ->name('get.partyList');
        Route::post('/party-page/storeCandidatesToParty',[PartiesController::class,'storeCandidatesToParty'])
        ->name('store.candidatesToParty');
        Route::post('/party-page/removeCandidate-To-Party',[PartiesController::class,'removeCandidate'])
        ->name('remove.candidate');
        //end of Party Routes

        //Route for Position
        Route::get('/position-page',[BallotAdminController::class,'PositionIndex'])
        ->name('position.index');
        Route::get('/add-position-view/{ballot_id}/add',[BallotAdminController::class,'showPositionForm'])
        ->name('add.position.form');

        //add Edit and update Position
        Route::post('/add-position',[BallotAdminController::class,'addPosition'])
        ->name('add.position');
        Route::post('/getPosition/edit',[BallotAdminController::class,'getPositionData'])
        ->name('get.pos.data');
        Route::post('/update-Position',[BallotAdminController::class,'updatePosition'])
        ->name('update.position');


        Route::get('/getPositionData/{ballot_id}',[BallotAdminController::class,'fetchPosData'])
        ->name('fetchPosData');


});

//for Voters
Route::group(['middleware'=>'role:voters|candidates','prefix'=>'voters'],function(){
    Route::get('vote-now-page',[VotersController::class,'VoteNowPage'])
    ->name('vote.now.page');

    });

});

//you can only access this route if you are already login or authenticated
Route::group(['middleware'=>'auth'],function(){

// Route::get('/voters',[VotersController::class,'index'])->name('voters.index');

//change it in the future
    // Route::get('vote-now-page',[VotersController::class,'VoteNowPage'])
    // ->name('vote.now.page');

    Route::get('/view-ballot',function(){
        return view('ballotAdmin.ballot.view-ballot');
    });
    Route::get('/view-candidates',function(){
        return view('ballotAdmin.candidates.view-candidates');
    });

});



//the visitor can only access this routes
    Route::get('/', function () {
        return view('welcome');
    });
    Route::get('/about-us',function(){
        return view('about');
    });
    Route::get('/contact-us',function(){
        return view('contact');
    });

Auth::routes();
