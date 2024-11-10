import AuthenticatedLayout from "@/layouts/authenticated-layout";
import { Head, useForm } from "@inertiajs/react";
import { Label } from "@/components/ui/label";
import { Input } from "@/components/ui/input";
import { Button } from "@/components/ui/button";
import { InputError } from "@/components/ui/input-error";
// @ts-ignore
import AttributeValuesTable from "@/components/tables/attribute-values-table";
import { FormEventHandler } from "react";
import AttributeTable from "@/components/tables/attributes-table";
import { PageProps } from "@/types";
import {
    Dialog,
    DialogClose,
    DialogContent,
    DialogHeader,
    DialogTitle,
    DialogTrigger,
} from "@/components/ui/dialog";
import { Separator } from "@/components/ui/separator";
import { PlusCircleIcon } from "lucide-react";
import * as React from "react";

export type Attribute = {
    id: string;
    name: string;
    created_at: string;
    updated_at: string;
};

export type AttributeValue = {
    id: string;
    attribute_id: bigint;
    value: string;
    created_at: string;
    updated_at: string;
};

export default function Edit({
    attribute,
    attribute_values,
}: PageProps<{ attribute: Attribute; attribute_values: any }>) {
    const { data, setData, put, processing, errors, reset } = useForm({
        name: attribute.name,
    });
    const {
        data: addValueData,
        setData: setValueData,
        post: submitAddValue,
        processing: processingAddValue,
        errors: errorsAddValue,
        reset: resetAddValue,
    } = useForm({
        value: "",
        attribute_id: attribute.id, // initial data for form1
    });

    const updateAttribute: FormEventHandler = (e) => {
        e.preventDefault();
        console.log(route("admin.attributes.update", attribute.id))
    };
    const AddValue: FormEventHandler = (e) => {
        e.preventDefault();
        submitAddValue(route("admin.attribute-values.store"));
    };
    return (
        <AuthenticatedLayout header="Attributes">
            <Head title="Update Attributes" />

            <p>Update</p>
            <form onSubmit={updateAttribute} className="max-w-md mt-6">
                <div className="grid gap-4">
                    <div className="grid gap-2">
                        <Label htmlFor="name">Name</Label>
                        <Input
                            id="name"
                            type="text"
                            placeholder="Attribute name"
                            value={data.name}
                            onChange={(e) => setData("name", e.target.value)}
                            required
                        />

                        <InputError message={errors.name} />
                    </div>
                    <Button type="submit" className="w-full">
                        Update
                    </Button>
                </div>
            </form>
            <Separator className="my-12"></Separator>
            <Head title="Attribute Values" />
            <p>Attribute values</p>
            <Dialog>
                <DialogTrigger asChild>
                    <Button className="mt-4">
                        <p>Add Value</p>
                        <PlusCircleIcon className="ml-2 h-4 w-4" />
                    </Button>
                </DialogTrigger>
                <DialogContent>
                    <DialogHeader>
                        <DialogTitle>
                            Add a Value to {attribute.name}
                        </DialogTitle>
                    </DialogHeader>
                    <form onSubmit={AddValue} className="max-w-md mt-6">
                        <div className="grid gap-4">
                            <div className="grid gap-2">
                                <Label htmlFor="name">Name</Label>
                                <Input
                                    id="name"
                                    type="text"
                                    placeholder="Attribute name"
                                    value={addValueData.value}
                                    onChange={(e) =>
                                        setValueData("value", e.target.value)
                                    }
                                    required
                                />

                                <InputError message={errors.name} />
                            </div>
                            <DialogClose>
                                <Button type="submit" className="w-full">
                                    Add
                                </Button>
                            </DialogClose>
                        </div>
                    </form>
                </DialogContent>
            </Dialog>
            <AttributeValuesTable attribute_values={attribute_values} />
        </AuthenticatedLayout>
    );
}
