<template>
	<v-card>
		<v-card-title class="pa-2 primary white--text">
			{{$route.name}}
			<v-spacer></v-spacer>
			<v-btn class="white">اضافة دورة</v-btn>
		</v-card-title>
		<v-card-text>

		</v-card-text>

		<d-dialog v-model="show_course_dialog">

		</d-dialog>
	</v-card>
</template>

<script>
	export default {

	}
</script>

<style lang="scss" scoped>
</style>