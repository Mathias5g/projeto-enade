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
                                <p class="mx-2 font-semibold text-sm">Concurso:</p>
                                <select name="" class="w-3/4" v-model="formPesquisa.concursos">
                                    <option v-for="concurso in concursos" :key="concurso.id" v-bind:value="concurso.id">{{concurso.nome_concurso}}</option>
                                </select>
                            </div>
                            <div class="flex items-center justify-between w-full my-1">
                                <p class="mx-2 font-semibold text-sm">Data da Realização:</p>
                                <input type="number" min="1900" max="2099" step="1" class="w-3/4" v-model="formPesquisa.ano_concurso" placeholder="entre 1900 e 2099">
                            </div>
                        </div>
                    </div>
                    <table id="tabela" class="w-full table-auto border-collapse">
                        <thead class="bg-red-600 text-white">
                        <tr>
                            <th class="py-6 border border-black">ID</th>
                            <th class="border border-black">Concurso</th>
                            <th class="border border-black">Data da Realização</th>
                            <th class="border border-black">Horário de Início</th>
                            <th class="border border-black">Horário de Término</th>
                            <th class="border border-black">Duração da Prova</th>
                            <th class="border border-black">Observações</th>
                            <th class="border border-black">Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="dadoConcursos in dadosConcursos" :key="dadoConcursos.id">
                            <td class="text-center py-4 border border-black">{{dadoConcursos.id}}</td>
                            <td class="text-center border border-black">{{dadoConcursos.nome_concurso}}</td>
                            <td class="text-center border border-black">{{formatarDataHora(dadoConcursos.data_realizacao)}}</td>
                            <td class="text-center border border-black">{{dadoConcursos.hora_inicio}}</td>
                            <td class="text-center border border-black">{{dadoConcursos.hora_termino}}</td>
                            <td class="text-center border border-black">{{calcularTempoDuracao(dadoConcursos.tempo_duracao)}}</td>
                            <td class="text-center border border-black">{{dadoConcursos.observacoes}}</td>
                            <td class="text-center border border-black">
                                <p class="italic underline cursor-pointer text-blue-600" @click="handleEditar(dadoConcursos)">Visualizar</p>
                                <p class="italic underline cursor-pointer text-blue-600" @click="handleEditar(dadoConcursos)">Editar</p>
                                <p class="italic underline cursor-pointer text-blue-600" @click="handleDeletar(dadoConcursos)">Excluir</p>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <confirmation-modal :show="modal" :closeable="true">
                        <template #title>
                            <p class="text-red-600 font-bold text-3xl">AVISO!</p>
                        </template>

                        <template #content>
                            <p class="text-lg">Você tem certeza que deseja remover o concurso {{concursoDeletar.nome_concurso}}? Todas as informações relacionadas
                                serão deletadas permanentemente.</p>
                            <br />
                            <p class="italic text-red-600 font-semibold">Essa ação não poderá ser desfeita após a confirmação</p>
                        </template>

                        <template #footer>
                            <button type="button" class="bg-red-600 p-4 text-white font-semibold border rounded" @click="handleConfirmaDeletar(concursoDeletar)">EXCLUIR</button>
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
import moment from 'moment'
import {Inertia} from "@inertiajs/inertia";
import ConfirmationModal from "@/Jetstream/ConfirmationModal";

moment.locale("pt-br");
export default defineComponent({
    props: ['concursos'],
    components: {
        AppLayout,
        ConfirmationModal
    },
    data: () => {
        return {
            dadosConcursos: null,
            concursoDeletar: null,
            modal: false,
            erro: false,
            mensagemErro: '',
            formPesquisa: {
                concursos: null,
                ano_concurso: null
            }
        }
    },
    methods: {
        formatarDataHora(value) {
            return moment(value).format("dddd, D [de] MMMM [de] YYYY")
        },
        calcularTempoDuracao(value) {
            return moment.utc().startOf('day').add(value, 'minutes').format('hh [hora(s) e] mm [minutos]')
        },
        async handlePesquisa() {
            return await axios.post(route('pesquisas.concursos'), this.formPesquisa)
                .then((response) => {
                    if(response.data.length > 0) {
                        this.erro = false
                        return this.dadosConcursos = response.data
                    } else {
                        this.mensagemErro = 'Não foi possivel achar questões com o filtro informado';
                        return this.erro = true
                    }
                })
        },
        handleResetarPesquisa() {
            this.formPesquisa.concursos = null
            this.formPesquisa.ano_concurso = null
            this.erro = false
            return this.dadosConcursos = this.concursos
        },
        handleEditar(concurso) {
            return Inertia.visit(route('concursos.show', concurso))
        },
        handleDeletar(concurso) {
            this.modal = !this.modal
            this.cursoDeletar = concurso
        },
        async handleConfirmaDeletar(concurso) {
            this.modal = false
            this.dadosConcursos = this.concursos.filter(item => {
                return item.id !== concurso.id
            });
            await axios.delete(route('concursos.destroy', concurso))
            return Inertia.reload({ only: ['concurso'] })
        },
    },
    mounted() {
        this.dadosConcursos = this.concursos
    },
})
</script>
