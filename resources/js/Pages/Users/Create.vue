<template>
    <AppLayout title="Crear Usuario">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Crear Nuevo Usuario
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6"
                >
                    <form @submit.prevent="submit">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Nombre -->
                            <div>
                                <label
                                    for="name"
                                    class="block text-sm font-medium text-gray-700"
                                    >Nombre</label
                                >
                                <input
                                    v-model="form.name"
                                    type="text"
                                    id="name"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                />
                                <p
                                    v-if="errors.name"
                                    class="mt-2 text-sm text-red-600"
                                >
                                    {{ errors.name }}
                                </p>
                            </div>

                            <!-- Apellidos -->
                            <div>
                                <label
                                    for="apellidos"
                                    class="block text-sm font-medium text-gray-700"
                                    >Apellidos</label
                                >
                                <input
                                    v-model="form.apellidos"
                                    type="text"
                                    id="apellidos"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                />
                                <p
                                    v-if="errors.apellidos"
                                    class="mt-2 text-sm text-red-600"
                                >
                                    {{ errors.apellidos }}
                                </p>
                            </div>

                            <!-- Email -->
                            <div>
                                <label
                                    for="email"
                                    class="block text-sm font-medium text-gray-700"
                                    >Email</label
                                >
                                <input
                                    v-model="form.email"
                                    type="email"
                                    id="email"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                />
                                <p
                                    v-if="errors.email"
                                    class="mt-2 text-sm text-red-600"
                                >
                                    {{ errors.email }}
                                </p>
                            </div>

                            <!-- Contraseña -->
                            <div>
                                <label
                                    for="password"
                                    class="block text-sm font-medium text-gray-700"
                                    >Contraseña</label
                                >
                                <input
                                    v-model="form.password"
                                    type="password"
                                    id="password"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                />
                                <p
                                    v-if="errors.password"
                                    class="mt-2 text-sm text-red-600"
                                >
                                    {{ errors.password }}
                                </p>
                            </div>

                            <!-- Confirmar Contraseña -->
                            <div>
                                <label
                                    for="password_confirmation"
                                    class="block text-sm font-medium text-gray-700"
                                    >Confirmar Contraseña</label
                                >
                                <input
                                    v-model="form.password_confirmation"
                                    type="password"
                                    id="password_confirmation"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                />
                            </div>

                            <!-- Rol -->
                            <div>
                                <label
                                    for="role"
                                    class="block text-sm font-medium text-gray-700"
                                    >Rol</label
                                >
                                <select
                                    v-model="form.role"
                                    id="role"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                >
                                    <option value="Admin">Admin</option>
                                    <option value="Doctor">Doctor</option>
                                    <option value="Secretaria">
                                        Secretaria
                                    </option>
                                </select>
                                <p
                                    v-if="errors.role"
                                    class="mt-2 text-sm text-red-600"
                                >
                                    {{ errors.role }}
                                </p>
                            </div>

                            <!-- Teléfono -->
                            <div>
                                <label
                                    for="telefono"
                                    class="block text-sm font-medium text-gray-700"
                                    >Teléfono</label
                                >
                                <input
                                    v-model="form.telefono"
                                    type="text"
                                    id="telefono"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                />
                                <p
                                    v-if="errors.telefono"
                                    class="mt-2 text-sm text-red-600"
                                >
                                    {{ errors.telefono }}
                                </p>
                            </div>

                            <!-- Dirección -->
                            <div>
                                <label
                                    for="direccion"
                                    class="block text-sm font-medium text-gray-700"
                                    >Dirección</label
                                >
                                <input
                                    v-model="form.direccion"
                                    type="text"
                                    id="direccion"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                />
                                <p
                                    v-if="errors.direccion"
                                    class="mt-2 text-sm text-red-600"
                                >
                                    {{ errors.direccion }}
                                </p>
                            </div>
                        </div>

                        <div class="mt-6">
                            <button
                                type="submit"
                                :disabled="form.processing"
                                class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring focus:ring-blue-300 disabled:opacity-25 transition"
                            >
                                Guardar
                            </button>
                            <Link
                                :href="route('users.index')"
                                class="ml-4 inline-flex items-center px-4 py-2 bg-gray-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition"
                            >
                                Cancelar
                            </Link>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { useForm } from "@inertiajs/vue3";
import { Link } from "@inertiajs/vue3";

const form = useForm({
    name: "",
    apellidos: "",
    email: "",
    password: "",
    password_confirmation: "",
    role: "Secretaria",
    telefono: "",
    direccion: "",
});

defineProps({
    errors: Object,
});

const submit = () => {
    form.post(route("users.store"), {
        onSuccess: () => {
            alert("Usuario creado exitosamente");
        },
        onError: (errors) => {
            let errorMessage = "Errores en el formulario:\n";
            for (const field in errors) {
                errorMessage += `- ${errors[field]}\n`;
            }
            alert(errorMessage);
        },
    });
};
</script>
