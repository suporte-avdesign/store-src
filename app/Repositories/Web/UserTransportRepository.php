<?php

namespace AVD\Repositories\Web;

use AVD\Events\UserRegisteredNoteEvent;
use AVD\Models\Web\UserTransport as Model;
use AVD\Interfaces\Web\UserTransportInterface;


class UserTransportRepository implements UserTransportInterface
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


    public function update($input, $user)
    {
        unset($input['indicate']);
        $input['user_id'] = $user->id;

        $data = $this->model->where('user_id', $user->id)->first();
        if ($data) {
            $current = [
                'user_id' => $data->user_id,
                'name' => $data->name,
                'phone' => $data->phone
            ];

            if ($current != $input) {
                $update =  $data->update($input);
                if ($update) {
                    $page = constLang('account');
                    $description = constLang('updated')." ".constLang('transport');
                    $note = $this->updateNote($description, $page);
                    return $update;
                }
            }

        } else {

            $create = $this->model->create($input);
            if ($create) {
                $page = constLang('account');
                $description = constLang('added')." ".constLang('transport');
                $note = $this->updateNote($description, $page);
                return $create;
            }
        }

        return true;
    }

    public function delete($user)
    {
        $data = $this->model->where('user_id', $user->id)->first();
        if ($data) {
            $page = constLang('account');
            $description = constLang('deleted')." ".constLang('transport');
            $note = $this->updateNote($description, $page);

            return $data->delete();
        }
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