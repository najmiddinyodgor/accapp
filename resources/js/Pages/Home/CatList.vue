<template>
    <ul>
        <li
            class="py-1 cursor-pointer hover:underline"
            v-for="category in categories"
            :key="category.id"
        >
            <inertia-link :href="getHref(category.id)">{{
                category.name
            }}</inertia-link>
        </li>
    </ul>
</template>

<script>
export default {
    data() {
        return {
            categories: this.$page.categories
        };
    },
    methods: {
        getHref: function(id) {
            return "/categories/" + id;
        }
    }
};
</script>
