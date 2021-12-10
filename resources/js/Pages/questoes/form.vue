<template>
    <app-layout title="Questão">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div v-show="errors" id="erros">
                        <p v-for="error in errors" class="italic font-semibold text-white underline bg-red-600 p-2 m-4">{{error}}</p>
                    </div>
                    <form @submit.prevent="formSubmit" class="flex flex-col m-4">
                        <div v-show="typeof questao != 'undefined'" class="flex items-center justify-between w-full my-1">
                            <p class="mx-2 font-semibold text-sm">ID no Sistema:</p>
                            <input type="text" class="w-3/4 bg-gray-200 cursor-not-allowed" v-model="form.id" disabled>
                        </div>
                        <div class="flex items-center justify-between w-full my-1">
                            <p class="mx-2 font-semibold text-sm">Concurso:</p>
                            <select v-bind:class="errors.concurso_id ? 'border-red-600' : ''" class="w-3/4" v-model="form.concurso_id">
                                <option v-for="concurso in concursos" :key="concurso.key" v-bind:value="concurso.id">{{concurso.nome_concurso}}</option>
                            </select>
                        </div>
                        <div class="flex items-center justify-between w-full my-1">
                            <p class="mx-2 font-semibold text-sm">Número da Questão:</p>
                            <input v-bind:class="errors.numero_questao ? 'border-red-600' : ''" type="text" class="w-3/4" v-model="form.numero_questao">
                        </div>
                        <div class="flex items-center justify-between w-full my-1">
                            <p class="mx-2 font-semibold text-sm">Tipo da Questão:</p>
                            <select v-bind:class="errors.tipo_questao ? 'border-red-600' : ''" class="w-3/4" v-model="form.tipo_questao">
                                <option value="Dissertativa">Dissertativa</option>
                                <option value="Alternativa">Alternativa</option>
                                <option value="Alternativa">V/F</option>
                            </select>
                        </div>
                        <div class="flex items-center justify-between w-full my-1">
                            <p class="mx-2 font-semibold text-sm">Disciplina da Questão:</p>
                            <select v-bind:class="errors.disciplina_id ? 'border-red-600' : ''" class="w-3/4" v-model="form.disciplina_id">
                                <option v-for="disciplina in disciplinas" :key="disciplina.key" v-bind:value="disciplina.id">{{disciplina.nome_disciplina}}</option>
                            </select>
                        </div>
                        <div class="flex items-center justify-between w-full my-1">
                            <p class="mx-2 font-semibold text-sm">Grau de Dificuldade:</p>
                            <select v-bind:class="errors.grau_dificuldade ? 'border-red-600' : ''" class="w-3/4" v-model="form.grau_dificuldade">
                                <option value="Facil">Facil</option>
                                <option value="Moderada">Moderada</option>
                                <option value="Dificil">Dificil</option>
                            </select>
                        </div>
                        <div class="flex flex-col w-full my-1">
                            <p>Pergunta:</p>
                            <textarea v-bind:class="errors.pergunta ? 'border-red-600' : ''" class="w-full" v-model="form.pergunta"></textarea>
                        </div>
                        <div class="flex flex-col w-full my-1">
                            <p>Alternativas:</p>
                            <textarea v-bind:class="errors.resposta ? 'border-red-600' : ''" class="w-full" v-model="form.resposta"></textarea>
                        </div>
                        <div class="flex justify-between">
                            <div v-bind:class="errors.alternativa ? 'border border-red-600' : ''" class="flex justify-between flex-wrap w-1/3">
                                <div class="flex items-center w-1/3 my-3">
                                    <p class="mr-2">A</p>
                                    <input type="radio" name="alternativa" value="A" v-model="form.alternativa">
                                </div>
                                <div class="flex items-center w-1/3 my-3">
                                    <p class="mr-2">B</p>
                                    <input type="radio" name="alternativa" value="B" v-model="form.alternativa">
                                </div>
                                <div class="flex items-center w-1/3 my-3">
                                    <p class="mr-2">C</p>
                                    <input type="radio" name="alternativa" value="C" v-model="form.alternativa">
                                </div>
                                <div class="flex items-center w-1/3 my-3">
                                    <p class="mr-2">D</p>
                                    <input type="radio" name="alternativa" value="D" v-model="form.alternativa">
                                </div>
                                <div class="flex items-center w-1/3 my-3">
                                    <p class="mr-2">E</p>
                                    <input type="radio" name="alternativa" value="E" v-model="form.alternativa">
                                </div>
                                <div class="flex items-center w-1/3 my-3">
                                    <p class="mr-2">F</p>
                                    <input type="radio" name="alternativa" value="F" v-model="form.alternativa">
                                </div>
                                <div class="flex items-center w-1/3 my-3">
                                    <p class="mr-2">Verdadeiro</p>
                                    <input type="radio" name="alternativa" value="Verdadeiro" v-model="form.alternativa">
                                </div>
                                <div class="flex items-center w-1/3 my-3">
                                    <p class="mr-2">Falso</p>
                                    <input type="radio" name="alternativa" value="Falso" v-model="form.alternativa">
                                </div>
                            </div>
                            <div class="self-end">
                                <button v-if="typeof questao == 'undefined'" type="submit" class="w-40 p-1 bg-red-600 text-white font-semibold mr-2">Incluir</button>
                                <button v-else type="submit" class="w-40 p-1 bg-red-600 text-white font-semibold mr-2">Salvar</button>
                                <button type="button" class="w-40 p-1 bg-red-600 text-white font-semibold">Cancelar</button>
                            </div>
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
    props: ['errors', 'action', 'cursos', 'concursos', 'disciplinas', 'questao'],
    components: {
        AppLayout
    },
    data: () => {
        return {
            form: {
                numero_questao: null,
                tipo_questao: null,
                grau_dificuldade: null,
                pergunta: null,
                resposta: null,
                alternativa: null,
                concurso_id: null,
                disciplina_id: null
            },
        }
    },
    methods: {
        async formSubmit() {
           this.action === route('questoes.store') ? await Inertia.post(this.action, this.form) : await Inertia.put(this.action, this.form)
        }
    },
    mounted() {
        if(typeof this.questao != 'undefined') {
            this.form = this.questao
        }

        console.log(this.form)
    }
}
</script>
