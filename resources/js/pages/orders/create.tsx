import AuthenticatedLayout from "@/layouts/authenticated-layout";
import { Head, useForm } from "@inertiajs/react";
import { Label } from "@/components/ui/label";
import { Input } from "@/components/ui/input";
import { Button } from "@/components/ui/button";
import { InputError } from "@/components/ui/input-error";
import { FormEventHandler, useState } from "react";
import {Select, SelectContent, SelectItem, SelectTrigger, SelectValue} from "@/components/ui/select";

import { Textarea } from "@/components/ui/textarea";
import { Switch } from "@/components/ui/switch";


interface Users {
    id: string;
    name: string ;
    email: string;
}
interface Wilayas {
    id: string;
    name: string;
}
interface Communes {
    id: string;
    name: string;
}
interface CreateOrderProps {
    users: Users[];
    wilayas: Wilayas[];
    communes: Communes[];
}

export default function CreateOrder({users, wilayas, communes}: CreateOrderProps) {
    // console.log(wilayas);
    // console.log(users);
    const { data, setData, post, processing, errors, reset } = useForm({
        user_id: "",
        order_number: "",
        name: "",
        address: "",
        phone: "",
        email: "",
        total_price: 0,
        sub_total_price: 0,
        shipping_price: 0,
        discount: 0,
        total_qty: 0,
        state: 0,
        wilaya_id: "",
        commune_id: "",
        delivery_state: 0,
        payment_method: 0,
        payment_state: 0,
    });

    const [preview, setPreview] = useState<string | null>(null);

    // const handleImageChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    //     const file = e.target.files?.[0];
    //     if (file) {
    //         setData("image", file);
    //         setPreview(URL.createObjectURL(file));
    //     }
    // };

    const submit: FormEventHandler = (e) => {
        e.preventDefault();
        console.log(data);
        post(route("admin.orders.store"));
    };


    return (
        <AuthenticatedLayout header="Create Order">
            <Head title="Create Order" />

            <p>Create a new order</p>
            <form onSubmit={submit} className="max-w-md mt-6">
                {/*<span>{errors}</span>*/}
                <div className="grid gap-4">
                    <div className="grid gap-2">
                        <Label htmlFor="user_id">User ID</Label>
                        <Select
                            value={data.user_id}
                            onValueChange={(value) => setData("user_id", value)}

                        >
                            <SelectTrigger>
                                <SelectValue placeholder="Select a user"/>
                            </SelectTrigger>
                            <SelectContent>
                                {users.map((user) => (
                                    <SelectItem key={user.id} value={user.id}>
                                        {user.name}
                                    </SelectItem>
                                ))}
                            </SelectContent>
                        </Select>
                        <InputError message={errors.user_id}/>
                    </div>

                    <div className="grid gap-2">
                        <Label htmlFor="name">Name</Label>
                        <Input
                            id="name"
                            type="text"
                            placeholder="Order Name"
                            value={data.name}
                            onChange={(e) => setData("name", e.target.value)}

                        />
                        <InputError message={errors.name}/>
                    </div>

                    <div className="grid gap-2">
                        <Label htmlFor="address">Address</Label>
                        <Input
                            id="address"
                            type="text"
                            placeholder="Order Address"
                            value={data.address}
                            onChange={(e) => setData("address", e.target.value)}
                        />
                        <InputError message={errors.address}/>
                    </div>

                    <div className="grid gap-2">
                        <Label htmlFor="phone">Phone</Label>
                        <Input
                            id="phone"
                            type="text"
                            placeholder="Phone Number"
                            value={data.phone}
                            onChange={(e) => setData("phone", e.target.value)}

                        />
                        <InputError message={errors.phone}/>
                    </div>

                    <div className="grid gap-2">
                        <Label htmlFor="email">Email</Label>
                        <Input
                            id="email"
                            type="email"
                            placeholder="Email Address"
                            value={data.email}
                            onChange={(e) => setData("email", e.target.value)}
                        />
                        <InputError message={errors.email}/>
                    </div>

                    <div className="grid gap-2">
                        <Label htmlFor="total_price">Total Price</Label>
                        <Input
                            id="total_price"
                            type="number"
                            value={data.total_price}
                            onChange={(e) => setData("total_price", parseFloat(e.target.value))}

                        />
                        <InputError message={errors.total_price}/>
                    </div>

                    <div className="grid gap-2">
                        <Label htmlFor="sub_total_price">Sub Total Price</Label>
                        <Input
                            id="sub_total_price"
                            type="number"
                            value={data.sub_total_price}
                            onChange={(e) => setData("sub_total_price", parseFloat(e.target.value))}

                        />
                        <InputError message={errors.sub_total_price}/>
                    </div>

                    <div className="grid gap-2">
                        <Label htmlFor="shipping_price">Shipping Price</Label>
                        <Input
                            id="shipping_price"
                            type="number"
                            value={data.shipping_price}
                            onChange={(e) => setData("shipping_price", parseFloat(e.target.value))}
                        />
                        <InputError message={errors.shipping_price}/>
                    </div>

                    <div className="grid gap-2">
                        <Label htmlFor="discount">Discount</Label>
                        <Input
                            id="discount"
                            type="number"
                            value={data.discount}
                            onChange={(e) => setData("discount", parseFloat(e.target.value))}
                        />
                        <InputError message={errors.discount}/>
                    </div>

                    <div className="grid gap-2">
                        <Label htmlFor="total_qty">Total Quantity</Label>
                        <Input
                            id="total_qty"
                            type="number"
                            value={data.total_qty}
                            onChange={(e) => setData("total_qty", parseInt(e.target.value))}

                        />
                        <InputError message={errors.total_qty}/>
                    </div>

                    <div className="grid gap-2">
                        <Label htmlFor="state">State</Label>
                        <Input
                            id="state"
                            type="number"
                            value={data.state}
                            onChange={(e) => setData("state", parseInt(e.target.value))}

                        />
                        <InputError message={errors.state}/>
                    </div>

                    <div className="grid gap-2">
                        <Label htmlFor="wilaya_id">Wilayas</Label>
                        <Select
                            value={data.wilaya_id}
                            onValueChange={(value) => setData("wilaya_id", value)} // onValueChange for shadcn Select component

                        >
                            <SelectTrigger>
                                <SelectValue placeholder="Select a wilaya"/> {/* Placeholder for wilaya select */}
                            </SelectTrigger>
                            <SelectContent>
                                {Object.entries(wilayas).map(([id, name]) => (
                                    <SelectItem key={id} value={id}>
                                        {name}
                                    </SelectItem>
                                ))}
                            </SelectContent>
                        </Select>
                        <InputError message={errors.wilaya_id}/>
                    </div>

                    <div className="grid gap-2">
                        <Label htmlFor="commune_id">Communes</Label>
                        <Select
                            value={data.commune_id}
                            onValueChange={(value) => setData("commune_id", value)} // onValueChange for shadcn Select component

                        >
                            <SelectTrigger>
                                <SelectValue placeholder="Select a commune"/> {/* Placeholder for commune select */}
                            </SelectTrigger>
                            <SelectContent>
                                {Object.entries(communes).map(([id, name]) => (
                                    <SelectItem key={id} value={id}>
                                        {name}
                                    </SelectItem>
                                ))}
                            </SelectContent>
                        </Select>
                        <InputError message={errors.commune_id}/>
                    </div>

                    <div className="grid gap-2">
                        <Label htmlFor="delivery_state">Delivery State</Label>
                        <Input
                            id="delivery_state"
                            type="number"
                            value={data.delivery_state}
                            onChange={(e) => setData("delivery_state", parseInt(e.target.value))}

                        />
                        <InputError message={errors.delivery_state}/>
                    </div>

                    <div className="grid gap-2">
                        <Label htmlFor="payment_method">Payment Method</Label>
                        <Input
                            id="payment_method"
                            type="number"
                            value={data.payment_method}
                            onChange={(e) => setData("payment_method", parseInt(e.target.value))}

                        />
                        <InputError message={errors.payment_method}/>
                    </div>

                    <div className="grid gap-2">
                        <Label htmlFor="payment_state">Payment State</Label>
                        <Input
                            id="payment_state"
                            type="number"
                            value={data.payment_state}
                            onChange={(e) => setData("payment_state", parseInt(e.target.value))}

                        />
                        <InputError message={errors.payment_state}/>
                    </div>

                    <Button type="submit" className="w-full mt-4" disabled={processing}>
                        Create Order
                    </Button>
                </div>
            </form>
        </AuthenticatedLayout>
    );
}
