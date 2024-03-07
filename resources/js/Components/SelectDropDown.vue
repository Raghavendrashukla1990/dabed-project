<script setup>
import Multiselect from '@vueform/multiselect';
const props = defineProps({
	items : {
		type: Object,
		required : true,
	},
	modelValue : {
		type : [String,Number,Boolean],
		default : false
	},
	value : {
		type : [String,Number],
		required : false,
	}
});
</script>
<template>
	<Multiselect 
		:searchable="true"
		:options="studentList" 
		@change="$emit('update:modelValue', $event.target.value)"
	/>
	
</template>
<style src="@vueform/multiselect/themes/default.css"></style>