<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Note
            </h2>
        </template>
        <div>
            <div class="max-w-2xl mx-auto py-10 sm:px-6 lg:px-8">
                <slot></slot>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "./../../Layouts/AppLayout";
export default {
    components: {
        AppLayout
    }
};
</script>
