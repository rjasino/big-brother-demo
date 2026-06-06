import { createInertiaApp } from '@inertiajs/react';
import { type ComponentType } from 'react';
import { createRoot } from 'react-dom/client';
import '../css/app.css';

type PageModule = { default: ComponentType };

void createInertiaApp({
    resolve: (name) => {
        const pages = import.meta.glob<PageModule>('./Pages/**/*.tsx', { eager: true });
        const page = pages[`./Pages/${name}.tsx`];
        return page.default;
    },
    setup({ el, App, props }) {
        createRoot(el).render(<App {...props} />);
    },
});
