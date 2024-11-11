import {ColumnDef} from "@tanstack/react-table";
import {Checkbox} from "@/components/ui/checkbox";
import {Button, buttonVariants} from "@/components/ui/button";
import {ArrowUpDown, Eye, MoreHorizontal, Pencil, Trash} from "lucide-react";
import {Link, useForm} from "@inertiajs/react";
import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuItem,
    DropdownMenuLabel, DropdownMenuSeparator,
    DropdownMenuTrigger
} from "@/components/ui/dropdown-menu";
import {
    AlertDialog, AlertDialogAction, AlertDialogCancel,
    AlertDialogContent, AlertDialogDescription, AlertDialogFooter,
    AlertDialogHeader,
    AlertDialogTitle,
    AlertDialogTrigger
} from "@/components/ui/alert-dialog";
import * as React from "react";
import {Admin} from "@/components/tables/admins-table";
import {Badge} from "@/components/ui/badge";


export const setColumns = (canEdit: boolean, canDelete: boolean) => {
    const columns: ColumnDef<Admin>[] = [
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
            accessorKey: "name",
            header: "Name",
            cell: ({row}) => <div>{row.getValue("name")}</div>,
        },
        {
            accessorKey: "email",
            header: "Email",
            cell: ({row}) => <div>{row.getValue("email")}</div>,
        },
        {
            accessorKey: "phone",
            header: "Phone",
            cell: ({row}) => <div>{row.getValue("phone")}</div>,
        },
        {
            accessorKey: "roles",
            header: "Roles",
            cell: ({ row }) => (
                <div className="flex flex-wrap gap-1">
                    {row.getValue("roles").map((role :any, index: number) => (
                        <Badge key={index}>
                            {role.name}
                        </Badge>
                    ))}
                </div>
            ),
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
            id: "actions",
            enableHiding: false,
            cell: ({row}) => {
                const admin = row.original;

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
                            {canEdit && <DropdownMenuItem asChild>
                                <Link href={route("admin.admins.edit", admin.id)}>
                                    <Pencil/>
                                    <p>Edit admin</p>
                                </Link>
                            </DropdownMenuItem>}
                            <DropdownMenuItem asChild>
                                <Link href={route("admin.admins.show", admin.id)}>
                                    <Eye/>
                                    <p>View admin</p>
                                </Link>
                            </DropdownMenuItem>
                            <DropdownMenuSeparator/>
                            {canDelete && <DropdownMenuItem asChild>
                                <AlertDialog>
                                    <AlertDialogTrigger asChild>
                                        <div
                                            className="text-red-600 flex items-center gap-2 py-1 px-2 cursor-default cursor-pointer rounded-sm"
                                        >
                                            <Trash size={16}></Trash>
                                            <p className="text-sm font-medium">Delete admin</p>
                                        </div>
                                    </AlertDialogTrigger>

                                    <AlertDialogContent>
                                        <AlertDialogHeader>
                                            <AlertDialogTitle>Delete {admin.name}</AlertDialogTitle>
                                            <AlertDialogDescription>
                                                This action cannot be undone. This will permanently delete this admin,
                                                products
                                                and orders will not be deleted.
                                            </AlertDialogDescription>
                                        </AlertDialogHeader>
                                        <AlertDialogFooter>
                                            <AlertDialogCancel>Cancel</AlertDialogCancel>
                                            <AlertDialogAction className={buttonVariants({variant: 'destructive'})}
                                                               onClick={() => {
                                                                   destroy(route("admin.admins.destroy", admin.id));
                                                               }}>
                                                <Trash size={16}></Trash>
                                                <p>Delete</p>
                                            </AlertDialogAction>
                                        </AlertDialogFooter>
                                    </AlertDialogContent>
                                </AlertDialog>
                            </DropdownMenuItem>}
                        </DropdownMenuContent>
                    </DropdownMenu>
                );
            },
        },
    ];
    return columns;
}
