import AuthenticatedLayout from "@/layouts/authenticated-layout";
import { Head } from "@inertiajs/react";
import OrdersTable from "@/components/tables/orders-table";
import { PageProps } from "@/types";

export default function Orders({orders, totalOrders, totalPending, totalConfirmed, totalCancelled, totalRejected}: PageProps<{ orders: any, totalOrders: any, totalPending: any, totalConfirmed: any, totalCancelled: any, totalRejected: any }>) {
    return (
        <AuthenticatedLayout
            header="Orders"
        >
            <Head title="Orders"/>
            <OrdersTable orders={orders.data} totalOrders={totalOrders} totalPending={totalPending} totalConfirmed={totalConfirmed} totalCancelled={totalCancelled} totalRejected={totalRejected}/>
        </AuthenticatedLayout>
    );
}
