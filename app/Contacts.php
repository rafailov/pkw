<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contacts extends Model
{

    protected $table = 'contacts';

    protected $primaryKey = 'contact_id';

    public static function getRules()
    {
        return [
            'contact_city' => 'required',
            'contact_address' => 'required',
            'contact_worktime' => 'required',
            'contact_telephone' => 'required',
            'contact_coordinates' => 'required',
        ];
    }


    public static function getMessages()
    {
        return [
            'contact_city.required' => 'Въведете град',
            'contact_address.required' => 'Въведете адрес',
            'contact_worktime.required' => 'Въведете работно време',
            'contact_telephone.required' => 'Въведете телефон',
            'contact_coordinates.required' => 'Въведете координати на картата',

        ];
    }

    protected $fillable = array('contact_id', 'contact_city', 'contact_address', 'contact_worktime', 'contact_telephone', 'contact_coordinates');


    public static function addContact($data)
    {

        $validator = \Validator::make($data, self::getRules(), self::getMessages());

        if ($validator->fails()) {
            return array('validationError', $validator);
        }


        try {
            $contact = new Contacts();
            $contact->contact_city = $data['contact_city'];
            $contact->contact_address = $data['contact_address'];
            $contact->contact_worktime = $data['contact_worktime'];
            $contact->contact_telephone = $data['contact_telephone'];
            $contact->contact_coordinates = $data['contact_coordinates'];
            $contact->save();
        } catch (\Exception $ex) {
            \Log::error($ex);
            return array('creatingError', $ex);
        }
        return array('success', $contact);

    }


    public static function updateContact($data)
    {

        $validator = \Validator::make($data, self::getRules(), self::getMessages());

        if ($validator->fails()) {
            return array('validationError', $validator);
        }

        try {
            $contact = Contacts::find($data['contact_id']);
            $contact->contact_city = $data['contact_city'];
            $contact->contact_address = $data['contact_address'];
            $contact->contact_worktime = $data['contact_worktime'];
            $contact->contact_telephone = $data['contact_telephone'];
            $contact->contact_coordinates = $data['contact_coordinates'];
            $contact->save();
        } catch (\Exception $ex) {
            \Log::error($ex);
            return array('creatingError', $ex);
        }

        return array('success', $contact);

    }


    public static function destroy($id)
    {
        try {
            $contact = Contacts::find($id);
            $contact->delete();
        } catch (\Exception $ex) {
            \Log::error($ex);
            return 'destroyError';
        }
        return 'success';


    }

}
