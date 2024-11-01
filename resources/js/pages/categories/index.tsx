import AuthenticatedLayout from "@/layouts/authenticated-layout";
import { Head } from "@inertiajs/react";
import CategoryTable from "@/components/tables/categories-table";
import { PageProps } from "@/types";

export default function Categories({categories}: PageProps<{ categories: any }>) {
    console.log(categories);
    return (
        <AuthenticatedLayout
            header="Categories"
        >
            <Head title="Categories" />

            <CategoryTable />
        </AuthenticatedLayout>
    );
}
