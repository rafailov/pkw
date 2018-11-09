<?php

namespace App\Http\Controllers;

use App\About;
use App\Careers;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class CareerController extends Controller
{

    public function indexAdmin()
    {
        $careers = Careers::all();
        return view('admin.list.careers', ['careers' => $careers]);
    }

    public function index()
    {
        $aboutData = About::where('about_id', '=', 1)->select('about_telephone')->first();
        $career = Careers::all();
        return view('careers', [
            'aboutData' => $aboutData,
            'careers' => $career,
        ]);
    }


    public function create()
    {
        return view('admin.insert.career');
    }


    public function store()
    {
        $data = Input::all();
        $status = Careers::addCareer($data);

        switch ($status[0]) {
            case 'validationError':
                return back()->withInput()->withErrors($status[1]);
            case 'creatingError':
                return back()->withInput()->withErrors('Грешка в записа на сървъра');
            case 'success':
                return redirect('admin/careers')->with('successMessage', 'Кариерата  добавена успешно');
        }
    }


    public function show($id)
    {
        //redirect to Appliacation route:: application/careerID
    }


    public function edit($id)
    {
        $career = Careers::find($id);
        return view('admin.update.career', ['career' => $career]);
    }


    public function update()
    {
        $data = Input::all();
        $status = Careers::updateCareer($data);
        switch ($status[0]) {
            case 'validationError':
                return back()->withInput()->withErrors($status[1]);
            case 'creatingError':
                return back()->withInput()->withErrors('Грешка в записа на сървъра');
            case 'success':
                return redirect('admin/careers')->with('successMessage', 'Кариерата редактирана успешно');
        }
    }


    public function destroy()
    {
        $id = Input::get('career_id');
        $status = Careers::destroy($id);
        switch ($status) {
            case 'failDestroy':
                return back()->withInput()->withErrors('Грешка при изтриване на информацията');
            case 'success':
                return back()->with('successMessage', 'Кариерата  изтрита успешно');
        }
    }
}
