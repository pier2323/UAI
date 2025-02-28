import axios from 'axios';
import tash from 'alpinejs-tash'
import collapse from "@alpinejs/collapse";
import anchor from "@alpinejs/anchor";

// ? axios 
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// ? alpine tash 
Alpine.plugin(tash)
 
// ? alpine anchor && collapse 
document.addEventListener(
    "alpine:init",
    () => {
        const modules = import.meta.glob("./plugins/**/*.js", { eager: true });
 
        for (const path in modules) {
            window.Alpine.plugin(modules[path].default);
        }
        window.Alpine.plugin(collapse);
        window.Alpine.plugin(anchor);
    },
    { once: true },
);
