import {ColumnDef} from "@tanstack/react-table";
import {Checkbox} from "@/components/ui/checkbox";
import {Button, buttonVariants} from "@/components/ui/button";
import {ArrowUpDown, MoreHorizontal, Pencil, Trash} from "lucide-react";
import * as React from "react";
import {FormEventHandler} from "react";
import {useForm} from "@inertiajs/react";
import {Dialog, DialogClose, DialogContent, DialogHeader, DialogTitle, DialogTrigger} from "@/components/ui/dialog";
import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuItem,
    DropdownMenuLabel,
    DropdownMenuSeparator,
    DropdownMenuTrigger
} from "@/components/ui/dropdown-menu";
import {
    AlertDialog,
    AlertDialogAction,
    AlertDialogCancel,
    AlertDialogContent,
    AlertDialogDescription,
    AlertDialogFooter,
    AlertDialogHeader,
    AlertDialogTitle,
    AlertDialogTrigger
} from "@/components/ui/alert-dialog";
import {Label} from "@/components/ui/label";
import {Input} from "@/components/ui/input";
import {InputError} from "@/components/ui/input-error";
import {Select, SelectContent, SelectItem, SelectTrigger, SelectValue} from "@/components/ui/select";

import {Attribute, AttributesValues, Inventory, Value} from "@/pages/products/edit";

export type Product = {
    id: string;
    name: string;
};

interface InventoryRow {
    product_attributes: Attribute[],
    attributes_values: AttributesValues[],
    inventory: Inventory
}

let setColumns;

export default setColumns = (product_attributes: Attribute[], attributes_values: AttributesValues[]): ColumnDef<InventoryRow>[] => {
    // @ts-ignore

    const attributes_array = Object.values(product_attributes);

    return [
        {
            id: "select",
            header: ({table}) => (
                <Checkbox
                    checked={
                        table.getIsAllPageRowsSelected() ||
                        (table.getIsSomePageRowsSelected() && "indeterminate")
                    }
                    onCheckedChange={(value) => table.toggleAllPageRowsSelected(!!value)}
                    aria-label="Select all"
                />
            ),
            cell: ({row}) => (
                <Checkbox
                    checked={row.getIsSelected()}
                    onCheckedChange={(value) => row.toggleSelected(!!value)}
                    aria-label="Select row"
                />
            ),
            enableSorting: false,
            enableHiding: false,
        },
        ...attributes_array.map((att: Attribute) => ({
            accessorKey: att.name,
            header: att.name,


            cell: ({row}: any) => {

                const attributeValues = row.original.inventory.attribute_values.find(
                    (v: Value) => v.attribute_id === att.id
                );
                return (
                    <div>
                        <div>{attributeValues?.value ? attributeValues?.value : '/'}</div>
                    </div>
                );
            },
        })),
        {
            accessorKey: "price",
            header: ({column}) => {
                return (
                    <Button
                        variant="ghost"
                        onClick={() => column.toggleSorting(column.getIsSorted() === "asc")}
                    >
                        Price
                        <ArrowUpDown className="ml-2 h-4 w-4"/>
                    </Button>
                );
            },
            cell: ({row}) => <div className="lowercase">{row.getValue("price")}</div>,
            accessorFn: row => row.inventory.price,
        },
        {
            accessorKey: "quantity",
            header: ({column}) => {
                return (
                    <Button
                        variant="ghost"
                        onClick={() => column.toggleSorting(column.getIsSorted() === "asc")}
                    >
                        Quantity
                        <ArrowUpDown className="ml-2 h-4 w-4"/>
                    </Button>
                );
            },
            cell: ({row}) => <div className="lowercase">{row.getValue("quantity")}</div>,
            accessorFn: row => row.inventory.quantity,
        },
        {
            id: "actions",
            enableHiding: false,
            cell: ({row}) => {
                const inventory = row.original.inventory;
                const {delete: destroy} = useForm({});
                const {
                    data: editInventoryData,
                    setData: setEditInventoryData,
                    put: submitEditInventory,
                    processing: processingEditInventory,
                    errors: errorsEditInventory,
                    reset: resetEditInventory,
                } = useForm({
                    quantity: inventory.quantity,
                    price: inventory.price,
                    values: inventory.attribute_values as Value[]
                });
                const EditInventory: FormEventHandler = (e) => {
                    e.preventDefault();
                    submitEditInventory(route("admin.inventories.update", inventory.id));
                };
                return (
                    <Dialog>
                        <DropdownMenu>
                            <DropdownMenuTrigger>
                                <Button variant="ghost" className="h-8 w-8 p-0">
                                    <span className="sr-only">Open menu</span>
                                    <MoreHorizontal className="h-4 w-4"/>
                                </Button>
                            </DropdownMenuTrigger>
                            <DropdownMenuContent align="end">
                                <DropdownMenuLabel>Actions</DropdownMenuLabel>
                                <DropdownMenuSeparator/>
                                <DropdownMenuItem asChild>
                                    <DialogTrigger asChild>
                                        <div className="flex items-center gap-2 py-1 px-2">
                                            <Pencil/>
                                            <p>Edit inventory</p>
                                        </div>
                                    </DialogTrigger>
                                </DropdownMenuItem>
                                <DropdownMenuSeparator/>
                                <AlertDialog>
                                    <AlertDialogTrigger asChild>
                                        <div
                                            className="text-red-600  flex items-center gap-2 py-1 px-2 cursor-default hover:bg-slate-800 rounded-sm"
                                        >
                                            <Trash size={16}></Trash>
                                            <p>Delete Inventory</p>
                                        </div>
                                    </AlertDialogTrigger>
                                    <AlertDialogContent>
                                        <AlertDialogHeader>
                                            <AlertDialogTitle>Delete this inventory</AlertDialogTitle>
                                            <AlertDialogDescription>
                                                This action cannot be undone. This will permanently delete this
                                                inventory form this product.
                                            </AlertDialogDescription>
                                        </AlertDialogHeader>
                                        <AlertDialogFooter>
                                            <AlertDialogCancel>Cancel</AlertDialogCancel>
                                            <AlertDialogAction className={buttonVariants({variant: 'destructive'})}
                                                               onClick={(e) => {
                                                                   // @ts-ignore
                                                                   destroy(route('admin.inventories.destroy', inventory.id))
                                                               }}>
                                                <Trash size={16}></Trash>
                                                <p>Delete</p>
                                            </AlertDialogAction>
                                        </AlertDialogFooter>
                                    </AlertDialogContent>
                                </AlertDialog>
                            </DropdownMenuContent>
                        </DropdownMenu>
                        <DialogContent>
                            <DialogHeader>
                                <DialogTitle>
                                    Edit this inventory
                                </DialogTitle>
                            </DialogHeader>
                            <form onSubmit={EditInventory} className="max-w-md mt-6">
                                <div className="grid gap-4">
                                    <div className="grid gap-2">
                                        <Label htmlFor="price">Price</Label>
                                        <Input
                                            id="price"
                                            type="number"
                                            placeholder="Price"
                                            value={editInventoryData.price}
                                            onChange={(e) => setEditInventoryData("price", Number(e.target.value))}
                                            required
                                        />
                                        <InputError message={errorsEditInventory.price}/>
                                    </div>

                                    <div className="grid gap-2">
                                        <Label htmlFor="quantity">Quantity</Label>
                                        <Input
                                            id="quantity"
                                            type="number"
                                            placeholder="Quantity"
                                            value={editInventoryData.quantity}
                                            onChange={(e) => setEditInventoryData("quantity", Number(e.target.value))}
                                            required
                                        />
                                        <InputError message={errorsEditInventory.quantity}/>
                                    </div>
                                    {
                                        attributes_values.map((att) => {
                                            return (
                                                <div className="grid gap-2">
                                                    <Label>{att.name}</Label>
                                                    <Select
                                                        onValueChange={(value) => {
                                                            const exists = editInventoryData.values.some((item: Value) => item.attribute_id == att.id);
                                                            if (exists) {
                                                                const updatedValues = editInventoryData.values.map((item: Value) =>
                                                                    item.attribute_id == att.id
                                                                        ? {...item, id: value}
                                                                        : item
                                                                );

                                                                setEditInventoryData('values', updatedValues);
                                                            } else {
                                                                setEditInventoryData('values', [
                                                                    ...editInventoryData.values,
                                                                    {
                                                                        attribute_id: att.id,
                                                                        id: value
                                                                    }
                                                                ]);
                                                            }
                                                        }}
                                                    >
                                                        <SelectTrigger>
                                                            <SelectValue
                                                                placeholder={editInventoryData.values.find((v: Value) => v.attribute_id == att.id)?.value}/>
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
                                                </div>
                                            )
                                        })
                                    }
                                    <DialogClose>
                                        <Button type="submit" className="w-full">
                                            Edit
                                        </Button>
                                    </DialogClose>
                                </div>
                            </form>
                        </DialogContent>
                    </Dialog>


                );

            },
        },
    ];
};
