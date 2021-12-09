<template>
    <app-layout title="Disciplinas - Listagem">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Listar Disciplinas
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div v-show="erro">
                        <p class="italic font-semibold text-white underline bg-red-600 p-2 m-4">{{mensagemErro}}</p>
                    </div>
                    <div id="filtro" class="flex flex-col m-4">
                        <div class="flex justify-between my-3">
                            <p class="text-red-600 italic underline font-semibold">Filtros:</p>
                            <div class="flex">
                                <button type="button" class="w-40 p-1 bg-red-600 text-white font-semibold mr-2" @click="handlePesquisa">Pesquisar
                                </button>
                                <button type="button" class="w-40 p-1 bg-red-600 text-white font-semibold" @click="handleResetarPesquisa">Resetar Filtros
                                </button>
                            </div>
                        </div>
                        <div class="flex flex-wrap justify-between">
                            <div class="flex items-center justify-between w-full my-1">
                                <p class="mx-2 font-semibold text-sm">Curso:</p>
                                <select name="" class="w-3/4" v-model="formPesquisa.curso">
                                    <option v-for="curso in cursos" :key="curso.id" v-bind:value="curso.id">{{curso.nome_curso}}</option>
                                </select>
                            </div>
                            <div class="flex items-center justify-between w-full my-1">
                                <p class="mx-2 font-semibold text-sm">Disciplina:</p>
                                <select name="" class="w-3/4" v-model="formPesquisa.disciplina">
                                    <option v-for="disciplina in disciplinas" :key="disciplina.id" v-bind:value="disciplina.id">{{disciplina.nome_disciplina}}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <table id="tabela" class="w-full table-auto border-collapse">
                        <thead class="bg-red-600 text-white">
                        <tr>
                            <th class="py-6 border border-black">ID</th>
                            <th class="border border-black">Curso</th>
                            <th class="border border-black">Disciplina</th>
                            <th class="border border-black">Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="ddDisciplina in dadosDisciplina" :key="ddDisciplina.id">
                            <td class="text-center py-4 border border-black">{{ddDisciplina.id}}</td>
                            <td class="text-center border border-black">{{ddDisciplina.nome_curso}}</td>
                            <td class="text-center border border-black">{{ddDisciplina.nome_disciplina}}</td>
                            <td class="text-center border border-black">
                                <p class="italic underline cursor-pointer text-blue-600" @click="handleEditar(ddDisciplina)">Visualizar</p>
                                <p class="italic underline cursor-pointer text-blue-600" @click="handleEditar(ddDisciplina)">Editar</p>
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
import {Inertia} from "@inertiajs/inertia";

export default defineComponent({
    props: ['disciplinas', 'cursos'],
    components: {
        AppLayout,
    },
    data: () => {
        return {
            dadosDisciplina: null,
            desabilitado: true,
            erro: false,
            mensagemErro: '',
            formPesquisa: {
                curso: null,
                disciplina: null,
            }
        }
    },
    methods: {
        async handlePesquisa() {
            return await axios.post(route('pesquisas.disciplinas'), this.formPesquisa)
                .then((response) => {
                    if(response.data.length > 0) {
                        this.erro = false
                        return this.dadosDisciplina = response.data
                    } else {
                        this.mensagemErro = 'Não foi possivel achar questões com o filtro informado';
                        return this.erro = true
                    }
                })
        },
        handleResetarPesquisa() {
            this.formPesquisa.curso = null
            this.formPesquisa.disciplina = null
            this.erro = false
            return this.dadosDisciplina = this.disciplinas
        },
        handleEditar(disciplina) {
            return Inertia.visit(route('disciplinas.show', disciplina))
        },
        handleDeletar(value) {
            alert(value)
        },
    },
    mounted() {
        this.dadosDisciplina = this.disciplinas
    },
})
</script>
