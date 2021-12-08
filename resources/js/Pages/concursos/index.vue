<template>
    <app-layout title="Concursos - Listagem">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Listar Concursos
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div id="filtro" class="flex flex-col m-4">
                        <div class="flex justify-between my-3">
                            <p class="text-red-600 italic underline font-semibold">Filtros:</p>
                            <button type="button" class="w-40 p-1 bg-red-600 text-white font-semibold">Pesquisar
                            </button>
                        </div>
                        <div class="flex flex-wrap justify-between">
                            <div class="flex items-center justify-between w-full my-1">
                                <p class="mx-2 font-semibold text-sm">Concurso:</p>
                                <select name="" class="w-3/4">
                                    <option value="" selected disabled>SELECIONE</option>
                                </select>
                            </div>
                            <div class="flex items-center justify-between w-full my-1">
                                <p class="mx-2 font-semibold text-sm">Data da Realização:</p>
                                <select name="" class="w-3/4">
                                    <option value="" selected disabled>SELECIONE</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <table id="tabela" class="w-full table-auto border-collapse">
                        <thead class="bg-red-600 text-white">
                        <tr>
                            <th class="py-6 border border-black">ID</th>
                            <th class="border border-black">Concurso</th>
                            <th class="border border-black">Data da Realização</th>
                            <th class="border border-black">Duração da Prova</th>
                            <th class="border border-black">Observações</th>
                            <th class="border border-black">Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="concurso in concursos" :key="concurso.id">
                            <td class="text-center py-4 border border-black">{{concurso.id}}</td>
                            <td class="text-center border border-black">{{concurso.nome_concurso}}</td>
                            <td class="text-center border border-black">{{concurso.data_realizacao}}</td>
                            <td class="text-center border border-black">{{concurso.tempo_duracao}}</td>
                            <td class="text-center border border-black">{{concurso.observacoes}}</td>
                            <td class="text-center border border-black">
                                <p>Alterar</p>
                                <p>Excluir</p>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import {defineComponent} from 'vue'
import AppLayout from '@/Layouts/AppLayout.vue'

export default defineComponent({
    props: ['concursos'],
    components: {
        AppLayout,
    },
})
</script>
