<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Classes\ImageProccessing;


class Slider extends Model
{

    protected $table = 'slider';

    protected $primaryKey = 'slide_id';

    public static function getRules()
    {
        return [
            'slide_image' => 'required|image|max:10000',
            'slide_title' => 'required|max:255',
            'slide_text' => 'required',
            'slide_link' => 'required'
        ];
    }


    public static function getMessages()
    {
        return [
            'slide_image.required' => 'Изисква се снимка',
            'slide_image.max:10000' => 'Снимката трябва да е под 10 мегабайта',
            'slide_image.image' => 'Файлът трябва да е изображение',
            'slide_title.required' => 'Изисква се заглавие',
            'slide_title.max' => 'Заглавието не може да бъде повече от :max симовла!',
            'slide_text.required' => 'Изисква се описание',
            'slide_link.required' => 'Въведете линк'
        ];
    }

    protected $fillable = array('slide_id', 'slide_title', 'slide_text', 'slide_image', 'slide_link');


    protected static $path = 'uploads' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'SliderImages' . DIRECTORY_SEPARATOR;




    public static function addSlider($data)
    {

        $validator = \Validator::make($data, self::getRules(), self::getMessages());

        if ($validator->fails()) {
            return array('validationError', $validator);
        }
        try {
            $slider = new Slider();
            $slider->slide_title = $data['slide_title'];
            $slider->slide_text = $data['slide_text'];
            $slider->slide_link = $data['slide_link'];

            $imageName = ImageProccessing::storeNewImage($data['slide_image'], self::$path);
            if ($imageName == false) {
                return array('imageFailed', 'Грешка при записа на изображението');
            }

            $slider->slide_image = $imageName;
            $slider->save();

        } catch (\Exception $ex) {
            \Log::error($ex);
            return array('creatingError', $ex);
        }
        return array('success', $slider);
    }

    public static function updateSlider($data)
    {
        $rules = self::getRules();
        $messages = self::getMessages();

        $rules['slide_id'] = 'required|exists:slider,slide_id';

        $messages['slide_id.required'] = 'Ид-то не съществува';
        $messages['slide_id.exists'] = 'Ид-то вече съществува';

        if (!isset($data['slide_image'])) {
            $renew_image = false;
            $rules['slide_image'] = '';
        } else {
            $renew_image = true;
        }

        $validator = \Validator::make($data, $rules, $messages);

        if ($validator->fails()) {
            return array('validationError', $validator);
        }

        $slider = Slider::find($data['slide_id']);

        if ($renew_image) {
            ImageProccessing::deleteOldImage($slider->slide_image, self::$path);

            $image_name = ImageProccessing::storeNewImage($data['slide_image'], self::$path);
            if (!$image_name) {
                return array('imageFailed', 'Грешка при запис на изображението');
            }
        }

        try {
            $slider->slide_title = $data['slide_title'];
            $slider->slide_text = $data['slide_text'];
            $slider->slide_link = $data['slide_link'];
            if ($renew_image) $slider->slide_image = $image_name;
            $slider->save();

        } catch (\Exception $ex) {
            \Log::error($ex);
            return array('creatingError', $ex);
        }
        return array('success', $slider);
    }

    public static function destroy($id)
    {
        try {
            $slider = Slider::find($id);
            $oldImage = $slider->slide_image;
            ImageProccessing::deleteOldImage($oldImage, self::$path);
            $slider->delete();
        } catch (\Exception $ex) {
            \Log::error($ex);
            return 'destroyError';
        }
        return 'success';


    }
}
