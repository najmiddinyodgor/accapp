<template>
    <note-layout>
        <form @submit.prevent="sendForm">
            <div>
                <jet-label class="mb-1" for="category" :value="currCat" />
                <custom-select
                    @change="changeCategory($event)"
                    v-model="category"
                    :options="$page.categories"
                    id="category"
                ></custom-select>
                <jet-input-error
                    :message="form.error('category')"
                    class="mt-2"
                />
            </div>
            <jet-section-border />

            <div>
                <jet-label
                    class="mb-1"
                    for="sub-category"
                    :value="currSubCat"
                />
                <custom-select
                    :options="subCategoriesList"
                    @change="changeSubCategory($event)"
                    id="sub-category"
                ></custom-select>
            </div>
            <jet-section-border />

            <div>
                <jet-label class="mb-1" for="amount" value="Amount (sum)" />
                <jet-input
                    class="w-full"
                    id="amount"
                    type="number"
                    min="0"
                    v-model="form.amount"
                ></jet-input>
                <jet-input-error :message="form.error('amount')" class="mt-2" />
            </div>
            <jet-section-border />

            <div>
                <jet-label class="mb-1" for="comment" value="Comment" />
                <textarea
                    class="form-input rounded-md shadow-sm w-full"
                    v-model="form.comment"
                    max="255"
                    placeholder="Write your comment here..."
                ></textarea>
                <jet-input-error
                    :message="form.error('comment')"
                    class="mt-2"
                />
            </div>
            <jet-section-border />

            <div>
                <jet-label class="mb-1" for="date" value="Date" />
                <jet-input
                    class="w-full"
                    v-model="form.date"
                    id="date"
                    type="date"
                ></jet-input>
                <jet-input-error :message="form.error('date')" class="mt-2" />
            </div>
            <jet-section-border />

            <div class="d-flex">
                <jet-action-message :on="form.recentlySuccessful" class="mr-3">
                    Saved
                </jet-action-message>
                <jet-button
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Save
                </jet-button>
            </div>
        </form>
    </note-layout>
</template>

<script>
import NoteLayout from "./NoteLayout";
import JetSectionBorder from "../../Jetstream/SectionBorder";
import JetButton from "../../Jetstream/Button";
import JetLabel from "../../Jetstream/Label";
import JetInput from "../../Jetstream/Input";
import JetInputError from "../../Jetstream/InputError";
import JetActionMessage from "../../Jetstream/ActionMessage";
import CustomSelect from "./CustomSelect";

export default {
    components: {
        JetButton,
        NoteLayout,
        JetSectionBorder,
        JetInput,
        JetInputError,
        JetLabel,
        JetActionMessage,
        CustomSelect
    },
    props: ["sessions", "note", "categories", "subCategories"],
    data: function() {
        return {
            category: this.categories[0].id,
            subCategoriesList: this.subCategories,
            form: this.$inertia.form({
                _method: "PUT",
                subCategory: this.note.sub_category.id,
                amount: this.note.amount,
                comment: this.note.comment,
                date: this.note.date
            })
        };
    },
    methods: {
        changeCategory: async function(num) {
            this.category = num;
            this.subCategoriesList = await axios
                .get("/sub-categories/" + this.category)
                .then(res => {
                    return res.data;
                });
            this.form.subCategory = this.subCategoriesList[0].id;
        },
        changeSubCategory: function(num) {
            this.form.subCategory = num;
        },
        sendForm: function() {
            this.form.post("/note/update/" + this.note.id, {
                preserveScroll: true
            });
        }
    },
    computed: {
        currCat: function() {
            return "Category: " + this.note.sub_category.category.name;
        },
        currSubCat: function() {
            return "SubCategory: " + this.note.sub_category.name;
        }
    }
};
</script>
