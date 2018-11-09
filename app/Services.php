<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Classes\ImageProccessing;

class Services extends Model
{

    public function getProducts()
    {
        return $this->hasMany('App\Products', 'product_service_id');
    }

    protected $table = 'services';

    protected $primaryKey = 'service_id';

    public static function getRules()
    {
        return [
            'service_image' => 'required|image|max:10000',
            'service_name' => 'required',
            'service_text' => 'required',
            'service_icon' => 'required|image|max:10000'
        ];
    }


    public static function getMessages()
    {
        return [
            'service_image.required' => 'Изисква се снимка',
            'service_image.max:10000' => 'Снимката трябва да е под 10 мегабайта',
            'service_image.image' => 'Файлът трябва да е изображение',
            'service_name.required' => 'Изисква се име на дейността',
            'service_text.required' => 'Изисква се описание',
            'service_icon.required' => 'Изисква се снимка',
            'service_icon.max:10000' => 'Снимката трябва да е под 10 мегабайта',
            'service_icon.image' => 'Файлът трябва да е изображение',
        ];
    }

    protected $fillable = array('service_id', 'service_name', 'service_text', 'service_image', 'service_icon');


    static $path_ico = 'uploads' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'icon' . DIRECTORY_SEPARATOR;
//    static $path_ico = 'uploads/images/services/icon/';
    static $path_image = 'uploads' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'image' . DIRECTORY_SEPARATOR;

//    static $path_image = 'uploads/images/services/image/';

    public static function addService($data)
    {

        $validator = \Validator::make($data, self::getRules(), self::getMessages());

        if ($validator->fails()) {
            return array('validationError', $validator);
        }


        $imageName = null;
        $icoName = null;
        if (isset($data['service_image'])) {
            $status = ImageProccessing::storeNewImage($data['service_image'], self::$path_image);
            if ($status == false) {
                return array('imageFailed', 'Грешка при запис на изображение');
            }
            $imageName = $status;
        }
        if (isset($data['service_icon'])) {
            $status = ImageProccessing::storeNewImage($data['service_icon'], self::$path_ico);
            if ($status == false) {
                return array('imageFailed', 'Грешка при запис на изображение');
            }
            $icoName = $status;
        }

        try {
            $serviceEntity = new Services();
            $serviceEntity->service_name = $data['service_name'];
            $serviceEntity->service_text = $data['service_text'];
            $serviceEntity->service_image = $imageName;
            $serviceEntity->service_icon = $icoName;
            $serviceEntity->save();
        } catch (\Exception $ex) {
            \Log::error($ex);
            return array('creatingError', $ex);
        }
        return array('success', $serviceEntity);

    }


    public static function updateService($data)
    {
        $rules = self::getRules();


        if (!isset($data['service_icon'])) {
            $rules['service_icon'] = '';
        }
        if (!isset($data['service_image'])) {
            $rules['service_image'] = '';
        }
        $validator = \Validator::make($data, $rules, self::getMessages());

        if ($validator->fails()) {
            return array('validationError', $validator);
        }


        $imageName = null;
        $icoName = null;
        if (isset($data['service_icon'])) {
            $oldImage = Services::find($data['service_id'])->service_icon;
            ImageProccessing::deleteOldImage($oldImage, self::$path_ico);
            $status = ImageProccessing::storeNewImage($data['service_icon'], self::$path_ico);
            if ($status == false) {
                return array('imageFailed', 'Грешка при запис на изображение');
            }
            $icoName = $status;
        }
        if (isset($data['service_image'])) {
            $oldImage = Services::find($data['service_id'])->service_image;
            ImageProccessing::deleteOldImage($oldImage, self::$path_image);
            $status = ImageProccessing::storeNewImage($data['service_image'], self::$path_image);
            if ($status == false) {
                return array('imageFailed', 'Грешка при запис на изображение');
            }
            $imageName = $status;
        }


        try {
            $serviceEntity = Services::find($data['service_id']);
            $serviceEntity->service_name = $data['service_name'];
            $serviceEntity->service_text = $data['service_text'];


            if ($imageName != null) {
                $serviceEntity->service_image = $imageName;
            }

            if ($icoName != null) {
                $serviceEntity->service_icon = $icoName;
            }

            $serviceEntity->save();
        } catch (\Exception $ex) {
            \Log::error($ex);
            return array('creatingError', $ex);
        }

        return array('success', $serviceEntity);

    }

    public static function destroy($id)
    {
        try {
            $oldImage = Services::find($id)->service_image;
            $oldIco = Services::find($id)->service_icon;

            if ($oldImage != null) {
                ImageProccessing::deleteOldImage($oldImage, self::$path_image);
            }
            if ($oldIco != null) {
                ImageProccessing::deleteOldImage($oldIco, self::$path_ico);
            }

            $service = Services::find($id);
            $service->delete();
        } catch (\Exception $ex) {
            return 'fail';
        }
        return 'success';

    }

}
