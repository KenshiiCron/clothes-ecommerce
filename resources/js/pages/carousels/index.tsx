import AuthenticatedLayout from "@/layouts/authenticated-layout";
import { Head } from "@inertiajs/react";
import CarouselTable from "@/components/tables/carousels-table";
import { PageProps } from "@/types";

export default function Categories({carousels}: PageProps<{ carousels: any }>) {
    return (
        <AuthenticatedLayout
            header="Carousels"
        >
            <Head title="Carousels" />
            <CarouselTable carousels={carousels.data}/>
        </AuthenticatedLayout>
    );
}
