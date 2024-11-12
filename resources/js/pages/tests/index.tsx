import AuthenticatedLayout from "@/layouts/authenticated-layout";
import {Head, useForm} from "@inertiajs/react";
import {PageProps} from "@/types";
import {FormEventHandler, useEffect, useState} from "react"

import {
    Select,
    SelectContent,
    SelectGroup,
    SelectItem,
    SelectLabel,
    SelectTrigger,
    SelectValue,
} from "@/components/ui/select"
import ZRWilaya from "@/types/zr-wilaya";
import {Button} from "@/components/ui/button";
import Commune from "@/types/commune";
import {Input} from "@/components/ui/input";
import {InputError} from "@/components/ui/input-error";


export default function Tests({wilayas, communes}: PageProps<{ wilayas: ZRWilaya[], communes: Commune[] }>) {
    const {data, setData, post, processing, errors} = useForm({
        wilaya: "",
        delivery_type: "1",
        price: "0",
        commune: "",
        address: "",
    });

    const [filteredCommunes, setFilteredCommunes] = useState([]);

    useEffect(() => {
        const selectedCommunes = communes.filter(commune => commune.wilaya_id.toString() === data.wilaya);
        setFilteredCommunes(selectedCommunes);
    }, [data.wilaya]);

    useEffect(() => {
        setData("address", "")
    }, [data.delivery_type]);

    useEffect(() => {
        const selectedWilaya = wilayas.find(w => w.IDWilaya.toString() === data.wilaya);

        if (data.wilaya !== "") {
            if (data.delivery_type === "0") {
                setData('price', selectedWilaya.Domicile);
            } else {
                setData('price', selectedWilaya.Stopdesk);
            }
        }
    }, [data.wilaya, data.delivery_type]);


    const submit: FormEventHandler = (e) => {
        e.preventDefault();
        post(route("admin.tests.test"));
    };
    return (
        <AuthenticatedLayout
            header="Tests"
        >
            <Head title="Tests"/>
            <form onSubmit={submit} className="mt-4 max-w-md flex flex-col gap-4">
                <h2>ZR Pricing</h2>
                <Select required onValueChange={(value) => {
                    setData('wilaya', value);
                }}>
                    <SelectTrigger >
                        <SelectValue placeholder="Select a wilaya"/>
                    </SelectTrigger>
                    <SelectContent>
                        <SelectGroup>
                            <SelectLabel>Wilaya</SelectLabel>
                            {
                                wilayas.map((wilaya: ZRWilaya) => {
                                    return (<SelectItem value={wilaya.IDWilaya.toString()}
                                                        key={wilaya.IDWilaya}>{wilaya.Wilaya}</SelectItem>)
                                })
                            }
                        </SelectGroup>
                    </SelectContent>
                </Select>

                {data.wilaya && (<Select onValueChange={(value) => setData('commune', value)}>
                    <SelectTrigger>
                        <SelectValue placeholder="Select a commune"/>
                    </SelectTrigger>
                    <SelectContent>
                        <SelectGroup>
                            <SelectLabel>Communes</SelectLabel>
                            {
                                filteredCommunes.map((commune: Commune) => (
                                    <SelectItem value={commune.name} key={commune.id}>
                                        {commune.name}
                                    </SelectItem>
                                ))
                            }
                        </SelectGroup>
                    </SelectContent>
                </Select>)}

                <Select required onValueChange={(value) => {
                    setData('delivery_type', value);
                }} defaultValue={data.delivery_type}>
                    <SelectTrigger>
                        <SelectValue placeholder="Delivery Type"/>
                    </SelectTrigger>
                    <SelectContent>
                        <SelectGroup>
                            <SelectLabel>Delivery Type</SelectLabel>
                            <SelectItem value="1">Stop Desk</SelectItem>
                            <SelectItem value="0">Home</SelectItem>
                        </SelectGroup>
                    </SelectContent>
                </Select>

                {
                    data.delivery_type === "0" &&
                    <div>
                        <Input placeholder="Address" onChange={(e) => setData("address", e.target.value)} required/>
                        <InputError message={errors.address}/>
                    </div>
                }


                <p>{data.price} DA</p>


                <Button type="submit" className="w-full mt-4" disabled={processing}>Order</Button>
            </form>
        </AuthenticatedLayout>
    );
}
