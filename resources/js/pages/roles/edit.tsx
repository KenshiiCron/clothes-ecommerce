import AuthenticatedLayout from "@/layouts/authenticated-layout";
import { Head, useForm } from "@inertiajs/react";
import { Label } from "@/components/ui/label";
import { Input } from "@/components/ui/input";
import { Separator } from "@/components/ui/separator";
import { InputError } from "@/components/ui/input-error";
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from "@/components/ui/table";
import { Checkbox } from "@/components/ui/checkbox";
import { FormEventHandler } from "react";
import {Button} from "@/components/ui/button";

export default function Edit({ adminPermissionsList, role } : any) {
    const { data, setData, put, processing, errors, reset } = useForm({
        name: role.name,
        permissions: role.permissions.map((permission :any) => permission.name),
    });

    const submit: FormEventHandler = (e) => {
        e.preventDefault();
        put(route("admin.roles.update", role.id));
    };

    const handlePermissionChange = (permission) => {
        setData((prevData) => ({
            ...prevData,
            permissions: prevData.permissions.includes(permission)
                ? prevData.permissions.filter((p) => p !== permission) // Remove permission
                : [...prevData.permissions, permission], // Add permission
        }));
    };

    return (
        <AuthenticatedLayout header="Roles">
            <Head title="Edit Role" />

            <p>Edit</p>
            <form className="max-w-md mt-6" onSubmit={submit}>
                <div className="grid gap-2">
                    <Label htmlFor="name">Name</Label>
                    <Input
                        id="name"
                        type="text"
                        placeholder="Name"
                        value={data.name}
                        onChange={(e) => setData("name", e.target.value)}
                        required
                    />
                    <InputError message={errors.name} />
                </div>
                <Separator className="my-12 max-w-md"></Separator>
                <div className="grid gap-2">
                    <Label>Permissions</Label>
                    {Object.entries(adminPermissionsList).map(([model, permissions], modelIndex) => (
                        <Table key={modelIndex} className="mb-4 border rounded-lg">
                            <TableHeader>
                                <TableRow>
                                    <TableHead className="w-1/3">{model}</TableHead>
                                    <TableHead className="w-2/3">Capabilities</TableHead>
                                </TableRow>
                            </TableHeader>
                            <TableBody>
                                <TableRow>
                                    <TableCell className="w-1/3 font-medium">{model}</TableCell>
                                    <TableCell className="w-2/3 flex flex-wrap space-x-4">
                                        {permissions.capabilities.map((capability, capabilityIndex) => {
                                            const permissionName = `${capability}-${model}`;
                                            return (
                                                <div key={capabilityIndex} className="flex items-center space-x-2">
                                                    <Checkbox
                                                        id={permissionName}
                                                        name="permissions[]"
                                                        value={permissionName}
                                                        checked={data.permissions.includes(permissionName)}
                                                        onCheckedChange={() => handlePermissionChange(permissionName)}
                                                    />
                                                    <label htmlFor={permissionName} className="text-gray-700">
                                                        {capability}
                                                    </label>
                                                </div>
                                            );
                                        })}
                                    </TableCell>
                                </TableRow>
                            </TableBody>
                        </Table>
                    ))}
                </div>
                <Button type="submit" className="w-full mt-4" disabled={processing}>
                    Update
                </Button>
            </form>
        </AuthenticatedLayout>
    );
}
