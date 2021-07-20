<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeamMemberCreateRequest;
use App\Http\Requests\TeamMemberUpdateRequest;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TeamMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        $teamMembers = TeamMember::paginate(10);
        return Inertia::render('TeamMembers', [
            'teamMembersList' => $teamMembers
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TeamMemberCreateRequest $teamMemberCreateRequest
     * @return \Illuminate\Http\Response
     */
    public function store(TeamMemberCreateRequest $teamMemberCreateRequest)
    {
        TeamMember::create([
            'name' => $teamMemberCreateRequest['name'],
            'email' => $teamMemberCreateRequest['email'],
            'telephone' => $teamMemberCreateRequest['telephone'],
            'joined_date' => $teamMemberCreateRequest['joined_date'],
            'current_route' => $teamMemberCreateRequest['current_route'],
            'comments' => $teamMemberCreateRequest['comments'],
            'user_id' => auth()->user()->id
        ]);

        return redirect()->back()->with('message', 'Team Member Created Successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TeamMemberUpdateRequest $teamMemberUpdateRequest
     * @param \App\Models\TeamMember $teamMember
     * @return \Illuminate\Http\Response
     */
    public function update(TeamMemberUpdateRequest $teamMemberUpdateRequest)
    {
        if ($teamMemberUpdateRequest->has('id')) {
            $teamMember = TeamMember::find($teamMemberUpdateRequest['id']);
            $teamMember->name = $teamMemberUpdateRequest['name'];
            $teamMember->email = $teamMemberUpdateRequest['email'];
            $teamMember->telephone = $teamMemberUpdateRequest['telephone'];
            $teamMember->joined_date = $teamMemberUpdateRequest['joined_date'];
            $teamMember->current_route = $teamMemberUpdateRequest['current_route'];
            $teamMember->comments = $teamMemberUpdateRequest['comments'];
            $teamMember->save();
            return redirect()->back()->with('message', 'Team Member Updated Successfully.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        if ($request->has('id')) {
            TeamMember::find($request->input('id'))->delete();
            return redirect()->back();
        }
    }
}
