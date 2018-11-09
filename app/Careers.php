<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Careers extends Model
{
    protected $table = 'careers';

    protected $primaryKey = 'career_id';

    public static function getRules()
    {
        return [
            'career_position' => 'required',
            'career_description' => 'required',
            'career_requirements' => 'required',
        ];
    }


    public static function getMessages()
    {
        return [
            'career_position.required' => 'Въведете позиция на кандидатурата',
            'career_description.required' => 'Въведете описание на кандидатурата',
            'career_requirements.required' => 'Въведете изисквания за кандидатурата'
        ];
    }

    protected $fillable = array('career_id', 'career_position', 'career_description', 'career_requirements');


    public static function addCareer($data)
    {

        $validator = \Validator::make($data, self::getRules(), self::getMessages());

        if ($validator->fails()) {
            return array('validationError', $validator);
        }


        try {
            $career = new Careers();
            $career->career_position = $data['career_position'];
            $career->career_description = $data['career_description'];
            $career->career_requirements = $data['career_requirements'];
            $career->save();
        } catch (\Exception $ex) {
            \Log::error($ex);
            return array('creatingError', $ex);
        }
        return array('success', $career);

    }


    public static function updateCareer($data)
    {

        $validator = \Validator::make($data, self::getRules(), self::getMessages());

        if ($validator->fails()) {
            return array('validationError', $validator);
        }

        try {
            $career = Careers::find($data['career_id']);
            $career->career_position = $data['career_position'];
            $career->career_description = $data['career_description'];
            $career->career_requirements = $data['career_requirements'];
            $career->save();
        } catch (\Exception $ex) {
            \Log::error($ex);
            return array('creatingError', $ex);
        }

        return array('success', $career);

    }


    public static function destroy($id)
    {
        try {
            $career = Careers::find($id);
//            return dump($career);
            $career->delete();
        } catch (\Exception $ex) {
            \Log::error($ex);
            return 'destroyError';
        }
        return 'success';


    }

}
