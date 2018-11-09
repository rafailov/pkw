<?php

namespace App\Http\Controllers;

use App\About;
use App\Posts;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class AboutController extends Controller {

    public function index() {

        $aboutData = About::where('about_id', '=', 1)->first();

        $postsData = Posts::where('post_approve', '=', 1)->orderByRaw('RAND()')->get();

        return view('about', [
            'aboutData' => $aboutData,
            'postsData' => $postsData
        ]);

    }

    public function adminIndex() {

        $aboutData = About::where('about_id', '=', 1)->first();

        return view('admin.update.about', [
            'aboutData' => $aboutData
        ]);

    }

    public function update( Request $request ) {

        $inputData = $request->all();

        $tryUpdateAbout = About::updateAbout($inputData);

        switch ($tryUpdateAbout[0]) {
            case 'validationError':
                return back()->withInput()->withErrors($tryUpdateAbout[1]);
            case 'creatingError':
                return back()->withInput()->withErrors('Проблем, моля опитай те по късно!');
            case 'successMessage':
                return redirect()->back()->with('successMessage', 'Данните са променени успешно!');
            default:
                return back()->withInput()->withErrors('Проблем, моля опитай те по късно!');
        }

    }

}
