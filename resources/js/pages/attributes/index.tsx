import AuthenticatedLayout from "@/layouts/authenticated-layout";
import { Head } from "@inertiajs/react";
import AttributeTable from "@/components/tables/attributes-table";
import { PageProps } from "@/types";
import {useState} from "react";

export default function Attribute({attributes}: PageProps<{ attributes: any }>) {
    console.log(attributes);
    return (
        <AuthenticatedLayout
            header="Attributes"
        >
            <Head title="Attributes" />
            <AttributeTable attributes={attributes.data}/>
        </AuthenticatedLayout>
    );
}
