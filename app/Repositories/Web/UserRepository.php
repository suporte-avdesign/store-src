<?php

namespace AVD\Repositories\Web;

use AVD\Models\Web\User as Model;
use AVD\Interfaces\Web\UserInterface;

use Illuminate\Support\Str;

class UserRepository implements UserInterface
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
     * Date: 07/01/2019
     *
     * @param  int Id
     * @return mixed
     */
    public function setId($id)
    {
        return $this->model->find($id);
    }


    public function setEmail($email)
    {
        return $this->model->where('email', $email)->firstOrFail();
    }


    public function setToken($token)
    {
        return $this->model->where('token', $token)->firstOrFail();
    }


    /**
     * Date: 07/01/2019
     *
     * @param $input
     * @return bool
     */
    public function create($input)
    {
        $input['first_name'] = $input["first_name_{$input['type_id']}"];
        $input['last_name']  = $input["last_name_{$input['type_id']}"];
        $input['document1']  = $input["document1_{$input['type_id']}"];
        $input['document2']  = $input["document2_{$input['type_id']}"];
        $input['active']     = constLang('active_false');
        $input['token']      = Str::random(40);
        $input['ip']         = $_SERVER['REMOTE_ADDR'];

        return $this->model->create($input);
    }




    public function update($input, $id)
    {
        $data   = $this->model->find($id);
        return $data->update($input);
    }





}