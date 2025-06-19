<template>
    <AppLayout title="Gestión de Citas">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Gestión de Citas
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <div class="mb-6 flex justify-between items-center">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900">
                                Listado de Citas
                            </h3>
                            <p class="text-sm text-gray-600">
                                Usuario: {{ user.name }} {{ user.apellidos }}
                            </p>
                            <p class="text-sm text-gray-600">
                                Hora actual: {{ currentTime }}
                            </p>
                        </div>
                        <div class="flex gap-4">
                            <input
                                type="text"
                                v-model="busqueda"
                                placeholder="Buscar por paciente o médico..."
                                class="border rounded px-4 py-2"
                                @input="buscar"
                            />
                            <Link
                                :href="route('citas.create')"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded flex items-center gap-2"
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
                                        d="M12 4v16m8-8H4"
                                    />
                                </svg>
                                Crear Cita
                            </Link>
                        </div>
                    </div>

                    <!--  Buscador -->
                    <div class="mb-4">
                        <input
                            type="text"
                            v-model="search"
                            placeholder="Buscar paciente o correo..."
                            class="border border-gray-300 rounded px-4 py-2 w-1/2"
                            @keyup.enter="submitSearch"
                        />
                        <button
                            @click="submitSearch"
                            class="ml-2 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"
                        >
                            Buscar
                        </button>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Paciente</th>
<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Médico</th>
<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha y Hora</th>
<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
</tr>
</thead>
<tbody class="bg-white divide-y divide-gray-200">
  <tr v-for="appointment in appointments.data" :key="appointment.id">
    <td class="px-6 py-4 whitespace-nowrap">
      <div class="text-sm font-medium text-gray-900">
        {{
          appointment.paciente
            ? appointment.paciente.nombre + ' ' + appointment.paciente.apellidos
            : 'Sin paciente'
        }}
      </div>
    </td>

    <td class="px-6 py-4 whitespace-nowrap">
      <div class="text-sm text-gray-900">
        {{
          appointment.medico
            ? appointment.medico.nombre + ' ' + appointment.medico.apellidos
            : 'Sin médico'
        }}
      </div>
    </td>

    <td class="px-6 py-4 whitespace-nowrap">
      <div class="text-sm text-gray-900">
        {{ new Date(appointment.fecha_hora).toLocaleString("es-ES") }}
      </div>
    </td>

    <td class="px-6 py-4 whitespace-nowrap">
      <span
        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full"
        :class="{
          'bg-green-100 text-green-800': appointment.estado?.nombre === 'Confirmada',
          'bg-yellow-100 text-yellow-800': appointment.estado?.nombre === 'Pendiente',
          'bg-red-100 text-red-800': appointment.estado?.nombre === 'Cancelada',
        }"
      >
        {{ appointment.estado?.nombre ?? 'Sin estado' }}
      </span>
    </td>

    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex gap-3">
      <Link
        :href="route('citas.show', appointment.id)"
        class="text-indigo-600 hover:text-indigo-900 flex items-center gap-1"
      >
        <svg
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 24 24"
          stroke-width="1.5"
          stroke="currentColor"
          class="size-6"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"
          />
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"
          />
        </svg>
        Ver
      </Link>

      <Link
        :href="route('citas.edit', appointment.id)"
        class="text-yellow-600 hover:text-yellow-900 flex items-center gap-1"
      >
        <svg
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 24 24"
          stroke-width="1.5"
          stroke="currentColor"
          class="size-6"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10"
          />
        </svg>
        Editar
      </Link>

      <button
        @click="deleteAppointment(appointment.id)"
        :disabled="deletingAppointments.includes(appointment.id)"
        class="text-red-600 hover:text-red-900 disabled:opacity-50 flex items-center gap-1"
      >
        <svg
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 24 24"
          stroke-width="1.5"
          stroke="currentColor"
          class="size-6"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"
          />
        </svg>
        <span
          v-if="deletingAppointments.includes(appointment.id)"
        >
          Eliminando...
        </span>
        <span v-else>Eliminar</span>
      </button>
    </td>
  </tr>
</tbody>
</table>

</div>
<Pagination :links="appointments.links" class="mt-4" />

                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import { ref, onMounted } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link, router } from "@inertiajs/vue3";
import Pagination from "@/Components/Pagination.vue";

const props = defineProps({
  appointments: Object,
  user: Object,
  busqueda: String,
});

    


const search = ref('');
const currentTime = ref("");
const deletingAppointments = ref([]);
const busqueda = ref(props.busqueda);

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

const formatDateTime = (dateString) => {
  return new Date(dateString).toLocaleString("es-ES", {
    year: "numeric",
    month: "long",
    day: "numeric",
    hour: "2-digit",
    minute: "2-digit",
  });
};

  

const deleteAppointment = (id) => {
if (confirm("¿Estás seguro de eliminar esta cita?")) {
  deletingAppointments.value.push(id);

  router.delete(route("citas.destroy", id), {
    onFinish: () => {
      deletingAppointments.value = deletingAppointments.value.filter(
        (appointmentId) => appointmentId !== id
      );
    },
  });
}

    
};

const buscar = () => {
    router.get(
        route("citas.index"),
        { buscar: busqueda.value },
        { preserveState: true }
    );
};

onMounted(() => {
    updateTime();
    setInterval(updateTime, 1000);
});
</script>
