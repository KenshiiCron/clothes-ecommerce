import AuthenticatedLayout from "@/layouts/authenticated-layout";
import { Head } from "@inertiajs/react";
import NewsLettersTable from "@/components/tables/newsletters-table";
import { PageProps } from "@/types";
import {trans_choice} from "@/helpers/localization-helper";

export default function NewsLetters({newsletters}: PageProps<{ newsletters: any }>) {
    return (
        <AuthenticatedLayout
            header={trans_choice('labels.models.brand', 2)}
        >
            <Head title={trans_choice('labels.models.brand', 2)} />
            <NewsLettersTable newsletters={newsletters.data}/>
        </AuthenticatedLayout>
    );
}
