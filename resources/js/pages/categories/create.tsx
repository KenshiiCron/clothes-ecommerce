import AuthenticatedLayout from "@/layouts/authenticated-layout";
import {Head, useForm} from "@inertiajs/react";
import { Label } from "@/components/ui/label";
import { Input } from "@/components/ui/input";
import { Button } from "@/components/ui/button";
import { InputError } from "@/components/ui/input-error";
import {
    Select,
    SelectContent,
    SelectItem,
    SelectTrigger,
    SelectValue,
} from "@/components/ui/select"
import {FormEventHandler} from "react";
import {Textarea} from "@/components/ui/textarea";

export default function Create() {
    const { data, setData, post, processing, errors, reset } = useForm({
        name: "",
        description: "",
        state: "",
        image: null,
    });

    const submit: FormEventHandler = (e) => {
        e.preventDefault();

        post(route("admin.categories.store"));
    };
    return (
        <AuthenticatedLayout
            header="Categories"
        >
            <Head title="Create Category" />

            <p>Create</p>
            <form onSubmit={submit} className="max-w-md mt-6">
                <div className="grid gap-4">
                    <div className="grid gap-2">
                        <Label htmlFor="name">Name</Label>
                        <Input
                            id="name"
                            type="text"
                            placeholder="Category name"
                            value={data.name}
                            onChange={(e) => setData("name", e.target.value)}
                            required
                        />
                        <InputError message={errors.name} />
                    </div>
                    <div className="grid gap-2">
                        <Label htmlFor="description">Description</Label>
                        <Textarea
                            id="description"
                            placeholder="Category description"
                            value={data.description}
                            onChange={(e) => setData("description", e.target.value)}
                            required
                        />
                        <InputError message={errors.description} />
                    </div>
                    <div className="grid gap-2">
                        <Label htmlFor="image">Image</Label>
                        <Input
                            id="image"
                            type="file"
                            placeholder="Image url"
                            onChange={(e) => setData('image', e.target.files[0])}
                            required
                        />
                        <InputError message={errors.image} />
                    </div>
                    <div className="grid gap-2">
                        <Label htmlFor="state">State</Label>
                        <Select value={data.state} onValueChange={(value) => setData('state', value)}>
                            <SelectTrigger>
                                <SelectValue placeholder="State" />
                            </SelectTrigger>
                            <SelectContent>
                                <SelectItem value="1">Active</SelectItem>
                                <SelectItem value="0">Inactive</SelectItem>
                            </SelectContent>
                        </Select>
                        <InputError message={errors.state} />
                    </div>
                    <Button type="submit" className="w-full">
                        Create
                    </Button>
                </div>
            </form>
        </AuthenticatedLayout>
    );
}
