<template>
    <section class="flex-grow lg:py-6 lg:pb-0 md:px-8">
        <h2 class="text-3xl font-medium mb-4">
            Notes
        </h2>
        <table class="w-full text-center mb-8">
            <thead>
                <tr>
                    <th class="w-1/8 border px-4 py-2">Date</th>
                    <th class="w-1/8 border px-4 py-2">Amount</th>
                    <th class="w-4/8 border px-4 py-2">Comment</th>
                    <th class="w-1/8 border px-4 py-2">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(note, index) in notes" :key="index">
                    <td class="border px-4 py-2">{{ note.date }}</td>
                    <td class="border px-4 py-2">
                        {{ styleAmount(note.amount) }} sum
                    </td>
                    <td class="border px-4 py-2" v-if="note.comment !== null">
                        {{ note.comment }}
                    </td>
                    <td class="border px-4 py-2" v-else>
                        <span class="text-gray-500">No comment</span>
                    </td>
                    <td class="border px-4 py-2">
                        <inertia-link
                            class="py-1 px-4 m-2 rounded border"
                            :href="getEditHref(note.id)"
                            >Edit</inertia-link
                        >
                        <jet-danger-button
                            @click.native="confirmDelete(note.id)"
                        >
                            Delete
                        </jet-danger-button>
                    </td>
                </tr>
            </tbody>
        </table>
        <pag></pag>
        <jet-dialog-modal
            :show="confirmingNoteDeletion"
            @close="confirmingNoteDeletion = false"
        >
            <template #title>
                Delete Note
            </template>

            <template #content>
                Are you sure you to delete note?
            </template>

            <template #footer>
                <jet-danger-button
                    class="ml-2"
                    @click.native="deleteNote"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Delete Note
                </jet-danger-button>
            </template>
        </jet-dialog-modal>
    </section>
</template>

<script>
import Pag from "./Pag";
import JetDangerButton from "./../../Jetstream/DangerButton";
import JetDialogModal from "./../../Jetstream/DialogModal";

export default {
    components: {
        JetDangerButton,
        JetDialogModal,
        Pag
    },
    data() {
        return {
            notes: this.$page.notes.data,
            deletingNote: null,
            form: this.$inertia.form({
                _method: "DELETE"
            }),
            confirmingNoteDeletion: false
        };
    },
    methods: {
        styleAmount: function(sum) {
            if (sum >= 1000) {
                return sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            } else return sum;
        },
        getEditHref: function(id) {
            return "/note/edit/" + id;
        },
        getDeleteHref: function(id) {
            return "/note/delete/" + id;
        },
        confirmDelete: function(id) {
            this.confirmingNoteDeletion = true;
            this.deletingNote = id;
        },
        deleteNote: function() {
            this.form.post("/note/delete/" + this.deletingNote);
            this.deletingNote = null;
        }
    }
};
</script>
