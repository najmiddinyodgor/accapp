<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Profile
            </h2>
        </template>

        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <update-profile-information-form
                            :name="$page.user.name"
                            :email="$page.user.email" />
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from './../../Layouts/AppLayout'
    import UpdateProfileInformationForm from './UpdateProfileInformationForm'

    export default {
        props: ['sessions'],

        components: {
            AppLayout,
            UpdateProfileInformationForm,
        },
    }
</script>
