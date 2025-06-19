<template>
    <AppLayout title="Gestión de Tipos de Contrato">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Gestión de Tipos de Contrato
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <div class="mb-6 flex justify-between items-center">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900">
                                Estás en la vista: Gestión de Tipos de Contrato
                            </h3>
                            <p class="text-sm text-gray-600">
                                Usuario: {{ user.name }} {{ user.apellidos }}
                            </p>
                            <p class="text-sm text-gray-600">
                                Hora actual: {{ currentTime }}
                            </p>
                        </div>
                        <Link
                            :href="route('tipo-contratos.create')"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded flex items-center gap-2"
                        >
                            ➕ Crear Tipo de Contrato
                        </Link>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Descripción</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Salario</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Creación</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr v-for="tipoContrato in tiposContrato.data" :key="tipoContrato.id">
                                    <td class="px-6 py-4 text-sm text-gray-900">{{ tipoContrato.nombre }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-900">{{ tipoContrato.descripcion || 'Sin descripción' }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-900">${{ Number(tipoContrato.salario).toFixed(2) }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-900">{{ formatDate(tipoContrato.created_at) }}</td>
                                    <td class="px-6 py-4 text-sm font-medium flex gap-3">
                                        <Link :href="route('tipo-contratos.show', tipoContrato.id)" class="text-indigo-600 hover:text-indigo-900">👁 Ver</Link>
                                        <Link :href="route('tipo-contratos.edit', tipoContrato.id)" class="text-yellow-600 hover:text-yellow-900">✏️ Editar</Link>
                                        <button
                                            @click="deleteTipoContrato(tipoContrato.id)"
                                            :disabled="deletingTipoContratos.includes(tipoContrato.id)"
                                            class="text-red-600 hover:text-red-900 disabled:opacity-50"
                                        >
                                            <span v-if="deletingTipoContratos.includes(tipoContrato.id)">🕑 Eliminando...</span>
                                            <span v-else>🗑 Eliminar</span>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import { ref, onMounted } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link, router } from "@inertiajs/vue3";

defineProps({
    tiposContrato: Object,
    user: Object,
});

const currentTime = ref("");
const deletingTipoContratos = ref([]);

const updateTime = () => {
    const now = new Date();
    currentTime.value = now.toLocaleString("es-ES", {
        year: "numeric",
        month: "long",
        day: "numeric",
        hour: "2-digit",
        minute: "2-digit",
        second: "2-digit",
    });
};

const formatDate = (dateString) => {
    return new Date(dateString).toLocaleDateString("es-ES", {
        year: "numeric",
        month: "long",
        day: "numeric",
    });
};

const deleteTipoContrato = (id) => {
    if (confirm("¿Estás seguro de eliminar este tipo de contrato?")) {
        deletingTipoContratos.value.push(id);

        router.delete(route("tipo-contratos.destroy", id), {
            onFinish: () => {
                deletingTipoContratos.value = deletingTipoContratos.value.filter(
                    (tipoContratoId) => tipoContratoId !== id
                );
            },
        });
    }
};

onMounted(() => {
    updateTime();
    setInterval(updateTime, 1000);
});
</script>
