<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";

const form = useForm({
    numero_registro: null,
    nombre: null,
    padre: null,
    madre: null,
    padrino: null,
    madrina: null,
    fecha_bautizo: null,
    lugar_bautizo: null,
    sacerdote: null,
});

const submit = () => {
    form.post(route("registros.store"));
};
</script>

<template>
    <AdminLayout>
        <Head title="Crear Registro de Bautizo" />
        <div class="max-w-7xl mx-auto mt-4">
            <div class="flex justify-between">
                <Link
                    :href="route('registros.index')"
                    class="px-3 py-2 text-white font-semibold bg-indigo-500 hover:bg-indigo-700 rounded"
                    >Atrás</Link
                >
            </div>
        </div>
        <div class="max-w-md mx-auto mt-6 p-6 bg-slate-100">
            <form @submit.prevent="submit">
                <!-- Agregar campos con verificación de nulos -->
                <div>
                    <InputLabel
                        for="numero_registro"
                        value="Número de Registro"
                    />

                    <TextInput
                        id="numero_registro"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.numero_registro"
                    />

                    <InputError
                        class="mt-2"
                        :message="form.errors.numero_registro"
                    />
                </div>

                <div>
                    <InputLabel for="nombre" value="Nombre" />

                    <TextInput
                        id="nombre"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.nombre"
                    />

                    <InputError class="mt-2" :message="form.errors.nombre" />
                </div>

                <!-- Repite este bloque para los demás campos -->

                <!-- Campo de fecha simple -->
                <div>
                    <InputLabel for="fecha_bautizo" value="Fecha de Bautizo" />

                    <input
                        id="fecha_bautizo"
                        type="date"
                        class="mt-1 block w-full"
                        v-model="form.fecha_bautizo"
                    />

                    <InputError
                        class="mt-2"
                        :message="form.errors.fecha_bautizo"
                    />
                </div>

                <div>
                    <InputLabel for="padre" value="Padre" />

                    <TextInput
                        id="padre"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.padre"
                    />

                    <InputError class="mt-2" :message="form.errors.padre" />
                </div>

                <div>
                    <InputLabel for="madre" value="Madre" />

                    <TextInput
                        id="madre"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.madre"
                    />

                    <InputError class="mt-2" :message="form.errors.madre" />
                </div>

                <div>
                    <InputLabel for="padrino" value="Padrino" />

                    <TextInput
                        id="padrino"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.padrino"
                    />

                    <InputError class="mt-2" :message="form.errors.padrino" />
                </div>

                <div>
                    <InputLabel for="madrina" value="Madrina" />

                    <TextInput
                        id="madrina"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.madrina"
                    />

                    <InputError class="mt-2" :message="form.errors.madrina" />
                </div>

                <div>
                    <InputLabel for="lugar_bautizo" value="Lugar de Bautizo" />

                    <TextInput
                        id="lugar_bautizo"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.lugar_bautizo"
                    />

                    <InputError
                        class="mt-2"
                        :message="form.errors.lugar_bautizo"
                    />
                </div>

                <div>
                    <InputLabel for="sacerdote" value="Sacerdote" />

                    <TextInput
                        id="sacerdote"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.sacerdote"
                    />

                    <InputError class="mt-2" :message="form.errors.sacerdote" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <PrimaryButton
                        class="ml-4"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >
                        Crear Registro
                    </PrimaryButton>
                </div>
            </form>
        </div>
    </AdminLayout>
</template>
