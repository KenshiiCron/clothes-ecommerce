import "./bootstrap";
import "../css/app.css";

import { createRoot } from "react-dom/client";
import { createInertiaApp } from "@inertiajs/react";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { ThemeProvider } from "@/components/theme-provider";
import { Toaster } from "@/components/ui/toaster";
import { useToast } from "@/hooks/use-toast";
import { useEffect } from "react";

const appName = import.meta.env.VITE_APP_NAME || "Laravel";

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./pages/${name}.tsx`,
            import.meta.glob("./pages/**/*.tsx")
        ),
    setup({ el, App, props }) {
        const root = createRoot(el);

        const ToastHandler = () => {
            const { toast } = useToast();
            const { toast: serverToast } = props.initialPage.props;
            useEffect(() => {
                if (serverToast) {
                    toast({
                        type: serverToast.type || "info",
                        title: serverToast.title || "Notification",
                        description: serverToast.message || "",
                    });
                }
            }, [serverToast, toast]);

            return null;
        };

        root.render(
            <ThemeProvider
                attribute="class"
                defaultTheme="system"
                enableSystem
                disableTransitionOnChange
            >
                <App {...props} />
                <Toaster />
                <ToastHandler />
            </ThemeProvider>
        );
    },
    progress: {
        color: "#4B5563",
    },
});
