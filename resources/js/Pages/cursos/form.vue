<template>
    <app-layout title="Curso">
        <div class="py-12 h-full">
            <div class="max-w-7xl h-full mx-auto sm:px-6 lg:px-8">
                <div class="bg-white h-full overflow-auto shadow-xl sm:rounded-lg">
                    <div v-show="errors" id="erros">
                        <p v-for="error in errors" class="italic font-semibold text-white underline bg-red-600 p-2 m-4">{{error}}</p>
                    </div>
                    <form @submit.prevent="formSubmit" class="flex flex-col justify-between p-4 h-full">
                        <div>
                            <div v-show="typeof curso != 'undefined'" class="flex items-center justify-between w-full my-1">
                                <p class="mx-2 font-semibold text-sm">ID no Sistema:</p>
                                <input type="text" class="w-3/4 bg-gray-200 cursor-not-allowed" v-model="form.id" disabled>
                            </div>
                            <div class="flex items-center justify-between w-full my-1">
                                <p class="mx-2 font-semibold text-sm">Nome do Curso:</p>
                                <input v-bind:class="errors.nome_curso ? 'border-red-600' : ''" type="text" class="w-3/4" v-model="form.nome_curso">
                            </div>
                        </div>
                        <div class="flex justify-end">
                            <button v-if="typeof curso == 'undefined'" type="submit" class="w-40 p-1 bg-red-600 text-white font-semibold mr-2">Incluir</button>
                            <button v-else type="submit" class="w-40 p-1 bg-red-600 text-white font-semibold mr-2">Salvar</button>
                            <Link href="/cursos"><button type="button" class="w-40 p-1 bg-red-600 text-white font-semibold">Cancelar</button></Link>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout';
import {Inertia} from "@inertiajs/inertia";
import { Link } from '@inertiajs/inertia-vue3'

export default {
    props: ['errors', 'curso', 'action'],
    components: {
        AppLayout,
        Link
    },
    data: () => {
        return {
            form: {
                nome_curso: null
            }
        }
    },
    methods: {
        async formSubmit() {
            this.action === route('cursos.store') ? await Inertia.post(this.action, this.form) : await Inertia.put(this.action, this.form)
        }
    },
    mounted() {
        if(this.curso) {
            this.form = this.curso
        }
    }
}
</script>
