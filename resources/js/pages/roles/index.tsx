import AuthenticatedLayout from "@/layouts/authenticated-layout";
import { Head } from "@inertiajs/react";
import RoleTable from "@/components/tables/roles-table";
import { PageProps } from "@/types";

export default function Roles({roles , canCreate, canDelete, canEdit}: PageProps<{ roles: any, canCreate: boolean, canDelete: boolean, canEdit: boolean }>) {
    return (
        <AuthenticatedLayout
            header="Roles"
        >
            <Head title="Roles" />
            <RoleTable roles={roles.data} canCreate={canCreate} canDelete={canDelete} canEdit={canEdit}/>
        </AuthenticatedLayout>
    );
}
