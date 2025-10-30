/**
 *  API Client para Propriedades
 *  Centraliza todos os endpoints de propriedades
 */

import type { Property, CreatePropertyDto } from '@/types/models/property'

export const propertyApi = {
    /**
     * GET /properties - Lista todas as propriedades
     */
    getAll() {
        return useFetch<Property[]>('/properties', {
            baseURL: useRuntimeConfig().public.apiBase,
        })
    },

    getById(id: string) {
        return useFetch<Property>(`/properties/${id}`, {
            baseURL: useRuntimeConfig().public.apiBase,
        })
    },

    create(data: CreatePropertyDto) {
        return useFetch<Property>('/properties', {
            baseURL: useRuntimeConfig().public.apiBase,
            method: 'POST',
            body: data,
        })
    },
}