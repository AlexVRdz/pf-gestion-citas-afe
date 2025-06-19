<template>
  <AppLayout title="Editar Tipo de Enfermedad">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Editar Tipo de Enfermedad
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white p-6 rounded shadow">
          <form @submit.prevent="updateTipo">
            <div class="mb-4">
              <label class="block text-sm font-medium text-gray-700">Nombre</label>
              <input v-model="form.nombre" type="text" class="mt-1 block w-full rounded border-gray-300 shadow-sm" />
            </div>

            <div class="mb-4">
              <label class="block text-sm font-medium text-gray-700">Descripción</label>
              <textarea v-model="form.descripcion" class="mt-1 block w-full rounded border-gray-300 shadow-sm"></textarea>
            </div>

            <div class="mb-4">
              <label class="block text-sm font-medium text-gray-700">Categoría</label>
              <input v-model="form.categoria" type="text" class="mt-1 block w-full rounded border-gray-300 shadow-sm" />
            </div>

            <div class="flex justify-end space-x-3">
              <Link :href="route('tipo-enfermedades.index')" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                Cancelar
              </Link>
              <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                Actualizar
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { useForm, Link, router } from "@inertiajs/vue3";

const props = defineProps({
  tipoEnfermedad: Object
});

const form = useForm({
  nombre: props.tipoEnfermedad.nombre,
  descripcion: props.tipoEnfermedad.descripcion,
  categoria: props.tipoEnfermedad.categoria
});

function updateTipo() {
  router.put(route("tipo-enfermedades.update", props.tipoEnfermedad.id), form);
}
</script>
