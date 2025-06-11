<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3";
import Checkbox from "@/Components/Checkbox.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: "",
    password: "",
    remember: false,
});

const submit = () => {
    form.transform((data) => ({
        ...data,
        remember: form.remember ? "on" : "",
    })).post(route("login"), {
        onFinish: () => form.reset("password"),
    });
};
</script>

<template>
    <Head title="Iniciar Sesión" />

    <div
        class="min-h-screen flex flex-col sm:justify-center items-center bg-gradient-to-br from-blue-50 to-white dark:from-gray-700 dark:to-gray-600"
    >
        <!-- Logo Container -->
        <div class="w-full sm:max-w-md px-6 py-12 flex flex-col items-center">
            <div class="flex flex-col items-center mb-8">
                <img
                    src="/images/logo/logo.jpeg"
                    alt="Logo Klinika"
                    class="w-32 h-32 object-contain rounded-full border-4 border-white shadow-lg"
                />
                <h1
                    class="mt-4 text-2xl font-bold text-blue-800 dark:text-blue-300"
                >
                    KLINIKA
                </h1>
                <p class="text-sm text-blue-600 dark:text-blue-400">
                    Sistema de Gestión de Citas Médicas
                </p>
            </div>

            <!-- Card Container -->
            <div
                class="w-full bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden sm:max-w-md"
            >
                <!-- Status Messages -->
                <div
                    v-if="status"
                    class="px-6 py-4 bg-green-100 dark:bg-green-900 text-green-700 dark:text-green-300"
                >
                    {{ status }}
                </div>

                <!-- Form Container -->
                <div class="px-8 py-10">
                    <form @submit.prevent="submit">
                        <!-- Email Field -->
                        <div class="mb-6">
                            <InputLabel
                                for="email"
                                value="Correo Electrónico"
                                class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300"
                            />
                            <TextInput
                                id="email"
                                v-model="form.email"
                                type="email"
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white transition"
                                required
                                autofocus
                                autocomplete="username"
                                placeholder="usuario@ejemplo.com"
                            />
                            <InputError
                                class="mt-2 text-sm text-red-600"
                                :message="form.errors.email"
                            />
                        </div>

                        <!-- Password Field -->
                        <div class="mb-6">
                            <InputLabel
                                for="password"
                                value="Contraseña"
                                class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300"
                            />
                            <TextInput
                                id="password"
                                v-model="form.password"
                                type="password"
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white transition"
                                required
                                autocomplete="current-password"
                                placeholder="••••••••"
                            />
                            <InputError
                                class="mt-2 text-sm text-red-600"
                                :message="form.errors.password"
                            />
                        </div>

                        <!-- Remember Me & Forgot Password -->
                        <div class="flex items-center justify-between mb-6">
                            <label class="flex items-center">
                                <Checkbox
                                    v-model:checked="form.remember"
                                    name="remember"
                                    class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700"
                                />
                                <span
                                    class="ms-2 text-sm text-gray-600 dark:text-gray-400"
                                    >Recordar sesión</span
                                >
                            </label>

                            <Link
                                v-if="canResetPassword"
                                :href="route('password.request')"
                                class="text-sm text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 transition"
                            >
                                ¿Olvidaste tu contraseña?
                            </Link>
                        </div>

                        <!-- Submit Button -->
                        <div>
                            <PrimaryButton
                                class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition"
                                :class="{
                                    'opacity-50 cursor-not-allowed':
                                        form.processing,
                                }"
                                :disabled="form.processing"
                            >
                                <span v-if="!form.processing"
                                    >Iniciar Sesión</span
                                >
                                <span v-else class="flex items-center">
                                    <svg
                                        class="animate-spin -ml-1 mr-2 h-4 w-4 text-white"
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                    >
                                        <circle
                                            class="opacity-25"
                                            cx="12"
                                            cy="12"
                                            r="10"
                                            stroke="currentColor"
                                            stroke-width="4"
                                        ></circle>
                                        <path
                                            class="opacity-75"
                                            fill="currentColor"
                                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
                                        ></path>
                                    </svg>
                                    Procesando...
                                </span>
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Footer -->
            <div
                class="mt-8 text-center text-sm text-gray-500 dark:text-gray-400"
            >
                © {{ new Date().getFullYear() }} Klinika. Todos los derechos
                reservados.
            </div>
        </div>
    </div>
</template>
