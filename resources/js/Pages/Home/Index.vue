<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Home
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="flex flex-wrap p-6 pb-12 bg-white overflow-hidden shadow-xl sm:rounded-lg"
                >
                    <nav
                        role="navigation"
                        class="flex flex-col mb-10 md:mb-0 items-start w-full md:w-1/4 lg:w-1/5 lg:px-2 lg:py-6 border-gray md:border-r-2"
                    >
                        <h2 class="text-3xl font-medium mb-4">
                            Categories
                        </h2>
                        <cat-list></cat-list>
                    </nav>
                    <stats></stats>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "./../../Layouts/AppLayout";
import CatList from "./CatList";
import Stats from "./Stats";

export default {
    components: {
        AppLayout,
        CatList,
        Stats
    },
    props: ["categories"],
    data() {
        return {};
    }
};
</script>
