<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\Api\User;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    /**
     * @return User
     */
    public function me(): User
    {
        return new User(\Auth::user());
    }
}
