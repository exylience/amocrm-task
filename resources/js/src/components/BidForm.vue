<template>
	<form class="w-100">
		<div class="mb-3">
			<label
				class="form-label"
				for="inputName"
				>Имя</label
			>
			<input
				id="inputName"
				class="form-control"
				:class="errors.name ? 'is-invalid' : ''"
				type="text"
				aria-describedby="inputNameMsg"
				v-model="form.name"
			/>
			<div
				id="inputNameMsg"
				class="invalid-feedback"
				v-if="errors.name"
			>
				{{ errors.name[0] }}
			</div>
		</div>
		<div class="mb-3">
			<label
				class="form-label"
				for="inputEmail"
				>Email</label
			>
			<input
				id="inputEmail"
				class="form-control"
				:class="errors.email ? 'is-invalid' : ''"
				type="email"
				aria-describedby="inputEmailMsg"
				v-model="form.email"
			/>
			<div
				id="inputEmailMsg"
				class="invalid-feedback"
				v-if="errors.email"
			>
				{{ errors.email[0] }}
			</div>
		</div>
		<div class="mb-3">
			<label
				class="form-label"
				for="inputPhone"
				>Телефон</label
			>
			<input
				id="inputPhone"
				class="form-control"
				:class="errors.phone ? 'is-invalid' : ''"
				type="tel"
				aria-describedby="inputPhoneMsg"
				v-model="form.phone"
			/>
			<div
				id="inputPhoneMsg"
				class="invalid-feedback"
				v-if="errors.phone"
			>
				{{ errors.phone[0] }}
			</div>
		</div>
		<div class="mb-3">
			<label
				class="form-label"
				for="inputPrice"
				>Цена</label
			>
			<input
				id="inputPrice"
				class="form-control"
				:class="errors.price ? 'is-invalid' : ''"
				type="number"
				aria-describedby="inputPriceMsg"
				v-model="form.price"
			/>
			<div
				id="inputPriceMsg"
				class="invalid-feedback"
				v-if="errors.price"
			>
				{{ errors.price[0] }}
			</div>
		</div>

		<button
			class="btn btn-primary"
			type="button"
			:disabled="isLoading"
			@click.prevent="sendRequest"
		>
			<span
				class="spinner-border spinner-border-sm"
				aria-hidden="true"
				v-if="isLoading"
			></span>
			<span role="status">
				{{ isLoading ? 'Отправка' : 'Отправить' }}
			</span>
		</button>
	</form>
</template>

<script lang="ts">
	import { defineComponent, ref } from 'vue';
	import axios from 'axios';

	export default defineComponent({
		setup() {
			const form = ref({
				name: '',
				email: '',
				phone: '',
				price: 0,
			});
			const isLoading = ref(false);

			const errors = ref([]);

			const sendRequest = () => {
				errors.value = [];
				isLoading.value = true;

				axios
					.post('api/bids', form.value)
					.then((res) => (isLoading.value = false))
					.catch((e) => (errors.value = e.response.data));
			};

			return {
				form,
				sendRequest,
				errors,
				isLoading,
			};
		},
	});
</script>

<style scoped></style>
