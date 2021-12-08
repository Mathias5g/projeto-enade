<template>
    <app-layout title="Curso">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div v-show="errors" id="erros">
                        <p v-for="error in errors" class="italic font-semibold text-white underline bg-red-600 p-2 m-4">{{error}}</p>
                    </div>
                    <form @submit.prevent="formSubmit" class="flex flex-col m-4">
                        <div class="flex items-center justify-between w-full my-1">
                            <p class="mx-2 font-semibold text-sm">Nome do Curso:</p>
                            <input type="text" class="w-3/4" v-model="form.nome_curso">
                        </div>
                        <div class="flex justify-end">
                            <button type="submit" class="w-40 p-1 bg-red-600 text-white font-semibold mr-2">Incluir</button>
                            <button type="button" class="w-40 p-1 bg-red-600 text-white font-semibold">Cancelar</button>
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

export default {
    props: ['errors'],
    components: {
        AppLayout
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
            await Inertia.post(route('cursos.store'), this.form)
        }
    }
}
</script>
