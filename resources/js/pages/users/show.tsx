import AuthenticatedLayout from "@/layouts/authenticated-layout";
import {Head} from "@inertiajs/react";
import {PageProps} from "@/types";
import {User} from "@/types/user"
import {
    Card,
    CardContent,
    CardDescription,
    CardFooter,
    CardHeader,
    CardTitle,
} from "@/components/ui/card"
import {GlareCard} from "@/components/ui/glare-card";
import {Button} from "@/components/ui/button";
import {Separator} from "@/components/ui/separator";
import {Heart, Info, ShoppingCart} from "lucide-react";
import {Tabs, TabsContent, TabsList, TabsTrigger} from "@/components/ui/tabs";

export default function Show({user}: PageProps<{ user: User }>) {
    console.log(user.wishlist);
    // @ts-ignore
    return (
        <AuthenticatedLayout
            header="User"
        >
            <Head title="Users"/>
            <Tabs defaultValue="general" className="w-full">
                <TabsList className="w-full flex justify-evenly">
                    <TabsTrigger value="general" className="w-full justify-center">
                        <Info size={20} className="mr-2 h-4 w-4"/>
                        General
                    </TabsTrigger>
                    <TabsTrigger value="orders" className="w-full justify-center">
                        <ShoppingCart size={20} className="mr-2 h-4 w-4"/>
                        Orders
                    </TabsTrigger>
                    <TabsTrigger value="wishlist" className="w-full justify-center">
                        <Heart size={20} className="mr-2 h-4 w-4"/>
                        Wishlist
                    </TabsTrigger>
                </TabsList>
                <TabsContent value="general">
                    <Card>
                        <CardHeader>
                            <CardTitle>User Details</CardTitle>
                            <CardDescription>Deploy your new project in one-click.</CardDescription>
                        </CardHeader>
                        <CardContent className="flex items-start justify-start gap-8">
                            <GlareCard className="flex flex-col items-center justify-center">
                                <img
                                    src={user.image_url}
                                    alt="user"
                                    className="w-24 h-24 rounded-full object-cover"
                                />
                                <p className=" font-bold uppercase text-xl mt-8 mb-4">{user.name}</p>
                                <p>{user.email}</p>
                                <p>{user.phone}</p>
                            </GlareCard>
                            <div className="flex-1">
                                <h2 className=" font-bold text-xl mt-4">Discounts</h2>
                            </div>
                        </CardContent>
                    </Card>
                </TabsContent>
                <TabsContent value="orders">
                    <Card>
                        <CardHeader>
                            <CardTitle>Orders</CardTitle>
                            <CardDescription>Check all of this user's orders.</CardDescription>
                        </CardHeader>
                        <CardContent>
                            <div className="flex flex-wrap gap-4">
                                {user.orders.map((order, index) => (
                                    <Card className="w-52">
                                        <CardHeader>
                                            <CardTitle className="truncate text-lg text-center">{order.order_number}</CardTitle>
                                        </CardHeader>
                                        <CardContent className="flex items-start justify-center">
                                            <p className="font-bold text-3xl text-primary">{order.total_price} DA</p>
                                        </CardContent>
                                    </Card>
                                ))}
                            </div>

                        </CardContent>
                    </Card>
                </TabsContent>
                <TabsContent value="wishlist">
                    <Card>
                        <CardHeader>
                            <CardTitle>Wishlist</CardTitle>
                            <CardDescription>Check all of this user's wishlist.</CardDescription>
                        </CardHeader>
                        <CardContent className="flex items-start justify-start gap-8">
                                <div className="flex flex-wrap gap-4">
                                    {user.wishlist.map((wishlist, index) => (
                                        <Card className="w-52">
                                            <CardHeader>
                                                <CardTitle className="truncate text-lg">{wishlist.name}</CardTitle>
                                            </CardHeader>
                                            <CardContent className="flex items-start justify-start gap-8">
                                                <img
                                                    src={wishlist.image_url}
                                                    alt="user"
                                                    className="w-full aspect-square rounded-lg object-cover"
                                                />
                                            </CardContent>
                                        </Card>
                                    ))}
                                </div>
                        </CardContent>
                    </Card>
                </TabsContent>
            </Tabs>

        </AuthenticatedLayout>
    );
}
