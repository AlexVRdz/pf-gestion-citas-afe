<template>
    <AppLayout title="Detalles de Cita">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Detalles de Cita
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <!-- Header -->
                    <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                        <div class="flex justify-between items-center">
                            <div>
                                <h3 class="text-lg font-medium text-gray-900">
                                    Cita #{{ cita?.id || "Cargando..." }}
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
                                    v-if="cita?.id"
                                    :href="route('citas.edit', cita.id)"
                                    class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded flex items-center gap-2"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10"
                                        />
                                    </svg>
                                    Editar
                                </Link>
                                <Link
                                    :href="route('citas.index')"
                                    class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded flex items-center gap-2"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M10 19l-7-7m0 0l7-7m-7 7h18"
                                        />
                                    </svg>
                                    Volver
                                </Link>
                            </div>
                        </div>
                    </div>

                    <!-- Información General -->
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Columna Izquierda -->
                            <div class="space-y-4">
                                <div>
                                    <label
                                        class="block text-sm font-medium text-gray-700 mb-2"
                                    >
                                        Paciente
                                    </label>
                                    <div class="p-3 bg-gray-50 rounded-md">
                                        <p
                                            class="text-sm text-gray-900 font-medium"
                                        >
                                            {{
                                                cita?.paciente?.nombre || "N/A"
                                            }}
                                        </p>
                                        <p class="text-xs text-gray-600">
                                            {{ cita?.paciente?.email || "" }}
                                        </p>
                                        <p class="text-xs text-gray-600">
                                            {{ cita?.paciente?.telefono || "" }}
                                        </p>
                                    </div>
                                </div>

                                <div>
                                    <label
                                        class="block text-sm font-medium text-gray-700 mb-2"
                                    >
                                        Médico
                                    </label>
                                    <div class="p-3 bg-gray-50 rounded-md">
                                        <p
                                            class="text-sm text-gray-900 font-medium"
                                        >
                                            {{ getMedicoName() }}
                                        </p>
                                        <p class="text-xs text-gray-600">
                                            Especialidad:
                                            {{
                                                cita?.medico?.especialidad ||
                                                "N/A"
                                            }}
                                        </p>
                                        <p class="text-xs text-gray-600">
                                            {{
                                                cita?.medico?.user?.email || ""
                                            }}
                                        </p>
                                    </div>
                                </div>

                                <div>
                                    <label
                                        class="block text-sm font-medium text-gray-700 mb-2"
                                    >
                                        Fecha y Hora
                                    </label>
                                    <div class="p-3 bg-gray-50 rounded-md">
                                        <p
                                            class="text-sm text-gray-900 font-medium"
                                        >
                                            {{
                                                cita?.fecha_hora
                                                    ? formatDateTime(
                                                          cita.fecha_hora
                                                      )
                                                    : "N/A"
                                            }}
                                        </p>
                                    </div>
                                </div>

                                <div>
                                    <label
                                        class="block text-sm font-medium text-gray-700 mb-2"
                                    >
                                        Estado
                                    </label>
                                    <div class="p-3 bg-gray-50 rounded-md">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium"
                                            :class="getEstadoClass()"
                                        >
                                            {{ cita?.estado?.nombre || "N/A" }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Columna Derecha -->
                            <div class="space-y-4">
                                <div>
                                    <label
                                        class="block text-sm font-medium text-gray-700 mb-2"
                                    >
                                        Motivo de la Cita
                                    </label>
                                    <div class="p-3 bg-gray-50 rounded-md">
                                        <p class="text-sm text-gray-900">
                                            {{ cita?.motivo || "N/A" }}
                                        </p>
                                    </div>
                                </div>

                                <div>
                                    <label
                                        class="block text-sm font-medium text-gray-700 mb-2"
                                    >
                                        Tipo de Pago
                                    </label>
                                    <div class="p-3 bg-gray-50 rounded-md">
                                        <p class="text-sm text-gray-900">
                                            {{
                                                cita?.tipo_pago?.nombre ||
                                                "No especificado"
                                            }}
                                        </p>
                                    </div>
                                </div>

                                <div>
                                    <label
                                        class="block text-sm font-medium text-gray-700 mb-2"
                                    >
                                        Costo
                                    </label>
                                    <div class="p-3 bg-gray-50 rounded-md">
                                        <p
                                            class="text-sm text-gray-900 font-medium"
                                        >
                                            {{ formatCurrency(cita?.costo) }}
                                        </p>
                                    </div>
                                </div>

                                <div>
                                    <label
                                        class="block text-sm font-medium text-gray-700 mb-2"
                                    >
                                        Observaciones
                                    </label>
                                    <div class="p-3 bg-gray-50 rounded-md">
                                        <p class="text-sm text-gray-900">
                                            {{
                                                cita?.observaciones ||
                                                "Sin observaciones"
                                            }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Información de Fechas del Sistema -->
                    <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                        <h4 class="text-md font-medium text-gray-900 mb-4">
                            Información del Sistema
                        </h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label
                                    class="block text-sm font-medium text-gray-700 mb-2"
                                >
                                    Fecha de Creación
                                </label>
                                <div class="p-3 bg-white rounded-md">
                                    <p class="text-sm text-gray-900">
                                        {{
                                            cita?.created_at
                                                ? formatDate(cita.created_at)
                                                : "N/A"
                                        }}
                                    </p>
                                </div>
                            </div>

                            <div>
                                <label
                                    class="block text-sm font-medium text-gray-700 mb-2"
                                >
                                    Última Actualización
                                </label>
                                <div class="p-3 bg-white rounded-md">
                                    <p class="text-sm text-gray-900">
                                        {{
                                            cita?.updated_at
                                                ? formatDate(cita.updated_at)
                                                : "N/A"
                                        }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Estadísticas -->
                    <div class="px-6 py-4 bg-blue-50 border-t border-blue-200">
                        <h4 class="text-md font-medium text-blue-900 mb-4">
                            Información Rápida
                        </h4>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="bg-white p-4 rounded-lg shadow">
                                <div class="flex items-center">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-8 w-8 text-blue-500"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                                        />
                                    </svg>
                                    <div class="ml-3">
                                        <p
                                            class="text-sm font-medium text-gray-900"
                                        >
                                            ID Paciente
                                        </p>
                                        <p
                                            class="text-lg font-bold text-blue-600"
                                        >
                                            #{{ cita?.paciente_id || "N/A" }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-white p-4 rounded-lg shadow">
                                <div class="flex items-center">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-8 w-8 text-green-500"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                                        />
                                    </svg>
                                    <div class="ml-3">
                                        <p
                                            class="text-sm font-medium text-gray-900"
                                        >
                                            ID Médico
                                        </p>
                                        <p
                                            class="text-lg font-bold text-green-600"
                                        >
                                            #{{ cita?.medico_id || "N/A" }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-white p-4 rounded-lg shadow">
                                <div class="flex items-center">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-8 w-8 text-purple-500"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"
                                        />
                                    </svg>
                                    <div class="ml-3">
                                        <p
                                            class="text-sm font-medium text-gray-900"
                                        >
                                            ID Cita
                                        </p>
                                        <p
                                            class="text-lg font-bold text-purple-600"
                                        >
                                            #{{ cita?.id || "N/A" }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Acciones de Eliminación -->
                    <div class="px-6 py-4 bg-red-50 border-t border-red-200">
                        <h4 class="text-md font-medium text-red-900 mb-2">
                            Zona de Peligro
                        </h4>
                        <p class="text-sm text-red-700 mb-4">
                            Una vez eliminada, esta cita no podrá ser
                            recuperada.
                        </p>
                        <button
                            @click="deleteCita"
                            :disabled="deleting"
                            class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded disabled:opacity-50 disabled:cursor-not-allowed flex items-center gap-2"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"
                                />
                            </svg>
                            <span v-if="deleting">Eliminando...</span>
                            <span v-else>Eliminar Cita</span>
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

// Props con valores por defecto
const props = defineProps({
    cita: {
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

const formatDateTime = (dateString) => {
    if (!dateString) return "N/A";
    try {
        return new Date(dateString).toLocaleString("es-ES", {
            weekday: "long",
            year: "numeric",
            month: "long",
            day: "numeric",
            hour: "2-digit",
            minute: "2-digit",
        });
    } catch (error) {
        console.error("Error formateando fecha y hora:", error);
        return "Fecha inválida";
    }
};

const formatCurrency = (amount) => {
    if (!amount || amount === 0) return "Sin costo";
    try {
        return new Intl.NumberFormat("es-ES", {
            style: "currency",
            currency: "US", // Moneda local
        }).format(amount);
    } catch (error) {
        return `$${amount}`;
    }
};

const getMedicoName = () => {
    if (props.cita?.medico?.user) {
        return `Dr. ${props.cita.medico.user.name} ${
            props.cita.medico.user.apellidos || ""
        }`.trim();
    }
    return "N/A";
};

const getEstadoClass = () => {
    const estado = props.cita?.estado?.nombre?.toLowerCase();

    switch (estado) {
        case "confirmada":
        case "programada":
            return "bg-green-100 text-green-800";
        case "pendiente":
            return "bg-yellow-100 text-yellow-800";
        case "cancelada":
            return "bg-red-100 text-red-800";
        case "completada":
        case "finalizada":
            return "bg-blue-100 text-blue-800";
        default:
            return "bg-gray-100 text-gray-800";
    }
};

const deleteCita = () => {
    if (!props.cita?.id) {
        alert("Error: No se puede eliminar, ID no encontrado");
        return;
    }

    if (confirm("¿Estás seguro de eliminar esta cita?")) {
        deleting.value = true;

        router.delete(route("citas.destroy", props.cita.id), {
            onFinish: () => {
                deleting.value = false;
            },
            onError: (errors) => {
                console.error("Error eliminando:", errors);
                alert("Error al eliminar la cita");
            },
        });
    }
};

onMounted(() => {
    updateTime();
    setInterval(updateTime, 1000);

    // Debug: verificar que los datos lleguen correctamente
    console.log("Props recibidas:", props);
    console.log("Cita:", props.cita);
    console.log("Usuario:", props.user);
});
</script>
