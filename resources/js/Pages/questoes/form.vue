<template>
    <app-layout title="Questão">
        <div class="py-12 h-full">
            <div class="max-w-7xl h-full mx-auto sm:px-6 lg:px-8">
                <div class="bg-white h-full overflow-auto shadow-xl sm:rounded-lg">
                    <div v-show="errors" id="erros">
                        <p v-for="error in errors" class="italic font-semibold text-white underline bg-red-600 p-2 m-4">{{error}}</p>
                    </div>
                    <form @submit.prevent="formSubmit" class="flex flex-col p-4 h-full justify-between">
                        <div>
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
                                <p class="mx-2 font-semibold text-sm">Disciplinas da Questão:</p>
                                <Multiselect
                                    :classes="classes"
                                    v-model="form.disciplinas"
                                    mode="tags"
                                    :searchable="true"
                                    :createTag="true"
                                    :options="multiDisciplinas"
                                    :max="5"
                                    :closeOnSelect="true"
                                />
                                <!--select v-bind:class="errors.disciplinas ? 'border-red-600' : ''" class="w-3/4" v-model="form.disciplina_id">
                                    <option v-for="disciplina in disciplinas" :key="disciplina.key" v-bind:value="disciplina.id">{{disciplina.nome_disciplina}}</option>
                                </select-->
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
                            <div v-show="form.tipo_questao !== 'Dissertativa' && form.tipo_questao !== ''" class="flex justify-between">
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
                            </div>
                        </div>
                        <div class="flex justify-end">
                            <button v-if="typeof questao == 'undefined'" type="submit" class="w-40 p-1 bg-red-600 text-white font-semibold mr-2">Incluir</button>
                            <button v-else type="submit" class="w-40 p-1 bg-red-600 text-white font-semibold mr-2">Salvar</button>
                            <Link href="/questoes"><button type="button" class="w-40 p-1 bg-red-600 text-white font-semibold">Cancelar</button></Link>
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
import Multiselect from '@vueform/multiselect';
import { Link } from '@inertiajs/inertia-vue3'

export default {
    props: ['errors', 'action', 'cursos', 'concursos', 'disciplinas', 'questao', 'disciplina_questao'],
    components: {
        AppLayout,
        Multiselect,
        Link
    },
    data: () => {
        return {
            form: {
                numero_questao: null,
                tipo_questao: '',
                grau_dificuldade: null,
                pergunta: null,
                resposta: null,
                alternativa: null,
                concurso_id: null,
                disciplinas: []
            },
            multiDisciplinas: [],
            classes: {
                container: 'relative w-3/4 flex items-center justify-end box-border cursor-pointer border border-gray-500 bg-white text-base leading-snug outline-none',
                containerDisabled: 'cursor-default bg-gray-100',
                containerOpen: 'rounded-b-none',
                containerOpenTop: 'rounded-t-none',
                containerActive: 'ring ring-green-500 ring-opacity-30',
                singleLabel: 'flex items-center h-full absolute left-0 top-0 pointer-events-none bg-transparent leading-snug pl-3.5',
                multipleLabel: 'flex items-center h-full absolute left-0 top-0 pointer-events-none bg-transparent leading-snug pl-3.5',
                search: 'w-full absolute inset-0 outline-none appearance-none box-border border-0 text-base font-sans bg-white rounded pl-3.5',
                tags: 'flex-grow flex-shrink flex flex-wrap items-center mt-1 pl-2',
                tag: 'bg-red-600 text-white text-sm font-semibold py-0.5 pl-2 rounded mr-1 mb-1 flex items-center whitespace-nowrap',
                tagDisabled: 'pr-2 opacity-50',
                tagRemove: 'flex items-center justify-center p-1 mx-0.5 rounded-sm hover:bg-black hover:bg-opacity-10 group',
                tagRemoveIcon: 'bg-multiselect-remove bg-center bg-no-repeat opacity-30 inline-block w-3 h-3 group-hover:opacity-60',
                tagsSearchWrapper: 'inline-block relative mx-1 mb-1 flex-grow flex-shrink h-full',
                tagsSearch: 'absolute inset-0 border-0 outline-none appearance-none p-0 text-base font-sans box-border w-full',
                tagsSearchCopy: 'invisible whitespace-pre-wrap inline-block h-px',
                placeholder: 'flex items-center h-full absolute left-0 top-0 pointer-events-none bg-transparent leading-snug pl-3.5 text-gray-400',
                caret: 'bg-multiselect-caret bg-center bg-no-repeat w-2.5 h-4 py-px box-content mr-3.5 relative z-10 opacity-40 flex-shrink-0 flex-grow-0 transition-transform transform pointer-events-none',
                caretOpen: 'rotate-180 pointer-events-auto',
                clear: 'pr-3.5 relative z-10 opacity-40 transition duration-300 flex-shrink-0 flex-grow-0 flex hover:opacity-80',
                clearIcon: 'bg-multiselect-remove bg-center bg-no-repeat w-2.5 h-4 py-px box-content inline-block',
                spinner: 'bg-multiselect-spinner bg-center bg-no-repeat w-4 h-4 z-10 mr-3.5 animate-spin flex-shrink-0 flex-grow-0',
                dropdown: 'max-h-60 absolute -left-px -right-px bottom-0 transform translate-y-full border border-gray-300 -mt-px overflow-y-scroll z-50 bg-white flex flex-col rounded-b',
                dropdownTop: '-translate-y-full top-px bottom-auto flex-col-reverse rounded-b-none rounded-t',
                dropdownHidden: 'hidden',
                options: 'flex flex-col p-0 m-0 list-none',
                optionsTop: 'flex-col-reverse',
                group: 'p-0 m-0',
                groupLabel: 'flex text-sm box-border items-center justify-start text-left py-1 px-3 font-semibold bg-gray-200 cursor-default leading-normal',
                groupLabelPointable: 'cursor-pointer',
                groupLabelPointed: 'bg-gray-300 text-gray-700',
                groupLabelSelected: 'bg-green-600 text-white',
                groupLabelDisabled: 'bg-gray-100 text-gray-300 cursor-not-allowed',
                groupLabelSelectedPointed: 'bg-green-600 text-white opacity-90',
                groupLabelSelectedDisabled: 'text-green-100 bg-green-600 bg-opacity-50 cursor-not-allowed',
                groupOptions: 'p-0 m-0',
                option: 'flex items-center justify-start box-border text-left cursor-pointer text-base leading-snug py-2 px-3',
                optionPointed: 'text-gray-800 bg-gray-100',
                optionSelected: 'text-white bg-green-500',
                optionDisabled: 'text-gray-300 cursor-not-allowed',
                optionSelectedPointed: 'text-white bg-green-500 opacity-90',
                optionSelectedDisabled: 'text-green-100 bg-green-500 bg-opacity-50 cursor-not-allowed',
                noOptions: 'py-2 px-3 text-gray-600 bg-white',
                noResults: 'py-2 px-3 text-gray-600 bg-white',
                fakeInput: 'bg-transparent absolute left-0 right-0 -bottom-px w-full h-px border-0 p-0 appearance-none outline-none text-transparent',
                spacer: 'h-9 py-px box-content',
            }
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
            this.form.disciplinas = this.disciplina_questao.map(item => item.id)
        }

        this.disciplinas.map(item => this.multiDisciplinas.push({
            value: item.id,
            label: item.nome_disciplina
        }));
    }
}
</script>
