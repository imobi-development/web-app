/**
 * Types para Produtos
 */

// Modelo completo do produto
export interface Product {
    id: number
    name: string
    description: string
    price: number
    stock: number
    category: string
    sku?: string
    weight?: number
    created_at: string
    updated_at: string
  }
  
  // Para criar produto (não precisa de id, created_at, etc)
  export interface CreateProductDto {
    name: string
    description?: string
    price: number
    stock: number
    category: string
  }
  
  // Para atualizar produto (todos os campos opcionais)
  export interface UpdateProductDto {
    name?: string
    description?: string
    price?: number
    stock?: number
    category?: string
  }
  
  // Resposta paginada
  export interface PaginatedProducts {
    success: boolean
    // message: string
    data: Product[]
    pagination: {
      current_page: number
      last_page: number
      per_page: number
      total: number
      from: number
      to: number
    }
  }