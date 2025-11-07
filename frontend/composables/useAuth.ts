export const useAuth = () => {
    const user = useState<any>('user', () => null)
    const loading = useState<boolean>('auth-loading', () => false)
    const config = useRuntimeConfig()
  
    // Busca dados do usuário
    const fetchUser = async () => {
      if (loading.value) return user.value
      
      loading.value = true
      try {
        const response = await $fetch(`${config.public.apiBase}/me`, {
          credentials: 'include',
        })
        user.value = response.user
        return response.user
      } catch (error) {
        user.value = null
        throw error
      } finally {
        loading.value = false
      }
    }
  
    // Faz logout
    const logout = async () => {
      try {
        await $fetch(`${config.public.apiBase}/auth/logout`, {
          method: 'POST',
          credentials: 'include',
        })
        user.value = null
        navigateTo('/')
      } catch (error) {
        console.error('Erro ao fazer logout:', error)
      }
    }
  
    // Faz login
    const login = async (credentials: { email: string; password: string }) => {
      try {
        const response = await $fetch(`${config.public.apiBase}/auth/login`, {
          method: 'POST',
          body: credentials,
          credentials: 'include',
        })
        
        // Busca os dados do usuário após login
        await fetchUser()
        
        return response
      } catch (error) {
        throw error
      }
    }
  
    return {
      user,
      loading,
      fetchUser,
      logout,
      login,
    }
  }