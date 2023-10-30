<template>
	<div
		class="container h-100 w-25 d-flex justify-content-center align-items-center"
	>
		<BidForm />
	</div>
</template>

<script lang="ts">
	import { defineComponent } from 'vue';
	import BidForm from './components/BidForm.vue';

	export default defineComponent({
		components: { BidForm },
		setup() {
			return {};
		},
	});
</script>

<style scoped></style>
