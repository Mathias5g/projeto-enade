<template>
    <app-layout title="Cursos - Listagem">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Listar Cursos
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
                            <div class="flex items-center justify-between w-3/6">
                                <p class="mx-2 font-semibold text-sm">Cursos:</p>
                                <select name="" class="w-3/4" v-model="formPesquisa.curso">
                                    <option v-for="curso in cursos" :key="curso.id" v-bind:value="curso.id">{{curso.nome_curso}}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <table id="tabela" class="w-full table-auto border-collapse">
                        <thead class="bg-red-600 text-white">
                        <tr>
                            <th class="py-6 border border-black">ID</th>
                            <th class="border border-black">Curso</th>
                            <th class="border border-black">Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="dadoCursos in dadosCursos" :key="dadoCursos.id">
                            <td class="text-center py-4 border border-black">{{dadoCursos.id}}</td>
                            <td class="text-center border border-black">{{dadoCursos.nome_curso}}</td>
                            <td class="text-center border border-black">
                                <p class="italic underline cursor-pointer text-blue-600" @click="handleEditar(dadoCursos)">Visualizar</p>
                                <p class="italic underline cursor-pointer text-blue-600" @click="handleEditar(dadoCursos)">Editar</p>
                                <p class="italic underline cursor-pointer text-blue-600" @click="handleDeletar(dadoCursos)">Excluir</p>
                            </td>
                            <confirmation-modal :show="modal" :closeable="true">
                                <template #title>
                                    <p class="text-red-600 font-bold text-3xl">AVISO!</p>
                                </template>

                                <template #content>
                                    <p class="text-lg">Você tem certeza que deseja remover o curso {{cursoDeletar.nome_curso}}? Todas as informações relacionadas
                                        serão deletadas permanentemente.</p>
                                    <br />
                                    <p class="italic text-red-600 font-semibold">Essa ação não poderá ser desfeita após a confirmação</p>
                                </template>

                                <template #footer>
                                    <button type="button" class="bg-red-600 p-4 text-white font-semibold border rounded" @click="handleConfirmaDeletar(cursoDeletar)">EXCLUIR</button>
                                    <button type="button" class="bg-blue-600 p-4 text-white font-semibold border rounded" @click="modal = !modal">CANCELAR</button>
                                </template>
                            </confirmation-modal>
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
    props: ['cursos'],
    components: {
        AppLayout,
    },
    data: () => {
        return {
            dadosCursos: null,
            desabilitado: true,
            erro: false,
            modal: false,
            cursoDeletar: null,
            mensagemErro: '',
            formPesquisa: {
                curso: null,
            }
        }
    },
    methods: {
        async handlePesquisa() {
            return await axios.post(route('pesquisas.cursos'), this.formPesquisa)
                .then((response) => {
                    if(response.data.length > 0) {
                        this.erro = false
                        return this.dadosCursos = response.data
                    } else {
                        this.mensagemErro = 'Não foi possivel achar questões com o filtro informado';
                        return this.erro = true
                    }
                })
        },
        handleResetarPesquisa() {
            this.formPesquisa.curso = null
            this.erro = false
            return this.dadosCursos = this.cursos
        },
        handleEditar(curso) {
          return Inertia.visit(route('cursos.show', curso))
        },
        handleDeletar(curso) {
            this.modal = !this.modal
            this.cursoDeletar = curso
        },
        async handleConfirmaDeletar(curso) {
            this.modal = false
            this.dadosCursos = this.cursos.filter(item => {
                return item.id !== curso.id
            });
            await axios.delete(route('cursos.destroy', curso))
            return Inertia.reload({ only: ['cursos'] })
        },
    },
    mounted() {
        this.dadosCursos = this.cursos
    },
})
</script>
