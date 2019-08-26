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
        $data = $this->lestAddress($user_id);

        $current = array(
            "address" => $data->address,
            "number" => $data->number,
            "complement" => $data->complement,
            "district" => $data->district,
            "city" => $data->city,
            "state" => $data->state,
            "zip_code" => $data->zip_code
        );



        if($current != $input) {
            $note = constLang('updated').' '.constLang('address').' ';
            $this->updateNote(substr($note, 0, -2), $page);

            $input["user_id"] = $user_id;
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