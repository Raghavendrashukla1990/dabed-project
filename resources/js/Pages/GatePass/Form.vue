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
    gate_pass: Object,
    students : Object,
});

const form = useForm({
	student_id 		: typeof props.gate_pass === 'undefined' ? '' : props.gate_pass.student_id,
	class 			: typeof props.gate_pass === 'undefined' ? '' : props.gate_pass.class,
	receiving_time 	: typeof props.gate_pass === 'undefined' ? '' : props.gate_pass.receiving_time,
	receiver_name 	: typeof props.gate_pass === 'undefined' ? '' : props.gate_pass.receiver_name,
	contact_number 	: typeof props.gate_pass === 'undefined' ? '' : props.gate_pass.contact_number,
	address 		: typeof props.gate_pass === 'undefined' ? '' : props.gate_pass.address,
	purpose 		: typeof props.gate_pass === 'undefined' ? '' : props.gate_pass.purpose,
});

const studentList = {};

props.students.forEach((data) => {
	studentList[data.id] = data.name
});

const submit = () => {
	if(typeof props.gate_pass === 'undefined'){
	    form.post(route('gate.pass.store'), {
	  		onSuccess: () => form.reset(),
	    });
	} else {
		form.post(route('gate.pass.update',props.gate_pass.id), {
    		PrimaryButton:true
    	});
	}  
};
</script>

<template>
    <AppLayout title="Student Gate Pass">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <Link :href="route('gate.pass.index')" class="text-gray-600 hover:text-gray-900">
                    Student Gate Pass
                </Link>
                {{ typeof props.gate_pass === 'undefined' ? '/ Add' : '/ Update' }}
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
					<form @submit.prevent="submit" class="mx-6 py-10">
				        <div class="flex flex-wrap -mx-3 mb-6">

				        	<div class="mb-4 px-3 w-full">
				            	<InputLabel for="student_id" value="Select Student" />
				                <Select 
				                	:items="studentList" 
				                	:value="form.student_id"
				                	v-model="form.student_id"
				                	id="student_id"
				                />
				                <InputError class="mt-2" :message="form.errors.student_id" />
				            </div>

    						<div class="mb-4 px-3 w-full">
				                <InputLabel for="class" value="Class Name"/>
				                <TextInput
				                    id="class"
				                    v-model="form.class"
				                    type="text"
				                    class="mt-1 block w-full"
				                />
				                <InputError class="mt-2" :message="form.errors.class" />
				            </div>

				            <div class="mb-4 px-3 w-full">
				                <InputLabel for="receiving_time" value="Receive Time"/>
				                <TextInput
				                    id="receiving_time"
				                    v-model="form.receiving_time"
				                    type="time"
				                    class="mt-1 block w-full"
				                />
				                <InputError class="mt-2" :message="form.errors.receiving_time" />
				            </div>

				            <div class="mb-4 px-3 w-full">
				                <InputLabel for="receiver_name" value="Receiver Name"/>
				                <TextInput
				                    id="receiver_name"
				                    v-model="form.receiver_name"
				                    type="text"
				                    class="mt-1 block w-full"
				                />
				                <InputError class="mt-2" :message="form.errors.receiver_name" />
				            </div>

				            <div class="mb-4 px-3 w-full">
				                <InputLabel for="contact_number" value="Contact Number"/>
				                <TextInput
				                    id="contact_number"
				                    v-model="form.contact_number"
				                    type="tel"
				                    maxLength="10"
				                    class="mt-1 block w-full"
				                />
				                <InputError class="mt-2" :message="form.errors.contact_number" />
				            </div>

				            <div class="mb-4 px-3 w-full">
				                <InputLabel for="address" value="Address"/>
				                <TextInput
				                    id="address"
				                    v-model="form.address"
				                    type="text"
				                    class="mt-1 block w-full"
				                />
				                <InputError class="mt-2" :message="form.errors.address" />
				            </div>

				            <div class="mb-4 px-3 w-full">
				                <InputLabel for="purpose" value="Purpose"/>
				                <TextInput
				                    id="purpose"
				                    v-model="form.purpose"
				                    type="text"
				                    class="mt-1 block w-full"
				                />
				                <InputError class="mt-2" :message="form.errors.purpose" />
				            </div>

				        </div>

            			<div class="flex items-center justify-end mt-4">
                			<PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    			{{ typeof props.gate_pass === 'undefined' ? 'Add' : 'Update' }}
                			</PrimaryButton>
            			</div>
        			</form>
                </div>
            </div>
        </div>
    </AppLayout>
</template>