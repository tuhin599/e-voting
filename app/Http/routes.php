<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', [
    'uses' => 'UserController@index',
    'as' => 'index',
]);
Route::get('/login', [
    'uses' => 'UserController@login',
    'as' => 'user.login',
]);
Route::get('/add_candidate', [
    'uses' => 'UserController@addCandidateInterface',
    'as' => 'add.candidate',
    'middleware'=>'auth'
]);
Route::get('/list_candidate', [
    'uses' => 'UserController@listCandidateInterface',
    'as' => 'list.candidate',
    'middleware'=>'auth'
]);
Route::get('/add_voter', [
    'uses' => 'UserController@addVoterInterface',
    'as' => 'add.voter',
    'middleware'=>'auth'
]);
Route::post('/add_voter', [
    'uses' => 'UserController@addVoter',
    'as' => 'add.voter',
    'middleware'=>'auth'
]);
Route::get('/list_voter', [
    'uses' => 'UserController@listVoterInterface',
    'as' => 'list.voter',
    'middleware'=>'auth'
]);
Route::post('/add_candidate', [
    'uses' => 'UserController@addCandidate',
    'as' => 'add.candidate',
    'middleware'=>'auth'
]);

Route::get('/dashboard', [
    'uses' => 'UserController@userDashboard',
    'as' => 'user.dashboard',
    'middleware'=>'auth'
]);

Route::post('/registration', [
    'uses' => 'UserController@postRegistration',
    'as' => 'user.registration',
]);
Route::get('/registration', [
    'uses' => 'UserController@getRegistration',
    'as' => 'user.registrationform',
    'middleware'=>'guest'
]);

Route::get('/logout', [
    'uses' => 'UserController@logout',
    'as' => 'user.logout',
    'middleware'=>'auth'
]);

Route::get('/change/profile',[
    'uses' => 'UserController@changeProfileInterface',
    'as' => 'change.profile',
    'middleware'=>'auth'
]);
Route::post('/change/profile/{id?}',[
    'uses' => 'UserController@changeProfile',
    'as' => 'change.profile',
    'middleware'=>'auth'
]);


Route::get('/profile',[
    'uses' => 'UserController@candidateProfile',
    'as' => 'candidate.profile.all',
    'middleware'=>'auth'
]);

Route::get('/profile/edit',[
    'uses' => 'UserController@profileEditInterface',
    'as' => 'edit.profile',
    'middleware'=>'auth'
]);
Route::post('/profile/edit',[
    'uses' => 'UserController@profileEdit',
    'as' => 'edit.profile',
    'middleware'=>'auth'
]);

Route::get('/confirm/email',[
    'uses' => 'UserController@confirmEmail',
    'as' => 'confirm.email',
]);

Route::get('/reset/password',[
    'uses'=>'UserController@resetPasswordInterface',
    'as'=>'reset.password',
    'middleware'=>'auth'
]);
Route::post('/reset/password',[
    'uses'=>'UserController@resetPassword',
    'as'=>'reset.password',
    'middleware'=>'auth'
]);
Route::post('/voter/request/{id?}',[
    'uses'=>'UserController@voterRequest',
    'as'=>'voter.request',
    'middleware'=>'auth'
]);
Route::get('/request',[
    'uses'=>'UserController@requestInterface',
    'as'=>'voter.request.interface',
    'middleware'=>'auth'
]);
Route::get('/request/voterlist',[
    'uses'=>'UserController@requestVoterList',
    'as'=>'request.voter.list',
    'middleware'=>'auth'
]);
Route::get('/vote/candidate/{id}/{election}',[
    'uses'=>'UserController@voteCandidate',
    'as'=>'vote.candidate',
    'middleware'=>'auth'
]);

Route::get('/request/{type}/{id}',[
    'uses'=>'UserController@voterRequestAction',
    'as'=>'request.action',
    'middleware'=>'auth'
]);
Route::get('/add-region',[
    'uses'=>'UserController@addRegionInterface',
    'as'=>'add.region.interface',
    'middleware'=>'auth'
]);
Route::post('/add-rigion',[
    'uses'=>'UserController@addRegion',
    'as'=>'add.region',
    'middleware'=>'auth'
]);
Route::post('/create/election',[
    'uses'=>'UserController@createElection',
    'as'=>'create.election',
    'middleware'=>'auth'
]);

Route::get('start/election/{id}',[
    'uses'=>'UserController@startElection',
    'as'=>'start.election',
    'middleware'=>'auth'
]);

Route::get('stop/election/{id}',[
    'uses'=>'UserController@stopElection',
    'as'=>'stop.election',
    'middleware'=>'auth'
]);
Route::get('delete/candidate/{id}',[
    'uses'=>'UserController@deleteCandidate',
    'as'=>'delete.candidate',
    'middleware'=>'auth'
]);
Route::get('get/candidatelist',[
    'uses'=>'UserController@getSelectedCandidate',
    'as'=>'get.selected.candidate',
    'middleware'=>'auth'
]);

