<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Mail;
use App\Contacts;
use App\About;
use App\SendMails;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ContactsController extends Controller
{

    public function index()
    {

        $aboutData = About::where('about_id', '=', 1)->select('about_telephone')->first();
        $contactsDataS = Contacts::where('contact_id', '=', 1)->first();
        $contactsDataP = Contacts::where('contact_id', '=', 2)->first();

        return view('contacts', [
            'aboutData' => $aboutData,
            'contactsDataS' => $contactsDataS,
            'contactsDataP' => $contactsDataP
        ]);

    }

    public function createContact()
    {

        return view('admin.insert.contact');

    }

    public function editContacts($contact_id)
    {

        $contact = Contacts::find($contact_id);
        return view('admin.update.contact', ['contact' => $contact]);

    }

    public function storeContact()
    {

        $data = Input::all();
        $status = Contacts::addContact($data);
//        return dump($status);
        switch ($status[0]) {
            case 'validationError':
                return back()->withInput()->withErrors($status[1]);
            case 'creatingError':
                return back()->withInput()->withErrors('Грешка в записа на сървъра');
            case 'success':
                return redirect('admin/contacts')->with('successMessage', 'Контактът добавен успешно');
        }

    }

    public function updateContacts()
    {

        $data = Input::all();
        $status = Contacts::updateContact($data);
//        return dump($status);
        switch ($status[0]) {
            case 'validationError':
                return back()->withInput()->withErrors($status[1]);
            case 'creatingError':
                return back()->withInput()->withErrors('Грешка в записа на сървъра');
            case 'success':
                return redirect('admin/contacts')->with('successMessage', 'Контактът редактиран успешно');
        }

    }

    public function adminContactView()
    {

        $contactsData = Contacts::all();

        return view('admin.list.contacts', [
            'contactsData' => $contactsData
        ]);

    }

    public function adminIndex()
    {

        $mailsData = SendMails::orderBy('send_id', 'DESC')->paginate(10);

        return view('admin.list.mails', [
            'mailsData' => $mailsData
        ]);
    }

    public function store(Request $request)
    {

        $inputData = $request->all();

        $trySendMeil = SendMails::sendMeil($inputData);

        switch ($trySendMeil[0]) {
            case 'validationError':
                return back()->withInput()->withErrors($trySendMeil[1]);
            case 'creatingError':
                return back()->withInput()->withErrors('Проблем, моля опитай те по късно!');
            case 'successMessage':

                $data = $request->only('send_name', 'send_email', 'send_telephone', 'send_message');
                $data['messageLines'] = explode("\n", $request->get('message'));

                Mail::send('emails.contacts', $data, function ($message) use ($data) {
//                    $message->from($data['send_email'], $data['send_name']);
                    $message->to('pekave85@abv.bg', 'Admin')->subject('Съобщение от клиент през сайта PKW.bg');
                    $message->bcc('boqnognqnov@gmail.com', 'Info')->subject('Съобщение от клиент през сайта PKW.bg');
                    $message->bcc('alarma7a@gmail.com', 'Info')->subject('Съобщение от клиент през сайта PKW.bg');


                });

                return redirect()->back()->with('successMessage', 'Вашият E-mail е изпратен успешно!');
            default:
                return back()->withInput()->withErrors('Проблем, моля опитай те по късно!');
        }

    }


    public function destroyContact()
    {

        $id = Input::get('contact_id');
        $status = Contacts::destroy($id);
        switch ($status) {
            case 'failDestroy':
                return back()->withInput()->withErrors('Грешка при изтриване на информацията');
            case 'success':
                return back()->with('successMessage', 'Контактът  изтрит успешно');
        }

    }

    public function destroyMeil(Request $request)
    {

        $inputData = $request->get('send_id');

        $tryDeleteMail = SendMails::deleteMeil($inputData);

        switch ($tryDeleteMail) {
            case 'errorMessage':
                return back()->withInput()->withErrors('Проблем, моля опитай те по късно!');
            case 'successMessage':
                return redirect()->back()->with('successMessage', 'Данните са изтрити успешно!');
            default:
                return back()->withInput()->withErrors('Проблем, моля опитай те по късно!');
        }


    }

}
