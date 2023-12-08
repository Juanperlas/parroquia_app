<template>
    <div class="grid sm:grid-cols-2 sm:gap-x-6 lg:grid-cols-3">
        <div
            v-for="comentario in $page.props.comentarios.hoy"
            :key="comentario.id"
            class="mb-6 rounded-lg bg-slate-100 p-6 shadow-lg"
        >
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <img
                        class="mr-2 h-10 w-10 rounded-full object-cover"
                        src="https://rapidapi-prod-apis.s3.amazonaws.com/b42aa17d-8ae0-4a28-b29f-587af5454390.png"
                        alt="profile"
                    />
                    <div>
                        <h3 class="text-base font-semibold text-gray-900">
                            {{ comentario.nombre }}
                        </h3>
                        <span class="block text-xs font-normal text-gray-500">
                            {{ comentario.correo }}
                        </span>
                    </div>
                </div>
            </div>
            <p class="my-6 text-sm font-normal text-gray-500">
                {{ comentario.comentario }}
            </p>
        </div>
    </div>
</template>
