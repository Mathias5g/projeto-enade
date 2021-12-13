<template>
    <app-layout title="Questões - Listagem">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Listar Questões
            </h2>
        </template>

        <div class="py-12 h-full">
            <div class="max-w-7xl h-full mx-auto sm:px-6 lg:px-8">
                <div class="bg-white h-full overflow-auto shadow-xl sm:rounded-lg p-4">
                    <div id="filtro" class="flex flex-col m-4">
                        <div v-show="erro">
                            <p class="italic font-semibold text-white underline bg-red-600 p-2 m-4">{{mensagemErro}}</p>
                        </div>
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
                            <div class="flex items-center justify-between w-3/6 my-1">
                                <p class="mx-2 font-semibold text-sm">Concurso:</p>
                                <select name="" class="w-3/4" v-model="formPesquisa.concurso">
                                    <option v-for="concurso in concursos" v-bind:value="concurso.id">{{concurso.nome_concurso}}</option>
                                </select>
                            </div>
                            <div class="flex items-center justify-between w-3/6 my-1">
                                <p class="mx-2 font-semibold text-sm">Tipo de Questão:</p>
                                <select name="" class="w-3/4" v-model="formPesquisa.tipo_questao">
                                    <option value="Dissertativa">Dissertativa</option>
                                    <option value="Alternativa" >Alternativa</option>
                                    <option value="V/F">V/F</option>
                                </select>
                            </div>
                            <div class="flex items-center justify-between w-3/6 my-1">
                                <p class="mx-2 font-semibold text-sm">Ano do Concurso:</p>
                                <input type="number" min="1900" max="2099" step="1" class="w-3/4" v-model="formPesquisa.ano_concurso" placeholder="entre 1900 e 2099">
                            </div>
                            <div class="flex items-center justify-between w-3/6 my-1">
                                <p class="mx-2 font-semibold text-sm">Grau de Dificuldade:</p>
                                <select name="" class="w-3/4" v-model="formPesquisa.grau_dificuldade">
                                    <option value="Facil">Facil</option>
                                    <option value="Moderada">Moderada</option>
                                    <option value="Dificil">Dificil</option>
                                </select>
                            </div>
                            <div class="flex items-center justify-between w-3/6 my-1">
                                <p class="mx-2 font-semibold text-sm">Disciplinas:</p>
                                <select name="" class="w-3/4" v-model="formPesquisa.disciplinas">
                                    <option v-for="disciplina in disciplinas" v-bind:value="disciplina.id">{{disciplina.nome_disciplina}}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <table id="tabela" class="w-full table-auto border-collapse">
                        <thead class="bg-red-600 text-white">
                        <tr>
                            <th class="py-6 border border-black">ID</th>
                            <th class="border border-black">Concurso</th>
                            <th class="border border-black">Enunciado</th>
                            <th class="border border-black">Dificuldade</th>
                            <th class="border border-black">Tipo da Questão</th>
                            <th class="border border-black">Disciplina</th>
                            <th class="border border-black">Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="dadosQuestao in dadosQuestoes" :key="dadosQuestao.id">
                            <td class="text-center py-4 border border-black">{{dadosQuestao.id}}</td>
                            <td class="text-center border border-black">{{dadosQuestao.concurso.nome_concurso}}</td>
                            <td class="text-center border border-black">{{dadosQuestao.pergunta}}</td>
                            <td class="text-center border border-black">{{dadosQuestao.grau_dificuldade}}</td>
                            <td class="text-center border border-black">{{dadosQuestao.tipo_questao}}</td>
                            <td class="text-center border border-black">
                                <p v-for="disciplina in dadosQuestao.disciplinas">{{disciplina.nome_disciplina}}</p>
                            </td>
                            <td class="text-center border border-black">
                                <p class="italic underline cursor-pointer text-blue-600" @click="handleEditar(dadosQuestao)">Visualizar</p>
                                <p class="italic underline cursor-pointer text-blue-600" @click="handleEditar(dadosQuestao)">Editar</p>
                                <p class="italic underline cursor-pointer text-blue-600" @click="handleDeletar(dadosQuestao)">Excluir</p>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <confirmation-modal :show="modal" :closeable="true">
                        <template #title>
                            <p class="text-red-600 font-bold text-3xl">AVISO!</p>
                        </template>

                        <template #content>
                            <p class="text-lg">Você tem certeza que deseja remover a questão - {{questaoDeletar.pergunta}}? Todas as informações relacionadas
                                serão deletadas permanentemente.</p>
                            <br />
                            <p class="italic text-red-600 font-semibold">Essa ação não poderá ser desfeita após a confirmação</p>
                        </template>

                        <template #footer>
                            <button type="button" class="bg-red-600 p-4 text-white font-semibold border rounded" @click="handleConfirmaDeletar(questaoDeletar)">EXCLUIR</button>
                            <button type="button" class="bg-blue-600 p-4 text-white font-semibold border rounded" @click="modal = !modal">CANCELAR</button>
                        </template>
                    </confirmation-modal>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import {defineComponent} from 'vue'
import AppLayout from '@/Layouts/AppLayout.vue'
import ConfirmationModal from "@/Jetstream/ConfirmationModal";
import {Inertia} from "@inertiajs/inertia";

export default defineComponent({
    props: ['questoes', 'cursos', 'disciplinas', 'concursos'],
    components: {
        AppLayout,
        ConfirmationModal
    },
    data: () => {
        return {
            dadosQuestoes: null,
            questaoDeletar: null,
            modal: false,
            erro: false,
            mensagemErro: '',
            formPesquisa: {
                concurso: null,
                tipo_questao: null,
                ano_concurso: null,
                grau_dificuldade: null,
                disciplinas: null
            }
        }
    },
    methods: {
        async handlePesquisa() {
            return await axios.post(route('pesquisas.questoes'), this.formPesquisa)
                .then((response) => {
                    if(response.data.length > 0) {
                        this.erro = false
                        return this.dadosQuestoes = response.data
                    } else {
                        this.mensagemErro = 'Não foi possivel achar questões com o filtro informado';
                        return this.erro = true
                    }
                })
        },
        handleResetarPesquisa() {
            this.formPesquisa.concurso = null
            this.formPesquisa.tipo_questao = null
            this.formPesquisa.ano_concurso = null
            this.formPesquisa.curso = null
            this.formPesquisa.grau_dificuldade = null
            this.formPesquisa.disciplinas = null
            this.erro = false
            return this.dadosQuestoes = this.questoes
        },
        handleEditar(questao) {
            return Inertia.visit(route('questoes.show', questao))
        },
        handleDeletar(questao) {
            this.modal = !this.modal
            this.questaoDeletar = questao
        },
        async handleConfirmaDeletar(questo) {
            this.modal = false
            this.dadosQuestoes = this.questoes.filter(item => {
                return item.id !== questo.id
            });
            await axios.delete(route('questoes.destroy', questo))
            return Inertia.reload({ only: ['questoes'] })
        },
    },
    mounted() {
        this.dadosQuestoes = this.questoes
    },
})
</script>
