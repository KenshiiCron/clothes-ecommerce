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
import { Card, CardContent } from "@/components/ui/card";
import { EyeIcon, StarIcon, FlameIcon } from "lucide-react";


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

    const [selections, setSelections] = useState({
        state: true,
        featured: false,
        limited: false,
    })

    const toggleSelection = (option: keyof typeof selections) => {
        setSelections(prev => ({ ...prev, [option]: !prev[option] }))
    }

    const CardCheckbox = ({
                              id,
                              checked,
                              label,
                              icon: Icon,
                              onChange
                          }: {
        id: keyof typeof selections;
        checked: boolean;
        label: string;
        icon: React.ElementType;
        onChange: () => void;
    }) => (
        <Card
            className={`cursor-pointer transition-all ${checked ? 'border-primary' : ''}`}
            onClick={onChange}
        >
            <CardContent className="flex flex-col items-center justify-center p-6 space-y-2">
                <Icon className={`h-6 w-6 mb-1 ${checked ? 'text-primary' : ''}`} />
                <Label htmlFor={id} className={`text-sm font-medium cursor-pointer ${checked ? 'text-primary' : ''}`}>
                    {label}
                </Label>
            </CardContent>
        </Card>
    )

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

                    <div className="grid gap-2">
                        <Label>Options</Label>
                        <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <CardCheckbox
                                id="state"
                                checked={selections.state}
                                label="State"
                                icon={EyeIcon}
                                onChange={() => toggleSelection('state')}
                            />
                            <CardCheckbox
                                id="featured"
                                checked={selections.featured}
                                label="Featured"
                                icon={StarIcon}
                                onChange={() => toggleSelection('featured')}
                            />
                            <CardCheckbox
                                id="limited"
                                checked={selections.limited}
                                label="Limited"
                                icon={FlameIcon}
                                onChange={() => toggleSelection('limited')}
                            />
                        </div>
                    </div>
                    <Button type="submit" className="w-full mt-4">
                        Create
                    </Button>
                </div>
            </form>
        </AuthenticatedLayout>
    );
}




