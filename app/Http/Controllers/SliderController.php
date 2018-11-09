<?php

namespace App\Http\Controllers;

use App\Slider;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\SliderSwitcher;

class SliderController extends Controller
{

    public function indexAdmin()
    {
        $sliders = Slider::all();
        $switchVal = 'true';
        $switchObj = SliderSwitcher::all()->first();
        if ($switchObj) {
            $switchVal = $switchObj->switch_value;
        }
        return view('admin.list.sliders', ['sliders' => $sliders, 'switchVal' => $switchVal]);
    }

    public function switchSlider($boolVal)
    {
        $switchObj = SliderSwitcher::all()->first();
        if (!$switchObj) {
            $switchObj = new SliderSwitcher();
        }
        $switchObj->switch_value = $boolVal;
        $switchObj->save();
        return redirect()->back();

    }

    public function index()
    {

    }


    public function create()
    {

        return view('admin.insert.slider');
    }


    public function store()
    {
        $data = Input::all();
        $status = Slider::addSlider($data);
        switch ($status[0]) {
            case 'validationError':
                return back()->withInput()->withErrors($status[1]);
            case 'imageFailed':
                return back()->withInput()->withErrors('Грешка в записа на изображението');
            case 'creatingError':
                return back()->withInput()->withErrors('Грешка в записа на сървъра');
            case 'success':
                return redirect('admin/slider')->with('successMessage', 'Информацията е добавена успешно');
        }
    }

    public function show($id)
    {

    }


    public function edit($id)
    {
        $slider = Slider::find($id);
        return view('admin.update.slider', ['slider' => $slider]);

    }

    public function update()
    {
        $data = Input::all();
        $status = Slider::updateSlider($data);
//        return dump($status);
        switch ($status[0]) {
            case 'validationError':
                return back()->withInput()->withErrors($status[1]);
            case 'imageFailed':
                return back()->withInput()->withErrors('Грешка в записа на изображението');
            case 'creatingError':
                return back()->withInput()->withErrors('Грешка в записа на сървъра');
            case 'success':
                return redirect('admin/slider')->with('successMessage', 'Информацията е добавена успешно');
        }
    }


    public function destroy()
    {
        $id = Input::get('slide_id');
        $status = Slider::destroy($id);
        switch ($status) {
            case 'failDestroy':
                return back()->withInput()->withErrors('Грешка при изтриване на информацията');
            case 'success':
                return back()->with('successMessage', 'Информацията е изтрита успешно');
        }
    }
}
