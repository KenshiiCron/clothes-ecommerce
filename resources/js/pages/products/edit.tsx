import {Tabs, TabsContent, TabsList, TabsTrigger} from "@/components/ui/tabs";
import {Head, router, useForm} from "@inertiajs/react";
import * as React from "react";
import AuthenticatedLayout from "@/layouts/authenticated-layout";
import {Label} from "@/components/ui/label";
import {Input} from "@/components/ui/input";
import {InputError} from "@/components/ui/input-error";
import {Button} from "@/components/ui/button";
import {
    Select,
    SelectContent,
    SelectItem,
    SelectTrigger,
    SelectValue,
} from "@/components/ui/select";
import {FormEventHandler, useRef, useState} from "react";
import ProductAttributeTable from "@/components/tables/product-attribute-table";

import {
    Dialog,
    DialogClose,
    DialogContent,
    DialogHeader,
    DialogTitle,
    DialogTrigger,
} from "@/components/ui/dialog";
import {PlusIcon, X} from "lucide-react";
import InventoryTable from "@/components/tables/inventory-table";
import {CKEditor} from "@ckeditor/ckeditor5-react";
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
    EventInfo,
} from "ckeditor5";
import "ckeditor5/ckeditor5.css";
import {
    Card,
    CardContent,
    CardDescription,
    CardFooter,
    CardHeader,
    CardTitle,
} from "@/components/ui/card";
import {MultiSelect} from "@/components/multi-select";

export type Product = {
    id: string;
    categories: Category[];
    description: string;
    image_url: string;
    name: string;
    created_at: string;
    updated_at: string;
    category: Category;
    images: Image[];
    attributes: Attribute[];
    inventories: Inventory[];
};
export type Category = {
    id: number;
    name: string;
};
export type Attribute = {
    id: string;
    name: string;
};
export type Inventory = {
    id: string;
    product_id: string;
    quantity: number;
    price: number;
    old_price: number;
    created_at: string;
    attribute_values: Value[]
}


export type AttributesValues = {
    id: string,
    name: string,
    values: Value[]
}
export type Value = {
    attribute_id?: string,
    id: string,
    value?: string,
}

type Image = {
    product_id: number;
    path: string;
    image_url: string;
};

interface EditProductProps {
    product: Product,
    categories: Category[],
    attributes: Attribute[],
    attributes_values: AttributesValues[];
    images: Image[];
    inventories: Inventory[];
}


export default function Edit({product, categories, attributes, attributes_values}: EditProductProps) {
    const {data, setData, put, processing, errors, reset} = useForm({
        categories: product.categories.map((category) => category.id),
        name: product.name,
        description: product.description,
        image: null,
    });

    console.log(product.categories)
    console.log(categories)

    const handleChangeCategories = (values: any) => {
        setData('categories', values);
    }

    const {
        data: attachAttributeData,
        setData: setAttributeData,
        put: submitAttachAttribute,
        processing: processingAttachAttribute,
        errors: errorsAttachAttribute,
        reset: resetAttachAttribute,
    } = useForm({
        product_id: product.id,
        attribute_id: "",
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
        old_price: 0,
        values: [] as Value[],
    });


    const AttachAttribute: FormEventHandler = (e) => {
        e.preventDefault();
        submitAttachAttribute(
            route("admin.products.attach", attachAttributeData.attribute_id)
        );
        resetAttachAttribute("attribute_id");
    };

    const AddInventory: FormEventHandler = (e) => {
        e.preventDefault();
        //console.log(inventoryData.values)
        submitAddInventory(route("admin.inventories.store"));
        resetAddInventory('values', 'quantity', 'price','old_price');
    };

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
        console.log(data.image)
        router.post(route("admin.products.update", product.id), {
            _method: "put",
            categories: data.categories,
            name: data.name,
            description: data.description,
            image: data.image,
        });
    };

    const MemoizedProductAttributeTable = React.memo(ProductAttributeTable);
    const MemoizedInventoryTable = React.memo(InventoryTable);

    // Images Tab
    const {
        data: imagesData,
        setData: setImagesData,
        post: submitImages,
        processing: processingImages,
        errors: errorsImages,
        reset: resetImages,
    } = useForm({
        old_images: product.images,
        deleted_images: [],
        images: [],
    });
    const [deletedImages, setDeletedImages] = useState<Image[]>([]);
    const [oldImages, setOldImages] = useState<Image[]>(
        product.images.map((image) => image)
    );
    const [images, setImages] = useState<File[]>([]);
    const [previews, setPreviews] = useState<string[]>([]);
    const fileInputRef = useRef<HTMLInputElement>(null);
    const handleFileChange = (e: React.ChangeEvent<HTMLInputElement>) => {
        const files = Array.from(e.target.files || []);
        setImages((prevImages) => [...prevImages, ...files]);
        setImagesData("images", files);
        const newPreviews = files.map((file) => URL.createObjectURL(file));
        setPreviews((prevPreviews) => [...prevPreviews, ...newPreviews]);
    };
    const removeOldImage = (index: number) => {
        setOldImages((prevOldImages) => {
            const newOldImages = [...prevOldImages];
            newOldImages.splice(index, 1);
            setDeletedImages((prevDeletedImages) => {
                const newDeletedImages = [...prevDeletedImages];
                newDeletedImages.push(newOldImages[index]);
                return newDeletedImages;
            });
            const imageToDelete = oldImages[index];
            setImagesData("deleted_images", [...imagesData.deleted_images, imageToDelete]);
            console.log(imagesData['deleted_images'])
            return newOldImages;
        });
    };
    const removeImage = (index: number) => {
        setImages((prevImages) => {
            const newImages = [...prevImages];
            newImages.splice(index, 1);
            return newImages;
        });
        setPreviews((prevPreviews) => {
            const newPreviews = [...prevPreviews];
            URL.revokeObjectURL(newPreviews[index]);
            newPreviews.splice(index, 1);
            return newPreviews;
        });
    };
    const handleUpload: FormEventHandler = (e) => {
        e.preventDefault();
        submitImages(route("admin.products.images", product.id));
    };

    // @ts-ignore
    return (
        <AuthenticatedLayout header="Product">
            <Head title="Edit Product"/>
            <p>Edit</p>
            <Tabs defaultValue="general" className="w-full mt-6">
                <TabsList className="w-full justify-around">
                    <TabsTrigger value="general" className="w-full">
                        General
                    </TabsTrigger>
                    <TabsTrigger value="images" className="w-full">
                        Images
                    </TabsTrigger>
                    <TabsTrigger value="attributes" className="w-full">
                        Attributes
                    </TabsTrigger>
                    <TabsTrigger value="inventory" className="w-full">
                        Inventory
                    </TabsTrigger>
                </TabsList>
                <TabsContent value="general">
                    <Card>
                        <CardHeader>
                            <CardTitle>General</CardTitle>
                            <CardDescription>
                                Edit general product information.
                            </CardDescription>
                        </CardHeader>
                        <CardContent>
                            <form onSubmit={submit} className="max-w-md">
                                <div className="grid gap-4">
                                    <div className="grid gap-2">
                                        <Label htmlFor="name">Name</Label>
                                        <Input
                                            id="name"
                                            type="text"
                                            placeholder="Product name"
                                            value={data.name}
                                            onChange={(e) =>
                                                setData("name", e.target.value)
                                            }
                                            required
                                        />
                                        <InputError message={errors.name}/>
                                    </div>

                                    <div className="grid gap-2">
                                        <Label htmlFor="description">
                                            Description
                                        </Label>
                                        <CKEditor
                                            editor={ClassicEditor}
                                            data={data.description}
                                            onChange={(
                                                e: EventInfo,
                                                editor: ClassicEditor
                                            ) =>
                                                setData(
                                                    "description",
                                                    editor.getData()
                                                )
                                            }
                                            config={{
                                                toolbar: [
                                                    "undo",
                                                    "redo",
                                                    "|",
                                                    "heading",
                                                    "|",
                                                    "bold",
                                                    "italic",
                                                    "fontColor",
                                                    "fontBackgroundColor",
                                                    "|",
                                                    "insertTable",
                                                    "|",
                                                    "bulletedList",
                                                    "numberedList",
                                                    "indent",
                                                    "outdent",
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
                                                    Undo,
                                                ],
                                            }}
                                        />
                                        <InputError
                                            message={errors.description}
                                        />
                                    </div>

                                    <div className="grid gap-2">
                                        <Label htmlFor="categories">Category</Label>
                                        <MultiSelect
                                            options={categories}
                                            onValueChange={handleChangeCategories}
                                            defaultValue={product.categories.map((category) => category.id)}
                                            placeholder="Select categories"
                                            variant="inverted"
                                            animation={2}
                                        />
                                        <InputError message={errors.categories}/>
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
                                    <Button
                                        type="submit"
                                        className="w-full mt-4"
                                    >
                                        Update
                                    </Button>
                                </div>
                            </form>
                        </CardContent>
                    </Card>
                </TabsContent>
                <TabsContent value="images">
                    <Card>
                        <CardHeader>
                            <CardTitle>Images</CardTitle>
                            <CardDescription>
                                Add or remove images from your product.
                            </CardDescription>
                        </CardHeader>
                        <CardContent>
                            <div className="space-y-6">
                                <div>
                                    <Label htmlFor="images" className="mr-4">
                                        Product Images
                                    </Label>
                                    <Input
                                        id="images"
                                        type="file"
                                        accept="image/*"
                                        multiple
                                        onChange={handleFileChange}
                                        ref={fileInputRef}
                                        className="hidden"
                                    />
                                    <Button
                                        type="button"
                                        variant="outline"
                                        onClick={() =>
                                            fileInputRef.current?.click()
                                        }
                                    >
                                        Select Images
                                    </Button>
                                </div>

                                {(previews.length > 0 ||
                                    oldImages?.length > 0) && (
                                    <Card>
                                        <CardContent className="p-8 min-w-fit">
                                            <div className="flex flex-wrap gap-8 justify-center md:justify-start">
                                                {oldImages?.map(
                                                    (oldImage, index) => (
                                                        <div
                                                            key={index}
                                                            className="relative group"
                                                        >
                                                            <img
                                                                src={
                                                                    oldImage.image_url
                                                                }
                                                                alt={
                                                                    oldImage.path
                                                                }
                                                                className="w-40 h-40 object-cover rounded-md"
                                                            />
                                                            <Button
                                                                type="button"
                                                                variant="destructive"
                                                                size="icon"
                                                                className="absolute top-1 right-1 opacity-0 group-hover:opacity-100 transition-opacity"
                                                                onClick={() =>
                                                                    removeOldImage(index)
                                                                }
                                                            >
                                                                <X className="h-4 w-4"/>
                                                            </Button>
                                                        </div>
                                                    )
                                                )}
                                                {previews?.map(
                                                    (preview, index) => (
                                                        <div
                                                            key={index}
                                                            className="relative group"
                                                        >
                                                            <img
                                                                src={preview}
                                                                alt={`Preview ${
                                                                    index + 1
                                                                }`}
                                                                className="w-40 h-40 object-cover rounded-md opacity-50"
                                                            />
                                                            <Button
                                                                type="button"
                                                                variant="destructive"
                                                                size="icon"
                                                                className="absolute top-1 right-1 opacity-0 group-hover:opacity-100 transition-opacity"
                                                                onClick={() =>
                                                                    removeImage(
                                                                        index
                                                                    )
                                                                }
                                                            >
                                                                <X className="h-4 w-4"/>
                                                            </Button>
                                                        </div>
                                                    )
                                                )}
                                            </div>
                                        </CardContent>
                                    </Card>
                                )}
                            </div>
                        </CardContent>
                        <CardFooter>
                            <Button
                                onClick={handleUpload}
                                disabled={images.length === 0 && imagesData.deleted_images.length === 0}
                            >
                                Update Images
                            </Button>
                        </CardFooter>
                    </Card>
                </TabsContent>
                <TabsContent value="attributes">
                    <Card>
                        <CardHeader>
                            <CardTitle>Attributes</CardTitle>
                            <CardDescription>
                                Attach or detach attributes from your product.
                            </CardDescription>
                        </CardHeader>
                        <CardContent>
                            <Dialog>
                                <DialogTrigger asChild>
                                    <Button className="mb-4">
                                        <p>Add attribute</p>
                                        <PlusIcon size={20}/>
                                    </Button>
                                </DialogTrigger>
                                <DialogContent>
                                    <DialogHeader>
                                        <DialogTitle>
                                            Add an attribute to {product.name}
                                        </DialogTitle>
                                    </DialogHeader>
                                    <form
                                        onSubmit={AttachAttribute}
                                        className="max-w-md mt-6"
                                    >
                                        <div className="grid gap-4">
                                            <div className="grid gap-2">
                                                <Label>Attribute</Label>
                                                <Select
                                                    value={
                                                        attachAttributeData.attribute_id
                                                    }
                                                    onValueChange={(value) => {
                                                        setAttributeData(
                                                            "attribute_id",
                                                            value
                                                        );
                                                    }}
                                                >
                                                    <SelectTrigger>
                                                        <SelectValue placeholder="Select attribute"/>
                                                    </SelectTrigger>
                                                    <SelectContent>
                                                        {attributes.map(
                                                            (attribute) => (
                                                                <SelectItem
                                                                    key={
                                                                        attribute.id
                                                                    }
                                                                    value={String(
                                                                        attribute.id
                                                                    )}
                                                                >
                                                                    {
                                                                        attribute.name
                                                                    }
                                                                </SelectItem>
                                                            )
                                                        )}
                                                    </SelectContent>
                                                </Select>
                                                <InputError
                                                    message={
                                                        errorsAttachAttribute.attribute_id
                                                    }
                                                />
                                            </div>
                                            <DialogClose>
                                                <Button
                                                    type="submit"
                                                    className="w-full"
                                                >
                                                    Add
                                                </Button>
                                            </DialogClose>
                                        </div>
                                    </form>
                                </DialogContent>
                            </Dialog>
                            <MemoizedProductAttributeTable
                                attributes={product.attributes}
                                product_id={product.id}
                            />
                        </CardContent>
                    </Card>
                </TabsContent>
                <TabsContent value="inventory">
                    <Card>
                        <CardHeader>
                            <CardTitle>Inventory</CardTitle>
                            <CardDescription>Manage your product's inventory.</CardDescription>
                        </CardHeader>
                        <CardContent>
                            <Dialog>
                                <DialogTrigger asChild>
                                    <Button className="mb-4">
                                        <p>Add inventory</p>
                                        <PlusIcon size={20} />
                                    </Button>
                                </DialogTrigger>
                                <DialogContent>
                                    <DialogHeader>
                                        <DialogTitle>Add an inventory</DialogTitle>
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
                                                    onChange={(e) =>
                                                        setInventoryData(
                                                            "price",
                                                            Number(e.target.value)
                                                        )
                                                    }
                                                    required
                                                />
                                                <InputError message={errorsAddInventory.price}/>
                                            </div>

                                            <div className="grid gap-2">
                                                <Label htmlFor="old_price">Old Price</Label>
                                                <Input
                                                    id="old_price"
                                                    type="number"
                                                    placeholder="Old Price"
                                                    value={inventoryData.old_price}
                                                    onChange={(e) =>
                                                        setInventoryData(
                                                            "old_price",
                                                            Number(e.target.value)
                                                        )
                                                    }
                                                    required
                                                />
                                                <InputError message={errorsAddInventory.old_price}/>
                                            </div>

                                            <div className="grid gap-2">
                                                <Label htmlFor="quantity">Quantity</Label>
                                                <Input
                                                    id="quantity"
                                                    type="number"
                                                    placeholder="Quantity"
                                                    value={inventoryData.quantity}
                                                    onChange={(e) =>
                                                        setInventoryData(
                                                            "quantity",
                                                            Number(e.target.value)
                                                        )
                                                    }
                                                    required
                                                />
                                                <InputError message={errorsAddInventory.quantity}/>
                                            </div>

                                            {attributes_values.map((att) => (
                                                <div className="grid gap-2" key={att.id}>
                                                    <Label>{att.name}</Label>
                                                    <Select
                                                        onValueChange={(value) => {
                                                            const exists = inventoryData.values.some(
                                                                (item: Value) =>
                                                                    item.attribute_id === att.id
                                                            );
                                                            if (exists) {
                                                                const updatedValues = inventoryData.values.map(
                                                                    (item: Value) =>
                                                                        item.attribute_id ===
                                                                        att.id
                                                                            ? {...item, id: value}
                                                                            : item
                                                                );

                                                                setInventoryData("values", updatedValues);
                                                            } else {
                                                                setInventoryData("values", [
                                                                    ...inventoryData.values,
                                                                    {
                                                                        attribute_id: att.id,
                                                                        id: value,
                                                                    },
                                                                ]);
                                                            }
                                                        }}
                                                    >
                                                        <SelectTrigger>
                                                            <SelectValue placeholder="Select a value"/>
                                                        </SelectTrigger>
                                                        <SelectContent>
                                                            {att.values.map((v) => (
                                                                <SelectItem key={v.id} value={String(v.id)}>
                                                                    {v.value}
                                                                </SelectItem>
                                                            ))}
                                                        </SelectContent>
                                                    </Select>
                                                    <InputError
                                                        message={errorsAttachAttribute.attribute_id}
                                                    />
                                                </div>
                                            ))}

                                            <Button type="submit" className="w-full">
                                                Add
                                            </Button>
                                        </div>
                                    </form>
                                </DialogContent>
                            </Dialog>
                            <MemoizedInventoryTable
                                product_attributes={product.attributes}
                                inventories={product.inventories}
                                attributes_values={attributes_values}
                            />
                        </CardContent>
                    </Card>
                </TabsContent>

            </Tabs>
        </AuthenticatedLayout>
    );
}
