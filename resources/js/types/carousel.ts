export default interface Carousel {
    id: string;
    name: string;
    description?: string;
    image_url: string;
    state: boolean;
    type: number;
    product_id?: number;
    action?: string;
    created_at: string;
    updated_at: string;
};
