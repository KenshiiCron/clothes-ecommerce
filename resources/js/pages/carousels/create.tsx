import AuthenticatedLayout from "@/layouts/authenticated-layout";
import {Head, useForm} from "@inertiajs/react";
import {Label} from "@/components/ui/label";
import {Input} from "@/components/ui/input";
import {Button} from "@/components/ui/button";
import {InputError} from "@/components/ui/input-error";
import {Switch} from "@/components/ui/switch";
import {FormEventHandler, JSXElementConstructor, Key, ReactElement, ReactNode, ReactPortal, useState} from "react";
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
import {Product} from "@/components/tables/products-table";


export default function Create({products}: any) {
    const {data, setData, post, processing, errors, reset} = useForm({
        name: "",
        description: "",
        state: true,
        image: null,
        action: "",
        product_id: "",
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

    const [open, setOpen] = useState(false)
    const [productId, setProductId] = useState("")

    const [selectedOption, setSelectedOption] = useState('nothing')


    const submit: FormEventHandler = (e) => {
        e.preventDefault();

        post(route("admin.carousels.store"));
    };
    return (
        <AuthenticatedLayout header="Carousels">
            <Head title="Create Carousel"/>

            <h2>Create</h2>
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
                            value={data.description}
                            onChange={(e) =>
                                setData("description", e.target.value)
                            }
                        />
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
                            required
                        />
                        {preview && (
                            <img
                                src={preview}
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
                        <RadioGroup onValueChange={setSelectedOption} defaultValue="nothing">
                            <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <Label
                                    htmlFor="nothing"
                                    className="cursor-pointer"
                                    onClick={() => {setData("action", ""); setData("product_id", "")}}
                                >
                                    <Card className={`h-full ${selectedOption === 'nothing' && 'border-primary'}`}>
                                        <CardContent className="flex flex-col items-center justify-center p-6">
                                            <RadioGroupItem value="nothing" id="nothing" className="sr-only"/>
                                            <XIcon className="h-6 w-6 mb-2"/>
                                            <span className="text-sm font-medium">Nothing</span>
                                        </CardContent>
                                    </Card>
                                </Label>
                                <Label
                                    htmlFor="product"
                                    className="cursor-pointer"
                                    onClick={() => {setData("action", ""); setData("product_id", "")}}
                                >
                                    <Card className={`h-full ${selectedOption === 'product' && 'border-primary'}`}>
                                        <CardContent className="flex flex-col items-center justify-center p-6">
                                            <RadioGroupItem value="product" id="product" className="sr-only"/>
                                            <PackageIcon className="h-6 w-6 mb-2"/>
                                            <span className="text-sm font-medium">Product</span>
                                        </CardContent>
                                    </Card>
                                </Label>
                                <Label
                                    htmlFor="link"
                                    className="cursor-pointer"
                                    onClick={() => {setData("action", ""); setData("product_id", "")}}
                                >
                                    <Card className={`h-full ${selectedOption === 'link' && 'border-primary'}`} >
                                        <CardContent className="flex flex-col items-center justify-center p-6">
                                            <RadioGroupItem value="link" id="link" className="sr-only"/>
                                            <LinkIcon className="h-6 w-6 mb-2"/>
                                            <span className="text-sm font-medium">Link</span>
                                        </CardContent>
                                    </Card>
                                </Label>
                            </div>
                        </RadioGroup>
                        <div className="mt-6">
                            {selectedOption === 'nothing' ?
                                (<p className="text-sm text-muted-foreground">No additional information
                                    required.</p>) : selectedOption === 'product' ?
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
                                                        ? products.find((product: { id: string; name: string; }) => product.id === productId)?.label
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
                        Create
                    </Button>
                </div>
            </form>
        </AuthenticatedLayout>
    );
}
