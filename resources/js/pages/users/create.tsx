import AuthenticatedLayout from "@/layouts/authenticated-layout";
import {Head, useForm} from "@inertiajs/react";
import {Label} from "@/components/ui/label";
import {Input} from "@/components/ui/input";
import {Button} from "@/components/ui/button";
import {Separator} from "@/components/ui/separator";
import {InputError} from "@/components/ui/input-error";
import {Switch} from "@/components/ui/switch";
import {
    Select,
    SelectContent,
    SelectItem,
    SelectTrigger,
    SelectValue,
} from "@/components/ui/select";
import {FormEventHandler, useState} from "react";

import {Eye, EyeOff} from 'lucide-react'

export default function Create() {
    const {data, setData, post, processing, errors, reset} = useForm({
        name: "",
        email: "",
        password: "",
        password_confirmation: "",
        phone: "",
        image: null,
    });

    const [preview, setPreview] = useState(data.image);
    const handleImageChange = (e: any) => {
        const file = e.target.files[0];
        if (file) {
            setData("image", file);
            // @ts-ignore
            setPreview(URL.createObjectURL(file));
        }
    };

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

        post(route("admin.users.store"));
    };
    return (
        <AuthenticatedLayout header="Users">
            <Head title="Create User"/>

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
                        <Label htmlFor="password_confirmation">Password</Label>
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
                    <Separator className="my-4"></Separator>
                    <div className="grid gap-2">
                        <Label htmlFor="image">Image</Label>
                        <Input
                            id="image"
                            type="file"
                            accept="image/*"
                            placeholder="Image url"
                            onChange={handleImageChange}
                            required
                        />
                        {preview && (
                            <img
                                src={preview}
                                alt="Selected image preview"
                                className="w-32 h-32 object-cover rounded"
                            />
                        )}
                        <InputError message={errors.image}/>
                    </div>
                    <Button type="submit" className="w-full mt-4" disabled={processing}>
                        Create
                    </Button>
                </div>
            </form>
        </AuthenticatedLayout>
    );
}
