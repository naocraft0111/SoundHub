<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Mail\ContactSendmail;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact.index');
    }

    public function confirm(ContactRequest $request)
    {
        $inputs = $request->all();
        return view('contact.confirm', compact('inputs'));
    }

    public function send(ContactRequest $request)
    {
        $inputs = $request->all();

        if ($request->has('back')) {
            return redirect()->route('contact.index')
                ->withInput($inputs);
        }

        \Mail::to('
        soundhub1110@gmail.com')->send(new ContactSendmail($inputs));
        $request->session()->regenerateToken();
        return view('contact.thanks');
    }
}
