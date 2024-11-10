import AuthenticatedLayout from "@/layouts/authenticated-layout";
import {Head, router, useForm} from "@inertiajs/react";
import {Label} from "@/components/ui/label";
import {Input} from "@/components/ui/input";
import {Button} from "@/components/ui/button";
import {InputError} from "@/components/ui/input-error";
import {Switch} from "@/components/ui/switch";
import {FormEventHandler, useState} from "react";
import {Textarea} from "@/components/ui/textarea";
import {Card, CardContent} from "@/components/ui/card";
import {Check, ChevronsUpDown, LinkIcon, PackageIcon, XIcon} from "lucide-react";
import {Separator} from "@/components/ui/separator";
import {RadioGroup, RadioGroupItem} from "@/components/ui/radio-group"
import {
    Command,
    CommandEmpty,
    CommandGroup,
    CommandInput,
    CommandItem,
    CommandList,
} from "@/components/ui/command"
import {
    Popover,
    PopoverContent,
    PopoverTrigger,
} from "@/components/ui/popover"
import {cn} from "@/lib/utils";

export default function Edit({products, carousel}: any) {
    const {data, setData, errors} = useForm({
        name: carousel.name,
        description: carousel.description,
        state: carousel.state,
        image: null,
        type: carousel.type,
        action: carousel.action ? carousel.action : "",
        product_id: carousel.product_id ? carousel.product_id : "",
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

    const [open, setOpen] = useState(false)
    const [productId, setProductId] = useState(carousel.product_id ? carousel.product_id : "")

    const [selectedOption, setSelectedOption] = useState(carousel.type.toString())


    const submit: FormEventHandler = (e) => {
        e.preventDefault();

        // post(route("admin.carousels.update", carousel.id));

        router.post(route("admin.carousels.update", carousel.id), {
            _method: "put",
            name: data.name,
            description: data.description,
            state: data.state,
            image: data.image,
            type: data.type,
            action: data.action,
            product_id: data.product_id,
        });
    };
    return (
        <AuthenticatedLayout header="Carousels">
            <Head title="Edit Carousel"/>

            <h2>Edit</h2>
            <form onSubmit={submit} className="max-w-md mt-6">
                <div className="grid gap-4">
                    <div className="grid gap-2">
                        <Label htmlFor="name">Name <span className="text-red-400">*</span></Label>
                        <Input
                            id="name"
                            type="text"
                            placeholder="Carousel name"
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
                            placeholder="Carousel description"
                            onChange={(e) =>
                                setData("description", e.target.value)
                            }
                            defaultValue={data.description}
                        ></Textarea>
                        <InputError message={errors.description}/>
                    </div>
                    <div className="grid gap-2">
                        <Label htmlFor="image">Image <span className="text-red-400">*</span></Label>
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
                                src={carousel.image_url}
                                alt="Selected image preview"
                                className="w-56 h-32 object-cover rounded"
                            />
                        )}
                        <InputError message={errors.image}/>
                    </div>
                    <div className="grid gap-2">
                        <div className="flex items-center space-x-3">
                            <Label htmlFor="state">State <span className="text-red-400">*</span></Label>
                            <Switch
                                id="state"
                                checked={data.state}
                                onCheckedChange={(e) => setData("state", e)}
                            />
                        </div>
                        <InputError message={errors.description}/>
                    </div>
                    <Separator className="my-4"/>
                    <div className="grid gap-2">
                        <Label>Action <span className="text-red-400">*</span></Label>
                        <RadioGroup onValueChange={(value) => {
                            setSelectedOption(value)
                            setData("type", value)
                        }} defaultValue={carousel.type.toString()}>
                            <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <Label
                                    htmlFor="0"
                                    className="cursor-pointer"
                                >
                                    <Card className={`h-full ${selectedOption === '0' && 'border-primary'}`}>
                                        <CardContent className="flex flex-col items-center justify-center p-6">
                                            <RadioGroupItem value="0" id="0" className="sr-only"/>
                                            <XIcon className="h-6 w-6 mb-2"/>
                                            <span className="text-sm font-medium">Nothing</span>
                                        </CardContent>
                                    </Card>
                                </Label>
                                <Label
                                    htmlFor="1"
                                    className="cursor-pointer"
                                >
                                    <Card className={`h-full ${selectedOption === '1' && 'border-primary'}`}>
                                        <CardContent className="flex flex-col items-center justify-center p-6">
                                            <RadioGroupItem value="1" id="1" className="sr-only"/>
                                            <PackageIcon className="h-6 w-6 mb-2"/>
                                            <span className="text-sm font-medium">Product</span>
                                        </CardContent>
                                    </Card>
                                </Label>
                                <Label
                                    htmlFor="2"
                                    className="cursor-pointer"
                                >
                                    <Card className={`h-full ${selectedOption === '2' && 'border-primary'}`}>
                                        <CardContent className="flex flex-col items-center justify-center p-6">
                                            <RadioGroupItem value="2" id="2" className="sr-only"/>
                                            <LinkIcon className="h-6 w-6 mb-2"/>
                                            <span className="text-sm font-medium">Link</span>
                                        </CardContent>
                                    </Card>
                                </Label>
                            </div>
                        </RadioGroup>
                        <div className="mt-6">
                            {selectedOption === '0' ?
                                (<p className="text-sm text-muted-foreground">No additional information
                                    required.</p>) : selectedOption === '1' ?
                                    (<div className="space-y-2">
                                        <Label htmlFor="productName">Product Name</Label>
                                        <Popover open={open} onOpenChange={setOpen}>
                                            <PopoverTrigger asChild>
                                                <Button
                                                    variant="outline"
                                                    role="combobox"
                                                    aria-expanded={open}
                                                    className="justify-between w-full"
                                                >
                                                    {productId
                                                        ? products.find((product: {
                                                            id: string;
                                                            name: string;
                                                        }) => product.id === productId)?.name
                                                        : "Select product..."}
                                                    <ChevronsUpDown className="ml-2 h-4 w-4 shrink-0 opacity-50"/>
                                                </Button>
                                            </PopoverTrigger>
                                            <PopoverContent className="w-full p-0">
                                                <Command>
                                                    <CommandInput placeholder="Search product..."/>
                                                    <CommandList>
                                                        <CommandEmpty>No product found.</CommandEmpty>
                                                        <CommandGroup>
                                                            {products.map((product: { id: string; name: string; }) => (
                                                                <CommandItem
                                                                    key={product.id}
                                                                    value={product.name}
                                                                    onSelect={() => {
                                                                        setProductId(product.id)
                                                                        setData("product_id", product.id)
                                                                        setOpen(false)
                                                                    }}
                                                                >
                                                                    <Check
                                                                        className={cn(
                                                                            "mr-2 h-4 w-4",
                                                                            productId === product.id ? "opacity-100" : "opacity-0"
                                                                        )}
                                                                    />
                                                                    {product.name}
                                                                </CommandItem>
                                                            ))}
                                                        </CommandGroup>
                                                    </CommandList>
                                                </Command>
                                            </PopoverContent>
                                        </Popover>
                                    </div>) : (<div className="space-y-2">
                                        <Label htmlFor="action">Link URL</Label>
                                        <Input id="action" type="url" placeholder="Enter URL"
                                               value={data.action}
                                               onChange={(e) => setData("action", e.target.value)}/>
                                    </div>)}
                        </div>

                    </div>
                    <Button type="submit" className="w-full mt-4">
                        Update
                    </Button>
                </div>
            </form>
        </AuthenticatedLayout>
    );
}
