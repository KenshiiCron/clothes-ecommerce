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
    MoreHorizontal,
    Pencil,
} from "lucide-react";

import {Button, buttonVariants} from "@/components/ui/button";
import {Checkbox} from "@/components/ui/checkbox";
import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuItem,
    DropdownMenuLabel,
    DropdownMenuSeparator,
    DropdownMenuTrigger,
} from "@/components/ui/dropdown-menu";
import {
    AlertDialog,
    AlertDialogTrigger,
    AlertDialogContent,
    AlertDialogHeader,
    AlertDialogFooter,
    AlertDialogTitle,
    AlertDialogDescription,
    AlertDialogCancel,
    AlertDialogAction,
} from "@/components/ui/alert-dialog";

import {Input} from "@/components/ui/input";

import {
    Table,
    TableBody,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from "@/components/ui/table";

import {Badge} from "@/components/ui/badge";
import {Link, useForm} from "@inertiajs/react";
import {CreateButton} from "@/components/elements/create-button";
import Brand from "@/types/brand";
import {__, trans_choice} from "@/helpers/localization-helper";



/*export const columns: ColumnDef<Brand>[] = [
    {
        id: __('actions.select'),
        header: ({table}) => (
            <Checkbox
                checked={
                    table.getIsAllPageRowsSelected() ||
                    (table.getIsSomePageRowsSelected() && "indeterminate")
                }
                onCheckedChange={(value) =>
                    table.toggleAllPageRowsSelected(!!value)
                }
                aria-label={`${__('actions.select')}`}
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
        accessorKey: "image_url",
        header: "Image",
        cell: ({row}) => (
            <div className="p-2">
                <img
                    src={row.getValue("image_url")}
                    alt="image"
                    className="w-14 h-14 rounded-md object-cover"
                />
            </div>
        ),
    },
    {
        accessorKey: "name",
        header: ({column}) => {
            return (
                <Button
                    variant="ghost"
                    onClick={() =>
                        column.toggleSorting(column.getIsSorted() === "asc")
                    }
                >
                    Name
                    <ArrowUpDown className="ml-2 h-4 w-4"/>
                </Button>
            );
        },
        cell: ({row}) => <div>{row.getValue("name")}</div>,
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
                {new Date(row.getValue("created_at"))
                    .toISOString()
                    .slice(0, 19)
                    .replace("T", " ")}
            </div>
        ),
    },
    {
        accessorKey: "featured",
        header: "Featured",
        cell: ({row}) => (
            <div className="capitalize">
                {/!* <Switch value={row.getValue("featured")} /> *!/}
                <Badge
                    variant={
                        row.getValue("featured") == 0
                            ? "destructive"
                            : "secondary"
                    }
                >
                    {row.getValue("featured") == 0 ? "No" : "Yes"}
                </Badge>
            </div>
        ),
    },
    {
        id: "actions",
        enableHiding: false,
        cell: ({row}) => {
            const brand = row.original;
            const {delete: destroy} = useForm({});

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
                        <DropdownMenuItem asChild>
                            <Link href={route("admin.brands.edit", brand.id)}>
                                <Pencil/>
                                <p>Edit brand</p>
                            </Link>
                        </DropdownMenuItem>
                        <DropdownMenuItem asChild>
                            <Link href={route("admin.brands.show", brand.id)}>
                                <Eye/>
                                <p>View brand</p>
                            </Link>
                        </DropdownMenuItem>
                        <DropdownMenuSeparator/>
                        <DropdownMenuItem asChild>
                            <AlertDialog>
                                <AlertDialogTrigger asChild>
                                    <div
                                        className="text-red-600 flex items-center gap-2 py-1 px-2 cursor-pointer rounded-sm"
                                    >
                                        <Trash size={16}></Trash>
                                        <p className="text-sm font-medium">Delete brand</p>
                                    </div>
                                </AlertDialogTrigger>

                                <AlertDialogContent>
                                    <AlertDialogHeader>
                                        <AlertDialogTitle>Delete {brand.name}</AlertDialogTitle>
                                        <AlertDialogDescription>
                                            This action cannot be undone. This will permanently delete this brand,
                                            products
                                            and orders will not be deleted.
                                        </AlertDialogDescription>
                                    </AlertDialogHeader>
                                    <AlertDialogFooter>
                                        <AlertDialogCancel>Cancel</AlertDialogCancel>
                                        <AlertDialogAction className={buttonVariants({variant: 'destructive'})}
                                                           onClick={() => {
                                                               destroy(route("admin.brands.destroy", brand.id));
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
];*/

interface BrandTableProps {
    brands: Brand[];
}

export default function BrandTable({brands}: BrandTableProps) {

    const columns: ColumnDef<Brand>[] = [
        {
            id: __('actions.select'),
            header: ({table}) => (
                <Checkbox
                    checked={
                        table.getIsAllPageRowsSelected() ||
                        (table.getIsSomePageRowsSelected() && "indeterminate")
                    }
                    onCheckedChange={(value) =>
                        table.toggleAllPageRowsSelected(!!value)
                    }
                    aria-label={__('actions.select_all')}
                />
            ),
            cell: ({row}) => (
                <Checkbox
                    checked={row.getIsSelected()}
                    onCheckedChange={(value) => row.toggleSelected(!!value)}
                    aria-label={__('actions.select_row')}
                />
            ),
            enableSorting: false,
            enableHiding: false,
        },
        {
            accessorKey: "image_url",
            header: __('labels.fields.image'),
            cell: ({row}) => (
                <div className="p-2">
                    <img
                        src={row.getValue("image_url")}
                        alt="image"
                        className="w-14 h-14 rounded-md object-cover"
                    />
                </div>
            ),
        },
        {
            accessorKey: "name",
            header: ({column}) => {
                return (
                    <Button
                        variant="ghost"
                        onClick={() =>
                            column.toggleSorting(column.getIsSorted() === "asc")
                        }
                    >
                        {__('labels.fields.name')}
                        <ArrowUpDown className="ml-2 h-4 w-4"/>
                    </Button>
                );
            },
            cell: ({row}) => <div>{row.getValue("name")}</div>,
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
                        {__('labels.fields.created_at')}
                        <ArrowUpDown className="ml-2 h-4 w-4"/>
                    </Button>
                );
            },
            cell: ({row}) => (
                <div className="lowercase">
                    {new Date(row.getValue("created_at"))
                        .toISOString()
                        .slice(0, 19)
                        .replace("T", " ")}
                </div>
            ),
        },
        {
            accessorKey: "featured",
            header: __("labels.fields.featured"),
            cell: ({row}) => (
                <div className="capitalize">
                    {/* <Switch value={row.getValue("featured")} /> */}
                    <Badge
                        variant={
                            row.getValue("featured") == 0
                                ? "destructive"
                                : "secondary"
                        }
                    >
                        {row.getValue("featured") == 0 ? __("static.words.no") : __("static.words.yes")}
                    </Badge>
                </div>
            ),
        },
        {
            id: "actions",
            enableHiding: false,
            cell: ({row}) => {
                const brand = row.original;
                const {delete: destroy} = useForm({});

                return (
                    <DropdownMenu>
                        <DropdownMenuTrigger asChild>
                            <Button variant="ghost" className="h-8 w-8 p-0">
                                <span className="sr-only">Open menu</span>
                                <MoreHorizontal className="h-4 w-4"/>
                            </Button>
                        </DropdownMenuTrigger>
                        <DropdownMenuContent align="end">
                            <DropdownMenuLabel>{trans_choice('labels.fields.action', 2)}</DropdownMenuLabel>
                            <DropdownMenuItem asChild>
                                <Link href={route("admin.brands.edit", brand.id)}>
                                    <Pencil/>
                                    <p>{__('actions.edit')} {trans_choice('labels.models.brand', 1).toLowerCase()}</p>
                                </Link>
                            </DropdownMenuItem>
                            <DropdownMenuItem asChild>
                                <Link href={route("admin.brands.show", brand.id)}>
                                    <Eye/>
                                    <p>{__('actions.view')} {trans_choice('labels.models.brand', 1).toLowerCase()}</p>
                                </Link>
                            </DropdownMenuItem>
                            <DropdownMenuSeparator/>
                            <DropdownMenuItem asChild>
                                <AlertDialog>
                                    <AlertDialogTrigger asChild>
                                        <div
                                            className="text-red-600 flex items-center gap-2 py-1 px-2 cursor-pointer rounded-sm"
                                        >
                                            <Trash size={16}></Trash>
                                            <p className="text-sm">{__('actions.delete')} {trans_choice('labels.models.brand', 1).toLowerCase()}</p>
                                        </div>
                                    </AlertDialogTrigger>

                                    <AlertDialogContent>
                                        <AlertDialogHeader>
                                            <AlertDialogTitle>{__('actions.delete')} {brand.name}</AlertDialogTitle>
                                            <AlertDialogDescription>
                                                {__('static.texts.delete_brand')}
                                            </AlertDialogDescription>
                                        </AlertDialogHeader>
                                        <AlertDialogFooter>
                                            <AlertDialogCancel>{__('actions.cancel')}</AlertDialogCancel>
                                            <AlertDialogAction className={buttonVariants({variant: 'destructive'})}
                                                               onClick={() => {
                                                                   destroy(route("admin.brands.destroy", brand.id));
                                                               }}>
                                                <Trash size={16}></Trash>
                                                <p>{__('actions.delete')}</p>
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

    const [sorting, setSorting] = React.useState<SortingState>([]);
    const [columnFilters, setColumnFilters] =
        React.useState<ColumnFiltersState>([]);
    const [columnVisibility, setColumnVisibility] =
        React.useState<VisibilityState>({});
    const [rowSelection, setRowSelection] = React.useState({});

    const table = useReactTable({
        data: brands,
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
                <CreateButton link="admin.brands.create" />
                <Input
                    placeholder="Filter brands..."
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
