<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import DataTable from '@/Components/DataTable.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';

const props = defineProps({
    student: Object,
});

const tableHeader = {
    'name'          : 'Name',
    'email'         : 'Email',   
    'dob'           : 'Date Of Birth',
    'phone_number'  : 'Phone Number',
    'school'        : 'School',
    'father_name'   : 'Father Name',
    'course'        : 'Enrolled Course'
};
</script>

<template>
    <AppLayout title="Student Registration Details Index">
        <template #header>
            <div class="flow-root">
                <div class="float-left">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        <Link :href="route('student.index')" class="text-gray-600 hover:text-gray-900">
                            Student Registration
                        </Link>
                        / Index
                    </h2>
                </div>
                <div class="float-right">
                    <SecondaryButton>
                        <Link :href="route('student.create')" class="text-gray-600 hover:text-gray-900">
                            Add New Registration
                        </Link>
                    </SecondaryButton>
                </div>
            </div>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                	<DataTable 
                        :items="student" 
                        :theaders="tableHeader" 
                        forEditPath="student.edit" 
                        forDeletePath="student.delete"
                        forIndexPath="student.index"
                    />
                </div>
            </div>
        </div>
    </AppLayout>
</template>