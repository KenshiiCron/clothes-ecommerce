"use client"

import * as React from "react"

import {
    Command,
    Home,
    ShoppingBasket,
    Settings,
    Users,
    User,
    ShoppingBag,
    Image,
    Code, Mail
} from "lucide-react"

import {NavMain} from "@/components/nav-main"
import {NavSecondary} from "@/components/nav-secondary"
import {NavUser} from "@/components/nav-user"
import {
    Sidebar,
    SidebarContent,
    SidebarFooter, SidebarGroup, SidebarGroupContent, SidebarGroupLabel,
    SidebarHeader,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
} from "@/components/ui/sidebar"

import {Link, usePage} from "@inertiajs/react";

import {PageProps} from "@/types";
import {TextGenerateEffect} from "@/components/ui/text-generate-effect";

const data = {
    user: {
        name: "shadcn",
        email: "m@example.com",
        avatar: "/avatars/shadcn.jpg",
    },
    navMain: [
        {
            title: "Dashboard",
            url: "/admin/dashboard",
            icon: Home,
        },
        {
            title: "Products",
            url: "/admin/products",
            icon: ShoppingBag,
            isActive: false,
            items: [
                {
                    title: "Products",
                    url: "/admin/products",
                },
                {
                    title: "Categories",
                    url: "/admin/categories",
                },
                {
                    title: "Brands",
                    url: "/admin/brands",
                },
                {
                    title: "Attributes",
                    url: "/admin/attributes",
                },
            ]
        },
        {
            title: "Orders",
            url: "/admin/orders",
            icon: ShoppingBasket,
        },
        {
            title: "Carousels",
            url: "/admin/carousels",
            icon: Image,
        },
        {
            title: "Accounts",
            url: "/admin/users",
            icon: User,
            isActive: false,
            items: [
                {
                    title: "Users",
                    url: "/admin/users",
                },
                {
                    title: "Admins",
                    url: "/admin/admins",
                },
            ]
        },
        {
            title: "Newsletters",
            url: "/admin/newsletters",
            icon: Mail,
        },
        {
            title: "Tests",
            url: "/admin/tests",
            icon: Code,
        },
    ],
    navSecondary: [
        {
            title: "Settings",
            url: "/admin/settings",
            icon: Settings,
        },
        {
            title: "Roles",
            url: "/admin/roles",
            icon: Users,
        },
    ],
}

export function AppSidebar({...props}: React.ComponentProps<typeof Sidebar>) {
    const {auth} = usePage<PageProps>().props;
    const date = new Date();
    const words = `ALGEORITHME© ${date.getFullYear()}`;
    return (
        <Sidebar variant="inset" {...props}>
            <SidebarHeader>
                <SidebarMenu>
                    <SidebarMenuItem>
                        <SidebarMenuButton size="lg" asChild>
                            <Link href={route('admin.dashboard')}>
                                <div
                                    className="flex aspect-square size-8 items-center justify-center rounded-lg bg-sidebar-primary text-sidebar-primary-foreground">
                                    <Command className="size-4"/>
                                </div>
                                <div className="grid flex-1 text-left text-sm leading-tight">
                                    <span className="truncate font-semibold">Ecommerce</span>
                                    <span className="truncate text-xs">Enterprise</span>
                                </div>
                            </Link>
                        </SidebarMenuButton>
                    </SidebarMenuItem>
                </SidebarMenu>
            </SidebarHeader>
            <SidebarContent>
                <NavMain items={data.navMain}/>
                <NavSecondary items={data.navSecondary} className="mt-auto" />
            </SidebarContent>
            <SidebarFooter>
                <NavUser user={auth.user}/>
                <TextGenerateEffect words={words}/>
            </SidebarFooter>
        </Sidebar>
    )
}
