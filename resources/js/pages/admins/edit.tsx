import AuthenticatedLayout from "@/layouts/authenticated-layout";
import {Head, router, useForm} from "@inertiajs/react";
import {Label} from "@/components/ui/label";
import {Input} from "@/components/ui/input";
import {Button} from "@/components/ui/button";
import {Separator} from "@/components/ui/separator";
import {InputError} from "@/components/ui/input-error";
import {FormEventHandler, useState} from "react";

import {Eye, EyeOff} from 'lucide-react'
import {MultiSelect} from "@/components/multi-select";

export default function Edit({admin , roles}: any) {

    const {data, setData, processing, errors, reset} = useForm({
        name: admin.name,
        email: admin.email,
        phone: admin.phone,
        roles: admin.roles.map((role :any) => role.id),
    });

    // const {
    //     data: pwdData,
    //     setData: pwdSetData,
    //     put,
    //     processing: pwdProcessing,
    //     errors: pwdErrors,
    //     reset: pwdReset
    // } = useForm({
    //     old_password: "",
    //     password: "",
    //     password_confirmation: "",
    // });
    //
    // const [showPassword, setShowPassword] = useState(false)
    // const togglePasswordVisibility = () => {
    //     setShowPassword(!showPassword)
    // }
    // const [showPasswordConfirmation, setShowPasswordConfirmation] = useState(false)
    // const togglePasswordConfirmationVisibility = () => {
    //     setShowPasswordConfirmation(!showPasswordConfirmation)
    // }

    const submit: FormEventHandler = (e) => {
        e.preventDefault();
        router.post(route("admin.admins.update", admin.id), {
            _method: "put",
            name: data.name,
            email: data.email,
            // password: data.password,
            // password_confirmation: data.password,
            phone: data.phone,
            roles: data.roles,
        });
    };

    const submitChangePassword: FormEventHandler = (e) => {
        e.preventDefault();

        router.post(route("admin.users.update", admin.id), {
            _method: "put",
            name: data.name,
            email: data.email,
            // password: data.password,
            // password_confirmation: data.password,
            phone: data.phone,
        });
    };

    const handleChangeRoles = (values: any) => {
        setData('roles', values);
    }
    return (
        <AuthenticatedLayout header="Admins">
            <Head title="Edit Admin"/>

            <p>Edit</p>
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
                            defaultValue={admin.roles.map((role :any) => role.id)}
                            placeholder="Select roles"
                            variant="inverted"
                            animation={2}
                        />
                        {/*<InputError message={errors.category_id}/>*/}
                    </div>
                    <Button type="submit" className="w-full mt-4">
                        Update
                    </Button>
                </div>
            </form>
            <Separator className="my-12 max-w-md"></Separator>
            {/*<p>Edit Password</p>*/}
            {/*<form onSubmit={submitChangePassword} className="max-w-md mt-6">*/}
            {/*    <div className="grid gap-4">*/}
            {/*        <div className="relative grid gap-2">*/}
            {/*            <Label htmlFor="old_password">Old Password</Label>*/}
            {/*            <Input*/}
            {/*                type={showPassword ? 'text' : 'password'}*/}
            {/*                placeholder="Old Password"*/}
            {/*                value={pwdData.old_password}*/}
            {/*                onChange={(e) => pwdSetData("old_password", e.target.value)}*/}
            {/*                className="pr-10"*/}
            {/*            />*/}
            {/*            <Button*/}
            {/*                type="button"*/}
            {/*                variant="ghost"*/}
            {/*                size="icon"*/}
            {/*                className="absolute right-0 top-3 h-full px-3 py-2 hover:bg-transparent"*/}
            {/*                onClick={togglePasswordVisibility}*/}
            {/*                aria-label={showPassword ? 'Hide old password' : 'Show old password'}*/}
            {/*            >*/}
            {/*                {showPassword ? (*/}
            {/*                    <EyeOff className="h-4 w-4 text-gray-500"/>*/}
            {/*                ) : (*/}
            {/*                    <Eye className="h-4 w-4 text-gray-500"/>*/}
            {/*                )}*/}
            {/*            </Button>*/}
            {/*        </div>*/}
            {/*        <InputError message={pwdErrors.old_password}/>*/}
            {/*        <div className="relative grid gap-2">*/}
            {/*            <Label htmlFor="password_confirmation">New Password</Label>*/}
            {/*            <Input*/}
            {/*                type={showPasswordConfirmation ? 'text' : 'password'}*/}
            {/*                placeholder="New Password"*/}
            {/*                value={pwdData.password}*/}
            {/*                onChange={(e) => pwdSetData("password", e.target.value)}*/}
            {/*                className="pr-10"*/}
            {/*            />*/}
            {/*            <Button*/}
            {/*                type="button"*/}
            {/*                variant="ghost"*/}
            {/*                size="icon"*/}
            {/*                className="absolute right-0 top-3 h-full px-3 py-2 hover:bg-transparent"*/}
            {/*                onClick={togglePasswordConfirmationVisibility}*/}
            {/*                aria-label={showPasswordConfirmation ? 'Hide password confirmation' : 'Show password confirmation'}*/}
            {/*            >*/}
            {/*                {showPasswordConfirmation ? (*/}
            {/*                    <EyeOff className="h-4 w-4 text-gray-500"/>*/}
            {/*                ) : (*/}
            {/*                    <Eye className="h-4 w-4 text-gray-500"/>*/}
            {/*                )}*/}
            {/*            </Button>*/}
            {/*        </div>*/}
            {/*        <InputError message={pwdErrors.password}/>*/}
            {/*        <div className="relative grid gap-2">*/}
            {/*            <Label htmlFor="password_confirmation">Password</Label>*/}
            {/*            <Input*/}
            {/*                type={showPasswordConfirmation ? 'text' : 'password'}*/}
            {/*                placeholder="Password Confirmation"*/}
            {/*                value={pwdData.password_confirmation}*/}
            {/*                onChange={(e) => pwdSetData("password_confirmation", e.target.value)}*/}
            {/*                className="pr-10"*/}
            {/*            />*/}
            {/*        </div>*/}
            {/*        <InputError message={pwdErrors.password_confirmation}/>*/}
            {/*        <Button type="submit" className="w-full mt-4">*/}
            {/*            Update Password*/}
            {/*        </Button>*/}
            {/*    </div>*/}

            {/*</form>*/}
        </AuthenticatedLayout>
    );
}
