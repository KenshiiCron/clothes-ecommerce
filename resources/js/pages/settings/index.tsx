import AuthenticatedLayout from "@/layouts/authenticated-layout";
import {Head, useForm, usePage} from "@inertiajs/react";
import {PageProps} from "@/types";
import {FormEventHandler} from "react"
import {Settings, Facebook, Truck, Languages, Laptop} from "lucide-react"

import {Button} from "@/components/ui/button"
import {Card, CardContent, CardDescription, CardFooter, CardHeader, CardTitle} from "@/components/ui/card"
import {Input} from "@/components/ui/input"
import {Label} from "@/components/ui/label"
import {Switch} from "@/components/ui/switch"
import {Tabs, TabsContent, TabsList, TabsTrigger} from "@/components/ui/tabs"
import {SelectContent, SelectGroup, SelectItem, SelectTrigger, SelectValue} from "@/components/ui/select";
import {Select} from "@radix-ui/react-select";
import {Textarea} from "@/components/ui/textarea";

export default function Roles({settings} : PageProps<{ settings: any }>) {
    console.log(settings)
    const {data, setData, post, processing, errors} = useForm({
        contact_email: settings.contact_email,
        phone_1: settings.phone_1,
        site_name: settings.site_name,
        site_description: settings.site_description,
        site_about_us: settings.site_about_us,
        seo_meta_keywords: settings.seo_meta_keywords,
        max_upload_size: settings.max_upload_size,
        phone_2: settings.phone_2,
        facebook_pixel: settings.facebook_pixel,
        social_facebook: settings.social_facebook,
        social_twitter: settings.social_twitter,
        social_instagram: settings.social_instagram,
        yalidine_api_id: settings.yalidine_api_id,
        yalidine_api_token: settings.yalidine_api_token,
        zr_express_api_key: settings.zr_express_api_key,
        zr_express_api_token: settings.zr_express_api_token,
        zr_delivery: settings.zr_delivery == 1,
        yalidine_delivery: settings.yalidine_delivery == 1,
    });

    const { locale } = usePage().props;

    const {data: localeData, setData: setLocaleData, get} = useForm({
        locale: locale,
    });

    const handleLocaleChange = (value: string) => {
        setLocaleData("locale", value);
        get(route("switchLocale", { locale: value }));
    };

    const submit: FormEventHandler = (e) => {
        e.preventDefault();
        post(route("admin.settings.update"));
    };
    return (
        <AuthenticatedLayout
            header="Settings"
        >
            <Head title="Settings"/>
            <form onSubmit={submit}>
                <Tabs defaultValue="general" orientation="vertical" className="flex space-x-6">
                    <TabsList className="flex flex-col h-full space-y-2 bg-muted p-2 rounded-lg min-w-44">
                        <TabsTrigger value="general" className="w-full justify-start">
                            <Settings className="mr-2 h-4 w-4"/>
                            General
                        </TabsTrigger>
                        <TabsTrigger value="socials" className="w-full justify-start">
                            <Facebook className="mr-2 h-4 w-4"/>
                            Socials
                        </TabsTrigger>
                        <TabsTrigger value="delivery" className="w-full justify-start">
                            <Truck className="mr-2 h-4 w-4"/>
                            Delivery
                        </TabsTrigger>
                        <TabsTrigger value="language" className="w-full justify-start">
                            <Languages className="mr-2 h-4 w-4"/>
                            Language
                        </TabsTrigger>
                        <TabsTrigger value="website" className="w-full justify-start">
                            <Laptop className="mr-2 h-4 w-4"/>
                            Website
                        </TabsTrigger>
                        {/*<TabsTrigger value="privacy">*/}
                        {/*    <Lock className="mr-2 h-4 w-4"/>*/}
                        {/*    Privacy*/}
                        {/*</TabsTrigger>*/}
                    </TabsList>
                    <div className="flex-1">
                        <TabsContent value="general">
                            <Card>
                                <CardHeader>
                                    <CardTitle>General Settings</CardTitle>
                                    <CardDescription>Manage your general preferences.</CardDescription>
                                </CardHeader>
                                <CardContent className="space-y-4">
                                    <div className="space-y-2">
                                        <Label htmlFor="contact_email">Contact Email</Label>
                                        <Input
                                            id="contact_email"
                                            type="email"
                                            value={data.contact_email}
                                            onChange={(e) => setData("contact_email", e.target.value)}
                                        />
                                    </div>
                                    <div className="space-y-2">
                                        <Label htmlFor="phone_1">Phone 1</Label>
                                        <Input
                                            id="phone_1"
                                            type="text"
                                            value={data.phone_1}
                                            onChange={(e) => setData("phone_1", e.target.value)}
                                        />
                                    </div>
                                    <div className="space-y-2">
                                        <Label htmlFor="phone_1">Phone 2</Label>
                                        <Input
                                            id="phone_2"
                                            type="text"
                                            value={data.phone_2}
                                            onChange={(e) => setData("phone_2", e.target.value)}
                                        />
                                    </div>
                                    <div className="space-y-2">
                                        <Label htmlFor="pixel_token">Facebook Pixel Token</Label>
                                        <Input
                                            id="pixel_token"
                                            type="text"
                                            value={data.facebook_pixel}
                                            onChange={(e) => setData("facebook_pixel", e.target.value)}
                                        />
                                    </div>
                                </CardContent>
                                <CardFooter>
                                    <Button>Save Changes</Button>
                                </CardFooter>
                            </Card>
                        </TabsContent>
                        <TabsContent value="socials">
                            <Card>
                                <CardHeader>
                                    <CardTitle>Socials Settings</CardTitle>
                                    <CardDescription>Manage your social media links.</CardDescription>
                                </CardHeader>
                                <CardContent className="space-y-4">
                                    <div className="space-y-2">
                                        <Label htmlFor="facebook">Facebook link</Label>
                                        <Input
                                            id="facebook"
                                            type="text"
                                            value={data.social_facebook}
                                            onChange={(e) => setData("social_facebook", e.target.value)}
                                        />
                                    </div>
                                    <div className="space-y-2">
                                        <Label htmlFor="instagram">Instagram link</Label>
                                        <Input
                                            id="instagram"
                                            type="text"
                                            value={data.social_instagram}
                                            onChange={(e) => setData("social_instagram", e.target.value)}
                                        />
                                    </div>
                                    <div className="space-y-2">
                                        <Label htmlFor="twitter">Twitter link</Label>
                                        <Input
                                            id="twitter"
                                            type="text"
                                            value={data.social_twitter}
                                            onChange={(e) => setData("social_twitter", e.target.value)}
                                        />
                                    </div>
                                </CardContent>
                                <CardFooter>
                                    <Button>Update Account</Button>
                                </CardFooter>
                            </Card>
                        </TabsContent>
                        <TabsContent value="delivery">
                            <Card>
                                <CardHeader>
                                    <CardTitle>Delivery Settings</CardTitle>
                                    <CardDescription>Manage your delivery settings.</CardDescription>
                                </CardHeader>
                                <CardContent className="space-y-4">
                                    <div className="flex items-center space-x-2">
                                        <Switch checked={data.yalidine_delivery}
                                                onCheckedChange={(value) => setData('yalidine_delivery', value)}
                                                id="yalidine-delivery" className="data-[state=checked]:bg-red-500"/>
                                        <Label htmlFor="yalidine-delivery">Yalidine Delivery</Label>
                                    </div>
                                    {data.yalidine_delivery &&
                                        <div>
                                            <div className="space-y-2 mb-2">
                                                <Label htmlFor="yalidine_api_id">Yalidine API ID</Label>
                                                <Input
                                                    id="yalidine_api_id"
                                                    type="text"
                                                    value={data.yalidine_api_id}
                                                    onChange={(e) => setData("yalidine_api_id", e.target.value)}
                                                />
                                            </div>
                                            <div className="space-y-2">
                                                <Label htmlFor="yalidine_api_token">Yalidine API token</Label>
                                                <Input
                                                    id="yalidine_api_token"
                                                    type="text"
                                                    value={data.yalidine_api_token}
                                                    onChange={(e) => setData("yalidine_api_token", e.target.value)}
                                                />
                                            </div>
                                        </div>
                                    }
                                    <div className="flex items-center space-x-2">
                                        <Switch id="zr-delivery" className="data-[state=checked]:bg-yellow-300" checked={data.zr_delivery}
                                                onCheckedChange={(value) => setData('zr_delivery', value)}
                                        />
                                        <Label htmlFor="zr-delivery">ZR Express Delivery</Label>
                                    </div>
                                    {data.zr_delivery &&
                                        <div>
                                            <div className="space-y-2 mb-2">
                                                <Label htmlFor="zr_token">ZR Express Token</Label>
                                                <Input
                                                    id="zr_token"
                                                    type="text"
                                                    value={data.zr_express_api_token}
                                                    onChange={(e) => setData("zr_express_api_token", e.target.value)}
                                                />
                                            </div>
                                            <div className="space-y-2">
                                                <Label htmlFor="zr_key">ZR Key</Label>
                                                <Input
                                                    id="zr_key"
                                                    type="text"
                                                    value={data.zr_express_api_key}
                                                    onChange={(e) => setData("zr_express_api_key", e.target.value)}
                                                />
                                            </div>
                                        </div>
                                    }
                                </CardContent>
                                <CardFooter>
                                    <Button>Save Preferences</Button>
                                </CardFooter>
                            </Card>
                        </TabsContent>
                        <TabsContent value="language">
                            <Card>
                                <CardHeader>
                                    <CardTitle>Language Settings</CardTitle>
                                    <CardDescription>Manage your Language preferences.</CardDescription>
                                </CardHeader>
                                <CardContent className="space-y-4">
                                    <Select onValueChange={handleLocaleChange}>
                                        <SelectTrigger className="max-w-96">
                                            <SelectValue placeholder="Language" />
                                        </SelectTrigger>
                                        <SelectContent>
                                            <SelectGroup>
                                                <SelectItem value="fr">Français</SelectItem>
                                                <SelectItem value="en">English</SelectItem>
                                                <SelectItem value="ar">العربية</SelectItem>
                                            </SelectGroup>
                                        </SelectContent>
                                    </Select>
                                </CardContent>
                            </Card>
                        </TabsContent>
                        <TabsContent value="website">
                            <Card>
                                <CardHeader>
                                    <CardTitle>Website Settings</CardTitle>
                                    <CardDescription>Manage your website settings.</CardDescription>
                                </CardHeader>
                                <CardContent className="space-y-4">
                                    <div className="space-y-2">
                                        <Label htmlFor="site_name">Website Name</Label>
                                        <Input
                                            id="site_name"
                                            type="text"
                                            value={data.site_name}
                                            onChange={(e) => setData("site_name", e.target.value)}
                                        />
                                    </div>
                                    <div className="space-y-2">
                                        <Label htmlFor="site_description">Website Description</Label>
                                        <Textarea
                                            id="site_description"
                                            onChange={(e) => setData("site_description", e.target.value)}
                                        >{data.site_description}</Textarea>
                                    </div>
                                    <div className="space-y-2">
                                        <Label htmlFor="site_about_us">About us Description</Label>
                                        <Textarea
                                            id="site_about_us"
                                            onChange={(e) => setData("site_about_us", e.target.value)}
                                        >{data.site_about_us}</Textarea>
                                    </div>
                                    <div className="space-y-2">
                                        <Label htmlFor="seo_meta_keywords">SEO Keywords (seperated by comma)</Label>
                                        <Input
                                            id="seo_meta_keywords"
                                            value={data.seo_meta_keywords}
                                            onChange={(e) => setData("seo_meta_keywords", e.target.value)}
                                        />
                                    </div>
                                    <div className="space-y-2">
                                        <Label htmlFor="max_upload_size">Max Upload Size (KB)</Label>
                                        <Input
                                            id="max_upload_size"
                                            type="number"
                                            value={data.max_upload_size}
                                            onChange={(e) => setData("max_upload_size", e.target.value)}
                                        />
                                    </div>
                                </CardContent>
                                <CardFooter>
                                    <Button>Save Changes</Button>
                                </CardFooter>
                            </Card>
                        </TabsContent>
                        {/*<TabsContent value="privacy">*/}
                        {/*    <Card>*/}
                        {/*        <CardHeader>*/}
                        {/*            <CardTitle>Privacy Settings</CardTitle>*/}
                        {/*            <CardDescription>Manage your privacy preferences.</CardDescription>*/}
                        {/*        </CardHeader>*/}
                        {/*        <CardContent className="space-y-4">*/}
                        {/*            <div className="flex items-center space-x-2">*/}
                        {/*                <Switch id="profile-visibility"/>*/}
                        {/*                <Label htmlFor="profile-visibility">Public Profile</Label>*/}
                        {/*            </div>*/}
                        {/*            <div className="flex items-center space-x-2">*/}
                        {/*                <Switch id="data-collection"/>*/}
                        {/*                <Label htmlFor="data-collection">Allow Data Collection</Label>*/}
                        {/*            </div>*/}
                        {/*        </CardContent>*/}
                        {/*        <CardFooter>*/}
                        {/*            <Button>Update Privacy Settings</Button>*/}
                        {/*        </CardFooter>*/}
                        {/*    </Card>*/}
                        {/*</TabsContent>*/}
                    </div>
                </Tabs>
            </form>
        </AuthenticatedLayout>
    );
}
