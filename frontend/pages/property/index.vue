<template>
    <h1>propiedades</h1>
    <button class="bg-orange-500 p-4" @click="refresh">carregar dnv</button>
    {{ data }}
</template>

<script setup lang="ts">
import { propertyApi } from '~/utils/api/propertyApi';

const { data, refresh } = await propertyApi.getAll()
</script>