<?php

namespace App\Http\Controllers;

use stdClass;
use App\Mail\FeedbackMailer;
use App\Http\Requests\Feedback\SendRequest;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
class FeedbackController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        return view('feedback.index');
    }

    /**
     * @param SendRequest $request
     * @return RedirectResponse
     */
    public function send(SendRequest $request): RedirectResponse
    {
        $data = new stdClass();
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->message = $request->message;

        Mail::to(env('MAIL_TO'))->send(new FeedbackMailer($data));

        return redirect()->route('feedback.index')
            ->with('success', 'Ваше сообщение успешно отправлено');
    }
}
