export default defineNuxtRouteMiddleware(async (to, from) => {
  const { user, fetchUser } = useAuth()

  // Se já tem usuário em cache, permite acesso
  if (user.value) {
    return
  }

  // Tenta buscar o usuário
  try {
    await fetchUser()
    
    // Se conseguiu buscar, permite acesso
    if (user.value) {
      return
    }
    
    // Se não tem usuário, redireciona para login
    return navigateTo('/')
  } catch (error) {
    // Erro ao buscar = não autenticado
    console.log('Não autenticado, redirecionando...')
    return navigateTo('/')
  }
})