<template>
    <div class="flex items-center justify-center min-h-screen w-full bg-zinc-950">
        <div class="w-full max-w-lg px-6">
            <!-- Header -->
            <div class="text-center mb-12">
                <h1 class="text-3xl font-light text-zinc-100 tracking-tight mb-2">Criar Conta</h1>
                <p class="text-sm text-zinc-500">Preencha os dados para começar</p>
            </div>

            <!-- Form Card -->
            <div class="bg-zinc-900/50 border border-zinc-800/50 rounded-2xl p-8 backdrop-blur-sm">
                <form @submit.prevent="handleRegister" class="space-y-6">
                    <!-- Name Field -->
                    <div class="space-y-2">
                        <label for="name" class="block text-sm font-medium text-zinc-300">
                            Nome Completo
                        </label>
                        <input 
                            id="name"
                            type="text" 
                            v-model="formData.name" 
                            placeholder="Seu nome completo"
                            class="w-full px-4 py-3 bg-zinc-900 border border-zinc-800 rounded-xl text-zinc-100 placeholder-zinc-600 text-sm transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-orange-500/50 focus:border-orange-500 hover:border-zinc-700"
                            required
                        >
                    </div>

                    <!-- Email Field -->
                    <div class="space-y-2">
                        <label for="email" class="block text-sm font-medium text-zinc-300">
                            Email
                        </label>
                        <input 
                            id="email"
                            type="email" 
                            v-model="formData.email" 
                            placeholder="seu@email.com"
                            class="w-full px-4 py-3 bg-zinc-900 border border-zinc-800 rounded-xl text-zinc-100 placeholder-zinc-600 text-sm transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-orange-500/50 focus:border-orange-500 hover:border-zinc-700"
                            required
                        >
                    </div>

                    <!-- Phone Field -->
                    <div class="space-y-2">
                        <label for="phone" class="block text-sm font-medium text-zinc-300">
                            Telefone
                        </label>
                        <input 
                            id="phone"
                            type="tel" 
                            v-model="formData.phone" 
                            placeholder="(00) 00000-0000"
                            class="w-full px-4 py-3 bg-zinc-900 border border-zinc-800 rounded-xl text-zinc-100 placeholder-zinc-600 text-sm transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-orange-500/50 focus:border-orange-500 hover:border-zinc-700"
                            required
                        >
                    </div>

                    <!-- Password Field -->
                    <div class="space-y-2">
                        <label for="password" class="block text-sm font-medium text-zinc-300">
                            Senha
                        </label>
                        <input 
                            id="password"
                            type="password" 
                            v-model="formData.password" 
                            placeholder="Mínimo 8 caracteres"
                            class="w-full px-4 py-3 bg-zinc-900 border border-zinc-800 rounded-xl text-zinc-100 placeholder-zinc-600 text-sm transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-orange-500/50 focus:border-orange-500 hover:border-zinc-700"
                            required
                            minlength="8"
                        >
                    </div>

                    <!-- Password Confirmation Field -->
                    <div class="space-y-2">
                        <label for="password_confirmation" class="block text-sm font-medium text-zinc-300">
                            Confirmar Senha
                        </label>
                        <input 
                            id="password_confirmation"
                            type="password" 
                            v-model="formData.password_confirmation" 
                            placeholder="Digite a senha novamente"
                            class="w-full px-4 py-3 bg-zinc-900 border border-zinc-800 rounded-xl text-zinc-100 placeholder-zinc-600 text-sm transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-orange-500/50 focus:border-orange-500 hover:border-zinc-700"
                            required
                            minlength="8"
                        >
                    </div>

                    <!-- User Type Selection -->
                    <div class="space-y-2">
                        <label for="user_type" class="block text-sm font-medium text-zinc-300">
                            Tipo de Conta
                        </label>
                        <select 
                            id="user_type"
                            v-model="formData.user_type"
                            class="w-full px-4 py-3 bg-zinc-900 border border-zinc-800 rounded-xl text-zinc-100 text-sm transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-orange-500/50 focus:border-orange-500 hover:border-zinc-700"
                            required
                        >
                            <option value="" disabled>Selecione o tipo</option>
                            <!-- <option value="client">Cliente</option> -->
                            <option value="broker">Corretor</option>
                            <option value="agency">Imobiliária</option>
                        </select>
                    </div>

                    <!-- Terms and Conditions -->
                    <div class="flex items-start space-x-3">
                        <input 
                            id="terms"
                            type="checkbox" 
                            v-model="formData.acceptTerms"
                            class="mt-1 w-4 h-4 bg-zinc-900 border-zinc-800 rounded text-orange-500 focus:ring-2 focus:ring-orange-500/50"
                            required
                        >
                        <label for="terms" class="text-sm text-zinc-400">
                            Concordo com os 
                            <a href="#" class="text-orange-500 hover:text-orange-400 transition-colors">
                                termos de uso
                            </a> 
                            e 
                            <a href="#" class="text-orange-500 hover:text-orange-400 transition-colors">
                                política de privacidade
                            </a>
                        </label>
                    </div>

                    <!-- Error Message -->
                    <div v-if="errorMessage" class="p-3 bg-red-500/10 border border-red-500/50 rounded-xl">
                        <p class="text-sm text-red-400">{{ errorMessage }}</p>
                    </div>

                    <!-- Submit Button -->
                    <button 
                        type="submit"
                        :disabled="isLoading"
                        class="w-full py-3 bg-orange-500 hover:bg-orange-600 text-white rounded-xl text-sm font-semibold transition-all duration-200 hover:shadow-lg hover:shadow-orange-500/20 active:scale-[0.98] disabled:opacity-50 disabled:cursor-not-allowed"
                    >
                        {{ isLoading ? 'Criando conta...' : 'Criar Conta' }}
                    </button>
                </form>

                <!-- Divider -->
                <div class="relative my-6">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-zinc-800"></div>
                    </div>
                    <div class="relative flex justify-center text-xs">
                        <span class="px-2 bg-zinc-900/10 text-zinc-600">ou</span>
                    </div>
                </div>

                <!-- Login Link -->
                <div class="text-center">
                    <p class="text-sm text-zinc-500">
                        Já tem uma conta? 
                        <NuxtLink to="/" class="text-orange-500 hover:text-orange-400 font-medium transition-colors">
                            Entrar
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
const config = useRuntimeConfig()
const formData = ref({
    name: '',
    email: '',
    phone: '',
    password: '',
    password_confirmation: '',
    user_type: '',
    acceptTerms: false,
})

const isLoading = ref(false)
const errorMessage = ref('')

const handleRegister = async () => {
    // Validar se as senhas coincidem
    if (formData.value.password !== formData.value.password_confirmation) {
        errorMessage.value = 'As senhas não coincidem'
        return
    }

    isLoading.value = true
    errorMessage.value = ''

    try {
        // Aqui você fará a chamada para a API de registro
        console.log('Registrando usuário:', formData.value)
        
        const response = await $fetch(`${config.public.apiBase}/auth/register`, {
            method: 'POST',
            body: {
                name: formData.value.name,
                email: formData.value.email,
                phone: formData.value.phone,
                password: formData.value.password,
                password_confirmation: formData.value.password_confirmation,
                user_type: formData.value.user_type,
                avatar: null,
                is_active: true,
            }
        })
        console.log('Response:', response)
        
        navigateTo('/')

    } catch (error) {
        errorMessage.value = error.data?.message || 'Erro ao criar conta. Tente novamente.'
        console.error('Erro no registro:', error)
    } finally {
        isLoading.value = false
    }
}
</script>

