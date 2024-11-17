import {Wishlist} from "@/types/wishlist";

export interface User {
    id: string,
    name: string,
    email: string,
    phone: string,
    orders: Array<any>,
    wishlist: Wishlist[],
    image: string,
    image_url: string,
    created_at: string,
    updated_at: string,
}
