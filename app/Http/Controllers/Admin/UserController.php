<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Requests\Admin\Users\StoreRequest;
use App\Http\Requests\Admin\Users\UpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Hash;

class UserController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        return view('admin.users.index')->with('title', 'Пользователи');
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return view('admin.users.create_edit')->with('title', "Добавление пользователя");
    }

    /**
     * @param StoreRequest $request
     * @return RedirectResponse
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        User::create(array_merge($request->all(), ['password' => Hash::make($request->password)]));

        return redirect()->route('admin.users.index')->with('success', "Данные успешно добавлены");
    }

    /**
     * @param int $id
     * @return View
     */
    public function edit(int $id): View
    {
        $user = User::find($id);

        if (!$user) abort(404);

        return view('admin.users.create_edit')->with('title', 'Редактирование пользователя');
    }

    /**
     * @param UpdateRequest $request
     * @return RedirectResponse
     */
    public function update(UpdateRequest $request): RedirectResponse
    {
        $user = User::find($request->id);

        if (!$user) abort(404);

        $user->login = $request->input('login');
        $user->name = $request->input('name');

        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'Данные обновлены');
    }

    /**
     * @param Request $request
     * @return void
     */
    public function destroy(Request $request): void
    {
        if ($request->id != Auth::id()) User::find($request->id)->delete();
    }

}
