<template>
    <AppLayout title="Editar Historial Médico">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Editar Historial Médico
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white p-6 rounded shadow">
                    <form @submit.prevent="submit">
                        <div class="mb-4">
                            <label class="block text-gray-700">Paciente</label>
                            <input type="text" v-model="form.paciente_id" disabled class="w-full border-gray-300 rounded bg-gray-100" />
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700">Tipo de Enfermedad</label>
                            <input type="text" v-model="form.tipo_enfermedad_id" class="w-full border-gray-300 rounded" />
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700">Diagnóstico</label>
                            <textarea v-model="form.diagnostico" class="w-full border-gray-300 rounded"></textarea>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700">Tratamiento</label>
                            <textarea v-model="form.tratamiento" class="w-full border-gray-300 rounded"></textarea>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700">Fecha de diagnóstico</label>
                            <input type="date" v-model="form.fecha_diagnostico" class="w-full border-gray-300 rounded" />
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700">Observaciones</label>
                            <textarea v-model="form.observaciones" class="w-full border-gray-300 rounded"></textarea>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                                Guardar Cambios
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import { defineProps } from 'vue';

const props = defineProps({
    historial: Object,
});

const form = useForm({
    paciente_id: props.historial.paciente_id,
    tipo_enfermedad_id: props.historial.tipo_enfermedad_id,
    diagnostico: props.historial.diagnostico,
    tratamiento: props.historial.tratamiento,
    fecha_diagnostico: props.historial.fecha_diagnostico,
    observaciones: props.historial.observaciones,
});

const submit = () => {
    form.put(route('historial-medicos.update', props.historial.id));
};
</script>
