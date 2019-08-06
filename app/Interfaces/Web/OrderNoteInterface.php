<?php

namespace AVD\Interfaces\Web;

interface OrderNoteInterface
{
    /**
     * Interface model OrderNote
     *
     * @return \AVD\Repositories\Web\OrderNoteRepository
     */
    public function create($order_id, $comment);

}