<template>
    <h1 class="text-3xl font-bold underline bg-red-500">Olá, Nuxt está funcionando com tailwind 🎉</h1>
    <button @click="navigateTo('/teste/versao1')" class="py-4 bg-blue-500 text-white rounded-md">Teste para ir pra
        rotaaaa</button>
        <p class="text-3xl text-black">{{ data.message|| 'nao tem nada' }}</p>
</template>

<script setup>
const { data, pending, error } = await useFetch('http://127.0.0.1:8000/api/hello')
</script>
