<template>
    <AppLayout title="Crear Tipo de Enfermedad">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Crear Tipo de Enfermedad
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <form @submit.prevent="submit">
                        <div class="mb-4">
                            <label class="block font-medium text-sm text-gray-700">Nombre</label>
                            <input type="text" v-model="form.nombre" class="form-input rounded-md shadow-sm mt-1 block w-full" required />
                        </div>

                        <div class="mb-4">
                            <label class="block font-medium text-sm text-gray-700">Descripción</label>
                            <textarea v-model="form.descripcion" class="form-input rounded-md shadow-sm mt-1 block w-full"></textarea>
                        </div>

                        <div class="mb-4">
                            <label class="block font-medium text-sm text-gray-700">Categoría</label>
                            <input type="text" v-model="form.categoria" class="form-input rounded-md shadow-sm mt-1 block w-full" required />
                        </div>

                        <div class="flex items-center justify-end">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
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
import { reactive } from 'vue'
import { router } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue'

const form = reactive({
    nombre: '',
    descripcion: '',
    categoria: '',
})

function submit() {
    router.post(route('tipo-enfermedades.store'), form)
}
</script>
