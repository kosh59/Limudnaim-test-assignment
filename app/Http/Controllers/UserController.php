<?php

namespace App\Http\Controllers;

use App\Models\User;
use http\Exception;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('User/Index', [
            'users' => User::query()->limit(100)->get(),
        ]);
    }

    public function userImage(User $user)
    {

        if(!$user->image_path || !\File::exists(storage_path($user->image_path))) throw new NotFoundHttpException();
        return response()->file(storage_path($user->image_path));
    }
}
