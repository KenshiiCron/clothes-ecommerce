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
    PlusCircleIcon, DollarSign, Check, Ellipsis, LucideCross, X, Package, Clock,
} from "lucide-react";

import {Button, buttonVariants} from "@/components/ui/button";
import {Checkbox} from "@/components/ui/checkbox";
import {
    DropdownMenu,
    DropdownMenuCheckboxItem,
    DropdownMenuContent,
    DropdownMenuItem,
    DropdownMenuLabel,
    DropdownMenuSeparator,
    DropdownMenuTrigger,
} from "@/components/ui/dropdown-menu";

import {Separator} from "@/components/ui/separator"

import {Input} from "@/components/ui/input";

import {
    Table,
    TableBody,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from "@/components/ui/table";

import {Switch} from "@/components/ui/switch";
import {Badge} from "@/components/ui/badge";
import {PageProps} from "@/types";
import {Link, useForm} from "@inertiajs/react";
import {
    AlertDialog, AlertDialogAction, AlertDialogCancel,
    AlertDialogContent, AlertDialogDescription, AlertDialogFooter,
    AlertDialogHeader,
    AlertDialogTitle,
    AlertDialogTrigger
} from "@/components/ui/alert-dialog";
import {CreateButton} from "@/components/elements/create-button";
import {Card, CardContent, CardHeader, CardTitle} from "@/components/ui/card";

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
    state: number;
    wilaya_id?: number | null;
    commune_id?: number | null;
    delivery_state: number;
    payment_method: number;
    payment_state: number;
};


export const columns: ColumnDef<Order>[] = [
    {
        id: "select",
        header: ({table}) => (
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
    {
        accessorKey: "order_number",
        header: ({column}) => {
            return (
                <Button
                    variant="ghost"
                    onClick={() =>
                        column.toggleSorting(column.getIsSorted() === "asc")
                    }
                >
                    Order Number
                    <ArrowUpDown className="ml-2 h-4 w-4"/>
                </Button>
            );
        },
        cell: ({row}) => <div>{row.getValue("order_number")}</div>,
    },
    {
        accessorKey: "name",
        header: "Name",
        cell: ({row}) => <div>{row.getValue("name")}</div>,
    },
    {
        accessorKey: "phone",
        header: "Phone",
        cell: ({row}) => (
            <div className="capitalize">
                {row.getValue("phone")}
            </div>
        ),
    },
    {
        accessorKey: "total_price",
        header: ({column}) => {
            return (
                <Button
                    variant="ghost"
                    onClick={() =>
                        column.toggleSorting(column.getIsSorted() === "asc")
                    }
                >
                    Total
                    <ArrowUpDown className="ml-2 h-4 w-4"/>
                </Button>
            );
        },
        cell: ({row}) => <Badge>{row.getValue("total_price")} DA</Badge>,
    },
    {
        accessorKey: "created_at",
        header: ({column}) => {
            return (
                <Button
                    variant="ghost"
                    onClick={() =>
                        column.toggleSorting(column.getIsSorted() === "asc")
                    }
                >
                    Created at
                    <ArrowUpDown className="ml-2 h-4 w-4"/>
                </Button>
            );
        },
        cell: ({row}) => (
            <div className="lowercase">
                {row.getValue("created_at")}
            </div>
        ),
    },
    {
        accessorKey: "state",
        header: "State",
        cell: ({row}) => (
            <div className="capitalize">
                {/* <Switch value={row.getValue("featured")} /> */}
                <Badge
                    // variant={
                    //     row.getValue("featured") == 0
                    //         ? "destructive"
                    //         : "secondary"
                    // }
                    className={`text-slate-950 ${row.getValue("state") == 0 ? "bg-yellow-400 hover:bg-yellow-400" : row.getValue("state") == 1 ? "bg-green-400 hover:bg-green-400" : "bg-red-400 hover:bg-red-400"}`}
                >
                    {
                        row.getValue("state") == 0 ? "Pending" : row.getValue("state") == 1 ? "Accepted" : row.getValue("state") == 2 ? "Cancelled" : "Rejected"
                    }
                </Badge>
            </div>
        ),
    },
    {
        id: "actions",
        enableHiding: false,
        cell: ({row}) => {
            const order = row.original;
            const {data, setData, delete: destroy, processing, errors, reset} = useForm({});


            return (
                <DropdownMenu>
                    <DropdownMenuTrigger asChild>
                        <Button variant="ghost" className="h-8 w-8 p-0">
                            <span className="sr-only">Open menu</span>
                            <MoreHorizontal className="h-4 w-4"/>
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
                            <AlertDialog>
                                <AlertDialogTrigger asChild>
                                    <div
                                        className="text-red-600 flex items-center gap-2 py-1 px-2 cursor-pointer rounded-sm"
                                    >
                                        <Trash size={16}></Trash>
                                        <p className="text-sm">Delete Order</p>
                                    </div>
                                </AlertDialogTrigger>

                                <AlertDialogContent>
                                    <AlertDialogHeader>
                                        <AlertDialogTitle>Delete Order {order.order_number}</AlertDialogTitle>
                                        <AlertDialogDescription>
                                            This action cannot be undone. This will permanently delete this order
                                        </AlertDialogDescription>
                                    </AlertDialogHeader>
                                    <AlertDialogFooter>
                                        <AlertDialogCancel>Cancel</AlertDialogCancel>
                                        <AlertDialogAction className={buttonVariants({variant: 'destructive'})}

                                                           onClick={() => {
                                                               destroy(route("admin.orders.destroy", order.id));
                                                           }}>
                                            <Trash size={16}></Trash>
                                            <p>Delete</p>
                                        </AlertDialogAction>
                                    </AlertDialogFooter>
                                </AlertDialogContent>
                            </AlertDialog>
                        </DropdownMenuItem>
                    </DropdownMenuContent>
                </DropdownMenu>
            );
        },
    },
];

interface OrdersTableProps {
    orders: Order[];
    totalOrders: number;
    totalPending: number;
    totalConfirmed: number;
    totalCancelled: number;
    totalRejected: number;
}

export default function OrdersTable({
                                        orders,
                                        totalOrders,
                                        totalPending,
                                        totalConfirmed,
                                        totalCancelled,
                                        totalRejected
                                    }: OrdersTableProps) {
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
                <CreateButton link="admin.orders.create"/>
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
            <div
                className="grid gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 xl:grid-cols-6 2xl:grid-cols-7 my-6">
                <Card className="border-primary bg-primary/10">
                    <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-2">
                        <CardTitle className="text-md font-medium">
                            Total Orders
                        </CardTitle>
                        <Package size={20}/>
                    </CardHeader>
                    <CardContent>
                        <div className="text-2xl font-bold">{totalOrders}</div>
                        {/*<p className="text-xs text-muted-foreground">*/}
                        {/*    +20.1% from last month*/}
                        {/*</p>*/}
                    </CardContent>
                </Card>
                <Card className="border-yellow-400 bg-yellow-400/10">
                    <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-2">
                        <CardTitle className="text-md font-medium">
                            Orders Pending
                        </CardTitle>
                        <Clock size={20}/>
                    </CardHeader>
                    <CardContent>
                        <div className="text-2xl font-bold">{totalPending}</div>
                        {/*<p className="text-xs text-muted-foreground">*/}
                        {/*    +20.1% from last month*/}
                        {/*</p>*/}
                    </CardContent>
                </Card>
                <Card className="border-green-400 bg-green-400/10">
                    <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-2">
                        <CardTitle className="text-md font-medium">
                            Orders Confirmed
                        </CardTitle>
                        <Check size={20}/>
                    </CardHeader>
                    <CardContent>
                        <div className="text-2xl font-bold">{totalConfirmed}</div>
                        {/*<p className="text-xs text-muted-foreground">*/}
                        {/*    +20.1% from last month*/}
                        {/*</p>*/}
                    </CardContent>
                </Card>
                <Card className="border-red-600 bg-red-600/10">
                    <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-2">
                        <CardTitle className="text-md font-medium">
                            Orders Cancelled
                        </CardTitle>
                        <X size={20}/>
                    </CardHeader>
                    <CardContent>
                        <div className="text-2xl font-bold">{totalCancelled}</div>
                        {/*<p className="text-xs text-muted-foreground">*/}
                        {/*    +20.1% from last month*/}
                        {/*</p>*/}
                    </CardContent>
                </Card>
                <Card className="border-red-600 bg-red-600/10">
                    <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-2">
                        <CardTitle className="text-md font-medium">
                            Orders Rejected
                        </CardTitle>
                        <Trash size={20}/>
                    </CardHeader>
                    <CardContent>
                        <div className="text-2xl font-bold">{totalRejected}</div>
                        {/*<p className="text-xs text-muted-foreground">*/}
                        {/*    +20.1% from last month*/}
                        {/*</p>*/}
                    </CardContent>
                </Card>
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
