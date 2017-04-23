<?php

namespace App\Http\Controllers;

use App\Candidates;
use App\Elections;
use App\Emailconfirm;
use App\RegionList;
use App\User;
use App\VoteCounter;
use App\VoterRequest;
use App\Voters;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class UserController extends Controller
{
    public function postRegistration(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required|min:4',
            'national_id' => 'required',
            'name' => 'required',
            'date_of_birth' => 'required',
            'region' => 'required',
            'gender' => 'required'
        ]);
        if (User::where('email', $request->input('email'))->first()) {
            return redirect()->back()->withErrors('Sorry email already exist. Please try with another email.');
        }
        if (User::where('national_id', $request->input('national_id'))->first()) {
            return redirect()->back()->withErrors('Sorry national id already exist. Please try with valid national id.');
        }

        $user = new User();
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->national_id = $request->input('national_id');
        $user->name = $request->input('name');
        $user->user_type = 'anonymous';
        $user->address = $request->input('region');
        $user->date_of_birth = $request->input('date_of_birth');
        $user->profile_pic = "image/default.png";
        $user->gender = $request->input('gender');
        $user->save();

        $code = time() . str_random(25);
        $token = new Emailconfirm();
        $token->user_id = $user->id;
        $token->token = $code;
        $token->save();
        Log::useDailyFiles(storage_path() . '/logs/emailconfirmation.log');
        Log::info(route('confirm.email', ['user' => $user->id, 'token' => $code]));

        return redirect()->route('index')->with('message', 'Registration Successful ! Please check your email for active your account. Thanks.');
    }

    public function confirmEmail()
    {
        $user_id = Input::get('user');
        $token = Input::get('token');
        $confirm = Emailconfirm::where('user_id', $user_id)->where('token', $token)->first();
        if (!$confirm) {
            return redirect()->back()->withErrors('Sorry token is incorrect. Please try with valid token');
        }
        $user = User::find($user_id);
        if (!$user) {
            return redirect()->back()->withErrors('Sorry User is not valid. Please try with valid User');
        }

        $user->active = 1;
        $user->save();
        return redirect()->route('index')->with('message', 'Successfully confirm your account. Please login');
    }

    public function getRegistration()
    {
        $data = [
            'regions' => RegionList::all()
        ];
        return view('nonUser.registration')->with($data);
    }

    public function index()
    {
        if (Auth::check()) {

            return redirect()->route('user.dashboard');
        } else {
            return view('nonUser.home');
        }
    }

    public function login()
    {
        $credintial = [
            'email' => $email = Input::get('email'),
            'password' => $pass = Input::get('password'),
            'active' => 1,
        ];
        if (Auth::attempt($credintial)) {
            return redirect()->route('user.dashboard')->with('message', 'Successfully Login');
        } else {
            return redirect()->back()->withErrors('Login fail !! Check email or password !');
        }

    }

    public function addCandidateInterface()
    {
        $regions = RegionList::all();
        $data = [
            'user' => Auth::user(),
            'regions' => $regions
        ];
        return view('user.addcandidate')->with($data);
    }

    public function addcandidate(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'national_id' => 'required',
            'gender' => 'required',
            'birthday' => 'required | date',
            'region' => 'required',
            'file' => 'required|image',
        ]);
        $date = date_create($request->birthday);
        $d = date_format($date, 'Y-m-d');
        $pic = $request->file('file');
        $filename = time() . '.' . $pic->getClientOriginalExtension();

        $candidate = new Candidates();
        $candidate->first_name = $request->first_name;
        $candidate->last_name = $request->last_name;
        $candidate->national_id = $request->national_id;
        $candidate->gender = $request->gender;
        $candidate->date_of_birth = $d;
        $candidate->region = $request->region;
        $candidate->save();
        $fullpath = $candidate->id . '/' . $filename;
        $pic->move('candidate/' . $candidate->id, $filename);
        $candidate->mark = $fullpath;
        $candidate->save();
        return redirect()->back()->with('message', 'Successfully Added Candidate.');
    }

    public function userDashboard()
    {
        $data = [
            'user' => Auth::user(),
            'candidates' => Candidates::all(),
            'elections' => Elections::all(),
            'regions' => RegionList::all()
        ];
        return view('user.userDashboard')->with($data);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('index');
    }

    public function listCandidateInterface()
    {

        $data = [
            'user' => Auth::user(),
            'candidate' => Candidates::all()
        ];
        return view('user.listCandidate')->with($data);
    }

    public function addVoterInterface()
    {
        $data = [
            'user' => Auth::user()
        ];
        return view('user.addvoter')->with($data);
    }

    public function listVoterInterface()
    {
        $data = [
            'user' => Auth::user(),
            'voters' => Voters::all()
        ];
        return view('user.listVoter')->with($data);
    }

    public function addVoter(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'national_id' => 'required',
            'gender' => 'required',
            'birthday' => 'required | date',
            'address' => 'required',
            'file' => 'required|image',
        ]);
        $date = date_create($request->birthday);
        $d = date_format($date, 'Y-m-d');
        $pic = $request->file('file');
        $filename = time() . '.' . $pic->getClientOriginalExtension();

        $voter = new Voters();
        $voter->first_name = $request->first_name;
        $voter->last_name = $request->last_name;
        $voter->national_id = $request->national_id;
        $voter->gender = $request->gender;
        $voter->date_of_birth = $d;
        $voter->address = $request->address;
        $voter->save();
        $fullpath = $voter->id . '/' . $filename;
        $pic->move('voter/' . $voter->id, $filename);
        $voter->pic_location = $fullpath;
        $voter->save();
        return redirect() - back()->with('message', 'Successfully added Voter.');
    }

    public function changeProfileInterface()
    {
        $data = [
            'user' => Auth::user()
        ];
        return view('user.changeProfile')->with($data);
    }

    public function candidateProfile()
    {
        $data = [
            'user' => Auth::user(),
            'candidate' => Candidates::all()
        ];
        return view('user.candidateProfileAll')->with($data);
    }

    public function changeProfile($id, Request $request)
    {
        if (Auth::user()->alreadySendRequest()) {
            return redirect()->back()->withErrors('Voter request is under review. You can not update your profile.');
        }

        if ($request->hasFile('file')) {
            $user = User::find($id);
            if ($user) {
                $pic = $request->file('file');
                $filename = time() . '.' . $pic->getClientOriginalExtension();
                $fullpath = 'users' . '/' . $filename;
                $pic->move('users/', $filename);
                $user->profile_pic = $fullpath;
                $user->save();
            }
        }
        return redirect()->back();
    }

    public function profileEditInterface()
    {
        $region = RegionList::all();
        $data = [
            'user' => Auth::user(),
            'regions' => $region
        ];
        return view('user.editProfile')->with($data);
    }

    public function profileEdit(Request $request)
    {

        if (Auth::user()->user_type != 'voter') {
            if (Auth::user()->alreadySendRequest() && !Auth::user()->requestRejected()) {
                return redirect()->back()->withErrors('You can not update your profile.');
            }

            $this->validate($request, [
                'name' => 'required',
                'national_id' => 'required',
                'region' => 'required',
                'date_of_birth' => 'required'
            ]);

            $user_id = $request->input('id');
            $user = User::find($user_id);
            if (!$user) {
                return redirect()->back()->withErrors('Not a valid user.');
            }
            $user->name = $request->input('name');
            $user->national_id = $request->input('national_id');
            $user->address = $request->input('region');
            $user->date_of_birth = date_format(date_create($request->input('date_of_birth')), 'Y-m-d');
            $user->save();
            return redirect()->back()->with('message', 'Successfully Updated');

        }

    }

    public function resetPasswordInterface()
    {
        $data = [
            'user' => Auth::user()
        ];
        return view('user.resetPassword')->with($data);
    }

    public function resetPassword(Request $request)
    {
        $user = Auth::user();
        if (Hash::check($request->input('oldpassword'), $user->password)) {
            $user->password = bcrypt($request->input('newpassword'));
            $user->save();
            return redirect()->back()->with('message', 'Password successfully changed.');
        }
        return redirect()->back()->withErrors('Password is incorrect. Please try with valid password');


    }

    public function requestInterface()
    {

        $region = RegionList::all();
        $data = [
            'user' => Auth::user(),
            'regions' => $region
        ];
        return view('user.requestInterface')->with($data);

    }

    public function voterRequest($id, Request $request)
    {

        $this->profileEdit($request);

        $user = User::find($id);
        $pre = VoterRequest::where('user_id', $id)->first();
        if (!$user || !$user->user_type == 'anonymous') {
            return redirect()->back()->withErrors('Some error occur please try again');
        }
        if ($pre) {
            if ($pre->status == '0') {
                return redirect()->back()->withErrors('You have already sent a request');
            } elseif ($pre->status == '2') {
                $pre->status = 0;
                $pre->save();
                return redirect()->back()->with('success', 'Request sent successfully. Please wait for the approval');
            }
        }

        $re = new VoterRequest();
        $re->user_id = $user->id;
        $re->save();
        return redirect()->back()->with('success', 'Request sent successfully. Please wait for the approval');

    }

    public function requestVoterList()
    {
        $req = VoterRequest::all();
        $data = [
            'user' => Auth::user(),
            'reqVoters' => $req
        ];
        return view('user.requestVoterListInterface')->with($data);
    }

    public function voterRequestAction($action, $id)
    {
        if ($action == 'approve') {
            $req = VoterRequest::find($id);
            $user = User::find($req->user_id);
            if (!$user) {
                return redirect()->back();
            }

            $voter = new Voters();
            $voter->user_id = $user->id;
            $voter->name = $user->name;
            $voter->national_id = $user->national_id;
            $voter->gender = $user->gender;
            $voter->date_of_birth = $user->date_of_birth;
            $voter->address = $user->address;
            $voter->pic_location = $user->profile_pic;
            $voter->save();
            $req->status = 1;
            $req->save();
            $user->user_type = 'voter';
            $user->save();
            return redirect()->back()->with('success', 'Successfully Approved');

        } elseif ($action == 'reject') {
            $req = VoterRequest::find($id);
            $req->status = 2;
            $req->save();
            return redirect()->back()->with('success', 'Successfully Rejected');
        }
    }

    public function voteCandidate($id, $elcid)
    {
        $candidate = Candidates::find($id);

        $elc = Elections::find($elcid);
        if (!$elc) {
            return redirect()->back()->withErrors("Something went wrong with the election.");
        }

        $vc = VoteCounter::where('election_id', $candidate->election->id)->first();
        if ($vc) {
            return redirect()->back()->withErrors("You have already voted your candidate.");
        }
        if (!$candidate) {
            return redirect()->back()->withErrors("Something went wrong.");
        }
        if (Auth::user()->address != $candidate->region) {
            return redirect()->back()->withErrors("Sorry. You can not vote on another region's candidate.");
        }
        if (!Auth::user()->alreadyVote($candidate) && Auth::user()->user_type == 'voter') {
            $vote = new VoteCounter();
            $vote->candidate_id = $candidate->id;
            $vote->user_id = Auth::user()->id;
            $vote->election_id = $elc->id;
            $vote->save();
            return redirect()->back()->with('message', "Successfully voted the candidate.");
        }
        return redirect()->back()->withErrors("Already voted the candidate or not a valid voter.");

    }

    public function addRegionInterface()
    {
        $regions = RegionList::all();
        $data = [
            'user' => Auth::user(),
            'regions' => $regions
        ];
        return view('user.addRegionInterface')->with($data);
    }

    public function addRegion(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $region = new RegionList();
        $region->region = $request->input('name');
        $region->save();
        return redirect()->back()->with('message', 'Successfully Add the Region');
    }

    public function createElection(Request $request)
    {

        $this->validate($request, [
            'candidate' => 'required',
            'name' => 'required'
        ]);
        $election = new Elections();
        $election->election_name = $request->input('name');
        $election->region = $request->input('region');
        $election->save();

        foreach ($request->input('candidate') as $candidate) {
            $can = Candidates::where('id', $candidate)->first();
            $can->election_ref = $election->id;
            $can->save();
        }
        return redirect()->back()->with('message', 'Successfully add an election.');
    }

    public function startElection($id)
    {
        $ele = Elections::find($id);
        if (!$ele) {
            return redirect()->back()->withErrors("something went wrong");
        }

        $ele->status = 1;
        $ele->save();
        return redirect()->back()->with("message", "Successfully started the election");

    }

    public function isSame($arr)
    {
        $firstValue = current($arr);
        foreach ($arr as $val) {
            if ($firstValue !== $val) {
                return false;
            }
        }
        return true;
    }

    public function stopElection($id)
    {
        $ele = Elections::find($id);
        if (!$ele) {
            return redirect()->back()->withErrors("something went wrong");
        }
        $draw = array();

        foreach ($ele->candidates as $candidate) {
            $candidate->gain_votes = VoteCounter::where('candidate_id', $candidate->id)->count();
            $candidate->save();
            $draw[] = $candidate->gain_votes;
        }
        $cann = Candidates::where('election_ref', $ele->id)->whereRaw('gain_votes= (select max(gain_votes) from Candidates)')->first();

        if($this->isSame($draw)){
            $ele->winner='Tie';
        }else{
            $ele->winner = $cann->id;
        }

        $ele->status = 2;
        $ele->save();

        return redirect()->back()->with("message", "Successfully Stopped the election");

    }

    public function deleteCandidate($id)
    {
        $can = Candidates::find($id);
        if (!$can) {
            return redirect()->back()->withErrors('Something went wrong.Please try again.');
        }
        $can->delete();
        return redirect()->back()->withErrors('Successfully deleted.');
    }

    public function getSelectedCandidate()
    {
        $can = Candidates::where('region', Input::get('region'))->get();
        $data = [
            'candidates' => $can
        ];
        return view('user.selectedCandidate')->with($data);

    }
}
