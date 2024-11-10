import AuthenticatedLayout from "@/layouts/authenticated-layout";
import { Head } from "@inertiajs/react";
import RoleTable from "@/components/tables/roles-table";
import { PageProps } from "@/types";

export default function Roles({roles}: PageProps<{ roles: any }>) {
    return (
        <AuthenticatedLayout
            header="Roles"
        >
            <Head title="Roles" />
            <RoleTable roles={roles.data}/>
        </AuthenticatedLayout>
    );
}
