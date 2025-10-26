<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Candidature;
use App\Models\Entreprise;
use App\Models\Entretien;
use App\Models\Offre;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function  index()
    {
        $offresCount = Offre::count();
        $candidaturesCount = Candidature::count();
        $entretiensCount = Entretien::count();
        $usersCount = User::count();
        return view('admin.dashbord', compact('offresCount', 'candidaturesCount', 'entretiensCount', 'usersCount'));
    }

   

}
