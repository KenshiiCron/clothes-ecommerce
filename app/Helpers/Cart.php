<?php

namespace App\Helpers;

use App\Models\Product;

class Cart
{
    private $items = [];
    private $total_qty;
    private $total_price;

    /**
     * Cart constructor.
     * @param Cart|null $cart
     */
    public function __construct(Cart $cart = null)
    {
        if ($cart) {
            $this->setItems($cart->getItems());
            $this->setTotalPrice($cart->getTotalPrice());
            $this->setTotalQty($cart->getTotalQty());
        } else {
            $this->setItems([]);
            $this->setTotalPrice(0);
            $this->setTotalQty(0);
        }
    }

    public function add(Product $product, array $data): void
    {
        $item = [
            'product_id' => $product->id,
            'price' => $product->inventories->where('id', $data['inventory_id'])->first()->price,
            'qty' => 0,
            'inventory_id' => $data['inventory_id'],
        ];
        $key = $data['inventory_id'];
        if (!array_key_exists($key, $this->getItems())) {
            $this->items[$key] = $item;
        }

        $this->setTotalQty($this->getTotalQty() + $data['qty']);
        $this->setTotalPrice($this->getTotalPrice() + $item['price']* $data['qty']);
        $this->items[$key]['qty'] += $data['qty'];
    }

    public function update($key,$qty): void
    {
        $this->items[$key]["qty"] = $qty;
        $collection = collect($this->getItems());
        $this->total_price = $collection->sum(function ($item) {
            return $item["price"] * $item["qty"];
        });
        $this->total_qty = $collection->sum(function ($item) {
            return $item["qty"];
        });
    }

    public function remove($id): void
    {

        $collection = collect($this->getItems());

        $item = $collection->get($id);

        if (!$item) return;

        $this->setTotalPrice($this->getTotalPrice() - $item["price"] * $item["qty"]);

        $this->setTotalQty($this->getTotalQty() - $item["qty"]);

        $collection->forget($id);

        $this->setItems($collection->all());
    }
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @param array $items
     */
    public function setItems(array $items): void
    {
        $this->items = $items;
    }

    /**
     * @return mixed
     */
    public function getTotalQty()
    {
        return $this->total_qty;
    }

    /**
     * @param mixed $total_qty
     */
    public function setTotalQty(int $total_qty): void
    {
        $this->total_qty = $total_qty;
    }

    /**
     * @return mixed
     */
    public function getTotalPrice()
    {
        return $this->total_price;
    }

    /**
     * @param mixed $total_price
     */
    public function setTotalPrice($total_price): void
    {
        $this->total_price = $total_price;
    }

}
