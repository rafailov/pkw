<?php

namespace App\Http\Controllers;

use App\Applications;
use App\About;
use App\Careers;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ApplicationsController extends Controller {

    public function index( $career_id ) {

        $aboutData = About::where('about_id', '=', 1)->select('about_telephone')->first();

        $careerData = Careers::where('career_id', '=', $career_id)->first();

        return view('applications', [
            'aboutData' => $aboutData,
            'careerData' => $careerData
        ]);

    }

    public function adminIndex() {

        $applicationsData = Applications::orderBy('app_id', 'DESC')->paginate(10);

        $careerData = Careers::all();

        return view('admin.list.applications', [
            'applicationsData' => $applicationsData,
            'careerData' => $careerData
        ]);

    }

    public function store( Request $request ) {

        $inputData = $request->all();

        $tryCreateApplication = Applications::sendApplication($inputData,$request);

        switch ($tryCreateApplication[0]) {
            case 'validationError':
                return back()->withInput()->withErrors($tryCreateApplication[1]);
            case 'creatingError':
                return back()->withInput()->withErrors('Проблем, моля опитай те по късно!');
            case 'successMessage':
                return redirect()->back()->with('successMessage', 'Вашата кандидатура е изпратена!');
            default:
                return back()->withInput()->withErrors('Проблем, моля опитай те по късно!');
        }

    }

    public function downloadCV( $app_cv ) {

        $applicationCV = Applications::where('app_cv', '=', $app_cv)->first();

        $pathToFile = public_path() . DIRECTORY_SEPARATOR . "uploads".DIRECTORY_SEPARATOR. "cv" .DIRECTORY_SEPARATOR . $applicationCV -> app_cv;

        return Response::download($pathToFile);

    }

    public function destroy( Request $request ) {

        $inputData = $request->get('app_id');

        $tryDeleteApp = Applications::deleteApplication($inputData);

        switch ($tryDeleteApp) {
            case 'errorMessage':
                return back()->withInput()->withErrors('Проблем, моля опитай те по късно!');
            case 'successMessage':
                return redirect()->back()->with('successMessage', 'Данните са изтрити успешно!');
            default:
                return back()->withInput()->withErrors('Проблем, моля опитай те по късно!');
        }

    }

}
