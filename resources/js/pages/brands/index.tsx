import AuthenticatedLayout from "@/layouts/authenticated-layout";
import { Head } from "@inertiajs/react";
import BrandTable from "@/components/tables/brands-table";
import { PageProps } from "@/types";

export default function Categories({brands}: PageProps<{ brands: any }>) {
    console.log(brands);
    return (
        <AuthenticatedLayout
            header="Brands"
        >
            <Head title="Brands" />
            {/*<BrandTable categories={brands.data}/>*/}
            <BrandTable brands={brands.data}/>
        </AuthenticatedLayout>
    );
}
