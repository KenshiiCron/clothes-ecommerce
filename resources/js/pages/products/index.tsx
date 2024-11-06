import AuthenticatedLayout from "@/layouts/authenticated-layout";
import { Head } from "@inertiajs/react";
import ProductTable from "@/components/tables/products-table";
import { PageProps } from "@/types";

export default function Products({products}: PageProps<{ products: any }>) {
    return (
        <AuthenticatedLayout
            header="Products"
        >
            <Head title="Products" />

            <ProductTable  products={products.data}/>
        </AuthenticatedLayout>
    );
}
