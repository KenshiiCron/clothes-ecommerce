import AuthenticatedLayout from "@/layouts/authenticated-layout";
import {Head, useForm} from "@inertiajs/react";
import {Label} from "@/components/ui/label";
import {Input} from "@/components/ui/input";
import {Button} from "@/components/ui/button";
import {Separator} from "@/components/ui/separator";
import {InputError} from "@/components/ui/input-error";
import {FormEventHandler, useState} from "react";

import {Eye, EyeOff} from 'lucide-react'
import {MultiSelect} from "@/components/multi-select";

export default function Create({roles}: any) {
    const {data, setData, post, processing, errors, reset} = useForm({
        name: "",
        email: "",
        password: "",
        password_confirmation: "",
        phone: "",
        roles: [],
    });
    const [showPassword, setShowPassword] = useState(false)
    const togglePasswordVisibility = () => {
        setShowPassword(!showPassword)
    }
    const [showPasswordConfirmation, setShowPasswordConfirmation] = useState(false)
    const togglePasswordConfirmationVisibility = () => {
        setShowPasswordConfirmation(!showPasswordConfirmation)
    }

    const submit: FormEventHandler = (e) => {
        e.preventDefault();
        post(route("admin.admins.store"));
    };

    const handleChangeRoles = (values: any) => {
        setData('roles', values);
    }
    return (
        <AuthenticatedLayout header="Admins">
            <Head title="Create Admin"/>

            <p>Create</p>
            <form onSubmit={submit} className="max-w-md mt-6">
                <div className="grid gap-4">
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
                        <InputError message={errors.name}/>
                    </div>
                    <div className="grid gap-2">
                        <Label htmlFor="email">Email</Label>
                        <Input
                            id="email"
                            type="email"
                            placeholder="Email"
                            value={data.email}
                            onChange={(e) => setData("email", e.target.value)}
                            required
                        />
                        <InputError message={errors.email}/>
                    </div>
                    <div className="grid gap-2">
                        <Label htmlFor="email">Phone</Label>
                        <Input
                            id="phone"
                            type="text"
                            placeholder="Phone"
                            value={data.phone}
                            onChange={(e) => setData("phone", e.target.value)}
                            required
                        />
                        <InputError message={errors.phone}/>
                    </div>
                    <div className="grid gap-2">
                        <Label htmlFor="user_id">Roles</Label>
                        <MultiSelect
                            options={roles}
                            onValueChange={handleChangeRoles}
                            // defaultValue={selectedFrameworks}
                            placeholder="Select roles"
                            variant="inverted"
                            animation={2}
                        />
                        {/*<InputError message={errors.category_id}/>*/}
                    </div>
                    <Separator className="my-4"></Separator>
                    <div className="relative grid gap-2">
                        <Label htmlFor="password">Password</Label>
                        <Input
                            type={showPassword ? 'text' : 'password'}
                            placeholder="Password"
                            value={data.password}
                            onChange={(e) => setData("password", e.target.value)}
                            className="pr-10"
                        />
                        <Button
                            type="button"
                            variant="ghost"
                            size="icon"
                            className="absolute right-0 top-3 h-full px-3 py-2 hover:bg-transparent"
                            onClick={togglePasswordVisibility}
                            aria-label={showPassword ? 'Hide password' : 'Show password'}
                        >
                            {showPassword ? (
                                <EyeOff className="h-4 w-4 text-gray-500"/>
                            ) : (
                                <Eye className="h-4 w-4 text-gray-500"/>
                            )}
                        </Button>
                    </div>
                    <InputError message={errors.password}/>
                    <div className="relative grid gap-2">
                        <Label htmlFor="password_confirmation">Password confirmation</Label>
                        <Input
                            type={showPasswordConfirmation ? 'text' : 'password'}
                            placeholder="Password Confirmation"
                            value={data.password_confirmation}
                            onChange={(e) => setData("password_confirmation", e.target.value)}
                            className="pr-10"
                        />
                        <Button
                            type="button"
                            variant="ghost"
                            size="icon"
                            className="absolute right-0 top-3 h-full px-3 py-2 hover:bg-transparent"
                            onClick={togglePasswordConfirmationVisibility}
                            aria-label={showPasswordConfirmation ? 'Hide password confirmation' : 'Show password confirmation'}
                        >
                            {showPasswordConfirmation ? (
                                <EyeOff className="h-4 w-4 text-gray-500"/>
                            ) : (
                                <Eye className="h-4 w-4 text-gray-500"/>
                            )}
                        </Button>
                    </div>
                    <InputError message={errors.password_confirmation}/>
                    <Button type="submit" className="w-full mt-4" disabled={processing}>
                        Create
                    </Button>
                </div>
            </form>
        </AuthenticatedLayout>
    );
}
