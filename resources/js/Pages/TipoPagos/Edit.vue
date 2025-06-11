<template>
    <AppLayout title="Editar Método de Pago">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Editar Método de Pago
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6"
                >
                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900">
                            Editando: {{ tipoPago.nombre }}
                        </h3>
                        <p class="text-sm text-gray-600">
                            Usuario: {{ user.name }} {{ user.apellidos }}
                        </p>
                        <p class="text-sm text-gray-600">
                            Hora actual: {{ currentTime }}
                        </p>
                        <!-- <p class="text-xs text-gray-500 mt-1">
                            ID: #{{ tipoPago.id }} | Creado el:
                            {{ formatDate(tipoPago.created_at) }}
                        </p> -->
                    </div>

                    <form @submit.prevent="submit" class="space-y-6">
                        <div>
                            <label
                                for="nombre"
                                class="block text-sm font-medium text-gray-700"
                            >
                                Nombre del Método de Pago
                            </label>
                            <input
                                id="nombre"
                                v-model="form.nombre"
                                type="text"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                :class="{ 'border-red-300': errors.nombre }"
                                placeholder="Ej: Efectivo, Tarjeta de Crédito, Transferencia"
                                maxlength="50"
                                required
                            />
                            <div
                                v-if="errors.nombre"
                                class="mt-2 text-sm text-red-600"
                            >
                                {{ errors.nombre }}
                            </div>
                            <p class="mt-1 text-xs text-gray-500">
                                {{ form.nombre ? form.nombre.length : 0 }}/50
                                caracteres
                            </p>
                        </div>

                        <div>
                            <label
                                for="descripcion"
                                class="block text-sm font-medium text-gray-700"
                            >
                                Descripción (Opcional)
                            </label>
                            <textarea
                                id="descripcion"
                                v-model="form.descripcion"
                                rows="3"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                :class="{
                                    'border-red-300': errors.descripcion,
                                }"
                                placeholder="Descripción adicional del método de pago..."
                                maxlength="255"
                            ></textarea>
                            <div
                                v-if="errors.descripcion"
                                class="mt-2 text-sm text-red-600"
                            >
                                {{ errors.descripcion }}
                            </div>
                            <p class="mt-1 text-xs text-gray-500">
                                {{
                                    form.descripcion
                                        ? form.descripcion.length
                                        : 0
                                }}/255 caracteres
                            </p>
                        </div>

                        <!-- Información adicional -->
                        <div class="bg-blue-50 p-4 rounded-md">
                            <div class="flex">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5 text-blue-400"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                                    />
                                </svg>
                                <div class="ml-3">
                                    <h4
                                        class="text-sm font-medium text-blue-800"
                                    >
                                        Información del registro
                                    </h4>
                                    <div class="mt-2 text-sm text-blue-700">
                                        <p>
                                            Creado el:
                                            {{
                                                formatDate(tipoPago.created_at)
                                            }}
                                        </p>
                                        <p>
                                            Última actualización:
                                            {{
                                                formatDate(tipoPago.updated_at)
                                            }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div
                            class="flex items-center justify-between pt-6 border-t border-gray-200"
                        >
                            <div class="flex gap-3">
                                <Link
                                    :href="route('tipo-pagos.index')"
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
                                    Cancelar
                                </Link>

                                <Link
                                    :href="
                                        route('tipo-pagos.show', tipoPago.id)
                                    "
                                    class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded flex items-center gap-2"
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
                                            d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"
                                        />
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"
                                        />
                                    </svg>
                                    Ver Detalles
                                </Link>
                            </div>

                            <button
                                type="submit"
                                :disabled="form.processing || !hasChanges"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded flex items-center gap-2 disabled:opacity-50 disabled:cursor-not-allowed"
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
                                        d="M5 13l4 4L19 7"
                                    />
                                </svg>
                                <span v-if="form.processing"
                                    >Actualizando...</span
                                >
                                <span v-else-if="!hasChanges">Sin cambios</span>
                                <span v-else>Actualizar</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import { ref, computed, onMounted } from "vue";
import { useForm } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    tipoPago: Object,
    user: Object,
    errors: Object,
});

const currentTime = ref("");

const form = useForm({
    nombre: props.tipoPago.nombre,
    descripcion: props.tipoPago.descripcion || "",
});

const hasChanges = computed(() => {
    return (
        form.nombre !== props.tipoPago.nombre ||
        form.descripcion !== (props.tipoPago.descripcion || "")
    );
});

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
    return new Date(dateString).toLocaleString("es-ES", {
        year: "numeric",
        month: "long",
        day: "numeric",
        hour: "2-digit",
        minute: "2-digit",
    });
};

const submit = () => {
    form.put(route("tipo-pagos.update", props.tipoPago.id));
};

onMounted(() => {
    updateTime();
    setInterval(updateTime, 1000);
});
</script>
