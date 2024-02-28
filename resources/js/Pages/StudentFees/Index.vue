<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import DataTable from '@/Components/DataTable.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';

const props = defineProps({
    student_fee: Object,
});

const tableHeader = {
    'course'        : 'Course Name',
    'student'       : 'Student Name',
    'installment'   : 'Installment',
    'paid'          : 'Paid',
    'balance'       : 'Balance',
    'paid_date'     : 'Paid Date',
    'next_installment_due_date' : 'Next Installment Due Date',
    'status'        : 'Status',
};
</script>

<template>
    <AppLayout title="Student Fee Index">
        <template #header>
            <div class="flow-root">
                <div class="float-left">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        <Link :href="route('student.fee.index')" class="text-gray-600 hover:text-gray-900">
                            Student / Fee
                        </Link>
                        / Index
                    </h2>
                </div>
                <div class="float-right">
                    <SecondaryButton>
                        <Link :href="route('student.fee.create')" class="text-gray-600 hover:text-gray-900">
                            Add New Student
                        </Link>
                    </SecondaryButton>
                </div>
            </div>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                	<DataTable 
                        :items="student_fee" 
                        :theaders="tableHeader" 
                        forEditPath="student.fee.edit" 
                        forDeletePath="student.fee.delete"
                    />
                </div>
            </div>
        </div>
    </AppLayout>
</template>