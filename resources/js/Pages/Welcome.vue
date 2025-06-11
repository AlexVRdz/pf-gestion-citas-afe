<script setup>
import { Head, Link } from "@inertiajs/vue3";
import { ref, onMounted, onUnmounted } from "vue"; // Importaciones necesarias para el carrusel

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
});

// URLs de imágenes para el carousel
const carouselImages = [
    "https://images.unsplash.com/photo-1505751172876-fa1923c5c528?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80",
    "https://images.unsplash.com/photo-1579684385127-1ef15d508118?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80",
    "https://images.unsplash.com/photo-1588776814546-1ffcf47267a5?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80",
];

// Lógica del carrusel
const currentImageIndex = ref(0);
let intervalId;

onMounted(() => {
    // Cambiar imagen cada 5 segundos
    intervalId = setInterval(() => {
        currentImageIndex.value =
            (currentImageIndex.value + 1) % carouselImages.length;
    }, 5000);
});

onUnmounted(() => {
    // Limpiar intervalo al desmontar el componente
    clearInterval(intervalId);
});
</script>

<template>
    <Head title="Bienvenido a Klinika" />

    <div
        class="min-h-screen bg-gradient-to-br from-blue-50 to-white text-gray-800 dark:bg-gray-900 dark:text-gray-200"
    >
        <div
            class="relative min-h-screen flex flex-col items-center justify-center"
        >
            <div class="w-full max-w-7xl px-6">
                <!-- Header con logo y navegación -->
                <header class="grid grid-cols-3 items-center gap-4 py-8">
                    <!-- Logo Klinika -->
                    <div class="flex items-center space-x-3">
                        <!-- Logo como imagen -->
                        <div
                            class="flex items-center justify-center rounded-lg p-2"
                        >
                            <img
                                src="/images/logo/logo.jpeg"
                                alt="Logo Klinika"
                                class="h-20 w-20 object-contain rounded-lg"
                            />
                        </div>
                        <div class="ml-4">
                            <h1
                                class="text-xl font-bold text-blue-800 dark:text-blue-300"
                            >
                                KLINIKA
                            </h1>
                            <p class="text-sm text-blue-600 dark:text-blue-400">
                                Consultorio General
                            </p>
                        </div>
                    </div>

                    <!-- Título central -->
                    <div class="text-center">
                        <h1
                            class="text-xl font-semibold text-gray-700 dark:text-gray-400"
                        >
                            Sistema de Gestión de Citas Médicas
                        </h1>
                    </div>

                    <!-- Navegación Login -->
                    <nav v-if="canLogin" class="flex justify-end">
                        <Link
                            v-if="$page.props.auth.user"
                            :href="route('dashboard')"
                            class="flex items-center space-x-1 rounded-lg px-4 py-2 bg-blue-600 text-white hover:bg-blue-700 transition-colors"
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
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                                />
                            </svg>
                            <span>Panel</span>
                        </Link>

                        <template v-else>
                            <Link
                                :href="route('login')"
                                class="flex items-center space-x-1 rounded-lg px-4 py-2 bg-blue-600 text-white hover:bg-blue-700 transition-colors"
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
                                        d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"
                                    />
                                </svg>
                                <span>Iniciar Sesión</span>
                            </Link>
                        </template>
                    </nav>
                </header>

                <!-- Contenido principal -->
                <main class="mt-1">
                    <!-- Carousel de imágenes -->
                    <div
                        class="relative overflow-hidden rounded-xl shadow-lg mb-12 h-64 md:h-96"
                    >
                        <div
                            class="absolute inset-0 bg-gradient-to-r from-blue-600 to-blue-400 opacity-30 rounded-xl"
                        ></div>
                        <div class="relative h-full w-full">
                            <div class="carousel h-full w-full">
                                <div
                                    v-for="(image, index) in carouselImages"
                                    :key="index"
                                    class="carousel-item absolute inset-0 w-full h-full transition-opacity duration-500"
                                    :class="{
                                        'opacity-100':
                                            index === currentImageIndex,
                                        'opacity-0':
                                            index !== currentImageIndex,
                                    }"
                                >
                                    <img
                                        :src="image"
                                        :alt="
                                            'Imagen demostrativa ' + (index + 1)
                                        "
                                        class="w-full h-full object-cover"
                                    />
                                    <div
                                        class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-6 text-white"
                                    >
                                        <h2
                                            class="text-xl font-bold md:text-2xl"
                                        >
                                            Gestión eficiente de citas médicas
                                        </h2>
                                        <p class="mt-2 text-sm md:text-base">
                                            Simplificando la administración de
                                            su consultorio
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Características del sistema -->
                    <div class="grid gap-8 md:grid-cols-3">
                        <!-- Tarjeta 1 -->
                        <div
                            class="rounded-xl bg-white p-6 shadow-lg transition-transform hover:scale-105 dark:bg-gray-800"
                        >
                            <div
                                class="mb-4 flex h-12 w-12 items-center justify-center rounded-full bg-blue-100 text-blue-600 dark:bg-blue-900/50 dark:text-blue-400"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-6 w-6"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                                    />
                                </svg>
                            </div>
                            <h3 class="mb-2 text-lg font-semibold">
                                Programación de Citas
                            </h3>
                            <p class="text-gray-600 dark:text-gray-400">
                                Gestione fácilmente las citas de sus pacientes
                                con un calendario intuitivo y herramientas de
                                programación avanzadas.
                            </p>
                        </div>

                        <!-- Tarjeta 2 -->
                        <div
                            class="rounded-xl bg-white p-6 shadow-lg transition-transform hover:scale-105 dark:bg-gray-800"
                        >
                            <div
                                class="mb-4 flex h-12 w-12 items-center justify-center rounded-full bg-green-100 text-green-600 dark:bg-green-900/50 dark:text-green-400"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-6 w-6"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"
                                    />
                                </svg>
                            </div>
                            <h3 class="mb-2 text-lg font-semibold">
                                Historial Médico
                            </h3>
                            <p class="text-gray-600 dark:text-gray-400">
                                Acceda rápidamente al historial completo de sus
                                pacientes para brindar una atención más
                                personalizada.
                            </p>
                        </div>

                        <!-- Tarjeta 3 -->
                        <div
                            class="rounded-xl bg-white p-6 shadow-lg transition-transform hover:scale-105 dark:bg-gray-800"
                        >
                            <div
                                class="mb-4 flex h-12 w-12 items-center justify-center rounded-full bg-purple-100 text-purple-600 dark:bg-purple-900/50 dark:text-purple-400"
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
                                        d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"
                                    />
                                </svg>
                            </div>
                            <h3 class="mb-2 text-lg font-semibold">
                                Gestion de Pacientes
                            </h3>
                            <p class="text-gray-600 dark:text-gray-400">
                                Gestione detalladamente los datos personales
                                para mejorar la gestión de consultas por
                                paciente de su consultorio médico.
                            </p>
                        </div>
                    </div>

                    <!-- Sección de información adicional -->
                    <div
                        class="mt-16 rounded-xl bg-white p-8 shadow-lg dark:bg-gray-800"
                    >
                        <div class="flex flex-col items-center text-center">
                            <div
                                class="mb-6 flex h-16 w-16 items-center justify-center rounded-full bg-blue-100 text-blue-600 dark:bg-blue-900/50 dark:text-blue-400"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-8 w-8"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"
                                    />
                                </svg>
                            </div>
                            <h2 class="mb-4 text-2xl font-bold">
                                Optimice la gestión de su consultorio
                            </h2>
                            <p
                                class="max-w-2xl text-gray-600 dark:text-gray-400"
                            >
                                Klinika es un sistema diseñado específicamente
                                para consultorios de medicina general que
                                necesitan una solución completa para la gestión
                                de citas médicas. Simplifique sus procesos
                                administrativos y dedique más tiempo a lo que
                                realmente importa: la atención de sus pacientes.
                            </p>
                            <div
                                v-if="canLogin && !$page.props.auth.user"
                                class="mt-6"
                            >
                                <Link
                                    :href="route('login')"
                                    class="inline-flex items-center rounded-lg bg-blue-600 px-6 py-3 text-white hover:bg-blue-700"
                                >
                                    <span>Acceder al sistema</span>
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="ml-2 h-5 w-5"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M14 5l7 7m0 0l-7 7m7-7H3"
                                        />
                                    </svg>
                                </Link>
                            </div>
                        </div>
                    </div>
                </main>

                <!-- Pie de página -->
                <footer
                    class="mt-16 py-8 text-center text-sm text-gray-500 dark:text-gray-400"
                >
                    <div class="mb-4 flex justify-center space-x-6">
                        <a href="#" class="text-gray-400 hover:text-gray-500">
                            <span class="sr-only">Facebook</span>
                            <svg
                                class="h-6 w-6"
                                fill="currentColor"
                                viewBox="0 0 24 24"
                                aria-hidden="true"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
                                    clip-rule="evenodd"
                                />
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-gray-500">
                            <span class="sr-only">Instagram</span>
                            <svg
                                class="h-6 w-6"
                                fill="currentColor"
                                viewBox="0 0 24 24"
                                aria-hidden="true"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C9.013 2.013 9.357 2 12 2v.315z"
                                    clip-rule="evenodd"
                                />
                            </svg>
                        </a>
                    </div>
                    <p>
                        &copy; {{ new Date().getFullYear() }} Klinika. Todos los
                        derechos reservados.
                    </p>
                </footer>
            </div>
        </div>
    </div>
</template>
