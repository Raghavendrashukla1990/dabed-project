<script setup>
import { watch,ref } from "vue";
import { Head, Link, useForm } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import Dropdown from '@/Components/Dropdown.vue';
import Select from '@/Components/SelectDropDown.vue';

const studentList 	= {};
const today 		= new Date();
const yyyy 			= today.getFullYear();

let mm 				= today.getMonth() + 1; // Months start at 0!
let mm2 			= today.getMonth() + 2; // Months start at 0!
let dd 				= today.getDate();
let courseList 		= {};
let balance 		= 0;

if (dd < 10)  dd  = '0' + dd;
if (mm < 10)  mm  = '0' + mm;
if (mm2 < 10) mm2 = '0' + mm2;

const paidMinDueDate = (yyyy + '-' + mm  + '-' + dd).toString();
const nextMinDueDate = (yyyy + '-' + mm2 + '-' + dd).toString();

const props = defineProps({
    students: Object,
    student_fee : Object,
});

props.students.forEach((data) => {
	studentList[data.id] = data.name
});

const form = useForm({
	course_id 	: typeof props.student_fee === 'undefined' ? '0' 				: props.student_fee.course_id,
	student_id 	: typeof props.student_fee === 'undefined' ? '0' 				: props.student_fee.student_id,
	installment	: typeof props.student_fee === 'undefined' ? '0' 				: props.student_fee.installment,
	paid		: typeof props.student_fee === 'undefined' ? '0' 				: props.student_fee.paid,
	balance		: typeof props.student_fee === 'undefined' ? '0'				: props.student_fee.balance,
	status		: typeof props.student_fee === 'undefined' ? '1' 				: props.student_fee.status,
	paid_date	: typeof props.student_fee === 'undefined' ?  paidMinDueDate 	: props.student_fee.paid_date,
	next_installment_due_date	: typeof props.student_fee === 'undefined' ?  nextMinDueDate 	: props.student_fee.next_installment_due_date,
});

const getCourse = (student_id) =>{
	courseList = {};
	props.students.forEach((data) => {
		if(student_id == data.id){
			courseList[data.course.id] = data.course.name;
			form.balance	= Number(data.course.price);
			balance 		= Number(data.course.price);
		}
	});
}

const paidValue = (val) => {
	val = Number(val);
	if(balance > 0){
		if(val > 0 && val != ''){
			form.balance = Number(form.balance) - val;
		}else{
			form.balance = balance;
		}
	}
}

const submit = () => {
	if(typeof props.student_fee === 'undefined'){
	    form.post(route('student.fee.store'), {
	  		onSuccess: () => form.reset(),
	    });
	} else {
		form.post(route('student.fee.update',props.student_fee.id), {
    		PrimaryButton:true
    	});
	}  
};
</script>
<template>
    <AppLayout title="Course Fee Create">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <Link :href="route('student.fee.index')" class="text-gray-600 hover:text-gray-900">
                    Course / Fee
                </Link>
                {{ typeof props.student_fee === 'undefined' ? '/ Create' : '/ Edit' }}
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
					<form @submit.prevent="submit" class="mx-6 py-10">
				        <div class="flex flex-wrap -mx-3 mb-6">
    						
    						<div class="mb-4 px-3 w-full">
				                <InputLabel for="student_id" value="Student Name" required/>
				                <Select 
				                	:items="studentList" 
				                	:value="form.student_id"
				                	v-model="form.student_id"
				                	id="student_id"
				                	@change="getCourse(form.student_id)"
				                />
				                <InputError class="mt-2" :message="form.errors.student_id" />
				            </div>

				            <div class="mb-4 px-3 w-full">
				                <InputLabel for="course_id" value="Course Name" required/>
				                <select class="block border border-gray-300 p-2.5 rounded-lg text-sm w-full" v-model="form.course_id">
				                	 <option v-for="(item, key ,index) in courseList" :key="index" :value="key">{{item}}</option>
				                </select>
				                <InputError class="mt-2" :message="form.errors.student_id" />
				            </div>

				            <div class="mb-4 px-3 w-full">
				                <InputLabel for="installment" value="installment" required/>
				                <TextInput
				                    id="installment"
				                    v-model="form.installment"
				                    type="number"
				                    class="mt-1 block w-full"
				                />
				                <InputError class="mt-2" :message="form.errors.installment" />
				            </div>

				            <div class="mb-4 px-3 w-full">
				                <InputLabel for="paid" value="Paid" required/>
				                <TextInput
				                    id="paid"
				                    v-model="form.paid"
				                    type="number"
				                    class="mt-1 block w-full"
				                    @input="paidValue(form.paid)"
				                />
				                <InputError class="mt-2" :message="form.errors.paid" />
				            </div>

				            <div class="mb-4 px-3 w-full">
				                <InputLabel for="balance" value="Balance" required/>
				                <TextInput
				                    id="balance"
				                    v-model="form.balance"
				                    type="number"
				                    class="mt-1 block w-full"
				                    readonly
				                />
				                <InputError class="mt-2" :message="form.errors.balance" />
				            </div>

				            <div class="mb-4 px-3 w-full">
				                <InputLabel for="paid_date" value="Paid Date" required/>
				                <TextInput
				                    id="paid_date"
				                    v-model="form.paid_date"
				                    type="date"
				                    :min="paidMinDueDate"
				                    class="mt-1 block w-full"
				                />
				                <InputError class="mt-2" :message="form.errors.paid_date" />
				            </div>

				            <div class="mb-4 px-3 w-full">
				                <InputLabel for="next_installment_due_date" value="Next Installment Due Date" required/>
				                <TextInput
				                    id="next_installment_due_date"
				                    v-model="form.next_installment_due_date"
				                    type="date"
				                    :min="nextMinDueDate"
				                    class="mt-1 block w-full"
				                />
				                <InputError class="mt-2" :message="form.errors.next_installment_due_date" />
				            </div>

				            <div class="mb-4 px-3 w-full">
				            	<InputLabel for="status" value="Status" />
				                <select id="status" v-model="form.status" class="block border border-gray-300 p-2.5 rounded-lg text-sm w-full">
								    <option value="1">Active</option>
								    <option value="0">Inactive</option>
								</select>
				                <InputError class="mt-2" :message="form.errors.status" />
				            </div>
				        </div>

            			<div class="flex items-center justify-end mt-4">
                			<PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    			{{ typeof props.student_fee === 'undefined' ? 'Submit' : 'Update' }}
                			</PrimaryButton>
            			</div>
        			</form>
                </div>
            </div>
        </div>
    </AppLayout>
</template>