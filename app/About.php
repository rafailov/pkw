<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Intervention\Image\ImageManagerStatic as Image;

class About extends Model {

    protected $table = 'about';

    protected $fillable = [
        'about_title',
        'about_slogan',
        'about_textOne',
        'about_textTwo',
        'about_imageOne',
        'about_imageTwo',
        'about_imageTwo',
        'about_telephone'
    ];

    protected $primaryKey = 'about_id';

    protected static $path = 'uploads' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'about' . DIRECTORY_SEPARATOR;

    public static function getUpdateRules(){
        return array(
            'about_id' => 'required|exists:about,about_id',
            'about_title' => 'required|min:5|max:100',
            'about_slogan' => 'required|min:5',
            'about_textOne' => 'required|min:5',
            'about_textTwo' => 'required|min:5',
            'about_telephone' => 'required|min:5'

        );
    }

    public static function getUpdateMessages(){
        return [
            'about_id.required' => 'Грешка!',
            'about_id.exists' => 'Информацията която се опитвате да редактирате не съществува!',
            'about_title.required' => 'Въведи заглавие!',
            'about_title.min' => 'Заглавието не трябва да е по-малко от :min символа!',
            'about_title.max' => 'Заглавието не трябва да е по-голямо от :max символа!',
            'about_slogan.required' => 'Въведи слоган!',
            'about_slogan.min' => 'Слоганът не трябва да е по-малко от :min символа!',
            'about_textOne.required' => 'Въведи текст!',
            'about_textOne.min' => 'Текстът не трябва да е по-малко от :min символа!',
            'about_textTwo.required' => 'Въведи текст!',
            'about_textTwo.min' => 'Текстът не трябва да е по-малко от :min символа!',
            'about_telephone.required' => 'Въведи телефон!',
            'about_telephone.min' => 'Телефонът не трябва да е по-малко от :min символа!',
        ];
    }

    public static function updateAbout($data) {

        $validator = \Validator::make($data, self::getUpdateRules(), self::getUpdateMessages());

        if ($validator->fails()) {
            return array('validationError', $validator);
        }

        if( isset( $data['about_imageOne'] ) ) {
            $aboutImageOneName = time();

            $about_imageOne = $aboutImageOneName .'.'. $data['about_imageOne']->getClientOriginalExtension();

            $path = public_path(self::$path . $about_imageOne);
            Image::make($data['about_imageOne']->getRealPath())->save($path);
        }

        if( isset( $data['about_imageTwo'] ) ) {
            $aboutImageTwoName = time();

            $about_imageTwo = $aboutImageTwoName .'.'. $data['about_imageTwo']->getClientOriginalExtension();

            $path = public_path(self::$path . $about_imageTwo);
            Image::make($data['about_imageTwo']->getRealPath())->save($path);
        }

        try {
            $aboutEntity = About::where('about_id', '=', $data['about_id'])->first();
            $aboutEntity -> about_title = $data['about_title'];
            $aboutEntity -> about_slogan = $data['about_slogan'];
            $aboutEntity -> about_textOne = $data['about_textOne'];
            $aboutEntity -> about_textTwo = $data['about_textTwo'];
            if( isset( $data['about_imageOne'] ) ) $aboutEntity -> about_imageOne = $about_imageOne;
            if( isset( $data['about_imageTwo'] ) ) $aboutEntity -> about_imageTwo = $about_imageTwo;
            $aboutEntity -> about_telephone = $data['about_telephone'];
            $aboutEntity -> save();
        }catch (\Exception $ex){
            \Log::error($ex);
            return array('creatingError', $ex);
        }

        return array('successMessage', $aboutEntity);

    }

}
