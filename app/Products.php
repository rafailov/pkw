<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{


    protected $table = 'products';

    protected $primaryKey = 'product_id';

    public static function getRules()
    {
        return [
            'product_name' => 'required',
//            'product_price' => 'required',
            'product_service_id' => 'required',
//            'product_visible'=>'required'
        ];
    }


    public static function getMessages()
    {
        return [
            'product_name.required' => 'Изисква се име',
//            'product_price.required' => 'Изисква се цена',
            'product_service_id.required' => 'Изберете за коя дейност се отнася цената'
        ];
    }

    protected $fillable = array('product_id', 'product_name', 'product_price', 'product_service_id', 'product_visible');


    public static function addProduct($data)
    {

        $validator = \Validator::make($data, self::getRules(), self::getMessages());

        if ($validator->fails()) {
            return array('validationError', $validator);
        }

        if (!isset($data['product_visible'])) {
            $data['product_visible'] = true;
        }

        try {
            $product = new Products();
            $product->product_name = $data['product_name'];
            $product->product_price = $data['product_price'];
            $product->product_service_id = $data['product_service_id'];
            $product->product_visible = $data['product_visible'];
            $product->save();
        } catch (\Exception $ex) {
            \Log::error($ex);
            return array('creatingError', $ex);
        }
        return array('success', $product->product_service_id);

    }


    public static function updateProduct($data)
    {
        $rules = self::getRules();
        $rules['product_id'] = 'required';
        $validator = \Validator::make($data, self::getRules(), self::getMessages());

        if ($validator->fails()) {
            return array('validationError', $validator);
        }

        if (!isset($data['product_visible'])) {
            $data['product_visible'] = true;
        }

        try {
            $product = Products::find($data['product_id']);
            $product->product_name = $data['product_name'];
            $product->product_price = $data['product_price'];
            $product->product_service_id = $data['product_service_id'];
            $product->product_visible = $data['product_visible'];
            $product->save();
        } catch (\Exception $ex) {
            \Log::error($ex);
            return array('creatingError', $ex);
        }

        return array('success', $product->product_service_id);

    }

    public static function destroy($id)
    {
        try {
            $product = Products::find($id);
            $product->delete();
        } catch (\Exception $ex) {
            return 'fail';
        }
        return 'success';

    }

}
