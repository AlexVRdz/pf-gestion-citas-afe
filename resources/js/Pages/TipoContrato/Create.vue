<template>
    <AppLayout title="Crear Tipo de Contrato">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Crear Tipo de Contrato
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900">Nuevo Tipo de Contrato</h3>
                        <p class="text-sm text-gray-600">
                            Usuario: {{ user.name }} {{ user.apellidos }}
                        </p>
                        <p class="text-sm text-gray-600">Hora actual: {{ currentTime }}</p>
                    </div>

                    <form @submit.prevent="submit" class="space-y-6">
                        <div>
                            <label for="nombre" class="block text-sm font-medium text-gray-700">
                                Nombre del contrato
                            </label>
                            <input
                                id="nombre"
                                v-model="form.nombre"
                                type="text"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                :class="{ 'border-red-300': errors.nombre }"
                                placeholder="Ej: Tiempo completo, Por horas..."
                                maxlength="50"
                                required
                            />
                            <div v-if="errors.nombre" class="mt-2 text-sm text-red-600">
                                {{ errors.nombre }}
                            </div>
                        </div>

                        <div>
                            <label for="descripcion" class="block text-sm font-medium text-gray-700">
                                Descripción (opcional)
                            </label>
                            <textarea
                                id="descripcion"
                                v-model="form.descripcion"
                                rows="3"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                :class="{ 'border-red-300': errors.descripcion }"
                                placeholder="Descripción breve del contrato..."
                                maxlength="255"
                            ></textarea>
                            <div v-if="errors.descripcion" class="mt-2 text-sm text-red-600">
                                {{ errors.descripcion }}
                            </div>
                        </div>

                        <div>
                            <label for="salario" class="block text-sm font-medium text-gray-700">
                                Salario mensual (USD)
                            </label>
                            <input
                                id="salario"
                                v-model="form.salario"
                                type="number"
                                step="0.01"
                                min="0"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                :class="{ 'border-red-300': errors.salario }"
                                placeholder="Ej: 30000.00"
                                required
                            />
                            <div v-if="errors.salario" class="mt-2 text-sm text-red-600">
                                {{ errors.salario }}
                            </div>
                        </div>

                        <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                            <Link
                                :href="route('tipo-contratos.index')"
                                class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded flex items-center gap-2"
                            >
                                ← Cancelar
                            </Link>

                            <button
                                type="submit"
                                :disabled="form.processing"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded flex items-center gap-2 disabled:opacity-50"
                            >
                                ✔
                                <span v-if="form.processing">Guardando...</span>
                                <span v-else>Guardar</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import { ref, onMounted } from "vue";
import { useForm } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link } from "@inertiajs/vue3";

defineProps({
    user: Object,
    errors: Object,
});

const currentTime = ref("");

const form = useForm({
    nombre: "",
    descripcion: "",
    salario: "", 
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

const submit = () => {
    form.post(route("tipo-contratos.store"));
};

onMounted(() => {
    updateTime();
    setInterval(updateTime, 1000);
});
</script>
