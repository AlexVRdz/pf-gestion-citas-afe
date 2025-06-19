<template>
    <AppLayout title="Editar Tipo de Contrato">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Editar Tipo de Contrato
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900">
                            Editando: {{ tipoContrato.nombre }}
                        </h3>
                        <p class="text-sm text-gray-600">
                            Usuario: {{ user.name }} {{ user.apellidos }}
                        </p>
                        <p class="text-sm text-gray-600">
                            Hora actual: {{ currentTime }}
                        </p>
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
                                :class="{ 'border-red-300': form.errors.nombre }"
                                maxlength="50"
                                required
                            />
                            <div v-if="form.errors.nombre" class="mt-2 text-sm text-red-600">
                                {{ form.errors.nombre }}
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
                                :class="{ 'border-red-300': form.errors.descripcion }"
                                maxlength="255"
                            ></textarea>
                            <div v-if="form.errors.descripcion" class="mt-2 text-sm text-red-600">
                                {{ form.errors.descripcion }}
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
                                :class="{ 'border-red-300': form.errors.salario }"
                                required
                            />
                            <div v-if="form.errors.salario" class="mt-2 text-sm text-red-600">
                                {{ form.errors.salario }}
                            </div>
                        </div>

                        <div class="bg-blue-50 p-4 rounded-md">
                            <div class="flex">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <div class="ml-3">
                                    <h4 class="text-sm font-medium text-blue-800">Información del registro</h4>
                                    <div class="mt-2 text-sm text-blue-700">
                                        <p>Creado el: {{ formatDate(tipoContrato.created_at) }}</p>
                                        <p>Última actualización: {{ formatDate(tipoContrato.updated_at) }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                            <div class="flex gap-3">
                                <Link :href="route('tipo-contratos.index')" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded flex items-center gap-2">
                                    ← Cancelar
                                </Link>
                                <Link :href="route('tipo-contratos.show', tipoContrato.id)" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded flex items-center gap-2">
                                    👁 Ver Detalles
                                </Link>
                            </div>

                            <button
                                type="submit"
                                :disabled="form.processing || !hasChanges"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded flex items-center gap-2 disabled:opacity-50"
                            >
                                <span v-if="form.processing">Actualizando...</span>
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
import { ref, onMounted, computed } from "vue";
import { useForm, Link } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";

const props = defineProps({
  tipoContrato: Object,
  user: Object,
});

const { tipoContrato } = props;

const currentTime = ref("");

const form = useForm({
  nombre: tipoContrato.nombre,
  descripcion: tipoContrato.descripcion,
  salario: tipoContrato.salario,
});

const original = {
  nombre: tipoContrato.nombre,
  descripcion: tipoContrato.descripcion,
  salario: tipoContrato.salario,
};

const hasChanges = computed(() =>
  form.nombre !== original.nombre ||
  form.descripcion !== original.descripcion ||
  parseFloat(form.salario) !== parseFloat(original.salario)
);

const formatDate = (dateString) => {
  return new Date(dateString).toLocaleDateString("es-ES", {
    year: "numeric",
    month: "long",
    day: "numeric",
  });
};

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
  form.put(route("tipo-contratos.update", tipoContrato.id));
};

onMounted(() => {
  updateTime();
  setInterval(updateTime, 1000);
});
</script>
