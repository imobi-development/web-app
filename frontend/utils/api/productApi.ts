/**
 * API Client para Produtos
 * Centraliza todos os endpoints de produtos
 */
import type { Product, CreateProductDto, UpdateProductDto, PaginatedProducts } from '@/types/models/product'

export const productsApi = {
  /**
   * GET /products - Lista todos os produtos com paginação
   */
  getAll(page: Ref<number> | number = 1) {
    // Se for um Ref, usa computado para query reativa
    const query = computed(() => ({
      page: typeof page === 'number' ? page : page.value
    }))

    return useFetch<PaginatedProducts>('/products', {
      baseURL: useRuntimeConfig().public.apiBase,
      query, // ⭐ Query reativa - atualiza automaticamente!
    })
  },

  /**
   * GET /products/{id} - Busca um produto por ID
   */
  getById(id: number) {
    return useFetch<Product>(`/products/${id}`, {
      baseURL: useRuntimeConfig().public.apiBase,
    })
  },

  /**
   * POST /products - Cria um novo produto
   */
  create(data: CreateProductDto) {
    return useFetch<Product>('/products', {
      baseURL: useRuntimeConfig().public.apiBase,
      method: 'POST',
      body: data,
    })
  },

  /**
   * PATCH /products/{id} - Atualiza um produto
   */
  update(id: number, data: UpdateProductDto) {
    return useFetch<Product>(`/products/${id}`, {
      baseURL: useRuntimeConfig().public.apiBase,
      method: 'PATCH',
      body: data,
    })
  },

  /**
   * DELETE /products/{id} - Deleta um produto
   */
  delete(id: number) {
    return useFetch(`/products/${id}`, {
      baseURL: useRuntimeConfig().public.apiBase,
      method: 'DELETE',
    })
  },

  /**
   * GET /products/category/{category} - Busca por categoria
   */
  getByCategory(category: string) {
    return useFetch<Product[]>(`/products/category/${category}`, {
      baseURL: useRuntimeConfig().public.apiBase,
    })
  },
}