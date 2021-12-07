<template>
    <div>
        <Head :title="title" />

        <jet-banner />

        <div class="w-full grid grid-cols-4 min-h-screen bg-gray-100">
            <nav class="col-span-1 bg-white border-b border-gray-100">
                <!-- Primary Navigation Menu -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <!-- Navigation Links -->
                            <div class="flex flex-col space-x-8 sm:-my-px sm:ml-10">
                                <jet-nav-link :href="route('dashboard')">
                                    - Incluir Questão
                                </jet-nav-link>
                                <jet-nav-link :href="route('dashboard')">
                                    - Listar Questões
                                </jet-nav-link>

                                <jet-nav-link :href="route('dashboard')">
                                    - Incluir Concurso
                                </jet-nav-link>
                                <jet-nav-link :href="route('dashboard')">
                                    - Listar Concursos
                                </jet-nav-link>

                                <jet-nav-link :href="route('dashboard')">
                                    - Incluir Disciplina
                                </jet-nav-link>
                                <jet-nav-link :href="route('dashboard')">
                                    - listar Disciplinas
                                </jet-nav-link>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Page Content -->
            <main class="col-span-3">
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
