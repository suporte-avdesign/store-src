<?php

namespace AVD\Repositories\Web;

use AVD\Events\UserRegisteredNoteEvent;

use AVD\Models\Web\UserAddress as Model;
use AVD\Interfaces\Web\UserAddressInterface;
use Illuminate\Support\Facades\Auth;




class UserAddressRepository implements UserAddressInterface
{

    public $model;

    /**
     * Create construct.
     *
     * @return void
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }


    /**
     * Create
     *
     * @param  array $input
     * @return mixed
     */
    public function create($input)
    {
        return $this->model->create($input);
    }


    /**
     * Create
     *
     * @param  array $input
     * @return mixed
     */
    public function update($input, $page)
    {
        $dataForm = null;
        $user_id = auth()->id();
        $note = constLang('updated').' '.constLang('address').' ';
        $data = $this->lestAddress($user_id);
        if ($data->address != $input["address"]) {
            $dataForm["address"] = $input["address"];
               $note .=":{$input['address']}, ";
        }
        if ($data->number != $input["number"]) {
            $dataForm["number"] = $input["number"];
            $note .= constLang('number').":{$input["number"]}, ";
        }
        if ($data->complement != $input["complement"]) {
            $dataForm["complement"] = $input["complement"];
            $note .= constLang('complement').":{$input["complement"]}, ";
        }
        if ($data->district != $input["district"]) {
            $dataForm["district"] = $input["district"];
            $note .= constLang('district').":{$input["district"]}, ";
        }
        if ($data->city != $input["city"]) {
            $dataForm["city"] = $input["city"];
            $note .= constLang('city').":{$input["city"]}, ";
        }
        if ($data->state != $input["state"]) {
            $dataForm["state"] = $input["state"];
            $note .= constLang('state').":{$input["state"]}, ";
        }
        if ($data->zip_code != $input["zip_code"]) {
            $dataForm["zip_code"] = $input["zip_code"];
            $note .= constLang('zip_code').":{$input["zip_code"]}, ";
        }
        if ($dataForm) {
            $input["user_id"] = $user_id;
            $this->updateNote(substr($note, 0, -2), $page);
            return $this->model->create($input);
        }
        return true;
    }


    protected function lestAddress($user_id)
    {
        return $this->model->orderBy('id','desc')->where('user_id', $user_id)->first();
    }



    private function updateNote($description, $page)
    {
        $note = [
            'user_id' => auth()->id(),
            'admin' => constLang('profile_name.user'),
            'label' => $page,
            'description' => $description." ".ipLocation()
        ];



        event(new UserRegisteredNoteEvent($note));
    }






}