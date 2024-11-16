"use client"

import * as React from "react"
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
} from "@tanstack/react-table"
import {ArrowUpDown, ChevronDown, Download, File, MoreHorizontal, PlusCircleIcon, Upload} from "lucide-react"
import { Button } from "@/components/ui/button"

import { Input } from "@/components/ui/input"
import {
    Table,
    TableBody,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from "@/components/ui/table"
import {Link, useForm} from "@inertiajs/react";
import {columns} from "@/components/tables/columns/products-columns";
import {CreateButton} from "@/components/elements/create-button";
import {FormEventHandler, useRef} from "react";
import {
    Dialog, DialogClose,
    DialogContent,
    DialogDescription,
    DialogHeader,
    DialogTitle,
    DialogTrigger
} from "@/components/ui/dialog";
import {Simulate} from "react-dom/test-utils";
import submit = Simulate.submit;

export type Product = {
    id: string,
    image_url: string,
    name: string,
    created_at: string,
    updated_at: string
}

interface DataTableDemoProps {
    products: Product[];
}
export default function DataTableDemo({ products }: DataTableDemoProps) {
    const [sorting, setSorting] = React.useState<SortingState>([])
    const [columnFilters, setColumnFilters] = React.useState<ColumnFiltersState>(
        []
    )
    const [columnVisibility, setColumnVisibility] =
        React.useState<VisibilityState>({})
    const [rowSelection, setRowSelection] = React.useState({})

    const table = useReactTable({
        data : products,
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
    })
    const { data, setData, post, processing, errors, reset } = useForm({
        file: '',
    });
    const { get :submitExport,  data: exportData} = useForm({
    });
    const exportProducts: FormEventHandler = (e)=>{
        e.preventDefault()
        console.log(route('admin.products.export'))
        submitExport(route('admin.products.export'))
    }
    const importProducts: FormEventHandler = (e)=>{
        e.preventDefault();
        post(route('admin.products.import'))
        console.log(data.file)
    }
    return (
        <div className="w-full">
            <div className="flex justify-between items-center py-4">
                <div className='flex gap-2 w-full'>
                    <CreateButton link="admin.products.create" />
                    <Dialog>
                        <DialogTrigger>
                            <Button variant="outline">
                                <p>Import File</p>
                                <Upload/>
                            </Button>
                        </DialogTrigger>
                        <DialogContent>
                            <DialogHeader>
                                <DialogTitle>
                                    Import products
                                </DialogTitle>
                            </DialogHeader>
                            <DialogDescription>
                                Upload an excel file to insert products
                            </DialogDescription>
                            <form onSubmit={importProducts} className='w-full'>
                                <Input id='file' type='file'
                                       onChange={(e) => {
                                           // @ts-ignore
                                           setData('file',e.target.files[0])
                                       }}/>
                                <DialogClose>
                                    <Button type='submit' className='w-full mt-2' >
                                        Import
                                    </Button>
                                </DialogClose>
                            </form>
                        </DialogContent>
                    </Dialog>
                </div>
                <form onSubmit={exportProducts}>
                    <Button className='mr-2' type='submit'>
                        <p>Export Products</p>
                        <Download/>
                    </Button>
                </form>
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
                                                    header.column.columnDef.header,
                                                    header.getContext()
                                                )}
                                        </TableHead>
                                    )
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
    )
}
