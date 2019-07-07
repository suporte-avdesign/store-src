<?php

namespace AVD\Repositories\Web;


use AVD\Models\Web\UserNote as Model;
use AVD\Interfaces\Web\UserNoteInterface;


class UserNoteRepository implements UserNoteInterface
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


}