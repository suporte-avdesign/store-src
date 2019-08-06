<?php

namespace AVD\Repositories\Web;


use AVD\Models\Web\OrderNote as Model;
use AVD\Interfaces\Web\OrderNoteInterface;


class OrderNoteRepository implements OrderNoteInterface
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
    public function create($order_id, $comment)
    {
        $user = auth()->user();
        $user->profile_id == 1 ? $name = $user->last_name : $name = $user->first_name;
        $input = [
            'order_id' => $order_id,
            'who' => 2,
            'name' => $name,
            'description' => $comment
        ];
        return $this->model->create($input);
    }


}