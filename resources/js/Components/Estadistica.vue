<script setup>
import { Link } from "@inertiajs/vue3";
import { usePermission } from "@/composables/permissions";
import Comentarios from "./Comentarios.vue";
const { hasRole } = usePermission();
</script>
<template>
    <div class="antialiased bg-slate-300 w-full text-slate-700 relative py-1">
        <div
            class="grid grid-cols-16 mx-auto gap-2 sm:gap-4 md:gap-6 lg:gap-10 xl:gap-14 max-w-[90%] my-10 px-2"
        >
            <div
                id="content"
                class="bg-white col-span-12 md:col-span-9 rounded-lg p-6"
            >
                <div id="last-incomes">
                    <h1 class="font-bold mt-6 uppercase text-black">
                        RECUENTO DE REGISTROS REALIZADOS
                    </h1>
                    <div
                        id="stats"
                        class="grid grid-cols-1 sm:grid-cols-1 lg:grid-cols-2 xl:grid-cols-2 gap-4"
                    >
                        <div
                            class="bg-slate-100 to-white/5 rounded-lg shadow-xl"
                        >
                            <div class="flex flex-row items-center p-4">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    class="w-10 h-10 text-black"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"
                                    />
                                </svg>
                                <div class="p-2">
                                    <p class="text-xl font-bold">
                                        REGISTROS DE HOY
                                    </p>
                                    <p class="text-black font-medium">
                                        Total:
                                        <slot name="pagoTotalHoy"></slot>
                                    </p>
                                </div>
                            </div>
                            <div class="border-t border-black/20 p-4">
                                <a
                                    href="#"
                                    class="inline-flex space-x-2 items-center text-center"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="1.5"
                                        stroke="currentColor"
                                        class="w-6 h-6"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z"
                                        />
                                    </svg>
                                    <span>Info</span>
                                </a>
                            </div>
                        </div>
                        <div
                            class="bg-slate-100 to-white/5 rounded-lg shadow-xl"
                        >
                            <div class="flex flex-row items-center p-4">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    class="w-6 h-6"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 015.814-5.519l2.74-1.22m0 0l-5.94-2.28m5.94 2.28l-2.28 5.941"
                                    />
                                </svg>
                                <div class="p-2">
                                    <p class="text-xl font-bold">
                                        REGISTROS TOTALES
                                    </p>
                                    <p class="text-black font-medium">
                                        Total:
                                        <slot name="pagosTotalesTotal"></slot>
                                    </p>
                                </div>
                            </div>
                            <div class="border-t border-black/20 p-4">
                                <a
                                    href="#"
                                    class="inline-flex space-x-2 items-center text-center"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="1.5"
                                        stroke="currentColor"
                                        class="w-6 h-6"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z"
                                        />
                                    </svg>
                                    <span>Info</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-4">
                    <div class="my-5 mt-10">
                        <h2 class="text-lg font-semibold text-gray-900">
                            COMENTARIOS DE HOY
                        </h2>
                    </div>
                    <Comentarios :comentarios="comentariosHoy" />
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    methods: {
        descargarManual() {
            const url = "/descargar-manual";
            window.open(url, "_blank");
        },
    },
};
</script>
