<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class ProfileController extends Controller
{
  public function show(User $user)
  {
    $activities = $user->activity()->latest()->with('subject')->get();
    return view('profiles.show', [
        'profileUser' => $user,
        'activities' => $activities
    ]);
  }
}
