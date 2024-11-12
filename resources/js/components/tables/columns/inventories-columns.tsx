import { ColumnDef } from "@tanstack/react-table";
import { Checkbox } from "@/components/ui/checkbox";
import { Button, buttonVariants } from "@/components/ui/button";
import { ArrowUpDown, Eye, MoreHorizontal, Pencil, Trash } from "lucide-react";
import * as React from "react";
import { Link, useForm } from "@inertiajs/react";

export type Attribute = {
    id: string;
    name: string;
};

export type Product = {
    id: string;
    name: string;
};

export type Value = {
    id: string;
    value: string;
    attribute_id: string
};

export type Inventory = {
    id: string;
    product_id: string;
    quantity: number;
    price: number;
    created_at: string
};

interface InventoryRow {
    product_attributes: Attribute[],
    inventory: Inventory

}

let setColumns;

export default setColumns = (product_attributes: Attribute[]): ColumnDef<InventoryRow>[] => {
    // @ts-ignore

    const columns: ColumnDef<InventoryRow>[] = [

        {
            id: "select",
            header: ({ table }) => (
                <Checkbox
                    checked={
                        table.getIsAllPageRowsSelected() ||
                        (table.getIsSomePageRowsSelected() && "indeterminate")
                    }
                    onCheckedChange={(value) => table.toggleAllPageRowsSelected(!!value)}
                    aria-label="Select all"
                />
            ),
            cell: ({ row }) => (
                <Checkbox
                    checked={row.getIsSelected()}
                    onCheckedChange={(value) => row.toggleSelected(!!value)}
                    aria-label="Select row"
                />
            ),
            enableSorting: false,
            enableHiding: false,
        },
        // Dynamically generated columns for each attribute in attributes_values
        ...product_attributes.map((att: Attribute) => ({
            accessorKey: att.name,
            header: ({ column }) => (
                <Button
                    variant="ghost"
                    onClick={() => column.toggleSorting(column.getIsSorted() === "asc")}
                >
                    {att.name}
                    <ArrowUpDown className="ml-2 h-4 w-4" />
                </Button>
            ),
            cell: ({ row }) => {

                const attributeValues = row.original.inventory.attribute_values.filter(
                    (v:Value) => v.attribute_id === att.id
                );
                console.log(attributeValues)
                return (
                    <div>
                        <div>{attributeValues[0]?.value}</div>
                    </div>
                );
            },
        })),
        {
            accessorKey: "price",
            header: ({ column }) => {
                return (
                    <Button
                        variant="ghost"
                        onClick={() => column.toggleSorting(column.getIsSorted() === "asc")}
                    >
                        Price
                        <ArrowUpDown className="ml-2 h-4 w-4" />
                    </Button>
                );
            },
            cell: ({ row }) => <div className="lowercase">{row.getValue("price")}</div>,
            accessorFn: row => row.inventory.price,
        },
        {
            accessorKey: "quantity",
            header: ({ column }) => {
                return (
                    <Button
                        variant="ghost"
                        onClick={() => column.toggleSorting(column.getIsSorted() === "asc")}
                    >
                        Quantity
                        <ArrowUpDown className="ml-2 h-4 w-4" />
                    </Button>
                );
            },
            cell: ({ row }) => <div className="lowercase">{row.getValue("quantity")}</div>,
            accessorFn: row => row.inventory.quantity,
        },
        {
            id: "actions",
            enableHiding: false,
            cell: ({ row }) => {
                const product = row.original.inventory;
                const { data, setData, delete: destroy, processing, errors, reset } = useForm({});

            },
        },
    ];

    return columns;
};
