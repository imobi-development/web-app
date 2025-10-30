export interface Property {
    id: number
    name: string
    description: string
    is_active: boolean
    created_at: string
    updated_at: string
    deleted_at: string
}

export interface CreatePropertyDto {
    name: string
    description: string
}
