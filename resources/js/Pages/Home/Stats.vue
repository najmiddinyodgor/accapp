<template>
    <section class="flex-grow lg:py-6 md:px-8">
        <h2 class="text-3xl font-medium mb-4">
            Statistics
        </h2>
        <div class="relative mb-6">
            <select
                class="form-input rounded-md shadow-sm w-full"
                v-model="selected"
                @change="getStat()"
            >
                <option
                    v-for="(option, index) in options"
                    :key="index"
                    :value="index"
                    >{{ option }}</option
                >
                ></select
            >
            <div
                class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700"
            >
                <svg
                    class="fill-current h-4 w-4"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20"
                >
                    <path
                        d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"
                    />
                </svg>
            </div>
        </div>
        <ul>
            <li class="pr-6 mb-2">
                <b>Incomes:</b>
                <span>{{ inc }} sum</span>
            </li>
            <li class="pr-6">
                <b>Exponses:</b>
                <span>{{ exp }} sum</span>
            </li>
        </ul>
    </section>
</template>

<script>
export default {
    data() {
        return {
            selected: 0,
            inc: 0,
            exp: 0,
            options: ["Today", "Yesterday", "Last week", "This year"]
        };
    },
    methods: {
        getStat: async function() {
            let arr = await axios.get(this.getHref(this.selected)).then(res => {
                return res.data;
            });

            this.inc = this.styleAmount(arr.inc);
            this.exp = this.styleAmount(arr.exp);
        },

        getHref: function(id) {
            return "/stats/" + this.options[id].replace(" ", "-").toLowerCase();
        },

        styleAmount: function(sum) {
            if (sum >= 1000) {
                return sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            } else return sum;
        }
    },
    created() {
        this.getStat();
    }
};
</script>
