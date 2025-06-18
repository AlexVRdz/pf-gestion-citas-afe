<template>
    <AppLayout title="Crear Historial Médico">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Crear Historial Médico
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white p-6 rounded shadow">
                    <form @submit.prevent="submit">
                        <div class="mb-4">
                            <label class="block text-gray-700">Paciente</label>
                            <input type="text" v-model="form.paciente_id" class="w-full border-gray-300 rounded" placeholder="ID del paciente" />
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700">Tipo de Enfermedad</label>
                            <input type="text" v-model="form.tipo_enfermedad_id" class="w-full border-gray-300 rounded" placeholder="ID del tipo de enfermedad" />
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
                            <label class="block text-gray-700">Fecha</label>
                            <input type="date" v-model="form.fecha" class="w-full border-gray-300 rounded" />
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                                Guardar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import { reactive } from 'vue';
import { useForm, router } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

const form = useForm({
    paciente_id: '',
    tipo_enfermedad_id: '',
    diagnostico: '',
    tratamiento: '',
    fecha: '',
});

const submit = () => {
    form.post(route('historial-medicos.store'));
};
</script>
