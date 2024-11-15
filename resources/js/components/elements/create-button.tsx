import { Button } from "@/components/ui/button";
import {Link} from "@inertiajs/react";
import {PlusCircleIcon, PlusIcon} from "lucide-react";
import * as React from "react";
import {__} from "@/helpers/localization-helper";

export function CreateButton({ link }: any) {
    return (
        <Button asChild>
            <Link href={route(link)}>
                <p>{__('actions.create')}</p>
                <PlusIcon size={20}/>
            </Link>
        </Button>
    );
}
