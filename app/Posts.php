<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Intervention\Image\ImageManagerStatic as Image;

class Posts extends Model
{

    protected $table = 'posts';

    protected $fillable = [
        'post_name',
        'post_email',
        'post_image',
        'post_text',
        'post_position',
        'post_approve'
    ];

    protected $primaryKey = 'post_id';

    protected static $path = 'uploads' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'posts' . DIRECTORY_SEPARATOR;

    public static function getRules()
    {
        return array(
            'post_name' => 'required|min:5|max:50',
//            'post_email' => 'required|email',
//            'post_image' => 'required|image',
            'post_text' => 'required|min:5',
//            'post_position' => 'required|min:2'
        );
    }

    public static function getMessages()
    {
        return [
            'post_name.required' => 'Моля въведете име!',
            'post_name.min' => 'Името трябва да е минимум :min символа!',
            'post_name.max' => 'Името трябва да е максимум :max символа!',
            'post_email.required' => 'Въведете E-mail адрес!',
            'post_email.email' => 'Невалиден E-mail адрес!',
            'post_image.required' => 'Моля изберете снимка!',
            'post_image.image' => 'Файлът който се опитвате да качите не е снимка!',
            'post_text.required' => 'Моля въведете текст!',
            'post_text.min' => 'Текстът трябва да е минимум :min символа!',
            'post_position.required' => 'Моля въведете вашата позиция!',
            'post_position.min' => 'Позицията трябва да садържа минимум :min символа!'
        ];
    }

    public static function sendPosts($data)
    {

        $validator = \Validator::make($data, self::getRules(), self::getMessages());

        if ($validator->fails()) {
            return array('validationError', $validator);
        }


        $post_image = 'default';
        if (!empty($data['post_image'])) {
            $postImageName = time();
            $post_image = $postImageName . '.' . $data['post_image']->getClientOriginalExtension();
            $path = public_path(self::$path . $post_image);
            Image::make($data['post_image']->getRealPath())->resize(160, 160)->save($path);
        }




        try {
            $sendPostEntity = new Posts();
            $sendPostEntity->post_name = $data['post_name'];
            $sendPostEntity->post_image = $post_image;
            if (isset($data['post_email'])) {
                $sendPostEntity->post_email = $data['post_email'];
            }
            $sendPostEntity->post_text = $data['post_text'];
            if (isset($data['post_position'])) {
                $sendPostEntity->post_position = $data['post_position'];
            }
            $sendPostEntity->post_approve = 0;
            $sendPostEntity->save();
        } catch (\Exception $ex) {
            \Log::error($ex);
            return array('creatingError', $ex);
        }

        return array('successMessage', $sendPostEntity);

    }

    public static function approvePost($post_id)
    {

        try {
            $approveEntity = Posts::where('post_id', '=', $post_id)->first();
            $approveEntity->post_approve = 1;
            $approveEntity->save();
        } catch (\Exception $ex) {
            \Log::error($ex);
            return 'errorMessage';
        }

        return 'successMessage';

    }

    public static function rejectPost($post_id)
    {

        try {
            $rejectEntity = Posts::where('post_id', '=', $post_id)->first();
            $rejectEntity->post_approve = 0;
            $rejectEntity->save();
        } catch (\Exception $ex) {
            \Log::error($ex);
            return 'errorMessage';
        }

        return 'successMessage';

    }

    public static function deletePost($post_id)
    {

        try {
            Posts::destroy($post_id);
        } catch (\Exception $ex) {
            \Log::error($ex);
            return 'errorMessage';
        }

        return 'successMessage';

    }

}
