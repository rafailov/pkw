<?php

namespace App\Http\Controllers;

use App\Products;
use App\Services;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class ProductListController extends Controller
{


    public function indexAdmin($service_id = null)
    {
        if ($service_id == null) {
            $service = Services::all();
        } else {
            $service = Services::find($service_id);
        }
        return view('admin.list.products', ['services' => $service]);

    }

    public function index($service_id = null)
    {

        if ($service_id == null) {
            $service = Services::all();
        } else {
            $service = Services::find($service_id);
        }
        return view('products', ['services' => $service]);
    }


    public function create($service_id)
    {
        $visibleDropDownArr = array();
        $visibleDropDownArr[1] = 'Видим';
        $visibleDropDownArr[0] = 'Скрит';

        return view('admin.insert.product', ['visibleVal' => $visibleDropDownArr, 'service_id' => $service_id]);
    }


    public function store()
    {
        $data = Input::all();
        $status = Products::addProduct($data);
//        return dump($status);
        switch ($status[0]) {
            case 'validationError':
                return back()->withInput()->withErrors($status[1]);
            case 'creatingError':
                return back()->withInput()->withErrors('Грешка в записа на сървъра');
            case 'success':
                return redirect('admin/products/' . $status[1])->with('successMessage', 'Информацията е добавена успешно');
        }
    }


    public function show($id)
    {
        $product = Products::find($id);
        return view('product', ['product' => $product]);
    }

    public function edit($product_id, $service_id)
    {
        $visibleDropDownArr = array();
        $visibleDropDownArr[1] = 'Видим';
        $visibleDropDownArr[0] = 'Скрит';
        $product = Products::find($product_id);
        return view('admin.update.product', ['product' => $product, 'visibleVal' => $visibleDropDownArr, 'service_id' => $service_id]);
    }

    public function update()
    {
        $data = Input::all();
        $status = Products::updateProduct($data);
//        return dump($status);
        switch ($status[0]) {
            case 'validationError':
                return back()->withInput()->withErrors($status[1]);
            case 'creatingError':
                return back()->withInput()->withErrors('Грешка в записа на сървъра');
            case 'success':
                return redirect('admin/products/' . $status[1])->with('successMessage', 'Информацията е редактирана успешно');
        }
    }


    public function destroy()
    {

        $id = Input::get('product_id');
        $status = Products::destroy($id);
        switch ($status) {
            case 'failDestroy':
                return back()->withInput()->withErrors('Грешка при изтриване на информацията');
            case 'success':
                return back()->with('successMessage', 'Информацията е изтрита успешно');
        }

    }
}
