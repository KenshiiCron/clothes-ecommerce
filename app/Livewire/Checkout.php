<?php

namespace App\Livewire;

use App\Contracts\OrderContract;
use App\Helpers\Cart;
use App\Models\Order;
use App\Models\User;
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
        'address' => 'required_if:shipping_to,2|nullable|string|max:200',
        'commune_id' => 'required|integer',
    ];

    }
    protected function messages()
    {
        return [
            'email.email' => __('labels.errors.email_invalid'),

            'phone.required' => __('labels.errors.phone_required'),
            'phone.string' => __('labels.errors.phone_string'),
            'phone.max' => __('labels.errors.phone_max'),

            'wilayat_id.required' => __('labels.errors.wilayat_required'),
            'wilayat_id.integer' => __('labels.errors.wilayat_integer'),
            'wilayat_id.exists' => __('labels.errors.wilayat_exists'),

            'shipping_to.required' => __('labels.errors.shipping_required'),
            'shipping_to.integer' => __('labels.errors.shipping_integer'),
            'shipping_to.in' => __('labels.errors.shipping_in'),

            'address.required_if' => __('labels.errors.address_required_if'),
            'address.string' => __('labels.errors.address_string'),
            'address.max' => __('labels.errors.address_max'),

            'commune_id.integer' => __('labels.errors.commune_integer'),
            'commune_id.required' => __('labels.errors.commune_required'),

        ];
    }

    public function mount()
    {
        $this->cities = Wilaya::whereHas('communes')->get();;
        if(auth()->user())
        {
            $this->address = auth()->user()->address;
        }
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
        $this->commune_id = $this->communes->first()->id;
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
