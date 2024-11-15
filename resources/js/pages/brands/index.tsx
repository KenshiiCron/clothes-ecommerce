import AuthenticatedLayout from "@/layouts/authenticated-layout";
import { Head } from "@inertiajs/react";
import BrandTable from "@/components/tables/brands-table";
import { PageProps } from "@/types";
import {trans_choice} from "@/helpers/localization-helper";

export default function Categories({brands}: PageProps<{ brands: any }>) {
    return (
        <AuthenticatedLayout
            header={trans_choice('labels.models.brand', 2)}
        >
            <Head title={trans_choice('labels.models.brand', 2)} />
            <BrandTable brands={brands.data}/>
        </AuthenticatedLayout>
    );
}
