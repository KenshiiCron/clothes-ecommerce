<?php

namespace App\Livewire;

use App\Contracts\OrderContract;
use App\Helpers\Cart;
use App\Models\Order;
use Kossa\AlgerianCities\Commune;
use Kossa\AlgerianCities\Wilaya;
use Livewire\Attributes\On;
use Livewire\Component;
use App\Models\Product;
class Checkout extends Component
{
    public $name;
    public $email;
    public $phone;
    public $address;
    public $cities = [];
    public $communes = [];
    public $shipping_to = 1;
    public $commune_id;
    public $wilayat_id;
    public $products = [];
    public $total_price;
    protected function rules()
    {
        return [
            'name' => 'required|string|max:100',
            'email' => 'sometimes|nullable|email',
            'phone' => 'required|string|max:50',
            'wilayat_id' => 'required|integer',
            'shipping_to' => 'required|integer|in:1,2',
            'address' => 'sometimes|nullable|string|max:200',
            'commune_id' => 'required|integer',
        ];
    }
    protected function messages()
    {
        return [
            'name.required' => 'The name field is required.',
            'name.string' => 'The name must be a valid string.',
            'name.max' => 'The name must not exceed 100 characters.',

            'email.email' => 'Please enter a valid email address.',

            'phone.required' => 'The phone number is required.',
            'phone.string' => 'The phone number must be a valid string.',
            'phone.max' => 'The phone number must not exceed 50 characters.',

            'wilayat_id.required' => 'Please select a city.',
            'wilayat_id.integer' => 'Invalid city selection.',
            'wilayat_id.exists' => 'The selected city is invalid.',

            'shipping_to.required' => 'Please choose a shipping method.',
            'shipping_to.integer' => 'Invalid shipping selection.',
            'shipping_to.in' => 'The selected shipping method is invalid.',

            'address.required_if' => 'The address is required when choosing home delivery.',
            'address.string' => 'The address must be a valid string.',
            'address.max' => 'The address must not exceed 200 characters.',

            'commune_id.integer' => 'Invalid commune selection.',
        ];
    }

    public function mount()
    {
        $this->cities = Wilaya::whereHas('communes')->get();
        $this->getCart();
    }
    public function getCart(){
        $cart = session()->has('cart') ? session()->get('cart') : null;
        $this->products =[];
        if($cart){
            foreach($cart->getItems() as $key=>$item){
                $product = Product::find($item['product_id']);
                $inventory = $product->inventories->where('id',$item['inventory_id'])->first();
                $this->products[$key]['details'] = $product;
                $this->products[$key]['inventory'] = $inventory;
                $this->products[$key]['qty'] = $item['qty'];
                $this->products[$key]['total'] = $item['qty'] * $inventory->price;
            }
            $this->total_price = $cart->getTotalPrice();
        }else
        {
            redirect()->to_route('home');
        }
    }
    public function render()
    {
        return view('livewire.checkout');
    }
    public function updatedWilayatId($value)
    {
        $this->communes = Commune::where('wilaya_id', $value)->get();
        $this->commune_id = null;
    }

    public function updatedShippingTo($value)
    {
        if($value == 2){

            $this->addError('address', 'The address is required for home delivery.');

        }else{
            $this->resetErrorBag('address');
        }

    }
    public function placeOrder(OrderContract $o)
    {
        $data = $this->validate();
        if (auth()->check())
        {
            $data['user_id'] = auth()->id();
        }

        $data['wilaya_id'] = $this->wilayat_id;
        $data['commune_id'] = $this->commune_id;
        $data['name'] = $this->name;
        $data['email'] = $this->email;
        $data['phone'] = $this->phone;
        $data['address'] = $this->address;
        $data['total_price'] = $this->total_price;
        $data['sub_total_price'] = $this->total_price;
        $c = new Cart(session('cart'));
        $items = collect($c->getItems())->mapWithKeys(static function($i,$key){
            return [
                $key => [
                    'qty' => $i['qty'],
                    'total' => $i['qty'] * $i['price'],
                ]
            ];
        });

        /*$data['total_qty'] = $c->getTotalQty();*/
       /* $data['sub_total_price'] =  $c->getTotalPrice();*/
       /* $data['total_price'] = $c->getTotalPrice() + $data['shipping_price'];*/
        $order = $o->new($data);
        $order->orderItems()->attach($items->all());
        // $this->mail(config('settings.default_email_address'),$order);
        session()->forget('cart');
        $this->dispatch('swal-toast', [
            'icon' => 'success',
            'title' => 'Success',
            'text' => 'Your order has been placed.',
        ]);
        return redirect()->route('home');
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
}
