<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Applications extends Model
{

    protected $table = 'applications';

    protected $fillable = [
        'app_career',
        'app_name',
        'app_email',
        'app_telephone',
        'app_education',
        'app_cv',
        'app_text'
    ];

    protected $primaryKey = 'app_id';

    protected static $path = 'uploads' . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . 'cv' . DIRECTORY_SEPARATOR;


    public function getCareer()
    {
        return $this->belongsTo('App\Careers');
    }

    public static function getRules()
    {
        return array(

            'app_career' => 'required|exists:careers,career_id',
            'app_name' => 'required|min:5|max:50',
            'app_email' => 'required|email',
            'app_telephone' => 'required|numeric',
            'app_education' => 'required|min:5|max:255',
            'app_cv' => 'required|max:5000',
            'app_text' => 'required|min:5'
        );
    }

    public static function getMessages()
    {
        return [
            'app_career.required' => 'Изберете за къде е вашата кандидатура!',
            'app_career.exists' => 'Тази кариера не съществува',
            'app_name.required' => 'Въведете вашето име!',
            'app_name.min' => 'Името трябва да е минимум :min символа!',
            'app_name.max' => 'Името трябва да е максимум :max символа!',
            'app_email.required' => 'Въведете E-mail адрес!',
            'app_email.email' => 'Невалиден E-mail адрес!',
            'app_telephone.required' => 'Въведете вашият телефон!',
            'app_telephone.numeric' => 'Телефонът трябва да садържа само цифри!',
            'app_education.required' => 'Въведете вашето образование!',
            'app_education.min' => 'Образованието трябва да садържа минимум :min символа!',
            'app_education.max' => 'Образованието трябва да садържа максимум :max символа',
            'app_cv.required' => 'Качете вашето CV',
            'app_cv.max' => 'Файлът не трябва да надвишава :max MB',
            'app_text.required' => 'Въведете кратко описание за вас',
            'app_text.min' => 'Описанието трябва да е минимум :min символа'
        ];
    }

    public static function sendApplication($data,$request)
    {

        $validator = \Validator::make($data, self::getRules(), self::getMessages());

        if ($validator->fails()) {
            return array('validationError', $validator);
        }

        $appCvName = time();

        $app_cv = $appCvName . '.' . $data['app_cv']->getClientOriginalExtension();

        $request->file('app_cv')->move(self::$path, $app_cv);

        try {
            $applicationsEntity = new Applications();
            $applicationsEntity->app_career = $data['app_career'];
            $applicationsEntity->app_name = $data['app_name'];
            $applicationsEntity->app_email = $data['app_email'];
            $applicationsEntity->app_telephone = $data['app_telephone'];
            $applicationsEntity->app_education = $data['app_education'];
            $applicationsEntity->app_cv = $app_cv;
            $applicationsEntity->app_text = $data['app_text'];
            $applicationsEntity->save();
        } catch (\Exception $ex) {
            \Log::error($ex);
            return array('creatingError', $ex);
        }

        return array('successMessage', $applicationsEntity);

    }

    public static function deleteApplication($app_id)
    {

        try {
            Applications::destroy($app_id);
        } catch (\Exception $ex) {
            \Log::error($ex);
            return 'errorMessage';
        }

        return 'successMessage';

    }

}
