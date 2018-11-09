<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SendMails extends Model {

    protected $table = 'sendmails';

    protected $fillable = [
        'send_name',
        'send_email',
        'send_telephone',
        'send_message'
    ];

    protected $primaryKey = 'send_id';

    public static function getRules() {
        return array(
            'send_name' => 'required|min:3|max:50',
            'send_email' => 'required|email',
            'send_telephone' => 'required|numeric',
            'send_message' => 'required|min:3'
        );
    }

    public static function getMessages() {
        return [
            'send_name.required' => 'Моля въведете име!',
            'send_name.min' => 'Името трябва да е минимум :min символа!',
            'send_name.max' => 'Името трябва да е максимум :max символа!',
            'send_email.required' => 'Моля въведете E-mail!',
            'send_email.email' => 'Невалиден E-mail адрес',
            'send_telephone.required' => 'Моля въведете телефон!',
            'send_telephone.numeric' => 'Телефонът трябва да садържа само цифри!',
            'send_message.required' => 'Моля въведете съобщение!',
            'send_message.min' => 'Съобщението трябва да е минимум :min символа!'
        ];
    }

    public static function sendMeil( $data ) {

        $validator = \Validator::make($data, self::getRules(), self::getMessages());

        if ($validator->fails()) {
            return array('validationError', $validator);
        }

        try {
            $sendMeilEntity = new SendMails();
            $sendMeilEntity -> send_name = $data['send_name'];
            $sendMeilEntity -> send_email = $data['send_email'];
            $sendMeilEntity -> send_telephone = $data['send_telephone'];
            $sendMeilEntity -> send_message = $data['send_message'];
            $sendMeilEntity -> save();
        } catch( \Exception $ex ) {
            \Log::error($ex);
            return array('creatingError', $ex);
        }

        return array('successMessage', $sendMeilEntity);

    }

    public static function deleteMeil( $send_id ) {

        try {
            SendMails::destroy($send_id);
        } catch( \Exception $ex ) {
            \Log::error($ex);
            return 'errorMessage';
        }

        return 'successMessage';

    }

}
