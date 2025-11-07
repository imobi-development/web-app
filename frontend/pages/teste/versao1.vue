<template>
    <div class="p-8">
        <h1 class="text-5xl font-bold text-center mb-8">
            Bem vindo {{ user?.name || 'CARREGANDO...' }}
        </h1>

        <div v-if="user" class="max-w-2xl mx-auto">
            <div class="bg-zinc-900 rounded-xl p-6 mb-4">
                <pre class="bg-zinc-950 p-4 rounded overflow-auto text-green-500">{{ user }}</pre>
            </div>

            <iframe width="560" height="315" src="https://www.youtube.com/embed/qFBK3TY6R-c?si=pG7hju1gG10CzWjv"
                title="YouTube video player" frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>

            <button @click="handleLogout"
                class="w-full bg-red-500 hover:bg-red-600 text-white px-6 py-3 rounded-xl font-semibold transition-all mt-1">
                Sair
            </button>
        </div>

        <div v-else class="text-center">
            <p class="text-zinc-500">Carregando...</p>
        </div>
    </div>
</template>

<script setup>
definePageMeta({
    middleware: 'auth',
})

const { user, logout } = useAuth()

const handleLogout = async () => {
    await logout()
}
</script>