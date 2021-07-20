<?php

namespace App\Http\Controllers;

use App\Models\TeamMember;
use Inertia\Inertia;

class DashboardController extends Controller
{

    /**
     * Return total customer count.
     *
     * @return \Inertia\Response
     */
    public function counts()
    {
        $membersCount = TeamMember::all()->count();
        return Inertia::render('Dashboard', [
            'membersCount' => $membersCount
        ]);
    }
}
