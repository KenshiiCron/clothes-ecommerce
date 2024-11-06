import AuthenticatedLayout from "@/layouts/authenticated-layout";
import { Head } from "@inertiajs/react";
import OrdersTable from "@/components/tables/orders-table";
import { PageProps } from "@/types";
import {Button} from "@/components/ui/button";
import {toast} from "@/hooks/use-toast";
import {ToastAction} from "@/components/ui/toast";

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
