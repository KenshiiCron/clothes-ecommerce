import AuthenticatedLayout from "@/layouts/authenticated-layout";
import { Head, useForm } from "@inertiajs/react";
import { Label } from "@/components/ui/label";
import { Input } from "@/components/ui/input";
import { Button } from "@/components/ui/button";
import { InputError } from "@/components/ui/input-error";
import { Switch } from "@/components/ui/switch";
import {
    Select,
    SelectContent,
    SelectItem,
    SelectTrigger,
    SelectValue,
} from "@/components/ui/select";
import {FormEventHandler, useState} from "react";
import { Textarea } from "@/components/ui/textarea";


export type Category = {
    id: number,
    name: string
}


interface createCategory{
    categories: Category[]
}



export default function Create({categories} : createCategory) {
    const { data, setData, post, processing, errors, reset } = useForm({
        category_id : "",
        name: "",
        description: "",
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

    const submit: FormEventHandler = (e) => {
        e.preventDefault();

        post(route("admin.products.store"));
    };
    // @ts-ignore
    return (
        <AuthenticatedLayout header="Products">
            <Head title="Create Product" />

            <p>Create</p>
            <form onSubmit={submit} className="max-w-md mt-6">
                <div className="grid gap-4">
                    <div className="grid gap-2">
                        <Label htmlFor="name">Name</Label>
                        <Input
                            id="name"
                            type="text"
                            placeholder="Product name"
                            value={data.name}
                            onChange={(e) => setData("name", e.target.value)}
                            required
                        />
                        <InputError message={errors.name}/>
                    </div>

                    <div className="grid gap-2">
                        <Label htmlFor="description">Description</Label>
                        <Textarea
                            id="description"
                            placeholder="Product description"
                            value={data.description}
                            onChange={(e) =>
                                setData("description", e.target.value)
                            }

                        />
                        <InputError message={errors.description}/>
                    </div>
                    <div className="grid gap-2">
                        <Label htmlFor="user_id">Category</Label>
                        <Select
                            value={data.category_id}
                            onValueChange={(value) => setData("category_id", value)}
                        >
                            <SelectTrigger>
                                <SelectValue placeholder="Select a category"/>
                            </SelectTrigger>
                            <SelectContent>
                                {categories.map((category) => (
                                    <SelectItem key={category.id} value={String(category.id)}>
                                        {category.name}
                                    </SelectItem>
                                ))}
                            </SelectContent>
                        </Select>
                        <InputError message={errors.category_id}/>
                    </div>

                    <div className="grid gap-2">
                        <Label htmlFor="image">Image</Label>
                        <Input
                            id="image"
                            type="file"
                            accept="image/*"
                            placeholder="Image url"
                            onChange={handleImageChange}
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
                    <Button type="submit" className="w-full mt-4">
                        Create
                    </Button>
                </div>
            </form>
        </AuthenticatedLayout>
    );
}




