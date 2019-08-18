<?php

namespace AVD\Repositories\Web;


use AVD\Models\Web\Newsletter as Model;
use AVD\Interfaces\Web\NewsletterInterface;


class NewsletterRepository implements NewsletterInterface
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
        $data = $this->exist($input);
        if (empty($data)) {
            return $this->model->create($input);
        }

    }


    public function update($input)
    {
        $data = $this->exist($input);
        if ($data) {
            return $data->update($input);
        }

    }


    public function delete($input)
    {
        $data = $this->exist($input);
        if ($data) {
            return $data->delete($data);
        }

    }


    public function exist($input)
    {
        return $this->model->where('email', $input['email'])->firstOrFail();
    }


}