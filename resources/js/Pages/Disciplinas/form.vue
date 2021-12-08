<template>
    <app-layout title="Disciplina">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <form @submit.prevent="formSubmit" class="flex flex-col m-4">
                        <div class="flex items-center justify-between w-full my-1">
                            <p class="mx-2 font-semibold text-sm">Nome da Disciplina:</p>
                            <input type="text" class="w-3/4" v-model="form.nome_disciplina">
                        </div>
                        <div class="flex items-center justify-between w-full my-1">
                            <p class="mx-2 font-semibold text-sm">Curso:</p>
                            <select class="w-3/4" v-model="form.curso_id">
                                <option value="" selected disabled>SELECIONE</option>
                                <option v-for="curso in cursos" :key="curso.id" v-bind:value="curso.id">{{curso.nome_curso}}</option>
                            </select>
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
    props: ['cursos'],
    components: {
        AppLayout
    },
    data: () => {
        return {
            form: {
                nome_disciplina: null,
                curso_id: null
            }
        }
    },
    methods: {
        async formSubmit() {
            await Inertia.post(route('disciplinas.store'), this.form)
        }
    }
}
</script>
