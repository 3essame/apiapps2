<template>
	<v-card>
		<v-card-title class="pa-2 primary white--text">
			{{$route.name}}
			<v-spacer></v-spacer>
			<v-btn class="white">اضافة دورة</v-btn>
		</v-card-title>
		<v-card-text>

		</v-card-text>

		<d-dialog v-model="show_coursese" title="Attendance plane" @save="saveCource" width="600px">
			<v-select label="البرنامج التدريبي" outlined dense v-model="cource.master" :items="course_masters" item-text="name" item-value="id" :rules="[v=>!!v || 'this field is requird']" append-icon="mdi-plus" @click:append="addCourseMaster()"></v-select>
			<v-text-field outlined dense label="الاسم" type="date" v-model="course.name" :rules="[v=>!!v || 'this field is requird']"></v-text-field>
			<v-textarea label="وصف الدورة" outlined dense rows="2" v-model="course.description"></v-textarea>
			<v-text-field outlined dense label="تاريخ البداية" type="date" v-model="course.start" :rules="[v=>!!v || 'this field is requird']"></v-text-field>
			<v-text-field outlined dense label="تاريخ النهاية" type="date" v-model="course.end" :rules="[v=>!!v || 'this field is requird']"></v-text-field>
			<v-text-field outlined dense label="عدد الساعات" type="number" v-model="course.end" :rules="[v=>!!v || 'this field is requird']"></v-text-field>
			<v-select label="الاقسام" v-model="course.department_ids" outlined multiple dense :items="departments" item-text="name" item-value="id" append-icon="mdi-refresh" @click:append="$store.set('departments')" :rules="[v=>!!v || 'this field is requird']"></v-select>
		</d-dialog>
	</v-card>
</template>

<script>
	import { get } from 'vuex-pathify'
	export default {
		data() {
			return {
				key: value
			}
		},
		created() {
			this.fechCourseMasters()

		}, computed: {
			...get(['departments', 'cource_masters']),
		},
		methods: {
			fechCourseMasters() {
				this.$store.set('courseMasters')
			}
		}
	}
</script>

<style lang="scss" scoped>
</style>