<?php

namespace AVD\Repositories\Web;


use AVD\Models\Web\OrderItem as Model;
use AVD\Interfaces\Web\OrderItemInterface;


class OrderItemRepository implements OrderItemInterface
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
    public function create($cart, $order_id)
    {
        foreach ($cart as $item) {
            $input = [
                'order_id' => $order_id,
                'user_id' => auth()->id(),
                'grid' => $item->grid,
                'quantity' => $item->quantity,
                'image' => $item->image,
                'color' => $item->color,
                'code' => $item->code,
                'offer' => $item->offer,
                'percent' => $item->percent,
                'price_card' => $item->price_card,
                'price_cash' => $item->price_cash,
                'slug' => $item->slug,
                'kit' => $item->kit,
                'kit_name' => $item->kit_name,
                'name' => $item->name,
                'category' => $item->category,
                'section' => $item->section,
                'brand' => $item->brand,
                'unit' => $item->unit,
                'measure' => $item->measure,
                'declare' => $item->declare,
                'weight' => $item->weight,
                'width' => (int)$item->width,
                'height' => (int)$item->height,
                'length' => (int)$item->length,
                'cost' => $item->cost,
            ];

            $data = $this->model->create($input);
        }
        return $data;
    }


}