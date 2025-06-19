<template>
    <AppLayout title="Detalles del Tipo de Contrato">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Detalles del Tipo de Contrato
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <!-- Header -->
                    <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                        <div class="flex justify-between items-center">
                            <div>
                                <h3 class="text-lg font-medium text-gray-900">
                                    {{ tipoContrato?.nombre || "Cargando..." }}
                                </h3>
                                <p class="text-sm text-gray-600">
                                    Usuario: {{ user?.name || "" }}
                                    {{ user?.apellidos || "" }}
                                </p>
                                <p class="text-sm text-gray-600">
                                    Hora actual: {{ currentTime }}
                                </p>
                            </div>
                            <div class="flex gap-3">
                                <Link
                                    v-if="tipoContrato?.id"
                                    :href="route('tipo-contratos.edit', tipoContrato.id)"
                                    class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded flex items-center gap-2"
                                >
                                    ✏️ Editar
                                </Link>
                                <Link
                                    :href="route('tipo-contratos.index')"
                                    class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded flex items-center gap-2"
                                >
                                    ← Volver
                                </Link>
                            </div>
                        </div>
                    </div>

                    <!-- Información General -->
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Nombre del contrato
                                    </label>
                                    <div class="p-3 bg-gray-50 rounded-md">
                                        <p class="text-sm text-gray-900">
                                            {{ tipoContrato?.nombre || "N/A" }}
                                        </p>
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Descripción
                                    </label>
                                    <div class="p-3 bg-gray-50 rounded-md">
                                        <p class="text-sm text-gray-900">
                                            {{ tipoContrato?.descripcion || "Sin descripción" }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Salario mensual (USD)
                                    </label>
                                    <div class="p-3 bg-gray-50 rounded-md">
                                        <p class="text-sm text-gray-900">
                                            ${{ Number(tipoContrato?.salario).toFixed(2) || "0.00" }}
                                        </p>
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Fecha de Creación
                                    </label>
                                    <div class="p-3 bg-gray-50 rounded-md">
                                        <p class="text-sm text-gray-900">
                                            {{ tipoContrato?.created_at ? formatDate(tipoContrato.created_at) : "N/A" }}
                                        </p>
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Última Actualización
                                    </label>
                                    <div class="p-3 bg-gray-50 rounded-md">
                                        <p class="text-sm text-gray-900">
                                            {{ tipoContrato?.updated_at ? formatDate(tipoContrato.updated_at) : "N/A" }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Acciones de Eliminación -->
                    <div class="px-6 py-4 bg-red-50 border-t border-red-200">
                        <h4 class="text-md font-medium text-red-900 mb-2">Zona de Peligro</h4>
                        <p class="text-sm text-red-700 mb-4">
                            Una vez eliminado, este tipo de contrato no podrá ser recuperado.
                        </p>
                        <button
                            @click="deleteTipoContrato"
                            :disabled="deleting"
                            class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded disabled:opacity-50 flex items-center gap-2"
                        >
                            🗑
                            <span v-if="deleting">Eliminando...</span>
                            <span v-else>Eliminar Tipo de Contrato</span>
                        </button>
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

const props = defineProps({
    tipoContrato: {
        type: Object,
        default: () => ({}),
    },
    user: {
        type: Object,
        default: () => ({}),
    },
});

const currentTime = ref("");
const deleting = ref(false);

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
    if (!dateString) return "N/A";
    try {
        return new Date(dateString).toLocaleString("es-ES", {
            year: "numeric",
            month: "long",
            day: "numeric",
            hour: "2-digit",
            minute: "2-digit",
        });
    } catch (error) {
        console.error("Error formateando fecha:", error);
        return "Fecha inválida";
    }
};

const deleteTipoContrato = () => {
    if (!props.tipoContrato?.id) {
        alert("Error: No se puede eliminar, ID no encontrado");
        return;
    }

    if (confirm("¿Estás seguro de eliminar este tipo de contrato?")) {
        deleting.value = true;

        router.delete(route("tipo-contratos.destroy", props.tipoContrato.id), {
            onFinish: () => {
                deleting.value = false;
            },
            onError: (errors) => {
                console.error("Error eliminando:", errors);
                alert("Error al eliminar el tipo de contrato");
            },
        });
    }
};

onMounted(() => {
    updateTime();
    setInterval(updateTime, 1000);
});
</script>
