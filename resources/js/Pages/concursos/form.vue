<template>
    <app-layout title="Concurso">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div v-show="errors" id="erros">
                        <p v-for="error in errors" class="italic font-semibold text-white underline bg-red-600 p-2 m-4">{{error}}</p>
                    </div>
                    <form @submit.prevent="formSubmit" class="flex flex-col m-4">
                        <div class="flex items-center justify-between w-full my-1">
                            <p class="mx-2 font-semibold text-sm">Nome do Concurso:</p>
                            <input type="text" class="w-3/4" v-model="form.nome_concurso">
                        </div>
                        <div class="flex items-center justify-between w-full my-1">
                            <p class="mx-2 font-semibold text-sm">Data da Realização:</p>
                            <input type="date" class="w-3/4" v-model="form.data_realizacao">
                        </div>
                        <div class="flex items-center justify-between w-full my-1">
                            <p class="mx-2 font-semibold text-sm">Hora de Inicío:</p>
                            <input type="time" class="w-3/4" v-model="form.hora_inicio">
                        </div>
                        <div class="flex items-center justify-between w-full my-1">
                            <p class="mx-2 font-semibold text-sm">Hora do Término:</p>
                            <input type="time" class="w-3/4" v-model="form.hora_termino">
                        </div>
                        <div class="flex items-center justify-between w-full my-1">
                            <p class="mx-2 font-semibold text-sm">Duração da Prova:</p>
                            <input type="number" class="w-3/4" placeholder="em minutos" v-model="form.tempo_duracao">
                        </div>
                        <div class="flex flex-col w-full my-1">
                            <p>Observações:</p>
                            <textarea class="w-full" v-model="form.observacoes"></textarea>
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
                nome_concurso: null,
                data_realizacao: null,
                hora_inicio: null,
                hora_termino: null,
                tempo_duracao: null,
                observacoes: null
            }
        }
    },
    methods: {
        async formSubmit() {
            await Inertia.post(route('concursos.store'), this.form)
        },
    }
}
</script>
