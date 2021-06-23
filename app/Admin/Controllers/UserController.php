<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function selectList(Request $request): mixed
    {
        $q = $request->get('q');

        return User::where('name', 'like', "%$q%")
            ->paginate(null, ['id', 'name']);
    }
}
