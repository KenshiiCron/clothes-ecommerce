import AuthenticatedLayout from "@/layouts/authenticated-layout";
import { Head, useForm } from "@inertiajs/react";
import { Label } from "@/components/ui/label";
import { Input } from "@/components/ui/input";
import { Button } from "@/components/ui/button";
import { InputError } from "@/components/ui/input-error";
import {FormEventHandler, useState} from "react";
import { Textarea } from "@/components/ui/textarea";
import { Switch } from "@/components/ui/switch";

export default function Edit({ category }: any) {
    const { data, setData, put, processing, errors, reset } = useForm({
        name: category.name,
        description: category.description,
        featured: category.featured,
        image: null,
    });

    const [preview, setPreview] = useState(data.image ? data.image : null);
    const handleImageChange = (e: any) => {
        const file = e.target.files[0];
        if (file) {
            setData("image", file);
            setPreview(URL.createObjectURL(file));
        }
    };

    const submit: FormEventHandler = (e) => {
        e.preventDefault();

        put(route("admin.categories.update", category.id));
    };
    return (
        <AuthenticatedLayout header="Categories">
            <Head title="Edit Category" />

            <p>Edit</p>
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
                            onChange={(e) =>
                                setData("description", e.target.value)
                            }
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
                            // onChange={(e) =>
                            //     setData("image", e.target.files[0])
                            // }
                            onChange={handleImageChange}
                            // required
                        />
                        <InputError message={errors.image} />
                        {preview ? (
                            <img
                                src={preview}
                                alt="Selected image preview"
                                className="w-32 h-32 object-cover rounded"
                            />
                        ) : (
                            <img
                                src={category.image_url}
                                alt="Selected image preview"
                                className="w-32 h-32 object-cover rounded"
                            />
                        )}
                    </div>
                    <div className="grid gap-2">
                        <div className="flex items-center space-x-3">
                            <Label htmlFor="featured">Featured</Label>
                            <Switch
                                id="featured"
                                checked={data.featured}
                                onCheckedChange={(e) => setData("featured", e)}
                            />
                        </div>
                        <InputError message={errors.description} />
                    </div>
                    <Button type="submit" className="w-full mt-4">
                        Update
                    </Button>
                </div>
            </form>
        </AuthenticatedLayout>
    );
}
