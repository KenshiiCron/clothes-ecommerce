import { Button } from "@/components/ui/button";
import {Link} from "@inertiajs/react";
import {PlusCircleIcon, PlusIcon} from "lucide-react";
import * as React from "react";

export function CreateButton({ link }: any) {
    return (
        <Button asChild>
            <Link href={route(link)}>
                <p>Create</p>
                <PlusIcon size={20}/>
            </Link>
        </Button>
    );
}
