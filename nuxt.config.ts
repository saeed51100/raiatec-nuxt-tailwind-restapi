// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
    app: {
        head: {
            charset: "utf-16",
            viewport: "width=device-width,initial-scale=1",
            title: "raiatec",
            titleTemplate: "%s - raiatec",
            meta: [{name: "description", content: "raiatec.com"}],
            htmlAttrs: {
                lang: 'en',
                class: 'h-full bg-white'
            },
            bodyAttrs: {
                // id: 'my-body'
                class: 'h-full'
            },
        },
    },
    runtimeConfig: {
        public: {
            wpUri: process.env.WP_URI,
        },
    },
});
