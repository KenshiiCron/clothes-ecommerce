import AuthenticatedLayout from "@/layouts/authenticated-layout";
import { Head } from "@inertiajs/react";

export default function Create() {
    return (
        <AuthenticatedLayout
            header="Products"
        >
            <Head title="Products" />

            <p>Create</p>
        </AuthenticatedLayout>
    );
}
