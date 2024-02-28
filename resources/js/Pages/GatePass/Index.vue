<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import DataTable from '@/Components/DataTable.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';

const props = defineProps({
    gate_pass: Object,
});

const tableHeader = {
    'student'         : 'Student Name',
    'class'           : 'Class',   
    'receiving_time'  : 'Receive Time',
    'receiver_name'   : 'Receiver Name',
    'contact_number'  : 'Contact Number',
    'address'         : 'Address',
    'purpose'         : 'Purpose',
};
</script>

<template>
    <AppLayout title="Student Gate Pass Details">
        <template #header>
            <div class="flow-root">
                <div class="float-left">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        <Link :href="route('gate.pass.index')" class="text-gray-600 hover:text-gray-900">
                            Student Gate Pass
                        </Link>
                        / Index
                    </h2>
                </div>
                <div class="float-right">
                    <SecondaryButton>
                        <Link :href="route('gate.pass.create')" class="text-gray-600 hover:text-gray-900">
                            Add New Student Gate Pass
                        </Link>
                    </SecondaryButton>
                </div>
            </div>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                	<DataTable 
                        :items="gate_pass" 
                        :theaders="tableHeader" 
                        forEditPath="gate.pass.edit" 
                        forDeletePath="gate.pass.delete"
                        forIndexPath="gate.pass.index"
                    />
                </div>
            </div>
        </div>
    </AppLayout>
</template>