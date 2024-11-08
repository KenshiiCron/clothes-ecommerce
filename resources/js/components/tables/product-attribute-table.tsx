import * as React from "react";
import {
    ColumnDef,
    ColumnFiltersState,
    SortingState,
    VisibilityState,
    flexRender,
    getCoreRowModel,
    getFilteredRowModel,
    getPaginationRowModel,
    getSortedRowModel,
    useReactTable,
} from "@tanstack/react-table";
import {ArrowUpDown, ChevronDown, Eye, MoreHorizontal, PlusCircleIcon, Trash} from "lucide-react";

import {Button, buttonVariants} from "@/components/ui/button";
import { Checkbox } from "@/components/ui/checkbox";
import {
    DropdownMenu,
    DropdownMenuCheckboxItem,
    DropdownMenuContent,
    DropdownMenuItem,
    DropdownMenuLabel,
    DropdownMenuSeparator,
    DropdownMenuTrigger,
} from "@/components/ui/dropdown-menu";
import { Input } from "@/components/ui/input";
import {
    Table,
    TableBody,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from "@/components/ui/table";
import {
    AlertDialog,
    AlertDialogAction,
    AlertDialogCancel,
    AlertDialogContent,
    AlertDialogDescription,
    AlertDialogFooter,
    AlertDialogHeader,
    AlertDialogTitle,
    AlertDialogTrigger,
} from "@/components/ui/alert-dialog";
import {Link, useForm} from "@inertiajs/react";
import {Dialog, DialogClose, DialogContent, DialogHeader, DialogTitle, DialogTrigger} from "@/components/ui/dialog";
import {FormEventHandler} from "react";
import {CreateButton} from "@/components/elements/create-button";

export type Attribute = {
    id: string;
    name: string;
};


export type Product = {
    id: string;
    name: string;
}

interface CombinedRow {
    attribute: Attribute;
    product: Product;
}


// @ts-ignore
export const columns: ColumnDef<CombinedRow>[] = [
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

    {
        accessorKey: "name",
        header: ({ column }) => {
            return (
                <Button
                    variant="ghost"
                    onClick={() => column.toggleSorting(column.getIsSorted() === "asc")}
                >
                    Name
                    <ArrowUpDown className="ml-2 h-4 w-4" />
                </Button>
            );
        },
        cell: ({ row }) => <div className="lowercase">{row.getValue("name")}</div>,
        accessorFn: row => row.attribute.name,
    },
    {
        id: "actions",
        enableHiding: false,
        cell: ({ row }) => {
            const { attribute, product } = row.original;
            const {
                data: addAttributeData,
                setData: setAddAttributeData,
                post: submitAddAttribute,
                processing: processingAddAttribute,
                errors: errorsAddAttribute,
                reset: resetAddAttribute
            } = useForm({
                product_id: product.id,
            })
            const addAttribute: FormEventHandler = (e) => {
                e.preventDefault();
                submitAddAttribute(route("admin.attribute-values.update",attribute.id));
            };

            // @ts-ignore
            return (<>
                    <Dialog>
                        <DropdownMenu>
                            <DropdownMenuTrigger>
                                <Button variant="ghost" className="h-8 w-8 p-0">
                                    <span className="sr-only">Open menu</span>
                                    <MoreHorizontal className="h-4 w-4" />
                                </Button>
                            </DropdownMenuTrigger>
                            <DropdownMenuContent align="end">
                                <DropdownMenuLabel>Actions</DropdownMenuLabel>
                                <DropdownMenuSeparator/>
                                <AlertDialog>
                                    <AlertDialogTrigger asChild>
                                        <div
                                            className="text-red-600  flex items-center gap-2 py-1 px-2 cursor-default hover:bg-slate-800 rounded-sm"
                                        >
                                            <Trash size={16}></Trash>
                                            <p>Delete Attribute</p>
                                        </div>
                                    </AlertDialogTrigger>
                                    <AlertDialogContent>
                                        <AlertDialogHeader>
                                            <AlertDialogTitle>Delete {attribute.name}</AlertDialogTitle>
                                            <AlertDialogDescription>
                                                This action cannot be undone. This will permanently delete this attribute form this product.
                                            </AlertDialogDescription>
                                        </AlertDialogHeader>
                                        <AlertDialogFooter>
                                            <AlertDialogCancel>Cancel</AlertDialogCancel>
                                            <AlertDialogAction className={buttonVariants({variant: 'destructive'})}
                                                               onClick={(e) => {
                                                                   addAttribute(e);
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
                                    Add attribute to this product
                                </DialogTitle>
                            </DialogHeader>
                            <form onSubmit={addAttribute} className="max-w-md mt-6">
                                <div className="grid gap-4">
                                    <DialogClose>
                                        <Button type="submit" className="w-full">
                                            Add
                                        </Button>
                                    </DialogClose>
                                </div>
                            </form>
                        </DialogContent>
                    </Dialog>

                </>

            );
        },
    },
];

interface DataTableDemoProps {
    attributes: Attribute[];
    product : Product;
}

export default function DataTableDemo({ attributes,product }: DataTableDemoProps) {
    const [sorting, setSorting] = React.useState<SortingState>([]);
    const [columnFilters, setColumnFilters] = React.useState<ColumnFiltersState>([]);
    const [columnVisibility, setColumnVisibility] = React.useState<VisibilityState>({});
    const [rowSelection, setRowSelection] = React.useState({});

    const data: CombinedRow[] = attributes.map(attribute => ({
        attribute,
        product,
    }));
    const table = useReactTable({
        data: data,
        columns,
        onSortingChange: setSorting,
        onColumnFiltersChange: setColumnFilters,
        getCoreRowModel: getCoreRowModel(),
        getPaginationRowModel: getPaginationRowModel(),
        getSortedRowModel: getSortedRowModel(),
        getFilteredRowModel: getFilteredRowModel(),
        onColumnVisibilityChange: setColumnVisibility,
        onRowSelectionChange: setRowSelection,
        state: {
            sorting,
            columnFilters,
            columnVisibility,
            rowSelection,
        },
    });


    return (
        <div className="w-full">
            <div className="rounded-md border">
                <Table>
                    <TableHeader>
                        {table.getHeaderGroups().map((headerGroup) => (
                            <TableRow key={headerGroup.id}>
                                {headerGroup.headers.map((header) => {
                                    return (
                                        <TableHead key={header.id}>
                                            {header.isPlaceholder
                                                ? null
                                                : flexRender(
                                                    header.column.columnDef.header,
                                                    header.getContext()
                                                )}
                                        </TableHead>
                                    );
                                })}
                            </TableRow>
                        ))}
                    </TableHeader>
                    <TableBody>
                        {table.getRowModel().rows?.length ? (
                            table.getRowModel().rows.map((row) => (
                                <TableRow
                                    key={row.id}
                                    data-state={row.getIsSelected() && "selected"}
                                >
                                    {row.getVisibleCells().map((cell) => (
                                        <TableCell key={cell.id}>
                                            {flexRender(
                                                cell.column.columnDef.cell,
                                                cell.getContext()
                                            )}
                                        </TableCell>
                                    ))}
                                </TableRow>
                            ))
                        ) : (
                            <TableRow>
                                <TableCell
                                    colSpan={columns.length}
                                    className="h-24 text-center"
                                >
                                    No results.
                                </TableCell>
                            </TableRow>
                        )}
                    </TableBody>
                </Table>
            </div>
            <div className="flex items-center justify-end space-x-2 py-4">
                <div className="flex-1 text-sm text-muted-foreground">
                    {table.getFilteredSelectedRowModel().rows.length} of{" "}
                    {table.getFilteredRowModel().rows.length} row(s) selected.
                </div>
                <div className="space-x-2">
                    <Button
                        variant="outline"
                        size="sm"
                        onClick={() => table.previousPage()}
                        disabled={!table.getCanPreviousPage()}
                    >
                        Previous
                    </Button>
                    <Button
                        variant="outline"
                        size="sm"
                        onClick={() => table.nextPage()}
                        disabled={!table.getCanNextPage()}
                    >
                        Next
                    </Button>
                </div>
            </div>
        </div>
    );
}
