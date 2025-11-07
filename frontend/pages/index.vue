<template>
    <div class="flex items-center justify-center min-h-screen w-full bg-zinc-950">
        <div class="w-full max-w-lg px-6">
            <!-- Header -->
            <div class="text-center mb-12">
                <h1 class="text-3xl font-light text-zinc-100 tracking-tight mb-2">Bem-vindo</h1>
                <p class="text-sm text-zinc-500">Entre com suas credenciais</p>
            </div>

            <!-- Form Card -->
            <div class="bg-zinc-900/50 border border-zinc-800/50 rounded-2xl p-8 backdrop-blur-sm">
                <form @submit.prevent="handleLogin" class="space-y-6">
                    <!-- Email Field -->
                    <div class="space-y-2">
                        <label for="email" class="block text-sm font-medium text-zinc-300">
                            Email
                        </label>
                        <input id="email" type="email" v-model="credentials.email" placeholder="seu@email.com"
                            class="w-full px-4 py-3 bg-zinc-900 border border-zinc-800 rounded-xl text-zinc-100 placeholder-zinc-600 text-sm transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-orange-500/50 focus:border-orange-500 hover:border-zinc-700"
                            required>
                    </div>

                    <!-- Password Field -->
                    <div class="space-y-2">
                        <div class="flex items-center justify-between">
                            <label for="password" class="block text-sm font-medium text-zinc-300">
                                Senha
                            </label>
                            <a href="#" class="text-xs text-zinc-500 hover:text-orange-500 transition-colors">
                                Esqueceu a senha?
                            </a>
                        </div>
                        <input id="password" type="password" v-model="credentials.password" placeholder="••••••••"
                            class="w-full px-4 py-3 bg-zinc-900 border border-zinc-800 rounded-xl text-zinc-100 placeholder-zinc-600 text-sm transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-orange-500/50 focus:border-orange-500 hover:border-zinc-700"
                            required>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit"
                        class="w-full py-3 bg-orange-500 hover:bg-orange-600 text-white rounded-xl text-sm font-semibold transition-all duration-200 hover:shadow-lg hover:shadow-orange-500/20 active:scale-[0.98]">
                        Entrar
                    </button>
                </form>

                <!-- Divider -->
                <div class="relative my-6">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-zinc-800"></div>
                    </div>
                    <div class="relative flex justify-center text-xs">
                        <span class="px-2 bg-zinc-900/10 text-zinc-400">ou</span>
                    </div>
                </div>

                <!-- Sign Up Link -->
                <div class="text-center">
                    <p class="text-sm text-zinc-500">
                        Não tem uma conta?
                        <NuxtLink to="/register"
                            class="text-orange-500 hover:text-orange-400 font-medium transition-colors">
                            Criar conta
                        </NuxtLink>
                    </p>
                </div>
            </div>

            <!-- Footer -->
            <div class="text-center mt-8">
                <p class="text-xs text-zinc-600">
                    © 2025 Todos os direitos reservados
                </p>
            </div>
        </div>
    </div>
</template>

<script setup>
const { login } = useAuth()

const credentials = ref({
    email: '',
    password: '',
})

const error = ref('')
const loading = ref(false)

const handleLogin = async () => {
    try {
        loading.value = true
        error.value = ''
        
        await login(credentials.value)
        
        console.log('Login bem-sucedido!')
        navigateTo('/teste/versao1')
    } catch (error) {
        console.error('Erro ao fazer login:', error)
        error.value = error.data?.message || 'Credenciais inválidas'
    } finally {
        loading.value = false
    }
}
</script>