<?php

namespace App\Http\Controllers;

use App\About;
use App\Applications;
use App\Careers;
use App\Contacts;
use App\Posts;
use App\SendMails;
use App\Services;
use App\Slider;
use App\SliderSwitcher;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use PhpSpec\Console\Application;

class HomeController extends Controller
{

    public function index()
    {

        $sliderData = Slider::all();

        $sliderSwithStatus = SliderSwitcher::all()->first()->switch_value;

        $servicesData = Services::all();

        $aboutData = About::where('about_id', '=', 1)->first();

        $careersData = Careers::orderBy('career_id', 'desc')->take(2)->get();

        $contactsData = Contacts::all();


        return view('index', [
            'sliderData' => $sliderData,
            'sliderSwithStatus' => $sliderSwithStatus,
            'servicesData' => $servicesData,
            'aboutData' => $aboutData,
            'careersData' => $careersData,
            'contactsData' => $contactsData
        ]);
    }

    public function adminIndex()
    {

        $sliders = Slider::all();
        $services = Services::all();
        $careers = Careers::all();
        $applications = Applications::all();
        $mails = SendMails::all();
        $posts = Posts::all();

        return view('admin.index', ['sliders' => $sliders, 'services' => $services, 'careers' => $careers, 'applications' => $applications, 'mails' => $mails, 'posts' => $posts]);
    }

}
