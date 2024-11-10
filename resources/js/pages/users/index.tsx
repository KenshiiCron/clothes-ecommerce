import AuthenticatedLayout from "@/layouts/authenticated-layout";
import { Head } from "@inertiajs/react";
import UserTable from "@/components/tables/users-table";
import { PageProps } from "@/types";

export default function Users({users}: PageProps<{ users: any }>) {
    return (
        <AuthenticatedLayout
            header="Users"
        >
            <Head title="Users" />
            <UserTable users={users.data}/>
        </AuthenticatedLayout>
    );
}
