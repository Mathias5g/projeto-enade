<template>
    <app-layout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12 h-full">
            <div class="max-w-7xl h-full mx-auto sm:px-6 lg:px-8">
                <div class="bg-white h-full overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="flex flex-col h-full items-center p-8">
                        <h1 class="font-semibold text-3xl max-w-xl text-center">Bem-vindo(a) ao sistema de consulta de questões do ENADE</h1>
                        <div class="flex flex-col items-center h-full justify-center">
                            <h4 class="font-semibold text-2xl text-gray-600">Por aqui você poderá:</h4>
                            <ul class="">
                                <li class="text-blue-600 italic underline text-center text-xl"><Link href="/cursos">Consultar cursos cadastrados no sistema</Link></li>
                                <li class="text-blue-600 italic underline text-center text-xl"><Link href="/disciplinas">Consultar disciplinas cadastradas no sistema</Link></li>
                                <li class="text-blue-600 italic underline text-center text-xl"><Link href="/concursos">Consultar concursos cadastrados no sistema</Link></li>
                                <li class="text-blue-600 italic underline text-center text-xl"><Link href="/questoes">Consultar questões cadastrados no sistema</Link></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import { defineComponent } from 'vue'
    import AppLayout from '@/Layouts/AppLayout.vue'
    import { Link } from '@inertiajs/inertia-vue3'

    export default defineComponent({
        components: {
            AppLayout,
            Link
        },
    })
</script>
