<template>
    <AppLayout title="Editar Cita">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Editar Cita #{{ cita.id }}
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6"
                >
                    <form @submit.prevent="submit">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Paciente -->
                            <div>
                                <label
                                    for="paciente_id"
                                    class="block text-sm font-medium text-gray-700"
                                >
                                    Paciente *
                                </label>
                                <select
                                    id="paciente_id"
                                    v-model="form.paciente_id"
                                    required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                >
                                    <option
                                        v-for="paciente in pacientes"
                                        :key="paciente.id"
                                        :value="paciente.id"
                                        :selected="
                                            paciente.id === form.paciente_id
                                        "
                                    >
                                        {{ paciente.nombre }}
                                    </option>
                                </select>
                            </div>

                            <!-- Médico -->
                            <div>
                                <label
                                    for="medico_id"
                                    class="block text-sm font-medium text-gray-700"
                                >
                                    Médico *
                                </label>
                                <select
                                    id="medico_id"
                                    v-model="form.medico_id"
                                    required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                >
                                    <option
                                        v-for="medico in medicos"
                                        :key="medico.id"
                                        :value="medico.id"
                                    >
                                        {{ medico.user.name }}
                                        {{ medico.user.apellidos }} -
                                        {{ medico.especialidad }}
                                    </option>
                                </select>
                            </div>

                            <!-- Fecha y Hora -->
                            <div>
                                <label
                                    for="fecha_hora"
                                    class="block text-sm font-medium text-gray-700"
                                >
                                    Fecha y Hora *
                                </label>
                                <input
                                    type="datetime-local"
                                    id="fecha_hora"
                                    v-model="form.fecha_hora"
                                    required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                />
                            </div>

                            <!-- Estado -->
                            <div>
                                <label
                                    for="estado_id"
                                    class="block text-sm font-medium text-gray-700"
                                >
                                    Estado *
                                </label>
                                <select
                                    id="estado_id"
                                    v-model="form.estado_id"
                                    required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                >
                                    <option
                                        v-for="estado in estados"
                                        :key="estado.id"
                                        :value="estado.id"
                                        :selected="estado.id === form.estado_id"
                                    >
                                        {{ estado.nombre }}
                                    </option>
                                </select>
                            </div>

                            <!-- Tipo de Pago -->
                            <div>
                                <label
                                    for="tipo_pago_id"
                                    class="block text-sm font-medium text-gray-700"
                                >
                                    Tipo de Pago
                                </label>
                                <select
                                    id="tipo_pago_id"
                                    v-model="form.tipo_pago_id"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                >
                                    <option value="">Ninguno</option>
                                    <option
                                        v-for="tipoPago in tiposPago"
                                        :key="tipoPago.id"
                                        :value="tipoPago.id"
                                        :selected="
                                            tipoPago.id === form.tipo_pago_id
                                        "
                                    >
                                        {{ tipoPago.nombre }}
                                    </option>
                                </select>
                            </div>

                            <!-- Costo -->
                            <div>
                                <label
                                    for="costo"
                                    class="block text-sm font-medium text-gray-700"
                                >
                                    Costo (USD)
                                </label>
                                <input
                                    type="number"
                                    step="0.01"
                                    id="costo"
                                    v-model="form.costo"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                />
                            </div>

                            <!-- Motivo -->
                            <div class="md:col-span-2">
                                <label
                                    for="motivo"
                                    class="block text-sm font-medium text-gray-700"
                                >
                                    Motivo *
                                </label>
                                <input
                                    type="text"
                                    id="motivo"
                                    v-model="form.motivo"
                                    required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                />
                            </div>

                            <!-- Observaciones -->
                            <div class="md:col-span-2">
                                <label
                                    for="observaciones"
                                    class="block text-sm font-medium text-gray-700"
                                >
                                    Observaciones
                                </label>
                                <textarea
                                    id="observaciones"
                                    v-model="form.observaciones"
                                    rows="3"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                ></textarea>
                            </div>
                        </div>

                        <div
                            class="flex items-center justify-between pt-6 border-t border-gray-200"
                        >
                            <button
                                type="submit"
                                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                            >
                                Actualizar Cita
                            </button>
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
import { reactive } from "vue";
import { router } from "@inertiajs/vue3";
import { Link } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";

const props = defineProps({
    cita: Object,
    pacientes: Array,
    medicos: Array,
    estados: Array,
    tiposPago: Array,
});

const form = reactive({
    paciente_id: props.cita.paciente_id,
    medico_id: props.cita.medico_id,
    fecha_hora: props.cita.fecha_hora,
    motivo: props.cita.motivo,
    estado_id: props.cita.estado_id,
    tipo_pago_id: props.cita.tipo_pago_id,
    costo: props.cita.costo,
    observaciones: props.cita.observaciones,
});

const submit = () => {
    router.put(route("citas.update", props.cita.id), form);
};
</script>
