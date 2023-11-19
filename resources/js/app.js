import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { Head, Link, createInertiaApp } from '@inertiajs/vue3';
import Logo from '@/Components/Icon/Logo.vue';
import Message from './Components/Message.vue';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
const appName = import.meta.env.VITE_APP_NAME || 'Error';

createInertiaApp({
    title: (title) => title ? title : appName,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .component("Link", Link)
            .component("Head", Head)
            .component("Logo", Logo)
            .component("Message", Message)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
