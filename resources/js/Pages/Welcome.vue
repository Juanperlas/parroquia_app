<script setup>
import { ref } from "vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import Modal from "@/Components/Modal.vue";
import Table from "@/Components/Table.vue";
import TableRow from "@/Components/TableRow.vue";
import TableHeaderCell from "@/Components/TableHeaderCell.vue";
import TableDataCell from "@/Components/TableDataCell.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const showResultModal = ref(false);
const numeroRegistro = ref("");
const registroEncontrado = ref(null);

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
    registros: {
        type: Array,
    },
});

const buscarConstancias = (registros) => {
    console.log(registros);
    console.log(numeroRegistro.value);

    // Verificar si registros está definido
    if (!registros) {
        console.error("La variable 'registros' no está definida");
        return;
    }

    // Convertir el número de registro a un tipo consistente (puede ser necesario ajustar según el tipo de datos)
    const numeroBuscado = parseInt(numeroRegistro.value);

    // Buscar el registro correspondiente al número de registro ingresado
    registroEncontrado.value = registros.find(
        (registro) => registro.numero_registro === numeroBuscado
    );

    console.log(registroEncontrado.value);

    // Mostrar el modal con el resultado
    openModal();
};

const ocultarNombres = (texto) => {
    // Dividir el texto en palabras
    const palabras = texto.split(" ");

    // Reemplazar cada palabra con la inicial seguida de tres asteriscos
    const inicialesAsteriscos = palabras.map((palabra) => {
        // Tomar la primera letra y agregar tres asteriscos
        return palabra.charAt(0) + "*";
    });

    // Unir las palabras transformadas en un solo texto
    return inicialesAsteriscos.join(" ");
};

const abrirConstancia = (numeroRegistro) => {
    window.open(`/registros/${numeroRegistro}/constancia`, "_blank");
};

const closeModal = () => {
    showResultModal.value = false;
    document.body.style.overflow = null;
};

const openModal = () => {
    showResultModal.value = true;
    document.body.style.overflow = "hidden";
};

const form = useForm({
    nombre: "",
    correo: "",
    comentario: "",
});

function submitForm() {
    form.post(route("comentarios.store")).then(() => {
        form.reset();
    });
}
</script>
<template>
    <Head title="SAP " />
    <main>
        <section class="bg-white dark:bg-gray-900">
            <nav
                x-data="{ isOpen: false }"
                class="container mx-auto p-6 lg:flex lg:items-center lg:justify-between"
            >
                <div class="flex items-center justify-between">
                    <div>
                        <a
                            class="text-2xl font-bold text-gray-800 hover:text-gray-700 dark:text-white dark:hover:text-gray-300 lg:text-3xl"
                            href="#"
                            >PARROQUIA</a
                        >
                    </div>

                    <!-- Mobile menu button -->
                    <div class="flex lg:hidden">
                        <button
                            x-cloak
                            @click="isOpen = !isOpen"
                            type="button"
                            class="text-gray-500 hover:text-gray-600 focus:text-gray-600 focus:outline-none dark:text-gray-200 dark:hover:text-gray-400 dark:focus:text-gray-400"
                            aria-label="toggle menu"
                        >
                            <svg
                                x-show="!isOpen"
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-6 w-6"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M4 8h16M4 16h16"
                                />
                            </svg>

                            <svg
                                x-show="isOpen"
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-6 w-6"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M6 18L18 6M6 6l12 12"
                                />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Mobile Menu open: "block", Menu closed: "hidden" -->
                <div
                    x-cloak
                    class="absolute inset-x-0 z-20 w-full bg-white px-6 py-4 transition-all duration-300 ease-in-out dark:bg-gray-900 lg:relative lg:top-0 lg:mt-0 lg:flex lg:w-auto lg:translate-x-0 lg:items-center lg:bg-transparent lg:p-0 lg:opacity-100 lg:dark:bg-transparent"
                >
                    <Link
                        v-if="$page.props.auth.user"
                        :href="route('dashboard')"
                        class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                        >Dashboard</Link
                    >

                    <template v-else>
                        <Link
                            :href="route('login')"
                            class="mt-4 block rounded-lg bg-blue-600 px-6 py-2.5 text-center font-medium capitalize leading-5 text-white hover:bg-blue-500 lg:mt-0 lg:w-auto"
                            >Iniciar Sesión</Link
                        >
                    </template>
                </div>
            </nav>

            <div class="container mx-auto px-6 py-16 text-center">
                <div class="mx-auto max-w-lg">
                    <h1
                        class="text-3xl font-extrabold text-gray-800 dark:text-white lg:text-4xl"
                    >
                        Descubre el Tesoro de la Fe en Nuestro Hogar Espiritual
                    </h1>
                    <p class="mt-6 text-gray-500 dark:text-gray-300">
                        Nos enorgullece ser un refugio espiritual para todos
                        aquellos que buscan fortalecer su conexión con Dios y la
                        comunidad. Aquí, todos son bienvenidos con los brazos
                        abiertos, independientemente de su camino espiritual.
                    </p>
                    <div
                        class="p-6 border-blue-200 border-2 rounded-xl bg-blue-200"
                    >
                        <h2
                            class="text-lg font-semibold text-slate-800 text-center"
                        >
                            Buscar Constancia
                        </h2>
                        <form
                            @submit.prevent="() => buscarConstancias(registros)"
                        >
                            <div class="flex space-x-4">
                                <div class="w-full">
                                    <input
                                        v-model="numeroRegistro"
                                        type="text"
                                        id="numeroRegistro"
                                        name="numeroRegistro"
                                        class="mt-1 p-2 w-full border rounded-md justify-center text-center"
                                        placeholder="Ingresa el número de registro"
                                        required
                                    />
                                </div>
                            </div>
                            <div class="flex space-x-4 justify-center">
                                <button
                                    v-if="numeroRegistro"
                                    type="submit"
                                    class="mt-2 rounded-lg bg-blue-600 px-6 py-2.5 text-center text-sm font-medium capitalize leading-5 text-white hover:bg-blue-500 focus:outline-none lg:mx-0 lg:w-auto"
                                >
                                    Ver mi constancia de Bautizo
                                </button>
                            </div>
                        </form>
                    </div>

                    <Modal :show="showResultModal" @close="closeModal">
                        <div class="mt-6">
                            <div
                                class="justify-center text-center font-extrabold text-2xl border-b shadow-md p-2"
                            >
                                {{
                                    registroEncontrado
                                        ? "Registro Encontrado"
                                        : "Registro No Encontrado"
                                }}
                            </div>
                            <template v-if="registroEncontrado">
                                <Table>
                                    <template #header>
                                        <TableRow
                                            class="border-b justify-center text-center"
                                        >
                                            <TableHeaderCell
                                                >Nª Registro</TableHeaderCell
                                            >
                                            <TableHeaderCell
                                                >INICIALES</TableHeaderCell
                                            >
                                            <TableHeaderCell
                                                >FECHA</TableHeaderCell
                                            >
                                            <TableHeaderCell
                                                >Acciones</TableHeaderCell
                                            >
                                        </TableRow>
                                    </template>
                                    <template #default>
                                        <TableRow
                                            :key="
                                                registroEncontrado.numero_registro
                                            "
                                            class="border-b justify-center text-center"
                                        >
                                            <TableDataCell>{{
                                                registroEncontrado.numero_registro
                                            }}</TableDataCell>
                                            <TableDataCell>{{
                                                ocultarNombres(
                                                    registroEncontrado.nombre
                                                )
                                            }}</TableDataCell>
                                            <TableDataCell>{{
                                                registroEncontrado.fecha_bautizo
                                            }}</TableDataCell>
                                            <TableDataCell>
                                                <PrimaryButton
                                                    @click="
                                                        abrirConstancia(
                                                            registroEncontrado.numero_registro
                                                        )
                                                    "
                                                    class="mx-2"
                                                    >BOLETA</PrimaryButton
                                                >
                                            </TableDataCell>
                                        </TableRow>
                                    </template>
                                </Table>
                            </template>
                        </div>
                    </Modal>
                </div>

                <div class="mt-10 flex justify-center">
                    <img
                        class="h-96 w-full rounded-xl object-cover lg:w-4/5"
                        src="https://tomecano7.com/wp-content/uploads/2021/01/Bautizo-5.2.jpg"
                    />
                </div>
            </div>
        </section>

        <section class="bg-white dark:bg-gray-900">
            <div class="container mx-auto px-6 py-10">
                <h1
                    class="text-center text-3xl font-semibold capitalize text-gray-800 dark:text-white lg:text-4xl"
                >
                    Bautizos Realizados
                </h1>

                <p class="mt-4 text-center text-gray-500 dark:text-gray-300">
                    Experimenta la esencia de la fe a través de nuestras
                    celebraciones y servicios inspiradores. Desde misas diarias
                    hasta eventos especiales, ofrecemos un espacio donde puedes
                    encontrar la paz y la comunión con Dios.
                </p>

                <div
                    class="mt-8 grid grid-cols-1 gap-8 md:grid-cols-2 xl:mt-12 xl:grid-cols-3 xl:gap-12"
                >
                    <div>
                        <img
                            class="h-96 w-full rounded-lg object-cover"
                            src="https://www.blogdelfotografo.com/wp-content/uploads/2014/09/13125826734_d89474c2a5_z.jpg"
                            alt=""
                        />
                    </div>

                    <div>
                        <img
                            class="h-96 w-full rounded-lg object-cover"
                            src="https://www.loscincoenebros.com/wp-content/uploads/2018/03/organizar-un-bautizo.jpg"
                            alt=""
                        />
                    </div>

                    <div>
                        <img
                            class="h-96 w-full rounded-lg object-cover"
                            src="https://www.cardoviera.com/wp-content/uploads/Fotografo-de-bautizo-%C2%A9-2017-Cachimbambu%CC%81-Photography36-1-950x633.jpg"
                            alt=""
                        />
                    </div>
                </div>
            </div>
        </section>

        <section class="bg-white dark:bg-gray-900">
            <div class="h-[32rem] bg-gray-100 dark:bg-gray-800">
                <div class="container mx-auto px-6 py-10">
                    <h1
                        class="text-center text-3xl font-semibold capitalize text-gray-800 dark:text-white lg:text-4xl"
                    >
                        Misas y Eventos
                    </h1>

                    <div class="mx-auto mt-6 flex justify-center">
                        <span
                            class="inline-block h-1 w-40 rounded-full bg-blue-500"
                        ></span>
                        <span
                            class="mx-1 inline-block h-1 w-3 rounded-full bg-blue-500"
                        ></span>
                        <span
                            class="inline-block h-1 w-1 rounded-full bg-blue-500"
                        ></span>
                    </div>

                    <p
                        class="mx-auto mt-6 max-w-2xl text-center text-gray-500 dark:text-gray-300"
                    >
                        Consulta nuestros horarios de misas y eventos para
                        planificar tu visita y participar en las actividades que
                        más te interesen. Queremos ser parte de tu jornada
                        espiritual y ayudarte a fortalecer tu relación con Dios.
                    </p>
                </div>
            </div>

            <div
                class="container mx-auto -mt-72 px-6 py-10 sm:-mt-80 md:-mt-96"
            >
                <div
                    class="mt-8 grid grid-cols-1 gap-8 md:grid-cols-2 xl:mt-16 xl:grid-cols-3"
                >
                    <div
                        class="flex flex-col items-center rounded-xl border p-4 dark:border-gray-700 sm:p-6"
                    >
                        <img
                            class="aspect-square w-full rounded-xl object-cover"
                            src="https://lh5.googleusercontent.com/p/AF1QipMuj9OyiHHRJgD6arNlPW37T8doVeWyhXZ_dML4=w1080-k-no"
                            alt=""
                        />

                        <h1
                            class="mt-4 text-2xl font-semibold capitalize text-gray-700 dark:text-white"
                        >
                            Iglesia - San Antonio de Putina
                        </h1>

                        <p
                            class="mt-2 capitalize text-gray-500 dark:text-gray-300"
                        >
                            Parroquia
                        </p>
                    </div>

                    <div
                        class="flex flex-col items-center rounded-xl border p-4 dark:border-gray-700 sm:p-6"
                    >
                        <img
                            class="aspect-square w-full rounded-xl object-cover"
                            src="https://perucatolico.com/wp-content/uploads/2020/10/sacerdote-sotana-negra-peru-catolcio.jpg"
                            alt=""
                        />

                        <h1
                            class="mt-4 text-2xl font-semibold capitalize text-gray-700 dark:text-white"
                        >
                            padre Pío Ríos Villasante
                        </h1>

                        <p
                            class="mt-2 capitalize text-gray-500 dark:text-gray-300"
                        >
                            SACERDOTE
                        </p>
                    </div>

                    <div
                        class="flex flex-col items-center rounded-xl border p-4 dark:border-gray-700 sm:p-6"
                    >
                        <img
                            class="aspect-square w-full rounded-xl object-cover"
                            src="https://radioondaazul.com/wp-content/uploads/2021/06/32-aniversario-San-Antonio-de-Putina.jpg"
                            alt=""
                        />

                        <h1
                            class="mt-4 text-2xl font-semibold capitalize text-gray-700 dark:text-white"
                        >
                            San Antonio de Putina
                        </h1>

                        <p
                            class="mt-2 capitalize text-gray-500 dark:text-gray-300"
                        >
                            Plaza de Armas
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <section
            class="min-h-screen bg-gradient-to-r from-blue-600 via-blue-800 to-blue-900 dark:from-gray-700 dark:via-gray-800 dark:to-gray-900"
        >
            <div
                class="container mx-auto flex min-h-screen flex-col px-6 py-12"
            >
                <div class="flex-1 lg:-mx-6 lg:flex lg:items-center">
                    <div class="text-white lg:mx-6 lg:w-1/2">
                        <h1
                            class="text-3xl font-semibold capitalize lg:text-5xl"
                        >
                            Envíanos tus comentarios
                        </h1>

                        <p class="mt-6 max-w-xl">
                            Haznos saber sobre tus dudas o consultas, asi como
                            también sugerencias o cualquier tipo de comentario
                            acerca de nosotros.
                        </p>

                        <div class="mt-6 space-y-8 md:mt-8">
                            <p class="-mx-2 flex items-start">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="mx-2 h-6 w-6 text-white"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="2"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"
                                    />
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"
                                    />
                                </svg>

                                <span class="mx-2 w-72 truncate text-white">
                                    San Antonio de Putina 21340
                                </span>
                            </p>

                            <p class="-mx-2 flex items-start">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="mx-2 h-6 w-6 text-white"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="2"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"
                                    />
                                </svg>

                                <span class="mx-2 w-72 truncate text-white"
                                    >(51) 987 654 321</span
                                >
                            </p>

                            <p class="-mx-2 flex items-start">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="mx-2 h-6 w-6 text-white"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="2"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                                    />
                                </svg>

                                <span class="mx-2 w-72 truncate text-white"
                                    >parroquia@putina.com</span
                                >
                            </p>
                        </div>
                    </div>

                    <div class="mt-8 lg:mx-6 lg:w-1/2">
                        <div
                            class="mx-auto w-full overflow-hidden rounded-xl bg-white px-8 py-10 shadow-2xl dark:bg-gray-900 lg:max-w-xl"
                        >
                            <h1
                                class="text-2xl font-medium text-gray-700 dark:text-gray-200"
                            >
                                Formulario
                            </h1>

                            <form class="mt-6" @submit.prevent="submitForm">
                                <div class="flex-1">
                                    <label
                                        class="mb-2 block text-sm text-gray-600 dark:text-gray-200"
                                        >Nombre completo</label
                                    >
                                    <input
                                        v-model="form.nombre"
                                        type="text"
                                        placeholder="Nombre Completo"
                                        class="mt-2 block w-full rounded-md border border-gray-200 bg-white px-5 py-3 text-gray-700 focus:border-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-blue-300"
                                    />
                                </div>

                                <div class="mt-6 flex-1">
                                    <label
                                        class="mb-2 block text-sm text-gray-600 dark:text-gray-200"
                                        >Correo electrónico</label
                                    >
                                    <input
                                        v-model="form.correo"
                                        type="email"
                                        placeholder="correo@ejemplo.com"
                                        class="mt-2 block w-full rounded-md border border-gray-200 bg-white px-5 py-3 text-gray-700 focus:border-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-blue-300"
                                    />
                                </div>

                                <div class="mt-6 w-full">
                                    <label
                                        class="mb-2 block text-sm text-gray-600 dark:text-gray-200"
                                        >Mensaje</label
                                    >
                                    <textarea
                                        v-model="form.comentario"
                                        class="mt-2 block h-32 w-full rounded-md border border-gray-200 bg-white px-5 py-3 text-gray-700 placeholder-gray-400 focus:border-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-blue-300 md:h-48"
                                        placeholder="Mensaje"
                                    ></textarea>
                                </div>

                                <button
                                    type="submit"
                                    class="mt-6 w-full transform rounded-md bg-blue-600 px-6 py-3 text-sm font-medium capitalize tracking-wide text-white transition-colors duration-300 hover:bg-blue-500 focus:outline-none focus:ring focus:ring-blue-400 focus:ring-opacity-50"
                                >
                                    Enviar comentario
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</template>
