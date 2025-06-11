<template>
    <AppLayout title="Editar Usuario">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Editar Usuario: {{ userDetail.name }}
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
                                    >Nombre *</label
                                >
                                <input
                                    v-model="form.name"
                                    type="text"
                                    id="name"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                />
                                <p
                                    v-if="form.errors.name"
                                    class="mt-2 text-sm text-red-600"
                                >
                                    {{ form.errors.name }}
                                </p>
                            </div>

                            <!-- Apellidos -->
                            <div>
                                <label
                                    for="apellidos"
                                    class="block text-sm font-medium text-gray-700"
                                    >Apellidos *</label
                                >
                                <input
                                    v-model="form.apellidos"
                                    type="text"
                                    id="apellidos"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                />
                                <p
                                    v-if="form.errors.apellidos"
                                    class="mt-2 text-sm text-red-600"
                                >
                                    {{ form.errors.apellidos }}
                                </p>
                            </div>

                            <!-- Email -->
                            <div>
                                <label
                                    for="email"
                                    class="block text-sm font-medium text-gray-700"
                                    >Email *</label
                                >
                                <input
                                    v-model="form.email"
                                    type="email"
                                    id="email"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                />
                                <p
                                    v-if="form.errors.email"
                                    class="mt-2 text-sm text-red-600"
                                >
                                    {{ form.errors.email }}
                                </p>
                            </div>

                            <!-- Rol -->
                            <div>
                                <label
                                    for="role"
                                    class="block text-sm font-medium text-gray-700"
                                    >Rol *</label
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
                                    v-if="form.errors.role"
                                    class="mt-2 text-sm text-red-600"
                                >
                                    {{ form.errors.role }}
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
                                    v-if="form.errors.telefono"
                                    class="mt-2 text-sm text-red-600"
                                >
                                    {{ form.errors.telefono }}
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
                                    v-if="form.errors.direccion"
                                    class="mt-2 text-sm text-red-600"
                                >
                                    {{ form.errors.direccion }}
                                </p>
                            </div>
                        </div>

                        <!-- Campo de contraseña opcional -->
                        <div class="mt-6">
                            <label
                                for="password"
                                class="block text-sm font-medium text-gray-700"
                            >
                                Cambiar contraseña (dejar vacío para mantener
                                actual)
                            </label>
                            <input
                                v-model="form.password"
                                type="password"
                                id="password"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            />
                            <p
                                v-if="form.errors.password"
                                class="mt-2 text-sm text-red-600"
                            >
                                {{ form.errors.password }}
                            </p>
                        </div>

                        <div class="mt-6 flex justify-between">
                            <button
                                type="submit"
                                :disabled="form.processing"
                                class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring focus:ring-blue-300 disabled:opacity-25 transition"
                            >
                                <span v-if="form.processing"
                                    >Actualizando...</span
                                >
                                <span v-else>Actualizar Usuario</span>
                            </button>

                            <Link
                                :href="route('users.index')"
                                class="inline-flex items-center px-4 py-2 bg-gray-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition"
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

const props = defineProps({
    userDetail: Object,
    errors: Object,
});

const form = useForm({
    name: props.userDetail.name,
    apellidos: props.userDetail.apellidos,
    email: props.userDetail.email,
    role: props.userDetail.role,
    telefono: props.userDetail.telefono || "",
    direccion: props.userDetail.direccion || "",
    password: "",
});

const submit = () => {
    form.put(route("users.update", props.userDetail.id), {
        preserveScroll: true,
        onFinish: () => {
            // No necesitamos hacer nada aquí, Inertia maneja la redirección automáticamente
        },
    });
};
</script>
