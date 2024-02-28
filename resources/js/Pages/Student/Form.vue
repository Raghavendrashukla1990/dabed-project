<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import Dropdown from '@/Components/Dropdown.vue';
import Select from '@/Components/SelectDropDown.vue';

const props = defineProps({
    student: Object,
    course : Object,
});

const today 	= new Date();
let mm 			= today.getMonth();
let dd 			= today.getDate();

if (dd < 10)  dd  = '0' + dd;
if (mm < 10)  mm  = '0' + mm;

const minDate	= today.getFullYear() + "-" + mm +"-"+ dd;

const form = useForm({
	name 		: typeof props.student === 'undefined' ? '' : props.student.name ,
	email 		: typeof props.student === 'undefined' ? '' : props.student.email ,
	dob			: typeof props.student === 'undefined' ? '' : props.student.dob ,
	phone_number: typeof props.student === 'undefined' ? '' : props.student.phone_number ,
	school 		: typeof props.student === 'undefined' ? '' : props.student.school ,
	father_name	: typeof props.student === 'undefined' ? '' : props.student.father_name ,
	password 	: '',
	course_id 	: typeof props.student === 'undefined' ? '' : props.student.course_id,
});

const courseList = {};

props.course.forEach((data) => {
	courseList[data.id] = data.name
});


const submit = () => {
	if(typeof props.student === 'undefined'){
	    form.post(route('student.store'), {
	  		onSuccess: () => form.reset(),
	    });
	} else {
		form.post(route('student.update',props.student.id), {
    		PrimaryButton:true
    	});
	}  
};
</script>

<template>
    <AppLayout title="Student Registration">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <Link :href="route('student.index')" class="text-gray-600 hover:text-gray-900">
                    Student / Registration /
                </Link>
                {{ typeof props.student === 'undefined' ? 'Add' : 'Update' }}
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
					<form @submit.prevent="submit" class="mx-6 py-10">
				        <div class="flex flex-wrap -mx-3 mb-6">

				        	<div class="mb-4 px-3 w-full">
				            	<InputLabel for="course_id" value="Select Course" />
				                <Select 
				                	:items="courseList" 
				                	:value="form.course_id"
				                	v-model="form.course_id"
				                	id="course_id"
				                />
				                <InputError class="mt-2" :message="form.errors.course_id" />
				            </div>

    						<div class="mb-4 px-3 w-full">
				                <InputLabel for="name" value="Name"/>
				                <TextInput
				                    id="name"
				                    v-model="form.name"
				                    type="text"
				                    class="mt-1 block w-full"
				                />
				                <InputError class="mt-2" :message="form.errors.name" />
				            </div>

				            <div class="mb-4 px-3 w-full">
				                <InputLabel for="email" value="email"/>
				                <TextInput
				                    id="email"
				                    v-model="form.email"
				                    type="email"
				                    class="mt-1 block w-full"
				                />
				                <InputError class="mt-2" :message="form.errors.email" />
				            </div>

				            <div class="mb-4 px-3 w-full">
				                <InputLabel for="dob" value="Date Of Birth"/>
				                <TextInput
				                    id="dob"
				                    v-model="form.dob"
				                    type="date"
				                    :max="minDate"
				                    class="mt-1 block w-full"
				                />
				                <InputError class="mt-2" :message="form.errors.dob" />
				            </div>

				            <div class="mb-4 px-3 w-full">
				                <InputLabel for="phone_number" value="Phone Number"/>
				                <TextInput
				                    id="phone_number"
				                    v-model="form.phone_number"
				                    type="tel"
				                    maxlength="10"
				                    class="mt-1 block w-full"
				                />
				                <InputError class="mt-2" :message="form.errors.phone_number" />
				            </div>

				            <div class="mb-4 px-3 w-full">
				                <InputLabel for="school" value="School"/>
				                <TextInput
				                    id="school"
				                    v-model="form.school"
				                    type="text"
				                    class="mt-1 block w-full"
				                />
				                <InputError class="mt-2" :message="form.errors.school" />
				            </div>

				            <div class="mb-4 px-3 w-full">
				                <InputLabel for="father_name" value="Father Name"/>
				                <TextInput
				                    id="father_name"
				                    v-model="form.father_name"
				                    type="text"
				                    class="mt-1 block w-full"
				                />
				                <InputError class="mt-2" :message="form.errors.father_name" />
				            </div>

				            <div class="mb-4 px-3 w-full">
				                <InputLabel for="password" :value="typeof props.student === 'undefined' ? 'Set New Password' : 'Change Password' "/>
				                <TextInput
				                    id="password"
				                    v-model="form.password"
				                    type="password"
				                    class="mt-1 block w-full"
				                    autocomplete="new-password"
				                />
				                <InputError class="mt-2" :message="form.errors.password" />
				            </div>
				        </div>

            			<div class="flex items-center justify-end mt-4">
                			<PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    			{{ typeof props.student === 'undefined' ? 'Add' : 'Update' }}
                			</PrimaryButton>
            			</div>
        			</form>
                </div>
            </div>
        </div>
    </AppLayout>
</template>