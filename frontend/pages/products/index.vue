<template>
  <div class="container mx-auto p-4">
    <div class="flex justify-between items-center mb-6">
      <h1 class="text-3xl font-bold">Produtos</h1>
      <button 
        @click="navigateTo('/products/create')"
        class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600"
      >
        + Novo Produto
      </button>
    </div>

    <!-- Loading -->
    <div v-if="pending" class="text-center py-8">
      <p class="text-gray-600">Carregando produtos...</p>
    </div>

    <!-- Erro -->
    <div v-else-if="error" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
      <p>Erro ao carregar produtos: {{ error.message }}</p>
    </div>

    <!-- Lista de Produtos -->
    <div v-else class="grid gap-4">
      <!-- Tabela -->
      <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full">
          <thead class="bg-gray-100">
            <tr>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nome</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Categoria</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Preço</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Estoque</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Ações</th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            <!-- ⭐ CORRIGIDO: data.value?.data -->
            <tr v-for="product in data?.data" :key="product.id" class="hover:bg-gray-50">
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                {{ product.id }}
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm font-medium text-gray-900">{{ product.name }}</div>
                <div class="text-sm text-gray-500">{{ product.description }}</div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                  {{ product.category }}
                </span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                R$ {{ product.price.toFixed(2) }}
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm">
                <span 
                  :class="product.stock > 10 ? 'text-green-600' : 'text-red-600'"
                  class="font-semibold"
                >
                  {{ product.stock }} un
                </span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                <button
                  @click="editProduct(product.id)"
                  class="text-blue-600 hover:text-blue-900"
                >
                  Editar
                </button>
                <button
                  @click="deleteProduct(product.id)"
                  class="text-red-600 hover:text-red-900"
                >
                  Deletar
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- Paginação -->
      <!-- ⭐ MUDANÇA CRÍTICA: data?.meta em vez de data -->
      <div v-if="data?.pagination" class="flex justify-center gap-2 mt-4">
        <button
          v-for="page in data.pagination.last_page"
          :key="page"
          @click="changePage(page)"
          class="px-4 py-2 rounded"
          :class="page === currentPage 
            ? 'bg-blue-500 text-white' 
            : 'bg-gray-200 hover:bg-gray-300'"
        >
          {{ page }}
        </button>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { productsApi } from '@/utils/api/products'

const currentPage = ref(1)

const { data, pending, error, refresh } = await productsApi.getAll(currentPage)

const changePage = (page: number) => {
  currentPage.value = page
}

const deleteProduct = async (id: number) => {
 console.log("deleteProduct", id);
}

const editProduct = async (id: number) => {
 console.log("editProduct", id);
}
</script>