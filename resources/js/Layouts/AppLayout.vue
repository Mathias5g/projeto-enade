<template>
    <div>
        <Head :title="title" />

        <jet-banner />

        <div class="w-full grid grid-cols-4 min-h-screen bg-gray-100">
            <nav class="col-span-1 bg-white h-full border border-black">
                <!-- Primary Navigation Menu -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between">
                        <div class="flex flex-col w-full">
                            <!-- Navigation Links -->
                            <div class="flex flex-col mx-auto my-4">
                                <h1 class="text-lg">Cursos</h1>
                                <jet-nav-link :href="route('cursos.create')" class="font-semibold">
                                    - Incluir Curso
                                </jet-nav-link>
                                <jet-nav-link :href="route('cursos.index')" class="font-semibold">
                                    - Listar Cursos
                                </jet-nav-link>
                            </div>

                            <div class="flex flex-col mx-auto my-4">
                                <h1 class="text-lg">Disciplinas</h1>
                                <jet-nav-link :href="route('disciplinas.create')" class="font-semibold">
                                    - Incluir Disciplina
                                </jet-nav-link>
                                <jet-nav-link :href="route('disciplinas.index')" class="font-semibold">
                                    - Listar Disciplinas
                                </jet-nav-link>
                            </div>

                            <div class="flex flex-col mx-auto my-4">
                                <h1 class="text-lg">Concursos</h1>
                                <jet-nav-link :href="route('concursos.create')" class="font-semibold">
                                    - Incluir Concurso
                                </jet-nav-link>
                                <jet-nav-link :href="route('concursos.index')" class="font-semibold">
                                    - Listar Concursos
                                </jet-nav-link>
                            </div>

                            <div class="flex flex-col mx-auto my-4">
                                <h1 class="text-lg">Questões</h1>
                                <jet-nav-link :href="route('questoes.create')" class="font-semibold">
                                    - Incluir Questão
                                </jet-nav-link>
                                <jet-nav-link :href="route('questoes.index')" class="font-semibold">
                                    - Listar Questões
                                </jet-nav-link>
                            </div>

                            <div class="flex flex-col mx-auto my-4">
                                <h1 class="text-lg">Relatorios</h1>
                                <jet-nav-link :href="route('relatorios.index')" class="font-semibold">
                                    - Gerar Relatorio
                                </jet-nav-link>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Page Content -->
            <main class="col-span-3 border border-black h-screen">
                <slot></slot>
            </main>
        </div>
    </div>
</template>

<script>
    import { defineComponent } from 'vue'
    import JetApplicationMark from '@/Jetstream/ApplicationMark.vue'
    import JetBanner from '@/Jetstream/Banner.vue'
    import JetNavLink from '@/Jetstream/NavLink.vue'
    import { Head, Link } from '@inertiajs/inertia-vue3';

    export default defineComponent({
        props: {
            title: String,
        },

        components: {
            Head,
            JetApplicationMark,
            JetBanner,
            JetNavLink,
            Link,
        },

        data() {
            return {
                showingNavigationDropdown: false,
            }
        },

        methods: {
            logout() {
                this.$inertia.post(route('logout'));
            },
        }
    })
</script>
