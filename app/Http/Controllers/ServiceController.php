<?php

namespace App\Http\Controllers;

use App\About;
use App\Products;
use App\Services;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class ServiceController extends Controller
{
    public function indexAdmin()
    {
        $services = Services::all();
        return view('admin.list.services', ['services' => $services]);
    }

    public function index($services_id = 0)
    {
        $aboutData = About::where('about_id', '=', 1)->select('about_telephone')->first();
        $services = Services::all();
        $products = Products::all();

        return view('services', [
            'aboutData' => $aboutData,
            'servicesData' => $services,
            'productsData' => $products
        ]);
    }

    public function create()
    {
        return view('admin.insert.service');
    }

    function store()
    {
        $data = Input::all();
        $status = Services::addService($data);
//        return dump($status);
        switch ($status[0]) {
            case 'validationError':
                return back()->withInput()->withErrors($status[1]);
            case 'imageFailed':
                return back()->withInput()->withErrors('Грешка в записа на изображението');
            case 'creatingError':
                return back()->withInput()->withErrors('Грешка в записа на сървъра');
            case 'success':
                return redirect('admin/service')->with('successMessage', 'Информацията е добавена успешно');
        }
    }


    public function show($id)
    {
        $service = Services::find($id);
        return view('one-service', ['service' => $service]);
    }

    public function edit($id)
    {
        $service = Services::find($id);
        return view('admin.update.service', ['service' => $service]);
    }


    public function update()
    {
        $data = Input::all();
        $status = Services::updateService($data);
//        return dump($status);
        switch ($status[0]) {
            case 'validationError':
                return back()->withInput()->withErrors($status[1]);
            case 'imageFailed':
                return back()->withInput()->withErrors('Грешка в записа на изображението');
            case 'creatingError':
                return back()->withInput()->withErrors('Грешка в записа на сървъра');
            case 'success':
                return redirect('admin/service')->with('successMessage', 'Информацията е добавена успешно');
        }
    }


    public function destroy()
    {
        $id = Input::get('service_id');
        $status = Services::destroy($id);

        switch ($status) {
            case 'failDestroy':
                return back()->withInput()->withErrors('Грешка при изтриване на информацията');
            case 'success':
                return back()->with('successMessage', 'Информацията е изтрита успешно');
        }
    }
}
