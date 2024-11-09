import {ColumnDef} from "@tanstack/react-table";
import {Checkbox} from "@/components/ui/checkbox";
import {Button, buttonVariants} from "@/components/ui/button";
import {Eye, MoreHorizontal, Pencil, Trash} from "lucide-react";
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
import {Role} from "@/components/tables/roles-table";
import {Badge} from "@/components/ui/badge";

export const columns: ColumnDef<Role>[] = [
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
        accessorKey: "permissions",
        header: "Permissions",
        cell: ({ row }) => (
            <div className="max-w-lg flex flex-wrap items-center gap-1">
                {row.getValue("permissions").map((permission :any, index: number) => (
                    <Badge key={index}>
                        {permission.name}
                    </Badge>
                ))}
            </div>
        ),
    },
    {
        id: "actions",
        enableHiding: false,
        cell: ({row}) => {
            const role = row.original;

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
                        <DropdownMenuItem asChild>
                            <Link href={route("admin.roles.edit", role.id)}>
                                <Pencil/>
                                <p>Edit role</p>
                            </Link>
                        </DropdownMenuItem>
                        <DropdownMenuSeparator/>
                        <DropdownMenuItem asChild>
                            <AlertDialog>
                                <AlertDialogTrigger asChild>
                                    <div
                                        className="text-red-600 flex items-center gap-2 py-1 px-2 cursor-default cursor-pointer rounded-sm"
                                    >
                                        <Trash size={16}></Trash>
                                        <p className="text-sm font-medium">Delete role</p>
                                    </div>
                                </AlertDialogTrigger>

                                <AlertDialogContent>
                                    <AlertDialogHeader>
                                        <AlertDialogTitle>Delete {role.name}</AlertDialogTitle>
                                        <AlertDialogDescription>
                                            This action cannot be undone. This will permanently delete this role
                                        </AlertDialogDescription>
                                    </AlertDialogHeader>
                                    <AlertDialogFooter>
                                        <AlertDialogCancel>Cancel</AlertDialogCancel>
                                        <AlertDialogAction className={buttonVariants({variant: 'destructive'})}
                                                           onClick={() => {
                                                               destroy(route("admin.roles.destroy", role.id));
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
