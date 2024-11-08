
import { Tabs, TabsContent, TabsList, TabsTrigger } from "@/components/ui/tabs"
import {Head, router, useForm} from "@inertiajs/react";
import * as React from "react";
import AuthenticatedLayout from "@/layouts/authenticated-layout";
import {Label} from "@/components/ui/label";
import {Input} from "@/components/ui/input";
import {InputError} from "@/components/ui/input-error";
import {Button} from "@/components/ui/button";
import {Separator} from "@/components/ui/separator";
import {Dialog, DialogClose, DialogContent, DialogHeader, DialogTitle, DialogTrigger} from "@/components/ui/dialog";
import {PlusCircleIcon} from "lucide-react";
import AttributeValuesTable from "@/components/tables/attribute-values-table";
import {Textarea} from "@/components/ui/textarea";
import {Select, SelectContent, SelectItem, SelectTrigger, SelectValue} from "@/components/ui/select";
import {FormEventHandler, useState} from "react";


export type Product = {
    id: string,
    category_id: number,
    description: string,
    image_url: string,
    name: string,
    created_at: string,
    updated_at: string
}
export type Category = {
    id: number,
    name: string
}
interface EditProductProps{
    product: Product,
    categories: Category[],
    product_category: Category,
}

export default function Edit({product,product_category,categories}:EditProductProps){
    const { data, setData, put, processing, errors, reset } = useForm({
        category_id : product.category_id,
        name: product.name,
        description: product.description,
        image: product.image_url,
    });

    const [preview, setPreview] = useState(data.image ? data.image : null);
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

        router.post(route("admin.products.update", product.id), {
            _method: "put",
            category_id :data.category_id,
            name: data.name,
            description: data.description,
            image: data.image,
        });
    };
    console.log(product.category_id)
    // @ts-ignore
    return(
        <AuthenticatedLayout header="Product">
            <Head title="Update Product"/>
            <p>Update</p>
            <Tabs defaultValue="general" className="w-full mt-6">
                <TabsList className= "w-full justify-around">
                    <TabsTrigger value="general" className='w-full'>General</TabsTrigger>
                    <TabsTrigger value="attributes" className='w-full'>Attributes</TabsTrigger>
                    <TabsTrigger value="inventory" className='w-full'>Inventory</TabsTrigger>
                    <TabsTrigger value="images" className='w-full'>Images</TabsTrigger>
                </TabsList>
                <TabsContent value="general">
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
                                    value={String(data.category_id)}
                                    onValueChange={(value) => setData("category_id", value}
                                >
                                    <SelectTrigger>
                                        <SelectValue placeholder={product_category.name} defaultValue={String(product_category.id)}/>
                                    </SelectTrigger>
                                    <SelectContent>
                                        {categories.map((category) => (
                                            <SelectItem key={category.id} value={String(category.id)} >
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
                                Update
                            </Button>
                        </div>
                    </form>
                </TabsContent>
            </Tabs>
        </AuthenticatedLayout>
    );
}
