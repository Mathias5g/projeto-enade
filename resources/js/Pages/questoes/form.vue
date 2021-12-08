<template>
    <app-layout title="Questão">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div v-show="errors" id="erros">
                        <p v-for="error in errors" class="italic font-semibold text-white underline bg-red-600 p-2 m-4">{{error}}</p>
                    </div>
                    <form @submit.prevent="formSubmit" class="flex flex-col m-4">
                        <div v-show="true == false" class="flex items-center justify-between w-full my-1">
                            <p class="mx-2 font-semibold text-sm">ID da Questão:</p>
                            <input type="text" class="w-3/4">
                        </div>
                        <div class="flex items-center justify-between w-full my-1">
                            <p class="mx-2 font-semibold text-sm">Concurso:</p>
                            <select class="w-3/4" v-model="form.concurso_id">
                                <option v-for="concurso in concursos" :key="concurso.key" v-bind:value="concurso.id">{{concurso.nome_concurso}}</option>
                            </select>
                        </div>
                        <div class="flex items-center justify-between w-full my-1">
                            <p class="mx-2 font-semibold text-sm">Ano da Questão:</p>
                            <input type="date" class="w-3/4" v-model="form.ano_questao">
                        </div>
                        <div class="flex items-center justify-between w-full my-1">
                            <p class="mx-2 font-semibold text-sm">Número da Questão:</p>
                            <input type="text" class="w-3/4" v-model="form.numero_questao">
                        </div>
                        <div class="flex items-center justify-between w-full my-1">
                            <p class="mx-2 font-semibold text-sm">Tipo da Questão:</p>
                            <select class="w-3/4" v-model="form.tipo_questao">
                                <option value="" selected disabled>SELECIONE</option>
                                <option value="Dissertativa">Dissertativa</option>
                                <option value="Alternativa">Alternativa</option>
                                <option value="Alternativa">V/F</option>
                            </select>
                        </div>
                        <div class="flex items-center justify-between w-full my-1">
                            <p class="mx-2 font-semibold text-sm">Disciplina da Questão:</p>
                            <select class="w-3/4" v-model="form.disciplina_id">
                                <option value="" selected disabled>SELECIONE</option>
                                <option v-for="disciplina in disciplinas" :key="disciplina.key" v-bind:value="disciplina.id">{{disciplina.nome_disciplina}}</option>
                            </select>
                        </div>
                        <div class="flex items-center justify-between w-full my-1">
                            <p class="mx-2 font-semibold text-sm">Grau de Dificuldade:</p>
                            <select class="w-3/4" v-model="form.grau_dificuldade">
                                <option value="" selected disabled>SELECIONE</option>
                                <option value="Facil">Facil</option>
                                <option value="Moderada">Moderada</option>
                                <option value="Dificil">Dificil</option>
                            </select>
                        </div>
                        <div class="flex flex-col w-full my-1">
                            <p>Pergunta:</p>
                            <textarea class="w-full" v-model="form.pergunta"></textarea>
                        </div>
                        <div class="flex flex-col w-full my-1">
                            <p>Resposta:</p>
                            <textarea class="w-full" v-model="form.resposta"></textarea>
                        </div>
                        <div class="flex justify-between">
                            <div class="flex justify-between flex-wrap w-1/3">
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
                                <button type="submit" class="w-40 p-1 bg-red-600 text-white font-semibold mr-2">Incluir</button>
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
    props: ['errors', 'cursos', 'concursos', 'disciplinas'],
    components: {
        AppLayout
    },
    data: () => {
        return {
            form: {
                numero_questao: null,
                tipo_questao: null,
                grau_dificuldade: null,
                ano_questao: null,
                pergunta: null,
                resposta: null,
                alternativa: null,
                concurso_id: 'SELECIONE',
                disciplina_id: 'SELECIONE'
            }
        }
    },
    methods: {
        async formSubmit() {
            await Inertia.post(route('questoes.store'), this.form)
        }
    }
}
</script>
