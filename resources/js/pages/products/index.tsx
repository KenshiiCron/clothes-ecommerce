import AuthenticatedLayout from "@/layouts/authenticated-layout";
import { Head } from "@inertiajs/react";
import ProductTable from "@/components/products-table";
import { PageProps } from "@/types";

export default function Products() {
    return (
        <AuthenticatedLayout
            header="Products"
        >
            <Head title="Products" />

            <ProductTable />
        </AuthenticatedLayout>
    );
}
