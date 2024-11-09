import AuthenticatedLayout from "@/layouts/authenticated-layout";
import { Head } from "@inertiajs/react";
import AdminTable from "@/components/tables/admins-table";
import { PageProps } from "@/types";

export default function Admins({admins , canCreateAdmin, canEditAdmin, canDeleteAdmin}: PageProps<{ admins: any , canCreateAdmin: boolean,  canEditAdmin: boolean, canDeleteAdmin: boolean}>) {
    console.log(admins);
    return (
        <AuthenticatedLayout
            header="Admins"
        >
            <Head title="Admins" />
            <AdminTable admins={admins.data} canCreateAdmin={canCreateAdmin} canEditAdmin={canEditAdmin} canDeleteAdmin={canDeleteAdmin}/>
        </AuthenticatedLayout>
    );
}
