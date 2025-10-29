<template>
    <div class="container mx-auto p-4 max-w-2xl">
      <h1 class="text-3xl font-bold mb-6">Criar Novo Produto</h1>
  
      <form @submit.prevent="handleSubmit" class="bg-white shadow rounded-lg p-6 space-y-4">
        <!-- Nome -->
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">
            Nome do Produto *
          </label>
          <input
            v-model="formData.name"
            type="text"
            required
            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
            placeholder="Ex: Notebook Dell"
          />
        </div>
  
        <!-- Descrição -->
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">
            Descrição
          </label>
          <textarea
            v-model="formData.description"
            rows="3"
            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
            placeholder="Descrição detalhada do produto"
          ></textarea>
        </div>
  
        <!-- Preço e Estoque -->
        <div class="grid grid-cols-2 gap-4">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">
              Preço (R$) *
            </label>
            <input
              v-model.number="formData.price"
              type="number"
              step="0.01"
              min="0"
              required
              class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
              placeholder="0.00"
            />
          </div>
  
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">
              Estoque *
            </label>
            <input
              v-model.number="formData.stock"
              type="number"
              min="0"
              required
              class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
              placeholder="0"
            />
          </div>
        </div>
  
        <!-- Categoria -->
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">
            Categoria *
          </label>
          <select
            v-model="formData.category"
            required
            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
          >
            <option value="">Selecione...</option>
            <option value="Eletrônicos">Eletrônicos</option>
            <option value="Periféricos">Periféricos</option>
            <option value="Acessórios">Acessórios</option>
            <option value="Games">Games</option>
          </select>
        </div>
  
        <!-- Mensagem de erro -->
        <div v-if="errorMessage" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
          {{ errorMessage }}
        </div>
  
        <!-- Botões -->
        <div class="flex gap-3 pt-4">
          <button
            type="submit"
            :disabled="isSubmitting"
            class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600 disabled:opacity-50 disabled:cursor-not-allowed"
          >
            {{ isSubmitting ? 'Criando...' : 'Criar Produto' }}
          </button>
          <button
            type="button"
            @click="navigateTo('/products')"
            class="bg-gray-300 text-gray-700 px-6 py-2 rounded hover:bg-gray-400"
          >
            Cancelar
          </button>
        </div>
      </form>
    </div>
  </template>
  
  <script setup lang="ts">
  import { productsApi } from '~/utils/api/productApi'
  import type { CreateProductDto } from '@/types/models/product'
  
  const formData = ref<CreateProductDto>({
    name: '',
    description: '',
    price: 0,
    stock: 0,
    category: '',
  })
  
  const isSubmitting = ref(false)
  const errorMessage = ref('')
  
  const handleSubmit = async () => {
    isSubmitting.value = true
    errorMessage.value = ''
  
    const { data, error } = await productsApi.create(formData.value)
  
    if (error.value) {
      errorMessage.value = 'Erro ao criar produto. Tente novamente.'
      isSubmitting.value = false
      return
    }
  
    alert('Produto criado com sucesso!')
    navigateTo('/products')
  }
  </script>