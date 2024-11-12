import {usePage} from "@inertiajs/react";

export const __ = (key: string, replace = {}): string => {
    const { translations } = usePage().props;

    // @ts-ignore
    let translation = translations[key] || key;

    Object.keys(replace).forEach((placeholder) => {
        // @ts-ignore
        translation = translation.replace(`:${placeholder}`, replace[placeholder]);
    });

    return translation;
}

export const trans_choice = (key: string, count: number, replace = {}): string => {
    const { translations } = usePage().props;

    // @ts-ignore
    let translation = translations[key] || key;
    const plural = translation.split('|');

    let chosenTranslation = count > 1 ? plural[1] : plural[0];

    Object.keys(replace).forEach((placeholder) => {
        // @ts-ignore
        chosenTranslation = chosenTranslation.replace(`:${placeholder}`, replace[placeholder]);
    });

    return chosenTranslation;
}
