<template>
    <AppLayout title="Editar Paciente">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Editar Paciente</h2>
        </template>

        <div class="py-10">
            <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 bg-white p-6 shadow rounded">
                <form @submit.prevent="submit">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label>Nombre</label>
                            <input v-model="form.nombre" class="form-input w-full" type="text" required />
                        </div>
                        <div>
                            <label>Apellidos</label>
                            <input v-model="form.apellidos" class="form-input w-full" type="text" required />
                        </div>
                        <div>
                            <label>Email</label>
                            <input v-model="form.email" class="form-input w-full" type="email" required />
                        </div>
                        <div>
                            <label>Teléfono</label>
                            <input v-model="form.telefono" class="form-input w-full" type="text" required />
                        </div>
                        <div>
                            <label>Dirección</label>
                            <input v-model="form.direccion" class="form-input w-full" type="text" required />
                        </div>
                        <div>
                            <label>Fecha de nacimiento</label>
                            <input v-model="form.fecha_nacimiento" class="form-input w-full" type="date" required />
                        </div>
                        <div>
                            <label>Género</label>
                            <select v-model="form.genero" class="form-input w-full" required>
                                <option value="M">Masculino</option>
                                <option value="F">Femenino</option>
                            </select>
                        </div>
                        <div>
                            <label>Número de seguro</label>
                            <input v-model="form.numero_seguro" class="form-input w-full" type="text" />
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end">
                        <Link :href="route('pacientes.index')" class="btn bg-gray-500 text-white px-4 py-2 rounded mr-3">Cancelar</Link>
                        <button type="submit" class="btn bg-blue-500 text-white px-4 py-2 rounded">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import { useForm, router, Link } from '@inertiajs/vue3'
import { defineProps } from 'vue'

const props = defineProps({
    paciente: Object
})

const form = useForm({ ...props.paciente })

const submit = () => {
    router.put(route('pacientes.update', props.paciente.id), form)
}
</script>
