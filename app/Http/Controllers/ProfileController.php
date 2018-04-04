<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class ProfileController extends Controller
{
  public function show(User $user)
  {
    return view('profiles.show', [
        'profileUser' => $user,
        'activities' => \App\Activity::feed($user)
    ]);
  }
}
