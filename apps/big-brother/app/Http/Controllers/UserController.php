<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\Fortify\CreateNewUser;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

final class UserController extends Controller
{
    public function create(): Response
    {
        return Inertia::render('Auth/Register');
    }

    public function store(Request $request, CreateNewUser $action): RedirectResponse
    {
        $action->create($request->all());

        return to_route('dashboard')->with('success', 'Account created successfully.');
    }
}
