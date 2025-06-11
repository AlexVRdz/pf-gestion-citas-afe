<template>
    <AppLayout title="Detalles de Usuario">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Detalles de Usuario: {{ userDetail.name }}
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6"
                >
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Información del usuario -->
                        <div>
                            <h3 class="text-lg font-medium text-gray-900">
                                Información Personal
                            </h3>
                            <div class="mt-4 space-y-4">
                                <div>
                                    <label
                                        class="block text-sm font-medium text-gray-500"
                                        >Nombre completo</label
                                    >
                                    <p class="mt-1 text-sm text-gray-900">
                                        {{ userDetail.name }}
                                        {{ userDetail.apellidos }}
                                    </p>
                                </div>
                                <div>
                                    <label
                                        class="block text-sm font-medium text-gray-500"
                                        >Email</label
                                    >
                                    <p class="mt-1 text-sm text-gray-900">
                                        {{ userDetail.email }}
                                    </p>
                                </div>
                                <div>
                                    <label
                                        class="block text-sm font-medium text-gray-500"
                                        >Rol</label
                                    >
                                    <p class="mt-1 text-sm text-gray-900">
                                        <span
                                            class="px-2 py-1 rounded-full text-xs font-medium"
                                            :class="{
                                                'bg-red-100 text-red-800':
                                                    userDetail.role === 'Admin',
                                                'bg-blue-100 text-blue-800':
                                                    userDetail.role ===
                                                    'Doctor',
                                                'bg-green-100 text-green-800':
                                                    userDetail.role ===
                                                    'Secretaria',
                                            }"
                                        >
                                            {{ userDetail.role }}
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h3 class="text-lg font-medium text-gray-900">
                                Información de Contacto
                            </h3>
                            <div class="mt-4 space-y-4">
                                <div>
                                    <label
                                        class="block text-sm font-medium text-gray-500"
                                        >Teléfono</label
                                    >
                                    <p class="mt-1 text-sm text-gray-900">
                                        {{
                                            userDetail.telefono ||
                                            "No registrado"
                                        }}
                                    </p>
                                </div>
                                <div>
                                    <label
                                        class="block text-sm font-medium text-gray-500"
                                        >Dirección</label
                                    >
                                    <p class="mt-1 text-sm text-gray-900">
                                        {{
                                            userDetail.direccion ||
                                            "No registrada"
                                        }}
                                    </p>
                                </div>
                                <div>
                                    <label
                                        class="block text-sm font-medium text-gray-500"
                                        >Fecha de creación</label
                                    >
                                    <p class="mt-1 text-sm text-gray-900">
                                        {{ formatDate(userDetail.created_at) }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 flex justify-between">
                        <Link
                            :href="route('users.index')"
                            class="inline-flex items-center px-4 py-2 bg-gray-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:outline-none transition"
                        >
                            Volver
                        </Link>

                        <div>
                            <Link
                                :href="route('users.edit', userDetail.id)"
                                class="inline-flex items-center px-4 py-2 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-600 focus:outline-none transition"
                            >
                                Editar
                            </Link>
                            <button
                                @click="deleteUser"
                                :disabled="deleting"
                                class="ml-2 inline-flex items-center px-4 py-2 bg-red-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-600 focus:outline-none transition disabled:opacity-50"
                            >
                                <span v-if="deleting">Eliminando...</span>
                                <span v-else>Eliminar</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import { ref } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link, router } from "@inertiajs/vue3";

const props = defineProps({
    userDetail: Object,
});

const deleting = ref(false);

const formatDate = (dateString) => {
    const options = { year: "numeric", month: "long", day: "numeric" };
    return new Date(dateString).toLocaleDateString("es-ES", options);
};

const deleteUser = () => {
    if (confirm("¿Estás seguro de eliminar este usuario?")) {
        deleting.value = true;
        router.delete(route("users.destroy", props.userDetail.id), {
            onFinish: () => {
                deleting.value = false;
            },
        });
    }
};
</script>
