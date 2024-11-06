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

import {
    ArrowUpDown,
    Trash, Eye,
    MoreHorizontal, Pencil,
    PlusCircleIcon,
} from "lucide-react";

import { Button } from "@/components/ui/button";
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

import { Separator } from "@/components/ui/separator"

import { Input } from "@/components/ui/input";

import {
    Table,
    TableBody,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from "@/components/ui/table";

import { Switch } from "@/components/ui/switch";
import { Badge } from "@/components/ui/badge";
import { PageProps } from "@/types";
import { Link } from "@inertiajs/react";

export type Order = {
    id: String
    user_id: number | null;
    order_number: string;
    name: string;
    address?: string;
    phone: string;
    email?: string | null;
    total_price: number;
    sub_total_price: number;
    shipping_price?: number | null;
    discount?: number | null;
    total_qty: number;
    state: string;
    wilaya_id?: number | null;
    commune_id?: number | null;
    delivery_state: number;
    payment_method: number;
    payment_state: number;
};


export const columns: ColumnDef<Order>[] = [
    {
        id: "select",
        header: ({ table }) => (
            <Checkbox
                checked={
                    table.getIsAllPageRowsSelected() ||
                    (table.getIsSomePageRowsSelected() && "indeterminate")
                }
                onCheckedChange={(value) =>
                    table.toggleAllPageRowsSelected(!!value)
                }
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
        accessorKey: "order_number",
        header: ({ column }) => {
            return (
                <Button
                    variant="ghost"
                    onClick={() =>
                        column.toggleSorting(column.getIsSorted() === "asc")
                    }
                >
                    Order Number
                    <ArrowUpDown className="ml-2 h-4 w-4" />
                </Button>
            );
        },
        cell: ({ row }) => <div>{row.getValue("order_number")}</div>,
    },
    {
        accessorKey: "name",
        header: ({ column }) => {
            return (
                <Button
                    variant="ghost"
                    onClick={() =>
                        column.toggleSorting(column.getIsSorted() === "asc")
                    }
                >
                    Name
                    <ArrowUpDown className="ml-2 h-4 w-4" />
                </Button>
            );
        },
        cell: ({ row }) => <div>{row.getValue("name")}</div>,
    },
    {
        accessorKey: "phone",
        header: ({ column }) => {
            return (
                <Button
                    variant="ghost"
                    onClick={() =>
                        column.toggleSorting(column.getIsSorted() === "asc")
                    }
                >
                    Phone
                    <ArrowUpDown className="ml-2 h-4 w-4" />
                </Button>
            );
        },
        cell: ({ row }) => <div>{row.getValue("phone")}</div>,
    },
    {
        accessorKey: "total_price",
        header: ({ column }) => {
            return (
                <Button
                    variant="ghost"
                    onClick={() =>
                        column.toggleSorting(column.getIsSorted() === "asc")
                    }
                >
                    Total
                    <ArrowUpDown className="ml-2 h-4 w-4" />
                </Button>
            );
        },
        cell: ({ row }) => <div>{row.getValue("total_price")}</div>,
    },
    {
        accessorKey: "created_at",
        header: ({ column }) => {
            return (
                <Button
                    variant="ghost"
                    onClick={() =>
                        column.toggleSorting(column.getIsSorted() === "asc")
                    }
                >
                    Created at
                    <ArrowUpDown className="ml-2 h-4 w-4" />
                </Button>
            );
        },
        cell: ({ row }) => (
            <div className="lowercase">
                {new Date(row.getValue("created_at"))
                    .toISOString()
                    .slice(0, 19)
                    .replace("T", " ")}
            </div>
        ),
    },
    {
        accessorKey: "state",
        header: "State",
        cell: ({ row }) => (
            <div className="capitalize">
                {/* <Switch value={row.getValue("featured")} /> */}
                <Badge
                    // variant={
                    //     row.getValue("featured") == 0
                    //         ? "destructive"
                    //         : "secondary"
                    // }
                    className={row.getValue("state") == 0 ? "bg-green-600/70 hover:bg-green-600/70" : "bg-red-600/70 hover:bg-red-600/70"}
                >
                    {row.getValue("state") == 0 ? "Accepted" : "Canceled"}
                </Badge>
            </div>
        ),
    },
    {
        id: "actions",
        enableHiding: false,
        cell: ({ row }) => {
            const order = row.original;

            return (
                <DropdownMenu>
                    <DropdownMenuTrigger asChild>
                        <Button variant="ghost" className="h-8 w-8 p-0">
                            <span className="sr-only">Open menu</span>
                            <MoreHorizontal className="h-4 w-4" />
                        </Button>
                    </DropdownMenuTrigger>
                    <DropdownMenuContent align="end">
                        <DropdownMenuLabel>Actions</DropdownMenuLabel>
                        {/*<DropdownMenuItem*/}
                        {/*    onClick={() => navigator.clipboard.writeText(payment.id)}*/}
                        {/*>*/}
                        {/*    Copy payment ID*/}
                        {/*</DropdownMenuItem>*/}
                        {/*<DropdownMenuSeparator />*/}
                        <DropdownMenuItem asChild>
                            <Link
                                href={route(
                                    "admin.orders.edit",
                                    order.id
                                )}
                            >
                                <Pencil></Pencil>
                                <p>Edit order</p>
                            </Link>
                        </DropdownMenuItem>
                        <DropdownMenuItem asChild>
                            <Link
                                href={route(
                                    "admin.orders.show",
                                    order.id
                                )}
                            >
                                <Eye></Eye>
                                <p>View order</p>
                            </Link>
                        </DropdownMenuItem>
                        <Separator className="my-1"/>
                        <DropdownMenuItem asChild>
                            <Link
                                href={route(
                                    "admin.orders.show",
                                    order.id
                                )}
                                className="text-red-600"
                            >
                                <Trash></Trash>
                                <p>Delete order</p>
                            </Link>
                        </DropdownMenuItem>
                    </DropdownMenuContent>
                </DropdownMenu>
            );
        },
    },
];

interface DataTableDemoProps {
    orders: Order[];
}

export default function DataTableDemo({ orders }: DataTableDemoProps) {
    const [sorting, setSorting] = React.useState<SortingState>([]);
    const [columnFilters, setColumnFilters] =
        React.useState<ColumnFiltersState>([]);
    const [columnVisibility, setColumnVisibility] =
        React.useState<VisibilityState>({});
    const [rowSelection, setRowSelection] = React.useState({});

    const table = useReactTable({
        data: orders,
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
            <div className="flex justify-between items-center py-4">
                <Button asChild>
                    <Link href={route("admin.orders.create")}>
                        <p>Create</p>
                        <PlusCircleIcon className="ml-2 h-4 w-4" />
                    </Link>
                </Button>
                <Input
                    placeholder="Filter orders..."
                    value={
                        (table.getColumn("name")?.getFilterValue() as string) ??
                        ""
                    }
                    onChange={(event) =>
                        table
                            .getColumn("name")
                            ?.setFilterValue(event.target.value)
                    }
                    className="max-w-sm"
                />
                {/*<DropdownMenu>*/}
                {/*    <DropdownMenuTrigger asChild>*/}
                {/*        <Button variant="outline" className="ml-auto">*/}
                {/*            Columns <ChevronDown className="ml-2 h-4 w-4" />*/}
                {/*        </Button>*/}
                {/*    </DropdownMenuTrigger>*/}
                {/*    <DropdownMenuContent align="end">*/}
                {/*        {table*/}
                {/*            .getAllColumns()*/}
                {/*            .filter((column) => column.getCanHide())*/}
                {/*            .map((column) => {*/}
                {/*                return (*/}
                {/*                    <DropdownMenuCheckboxItem*/}
                {/*                        key={column.id}*/}
                {/*                        className="capitalize"*/}
                {/*                        checked={column.getIsVisible()}*/}
                {/*                        onCheckedChange={(value) =>*/}
                {/*                            column.toggleVisibility(!!value)*/}
                {/*                        }*/}
                {/*                    >*/}
                {/*                        {column.id}*/}
                {/*                    </DropdownMenuCheckboxItem>*/}
                {/*                );*/}
                {/*            })}*/}
                {/*    </DropdownMenuContent>*/}
                {/*</DropdownMenu>*/}
            </div>
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
                                                    header.column.columnDef
                                                        .header,
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
                                    data-state={
                                        row.getIsSelected() && "selected"
                                    }
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
