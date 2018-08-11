<?php

namespace App\Http\Controllers;

use App\Email;
use App\Http\Resources\EmailResource;
use App\Jobs\SendEmailsJob;
use Illuminate\Http\Request;

class SendEmailController extends Controller
{
    public function send(Request $request)
    {
        $email = new Email();

        $email->recipients = $request->input('recipients');
        $email->subject = $request->input('subject');
        $email->params = $request->input('params', []);
        $email->theme_id = $request->input('theme_id');

        if ($email->save()) {
            SendEmailsJob::dispatch($email);

            return new EmailResource($email);
        }
    }

    public function list(Request $request)
    {
        $emails = Email::paginate($request->query->get('limit', 30));

        return EmailResource::collection($emails);
    }

    public function get($id)
    {
        $email = Email::findOrFail($id);

        return new EmailResource($email);
    }
}
