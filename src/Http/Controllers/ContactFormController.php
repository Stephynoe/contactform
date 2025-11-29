<?php

namespace Stephynoe\Contactform\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Stephynoe\Contactform\Models\Contact;
use Stephynoe\Contactform\Mail\InquiryEmail;
use Illuminate\Support\Facades\Mail;

class ContactFormController extends BaseController
{ 

    public function create(){

        $admin_email = \config('contactform.admin_email');

        if ($admin_email === null || $admin_email === ''){
            return view('contactform::create', [
                'contactFormPackageError' => '<div class="mt-4 p-2 text-sm border border-red-500 text-red-500">Admin email not set</div>',
            ]);
        } else {
            return view('contactform::create', [
                'contactFormPackageError' => NULL,
            ]);
        }
    }

    public function store(Request $request){
        //return $request->all();

        $rules = [
            'name' => 'required|min:2|max:255',
            'email' => 'required|email|min:5|max:255',
            'subject' => 'required|min:2|max:255',
            'message' => 'required'
        ];

        $messages = [
            'name.required' => 'Please enter your name.',
            'name.min' => 'Your name must be at least 2 characters.',
            'name.max' => 'Your name may not be greater than 255 characters.',
            
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Enter a valid email address.',
            'email.min' => 'Your email must be at least 5 characters.',
            'email.max' => 'Your email may not be greater than 255 characters.',
            
            'subject.required' => 'Please enter a subject.',
            'subject.min' => 'The subject must be at least 2 characters.',
            'subject.max' => 'The subject may not be greater than 255 characters.',
            
            'message.required' => 'Please type your message.'
        ];

        $validated = $request->validate($rules, $messages);

        Contact::create($validated);

        $admin_email = \config('contactform.admin_email');

        //dd();

        if ($admin_email === null || $admin_email === ''){
            throw new \Exception("Admin email not set");
        } else {
            /* $emails = [
                'contact01@example.com',
                'admin02@example.com',
                'support03@example.com',
                'info04@example.com',
                'team05@example.com',
                'office06@example.com',
                'hello07@example.com',
                'service08@example.com',
                'noreply09@example.com',
                'updates10@example.com',
                'alerts11@example.com',
                'system12@example.com',
                'mailbox13@example.com',
                'helpdesk14@example.com',
                'assist15@example.com',
                'core16@example.com',
                'unit17@example.com',
                'group18@example.com',
                'dept19@example.com',
                'contact20@example.com',
            ];

            foreach ($emails as $email) {
                Mail::to($email)->queue(new InquiryEmail($validated));
            } */
            Mail::to($admin_email)->send(new InquiryEmail($validated));
        }

        return back()->with('success', 'Inquiry sent successfully.');
    }
}