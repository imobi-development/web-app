export default defineNuxtConfig({
  compatibilityDate: "2025-10-28",
  modules: ["@nuxtjs/tailwindcss"],
  devtools: { enabled: true },
  runtimeConfig: {
    // Variáveis privadas que podem ser acessadas somente pelo servidor
    apiSecret: process.env.NUXT_API_SECRET || 'secret',
    public: {
      // Variáveis públicas que podem ser acessadas no frontend
      apiBase: process.env.NUXT_PUBLIC_API_BASE,
    },
  },
});
