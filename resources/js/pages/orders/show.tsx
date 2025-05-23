import AuthenticatedLayout from "@/layouts/authenticated-layout";
import { Head } from "@inertiajs/react";
import { Card, CardContent } from "@/components/ui/card";
import { Badge } from "@/components/ui/badge";
import { Separator } from "@/components/ui/separator";
import * as React from "react";

import {
    Table,
    TableBody,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from "@/components/ui/table";
import {stateColor, stateLabel} from "@/enums/OrderEnum";
import {Button} from "@/components/ui/button";
import axios from "axios";

type OrderItem = {
    id: number;
    inventory_id: string;
    qty: number;
};

type Order = {
    id: number;
    order_number: string;
    created_at: string;
    state: string;
    user_id: number;
    description: string;
    featured: boolean;
    image_url: string | null;
    order_items: OrderItem[];
};

export default function OrderShow({ order }: { order: Order }) {

    console.log(order)

    function updateState(state: number) {
        axios.put(`/admin/orders/${order.id}`, { state: state })
            .then(res => {
                console.log(res);
            })
            .catch(err => {
                console.error(err.response.data);
            });
    }

    return (
        <AuthenticatedLayout header={`Order #${order.order_number}`}>
            <Head title={`Order ${order.order_number}`} />

            <div className="max-w-3xl mx-auto mt-8 space-y-6">
                <Card>
                    <CardContent className="p-6 space-y-4">
                        <div className="flex justify-between items-center">
                            <h2 className="text-2xl font-semibold">Order Details</h2>
                        </div>

                        <div className="grid gap-1 text-sm text-muted-foreground">
                            <div className="flex items-center justify-between">
                                <p><span className="font-medium text-black">Order Number:</span> {order.order_number}
                                </p>
                                <Badge variant={stateLabel(parseInt(order.state))}><span
                                    className="font-medium text-black"></span> {stateLabel(parseInt(order.state))}
                                </Badge>
                            </div>
                            <p><span className="font-medium text-black">Date:</span> {order.created_at}</p>

                            <h2 className="text-lg font-semibold border-b mb-1 mt-2 ">Client Details</h2>
                            <p><span className="font-medium text-black">Name:</span> {order.name}</p>
                            <p><span className="font-medium text-black">Phone:</span> {order.phone}</p>
                            <p><span className="font-medium text-black">Email:</span> {order.email ?? '/'}</p>
                            <p><span className="font-medium text-black">Address:</span> {order.address ?? '/'}</p>
                            <p><span className="font-medium text-black">Wilaya:</span> {order.wilaya_id}</p>
                            <p><span className="font-medium text-black">Commune:</span> {order.commune_id}</p>

                            <h2 className="text-lg font-semibold border-b mb-1 mt-2 ">Order Total</h2>
                            <div className="flex justify-between items-center">
                                <p><span className="font-medium text-black">Sub Price:</span> {order.sub_total_price}
                                </p>
                                <p><span
                                    className="font-medium text-black">Shipping Price:</span> {order.shipping_price ?? '/'}
                                </p>
                                <p><span className="font-medium text-black">Discount:</span> {order.discount ?? '/'}</p>
                                <Badge variant={"secondary"}><span
                                    className="font-medium text-black">Total Price:</span> {order.total_price}</Badge>
                            </div>
                        </div>

                    </CardContent>
                </Card>

                <div className="flex justify-between items-center gap-2">
                    {parseInt(order.state) === 0 ? (
                        <>
                            <Button onClick={() => updateState(4)} variant="danger" className="w-full">
                                <span className="text-sm font-medium">Reject Order</span>
                            </Button>
                            <Button onClick={() => updateState(3)} variant="success" className="w-full">
                                <span className="text-sm font-medium">Confirm Order</span>
                            </Button>
                        </>
                    ) : (
                        <Button onClick={() => updateState(2)} variant="danger" className="w-full">
                            <span className="text-sm font-medium">Cancel Order</span>
                        </Button>
                    )}
                </div>


                <Separator/>

                <Card>
                    <CardContent className="p-6 space-y-4">
                        <h3 className="text-xl font-semibold">Order Items</h3>

                        {order.order_items.length === 0 ? (
                            <p className="text-sm text-muted-foreground">No items in this order.</p>
                        ) : (
                            <Table>
                                <TableHeader>
                                    <TableRow>
                                        <TableHead>Image</TableHead>
                                        <TableHead>Product Name</TableHead>
                                        <TableHead>Quantity</TableHead>
                                        <TableHead>Total</TableHead>
                                    </TableRow>
                                </TableHeader>
                                <TableBody>
                                    {order.order_items.map((item: any) => (
                                        <TableRow key={item.id}>
                                            <TableCell>
                                                <img
                                                    src={item.product.image_url}
                                                    alt="Product"
                                                    className="w-14 h-14 rounded-md object-cover"
                                                />
                                            </TableCell>
                                            <TableCell>{item.product.name}</TableCell>
                                            <TableCell>{item.pivot.qty}</TableCell>
                                            <TableCell>{item.pivot.total}</TableCell>
                                        </TableRow>
                                    ))}
                                </TableBody>
                            </Table>
                        )
                        }
                    </CardContent>
                </Card>
            </div>
        </AuthenticatedLayout>
    );
}
