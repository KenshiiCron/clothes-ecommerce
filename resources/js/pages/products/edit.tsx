
import { Tabs, TabsContent, TabsList, TabsTrigger } from "@/components/ui/tabs"
import {Head, Link, router, useForm} from "@inertiajs/react";
import * as React from "react";
import AuthenticatedLayout from "@/layouts/authenticated-layout";
import {Label} from "@/components/ui/label";
import {Input} from "@/components/ui/input";
import {InputError} from "@/components/ui/input-error";
import {Button} from "@/components/ui/button";


import {Textarea} from "@/components/ui/textarea";
import {Select, SelectContent, SelectItem, SelectTrigger, SelectValue} from "@/components/ui/select";
import {FormEventHandler, useEffect, useState} from "react";
import ProductAttributeTable from "@/components/tables/product-attribute-table"


import {
    Dialog,
    DialogClose,
    DialogContent,
    DialogHeader,
    DialogTitle,
    DialogTrigger,
} from "@/components/ui/dialog";
import { PlusIcon } from "lucide-react";
import InventoryTable from "@/components/tables/inventory-table";

import {CKEditor} from '@ckeditor/ckeditor5-react';
import {
    ClassicEditor,
    Bold,
    Essentials,
    Heading,
    Indent,
    IndentBlock,
    Italic,
    List,
    FontColor,
    FontBackgroundColor,
    Paragraph,
    Table,
    Undo,
    EventInfo
} from 'ckeditor5';

import 'ckeditor5/ckeditor5.css';

export type Product = {
    id: string,
    category_id: string,
    description: string,
    image_url: string,
    name: string,
    created_at: string,
    updated_at: string,
    category: Category,
    attributes: Attribute[],
    inventories: Inventory[]
}
export type Category = {
    id: number,
    name: string
}
export type Attribute = {
    id: string,
    name: string
}
export type Inventory = {
    id: string;
    product_id: string;
    quantity: number;
    price: number;
    created_at: string
}


export type AttributesValues = {
    id:string,
    name:string,
    values: Value[]
}
 export type Value = {
     attribute_id:string,
     id:string,
     value?: string,
 }

interface EditProductProps{
    product: Product,
    categories: Category[],

    attributes: Attribute[],
    product_attributes: Attribute[],
    attributes_values: AttributesValues[];
    inventories: Inventory [];
}


export default function Edit({product,categories ,attributes,product_attributes, inventories,attributes_values}:EditProductProps){
    const { data, setData, put, processing, errors, reset } = useForm({
        category_id : product.category_id,
        name: product.name,
        description: product.description,
        image: null,

    });

    const {
        data: attachAttributeData,
        setData: setAttributeData,
        put: submitAttachAttribute,
        processing: processingAttachAttribute,
        errors: errorsAttachAttribute,
        reset: resetAttachAttribute,
    } = useForm({
        product_id: product.id,
        attribute_id: '',
    });

    const {
        data: inventoryData,
        setData: setInventoryData,
        post: submitAddInventory,
        processing: processingAddInventory,
        errors: errorsAddInventory,
        reset: resetAddInventory,
    } = useForm({
        product_id: product.id,
        quantity: 0,
        price: 0,
        values: [] as Value[]
    });



    const AttachAttribute :FormEventHandler = (e) => {
        e.preventDefault();
        submitAttachAttribute(route("admin.products.attach",attachAttributeData.attribute_id));
        resetAttachAttribute();
        resetAttachAttribute('attribute_id')
    };

    const AddInventory :FormEventHandler = (e) => {
        e.preventDefault();
        //console.log(inventoryData.values)
        submitAddInventory(route("admin.inventories.store"));
        resetAddInventory('values','quantity','price');
    };

    const [preview, setPreview] = useState(data.image ? data.image : null);
    const handleImageChange = (e: any) => {
        const file = e.target.files[0];

        if (file) {setData("image", file);
            // @ts-ignore
            setPreview(URL.createObjectURL(file));

        }

    };
    const submit: FormEventHandler = (e) => {
        e.preventDefault();
        console.log(data.image)
        router.post(route("admin.products.update", product.id), {
            _method: "put",
            category_id :data.category_id,
            name: data.name,
            description: data.description,
            image: data.image,
        });
    };

    const MemoizedProductAttributeTable = React.memo(ProductAttributeTable);
    const MemoizedInventoryTable = React.memo(InventoryTable);

    // @ts-ignore
    return(
        <AuthenticatedLayout header="Product">
            <Head title="Update Product"/>
            <p>Update</p>
            <Tabs defaultValue="general" className="w-full mt-6">
                <TabsList className= "w-full justify-around">
                    <TabsTrigger value="general" className='w-full'>General</TabsTrigger>
                    <TabsTrigger value="images" className='w-full'>Images</TabsTrigger>
                    <TabsTrigger value="attributes" className='w-full'>Attributes</TabsTrigger>
                    <TabsTrigger value="inventory" className='w-full'>Inventory</TabsTrigger>
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
                                <CKEditor
                                    editor={ClassicEditor}
                                    data={data.description}
                                    onChange={(e: EventInfo, editor: ClassicEditor) => setData("description", editor.getData())}
                                    config={{
                                        toolbar: [
                                            'undo', 'redo', '|',
                                            'heading', '|', 'bold', 'italic', 'fontColor', 'fontBackgroundColor', '|',
                                            'insertTable', '|',
                                            'bulletedList', 'numberedList', 'indent', 'outdent'
                                        ],
                                        plugins: [
                                            Bold,
                                            Essentials,
                                            Heading,
                                            Indent,
                                            IndentBlock,
                                            Italic,
                                            FontColor,
                                            FontBackgroundColor,
                                            List,
                                            Paragraph,
                                            Table,
                                            Undo
                                        ],
                                    }}
                                />
                                <InputError message={errors.description}/>
                            </div>

                            <div className="grid gap-2">
                                <Label htmlFor="user_id">Category</Label>
                                <Select
                                    value={product.category_id}
                                    onValueChange={(value) => setData("category_id", value)}
                                >
                                    <SelectTrigger>
                                        <SelectValue placeholder={product.category.name}
                                                     defaultValue={String(product.category.id)}/>
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
                                {preview ? (
                                    <img
                                        src={preview}
                                        alt="Selected image preview"
                                        className="w-32 h-32 object-cover rounded"
                                    />
                                ) : (
                                    <img
                                        src={product.image_url}
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
                <TabsContent value='attributes'>
                    <Dialog>
                        <DialogTrigger asChild>
                            <Button className="mt-4 mb-4">
                                    <p>Add attribute</p>
                                    <PlusIcon size={20}/>
                            </Button>
                        </DialogTrigger>
                        <DialogContent >
                            <DialogHeader>
                                <DialogTitle>
                                    Add an attribute to {product.name}
                                </DialogTitle>
                            </DialogHeader>
                            <form onSubmit={AttachAttribute} className="max-w-md mt-6">
                                <div className="grid gap-4">
                                    <div className="grid gap-2">
                                        <Label >Attribute</Label>
                                        <Select
                                            value={attachAttributeData.attribute_id}
                                            onValueChange={(value) => {
                                                setAttributeData("attribute_id", value)
                                            }}
                                        >
                                            <SelectTrigger>
                                                <SelectValue placeholder='Select attribute'/>
                                            </SelectTrigger>
                                            <SelectContent>
                                                {attributes.map((attribute) => (
                                                    <SelectItem key={attribute.id} value={String(attribute.id)}>
                                                        {attribute.name}
                                                    </SelectItem>
                                                ))}
                                            </SelectContent>
                                        </Select>
                                        <InputError message={errorsAttachAttribute.attribute_id}/>
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


                    <MemoizedProductAttributeTable attributes={product.attributes} product_id={product.id}/>
                </TabsContent>
                <TabsContent value='inventory'>
                    <Dialog >
                        <DialogTrigger asChild>
                            <Button className="mt-4 mb-4">
                                <p>Add inventory</p>
                                <PlusIcon size={20}/>
                            </Button>
                        </DialogTrigger>
                        <DialogContent >
                            <DialogHeader>
                                <DialogTitle>
                                    Add an inventory
                                </DialogTitle>
                            </DialogHeader>
                            <form onSubmit={AddInventory} className="max-w-md mt-6">

                                <div className="grid gap-4">
                                    <div className="grid gap-2">
                                        <Label htmlFor="price">Price</Label>
                                        <Input
                                            id="price"
                                            type="number"
                                            placeholder="Price"
                                            value={inventoryData.price}
                                            onChange={(e) => setInventoryData("price", Number(e.target.value))}
                                            required
                                        />
                                        <InputError message={errorsAddInventory.price}/>
                                    </div>

                                        <div className="grid gap-2">
                                            <Label htmlFor="quantity">Quantity</Label>
                                            <Input
                                                id="quantity"
                                                type="number"
                                                placeholder="Quantity"
                                                value={inventoryData.quantity}
                                                onChange={(e) => setInventoryData("quantity", Number(e.target.value))}
                                                required
                                            />
                                            <InputError message={errorsAddInventory.quantity}/>
                                        </div>
                                        {
                                            attributes_values.map((att) => {
                                                return (
                                                    <div className="grid gap-2">
                                                        <Label>{att.name}</Label>
                                                        <Select
                                                            onValueChange={(value) => {
                                                                console.log(value)
                                                                const exists = inventoryData.values.some((item :Value) => item.attribute_id == att.id);
                                                                if (exists) {
                                                                    const updatedValues = inventoryData.values.map((item : Value) =>
                                                                        item.attribute_id == att.id
                                                                            ? { ...item, id: value }
                                                                            : item
                                                                    );

                                                                    setInventoryData('values', updatedValues);
                                                                } else {
                                                                    setInventoryData('values', [
                                                                        ...inventoryData.values,
                                                                        {
                                                                            attribute_id: att.id,
                                                                            id: value
                                                                        }
                                                                    ]);
                                                                }
                                                            }}
                                                        >
                                                            <SelectTrigger>
                                                                <SelectValue placeholder={'Select a value'}/>
                                                            </SelectTrigger>
                                                            <SelectContent>
                                                                {att.values.map((v) => (
                                                                    <SelectItem key={v.id}
                                                                                value={String(v.id)}>
                                                                        {v.value}
                                                                    </SelectItem>
                                                                ))}
                                                            </SelectContent>
                                                        </Select>
                                                        <InputError message={errorsAttachAttribute.attribute_id}/>
                                                    </div>
                                                )
                                            })
                                        }
                                        <DialogClose>
                                            <Button type="submit" className="w-full">
                                                Add
                                            </Button>
                                        </DialogClose>
                                    </div>
                            </form>
                        </DialogContent>
                    </Dialog>
                    <MemoizedInventoryTable product_attributes={product.attributes} inventories={inventories} attributes_values={attributes_values}/>
                </TabsContent>
            </Tabs>


        </AuthenticatedLayout>
);

}
