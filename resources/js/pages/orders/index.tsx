import AuthenticatedLayout from "@/layouts/authenticated-layout";
import { Head } from "@inertiajs/react";
import OrdersTable from "@/components/orders-table";
import { PageProps } from "@/types";

export default function Orders({orders}: PageProps<{ orders: any }>) {
    return (
        <AuthenticatedLayout
            header="Orders"
        >
            <Head title="Orders"/>
            <OrdersTable orders={orders.data}/>
        </AuthenticatedLayout>
    );
}
